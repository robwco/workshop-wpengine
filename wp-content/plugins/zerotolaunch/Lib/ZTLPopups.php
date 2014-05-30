<?php

require_once 'ZTLDispatcher.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLOptinFormRenderer.php';

class ZTLPopups  extends ZTLDispatcher {
	public function setup() {
		add_action('wp_enqueue_scripts', array(&$this, 'loadPopupScripts'));
		add_action('wp_footer', array(&$this, 'loadPopupHtml'));
	}

	public function loadPopupHtml() {
		wp_register_script(
			'ztl-plugin-load-popup-loader',
			plugins_url('/assets/js/popup-loader.js', dirname(__FILE__)),
			array('ztl-plugin-load-popup'),
			false,
			true
		);

		wp_enqueue_script('ztl-plugin-load-popup-loader');

		$renderer = new ZTLOptinFormRenderer();

		$popups = ZTLPluginPopups::find('all', array('conditions' => array(
			"status = 'publish'"
		)));
		
		//find which popup to display
		if (!empty($popups)) {
			$popupIdToDisplay = null;
			
			global $post;
			$postID = $post->ID;
						
			$popupIdsWithSpecificPages = array();
			$popupIdWithFrontPage = null;
			$popupIdWithBlogTop = null;
			$popupIdWithEveryWhere = null;
			
			//find popups with specific pages
			foreach ($popups as $popup) {
				if ($popup->display_location == 'pages') {
					$newRow = array();
					$newRow['id'] = $popup->id;
					$newRow['valid_page_ids'] = $popup->valid_page_ids;
					$popupIdsWithSpecificPages[] = $newRow;
				}
				elseif ($popup->display_location == 'frontpage') {
					$popupIdWithFrontPage = $popup->id;
				}
				elseif ($popup->display_location == 'blogtop') {
					$popupIdWithBlogTop = $popup->id;
				}
				elseif ($popup->display_location == 'everywhere') {
					$popupIdWithEveryWhere = $popup->id;
				}
			}
			//if specific matches with current page
			if (!empty($popupIdsWithSpecificPages)) {
				foreach ($popupIdsWithSpecificPages as $row) {
					if ($postID == $row['valid_page_ids']) {
						$popupIdToDisplay = $row['id'];
						break;
					}
				}
			}
			
			if (empty($popupIdToDisplay)) {
				if (!empty($popupIdWithFrontPage) && is_front_page()) {
					$popupIdToDisplay = $popupIdWithFrontPage;
				}
			}
			
			if (empty($popupIdToDisplay)) {
				if (!empty($popupIdWithBlogTop) && is_home()) {
					$popupIdToDisplay = $popupIdWithBlogTop;
				}
			}
			
			if (empty($popupIdToDisplay)) {
				if (!empty($popupIdWithEveryWhere)) {
					$popupIdToDisplay = $popupIdWithEveryWhere;
				}
			}

			if (!empty($popupIdToDisplay)) {
				
				$popup = ZTLPluginPopups::find('first', array('conditions'=>array('id = '.$popupIdToDisplay)));
				
				$optinForm = ZTLPluginOptinForm::find('first', array('conditions' => array(
					'id = ' .$popup->optin_form_id
				)));

				if (!empty($optinForm)) {
					$optinFormHtml = $renderer->render($optinForm, array('editing' => false, 'source' => 'popup', 'mode' => 'popup'));
					echo '<style type="text/css">
							#ztl-plugin-popup {
								padding: 0px;
							}
						</style>
						<div id="ztl-plugin-popup" style="display: none;">' . $optinFormHtml . '</div>
						<script type="text/javascript">
							var optinSettings = {
								time_to_popup: ' . $popup->time_to_popup . ',
								timeout_in_days: ' . $popup->timeout_in_days . ',
								page_delay: ' . $popup->page_delay . ',
								id: ' . $optinForm->id . ',
								slug: \'' . $optinForm->slug . '\'
							}
						</script>
						';
				}
			}
		}
	}

	public static function loadPopupScripts()
	{
		// 			// $popupCount = ZTLPluginPopups::count();
		// if ($popupCount > 0) {
		// 	$popups = ZTLPluginPopups::find('all', array('conditions'=>array(
		// 		"status = 'publish' AND display_everywhere = 1"
		// 	)));

		// 	if (count($popups) > 0) {
		// 		//load javascript

		// 	}
		// }

		//if the page is in $popups?
		wp_enqueue_style(
			'fancybox', plugins_url('/assets/js/fancy/jquery.fancybox.css', dirname(__FILE__)),
			array(), '2.1.5');

		wp_enqueue_script(
			'fancybox', plugins_url('/assets/js/fancy/jquery.fancybox.pack.js', dirname(__FILE__)),
			array(), '2.1.5', true);

		wp_register_script('ztl-plugin-load-popup',
			plugins_url('/assets/js/popup.js', dirname(__FILE__)), array('jquery'));

		wp_enqueue_script('ztl-plugin-load-popup');

		wp_register_script('ztl-plugin-optin-validation',
			plugins_url('/assets/js/optin-validation.js', dirname(__FILE__)), array('jquery'));

		wp_enqueue_script('ztl-plugin-optin-validation');
	}
}