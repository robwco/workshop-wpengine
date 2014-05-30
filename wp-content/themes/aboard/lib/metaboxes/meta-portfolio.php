<?php

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Portfolio
/* ---------------------------------------------------------------------- */ 
$meta_boxes[] = array(
	'id' => 'portfolio',
	'title' =>  __('Portfolio Detail Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
    	array(
			'name' =>  __('Portfolio Type:', 'radium'),
			'id' => $prefix . 'portfolio_type',
			"type" => "select",
			'std' => 'Image',
			'options' => array(
				'image' =>'Image', 
				'slideshow' =>'Slideshow', 
				'video' =>'Video', 
				'audio' =>'Audio'
 			)
		),
    	array(
    	   'name' => __('Client:', 'radium'),
    	   'id' => $prefix . 'portfolio_client',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Project URL:', 'radium'),
    	   'id' => $prefix . 'portfolio_url',
    	   'type' => 'text',
    	   'std' => 'http://www.'
    	)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio-images',
	'title' => __('Image Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
		array( "name" => 'Gallery Images',
				"desc" => '	Click "Upload New" and once uploaded, click "Insert into Post".',
				"id" => $prefix . "portfolio_upload_images",
				"type" => 'gallery',
 			)
    )
);
 
$meta_boxes[] = array(
	'id' => 'portfolio-video',
	'title' => __('Video Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
		
		/*
		array( "name" => __('Video Height','radium'),
				"desc" => __('The video height (e.g. 390).','radium'),
				"id" => $prefix . "video_height",
				"type" => "text",
				'std' => ''
			), */
			
		array( "name" => __('M4V File URL','radium'),
				"desc" => __('The URL to the .m4v video file','radium'),
				"id" => $prefix . "video_m4v",
				"type" => "text",
				'std' => ''
			),
		array( "name" => __('OGV File URL','radium'),
				"desc" => __('The URL to the .ogv video file','radium'),
				"id" => $prefix . "video_ogv",
				"type" => "text",
				'std' => ''
			),
			
		/*	
		array( "name" => __('Poster Image','radium'),
				"desc" => __('The preview image. (It is only displayed on self hosted videos)','radium'),
				"id" => $prefix . "video_poster",
				"type" => "text",
				'std' => ''
			),
			
		*/
			
		array(
			'name' => __('Embedded Code', 'radium'),
			'desc' => __('If you are using something other than a self hosted video such as YouTube or Vimeo, paste the embed code here. Width is best at 780px with any height.', 'radium'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
		)
	),
	
);

$meta_boxes[] = array(
	'id' => 'portfolio-audio',
	'title' =>  __('Audio Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
		array( 
		    "name" => __('MP3 File URL','radium'),
				"desc" => __('The URL to the .mp3 audio file','radium'),
				"id" => $prefix."audio_mp3",
				"type" => "text",
				'std' => ''
		),
		array( 
		    "name" => __('OGA File URL','radium'),
				"desc" => __('The URL to the .oga, .ogg audio file','radium'),
				"id" => $prefix."audio_ogg",
				"type" => "text",
				'std' => ''
		),
		/*
		array(
		    'name' => __('Poster Image', 'radium'),
		    'desc' => __('The Preview Image for this audio track', 'radium'),
		    'id' => $prefix . 'audio_poster',
		    'type' => 'text',
		    'std' => ''
		),
		
		array(
		    'name' => __('Poster Image Height', 'radium'),
		    'desc' => __('The height of the poster image', 'radium'),
		    'id' => $prefix . 'poster_height',
		    'type' => 'text',
		    'std' => ''
		) */
	)
);



/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Portfolio
/* ---------------------------------------------------------------------- */ 
$meta_boxes[] = array(
	'id' => 'themes',
	'title' =>  __('Portfolio Detail Settings', 'radium'),
	'pages' => array('themes'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
    	array(
			'name' =>  __('Portfolio Type:', 'radium'),
			'desc' => __('Choose the type of portfolio you wish to display.', 'radium'),
			'id' => $prefix . 'portfolio_type',
			"type" => "select",
			'std' => 'Image',
			'options' => array(
				'image' =>'Image', 
				'slideshow' =>'Slideshow', 
				'video' =>'Video', 
				'audio' =>'Audio'
 			)
		),
    	array(
    	   'name' => __('Portfolio Client:', 'radium'),
    	   'id' => $prefix . 'portfolio_client',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Portfolio URL:', 'radium'),
    	   'id' => $prefix . 'portfolio_url',
    	   'type' => 'text',
    	   'std' => 'http://www.'
    	)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio-images',
	'title' => __('Image Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
'fields' => array(
	array( "name" => 'Gallery Images:',
			"desc" => '	Click "Upload New" and once uploaded, click "Insert into Post".',
			"id" => $prefix . "portfolio_upload_images",
			"type" => 'gallery',
			)
    )
);
 
$meta_boxes[] = array(
	'id' => 'portfolio-video',
	'title' => __('Video Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
		
		/*
		array( "name" => __('Video Height','radium'),
				"desc" => __('The video height (e.g. 390).','radium'),
				"id" => $prefix . "video_height",
				"type" => "text",
				'std' => ''
			), */
			
		array( "name" => __('M4V File URL:','radium'),
				"desc" => __('','radium'),
				"id" => $prefix . "video_m4v",
				"type" => "text",
				'std' => ''
			),
		array( "name" => __('OGV File URL:','radium'),
				"desc" => __('','radium'),
				"id" => $prefix . "video_ogv",
				"type" => "text",
				'std' => ''
			),
		array( "name" => __('Poster Image:','radium'),
				"desc" => __('','radium'),
				"id" => $prefix . "video_poster",
				"type" => "text",
				'std' => ''
			),
		array(
			'name' => __('Embed Code:', 'radium'),
			'desc' => __('If you are using something other than a self hosted video such as YouTube or Vimeo, paste the embed code here. Reccomended width is 780px, with any height.', 'radium'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
		)
	),
	
);

$meta_boxes[] = array(
	'id' => 'portfolio-audio',
	'title' =>  __('Audio Settings', 'radium'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	
	'fields' => array(
		array( 
		    "name" => __('MP3 File URL:','radium'),
				"desc" => __('','radium'),
				"id" => $prefix."audio_mp3",
				"type" => "text",
				'std' => ''
		),
		array( 
		    "name" => __('OGA File URL:','radium'),
				"desc" => __('','radium'),
				"id" => $prefix."audio_ogg",
				"type" => "text",
				'std' => ''
		),
		/*array(
		    'name' => __('Poster Image', 'radium'),
		    'desc' => __('The Preview Image for this audio track', 'radium'),
		    'id' => $prefix . 'audio_poster',
		    'type' => 'text',
		    'std' => ''
		),
		
		
		array(
		    'name' => __('Poster Image Height', 'radium'),
		    'desc' => __('The height of the poster image', 'radium'),
		    'id' => $prefix . 'poster_height',
		    'type' => 'text',
		    'std' => ''
		) */
	)
);