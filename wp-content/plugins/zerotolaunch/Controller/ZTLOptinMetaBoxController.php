<?php

require_once 'ZTLMetaBoxController.php';

class ZTLOptinMetaBoxController extends ZTLMetaBoxController {
	public static function register($ztlInput) {
		$metaBoxController = new ZTLOptinMetaBoxController($ztlInput);

		add_meta_box(
			'ztl-optin-meta-box-optin-form-selector',
			'ZTL Optin Form Selector',
			array($metaBoxController, 'optinFormSelector'),
			'ztl_landing_page',
			'side'
		);

		add_action('save_post', array($metaBoxController, 'selectOptinForm'));

		return $metaBoxController;
	}

	/**
	 * Creates a metabox for selecting which optin form will be displayed on the landing page.
	 */
	public function optinFormSelector($landingPage) {
		$selectedID = get_post_meta($landingPage->ID, '_ztl_optin_form_id', true);

		$params = array(
			'optin_forms' => ZTLPluginOptinForm::find('all'),
			'selected_id' => $selectedID
		);

		echo $this->view->render('admin/meta_boxes/optin_form_selector.twig', $params);
	}

	/**
	 * Saves which optin form should be displayed on this landing page.
	 */
	public function selectOptinForm($landingPageId) {
		if (!$this->isSubmittalAllowed('ztl_meta_box_optin_form_selector', $landingPageId)) {
			return $landingPageId;
		}

		if (!empty($_POST['ztl-optin-form-id']) && ZTLPluginOptinForm::exists(intval($_POST['ztl-optin-form-id']))) {
			update_post_meta($landingPageId, '_ztl_optin_form_id', intval($_POST['ztl-optin-form-id']));
		} else {
			// empty or doesn't exist, so delete in case it was set
			delete_post_meta($landingPageId, '_ztl_optin_form_id');
		}
	}
}
