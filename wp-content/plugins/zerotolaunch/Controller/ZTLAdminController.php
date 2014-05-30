<?php

require_once 'ZTLAppController.php';

if (!class_exists('ZTLAdminController')) {
	abstract class ZTLAdminController extends ZTLAppController {
		/**
		 * Calls the appropriate method based upon the "action" query string, but
		 * prior to the page being loaded. The reason for separating this from
		 * the dispatchAction is that dispatch occurs after output to the browser has begun,
		 * so we can't redirect or set other headers from it. Because of that, any logic
		 * that might result in a redirect needs to be performed in a "pre_$action" function.
		 *
		 * While I toyed around with passing the results of the pre-function to the do function,
		 * I felt that using instnace variables would be clearer and more flexible, so variables
		 * can be passed between pre and do blocks using instance variables.
		 *
		 * Rendering logic should go in the "do_$action" function.
		 *
		 * Pre-actions are entirely optional. If one is not defined, nothing is called.
		 */
		public function dispatchPreAction() {
			$action = 'pre' . $this->getAdminActionName();

			if (method_exists($this, $action)) {
				$this->$action();
			}
		}

		/**
		 *
		 * Calls the appropriate method based upon the "action" query string.
		 * The called method name format is "do$action". For example,
		 * an action of "new" would call the method "doNew".
		 *
		 * If an action is not provided and a method called "doIndex" exists,
		 * "doIndex" is called.
		 *
		 * If no action is provided and "doIndex" does not exist, then die with page not found.
		 *
		 * Due to when the dispatchAction is called, we can't redirect or otherwise modify the header,
		 * so any redirects need to occur in a pre function.
		 *
		 * TODO should this be $_REQUEST instead of $_GET?
		 * TODO having the controller be responsible for dispatching itself feels like a bit of mixed concerns,
		 *      so it might make sense to extract to a admin router or dispatcher class that would then call
		 *      the admin controller methods.
		 */
		public function dispatchAction() {
			$action = 'do' . $this->getAdminActionName();

			if (method_exists($this, $action)) {
				$this->$action();
			} elseif (method_exists($this, 'doIndex')) {
				$this->doIndex();
			} else {
				wp_die('The page you requested could not be found');
			}
		}

		/**
		 * Returns a URL for the specified admin page, or the current page if not provided.
		 *
		 * @param null $pageName An optional string page name to override the current page name.
		 * @return string A URL to the specified admin page.
		 */
		public function adminPageUrl($pageName = null) {
			if (empty($pageName)) {
				$pageName = $this->input->get['page'];
			}

			return admin_url('admin.php') . '?page=' . $pageName;
		}

		/**
		 * Create an HTML fragment of pagination links for an admin page.
		 *
		 * @param $totalPages Integer The total number of pages
		 * @param array $queryArgs Any query args to include. The current admin page is included by default.
		 * @return array|string A raw HTML fragment of pagination linkss
		 */
		public function adminPaginateLinks($totalPages, $queryArgs = array()) {
			$defaultQueryArgs = array(
				'page' => $this->input->get['page'],
				'paged' => '%#%'
			);

			return paginate_links(array(
				'base' => add_query_arg(array_merge($defaultQueryArgs, $queryArgs)),
				'format' => '',
				'current' => max(1, isset($this->input->get['paged']) ? $this->input->get['paged'] : 0),
				'total' => $totalPages,
				'prev_text' => '&laquo; Prev',
				'next_text' => 'Next &raquo;',
			));
		}

		protected function setupViewHelpers() {
			parent::setupViewHelpers();

			$this->view->addFunction('model_nonce_field', array(&$this, 'modelNonceField'));

			$this->view->addFunction('model_nonce_url', array(&$this, 'modelNonceUrl'));

			$this->view->addFunction('current_page_url', array(&$this, 'adminPageUrl'));
		}

		// Helper to simplify adding a field nonce for an PHPActiveRecord model.
		public function modelNonceField($model, $action = 'update') {
			return wp_nonce_field($this->modelNonceAction($model, $action));

		}

		// Helper to simplify adding a URL nonce for an PHPActiveRecord model.
		public function modelNonceUrl($model, $action = 'update') {
			return wp_nonce_url($this->adminPageUrl(), $this->modelNonceAction($model, $action));
		}

		/**
		 * For consistency with setting and confirming nonces for PHPActiveRecord, it generates a string
		 * that can be passed to a WP nonce function.
		 *
		 * @param ActiveRecord\Model $model
		 * @param String $action The name of the action being performed.
		 *        Defaults to create if the model is not persisted.
		 * @return String A nonce-able string for the model.
		 */
		protected function modelNonceAction($model, $action) {
			return get_class($model) . '-' . ($model->id ? $action . '-' . $model->id : 'create');
		}

		protected function getAdminActionName() {
			return isset($this->input->get['action']) ? ucfirst($this->input->get['action']) : null;
		}
		
		protected function getUserData() {
			$userJsonData =get_transient('ztl_plugin_user_data');
			
			$user = array();
			if (!empty($userJsonData)) {
				$user = json_decode($userJsonData, true);			
			}
			return $user;			
		}
	}
}
