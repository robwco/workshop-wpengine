<?php

require_once 'ZTLMetaBoxController.php';

class ZTLThemeMetaBoxController extends ZTLMetaBoxController
{
	public static function register($ztlInput)
	{
		$metaBoxController = new ZTLThemeMetaBoxController($ztlInput);

		add_meta_box(
			'ztl-theme-meta-box-optin-form-selector',
			'ZTL Theme Selector',
			array($metaBoxController, 'themeSelector'),
			'ztl_landing_page',
			'side'
		);

		add_action('save_post', array($metaBoxController, 'selectTheme'));

		return $metaBoxController;
	}

	/**
	 * Creates a metabox for selecting which optin form will be displayed on the landing page.
	 */
	public function themeSelector($landingPage)
	{
		$selectedName = get_post_meta($landingPage->ID, '_ztl_theme_name', true);
		$folders = array();

		$availableThemes = wp_get_themes(array('allowed' => true));

		foreach ($availableThemes as $themeName => $theme) {
			$tags = $theme->get('Tags');

			if (in_array('zerotolaunch', $tags)) {
				$folders[]['name'] = $themeName;
			}
		}

		$params = array(
			'themes' => $folders,
			'selected_name' => $selectedName
		);

		echo $this->view->render('admin/meta_boxes/theme_selector.twig', $params);
	}

	/**
	 * Saves which optin form should be displayed on this landing page.
	 */
	public function selectTheme($landingPageId)
	{
		if (!$this->isSubmittalAllowed('ztl_theme_meta_box_optin_form_selector', $landingPageId)) {
			return $landingPageId;
		}

		if (!empty($_POST['ztl-theme-name'])) {
			update_post_meta($landingPageId, '_ztl_theme_name', $_POST['ztl-theme-name']);
		} else {
			// empty or doesn't exist, so delete in case it was set
			delete_post_meta($landingPageId, '_ztl_theme_name');
		}
	}
}
