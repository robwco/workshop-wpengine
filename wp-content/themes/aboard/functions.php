<?php
/*
 * This file is a part of the theme core.
 * Please be extremely cautious editing this file,
 *
 * @category RadiumFramework
 * @package  Aboard WordPress Theme
 * @author   RadiumThemes
 * @link     http://radiumthemes.com
 */


/*
 * Initializes the framework by doing some basic things like defining constants
 * and loading framework components from the /lib directory.
 */

/* Run the radium_pre Hook */
do_action( 'radium_pre' );


/*
 * Setup the config array for which features the 
 * theme supports. This can easily be filtered 
 * giving you a chance to disable/enable the theme's various features.
 *
 * set each feature to true or false
 * 
 * radium_feature_setup 
 *
 * @since 2.0.0
 */
 
function radium_feature_setup() {
	$args = array(
	
		'primary' 	=> array(
			'breadcrumbs'		=> false, 
			'faq'				=> true, 
			'forms'				=> true,
			'gallery'			=> false,
			'meta'				=> true,
			'menu'				=> true,
			'portfolio'			=> true,
			'responsive' 		=> true,			 
			'sliders' 			=> false,			 
			'skins' 			=> true,
			'team'				=> true,
			'widgets'			=> true, 
		),
		
		'comments' 	=> array(
			'pages'				=> false,  //show comments on pages
			'posts'				=> true,  //show comments on single posts
			'portfolio'			=> false,  //show comments on single portfolios
			'gallery'			=> false,  //show comments on single galleries
		),
		
		'plugins' 	=> array(
			'bbpress'			=> false, //switched on by child theme  
		)
		
	);
	return apply_filters( 'radium_theme_config_args', $args );
}
add_action('radium_init', 'radium_feature_setup');


/**
 * Check which features are currently supported.
 * Please note that this function is loaded very early in the framework
 * don't move it or you'll break something :)
 *
 * @since 2.0.0
 *
 * @param string $group primary, meta, comments, plugins
 * @param string $feature feature key to check
 * @return boolean
 */
 
function radium_theme_supports( $group, $feature ) {
	$setup = radium_feature_setup();
	if( isset( $setup[$group][$feature] ) && $setup[$group][$feature] )
		return true;
	else
		return false;
}


/**
 * This function defines the Aboard Theme constants
 *
 * @since 1.0.0
 */
