<?php

/* ---------------------------------------------------------------------- */
/*	General / Global Metaboxes
/* ---------------------------------------------------------------------- */

$arg = array( 
	
	array('name' => __('Subtitle:', 'radium'),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	),	 
	 
);

$meta_boxes[] = array(
	'id'       => 'general-settings',
	'title'    => __('General Settings', 'radium'),
	'pages'    => array('post', 'portfolio', 'gallery'),
	'context'  => 'normal',
	'priority' => 'default',
	'fields' =>  apply_filters( 'radium_general_metaboxes', $arg )
);