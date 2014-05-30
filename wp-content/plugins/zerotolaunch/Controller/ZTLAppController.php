<?php

require_once ZTL_PLUGIN_PATH . 'Lib/ZTLTwigView.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLOptinFormRenderer.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLLandingPageRenderer.php';

if (!class_exists('ZTLAppController')) {
	abstract class ZTLAppController {
		protected $view;
		protected $input;

		// Functions name listed here will be automatically added to the Twig environment.
		protected static $view_functions = array(
			'wp_nonce_url', 'wp_nonce_field', 'admin_url'
		);

		public function __construct($ztlInput) {
			$this->view = new ZTLTwigView();
			$this->input = $ztlInput;

			$this->setupViewEnvironment();
			$this->setupViewHelpers();
		}

		/**
		 * Renders a landing page for viewing or editing
		 * @param        $landingPage
		 * @param string $mode
		 * @param string $source
		 * @return string
		 */
		public function renderLandingPage($landingPage, $mode = 'view', $source = ''){
			$renderer = new ZTLLandingPageRenderer();

			return $renderer->render($landingPage, array('editing' => $mode == 'editing', 'source' => $source));
		}

		public function renderOptinForm($optinForm, $mode = 'view', $source = '') {
			$renderer = new ZTLOptinFormRenderer();

			return $renderer->render($optinForm, array('editing' => $mode == 'editing', 'source' => $source));
		}

		public function displayEditor( $content, $editor_id, $settings = array()){
			wp_editor($content, $editor_id, $settings);
		}

		protected function setupViewHelpers() {
			$this->view->addFunction('render_optin_form', array(&$this, 'renderOptinForm'));
			$this->view->addFunction('render_landing_page', array(&$this, 'renderLandingPage'));
			$this->view->addFunction('wp_editor', array(&$this, 'displayEditor'));
		}

		private function setupViewEnvironment() {
			foreach (self::$view_functions as $function_name) {
				$this->view->addFunction($function_name);
			}
		}
	}
}