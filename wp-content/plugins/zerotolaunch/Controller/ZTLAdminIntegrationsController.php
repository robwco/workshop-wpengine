<?php

require_once 'ZTLAdminController.php';
require_once(plugin_dir_path(__FILE__) . '../Model/ZTLPluginOptinFormLeads.php');
			
if (!class_exists('ZTLAdminIntegrationsController')) {

class ZTLAdminIntegrationsController extends ZTLAdminController {
	public function doIndex() {
		global $wpdb;
		$wpdb->hide_errors();

		$levels = array();
		$serialized = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'wpm_levels'");
		if (!empty($serialized)) {
			$optionVal = unserialize($serialized);

			foreach ($optionVal as $key=>$row) {
				$levels[$key] = $row;
			}
		}

		$skus = ZTLPluginSkus::find('all');

		// TODO This is just pulling the first value from the DB due to my lack of ActiveRecord Knowledge!
		$mailChimpApiKey = ZTLPluginAdapters::find('first');
		$gumroadApiKey = ZTLPluginAdapters::find(2);
		$errors = array();

		$siteUrl = get_option('siteurl');
		$parsed = parse_url($siteUrl);

		$message = array();

		if (empty($_POST) && isset($_GET['action']) && $_GET['action'] != 'delete') {
			$message = get_transient('ztl-messages');
			delete_transient('ztl-messages');
		}

		$params = array(
			'mailchimp_api_key' => $mailChimpApiKey,
			'gumroad_api_key' => $gumroadApiKey,
			'mailchimp_logo' => plugins_url('/assets/images/mailchimp-logo.png', dirname(__FILE__)),
			'gumroad_logo' => plugins_url('/assets/images/gumroad-logo.png', dirname(__FILE__)),
			'export_img' => plugins_url('/assets/images/export.png', dirname(__FILE__)),
			'integration' => isset($_GET['integration']) ? $_GET['integration'] : null,
			'levels' => $levels,
			'skus' => $skus,
			'site_url'=>$parsed['host'],
			'errors'=>array(),
			'message'=>$message
		);

		//This saves changes
		if (!empty($_POST['ztl_mc_apikey_id'])) {
			try {
				$mc_api_submit = $_POST['ztl_mc_apikey_id'];
				$errors = array();

				$mailchimp = new ZTLMailChimpAPI($_POST['ztl_mc_apikey']);

				$success_message = "";
				if (empty($_POST['ztl_mc_apikey'])) {
					$this->ztlAdapter = ZTLPluginAdapters::find($mc_api_submit);
					$this->ztlAdapter->api_key = null;
					$this->ztlAdapter->save();							
				}
				else {
					if (!empty($_POST['ztl_mc_apikey']) && $mailchimp->isApiValid($_POST['ztl_mc_apikey'])) {
						$this->ztlAdapter = ZTLPluginAdapters::find($mc_api_submit);
						$this->ztlAdapter->api_key = $_POST['ztl_mc_apikey'];
						$this->ztlAdapter->save();					
						$success_message = "Your key was validated and saved.";
					}
					else {
						$errors = array('This MailChimp API key does not appear to be valid. Please try again.');		
						$success_message = '';				
					}
				}

				if ($_REQUEST['integration'] == 'gumroad') {
					$success_message = 'Gumroad success';
				}
				// TODO This is just pulling the first value from the DB due to my lack of ActiveRecord Knowledge!
				// There may also be a better way to do this!
				$newMailChimpApiKey = ZTLPluginAdapters::find('first');

				$params = array(
					'mailchimp_api_key' => $newMailChimpApiKey,
					'gumroad_api_key' => $gumroadApiKey,
					'mailchimp_logo' => plugins_url('/assets/images/mailchimp-logo.png', dirname(__FILE__)),
					'gumroad_logo' => plugins_url('/assets/images/gumroad-logo.png', dirname(__FILE__)),
					'export_img' => plugins_url('/assets/images/export.png', dirname(__FILE__)),
					'integration' => 'mailchimp',
					'errors'=>$errors,
					'success_message' => $success_message
				);

			}
			catch (ActiveRecord\RecordNotFound $e) {
				// TODO add flash message?
				wp_redirect($this->adminPageUrl());
				exit;
			}
		}

		echo $this->view->render('admin/integrations/index.twig', array_merge(
																		$params, 
																		array('user'=>$this->getUserData())
																	));
	}
	static function export_leads_callback() {
		$formatted = array();
		$output = ZTLPluginOptinFormLeads::find('all');
		if (!empty($output)) {
			foreach ($output as $row) {
				$newRow = array();
				$newRow['email'] = $row->email;
				$newRow['name'] = $row->name;
				$newRow['created'] = $row->created->format('c');
				$formatted[] = $newRow;
			}
		}
		
		ZTLAdminIntegrationsController::array_to_csv_download($formatted, 'ztl-leads.csv');
		exit;
	}
	static function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
	    header('Content-Type: application/csv');
	    header('Content-Disposition: attachement; filename="'.$filename.'";');

	    $f = fopen('php://output', 'w');

	    foreach ($array as $line) {
	        fputcsv($f, $line, $delimiter);
	    }
	}   
	/**
	 * Callback for saving a simple AJAX option with no page reload
	 */

	function mc_value() {

		if( isset( $_POST['data'] ) && isset( $_POST['data']['test-ajax'] ) ) {
			try {					
					$this->ztlAdapter = ZTLPluginAdapters::find($_POST['data']['ztl_mc_apikey_id']);
					$this->ztlAdapter->api_key = $_POST['data']['test-ajax'];
					$this->ztlAdapter->save();

					wp_redirect($this->admin_page_url());

				} catch (ActiveRecord\RecordNotFound $e) {
					// TODO add flash message?
					wp_redirect($this->adminPageUrl());
					exit;
				}
		}	
		die();
		}

	}
}
