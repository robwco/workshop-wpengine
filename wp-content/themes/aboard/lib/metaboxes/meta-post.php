<?php
 
/* ---------------------------------------------------------------------- */
/*	Post Format: Link
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'radium-meta-box-link',
	'title' =>  __('Link Settings', 'radium'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Link URL:','radium'),
				"desc" => __('ex: www.themebeans.com','radium'),
				"id" => $prefix."link_url",
				"type" => "text",
				"std" => 'www.'
			),
	),
	
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Audio
/* ----------------------------------------------------------------------  */

$meta_boxes[] = array(
	'id' => 'radium-meta-box-audio',
	'title' =>  __('Audio Settings', 'radium'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('MP3 File URL','radium'),
				"desc" => __('The URL to the .mp3 audio file','radium'),
				"id" => $prefix."audio_mp3",
				"type" => "text",
				"std" => ''
			),
		array( "name" => __('OGA File URL','radium'),
				"desc" => __('The URL to the .oga, .ogg audio file','radium'),
				"id" => $prefix."audio_ogg",
				"type" => "text",
				"std" => ''
			),
		array( 
	        "name" => __('Audio Poster Image', 'radium'),
	        "desc" => __('If you would like a poster image for the audio', 'radium'),
	        "id" => $prefix . "audio_poster",
	        "type" => "text",
	        "std" => ''
	        ),
	        
	    /*    
	    array( 
	        "name" => __('Poster Image Height', 'radium'),
	        "desc" => __('If you are including a poster image, please indicate the height of the image. The Poster Image recommended size is 172px by 172px', 'radium'),
	        "id" => $prefix . "poster_height",
	        "type" => "text",
	        "std" => '172'
	        ) */
	),
	
	
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Video
/* ----------------------------------------------------------------------  */

$meta_boxes[] = array(
	'id' => 'radium-meta-box-video',
	'title' =>  __('Video Settings', 'radium'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('M4V File URL','radium'),
				"desc" => __('','radium'),
				"id" => $prefix."video_m4v",
				"type" => "text",
				"std" => ''
			),
		array( "name" => __('OGV File URL','radium'),
				"desc" => __('','radium'),
				"id" => $prefix."video_ogv",
				"type" => "text",
				"std" => ''
			),
		array( "name" => __('Poster Image','radium'),
				"desc" => __('','radium'),
				"id" => $prefix."video_poster",
				"type" => "text",
				"std" => ''
			),
		array( "name" => __('Embeded Code','radium'),
				"desc" => __('If you are re not using self hosted video then you can include embeded code here.','radium'),
				"id" => $prefix."video_embed",
				"type" => "textarea",
				"std" => ''
			),
	)
	
);