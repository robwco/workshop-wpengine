<?php

require_once 'ZTLDispatcher.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLDashboardController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLThemeMetaBoxController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminOptinFormsController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminLandingPagesController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminPopupController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLAdminIntegrationsController.php';
require_once ZTL_PLUGIN_PATH . 'Controller/ZTLSkuController.php';

if (ZTL_ENABLE_LANDING_PAGES) {
	require_once ZTL_PLUGIN_PATH . 'Controller/ZTLLandingStatsMetaBoxController.php';
	require_once ZTL_PLUGIN_PATH . 'Controller/ZTLOptinMetaBoxController.php';
	require_once ZTL_PLUGIN_PATH . 'Controller/ZTLThemeMetaBoxController.php';
}

class ZTLAdmin extends ZTLDispatcher {
	public function setup() {
		add_action('admin_init', array(&$this, 'init'));
		add_action('admin_menu', array(&$this, 'addMenu'));
		add_action('admin_enqueue_scripts', array(&$this, 'addScripts'));
	}

	public function init() {
		if (ZTL_ENABLE_LANDING_PAGES) {
			ZTLLandingStatsMetaBoxController::register($this->input);

			ZTLOptinMetaBoxController::register($this->input);

			ZTLThemeMetaBoxController::register($this->input);
		}

		if (!empty($_GET['integration']) && ($_GET['integration'] == 'gumroad')) {
			ZTLSkuController::renderAjaxIfExists($_GET);

			if (!empty($_POST)) {
				ZTLSkuController::save($_POST);
			} else {
				ZTLSkuController::handleDelete($_GET);
			}
		}
		
		if (!empty($_GET['integration']) && ($_GET['integration'] == 'export')) {
			if (!empty($_POST['ztl_export_leads'])) {
				ZTLAdminIntegrationsController::export_leads_callback();
			}		
		}

		if (!empty($_GET['page']) && ($_GET['page'] == 'ztl-optin-page-settings')) {
			if (!empty($_GET['action']) && ($_GET['action'] == 'render_optin_ajax')) {
				ZTLAdminOptinFormsController::render_optin_ajax($_POST);
			}		
		}
		elseif (!empty($_GET['page']) && ($_GET['page'] == 'ztl-popups')) {
			if (!empty($_GET['action']) && ($_GET['action'] == 'render_popup_ajax')) {
				ZTLAdminPopupController::render_popup_ajax($_POST);
			}
		}

        if (!empty($_GET['page']) && ($_GET['page'] == 'ztl-optin-page-settings')) {
            if (!empty($_GET['action']) && ($_GET['action'] == 'render_optin')) {
                $optinForm = ZTLPluginOptinForm::find($_GET['id']);
                $renderer = new ZTLOptinFormRenderer();
                echo $renderer->render($optinForm, array(
                    'editing' => true,
                    'source' => 'landing-page'
                ));
                exit();
            }
        }


		// Override for displaying landing pages without the wp-admin chrome
		// ------------------------------------------------
		if (!empty($_GET['page']) && ($_GET['page'] == 'ztl-landing-pages')) {
			if (!empty($_GET['action']) && ($_GET['action'] == 'display')) {
				ZTLAdminLandingPagesController::render_landing_page_for_edit($_GET);
			}
		}


		/* Register our stylesheet. */
		wp_register_style('ztlAdminStylesheet', plugins_url('/assets/admin.css', __FILE__));
	}

