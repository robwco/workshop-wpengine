<?php

require_once 'ZTLAdminController.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLPluginStatus.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLThemeManager.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLWLM.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLDB.php';

class ZTLAdminLoginController extends ZTLAdminController {
	public function doIndex() {
		if(!current_user_can('manage_options'))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		if (!empty($_POST)) {
			$isLoggedIn = false;

			if (!empty($_POST['loginToIWTSFrom']) && $_POST['loginToIWTSFrom']=='dashboard') {
				$userEmail = trim($_POST['email']);
				$userPassword = $_POST['password'];

				$keyUrl = ZTL::$baseUrl."/zero_to_launch/get_key/".$userEmail."/".$userPassword;
				$key = file_get_contents($keyUrl);

				$isActiveUrl = ZTL::$baseUrl."/zero_to_launch/api/".$key;
				$result = file_get_contents($isActiveUrl);
				$resultJson = json_decode($result, true);

				$emailHash = array();
				$user = array();
				$message = array();
				if (!empty($resultJson)) {
					if ($resultJson['result']=='error') {
						$message['type'] = 'error';
						$message['text'] = 'Login failed, please try again.';
						$isLoggedIn = true;
					}
					elseif ($resultJson['result'] == 'success') {
						set_transient('ztl_plugin_api_key', $key, 0);
						$message['type'] = 'success';
						$message['text'] = 'You have successfully connected with IWTStudents '.$resultJson['User']['first_name'].' '.$resultJson['User']['last_name'];

						$user['User'] = $resultJson['User'];
						$emailHash = md5($user['User']['email']);
						$isLoggedIn = false;

						$endpoint = 'update-domain';
						$postUrl = ZTL::$baseUrl."/zero_to_launch/api/".$key."/".$endpoint;

						$siteUrl = get_option('siteurl');
						$parsed = parse_url($siteUrl);
						//save the user info with today's date
						$userData = array();
						$userData['email'] = $user['User']['email'];
						$userData['email_hash'] = md5(strtolower(trim($user['User']['email'])));
						$userData['first_name'] = $user['User']['first_name'];
						$userData['last_name'] = $user['User']['last_name'];
						$userData['last_logged_in'] = date('c');
						$jsonData = json_encode($userData);
						set_transient('ztl_plugin_user_data', $jsonData, 0);

						$installStatus = get_option ('ztl_first_install');

						if ($installStatus != 'true') {

							switch_theme( 'theme-fitness' );
						}


						add_option('ztl_first_install', 'true' , -1);


						ZTLWLM::setWLMLicenseKeyIfMissing($userEmail, $resultJson['wlm_key']);
						ZTLPluginStatus::saveSiteDomainForPostUrl($postUrl, $parsed['host']);
					}
				}
			}
		}

		echo $this->view->render('admin/dashboard/login.twig', compact('message'));
	}
}
