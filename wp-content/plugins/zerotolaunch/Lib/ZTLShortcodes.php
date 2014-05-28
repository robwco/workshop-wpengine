<?php

require_once 'ZTLDispatcher.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLShortcodeController.php';

class ZTLShortcodes extends ZTLDispatcher {
	public function processRequest() {
		$shortCode = new ZTLShortcodeController($this->input);

		//process the post data from the shortcode with a slug
		if (!empty($_POST['ztl-plugin-slug'])) {
			$shortCode->postOptinForm();
		}

		if (!empty($_GET['logView'])) {
			$slug = $_GET['logView'];
			$id = $_GET['id'];
			$type = $_GET['type'];

			if (!empty($slug) && !empty($id)) {
				$options = array();
				$options['slug'] = $slug;
				$options['type'] = $type;
				$options['id'] = $id;

				if ($type == 'landing_page' && !empty($_GET['landingPageID'])) {
					$options['landingPageID'] = $_GET['landingPageID'];
				}

				$shortCode->logView($options);
			}
		}
	}

	public function display($atts = array()) {
		try {
			if (!empty($atts['slug'])) {
				$shortCode = new ZTLShortcodeController($this->input);
				return $shortCode->htmlOptinForm($atts['slug']);
			}
		} catch (Exception $e) {
		}
	}

	public function displayEmpty($atts = array()) {
		//do nothing
	}
}
