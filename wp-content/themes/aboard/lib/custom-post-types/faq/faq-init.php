<?php

/*-----------------------------------------------------------------------------------
 	Add FAQ Post Type
 -----------------------------------------------------------------------------------*/

/* Create the FAQ Custom Post Type ------------------------------------------*/
add_action( 'init', 'radium_create_post_type_faq' );

function radium_create_post_type_faq(){
	
	// Create FAQ Post Type
	$labels = array(
		'name' => __( 'FAQs', 'radium' ),
		'singular_name' => __( 'FAQ', 'radium'),
		'add_new' => _x( 'Add New', 'FAQ', 'radium' ),
		'all_items' => __( 'All FAQs', 'radium' ),
		'add_new_item' => __( 'Add New FAQ', 'radium' ),
		'edit_item' => __( 'Edit FAQ', 'radium' ),
		'new_item' => __( 'New FAQ', 'radium' ),
		'view_item' => __( 'View FAQ', 'radium' ),
		'search_items' => __( 'Search FAQs', 'radium' ),
		'not_found' => __( 'No FAQs found', 'radium' ),
		'not_found_in_trash'=> __( 'No FAQs found in Trash', 'radium' )
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'menu_position' => null,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'faqs' ),
		'supports' => array('title','editor'/*,'thumbnail','custom-fields', 'page-attributes', 'excerpt', 'revisions', 'comments' */),
		'has_archive' => true,
		'show_in_nav_menus'	=> true,
		'rewrite' => array('slug' => 'faq'),
		'taxonomies' => array( 'faq_category' )
	);
	
	register_post_type(__( 'faq', 'radium'),$args);
	
}
/* Create the FAQ Group Taxonomy --------------------------------------------*/
add_action( 'init', 'radium_build_faq_taxonomies', 0 );

function radium_build_faq_taxonomies(){
    $labels = array(
        'name' =>	__( 'FAQ Groups', 'radium' ),
        'singular_name' =>	__( 'FAQ Group', 'radium' ),
        'search_items' =>	__( 'Search FAQ Groups', 'radium' ),
        'popular_items' =>	__( 'Popular FAQ Groups', 'radium' ),
        'all_items' =>	__( 'All FAQ Groups', 'radium' ),
        'parent_item' =>	__( 'Parent FAQ Group', 'radium' ),
        'parent_item_colon'	=>	__( 'Parent FAQ Group:', 'radium' ),
        'edit_item' =>	__( 'Edit FAQ Group', 'radium' ),
        'update_item' =>	__( 'Update FAQ Group', 'radium' ),
        'add_new_item' =>	__( 'Add new FAQ Group', 'radium' ),
    );
    
	register_taxonomy('faq_category', 'faq', array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array( 'slug' => 'faq_topics', 'hierarchical' => true )
	));

	// Add image sizes based on arguments
	$image_sizes = !empty( $args['image_sizes'] ) ? $args['image_sizes'] : null;
	if( $image_sizes ) {
		foreach( $image_sizes as $size ) {
			add_image_size( $size['name'], $size['width'], $size['height'], $size['crop'] );
		}
	}

}


/* Enable Sorting of the FAQ Groups------------------------------------------*/

add_action('admin_menu', 'radium_create_faq_sort_page');

function radium_create_faq_sort_page() {
    $radium_sort_page = add_submenu_page('edit.php?post_type=faq', __('Sort', 'radium'), __('Sort', 'radium'), 'edit_posts', basename(__FILE__), 'radium_faq_sort');
    
    add_action('admin_print_styles-' . $radium_sort_page, 'radium_print_sort_faq_styles');
    add_action('admin_print_scripts-' . $radium_sort_page, 'radium_print_sort_faq_scripts');
}

function radium_print_sort_faq_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('radium_faq_sort', RADIUM_CPT_URL . '/faq/js/radium_faq_sort.js');
}

function radium_print_sort_faq_styles() {
    wp_enqueue_style('nav-menu');
}

function radium_faq_sort() {
    $faqs = new WP_Query('post_type=faq&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Sort FAQs', 'radium'); ?></h2>
        <p><?php _e('Click, drag, re-order. Repeat as necessary. FAQ at the top will appear first.', 'radium'); ?></p>

        <ul id="faq_list">
            <?php while( $faqs->have_posts() ) : $faqs->the_post(); ?>
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="menu-item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php }

add_action('wp_ajax_faq_sort', 'radium_save_faq_sorted_order');

function radium_save_faq_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $faq_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $faq_id));
        $counter++;
    }
    die(1);
}


/* Add Custom Columns ------------------------------------------------------*/
add_filter("manage_edit-faq_columns", "radium_faq_edit_columns");  

function radium_faq_edit_columns($columns){  

    $columns = array(  
        "cb" => "<input type=\"checkbox\" />",  
        "title" => __( 'FAQ Item Title', 'radium' ),
        "type" => __( 'FAQ Group', 'radium' ),
		"author" => __('Author', 'radium'),
		"date" => __('Date', 'radium'),
    );  

    return $columns;  
}  

add_action( 'manage_posts_custom_column',  'radium_faq_custom_columns', 10, 2 );

function radium_faq_custom_columns($faq_columns, $post_id){

	switch ( $faq_columns )	{
 
		case __( 'type', 'radium' ):  
		    echo get_the_term_list($post_id, __( 'faq_category', 'radium' ), '', ', ','');  
	    break;
	}
}


/* Add FAQ count to "Right Now" Dashboard Widget --------------------------*/
add_action( 'right_now_content_table_end', 'radium_add_faq_counts' );

function radium_add_faq_counts() {
        if ( ! post_type_exists( 'faq' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'faq' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'FAQ Item', 'FAQ Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=faq'>$num</a>";
            $text = "<a href='edit.php?post_type=faq'>$text</a>";
        }
        echo '<td class="first b b-faq">' . $num . '</td>';
        echo '<td class="t faq">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'FAQ Item Pending', 'FAQ Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=faq'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=faq'>$text</a>";
            }
            echo '<td class="first b b-faq">' . $num . '</td>';
            echo '<td class="t faq">' . $text . '</td>';

            echo '</tr>';
        }
}


/**
 * Overrides the default behavior of faq taxonomies to use the archive-faq template
 * http://www.billerickson.net/reusing-wordpress-theme-files/
 */
add_filter( 'template_include', 'radium_faq_template_chooser' );
 
function radium_faq_template_chooser( $template ) {
	if ( is_tax( 'faq_category' ) )
		$template = get_query_template( 'archive-faq' );
	return $template;
}

?>