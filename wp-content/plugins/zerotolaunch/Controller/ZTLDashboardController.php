<?php

require_once 'ZTLAdminController.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLMailChimpAPI.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLSkuController.php';

if (!class_exists('ZTLDashboardController')) {
	class ZTLDashboardController extends ZTLAdminController {
		function withLoginOnly() {
			echo $this->view->render('admin/dashboard/login.twig');
		}

		function index() {
			global $wpdb;

      		$checklist = ZTLPluginStatus::getPluginChecklist();

			//Get total traffic from posts/pages
			$totalViewsQuery = $wpdb->get_results('SELECT meta_value
				FROM wp_postmeta
	            WHERE meta_key = "count_page_hits"
				ORDER BY CONVERT(meta_value, UNSIGNED INTEGER)');

			$totalViewCount = 0;
			foreach ($totalViewsQuery as $totals) {
				$totalViewCount += intval($totals->meta_value);
			}

			//Get Total Optins THIS WEEK
			$optinFormsActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => 'date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '"'
				));

			//Popular Optins THIS WEEK
			$popularOptinsQuery = ZTLPluginActivity::find('all' , array(
				'conditions' => array('date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '" AND category = ?' , array('Conversion')),
				'limit' => 3,
				'order' => 'hits desc'
				));

			
			//Get three most visited POST/PAGES
			$mostViewedQuery = $wpdb->get_results('SELECT ID, post_id , post_title , meta_value
				FROM wp_posts
				INNER JOIN  wp_postmeta
	            	ON ID = post_id
	            WHERE meta_key = "count_page_hits"
				ORDER BY CONVERT(meta_value, UNSIGNED INTEGER) DESC LIMIT 3');

            // Get all the optin Forms
            $optinForms = ZTLPluginOptinForm::find('all');

			$params2 = array(
				'optin_forms' => $optinForms ,
				'popular_optins' => $popularOptinsQuery,
				'optin_form_activity' => $optinFormsActivity,
				'total_hits' => $totalViewCount,
				'topPosts' => $mostViewedQuery,
				'landing_page_enabled' => ZTL_ENABLE_LANDING_PAGES
				);

			$values = array_merge($checklist , $params2);
			$user = $this->getUserData();
			
			if (!empty($_POST)) {
				if (!empty($_POST['loginToIWTSFrom']) && $_POST['loginToIWTSFrom'] == 'dashboard') {
					$userEmail = trim($_POST['email']);
					$userPassword = $_POST['password'];
					
					$keyUrl = ZTL::$baseUrl."/zero_to_launch/get_key/".$userEmail."/".$userPassword;
					$key = file_get_contents($keyUrl);
					
					$isActiveUrl = ZTL::$baseUrl."/zero_to_launch/api/".$key;
					$result = file_get_contents($isActiveUrl);
					$resultJson = json_decode($result, true);
					
					$emailHash = array();
					$message = array();
					
					if (!empty($resultJson)) {
						if ($resultJson['result']=='error') {
							$message['type'] = 'error';
							$message['text'] = 'Login failed, please try again.';
						}
						elseif ($resultJson['result']=='success') {
							$message['type'] = 'success';
							$message['text'] = 'You have successfully connected with IWTStudents '.$resultJson['User']['first_name'].' '.$resultJson['User']['last_name'];						
						}
					}

					echo $this->view->render(
							'admin/dashboard/dashboard.twig', array_merge(compact('message', 'user') , $values));
				}
			} else {
				echo $this->view->render('admin/dashboard/dashboard.twig' , array_merge(compact('message', 'user') ,$values));
			}
		}
	}
}
