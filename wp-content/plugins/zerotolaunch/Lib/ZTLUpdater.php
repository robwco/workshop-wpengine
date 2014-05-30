<?php

require_once ZTL_PLUGIN_PATH . 'Vendor/plugin-update-checker/plugin-update-checker.php';

class ZTLUpdater {
	private $updateChecker;

	function __construct() {
		$apiKey = get_transient('ztl_plugin_api_key');
		$url = ZTL::$baseUrl."/zero_to_launch/api/".$apiKey.'/ztl-updater';
		$this->updateChecker = PucFactory::buildUpdateChecker(
			$url,
			ZTL_PLUGIN_PATH . 'zerotolaunch.php',
			'zerotolaunch',
			5
		);
	}

	public function checkForUpdates() {
		$this->updateChecker->checkForUpdates();
	}

	public function addQueryArgs($query) {
		$query['api_key'] = $this->getApiKey();

		return $query;
	}

	private function getApiKey() {
		return get_option('_transient_ztl_plugin_api_key', 'unregistered');
	}
}
