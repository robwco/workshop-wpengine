<?php

require_once ZTL_PLUGIN_PATH . '/Vendor/class-tgm-plugin-activation.php';

class ZTLRequiredPlugins {
	protected $dependents = array('editorial-calendar/edcal.php', 'wishlist-member/wpm.php');

	static public function register() {
		$requiredPlugins = new ZTLRequiredPlugins();
		$requiredPlugins->setup();

		return $requiredPlugins;
	}

	public function setup() {
		//Require TGM class for auto-install
		add_action('tgmpa_register', array(&$this, 'registerRequirements'));
	}

	public function registerRequirements() {
		tgmpa($this->getPlugins(), $this->getConfig());
	}

	/**
	 * Deactivate the plugin
	 */
	public function deactivate()
	{
		add_action('update_option_active_plugins', array(&$this, 'deactivate_dependents'));
	}

	/**
	 * Deactivates dependant plugins
	 */
	public function deactivate_dependents(){
		foreach ($this->dependents as $dependent) {
			if (is_plugin_active($dependent)) {
				deactivate_plugins($dependent);
			}
		}
	}

	protected function getPlugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		return array($this->getEditorialCalendarConfig(), $this->getWishlistMemberConfig());
	}

	protected function getEditorialCalendarConfig() {
		return array(
			'name'					=> 'Editorial Calendar', // The plugin name
			'slug'					=> 'editorial-calendar', // The plugin slug (typically the folder name)
			'source'				=> ZTL_PLUGIN_PATH . 'assets/required-plugins/editorial-calendar.3.1.zip', // The plugin source
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required
			'version'				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL
		);
	}

	protected function getWishlistMemberConfig() {
		return array(
			'name'					=> 'Wishlist Member', // The plugin name
			'slug'					=> 'wishlist-member', // The plugin slug (typically the folder name)
			'source'				=> ZTL_PLUGIN_PATH . 'assets/required-plugins/wishlist-member-v2.80.2027.zip', // The plugin source
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required
			'version'				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL
		);
	}

	protected function getConfig() {
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'twentyfourteen';

		return array(
			'domain'			=> $theme_text_domain,			// Text domain - likely want to be the same as your theme.
			'default_path'		=> '',	// We unfortunately can't use this because it's only respected by the individual installer, not the bulk loader
			'parent_menu_slug'	=> 'plugins.php',				// Default parent menu slug
			'parent_url_slug'	=> 'plugins.php',				// Default parent URL slug
			'menu'				=> 'install-required-plugins',	// Menu slug
			'has_notices'		=> true,						// Show admin notices or not
			'is_automatic'		=> true,						// Automatically activate plugins after installation or not
			'message'			=> '',							// Message to output right before the plugins table
			'strings'			=> array(
				'page_title'								=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'								=> __( 'Install Plugins', $theme_text_domain ),
				'installing'								=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'										=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'				=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'						=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'				=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate'					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update'						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update'						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link'								=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'								=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'									=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'							=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete'									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	}
}
