<?php

if (!class_exists('ZTLPluginOptinForm')) {
	define('ZTL_OPTIN_FORM_TABLE', ZTL_TABLE_PREFIX . 'optin_forms');

	class ZTLPluginOptinForm extends ActiveRecord\Model {
		static $table_name = ZTL_OPTIN_FORM_TABLE;

		static $attr_protected = array('id');

		static $validates_presence_of = array(
			array('name', 'message'=>"'Opt-in Form Name' is blank. Please enter the Opt-in Form Name"),
			array('headline'),
			array('c2a_button_text'),
			array('body')
		);

		static $validates_uniqueness_of = array(
			array('name')
		);

		//static $validates_format_of = array(
		//	array('slug', 'with'=>"/^[a-z0-9-]+$/", 'message'=>'should not contain spaces, only letters, numbers, hyphen or underscores are allowed.')
		//);

		static $validates_size_of = array(
			array('name', 'maximum' => 125),
			array('headline', 'maximum' => 255),
			array('sub_headline', 'maximum' => 255),
			array('description', 'maximum' => 255),
			array('redirect_url', 'maximum' => 255),
			array('c2a_button_text', 'maximum' => 255),
			array('slug', 'maximum' => 255)
		);

		// updateSlug is only called when first created because to change the slug after
		// creation would mean that pages that used the old slug would no longer work.
		static $before_create = array('updateSlug');

		static $availableThemes = array();

		static public function availableThemes() {
			if (empty(self::$availableThemes)) {
				$themes = array_diff(scandir(ZTL_PLUGIN_PATH . 'themes/optin-forms'), array('..', '.', 'macros'));
				foreach ($themes as $key=>$theme) {
					if (substr($theme, 0, 1) == '.') {
						unset($themes[$key]);
					}
				}
				sort($themes);

				self::$availableThemes = $themes;
			}

			return self::$availableThemes;
		}

		public function updateSlug()
		{
			if (empty($this->slug)) {
				// We trim the slug to avoid dangling hyphens
				$potentialSlug = trim(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->name)), '-');

				// The slug needs to be unique
				$checkCount = 1;
				while (true) {
					if (!self::exists(array('slug' => $potentialSlug))) {
						$this->slug = $potentialSlug;
						break;
					} else {
						$potentialSlug .= $checkCount;
					}
				}
			}
		}
	}
}

