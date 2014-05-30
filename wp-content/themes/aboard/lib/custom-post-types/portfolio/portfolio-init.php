<?php

/*-----------------------------------------------------------------------------------
 	Add Portfolio Post Type
 -----------------------------------------------------------------------------------*/

/* Create the Portfolio Custom Post Type ------------------------------------------*/
add_action( 'init', 'radium_create_post_type_portfolio' );

function radium_create_post_type_portfolio() {

	$labels = array(
		'name' => __( 'Portfolio','radium'),
		'singular_name' => __( 'Portfolio','radium' ),
		'add_new' => __('Add New','radium'),
		'add_new_item' => __('Add New Portfolio','radium'),
		'edit_item' => __('Edit Portfolio','radium'),
		'new_item' => __('New Portfolio','radium'),
		'view_item' => __('View Portfolio','radium'),
		'search_items' => __('Search Portfolio','radium'),
		'not_found' =>  __('No portfolio found','radium'),
		'not_found_in_trash' => __('No portfolio found in Trash','radium'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields', 'page-attributes', 'excerpt', 'revisions', 'comments'),
		'rewrite' => array('slug' => 'portfolio')
	  ); 
	  
	  register_post_type(__( 'portfolio', 'radium'),$args);
}

/* Create the Portfolio Category Taxonomy --------------------------------------------*/
add_action( 'init', 'radium_build_portfolio_taxonomies', 0 );

function radium_build_portfolio_taxonomies(){

    $labels = array(
        'name' => __( 'Portfolio Category', 'radium' ),
        'singular_name' => __( 'Portfolio Category', 'radium' ),
        'search_items' =>  __( 'Search Portfolio Categories', 'radium' ),
        'popular_items' => __( 'Popular Portfolio Categories', 'radium' ),
        'all_items' => __( 'All Portfolio Categories', 'radium' ),
        'parent_item' => __( 'Parent Portfolio Category', 'radium' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'radium' ),
        'edit_item' => __( 'Edit Portfolio Category', 'radium' ), 
        'update_item' => __( 'Update Portfolio Category', 'radium' ),
        'add_new_item' => __( 'Add New Portfolio Category', 'radium' ),
        'new_item_name' => __( 'New Portfolio Category Name', 'radium' ),
        'separate_items_with_commas' => __( 'Separate portfolios categories with commas', 'radium' ),
        'add_or_remove_items' => __( 'Add or remove Portfolio Categories', 'radium' ),
        'choose_from_most_used' => __( 'Choose from the most used portfolio categories', 'radium' ),
        'menu_name' => __( 'Categories', 'radium' )
    );
    
	register_taxonomy('portfolio_category', 'portfolio', array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_nav_menus' => true,        
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio_category' )
	));


	/*  Register a taxonomy for Portfolio Tags ------------------------------------------*/
	
	$taxonomy_portfolio_tag_labels = array(
		'name' => __( 'Portfolio Tags', 'radium' ),
		'singular_name' => __( 'Portfolio Tag', 'radium' ),
		'search_items' => __( 'Search Portfolio Tags', 'radium' ),
		'popular_items' => __( 'Popular Portfolio Tags', 'radium' ),
		'all_items' => __( 'All Portfolio Tags', 'radium' ),
		'parent_item' => __( 'Parent Portfolio Tag', 'radium' ),
		'parent_item_colon' => __( 'Parent Portfolio Tag:', 'radium' ),
		'edit_item' => __( 'Edit Portfolio Tag', 'radium' ),
		'update_item' => __( 'Update Portfolio Tag', 'radium' ),
		'add_new_item' => __( 'Add New Portfolio Tag', 'radium' ),
		'new_item_name' => __( 'New Portfolio Tag Name', 'radium' ),
		'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'radium' ),
		'add_or_remove_items' => __( 'Add or remove portfolio tags', 'radium' ),
		'choose_from_most_used' => __( 'Choose from the most used portfolio tags', 'radium' ),
		'menu_name' => __( 'Tags', 'radium' )
	);
	
	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'portfolio_tag' ),
		'query_var' => true
	);
	
	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );

}


/* Enable Sorting of the Portfolio ------------------------------------------*/

add_action('admin_menu', 'radium_create_portfolio_sort_page');

function radium_create_portfolio_sort_page() {
    $radium_sort_page = add_submenu_page('edit.php?post_type=portfolio', __('Sort Portfolios', 'radium'), __('Sort', 'radium'), 'edit_posts', basename(__FILE__), 'radium_portfolio_sort');
    
    add_action('admin_print_styles-' . $radium_sort_page, 'radium_print_sort_styles');
    add_action('admin_print_scripts-' . $radium_sort_page, 'radium_print_sort_scripts');
}

