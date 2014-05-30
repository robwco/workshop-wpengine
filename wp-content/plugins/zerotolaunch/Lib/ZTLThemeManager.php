<?php

	class ZTLThemeManager {
		protected $selectedTheme;

		public function __construct() {
			$this->registerPremiumThemes();

			// We need to run prior to wp_templating_constants being run so that the
			// templating constants are set to our theme (if any) in time.
			add_action('setup_theme', array(&$this, 'setup'));
		}

		public function setup() {
			if (ZTL_ENABLE_LANDING_PAGES) {
				$this->setSelectedTheme();
				$this->registerLandingPageHandlers();
			}
		}

		protected function registerPremiumThemes() {
			// Add our premium themes root to our list of theme directories.
			// This allows us to include the themes in our plugin without
			// copying over to the main theme directory.
			register_theme_directory(ZTL_PLUGIN_PATH . 'themes/premium');
		}


		protected function registerLandingPageHandlers() {
			add_filter('template', array(&$this, 'getTemplate'));
			add_filter('stylesheet', array(&$this, 'getTemplate'));
		}

		protected function setSelectedTheme() {
			$landingPage = $this->getLandingPage();

			if (!empty($landingPage)) {
				// TODO add checks to make sure that the theme is still valid
				$this->selectedTheme = get_post_meta($landingPage->ID, '_ztl_theme_name', true);
			}
		}

		public function getTemplate($current) {
			if ($this->selectedTheme) {
				return $this->selectedTheme;
			}
			return $current;
		}

		private function getLandingPage() {
			// We unfortunately don't have access to most of the niceties of WordPress
			// at the time we're run, so we have to do parsing on our own to get info about
			// the requested post
			global $wp;

			$wp->parse_request();

			parse_str($wp->matched_query);

			if (!empty($ztl_landing_page)) {
				$posts = get_posts(array(
					'name' => $ztl_landing_page, 'post_type' => 'ztl_landing_page')
				);

				return $posts[0];
			}

			return null;
		}
	}