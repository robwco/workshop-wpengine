<?php 

/* ---------------------------------------------------------------------- */
/*	Sidebar Loader
/* ---------------------------------------------------------------------- */
function radium_sidebar_loader( $_radium_sidebar_location = '' ) {

	global $post, $radium_sidebar_location, $radium_sidebar_class, $radium_content_class;
		
	$options = get_option('radium_theme');
	
	if ( 'post'== get_post_type() && is_single() && ( get_post_meta ($post->ID, '_radium_page_layout', true) == '') ) {
		
		if ( isset( $options['single_post_layout'] ) )
			$radium_sidebar_location = $options['single_post_layout'];
	
	} elseif ( 'portfolio'== get_post_type() && is_singular('portfolio') && ( get_post_meta ($post->ID, '_radium_page_layout', true) == '') ) {
	
		if ( isset( $options['single_portfolio_layout'] ) )
			$radium_sidebar_location = $options['single_portfolio_layout'];

	} elseif ( 'gallery'== get_post_type() && is_singular('gallery') && ( get_post_meta ($post->ID, '_radium_page_layout', true) == '') ) {
		
		if ( isset( $options['single_gallery_layout'] ) )
			$radium_sidebar_location = $options['single_gallery_layout'];
	
	} elseif ( $_radium_sidebar_location !== '' ) {
		
		$radium_sidebar_location = $_radium_sidebar_location;
	
	} else {
	
		//Setup Sidebar (its also overrides post and archive setting from admin panel) 
		$radium_sidebar_location = get_post_meta ($post->ID, '_radium_page_layout', true);
		
	}
	
	$radium_sidebar_class = null;
	$radium_content_class = null;
	
	if ( $radium_sidebar_location === 'right' ) {
	
		$radium_sidebar_class = "four columns sidebar-right";
		$radium_content_class = "eight columns";  
	
	} elseif ( $radium_sidebar_location === 'left' ) {
	 
		$radium_sidebar_class = "four columns pull-eight sidebar-left"; 
		$radium_content_class = "eight columns push-four"; 
		
	} else { 
	
		$radium_content_class = "twelve columns"; 
		
	}	
	
	return apply_filters( 'radium_sidebar_loader', $radium_sidebar_location );
}


//*-----------------------------------------------------------------------------------*/
/*	Adds custom classes to the array of body classes.
/*-----------------------------------------------------------------------------------*/
function radium_browser_body_class($classes) {

	global $post,  $radium_sidebar_location, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		
	$options = get_option('radium_theme');
	$classes[] = 'animated BeanFadeIn';
	$radium_sidebar_location = radium_sidebar_loader();
	
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) {
	    $classes[] = 'ie';
	    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	    if( preg_match( "/MSIE 7.0/", $browser ) ) {
	        $classes[] = 'ie7';
	    }
    }
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	if ( $radium_sidebar_location === 'left'  ) {
	
		$classes[] = 'left-sidebar with-sidebar';
		
	} elseif ( $radium_sidebar_location === 'right') {
	
		$classes[] = 'right-sidebar with-sidebar';
		
	}
		
	return $classes;
}
add_filter('body_class','radium_browser_body_class');


//*-----------------------------------------------------------------------------------*/
/*	add home link to menu
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('radium_home_page_menu_args') ) {

	function radium_home_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'radium_home_page_menu_args' );

}


/* ---------------------------------------------------------------------- */
/*	Return template part
/* ---------------------------------------------------------------------- */

if ( !function_exists('radium_load_template_part') ) {

	function radium_load_template_part( $template_name, $part_name = null ) {

		ob_start();
			get_template_part( $template_name, $part_name );
			$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}

}


/* ---------------------------------------------------------------------- */
/*	Check the current post for the existence of a short code 
/* ---------------------------------------------------------------------- */

if ( !function_exists('radium_has_shortcode') ) {

	function radium_has_shortcode($shortcode = '') {

		global $post;
		
		$post_obj = get_post( $post->ID );
		$found = false;
		
		// if no short code was provided, return false
		if ( !$shortcode )
			return $found;
			
		// check the post content for the short code
		if ( stripos( $post_obj->post_content, '[' . $shortcode ) !== false )
		
			// we have found the short code
			$found = true;

		// return our final results  
		return $found;

	}
}
 
 
/* ---------------------------------------------------------------------- */
/*	Get Custom Field
/* ---------------------------------------------------------------------- */

if ( !function_exists('radium_get_custom_field') ) {

	function radium_get_custom_field( $key, $post_id = null ) {

		global $wp_query;
		
		$post_id = $post_id ? $post_id : $wp_query->get_queried_object()->ID;
		
		return get_post_meta( $post_id, $key, true );

	}

}


