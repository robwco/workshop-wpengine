<?php
/* ---------------------------------------------------------------------- */
/*	Page Post Type
/* ---------------------------------------------------------------------- */
$arg = array( 
 		
 		array('name' => __('Subtitle:', 'radium'),
 			'id'   => $prefix . 'subtitle',
 			'type' => 'text',
 		),
 	
	);

$meta_boxes[] = array(
	'id' => 'details',
	'title' => 'Page Settings',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => apply_filters( 'radium_page_setting_metaboxes', $arg )
);

	
/* ---------------------------------------------------------------------- */
/*	Page Sidebar
/* ---------------------------------------------------------------------- */
 $arg2 = array(	
		array(
			'name' =>__('Enable Portfolio Filter:','radium'),
			'desc' => __('Yes, please do.','radium'),
			'id'   => $prefix . 'cpt_sorting',
			'type' => 'checkbox',
			'std'  => '1',
		),
 		
		array(
			'name' => __('Posts per Page:', 'radium'),
			'id'   => $prefix . 'cpt_items_count',
			'type' => 'text',
			'std'  => '-1',
			'desc' => '(-1 for all posts)'
		)
	
);

$meta_boxes[] = array(
	'id'       => 'page-cpt-settings',
	'title'    => __('Template Settings', 'radium'),
	'pages'    => array('page'),
	'context'  => 'side',
	'priority' => 'high',
	'fields'   => apply_filters( 'radium_page_setting_metaboxes', $arg2 )
);
	