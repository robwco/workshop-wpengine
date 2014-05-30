<?php

/* ---------------------------------------------------------------------- */
/*	Team
/* ---------------------------------------------------------------------- */

// Register Custom Post Type: 'Team'
function radium_register_post_type_team() {

	$labels = array(
		'name'               => __( 'Team', 'radium' ),
		'singular_name'      => __( 'Member', 'radium' ),
		'add_new'            => __( 'Add New', 'radium' ),
		'add_new_item'       => __( 'Add a New Team Member', 'radium' ),
		'edit_item'          => __( 'Edit Member', 'radium' ),
		'new_item'           => __( 'New Member', 'radium' ),
		'view_item'          => __( 'View Member', 'radium' ),
		'search_items'       => __( 'Search Members', 'radium' ),
		'not_found'          => __( 'No members found', 'radium' ),
		'not_found_in_trash' => __( 'No members found in Trash', 'radium' ),
		'parent_item_colon'  => __( 'Parent Member:', 'radium' ),
		'menu_name'          => __( 'Team', 'radium' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array(''),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'team-member' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		
	);

	register_post_type( 'team', $args );

} 
add_action('init', 'radium_register_post_type_team');

// Custom columns for 'Team'
function radium_edit_team_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'team-photo'   => __( 'Photo', 'radium' ),
		'title'       => __( 'Name', 'radium' ),
		'job_title'   => __( 'Job Title', 'radium' ),
		'description' => __( 'Description', 'radium' ),
		//'shortcode'   => __( 'Shortcode', 'radium' )
	);

	return $columns;

}
add_action('manage_edit-team_columns', 'radium_edit_team_columns');

// Custom columns content for 'Team'
function radium_manage_team_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'team-photo':
			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';
			break;

		case 'job_title':
			echo radium_get_custom_field( '_radium_job_title', $post_id );
			break;

		case 'description':
			echo get_the_excerpt();
			break;

		//case 'shortcode':
		//	echo '<span class="shortcode-field">[team_member id="'. $post->post_name . '"]</span>';
		//	break;
		
		default:
			break;
	}

}
add_action('manage_team_posts_custom_column', 'radium_manage_team_columns', 10, 2);

// Sortable custom columns for 'Team'
function radium_sortable_team_columns( $columns ) {

	$columns['job_title'] = 'job_title';

	return $columns;

}
add_action('manage_edit-team_sortable_columns', 'radium_sortable_team_columns');

// Add styles for custom column page
function radium_add_column_custom_styles() {

	$screen = get_current_screen();

	if( $screen->post_type == 'slider' || $screen->post_type == 'team' )
		echo '<style> #posts-filter .column-shortcode .shortcode-field { background: #fafafa; border: 1px solid #e6e6e6; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; display: inline-block; padding: 2px 5px; }</style>';

	if( $screen->post_type == 'team' )
		echo '<style> #posts-filter .column-thumbnail { width: 8%; }</style>';

}
add_action('admin_head', 'radium_add_column_custom_styles');

/* Enable Sorting of the Team ------------------------------------------*/

add_action('admin_menu', 'radium_create_team_sort_page');

function radium_create_team_sort_page() {
    $radium_sort_page = add_submenu_page('edit.php?post_type=team', 'Sort Members', __('Sort', 'radium'), 'edit_posts', basename(__FILE__), 'radium_team_sort');
    
    add_action('admin_print_styles-' . $radium_sort_page, 'radium_print_teams_sort_styles');
    add_action('admin_print_scripts-' . $radium_sort_page, 'radium_print_teams_sort_scripts');
}

function radium_team_sort() {
    $teams = new WP_Query('post_type=team&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Sort Members', 'radium'); ?></h2>
        <p><?php _e('Click, drag, re-order. Repeat as necessary. Member at the top will appear first.', 'radium'); ?></p>

        <ul id="team_list">
            <?php while( $teams->have_posts() ) : $teams->the_post(); ?>
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

add_action('wp_ajax_team_sort', 'radium_save_team_sorted_order');

function radium_save_team_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $team_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $team_id));
        $counter++;
    }
    die(1);
}

function radium_print_teams_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('radium_team_sort', RADIUM_CPT_URL . '/teams/js/radium_team_sort.js');
}

function radium_print_teams_sort_styles() {
    wp_enqueue_style('nav-menu');
}


/* Add Team count to "Right Now" Dashboard Widget --------------------------*/
add_action( 'right_now_content_table_end', 'radium_add_team_counts' );

 function radium_add_team_counts() {
        if ( ! post_type_exists( 'team' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'team' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Team Member', 'Team Members', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=team'>$num</a>";
            $text = "<a href='edit.php?post_type=team'>$text</a>";
        }
        echo '<td class="first b b-team">' . $num . '</td>';
        echo '<td class="t team">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Team Member Pending', 'Team Members Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=team'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=team'>$text</a>";
            }
            echo '<td class="first b b-team">' . $num . '</td>';
            echo '<td class="t team">' . $text . '</td>';

            echo '</tr>';
        }
}

/* Add Custom Icon for Dashboard -------------------------------------------*/
add_action('admin_head', 'plugin_header');

function plugin_header() {
    global $post_type;
    ?>
    <style>
    #adminmenu #menu-posts-team div.wp-menu-image {
    	background:transparent url("<?php echo RADIUM_CPT_URL . '/teams/images/icon-team.png';?>") no-repeat 6px -18px !important;    
		}
		
    #adminmenu #menu-posts-team:hover div.wp-menu-image,
    #adminmenu #menu-posts-team.wp-has-current-submenu div.wp-menu-image { 
    	background:transparent url("<?php echo RADIUM_CPT_URL . '/teams/images/icon-team.png';?>") no-repeat 6px 6px !important;
    	}  
	
	@media all and (-webkit-min-device-pixel-ratio: 1.5) {
		#adminmenu #menu-posts-team div.wp-menu-image{
			background:transparent url("<?php echo RADIUM_CPT_URL .'/teams/images/icon-team@2x.png';?>") no-repeat 6px -17px !important; 
			background-size: 16px 40px!important;   
			}
		#adminmenu #menu-posts-team:hover div.wp-menu-image,
		#adminmenu #menu-posts-team.wp-has-current-submenu div.wp-menu-image {
			background:transparent url("<?php echo RADIUM_CPT_URL .'/teams/images/icon-team@2x.png';?>") no-repeat 6px 7px !important;
			background-size: 16px 40px!important;  
			}  
	
	</style>
<?php
}