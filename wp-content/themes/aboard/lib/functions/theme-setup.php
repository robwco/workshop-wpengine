<?php
/*
 * This file is a part of the RadiumFramework core
 * and contains theme specific settings .
 * Please be extremely cautious editing this file,
 *
 * @category RadiumFramework
 * @package  Aboard WordPress Theme	
 * @author   Franklin M Gitonga
 * @link     http://radiumthemes.com/
 */
 
 
/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     ADD OUR SCRIPTS									
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'add_our_scripts') ) {
		 
	function add_our_scripts() {
		global $post;
		
		$options = get_option('radium_theme');
	 	
	 	wp_enqueue_style( 'radium', RADIUM_CSS_URL . '/framework.css', false,'1.0','all');
	 	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri(). '/style.css', false, '1.4', 'all');	
		wp_enqueue_style('mobile', RADIUM_CSS_URL . '/mobile.css',false,'1.0','all'); 
		
		//JS
		wp_enqueue_script('jquery');
		wp_enqueue_script('custom-libraries', RADIUM_JS_URL . '/custom-libraries.js', 'jquery', '1.0', true);
		wp_enqueue_script('custom', RADIUM_JS_URL . '/custom.js', 'jquery', '2.0', true);
		
		global $is_IE;
		
		if ( $is_IE ) {
			wp_enqueue_script('selectivizr', RADIUM_JS_URL . '/selectivizr-min.js', 'jquery', '2.0', false);
		}
	 			
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
			wp_enqueue_script('validation', RADIUM_JS_URL . '/jquery.validate.min.js', 'jquery', '1.9', true);
		}
		
	}
	add_action( 'wp_enqueue_scripts', 'add_our_scripts',0);
}




/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     RADIUM SETUP										
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'radium_theme_setup') ) {

	function radium_theme_setup() {
		if ( function_exists( 'add_theme_support' ) ) {
			
			// Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
			add_theme_support('post-thumbnails');
			add_theme_support('automatic-feed-links');
			add_image_size( 'thumbnail-large', 725, 235, true ); // used by blog image slider
			
			set_post_thumbnail_size( 140, 140, true ); // Default Thumbnail
	
			// Add post formarts supports. http://codex.wordpress.org/Post_Formats
			add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));
			
		}
		
	}
	add_action('after_setup_theme', 'radium_theme_setup');
}




