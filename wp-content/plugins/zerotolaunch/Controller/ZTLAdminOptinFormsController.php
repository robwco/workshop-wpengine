<?php

require_once 'ZTLAdminController.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLMailChimpAPI.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLOptinFormRenderer.php';

if (!class_exists('ZTLAdminOptinFormsController')) {
	class ZTLAdminOptinFormsController extends ZTLAdminController {
		protected $optinForm;

		public function doIndex() {
			// TODO make per page a reasonable value and centralize it. Perhaps we could use screen options
			//      to allow the user to set this like they can per-page for posts?
			//      cf http://codex.wordpress.org/Function_Reference/add_screen_option
			$perPage = 10;
			$offset = $perPage * (isset($this->input->get['paged']) ? intval($this->input->get['paged']) - 1 : 0);

			// TODO look at generalizing pagination so that it can be re-used and we can cleanup this controller.
			$count = ZTLPluginOptinForm::count();
			$totalPages = ceil($count / $perPage);

			$optinForms = ZTLPluginOptinForm::find('all', array(
				'limit' => $perPage,
				'offset' => $offset,
				'order' => 'name'
			));

			$currentOptinFormsActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => 'date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '"'
				));
			$prevOptinFormsActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => 'date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 14 DAY) AND DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY)'
				));

			$params = array(
				'optin_forms' => $optinForms,
				'optin_form_activity' => $currentOptinFormsActivity,
				'prev_optin_form_activity' => $prevOptinFormsActivity,
				'optin_form_count' => $count,
				'pagination' => $this->adminPaginateLinks($totalPages)
			);

			echo $this->view->render('admin/optin_forms/index.twig',
										array_merge(
											$params, 
											array('user'=>$this->getUserData())
										));
		}

		public function preEdit() {
			if (!empty($this->input->get['id'])) {
				$id = $this->input->get['id'];
			} elseif (!empty($this->input->post['optin_form']['id'])) {
				$id = $this->input->post['optin_form']['id'];
			}

			if (!empty($id)) {
				try {
					$this->optinForm = ZTLPluginOptinForm::find($id);
				} catch (ActiveRecord\RecordNotFound $e) {
					// TODO add flash message?
					wp_redirect($this->adminPageUrl());
					exit;
				}
			} else {
				$this->optinForm = new ZTLPluginOptinForm();
				$this->optinForm->theme = 'gray-blue';
			}

			if ('POST' == $_SERVER['REQUEST_METHOD']) {
				check_admin_referer($this->modelNonceAction($this->optinForm, 'update'));
				
				$this->optinForm->update_attributes($this->input->post['optin_form']);
			}
			
		}
		public static function render_optin_ajax($postData) {
			$renderer = new ZTLOptinFormRenderer();
			if (!empty($postData['id'])) {
				$optinFormID = $postData['id'];
			}
			else {
				if (!empty($_GET['id'])) {
					$optinFormID = $_GET['id'];

					$output = ZTLPluginOptinForm::find($optinFormID);
					$postData = $output->attributes();
					//var_dump($postData);
				}
			}

			if (!empty($optinFormID)) {
				$ajaxData = array();

				$ajaxData['ZTLPluginOptinForm']['headline'] = stripslashes($postData['headline']);
				$ajaxData['ZTLPluginOptinForm']['sub_headline'] = stripslashes($postData['subHeadline']);
				$ajaxData['ZTLPluginOptinForm']['name_field_text'] = stripslashes($postData['namePlaceholder']);
				$ajaxData['ZTLPluginOptinForm']['email_field_text'] = stripslashes($postData['emailPlaceholder']);
				$ajaxData['ZTLPluginOptinForm']['c2a_button_text'] = stripslashes($postData['formC2AButton']);
				
				$ajaxData['ZTLPluginOptinForm']['body'] = stripslashes($postData['body']);
				
				$ajaxData['ZTLPluginOptinForm']['display_image'] = $postData['hasDisplayImage'];
				$ajaxData['ZTLPluginOptinForm']['display_name_field'] = $postData['hasDisplayName'];
				
				$ajaxData['ZTLPluginOptinForm']['image_url'] = stripslashes($postData['displayImage']);
				
				if ($optinFormID == 'new') {
					echo $renderer->render(null, array(
													'optin_form' => null,
													'editing' => true,
													'theme' => $postData['theme'],
													'ajaxData'=>$ajaxData));					
				}
				else {			
					$optinForm = ZTLPluginOptinForm::find($optinFormID);
					$ajaxData['ZTLPluginOptinForm']['id'] = $optinForm->id;
					$ajaxData['ZTLPluginOptinForm']['mailing_list_id'] = $optinForm->mailing_list_id;
					$ajaxData['ZTLPluginOptinForm']['name'] = $optinForm->name;
					$ajaxData['ZTLPluginOptinForm']['slug'] = $optinForm->slug;
					$ajaxData['ZTLPluginOptinForm']['description'] = $optinForm->description;
					$ajaxData['ZTLPluginOptinForm']['redirect_url'] = $optinForm->redirect_url;
									
					$ajaxData['ZTLPluginOptinForm']['image_alt'] = $optinForm->image_alt;
					$ajaxData['ZTLPluginOptinForm']['image_width'] = $optinForm->image_width;
					$ajaxData['ZTLPluginOptinForm']['image_height'] = $optinForm->image_height;
					
					$ajaxData['ZTLPluginOptinForm']['theme'] = $optinForm->theme;				
				
					if (empty($postData['theme'])) {
						$postData['theme'] = $optinForm->theme;
					}
					echo $renderer->render($optinForm, array(
													'optin_form' => $optinForm,
													'editing' => true,
													'theme' => $postData['theme'],
													'ajaxData'=>$ajaxData));				
				}
			}

			exit();
		}
		public function doEdit() {
			$mailchimpAdapter = ZTLPluginAdapters::find(array('conditions'=>"name = 'MailChimp'"));
			$apiKey = $mailchimpAdapter->api_key;
			$mailchimp = new ZTLMailChimpAPI($apiKey);
			$lists = array();
			$errors = array();
			$success_message = '';

			if ('POST' == $_SERVER['REQUEST_METHOD']) {
				$success_message = 'Your Opt-in form has been saved.';
			} 
			else {
				$success_message = '';
			}

			if (!empty($apiKey)) {
				if ($mailchimp->isApiValid($apiKey)) {
					$lists = $mailchimp->getAllLists();
				}
				else {
					$errors[]= 'Warning: Invalid Mailchimp API key or missing.';					
				}
			}


			$themes = ZTLPluginOptinForm::availableThemes();
				
			$selected_theme = $this->optinForm->theme;

			if (!in_array($selected_theme, $themes)) {
				$selected_theme = $themes[0];
			}

			$params = array(
				'themes' => $themes,
				'selected_theme' => $selected_theme,
				'lists' => $lists,
				'optin_form' => $this->optinForm,
				'errors' => $errors,
				'success_message' => $success_message
			);

			echo $this->view->render('admin/optin_forms/edit.twig',
										array_merge(
											$params, 
											array('user'=>$this->getUserData())
										));
		}

		public function doConfirmDelete() {
			try {
				$this->optinForm = ZTLPluginOptinForm::find($this->input->post['id']);
			} catch (ActiveRecord\RecordNotFound $e) {
				// No need to confirm the deletion of a non-existant record
				wp_redirect($this->adminPageUrl());
				exit;
			}

			check_admin_referer($this->modelNonceAction($this->optinForm, 'delete'));

			echo $this->view->render(
				'admin/optin_forms/confirm_delete.twig',
				array('optin_form' => $this->optinForm));
		}

		public function preDelete() {
			if (empty($this->input->post['id'])) {
				wp_redirect($this->adminPageUrl());
				exit;
			}

			try {
				$this->optinForm = ZTLPluginOptinForm::find($this->input->post['id']);

				check_admin_referer($this->modelNonceAction($this->optinForm, 'delete'));

				$this->optinForm->delete();
			} catch (ActiveRecord\RecordNotFound $e) {
				// Do nothing here since the original intent was to delete the optin form anyway.
			}

			// TODO add flash message?
			wp_redirect($this->adminPageUrl());
			exit;
		}
	}
}
