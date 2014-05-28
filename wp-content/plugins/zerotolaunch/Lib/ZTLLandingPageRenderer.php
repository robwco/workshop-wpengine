<?php

require_once ZTL_PLUGIN_PATH . 'Lib/ZTLTwigView.php';

class ZTLLandingPageRenderer {
	protected $view;

	public function __construct() {
		$this->view = new ZTLTwigView('themes/landing-pages');

		// only use the specified default if we're in edit mode ($editing == true)
		$this->view->addFilter('editor_default', function($value, $default, $editing = true) {
			if ($editing && twig_test_empty($value)) {
				return $default;
			}

			return $value;
		});

        $this->view->addFunction('render_optin_form', array(&$this, 'renderOptinForm'));
	}

    public function renderOptinForm($optinForm, $landingPageID = null, $mode = 'view', $source = 'landing_page') {   	
        $renderer = new ZTLOptinFormRenderer();

        return $renderer->render($optinForm, array(
        			'editing' => $mode == 'editing', 
        			'source' => $source,
        			'landingPageID' => $landingPageID
				));
    }

	public function render($landingPage, $options = array()) {

        $params = array(
            'landingPage' => $landingPage,
            'editing' => false,
            'theme' => $landingPage->theme);


		if (is_array($options)) {
			$params = array_merge($params, $options);
		}

		if (!file_exists($this->getThemeFolderPath($params['theme']))) {
			$availableThemes = ZTLPluginLandingPage::availableThemes();
			$params['theme'] = $availableThemes[0];
		}

		$htmlOutput = $this->view->render(
			$this->getThemeFolderName($params['theme']) . DIRECTORY_SEPARATOR . 'landing-page.twig',
			$params
		);

		return $htmlOutput;
	}

	protected function getThemeFolderPath($themeName, $file = null) {
		return ZTL_PLUGIN_PATH . 'themes/landing-pages/' . $this->getThemeFolderName($themeName) . "/$file";
	}

	// While usually safe and will be mangled with additional input,
	// just to be safe we remote non-whitelisted characters from the theme name
	// to get the name of the folder.
	protected function getThemeFolderName($themeName) {
		return preg_replace('/[^-_a-zA-Z0-9.]/', '', $themeName);
	}
}