<?php

require_once ZTL_PLUGIN_PATH . 'Lib/ZTLMailChimpAPI.php';
require_once(ZTL_PLUGIN_PATH . 'Model/ZTLPluginOptinFormLeads.php');

class ZTLPluginStatus {
	private $plugin;

	public function __construct($plugin) {
		$this->plugin = $plugin;
	}

	public static function saveSiteDomainForPostUrl($postUrl, $siteDomain) {
		//TODO these two curl calls (one below and one in postPluginChecklistToIWTStudents) should be merged into one call

		$leadsCount = ZTLPluginOptinFormLeads::count();

		$fields = array(
			'site_domain' => $siteDomain,
			'leads_count' => $leadsCount
		);

		$fields_string = '';
		foreach ($fields as $key => $value) {
			$fields_string .= $key . '=' . $value . '&';
		}

		rtrim($fields_string, '&');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close($ch);

		// Stick the Plugin Checklist into the IWTStudents DB
		// --------------------------------------------------
		// TODO: refactor into the encoded Base64 string
		$checklist = self::getPluginChecklist();
		self::postPluginChecklistToIWTStudents($checklist);

	}

	public function check() {
		return eval(base64_decode("CQkJJGlzVmFsaWQgPSAwOw0KDQoJCQkkaXNDYWNoZVZhbGlkID0gZ2V0X3RyYW5zaWVudCgienRsX3BsdWdpbl9pc192YWxpZCIpOw0KDQoJCQlpZiAoZW1wdHkoJGlzQ2FjaGVWYWxpZCkpIHsNCgkJCQkka2V5ID0gZ2V0X3RyYW5zaWVudCgienRsX3BsdWdpbl9hcGlfa2V5Iik7DQoJCQkJaWYgKCFlbXB0eSgka2V5KSkgew0KCQkJCQkkcmVhZFVybCA9IFpUTDo6JGJhc2VVcmwuIi96ZXJvX3RvX2xhdW5jaC9hcGkvIi4ka2V5Ow0KCQkJCQkkcmVzdWx0cyA9IEBmaWxlX2dldF9jb250ZW50cygkcmVhZFVybCk7DQoNCgkJCQkJaWYgKCFlbXB0eSgkcmVzdWx0cykpIHsNCgkJCQkJCSRyZXN1bHRzSnNvbiA9IGpzb25fZGVjb2RlKCRyZXN1bHRzLCB0cnVlKTsNCgkJCQkJCWlmICghZW1wdHkoJHJlc3VsdHNKc29uWyJyZXN1bHQiXSkpIHsNCgkJCQkJCQlpZiAoJHJlc3VsdHNKc29uWyJyZXN1bHQiXSAhPSAiZXJyb3IiKSB7DQoJCQkJCQkJCSRpc1ZhbGlkID0gIjEiOw0KCQkJCQkJCQlzZXRfdHJhbnNpZW50KCJ6dGxfcGx1Z2luX2lzX3ZhbGlkIiwgIjEiLCA4NjQwMCAqIDEpOw0KDQoJCQkJCQkJCSRlbmRwb2ludCA9ICJ1cGRhdGUtZG9tYWluIjsNCgkJCQkJCQkJJHBvc3RVcmwgPSBaVEw6OiRiYXNlVXJsLiIvemVyb190b19sYXVuY2gvYXBpLyIuJGtleS4iLyIuJGVuZHBvaW50Ow0KDQoJCQkJCQkJCSRzaXRlVXJsID0gZ2V0X29wdGlvbigic2l0ZXVybCIpOw0KCQkJCQkJCQkkcGFyc2VkID0gcGFyc2VfdXJsKCRzaXRlVXJsKTsNCg0KCQkJCQkJCQlaVExQbHVnaW5TdGF0dXM6OnNhdmVTaXRlRG9tYWluRm9yUG9zdFVybCgkcG9zdFVybCwgJHBhcnNlZFsiaG9zdCJdKTsNCgkJCQkJCQl9DQoJCQkJCQl9DQoJCQkJCX0NCgkJCQl9DQoJCQl9DQoJCQllbHNlaWYgKCRpc0NhY2hlVmFsaWQgPT0gMSkgew0KCQkJCSRpc1ZhbGlkID0gIjEiOw0KCQkJfQ0KDQoJCQkkaW5wdXQgPSAkdGhpcy0+cGx1Z2luLT5pbnB1dDsNCgkJCQ0KCQkJaWYgKCRpc1ZhbGlkID09ICIxIikgew0KCQkJCVpUTEFkbWluOjpyZWdpc3RlcigkaW5wdXQpOwkNCgkJCQlhZGRfc2hvcnRjb2RlKCd6dGxfb3B0aW4nLCBhcnJheSgmJHRoaXMtPnBsdWdpbi0+c2hvcnRjb2RlcywgJ2Rpc3BsYXknKSk7CQkJDQoJCQl9IGVsc2Ugew0KCQkJCS8vcGx1Z2luIGRpZCBub3QgdmFsaWRhdGUNCgkJCQlhZGRfc2hvcnRjb2RlKCJ6dGxfb3B0aW4iLCBhcnJheSgmJHRoaXMtPnBsdWdpbi0+c2hvcnRjb2RlcywgImRpc3BsYXlFbXB0eSIpKTsNCgkJCQlaVExBZG1pbkxvZ2luOjpyZWdpc3RlcigkaW5wdXQpOw0KCQkJCXJldHVybiAxOw0KCQkJfQ=="));
	}

