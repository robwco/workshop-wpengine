<?php

class ZTLCustomPostTypes {
	public static function setup() {
		if (ZTL_ENABLE_LANDING_PAGES) {
			self::addLandingPageType();
		}
	}

	public static function addLandingPageType() {
		$labels = array(
			'name' => _x( 'Landing Pages', 'ztl_landing_page' ),
			'singular_name' => _x( 'Landing Page', 'ztl_landing_page' ),
			'add_new' => _x( 'Add New', 'ztl_landing_page' ),
			'add_new_item' => _x( 'Add New Landing Page', 'ztl_landing_page' ),
			'edit_item' => _x( 'Edit Landing Page', 'ztl_landing_page' ),
			'new_item' => _x( 'New Landing Page', 'ztl_landing_page' ),
			'view_item' => _x( 'View Landing Page', 'ztl_landing_page' ),
			'search_items' => _x( 'Search Landing Pages', 'ztl_landing_page' ),
			'not_found' => _x( 'No landing pages found', 'ztl_landing_page' ),
			'not_found_in_trash' => _x( 'No landing pages found in Trash', 'ztl_landing_page' ),
			'parent_item_colon' => _x( 'Parent Landing Page:', 'ztl_landing_page' ),
			'menu_name' => _x( 'Landing Pages', 'ztl_landing_page' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Zero to launch landing pages.',
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
			'taxonomies' => array( 'category', 'post_tag', 'page-category' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,


			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array('slug' => 'l'),
			'capability_type' => 'post'
		);

		register_post_type( 'ztl_landing_page', $args );
	}
}