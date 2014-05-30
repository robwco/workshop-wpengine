<?php

require_once 'ZTLDispatcher.php';

class ZTLSkus extends ZTLDispatcher {
	public function setup() {
		//parse any gumroad payment
		$urlArr = explode('gumroad/', $_SERVER['REQUEST_URI']);
		if (!empty($urlArr[1])) {
			ZTLSkuController::webhook($urlArr[1]);
		}
	}
}