function radium_constants() {
 	
	/** Define Theme Directory Location Constants */
	define( 'PARENT_DIR', get_template_directory() );
	define( 'CHILD_DIR', get_stylesheet_directory() );
	
	/** Define Theme URL Location Constants */
	define( 'PARENT_URL', get_template_directory_uri() );
	define( 'CHILD_URL', get_stylesheet_directory_uri() );
	
    	
	/** Define Theme Info Constants */
	$theme = wp_get_theme(); //Get Theme data (WP 3.4+)
		
	$theme_title = $theme->name; //or $theme->title
	$theme_version = $theme->version;
	
	define( 'RADIUM_THEME_SLUG', get_template() );
	define( 'RADIUM_THEME_NAME', $theme_title );
	define( 'RADIUM_THEME_VER', $theme_version );
	
  	/*----------------------------------------------------*/
  	/* Define General Constants */
  	/*----------------------------------------------------*/
 
 	/** Define Directory Location Constants (These Constants make moving directories and files around very easy) */
 	define( 'RADIUM_IMAGES_DIR', PARENT_DIR . '/assets/images' );
	define( 'RADIUM_LIB_DIR', PARENT_DIR . '/lib' );
	define( 'RADIUM_JS_DIR', PARENT_DIR . '/assets/js' );
	define( 'RADIUM_CSS_DIR', PARENT_DIR . '/assets/css' );
	define( 'RADIUM_FUNCTIONS_DIR', RADIUM_LIB_DIR . '/functions' );
	define( 'RADIUM_CONTENT_DIR', RADIUM_LIB_DIR . '/content' );
	define( 'RADIUM_LANGUAGES_DIR', RADIUM_LIB_DIR . '/languages' );
	define( 'RADIUM_CPT_DIR', RADIUM_LIB_DIR . '/custom-post-types' );

	/** Define Url Location Constants (These Constants make moving directories and files around very easy) */
	define( 'RADIUM_STYLES_URL', PARENT_URL . '/assets/styles' );
	define( 'RADIUM_IMAGES_URL', PARENT_URL . '/assets/images' );
	define( 'RADIUM_LIB_URL', PARENT_URL . '/lib' );
	define( 'RADIUM_JS_URL', PARENT_URL . '/assets/js' );
	define( 'RADIUM_CSS_URL', PARENT_URL . '/assets/css' );
	define( 'RADIUM_FUNCTIONS_URL', RADIUM_LIB_URL . '/functions' );
	define( 'RADIUM_CPT_URL', RADIUM_LIB_URL . '/custom-post-types' );
	
	/*----------------------------------------------------*/
	/* Define Admin Constants */
	/*----------------------------------------------------*/

	/** Define Admin Directory Location Constants */
	define( 'RADIUM_ADMIN_DIR', RADIUM_LIB_DIR . '/admin' );
	define( 'RADIUM_ADMIN_IMAGES_DIR', RADIUM_LIB_DIR . '/admin/assets/images' );
	define( 'RADIUM_ADMIN_CSS_DIR', RADIUM_LIB_DIR . '/admin/assets/css' );
	define( 'RADIUM_ADMIN_JS_DIR', RADIUM_LIB_DIR . '/admin/assets/js' );
 		
	/** Define Admin URL Location Constants */
	define( 'RADIUM_ADMIN_URL', RADIUM_LIB_URL . '/admin' );
	define( 'RADIUM_ADMIN_IMAGES_URL', RADIUM_LIB_URL . '/admin/assets/images' );
	define( 'RADIUM_ADMIN_CSS_URL', RADIUM_LIB_URL . '/admin/assets/css' );
	define( 'RADIUM_ADMIN_JS_URL', RADIUM_LIB_URL . '/admin/assets/js' );
		
	// Constants for the theme name, folder and remote XML url
	define( 'RADIUM_FRAMEWORK_VERSION', '2.0' );
	define( 'RADIUM_DOCUMENTATION_URL', 'http://support.radiumthemes.com/knowledgebase' );
	define( 'RADIUM_SUPPORT_URL', 'http://support.radiumthemes.com' );
	
	define( 'NOTIFIER_THEME_NAME', RADIUM_THEME_NAME ); // The theme name
	define( 'NOTIFIER_THEME_FOLDER_NAME', RADIUM_THEME_SLUG ); // The theme folder name
	define( 'NOTIFIER_XML_FILE', 'http://themes.radiumthemes.com/updates/'.RADIUM_THEME_SLUG.'-wp.xml' ); // XML file containing latest version info and changelog
	
	//presstrend
	define( 'RADIUM_PRESSTREND', true); //Enable presstrend (true or false)
	define( 'RADIUM_PRESSTRENDKEY', 'sxn0jeama6fng7fjz5xsuw9ou3ysu7cdm4xc' ); // Account API Key
	define( 'RADIUM_PRESSTRENDAUTH', '2xi51elg39ybucuwvuxycfcfi9mqp79ns' ); // theme auth
		
	/* DEV Mode */
	define('DEV_MODE', false); //Define Dev Mode (true or false)
	
	/**
	 * Conditionally Loaded Contants
	 * Theme Specific
	 */
	if( radium_theme_supports( 'primary', 'widgets' ) ){
		define( 'RADIUM_WIDGETS_DIR', RADIUM_LIB_DIR . '/widgets' );
 		define( 'RADIUM_WIDGETS_URL', RADIUM_LIB_URL . '/widgets' );
	}
	
	if( radium_theme_supports( 'primary', 'forms' ) ){
	 	define( 'RADIUM_FORMS_DIR', RADIUM_ADMIN_DIR . '/forms' );
	 	define( 'RADIUM_FORMS_URL', RADIUM_ADMIN_URL . '/forms' );
	}	
}
add_action( 'radium_init', 'radium_constants' );
 
 	
/**
 * Loads all the framework files and features.
 *
 * The radium_pre_framework action hook is called before any of the files are
 * required().
 *
 * @since 1.0.0
 */
