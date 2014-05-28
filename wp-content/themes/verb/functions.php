<?php

//-----------------------------------  // Load Scripts //-----------------------------------//

function okay_scripts_styles() {
	
	//Enqueue Styles
	
	//Main Stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	//Font Awesome CSS
	wp_enqueue_style( 'font_awesome_css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.css", array(), '0.1', 'screen' );
	
	//Media Queries CSS
	wp_enqueue_style( 'media_queries_css', get_template_directory_uri() . "/media-queries.css", array(), '0.1', 'screen' );
	
	//Google Raleway
	wp_enqueue_style('google_raleway', 'http://fonts.googleapis.com/css?family=Raleway:200,300,400,500');
	
	//Google Open Sans Font
	wp_enqueue_style('google_opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
	
	//Enqueue Scripts
	
	//Register jQuery
	wp_enqueue_script('jquery');
	
	//Custom JS
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/includes/js/custom/custom.js', false, false , true);
	
	//Mobile JS
	wp_enqueue_script('mobile_menu_js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', false, false , true);
	
	//FidVid
	wp_enqueue_script('fitvid_js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', false, false , true);
	
	//View.js
	wp_enqueue_script('view_js', get_template_directory_uri() . '/includes/js/view/view.min.js?auto', false, false , true);

}
add_action( 'wp_enqueue_scripts', 'okay_scripts_styles' );



//-----------------------------------  // Add Customizer CSS To Header //-----------------------------------//

function customizer_css() {
    ?>
	<style type="text/css">
		a, #cancel-comment-reply i, #content .meta a, .entry-title a:hover, .post-navigation a:hover, .post-navigation li:hover i, .logo-text:hover i, .pull-quote {
			color: <?php echo '' .get_theme_mod( 'okay_theme_customizer_accent', '#f74f4f' )."\n";?>;
		}
		
		.next-prev a, #commentform #submit, .wpcf7-submit, .header .search-form .submit, .search-form .submit, .hero h3 {
			background: <?php echo '' .get_theme_mod( 'okay_theme_customizer_accent', '#f74f4f' )."\n";?>; 
		}
		
		<?php echo '' .get_theme_mod( 'okay_theme_customizer_css', '' )."\n";?>
	</style>
    <?php
}
add_action('wp_head', 'customizer_css');



//-----------------------------------  // Add Localization //-----------------------------------//

load_theme_textdomain( 'okay', get_template_directory() . '/includes/languages' );



//-----------------------------------  // Pagination //-----------------------------------//

function okay_page_has_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}



//-----------------------------------  // Add CPT To Archives //-----------------------------------//

add_filter( 'getarchives_where', 'cpt_getarchives_where' ); 
	function cpt_getarchives_where( $where ) { 
	return str_replace( "WHERE post_type = 'post'", "WHERE post_type IN 
	('post', 'okay-portfolio')", $where ); 
}



//-----------------------------------  // Customizer & Background Support //-----------------------------------//

require_once(dirname(__FILE__) . "/customizer.php");
add_theme_support( 'custom-background' );



//-----------------------------------  // Portfolio and Gallery Support //-----------------------------------//

function okay_theme_setup(){
	add_theme_support('okay_themes_portfolio_support');
	add_theme_support('okay_themes_gallery_support');
}
add_action('after_setup_theme', 'okay_theme_setup');



//-----------------------------------  // Add Quote Post Format //-----------------------------------//

add_theme_support('post-formats', array( 'gallery'));


//-----------------------------------  // Add Customizer To Menu //-----------------------------------//

function okay_customizer_admin() {
	add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' ); 
}
add_action ('admin_menu', 'okay_customizer_admin');



//-----------------------------------  // Excerpt Read More Link //-----------------------------------//

function new_excerpt_more( $more ) {
	return ' ... ';
}
add_filter('excerpt_more', 'new_excerpt_more');



//-----------------------------------  // Editor Styles //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/editor/add-styles.php");



//-----------------------------------  // Auto Feed Links //-----------------------------------//

add_theme_support( 'automatic-feed-links' );



//-----------------------------------  // Add Menus //-----------------------------------//

add_theme_support( 'menus' );
register_nav_menu('main', 'Main Menu');
register_nav_menu('custom', 'Custom Menu');



//-----------------------------------  // Thumbnail Sizes //-----------------------------------//

add_theme_support('post-thumbnails');
add_image_size( 'large-image', 9999, 9999, false ); // Large Post Image
add_image_size( 'home-image', 790, 790, true ); // Home Thumb Image

if ( ! isset( $content_width ) ) $content_width = 690;



//-----------------------------------  // Register Widget Areas //-----------------------------------//

if ( function_exists('register_sidebars') )

register_sidebar(array(
	'name' => 'Sidebar Widgets',
	'description' => 'Widgets in this area will be shown in the sidebar.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>'
));



//-----------------------------------  // Custom Comment Output //-----------------------------------//

function okay_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">	
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>
					
					<div class="comment-meta commentmetadata">
						<?php printf(__('<cite class="fn">%s</cite>', 'okay'), get_comment_author_link()) ?>
						<div style="clear:both;"></div>
						<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'okay'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'okay'),'  ','') ?>
					</div>
				</div>
			<div class="clearfix"></div>
			</div>
			
			<div class="comment-text">
				<?php comment_text() ?>
				<p class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</p>
			</div>
		
			<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'okay') ?></em>
			<?php endif; ?>    
		</div>
