<?php

require_once ZTL_PLUGIN_PATH . 'Vendor/Twig/lib/Twig/Autoloader.php';

/**
 * Class ZTLTwigView
 *
 * Provides a wrapper for rendering Twig templates within the plugin using. Currently hardcoded
 * to use the zerotolaunch/View directory for templates.
 *
 */

if (!class_exists('ZTLTwigView')) {
	class ZTLTwigView {
		private $loader;
		private $twig;

		public function __construct($viewPath = 'View') {
			Twig_Autoloader::register();

			$this->loader = new Twig_Loader_Filesystem(array(ZTL_PLUGIN_PATH . $viewPath));

			$this->twig = new Twig_Environment($this->loader, array(
				//todo: enable caching when live
				// 'cache' => get_temp_dir() . 'ztl_cache',
				'debug' => WP_DEBUG
			));
			
			$this->twig->addExtension(new Twig_Extension_Debug());
			
		}

		/**
		 * Render a template with the provided parameters.
		 *
		 * In addition to the supplied variables, templates also have access to normal Twig
		 * helpers and any functions listed in $env_functions. Additional functions may be added
		 * by calling the add_function() method.
		 *
		 * @param String $templateName The path to the template (relative to the View dir) to render.
		 * @param null|array $params An associative array of parameters to pass to the template.
		 * @return string The rendered template.
		 */
		public function render($templateName, $params = null) {
			if (!is_array($params)) {
				$params = array();
			}
			
			return $this->twig->render($templateName, $params);
		}

		/**
		 * Add the specified function to the Twig environment with the given name.
		 * If a function is not supplied or not callable, the name is treated as the function.
		 *
		 * TODO allow for trusted functions so that raw is not needed in the template.
		 *
		 * @param String $name The name to expose the function as to Twig templates.
		 * @param null|callable $function The function to add to the Twig environment.
		 *                                If null, the $name will be used for the function name.
		 */
		public function addFunction($name, $function = null) {
			$this->twig->addFunction(new Twig_SimpleFunction(
				$name,
				empty($function) ? $name : $function)
			);
		}

		public function addFilter($name, $function = null) {
			$this->twig->addFilter(new Twig_SimpleFilter(
					$name,
					empty($function) ? $name : $function)
			);
		}
	}
}