	public function addMenu() {
		global $submenu;

		$dashboardController = new ZTLDashboardController($this->input);
		add_menu_page(
			'Zero To Launch',
			'Zero To Launch',
			'manage_options',
			'ztl-dashboard',
			array(
				&$dashboardController,
				'index'
			),
			plugins_url('assets/images/icon.png', dirname(__FILE__))
		);

		// Add in Zendesk Support code
		add_action('admin_footer', function()
		{
			if (isset($_GET['page']) && strpos($_GET['page'], 'ztl') === 0) {
				echo '<script type="text/javascript" src="//assets.zendesk.com/external/zenbox/v2.5/zenbox.js"></script>
                    <style type="text/css" media="screen, projection">
                    @import url(//assets.zendesk.com/external/zenbox/v2.5/zenbox.css);
                    </style>
                    <script type="text/javascript">
                        if (typeof(Zenbox) !== "undefined") {
                            Zenbox.init({
                                dropboxID:   "20140132",
                                url:         "https://iwillteachyoutoberich.zendesk.com",
                                tabID:       "ZTL Support",
                                tabColor:    "#ffcc00",
                                tabPosition: "Right"
                            });
                        }
                    </script>';
			}
		});

		$optinFormsController = new ZTLAdminOptinFormsController($this->input);
		$this->addSubmenuDispatchers('ztl-dashboard', 'Opt-in Forms', 'Opt-in Forms', 'manage_options', 'ztl-optin-page-settings', $optinFormsController);

		$ztlAdminLandingPageController = new ZTLAdminLandingPagesController($this->input);
		$this->addSubmenuDispatchers('ztl-dashboard', 'Landing Pages', 'Landing Pages', 'manage_options', 'ztl-landing-pages', $ztlAdminLandingPageController);

		$ztlAdminPopupController = new ZTLAdminPopupController($this->input);
		$this->addSubmenuDispatchers('ztl-dashboard', 'Lightboxes', 'Lightboxes', 'manage_options', 'ztl-popups', $ztlAdminPopupController);

		$integrationsController = new ZTLAdminIntegrationsController($this->input);
		$this->addSubmenuDispatchers('ztl-dashboard', 'Integrations', 'Integrations', 'manage_options', 'ztl-integration', $integrationsController);

		if (isset($submenu['ztl-dashboard']))
			$submenu['ztl-dashboard'][0][0] = __('Dashboard', 'ztl-dashboard');
	}

	public function addScripts() {
		// todo split registering and enqueing into separate methods.
		wp_enqueue_media();
		wp_register_style('zerotolaunch_admin_style', plugins_url('zerotolaunch/assets/css/admin.css'));
		wp_enqueue_style('zerotolaunch_admin_style');
		wp_enqueue_script('zerotolaunch-admin-js', plugins_url('zerotolaunch/assets/js/admin.js'));
		wp_localize_script('zerotolaunch-admin-js', 'ajax_object', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		)); // setting ajaxurl
		wp_enqueue_script('ckeditor-js', plugins_url('zerotolaunch/assets/js/ckeditor/ckeditor.js'));
		wp_enqueue_script('move-it', plugins_url('zerotolaunch/assets/js/moveit.js'), array(
			'jquery-ui-sortable',
			'jquery'
		));
		wp_enqueue_script('dashboard');
		wp_enqueue_script('jquery-ui-tabs');
		
		//for popup preview
		wp_enqueue_style(
			'fancybox', plugins_url('/assets/js/fancy/jquery.fancybox.css', dirname(__FILE__)),
			array(), '2.1.5');

		wp_enqueue_script(
			'fancybox', plugins_url('/assets/js/fancy/jquery.fancybox.pack.js', dirname(__FILE__)),
			array(), '2.1.5', true);	
		
		wp_enqueue_script(			
			'admin-popup-preview', plugins_url('zerotolaunch/assets/js/admin-popup-preview.js'));
	}

	/**
        We can't redirect from within the submenu handler, so we need to hook into the page load action in order to do so.
        This method acts as a helper in doing so by automatically setting the callbacks to dispatchAction and pre_dispatcher
        for the specified
    */
	protected function addSubmenuDispatchers($parent_slug, $page_title, $menu_title, $capability, $menu_slug, &$controller)
	{
		$page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array(
			&$controller,
			'dispatchAction'
		));

		add_action('load-' . $page, array(
			&$controller,
			'dispatchPreAction'
		));
	}
}
