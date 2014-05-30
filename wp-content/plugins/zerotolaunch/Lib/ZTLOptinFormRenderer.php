<?php

require_once ZTL_PLUGIN_PATH . 'Lib/ZTLTwigView.php';

class ZTLOptinFormRenderer {
	protected $view;

	public function __construct() {
		$this->view = new ZTLTwigView('themes/optin-forms');

		// only use the specified default if we're in edit mode ($editing == true)
		$this->view->addFilter('editor_default', function($value, $default, $editing = true) {
			if ($editing && twig_test_empty($value)) {
				return $default;
			}

			return $value;
		});
		
		$this->view->addFilter('placeholder_url', function($value) {
			if (twig_test_empty($value)) {
				$url = plugins_url('assets/images/placeholder_240x160.png' , dirname(__FILE__ ));
				return $url;
			}

			return $value;
		});		
	}

	public function render($optinForm, $options = array()) {
		$uniqueId = $this->getUniqueId($optinForm);

		$params = array(
			'optin_form' => $optinForm,
			'editing' => false,
			'unique_id' => $uniqueId,
			'theme' => $optinForm->theme);

		if (is_array($options)) {
			$params = array_merge($params, $options);
		}

		if (!file_exists($this->getThemeFolderPath($params['theme']))) {
			$availableThemes = ZTLPluginOptinForm::availableThemes();
			$params['theme'] = $availableThemes[0];
		}
		
		if (!empty($params['ajaxData'])) {
			//var_dump('!empty($params[\'ajaxData\']');
			$params['data'] = $params['ajaxData'];
		}
		else {
			$optinForm = $params['optin_form'];
			
			$data = array();
			$data['ZTLPluginOptinForm']['id'] = $optinForm->id;
			$data['ZTLPluginOptinForm']['mailing_list_id'] = $optinForm->mailing_list_id;
			$data['ZTLPluginOptinForm']['name'] = $optinForm->name;
			$data['ZTLPluginOptinForm']['slug'] = $optinForm->slug;
			$data['ZTLPluginOptinForm']['headline'] = $optinForm->headline;
			$data['ZTLPluginOptinForm']['sub_headline'] = $optinForm->sub_headline;
			$data['ZTLPluginOptinForm']['name_field_text'] = $optinForm->name_field_text;
			$data['ZTLPluginOptinForm']['email_field_text'] = $optinForm->email_field_text;
			$data['ZTLPluginOptinForm']['c2a_button_text'] = $optinForm->c2a_button_text;
			$data['ZTLPluginOptinForm']['body'] = $optinForm->body;
			$data['ZTLPluginOptinForm']['description'] = $optinForm->description;
			$data['ZTLPluginOptinForm']['redirect_url'] = $optinForm->redirect_url;
			$data['ZTLPluginOptinForm']['display_image'] = $optinForm->display_image;
			$data['ZTLPluginOptinForm']['display_name_field'] = $optinForm->display_name_field;
			$data['ZTLPluginOptinForm']['image_url'] = $optinForm->image_url;
			$data['ZTLPluginOptinForm']['image_alt'] = $optinForm->image_alt;
			$data['ZTLPluginOptinForm']['image_width'] = $optinForm->image_width;
			$data['ZTLPluginOptinForm']['image_height'] = $optinForm->image_height;
			$data['ZTLPluginOptinForm']['theme'] = $optinForm->theme;
			
			if (!empty($options['ZTLPluginOptinForm']['landingPageID'])) {
				$params['landingPageID'] = $options['ZTLPluginOptinForm']['landingPageID'];
			}
			
			$params['data'] = $data;
		}
	
		// var_dump('ZTLOptinFormRenderer::render()');
		// var_dump($params['data']);
			
		$htmlOutput = $this->view->render(
			$this->getThemeFolderName($params['theme']) . DIRECTORY_SEPARATOR . 'optin.twig',
			$params
		);

		// unfortunately when we run it's usually too late to properly enqueue styles,
		// so we output the styles with the optin form.
		$cssOutput = $this->getThemeCSS($params['theme'], $uniqueId);

		return $htmlOutput . $cssOutput;
	}

	protected function getThemeCSS($themeFolderName, $optinFormId) {
		$styleFilePath = ZTL_PLUGIN_PATH . "themes/optin-forms/$themeFolderName/styles.css";

		if (file_exists($styleFilePath)) {
			$styles = file_get_contents($styleFilePath);

			// We need to customize the object ID (or if we switch to classes only, then the class
			// so multiple forms on one page don't overwrite each other's styles.
			$styles = str_replace('#ztl-optin-form', "#$optinFormId", $styles);

			return '<style type="text/css">' . $styles.'</style>';
		}
	}

	protected function getThemeFolderPath($themeName, $file = null) {
		return ZTL_PLUGIN_PATH . 'themes/optin-forms/' . $this->getThemeFolderName($themeName) . "/$file";
	}

	// While usually safe and will be mangled with additional input,
	// just to be safe we remote non-whitelisted characters from the theme name
	// to get the name of the folder.
	protected function getThemeFolderName($themeName) {
		return preg_replace('/[^-_a-zA-Z0-9.]/', '', $themeName);
	}

	protected function getUniqueId($optinForm) {
		$optinFormSlug = !empty($optinForm->slug) ? $optinForm->slug : $optinFormSlug = 'new';

		// While not guaranteed to be unique, it's unlikely that we'll have a collision.
		return 'ztl-optin-form-' . $optinFormSlug. '-' . str_replace('.', '-', microtime(true));
	}
}