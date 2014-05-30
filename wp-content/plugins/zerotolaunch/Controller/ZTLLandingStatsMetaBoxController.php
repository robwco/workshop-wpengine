<?php
require_once 'ZTLMetaBoxController.php';

class ZTLLandingStatsMetaBoxController extends ZTLMetaBoxController {
	public static function register($ztlInput) {
		$metaBoxController = new ZTLLandingStatsMetaBoxController($ztlInput);

		add_meta_box(
			'ztl-landing-stats-meta-box-optin-form-selector',
			'ZTL Landing Page Statistics',
			array($metaBoxController, 'statsBox'),
			'ztl_landing_page',
			'advanced',
			'high'
		);

		return $metaBoxController;
	}

	/**
	 * Creates a metabox for selecting which optin form will be displayed on the landing page.
	 */
	public function statsBox($landingPage) {		
		$landingPage->ID;

		$viewCount = 0;
		$viewActivity = ZTLPluginActivity::find('first' , array(
			'conditions' => "landing_page_id = ".$landingPage->ID." AND 
								category = 'View'"
			));			
		if ($viewActivity->hits > 0) {
			$viewCount = $viewActivity->hits;
		}		
		
		$conversionActivity = ZTLPluginActivity::find('first' , array(
			'conditions' => "landing_page_id = ".$landingPage->ID." AND 
								category = 'Conversion'"
			));				
		$optinCount = 0;
		if ($conversionActivity->hits > 0) {
			$optinCount = $conversionActivity->hits;
		}
		
		if ($viewCount > 0) {
			$conversionRateText = number_format($optinCount/$viewCount * 100, 2)."%";
		}
		else {
			$conversionRateText = "0.00%";
		}
		
		
		echo $this->view->render('admin/meta_boxes/stats_box.twig', compact('viewCount', 'optinCount', 'conversionRateText'));
	}
}