	/**
	 * Gets the list of the user's progress in installing and updating
	 * all features for the plugin
	 *
	 * @return array
	 */
	public static function getPluginChecklist() {
		global $wpdb;

		// TODO can we use get_option here? It seems like hard coding the optin_id here could be dangerous
		// Get Site Domain
		$domain = $wpdb->get_var('SELECT option_value FROM wp_options WHERE option_id = 1');

		// Get Theme
		$theme = get_option('template');

		// Check to see if there is a landing page setup
		$landingPage = $wpdb->get_var('SELECT COUNT(*) FROM wp_posts WHERE post_type = "ztl_landing_page"');

		// See if ZTL is installed
		$ztlInstalled = strpos($wpdb->get_var('SELECT option_value FROM wp_options WHERE option_name = "active_plugins"') , 'zerotolaunch');

		//Check for MailChimp and Gumroad API keys
		$mailChimpApiKey = ZTLPluginAdapters::find('first');
		$gumroadApiKey = ZTLPluginAdapters::find(2);

		// Check to see if there's an Optin Form
		$optinForms = ZTLPluginOptinForm::find('all');

		//Check to see if a list has been built in MailChimp
		$result = ZTLPluginAdapters::find(array('conditions'=>"name = 'MailChimp'"));
		$apiKey = $result->api_key;

		$mailchimp = new ZTLMailChimpAPI($apiKey);
		if ($mailchimp->isApiValid($apiKey)) {
			$result = $mailchimp->getAllLists();
			if (!empty($result)) {
				$mailchimpListSetup = 1;
			} else {
				$mailchimpListSetup = 0;
			}
		}
		else {
			$mailchimpListSetup = 0;
		}

		$membershipLevelCreated = false;
		// Check if we've created a membership level
		$serialized = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'wpm_levels'");
		if (!empty($serialized)) {
			$optionVal = unserialize($serialized);
			foreach ($optionVal as $key=>$row) {
				$membershipLevelCreated = true;
				break;
			}
		}

		$hasCreatedMembershipLevel = 0;
		if (!empty($membershipLevelCreated)) {
			$hasCreatedMembershipLevel = 1;
		}

		// TODO use ActiveRecord
		// Check to see if there has been an Optin
		$optinConversion = $wpdb->get_var('SELECT id FROM wp_ztl_plugin_activity WHERE category = "Conversion"');


		$domainSetup = '';
		if (!empty($domain)) {
			if (strpos($domain, ".wpengine.com") !== false) {
				//user still did not setup a domain and only used the default subdomain provided (ex. foo.wpengine.com)
				$domainSetup = '';
			}
			else {
				$domainSetup = true;
			}
		}

		$themeSetup = $theme != '';
		$ztlSetup = $ztlInstalled != '';
		$landingPageSetup = $landingPage != 0;
		$optinSetup = !empty($optinForms);
		$mailchimpSetup = $mailChimpApiKey->api_key && strpos($mailChimpApiKey->api_key, 'Add your ') !== 0;
		$gumroadSetup = ZTLPluginSkus::count() > 0;
		$optinConversionSetup = $optinConversion != '';

		return array(
			'has_setup_domain_name' => $domainSetup,
			'has_setup_theme' => $themeSetup,
			'has_installed_ztl_plugin' => $ztlSetup,
			'has_created_a_landing_page' => $landingPageSetup,
			'has_created_an_optin' => $optinSetup,
			'has_mailchimp_integration_complete' => $mailchimpSetup,
			'has_mailchimp_mailing_list_confirmed' => $mailchimpListSetup,
			'has_gumroad_integration_complete' => $gumroadSetup,
			'has_received_first_customer_optin' => $optinConversionSetup,
			'has_made_first_wishlist_sale' => 0,
			'has_created_a_membership_level' => $hasCreatedMembershipLevel,
			//'site_domain' => $domain,
		);
	}

	private static function postPluginChecklistToIWTStudents($params) {
		// Send JSON object to IWTS back-end
		$key = get_transient('ztl_plugin_api_key');

		$endpoint = 'checklist';
		$action = 'write';
		$postUrl = ZTL::$baseUrl."/zero_to_launch/api/".$key."/".$endpoint."/".$action;

		$fields_string = '';
		foreach($params as $key=>$value) {
			$fields_string .= $key.'='.$value.'&';
		}

		rtrim($fields_string, '&');

		$ch = curl_init();

		curl_setopt($ch,CURLOPT_URL, $postUrl);
		curl_setopt($ch,CURLOPT_POST, count($params));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
	}

	/**
	 *for testing
	 */
	public function initTest() {
		if (!empty($_GET['del']) && $_GET['del']=='ztl_plugin_is_valid') {
			delete_transient('ztl_plugin_is_valid');
		}
		else if (!empty($_GET['del']) && $_GET['del'] == 'ztl_plugin_api_key') {
			delete_transient('ztl_plugin_api_key');
		}
	}
}