<?php
}



//-----------------------------------  // Custom Comment Form Fields //-----------------------------------//

function okay_alter_comment_form_fields($fields){

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Your Name *', 'okay' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="Your Name *" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
                    
    $fields['email'] = '<p class="comment-form-email">' . '<label for="email">' . __( 'Your Email *', 'okay' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="email" name="email" type="text" placeholder="Your Email *" value="' . esc_attr( $commenter['comment_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url">' . '<label for="url">' . __( 'Your Website', 'okay' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="url" name="url" type="text" placeholder="Your Website" value="' . esc_attr( $commenter['comment_url'] ) . '" size="30"' . $aria_req . ' /></p>';

    return $fields;
}
add_filter('comment_form_default_fields','okay_alter_comment_form_fields');


function okay_cancel_comment_reply_button($html, $link, $text) {
    $style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
    $button = '<div id="cancel-comment-reply-link"' . $style . '>';
    return $button . '<i class="icon-remove-sign"></i> </div>';
}
 
add_action('cancel_comment_reply_link', 'okay_cancel_comment_reply_button', 10, 3);



//-----------------------------------  // Check for Okay Toolkit Notice //-----------------------------------//

if ( !function_exists('okaysocial_init') ) {
	
	add_action('admin_notices', 'okay_toolkit_notice');
	function okay_toolkit_notice() {
	    global $current_user ;
	    $user_id = $current_user->ID;
	    
	    $adminurl = admin_url('plugin-install.php?tab=plugin-information&plugin=okay-toolkit&TB_iframe=true&width=640&height=589');
	    
	    if ( ! get_user_meta($user_id, 'okay_toolkit_ignore_notice') ) { 
	        echo '<div class="updated"><p>';

	        echo 'This theme supports the Okay Toolkit! Install it to extend the features of your theme. ';
	        
	        echo '<a class="thickbox onclick" href=" ' . $adminurl . ' ">Install Now</a> | ';
	        
	        printf(__('<a href="%1$s">Hide Notice</a>'), '?okay_toolkit_nag_ignore=0');
	        
	        echo "</p></div>";
	    }
	}
	
	add_action('admin_init', 'okay_toolkit_nag_ignore');
	function okay_toolkit_nag_ignore() {
	    global $current_user;
	        $user_id = $current_user->ID;
	        /* If user clicks to ignore the notice, add that to their user meta */
	        if ( isset($_GET['okay_toolkit_nag_ignore']) && '0' == $_GET['okay_toolkit_nag_ignore'] ) {
	             add_user_meta($user_id, 'okay_toolkit_ignore_notice', 'true', true);
	    }
	}
}