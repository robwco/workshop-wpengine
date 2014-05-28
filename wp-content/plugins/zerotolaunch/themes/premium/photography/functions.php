<?php
function crb_init_theme() {
	# Enqueue jQuery
	wp_enqueue_script('jquery');

	if (is_admin()) { /* Front end scripts and styles won't be included in admin area */
		return;
	}
	# Enqueue Custom Scripts
	wp_enqueue_script('responsiveImages', get_bloginfo('stylesheet_directory') . '/js/responsiveImages.js', array('jquery'));
	wp_enqueue_script('functions', get_bloginfo('stylesheet_directory') . '/js/functions.js', array('jquery'));

	# Enqueue Custom Styles
	wp_enqueue_style('google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300', '', '');
}

define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
add_action('init', 'crb_init_theme');
add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');

		# Theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('html5', array('search-form'));
		
		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		# Register Theme Menu Locations
		add_theme_support('menus');
		register_nav_menus(array(
			'main-menu'=>__('Main Menu'),
		));
		
		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach additional functions
		if( !function_exists('wpthumb') ) {
			include_once(CRB_THEME_DIR . 'lib/wpthumb/wpthumb.php');
		}
		
		# Add Actions
		add_action('widgets_init', 'crb_widgets_init');

		add_action('carbon_register_fields', 'crb_attach_theme_options');
		add_action('carbon_after_register_fields', 'crb_attach_theme_help');

		# Add Filters
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widgettitle">',
		'after_title' => '</h5>',
	));

	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widgettitle">',
		'after_title' => '</h5>',
	));
}

function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
}

function crb_attach_theme_help() {
	# Theme Help needs to be after options/theme-options.php
	include_once(CRB_THEME_DIR . 'lib/theme-help/theme-readme.php');
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'post-thumb', 200, 200, true );
    add_image_size( 'post-large', 600 );
}

# Shortcodes fixes
function mt_shortcode_fix_tags($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

# Get all categories and return an array with their ids
function mt_cats_array() {

	$cats = get_categories('hide_empty=0&exclude=1');
	$cats_ids = array('');

	foreach ($cats as $cat) {
		$cats_ids[$cat->term_id] = $cat->name;		
	}

	return $cats_ids;
}

# Return a basic yes/no array
function mt_switcher() {
	return array(
		'no' => 'No',
		'yes' => 'Yes'
	);
}

# Return an array with post IDs
function mt_get_cpt_ids($post_type) {

	$posts = get_posts('post_type='. $post_type .'&posts_per_page=-1');
	$post_ids = array('');

	foreach ($posts as $p) {
		$post_ids[$p->ID] = $p->post_title;
	}

	return $post_ids;
}

function mt_htmlize($text, $tag = 'span') {
	$htmlized = preg_replace('~\*([^*]*)\*~', '<' . $tag . '>$1</' . $tag . '>', $text);
	return $htmlized;
}

# Filter P tags
function mt_filter_ptags($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    // now pass that through and do the same for iframes...
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}

// TODO delete
function mt_get_forms() {
	return array();
}

// TODO delete or replace with actual ZTL form
function mt_render_form( $id, $ajax = false ) {}

function mt_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'mt_excerpt_more');

function mt_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'mt_excerpt_length', 999 );

# Add specific CSS class by filter
add_filter('body_class', 'mt_class_names');
function mt_class_names( $classes ) {
	
	if ( is_page_template( 'template-landing.php' ) ) {
		$classes[] = 'landing-page';
	} else if ( is_page_template( 'default' ) ) {
		$classes[] = 'fitness-page';
	}

	// return the $classes array
	return $classes;
}

add_action('wp_head', 'mt_custom_logo');
function mt_custom_logo() {

	if ( !get_option( 'website_logo' ) )
		return;

	$logo = get_option( 'website_logo' );

	?>

	<style type="text/css">
		.logo a { background: url( <?php echo $logo; ?> ) no-repeat scroll 0 0 rgba(0, 0, 0, 0); }
	</style>

	<?php
}

function mt_numeric_pagination() {

	global $wp_query, $wp_rewrite;  
	$pages = '';  
	$max = $wp_query->max_num_pages;  
	if (!$current = get_query_var('paged')) $current = 1;  
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));  
	$a['total'] = $max;  
	$a['current'] = $current;  
	
	$total = 1; //1 - display the text "Page N of N", 0 - not display  
	$a['mid_size'] = 5; //how many links to show on the left and right of the current  
	$a['end_size'] = 1; //how many links to show in the beginning and end  
	$a['prev_text'] = '&laquo; Previous'; //text of the "Previous page" link  
	$a['next_text'] = 'Next &raquo;'; //text of the "Next page" link  
	
	if ($max > 1) echo '<div class="pagination">';  
	if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";  
	echo $pages . paginate_links($a);  
	if ($max > 1) echo '</div>'; 

}