function radium_load_framework() {
	
	/** Run the radium_pre_framework Hook */
	do_action( 'radium_pre_framework' );
		
	/*------------------------------------------------------------------------------------
	// Load General Functions (these are important - and are needed in the frontend and backend - don't disable)
	------------------------------------------------------------------------------------*/
	require( RADIUM_FUNCTIONS_DIR . '/theme-setup.php' );
	require( RADIUM_FUNCTIONS_DIR . '/core-functions.php' );
	require( RADIUM_FUNCTIONS_DIR . '/theme-functions.php' );
	require( RADIUM_FUNCTIONS_DIR . '/i18n.php' );
	
	if( radium_theme_supports( 'primary', 'meta' ) )
		require_once (RADIUM_ADMIN_DIR . '/metaboxes/metaboxes-init.php'); //metaboxes Engine
	//End General Functions
	
	/* Load Navigation Tools */
	if( radium_theme_supports( 'primary', 'menu' ) )
		include( RADIUM_FUNCTIONS_DIR . '/navigation/menu.php' );
	
	/*------------------------------------------------------------------------------------
	// Load the Slider Engines
	 ------------------------------------------------------------------------------------*/
	if( radium_theme_supports( 'primary', 'sliders' ) )
		include( RADIUM_ADMIN_DIR . '/slider/slider-init.php' );
	
	/*-----------------------------------------------------------------------------------
	// Initialize Custom Post Types
	 -----------------------------------------------------------------------------------*/
	
	/* Load Portfolio*/
	if( radium_theme_supports( 'primary', 'portfolio' ) ){
		include( RADIUM_CPT_DIR . '/portfolio/portfolio-init.php' );
		//include( RADIUM_WIDGETS_DIR . '/widget-portfolio.php' );
		
	}
	
	/* Load Gallery*/
	if( radium_theme_supports( 'primary', 'gallery' ) ){
	
		include( RADIUM_CPT_DIR . '/gallery/gallery-init.php' );
		include( RADIUM_CPT_DIR . '/gallery/gallery-functions.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-gallery.php' );
		
	}
	
	/* Load Teams*/
	if( radium_theme_supports( 'primary', 'team' ) ){
	
		include( RADIUM_CPT_DIR . '/teams/teams-init.php' );
		include( RADIUM_CPT_DIR . '/teams/teams-functions.php' );
		
	}
	
	/* Load FAQ*/
	if( radium_theme_supports( 'primary', 'faq' ) ){
	
		include( RADIUM_CPT_DIR . '/faq/faq-init.php' );
		include( RADIUM_CPT_DIR . '/faq/faq-functions.php' );
	}
	
	/*------------------------------------------------------------------------------------
	// Load the Form Builder
	-------------------------------------------------------------------------------------*/
	if( radium_theme_supports( 'primary', 'forms' ) )
		include( RADIUM_FORMS_DIR . '/form.php'); 	
	
	/*------------------------------------------------------------------------------------
	// Load Widgets
	------------------------------------------------------------------------------------*/
		
	if( radium_theme_supports( 'primary', 'widgets' ) ){
	
		include_once(RADIUM_ADMIN_DIR . '/sidebars/sidebars.php' ); // bootstrap the radium sidebar manager
	
		include( RADIUM_WIDGETS_DIR . '/widget-init.php' ); //Load Default Widget Areas
		
		/* Include widgets*/
		//include( RADIUM_WIDGETS_DIR . '/widget-custom-images.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-dribbble.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-flickr.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-newsletter.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-recent-posts.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-skills.php' );
		include( RADIUM_WIDGETS_DIR . '/widget-social.php' );
	 	include( RADIUM_WIDGETS_DIR . '/widget-social-counter.php' );
	}

	// We've separated admin and frontend specific files for the best performance
	if( is_admin() ) { 
		
		// Load up our theme options page and related code.
		require( RADIUM_ADMIN_DIR . '/admin-init.php' );
		require( RADIUM_ADMIN_DIR . '/options/options-init.php' ); //load admin theme options panel
		require( RADIUM_FUNCTIONS_DIR . '/theme-options.php' );// load theme options
		require_once( RADIUM_ADMIN_DIR . '/includes/plugin-activation.php' ); // Plugin Activation Dependencies
		require_once( RADIUM_ADMIN_DIR . '/includes/update-notifier.php' ); // Theme Update Notifier
		
		/*------------------------------------------------------------------------------------
		// Load the themes meta fields
		 ------------------------------------------------------------------------------------*/
		if( radium_theme_supports( 'primary', 'meta' ) ) {
			
			include( RADIUM_LIB_DIR . '/metaboxes/metaboxes-init.php'); //Required
			include( RADIUM_LIB_DIR . '/metaboxes/meta-general.php');
		
			include( RADIUM_LIB_DIR . '/metaboxes/meta-page.php');
			include( RADIUM_LIB_DIR . '/metaboxes/meta-post.php');
		}
		
		if( radium_theme_supports( 'primary', 'faq' ) && radium_theme_supports( 'primary', 'meta' ) )
			include( RADIUM_LIB_DIR . '/metaboxes/meta-faq.php');
		
		if( radium_theme_supports( 'primary', 'gallery' ) && radium_theme_supports( 'primary', 'meta' ) )
			include( RADIUM_LIB_DIR . '/metaboxes/meta-gallery.php');
		
		if( radium_theme_supports( 'primary', 'portfolio' ) && radium_theme_supports( 'primary', 'meta' ) )
			include( RADIUM_LIB_DIR . '/metaboxes/meta-portfolio.php');
			
		if( radium_theme_supports( 'primary', 'sliders' ) && radium_theme_supports( 'primary', 'meta' ) )
			include( RADIUM_LIB_DIR . '/metaboxes/meta-slider.php');
		
		if( radium_theme_supports( 'primary', 'team' ) && radium_theme_supports( 'primary', 'meta' ) )
			include( RADIUM_LIB_DIR . '/metaboxes/meta-team.php');
		
		//if( radium_theme_supports( 'primary', 'meta' ) )
		//require( RADIUM_LIB_DIR . '/metaboxes/demo.php'); //metabox setup demo

		/*------------------------------------------------------------------------------------
		// Load the Form Builder
		 -------------------------------------------------------------------------------------*/
 		if( radium_theme_supports( 'primary', 'forms' ) )
 			include(RADIUM_FORMS_DIR . '/admin.php');
 		
 		/*------------------------------------------------------------------------------------
 		// Load the Slider Engines
 		 ------------------------------------------------------------------------------------*/
 		if( radium_theme_supports( 'primary', 'sliders' ) )
 			include( RADIUM_ADMIN_DIR . '/slider/slider-admin.php' );
 		
	} else {
		
		/* Load Navigation Tools */
		if( radium_theme_supports( 'primary', 'responsive' ) )
				include( RADIUM_FUNCTIONS_DIR . '/navigation/mobile-nav.php' ); 
		
		if( radium_theme_supports( 'primary', 'breadcrumbs' ) )
			include( RADIUM_FUNCTIONS_DIR . '/navigation/breadcrumb-trail.php' ); 
		
		if( radium_theme_supports( 'primary', 'portfolio' ) ) {
			include( RADIUM_FUNCTIONS_DIR . '/navigation/portfolio.php' );
		}
		
		/* Pagination */
		include( RADIUM_FUNCTIONS_DIR . '/navigation/pagination.php' );
		
		/* Comments */
		include( RADIUM_FUNCTIONS_DIR . '/comments.php' );
		
		/* Media - video, audio, image functions */
		require( RADIUM_FUNCTIONS_DIR . '/media.php' );
	   	
 	}
	  	
}

add_action( 'radium_init', 'radium_load_framework' );

/** Run the radium_init hook */
do_action( 'radium_init' );

/** Run the radium_setup hook */
do_action( 'radium_setup' );