/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     PRIMARY NAVIGATION								
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( function_exists( 'wp_nav_menu') ) {

	add_theme_support( 'nav-menus' );
	$menus = array(
		'main-menu' => __( 'Primary Navigation', 'radium' ),
	);
	$menus = apply_filters( 'radium_nav_menus', $menus );
	register_nav_menus( $menus );
	
}
 
 
 
 
/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     CUSTOM CSS STYLES								
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_insert_custom_styles') ) {

	function radium_insert_custom_styles() { 
	
		$options = get_option('radium_theme');	
		$bg_color 		= get_post_meta( get_the_ID(), '_radium_backcolor', true );
 		$bg_src = null;
 		$text_color 	= get_post_meta( get_the_ID(), '_radium_textcolor', true );
 		
  		if( function_exists('rwmb_meta') ) {
  			$bg_src_array = rwmb_meta( '_radium_bgimage', 'type=image' );
  			
  			if( is_array($bg_src_array)){
 				foreach ( $bg_src_array as $bg_image ) {
		    		$bg_src = $bg_image['full_url'];
				}
  			}
		}			
	?>
	
	
<style>
/* ACCENT COLOR */	
<?php
	if ($options['accent_color']): ?>
		
		.main_menu .radium_mega a:hover,
		.main_menu .radium_mega > .current-menu-item > a, 
		input[type="password"].error, 
		input[type="date"].error, 
		input[type="datetime"].error, 
		input[type="email"].error, 
		input[type="number"].error,
		input[type="search"].error, 
		input[type="tel"].error, 
		input[type="time"].error, 
		input[type="url"].error,   
		input[type="text"].error, 
		input.error, 
		textarea.error { border-color: <?php  echo $options['accent_color']; ?>; }
		
		.modal .close:hover,
		.comment-author a:hover,
		.main_menu .radium_mega > li > ul li a:hover,
		.format-link .entry-title a:hover,
		#filter a.active,
		.team-twitter,
		 .modal .close:hover,
		.team-twitter a,
		.entry-content p a,
		.entry-header h1 a:hover,
		.entry-header h2 a:hover,
		.entry-header h3 a:hover,	
		div.bean-note a,
		a:hover { color:<?php  echo $options['accent_color']; ?>; }
		
		.author-count,
		.tagcloud a:hover,
		.tagcloud a,
		.short-btn,
		.btn:hover, 
		.button:hover, 
		button.button:hover, 
		.btn[type="submit"]:hover,
		.button[type="submit"]:hover,
		input[type="button"]:hover, 
		input[type="reset"]:hover, 
		input[type="submit"]:hover,
		.btn, 
		.button, 
		button.button, 
		.btn[type="submit"],
		.button[type="submit"],
		input[type="button"], 
		input[type="reset"], 
		input[type="submit"],
		.featurearea_icon .icon, 	
		#cancel-comment-reply a,	
		.comment-body .reply a, 
		.recent-tags a,
		.newsletter-button:hover,
		.newsletter-button,
		.stripes,
		.bean-quote,
		#twitter-btn:hover,
		.post-slider .flex-direction-nav .next:hover, 
		.post-slider .flex-direction-nav .prev:hover, 
		#twitter-btn { background-color: <?php  echo $options['accent_color']; ?>; }
		
		::-moz-selection { background-color: <?php  echo $options['accent_color']; ?>; color: #fff; }
		::selection { background-color: <?php  echo $options['accent_color']; ?>; color: #fff; }
		
<?php endif; 
/* HEADER COLOR */	
	if ($options['header_bg_color']): ?>
	
		#top-header { background-color: <?php  echo $options['header_bg_color']; ?>; }
	
<?php endif; 
/* PAGE HEADER COLOR */	
	if ($options['page_header_bg_color']): ?>
		#page-header { background-color: <?php  echo $options['page_header_bg_color']; ?>; }
	
<?php endif; 
/* BODY COLOR */	
	if ($options['body_bg_color']): ?>
		#main-container{ background-color: <?php  echo $options['body_bg_color']; ?>; }
	
<?php endif; 
/* FOOTER COLOR */	
	if( $options['footer_bg_color'] ): ?>	
	
		#bottom-footer { background-color: <?php echo $options['footer_bg_color']; ?>;}

<?php endif; 
/* IF NO ANIMATIONS */	
	if ($options['not_animated']): ?>
		.animated {
			-webkit-animation-fill-mode: none!important;
			   -moz-animation-fill-mode: none!important;
			    -ms-animation-fill-mode: none!important;
			     -o-animation-fill-mode: none!important;
			        animation-fill-mode: none!important;
			-webkit-animation-delay: 0s!important;
			   -moz-animation-delay: 0s!important;
			    -ms-animation-delay: 0s!important;
			     -o-animation-delay: 0s!important;
			        animation-delay: 0s!important;        
			-webkit-animation-duration: 0s!important;
			   -moz-animation-duration: 0s!important;
			    -ms-animation-duration: 0s!important;
			     -o-animation-duration: 0s!important;
			        animation-duration: 0s!important;	
		}		

<?php endif; ?>

</style>

<?php if( isset( $options['user_custom_styles'] )  ) : ?>

	<style><?php echo $options['user_custom_styles']; ?></style>

<?php endif; ?>


<?php }
	add_action('wp_head', 'radium_insert_custom_styles');
	}


/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     ADD THEME STYLE FROM OPTIONS PANEL				
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'radium_load_theme_style') ) {

	function radium_load_theme_style() {
	
		$options = get_option('radium_theme');	
		
		if ( isset( $options['theme_style'] ) ) {
	
			$skin = $options['theme_style'];
		
			if( $skin !== 'default')	
				wp_enqueue_style( $skin, RADIUM_STYLES_URL.'/'.$skin.'/style.css', false,'1.0','all');
		}
	
	}
	add_action('wp_enqueue_scripts', 'radium_load_theme_style');
}



/*------------------------------------------------------------------------------------------------*/
/*                    									
/*     ADD SKIN CLASSES TO BODY CLASS ARRAY				
/*                    									
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'radium_skin_body_class') ) {

	function radium_skin_body_class($classes) {
	
		global $post;
			
		$options = get_option('radium_theme');
		
		$classes[] = '';
		
		if ( isset( $options['theme_style'] ) )
			$classes[] = $options['theme_style'];
			
		return $classes;
	}
	
	add_filter('body_class','radium_skin_body_class');

} 