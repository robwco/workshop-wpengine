<?php

require_once 'ZTLAppController.php';
require_once(plugin_dir_path(__FILE__) . '../Model/ZTLPluginOptinFormLeads.php');
require_once(plugin_dir_path(__FILE__) . '../Model/ZTLPluginActivity.php');

if (!class_exists('ZTLShortcodeController')) {
	class ZTLShortcodeController extends ZTLAppController {
		// Display the optin form using a short code
		public function htmlOptinForm($slug) {
			$optinForm = ZTLPluginOptinForm::find(array('conditions'=>"slug = '".$slug."'"));

			if (empty($optinForm)) {
				return null;
			}

			return $this->renderOptinForm($optinForm, 'view', 'shortcode');
		}
		
		public function logView($options) {
			$today = date('Y-m-d');
			$activity = new ZTLPluginActivity();
			if ($options['type']=='landing_page') {
				$result = $activity->find('first', 
					array('conditions'=>array(
						"date = '".$today."' AND 
							optin_form_id = ".$options['id']." AND 
							landing_page_id = ".$options['landingPageID']." AND 
							category ='View' AND 
							type = '".$options['type']."' 
							AND slug = '".$options['slug']."'"
					)));
				
				if (empty($result)) {
					$activity = new ZTLPluginActivity();
					$activity->category = 'View';
					$activity->landing_page_id = $options['landingPageID'];
					$activity->optin_form_id = $options['id'];
					$activity->date = date('Y-m-d');
					$activity->type = $options['type'];
					$activity->slug = $options['slug'];
					
					$activity->hits = 1;
					$activity->save();				
				}
				else {
					$result->hits++;
					$result->save();
				}				
			}
			else {
				$result = $activity->find('first', 
					array('conditions'=>array(
						"date = '".$today."' AND 
							optin_form_id = ".$options['id']." AND 
							category ='View' AND 
							type = '".$options['type']."' 
							AND slug = '".$options['slug']."'"
					)));
				
				if (empty($result)) {
					$activity = new ZTLPluginActivity();
					$activity->category = 'View';
					$activity->optin_form_id = $options['id'];
					$activity->date = date('Y-m-d');
					$activity->type = $options['type'];
					$activity->slug = $options['slug'];
					$activity->hits = 1;
					$activity->save();				
				}
				else {
					$result->hits++;
					$result->save();
				}
			}
			
			exit;
		}
		
		// Handle the posting of the optin form from a short codes
		public function postOptinForm() {
			if (!empty($this->input->post['ztl-plugin-slug'])) {
				$slug = $this->input->post['ztl-plugin-slug'];
				$type = $this->input->post['type'];
				
				$optinForm = ZTLPluginOptinForm::find(array(
					'conditions'=>"slug = '".$slug."'"
				));

				if (!empty($optinForm)) {
					try {
						$lastName = "(Last Name Not Given)";

						if (!empty($this->input->post['name'])) {
							$firstName = $this->input->post['name'];

							//make firstName and lastName pretty
							$displayName = explode(" ", $this->input->post['name']);
							if (!empty($displayName[0])) {
								$firstName = $displayName[0];
							}

							if (!empty($displayName[1])) {
								$lastName = $displayName[1];
							}
						} else {
							$firstName = '(First Name Not Given)';
						}

						$result = ZTLPluginAdapters::find(array('conditions'=>"name = 'MailChimp'"));
						$apiKey = $result->api_key;
						
						if (!empty($apiKey)) {
							require_once ZTL_PLUGIN_PATH . 'Lib/ZTLMailChimpAPI.php';
							$mailchimp = new ZTLMailChimpAPI($apiKey);
							if ($mailchimp->isApiValid($apiKey)) {
								$email = $this->input->post['email'];
								$listID = $optinForm->mailing_list_id;
								$mailchimp->addSubscriber($listID, $email, $firstName, $lastName);
							}
						}
						
						//save lead
						ZTLPluginOptinFormLeads::create(array(
								'id'=>null,
								'optin_form_id'=>$optinForm->id,
								'name'=>$this->input->post['name'],
								'email'=>$this->input->post['email'],
								'created'=>date('c')
							));
						
						//activity
						$today = date('Y-m-d');
						$activity = new ZTLPluginActivity();
						$result = $activity->find('first', 
							array('conditions'=>array(
								"date = '".$today."' AND 
									optin_form_id = ".$optinForm->id." AND 
									category ='Conversion' AND 
									type = '".$type."' 
									AND slug = '".$slug."'"
							)));
						
						if (empty($result)) {
							$activity = new ZTLPluginActivity();
							$activity->category = 'Conversion';
							$activity->optin_form_id = $optinForm->id;
							if (!empty($this->input->post['landingPageID'])) {
								$activity->landing_page_id = $this->input->post['landingPageID'];
							}
							$activity->date = date('Y-m-d');
							$activity->type = $type;
							$activity->slug = $slug;
							$activity->hits = 1;
							$activity->save();				
						}
						else {
							$result->hits++;
							$result->save();
						}						
					}
					catch (Exception $e) {
						error_log("Error while handling optin form submittal: " . $e);
					}

					wp_redirect($optinForm->redirect_url);
					exit;
				}
			}
		}
	}
}