/* ---------------------------------------------------------------------- */
/*	Get Custom Taxonomies List. Usage: echo radium_custom_taxonomies_terms_links();
/*  This will List all Taxonomies
/* ---------------------------------------------------------------------- */
if ( !function_exists('radium_custom_taxonomies_terms_links') ) {
	
	function radium_custom_taxonomies_terms_links() {
		global $post, $post_id;
		
		// get post by post id
		$post = &get_post($post->ID);
		
		// get post type by post
		$post_type = $post->post_type;
		
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		foreach ($taxonomies as $taxonomy) {
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term )
					$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
				$return = join( ', ', $out );
			}
		}
		
		return $return;
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('radium_get_posts_related_by_taxonomy') ) {

	function radium_get_posts_related_by_taxonomy($post_id, $taxonomy, $args=array()) {
	
		$query = new WP_Query();
		$terms = wp_get_object_terms($post_id, $taxonomy);
		if (count($terms)) {
		
		// Assumes only one term for per post in this taxonomy
		$post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
		$post = get_post($post_id);
		$args = wp_parse_args($args,array(
		  'post_type' => $post->post_type, // The assumes the post types match
		  //'post__in' => $post_ids,
		  'post__not_in' => array($post_id),
		  'taxonomy' => $taxonomy,
		  'term' => $terms[0]->slug,
		  'orderby' => 'rand',
		  'posts_per_page' => -1
		));
		$query = new WP_Query($args);
		}
		return $query;
	}

}




/*--------------------------------------------------------------------*/                							
/*  ADD MORE THEMES LINK				                							
/*--------------------------------------------------------------------*/
add_action( 'admin_menu' , 'admin_menu_new_items' );
function admin_menu_new_items() {
    global $submenu;
    $submenu['index.php'][500] = array( 'ThemeBeans.com', 'manage_options' , 'http://themebeans.com/?ref=wp_sidebar' ); 
}




/*------------------------------------------------------------------------------------------------------------*/
/* Create a theme options feed
 * Since the options panel is only loaded in the admin, this has been placed here instead of the admin panel so 
 * that we don't have to load the entire options panel in the frontend when migrating/backing-up options
/*------------------------------------------------------------------------------------------------------------*/

/**
 * Download the options file, or display it
 *
 * @since RADIUM_Options 2.0.1
*/
if (!function_exists("radium_download_options")) {

	function radium_download_options(){
		//-'.$this->args['opt_name']
		if(!isset($_GET['secret']) || $_GET['secret'] != md5(AUTH_KEY.SECURE_AUTH_KEY)){wp_die('Invalid Secret for options use');exit;}
		if(!isset($_GET['feed'])){wp_die('No Feed Defined');exit;}
		$backup_options = get_option(str_replace('radiumopts-','',$_GET['feed']));
		$backup_options['radium-opts-backup'] = '1';
		$content = '###'.serialize($backup_options).'###';
		
		if(isset($_GET['action']) && $_GET['action'] == 'download_options'){
			header('Content-Description: File Transfer');
			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename="'.str_replace('radiumopts-','',$_GET['feed']).'_options_'.date('d-m-Y').'.txt"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			echo $content;
			exit;
		}else{
			echo $content;
			exit;
		}
	}
	add_action('do_feed_radiumopts-radium_theme',  'radium_download_options', 1, 1);
	
}




/*--------------------------------------------------------------------*/                							
/*  BEAN PLUGIN NOTIFICATION					                							
/*--------------------------------------------------------------------*/
add_action('admin_notices', 'bean_plugin_admin_notice');

function bean_plugin_admin_notice() {
	global $current_user ;
    $user_id = $current_user->ID;

	if ( ! get_user_meta($user_id, 'bean_ignore_notice') ) {
	    echo '<div class="updated"><p>'; 
	    printf(__('This theme is compatible with the ThemeBeans <a href="http://themebeans.com/plugin/bean-tweets-plugin/?ref=plugin_notice" target="blank">Tweets</a>, <a href="http://themebeans.com/plugin/bean-social-plugin/?ref=plugin_notice" target="blank">Social</a>,  <a href="http://themebeans.com/plugin/bean-shortcodes-plugin/?ref=plugin_notice" target="blank">Shortcodes</a> & <a href="http://themebeans.com/plugin/bean-instagram-plugin/?ref=plugin_notice" target="blank">Instagram</a> WordPress Plugins. <a href="%1$s">Dismiss</a>'), '?bean_plugin_ignore=0');
	    echo "</p></div>";
	}
	
}
add_action('admin_init', 'bean_plugin_ignore');

function bean_plugin_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['bean_plugin_ignore']) && '0' == $_GET['bean_plugin_ignore'] ) {
             add_user_meta($user_id, 'bean_ignore_notice', 'true', true);
	}
}