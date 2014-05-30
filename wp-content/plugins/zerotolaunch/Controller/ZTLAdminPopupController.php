<?php

require_once 'ZTLAdminController.php';
require_once(plugin_dir_path(__FILE__) . '../Model/ZTLPluginPopups.php');
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLMailChimpAPI.php';

if (!class_exists('ZTLAdminPopupController')) {
	class ZTLAdminPopupController extends ZTLAdminController {
		protected $popup;
		var $params;

		public function doIndex() {
			$popupStatus = isset($_GET['status']) ? $_GET['status'] : 'all';

			// TODO make per page a reasonable value and centralize it. Perhaps we could use screen options
			//      to allow the user to set this like they can per-page for posts?
			//      cf http://codex.wordpress.org/Function_Reference/add_screen_option
			$perPage = 10;
			$offset = $perPage * (isset($_GET['paged']) ? intval($_GET['paged']) - 1 : 0);

			// TODO look at generalizing pagination so that it can be re-used and we can cleanup this controller.
			$conditions = array();

			if ($popupStatus != 'all') {
				$conditions['status'] = $popupStatus;
			}

			$popup = ZTLPluginPopups::find('all', array(
				'conditions' => $conditions,
				'limit' => $perPage,
				'offset' => $offset
			));
			//OptIn Forms pull for dropdown
			$optin_forms = ZTLPluginOptinForm::find('all');

			$statusCounts = ZTLPluginPopups::status_counts();

			if (isset($statusCounts[$popupStatus])) {
				$currentStatusCount = $statusCounts[$popupStatus];
			} else {
				$currentStatusCount = 0;
			}

			$totalPages = ceil($currentStatusCount / $perPage);

			//Current Popup activity
			$currentPopupActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => array('date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '" AND type = ?' , array('popup'))
				));
			//Previous weeks popup activity
			$prevPopupActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => array('date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 14 DAY) AND DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY)' , array('popup'))
				));

			$params = array(
				'popups' => $popup,
				'popup_activity' => $currentPopupActivity,
				'prev_popup_activity' => $prevPopupActivity,
				'status_counts' => $statusCounts,
				'popup_status' => $popupStatus,
				'miniview_image' => plugins_url('/assets/images/cat.jpg', dirname(__FILE__)),
				'optin_forms' => $optin_forms,
				'pagination' => $this->adminPaginateLinks($totalPages, array('status' => $popupStatus))
			);

			echo $this->view->render('admin/popups/index.twig',
										array_merge(
											$params, 
											array('user'=>$this->getUserData())
										));
		}

		public function doNew() {
			$this->popup = new ZTLPluginPopups();
			$this->popup->status = 'publish';
			
			echo $this->view->render(
				'admin/popups/edit.twig',
				$this->editRenderParameters()
			);
		}

		public function doEdit() {
			try {
				$this->popup = ZTLPluginPopups::find($this->input->get['id']);
			} catch (ActiveRecord\RecordNotFound $e) {
				// TODO add flash message?
				wp_redirect($this->adminPageUrl());
				exit;
			}
			//'lists' => $lists,

			echo $this->view->render(
				'admin/popups/edit.twig',
				array_merge($this->editRenderParameters())
			);
		}

		public function preSave() {
			if (!empty($this->input->post['popup']['id'])) {
				// handling an update
				try {
					$this->popup = ZTLPluginPopups::find($this->input->post['popup']['id']);
				} catch (ActiveRecord\RecordNotFound $e) {
					// TODO add flash message?
					wp_redirect($this->adminPageUrl());
					exit;
				}
			} else {
				// handling a create
				$this->popup = new ZTLPluginPopups();
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				check_admin_referer($this->modelNonceAction($this->popup, 'update'));
				$popupAttributes = $this->input->post['popup'];
				// var_dump($popupAttributes['display_location']);
				// die();

				// TODO switch to actual join table for page ids.
				if (!empty($this->input->post['popup']['valid_page_ids']) && is_array($this->input->post['popup']['valid_page_ids'])) {
					$popupAttributes['valid_page_ids'] = join(",", $this->input->post['popup']['valid_page_ids']);
				}

				$this->popup->update_attributes($popupAttributes);

				// I would normally redirect rather than render if the save was successful,
				// but it seems the current preference is to simply render, so going with that.
				// Setting up rendering is handled in the doSave() function;
			}
		}

		// The actual saving is called in the preSave method, but the rendering here.
		public function doSave() {
			if (empty($this->params)) {
				$this->params = $this->editRenderParameters();
			}
			echo $this->view->render(
				'admin/popups/edit.twig',
				$this->params
			);


		}

		public function doConfirmDelete() {
			try {
				$this->popup = ZTLPluginPopups::find($this->input->post['id']);
			} catch (ActiveRecord\RecordNotFound $e) {
				// No need to confirm the deletion of a non-existant record
				wp_redirect($this->adminPageUrl());
				exit;
			}

			check_admin_referer($this->modelNonceAction($this->popup, 'delete'));

			echo $this->view->render(
				'admin/popups/confirm_delete.twig',
				array('optin_form' => $this->popup));
		}

		public function preDelete() {
			if (empty($this->input->post['id'])) {
				wp_redirect($this->adminPageUrl());
				exit;
			}

			try {
				$this->popup = ZTLPluginPopups::find($this->input->post['id']);

				check_admin_referer($this->modelNonceAction($this->popup, 'delete'));

				$this->popup->delete();
			} catch (ActiveRecord\RecordNotFound $e) {
				// Do nothing here since the original intent was to delete the optin form anyway.
			}

			// TODO add flash message?
			wp_redirect($this->adminPageUrl());
			exit;
		}
		
		protected function findExistingPages($id=null) {
			$output = array();
			if (!empty($id)) {
				$output = ZTLPluginPopups::find('all', array(
					'conditions' => array("id <> ? AND display_location = 'pages'", $id)));
			}
			else {
				$output = ZTLPluginPopups::find('all', array(
					'conditions' => array("display_location = 'pages'")));
			}
			$existingPageIDs = array();
			$existingPages = array();
			if (!empty($output)) {
				foreach ($output as $row) {
					$existingPageIDs[] = $row->valid_page_ids;
					$newRow = array();
					$newRow['id'] = $row->id;
					$newRow['name'] = $row->name;
					
					$existingPages[$row->valid_page_ids] = $newRow;
				}
			}
			
			return compact('existingPages', 'existingPageIDs');
		}
		
		protected function findExistingPopups($id=null) {
			if (!empty($id)) {
				$otherPopups = ZTLPluginPopups::find('all', array('conditions' => array('id <> ?', $id)));
			}
			else {
				$otherPopups = ZTLPluginPopups::find('all');
			}
			
			$existingPopups = array();
			$existingPopupNames = array();			

			if (!empty($otherPopups)) {
				foreach ($otherPopups as $otherPopup) {
					$newRow = array();
					$newRow['id'] = $otherPopup->id;
					$newRow['name'] = $otherPopup->name;
					$existingPopups[$otherPopup->display_location] = $newRow;
					
					$existingPopupNames[] = $otherPopup->display_location;
				}
			}		
			
			return compact('existingPopupNames', 'existingPopups');				
		}
		protected function editRenderParameters($params = null) {
			$validPageIds = $this->popup->valid_page_ids ? explode(',', $this->popup->valid_page_ids) : array();

			$mailchimpAdapter = ZTLPluginAdapters::find(array('conditions'=>"name = 'MailChimp'"));
			$apiKey = $mailchimpAdapter->api_key;
			$mailchimp = new ZTLMailChimpAPI($apiKey);
			$lists = array();
			$errors = array();
			$success_message = '';

			if ($_GET['action'] == 'save') {
				$success_message = 'Your Lightbox has been saved.';
			} else {
				$success_message = '';
			}

			if ($mailchimp->isApiValid($apiKey)) {
				$lists = $mailchimp->getAllLists();
			} else {
				$errors[]= 'Warning: Invalid Mailchimp API key or missing.';
			}

			$currentPopupActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => 'date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '"'
				));
			$prevOptinPopupActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => 'date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 14 DAY) AND DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY)'
				));

			// TODO do we need to support posts AND pages, or just pages? Currently only pages is supported.
			$default = array(
				'popup_activity' => $currentPopupActivity,
				'prev_popup_activity' => $prevOptinPopupActivity,
				'popup' => $this->popup,
				'lists' => $lists,
				'posts' => get_pages(),
				'optin_forms' => ZTLPluginOptinForm::find('all'),
				'postpage' => get_option('page_for_posts'),
				'frontpage' => get_option('page_on_front'),
				'valid_page_ids' => $validPageIds,
				'user'=>$this->getUserData(),
				'success_message' => $success_message
			);
			
			$existingPopups = $this->findExistingPopups($this->popup->id);
			extract($existingPopups);
			
			$existingPages = $this->findExistingPages($this->popup->id);
			extract($existingPages);

			if (is_array($params)) {
				$params = array_merge($params, compact('existingPopupNames', 'existingPopups', 'existingPages', 'existingPageIDs'));
				return array_merge($default, $params);
			} else {
				$default = array_merge($default, compact('existingPopupNames', 'existingPopups', 'existingPages', 'existingPageIDs'));
				return $default;
			}
		}
		
		static function render_popup_ajax() {
			$optinForm = ZTLPluginOptinForm::find('first', array('conditions' => array(
				'id = ' .$_GET['id']
			)));

			if (!empty($optinForm)) {
				$renderer = new ZTLOptinFormRenderer();
				$optinFormHtml = $renderer->render($optinForm, array('editing' => false, 'source' => 'admin-popup-preview', 'mode' => 'popup'));
				echo '<style type="text/css">
						#ztl-plugin-popup {
							padding: 0px;
						}
					</style>
					<div>' . $optinFormHtml . '</div>
					';
			}
							
			exit;
		}
	}
}
