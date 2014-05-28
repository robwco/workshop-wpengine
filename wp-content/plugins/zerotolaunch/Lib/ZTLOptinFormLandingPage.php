<?php

require_once ZTL_PLUGIN_PATH . 'Lib/ZTLDispatcher.php';

/**
 * Class ZTLOptinFormLandingPage handles the rendering of the optin form on a landing page.
 * Theme support is handled by the ZTLThemeManager.
 */
class ZTLOptinFormLandingPage extends ZTLDispatcher {
	public function setup() {
		add_filter('the_content', array(&$this, 'prepareLandingPage'));
	}

	public function prepareLandingPage() {
		$post = get_post();
		if (is_single($post) && $post->post_type == 'ztl_landing_page') {
			$chosenOptinFormID = get_post_meta($post->ID, '_ztl_optin_form_id', true);
			if (!empty($chosenOptinFormID)) {
				$optinForm = ZTLPluginOptinForm::find('first', array('conditions' => array('id = ' . $chosenOptinFormID)));

				if (!empty($optinForm)) {
					require_once ZTL_PLUGIN_PATH . 'Lib/ZTLOptinFormRenderer.php';
					$renderer = new ZTLOptinFormRenderer();
					$optinFormHtml = $renderer->render($optinForm, array('editing' => false, 'source' => 'landing-page', 'landingPageID' => $post->ID));


					$js = '<script type="text/javascript">
                                var slug = "' . $optinForm->slug . '";
                                var landingOptinFormID = ' . $optinForm->id . ';
                                var landingPageID = ' . $post->ID . ';
                                jQuery(document).ready(function(){
                                    jQuery.get("?logView="+slug+"&id="+landingOptinFormID+"&type=landing&landingPageID="+landingPageID);
                                });
                            </script>';

					$output = $post->post_content . $optinFormHtml . $js;
					return $output;
				}
			}
		}

		return $post->post_content;
	}
}