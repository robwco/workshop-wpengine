<?php

if (!class_exists('ZTLPluginLandingPage')) {
	define('ZTL_LANDING_PAGE_TABLE', ZTL_TABLE_PREFIX . 'landing_pages');

	class ZTLPluginLandingPage extends ActiveRecord\Model {
		static $table_name = ZTL_LANDING_PAGE_TABLE;

		static $attr_protected = array('id');

		static $validates_presence_of = array(
			array('name', 'message'=>"'Landing Page Name' is blank. Please enter the Landing Page Name"),
			array('optin_form_id', 'message'=>"'Opt-in Form' is missing. A Landing Page must have an Opt-in Form"),
			array('body')
		);

		static $validates_uniqueness_of = array(
			array('name'),
		);


		static $validates_size_of = array(
			array('name', 'maximum' => 125),
			array('slug', 'maximum' => 255),
		);

		// updateSlug is only called when first created because to change the slug after
		// creation would mean that pages that used the old slug would no longer work.
		static $before_create = array('updateSlug');

		static $availableThemes = array();

		static public function availableThemes() {
			if (empty(self::$availableThemes)) {
				$themes = array_diff(scandir(ZTL_PLUGIN_PATH . 'themes/landing-pages'), array('..', '.'));
				foreach ($themes as $key=>$theme) {
					if (substr($theme, 0, 1) == '.' || !is_dir(ZTL_PLUGIN_PATH . 'themes/landing-pages/' . $theme)) {
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

