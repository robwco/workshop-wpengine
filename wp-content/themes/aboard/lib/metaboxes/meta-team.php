<?php

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Team
/* ---------------------------------------------------------------------- */
		
	$meta_boxes[] = array(
		'id'       => 'team-member-settings',
		'title'    => __('Team Member Settings', 'radium'),
		'pages'    => array('team'),
		'context'  => 'side',
		'priority' => 'default',
		'fields'   => array(
			array(
				'name' => __('Job Title:', 'radium'),
				'id'   => $prefix . 'job_title',
				'type' => 'text',
				'std'  => '',
				'desc' => ''
			),
			
			array(
				'name' => __('Twitter Username:', 'radium'),
				'id'   => $prefix . 'twitter_username',
				'type' => 'text',
				'std'  => '',
				'desc' => ''
			)
			
		)
	);