function radium_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Sort Portfolio', 'radium'); ?></h2>
        <p><?php _e('Click, drag, re-order & repeat as necessary. The item at the top of the list will display first.', 'radium'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
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

add_action('wp_ajax_portfolio_sort', 'radium_save_portfolio_sorted_order');

function radium_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}

function radium_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('radium_portfolio_sort', RADIUM_CPT_URL . '/portfolio/js/radium_portfolio_sort.js');
}

function radium_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}


/* Add Custom Columns ------------------------------------------------------*/
add_filter("manage_edit-portfolio_columns", "radium_portfolio_edit_columns");  

function radium_portfolio_edit_columns($columns){  

    $columns = array(  
        "cb" => "<input type=\"checkbox\" />",  
        "title" => __( 'Portfolio Item Title', 'radium' ),
        "portfolio_thumbnail" => __('Thumbnail', 'radium'),
        "portfolio_category" => __( 'Category', 'radium' ),
        "portfolio_tag" => __('Tags', 'radium'),
		"author" => __('Author', 'radium'),
		"date" => __('Date', 'radium'),
    );  

    return $columns;  
}  

add_action( 'manage_posts_custom_column',  'radium_portfolio_custom_columns', 10, 2 );

function radium_portfolio_custom_columns($portfolio_columns, $post_id){

	switch ( $portfolio_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		case "portfolio_thumbnail":
			$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'radium');
			}
			break;	
			
			// Display the portfolio Category-Types in the column view
	
			case "portfolio_category":  
			    echo get_the_term_list($post_id, 'portfolio_category', '', ', ','');  
		    break;
		    
		    // Display the portfolio tags in the column view
		    case "portfolio_tag":
		    
		    if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
		    	echo $tag_list;
		    } else {
		    	echo __('None', 'radium');
		    }
		    break;			
		    
				
	}
}


/* Add Portfolio count to "Right Now" Dashboard Widget --------------------------*/
add_action( 'right_now_content_table_end', 'radium_add_portfolio_counts' );

 function radium_add_portfolio_counts() {
        if ( ! post_type_exists( 'portfolio' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'portfolio' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
        }
        echo '<td class="first b b-portfolio">' . $num . '</td>';
        echo '<td class="t portfolio">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
            }
            echo '<td class="first b b-portfolio">' . $num . '</td>';
            echo '<td class="t portfolio">' . $text . '</td>';

            echo '</tr>';
        }
}

/**
 * Overrides the default behavior of portfolio taxonomies to use the archive-portfolio template
 * http://www.billerickson.net/reusing-wordpress-theme-files/
 */
add_filter( 'template_include', 'radium_porfolio_template_chooser' );
 
function radium_porfolio_template_chooser( $template ) {
	if ( is_tax( 'portfolio_tag' ) ||  is_tax( 'portfolio_category' ) )
		$template = get_query_template( 'archive-portfolio' );
	return $template;
}


/* Add Custom Icon for Dashboard -------------------------------------------*/
add_action('admin_head', 'portfolio_header');

function portfolio_header() {
    global $post_type;
    ?>

<style>
 
    #adminmenu #menu-posts-portfolio div.wp-menu-image{
    	background:transparent url("<?php echo RADIUM_CPT_URL .'/portfolio/images/icon-portfolio.png';?>") no-repeat 6px -17px !important;    
		}
    #adminmenu #menu-posts-portfolio:hover div.wp-menu-image,
    #adminmenu #menu-posts-portfolio.wp-has-current-submenu div.wp-menu-image {
    	background:transparent url("<?php echo RADIUM_CPT_URL .'/portfolio/images/icon-portfolio.png';?>") no-repeat 6px 7px !important;
    	} 
    
    @media all and (-webkit-min-device-pixel-ratio: 1.5) {
		#adminmenu #menu-posts-portfolio div.wp-menu-image{
			background:transparent url("<?php echo RADIUM_CPT_URL .'/portfolio/images/icon-portfolio@2x.png';?>") no-repeat 6px -17px !important; 
			background-size: 16px 40px!important;   
			}
		#adminmenu #menu-posts-portfolio:hover div.wp-menu-image,
		#adminmenu #menu-posts-portfolio.wp-has-current-submenu div.wp-menu-image {
			background:transparent url("<?php echo RADIUM_CPT_URL .'/portfolio/images/icon-portfolio@2x.png';?>") no-repeat 6px 7px !important;
			background-size: 16px 40px!important;  
			}     
    }
</style>
<?php
}