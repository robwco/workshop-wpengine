<?php

if (!class_exists('ZTLInput')) {
	/**
	 * Class ZTLInput WordPress automatically adds magic quotes to all input, which
	 * ActiveRecord doesn't need since it uses placeholders, so this contains
	 * stripped slashes versions of the $_GET, $_POST, and $_REQUEST arrays.
	 */
	class ZTLInput {
		public $get;
		public $post;
		public $request;


		public function __construct() {
			$this->get = stripslashes_deep($_GET);
			$this->post = stripslashes_deep($_POST);
			$this->request = stripslashes_deep($_REQUEST);
		}
	}
}