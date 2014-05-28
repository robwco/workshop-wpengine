<?php
   /*
   Plugin Name: Zero To Launch Accelerator
   Plugin URI: http://zerotolaunchsystem.com/
   Description: The Accelerator add-on to your Zero to Launch course makes your business launch faster by automatically handling your technology needs.
   Version: 1.0.2
   Author: I Will Teach You To Be Rich
   Author URI: http://www.iwillteachyoutoberich.com
   */

if(!class_exists('ZTL'))
{
	define('ZTL_PLUGIN_PATH', plugin_dir_path(__FILE__));
	define('ZTL_ENABLE_LANDING_PAGES', false);

	// Get the version from our header so that we don't have to change it in multiple places
    if ( !function_exists('get_plugin_data') ){
        require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    }
	$ztlPluginData = get_plugin_data(ZTL_PLUGIN_PATH . '/zerotolaunch.php');
	define('ZTL_VERSION', $ztlPluginData['Version']);

	class ZTL
	{
		public static $baseUrl = "http://dreamjob.iwtstudents.com";

		public $settings;
		public $db;
		public $requiredPlugins;
		public $pluginStatus;
		public $themeManager;
		public $input;
		public $shortcodes;

		/**
		 * Construct the plugin object
		 */
		public function __construct($ztlDB) {
			$this->input = new ZTLInput();
			$this->db = $ztlDB;
			$this->pluginStatus = new ZTLPluginStatus($this);
		}

		public function setup() {
			register_activation_hook(__FILE__, array(&$this, 'activate'));
			register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));

			$this->requiredPlugins = ZTLRequiredPlugins::register();
			$this->themeManager = new ZTLThemeManager(); // Must be called to register plugin hooks at setup_theme or earlier

			add_action('init', array(&$this, 'init'));
			add_action('widgets_init', function () {
				register_widget("ZTLOptinWidgetController");
			});

			// Auto update plugin
			add_filter( 'auto_update_plugin', '__return_true' );
		}

		/**
		 * Activate the plugin
		 */
		public function activate() {
			global $wp_rewrite;
			$this->db->migrate();
			$this->db->insertSeedData();
      		$this->db->insertDefaultContent();

			if ($wp_rewrite->permalink_structure == '') {
				//permalinks setting is disabled force to enabled
				$wp_rewrite->set_permalink_structure('/%postname%/');
				$wp_rewrite->flush_rules();				
			}
		}

		public function deactivate() {
			delete_transient('ztl_plugin_is_valid');
			delete_transient('ztl_plugin_api_key');
			delete_transient('ztl_plugin_rewritedelay-v' . ZTL_VERSION);

			$this->requiredPlugins->deactivate();

			flush_rewrite_rules();
		}

		public function handle_custom_query_vars($query_vars){
			$query_vars[] = 'lp_slug';
			return $query_vars;
		}

		function get_my_vars() {
			global $wp_query;
			if(isset($wp_query->query_vars['lp_slug'])) {
				$slug = get_query_var('lp_slug');
				require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminLandingPagesController.php';
				ZTLAdminLandingPagesController::render_landing_page($slug);
				exit;
			}
		}

		public function init() {
			$this->shortcodes = new ZTLShortcodes($this->input);

			if (!$this->pluginStatus->check()) {
				require_once ABSPATH . 'wp-includes/option.php';

				$plugin = plugin_basename(__FILE__);

				ZTLCustomPostTypes::setup();
				new ZTLUpdater();

				$this->shortcodes->processRequest();

				ZTLSkus::register($this->input);
				ZTLPopups::register($this->input);

				if (ZTL_ENABLE_LANDING_PAGES) {
					ZTLOptinFormLandingPage::register($this->input);
				}

				$this->addRewriteRules();

				add_filter('query_vars', array(&$this, 'handle_custom_query_vars'));
				add_action('template_redirect', array(&$this, 'get_my_vars'));

				add_filter("plugin_action_links_$plugin", array(&$this, 'addPluginSettingsLink'));

				add_action('wp_head', array(&$this, 'countPageHits'));
			}
		}

		public function addPluginSettingsLink($links) {
			$settings_link = '<a href="admin.php?page=ztl-dashboard">Get Started</a>';
			array_unshift($links, $settings_link);
			return $links;
		}

		public function countPageHits() {
			global $post;

			if (!empty($post->ID)) {
				// TODO should this option name be prefixed with "ztl_" to avoid potential conflict with other plugins?
				$count = get_post_meta($post->ID, 'count_page_hits', true);
				$newcount = $count + 1;

				update_post_meta($post->ID, 'count_page_hits', $newcount);
			}
		}

		protected function addRewriteRules() {
			add_rewrite_rule('^l/([^/]+)/?','index.php?lp_slug=$matches[1]','top');
			add_rewrite_tag('%lp_slug%','([^&]+)');

			// Standard practice is to flush rewrite rules in the activate/deactivate
			// hooks, but due to our login, that's no possible. We instead use a long
			// lived transient cache to persist our values.
			$transientName = 'ztl_plugin_rewritedelay-v' . ZTL_VERSION;

			if (!get_transient($transientName)) {
				set_transient($transientName, true, 31536000); // 1 year
				flush_rewrite_rules(true);
			}
		}
	} // END class ZTL
} // END if(!class_exists('ZTL'))

if(class_exists('ZTL')) {
	require_once 'Lib/ZTLDB.php';

	// Setup our DB access. This must happen prior to other files loading to
	// ensure that AR has been properly loaded. If it is not loaded early enough,
	// then various file not found errors will occur.
	$ztlDB = ZTLDB::register();

	require_once 'Lib/ZTLInput.php';
	require_once 'Lib/ZTLPluginStatus.php';
	require_once 'Lib/ZTLRequiredPlugins.php';
	require_once 'Lib/ZTLThemeManager.php';
	require_once 'Lib/ZTLOptinFormWidget.php';
	require_once 'Lib/ZTLCustomPostTypes.php';
	require_once 'Lib/ZTLAdmin.php';
	require_once 'Lib/ZTLAdminLogin.php';
	require_once 'Lib/ZTLShortcodes.php';
	require_once 'Lib/ZTLPopups.php';
	require_once 'Lib/ZTLSkus.php';
	require_once 'Lib/ZTLOptinFormLandingPage.php';
	require_once 'Lib/ZTLUpdater.php';
	include_once 'Vendor/tinymce/tinymce.php';
	require_once 'Vendor/tinymce/ajax.php';


	// instantiate the plugin class
	$ztl = new ZTL($ztlDB);
	$ztl->setup();

	if (!function_exists('debug')) {
		function debug($msg)
		{
			echo '<pre>' . print_r($msg, true) . '</pre>';
		}
	}
}
