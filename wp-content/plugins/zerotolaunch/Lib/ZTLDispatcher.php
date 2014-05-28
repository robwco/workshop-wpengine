<?php

/**
 * Class ZTLDispatcher provides a generic structure for classes to inherit from
 * that acts as an intermediary between the WordPress lifecycle and our controllers.
 * It's very similar to a router, but due to the connotations of that and that we don't
 * strictly fit the usual usage of a router, a different name was chosen.
 */
abstract class ZTLDispatcher {
	protected $input;

	/**
	 * Shorthand function for instantiating the class and calling setup on it.
	 *
	 * @param ZTLInput $input
	 * @return mixed An instance of the class with setup already called.
	 */
	public static function register($input) {
		$class = get_called_class();
		$dispatcher = new $class($input);
		$dispatcher->setup();

		return $dispatcher;
	}

	/**
	 * This should take care of any class-related setup, but WP hooks should normally be
	 * placed in the setup method.
	 *
	 * @param ZTLInput $input
	 */
	public function __construct($input) {
		$this->input = $input;
	}

	/**
	 * Whenever possible, hooking into WordPress should be performed in the setup
	 * method, rather than the constructor, to allow more flexibility in when
	 * and how the dispatcher is configured.
	 */
	public function setup() {}
}