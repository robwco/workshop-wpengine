<?php

require_once 'ZTLAdmin.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminLoginController.php';

class ZTLAdminLogin extends ZTLAdmin {
	public function addMenu() {
		$loginController = new ZTLAdminLoginController($this->input);

		add_menu_page(
			'Zero To Launch',
			'Zero To Launch',
			'manage_options',
			'ztl-dashboard',
			array(&$loginController, 'doIndex'),
			plugins_url('assets/images/icon.png', dirname(__FILE__))
		);
	}

	public function addScripts() {
		parent::addScripts();

		wp_enqueue_style(
			'core-ztl', plugins_url('/assets/css/login.css', dirname(__FILE__)));
	}
}