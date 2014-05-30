<?php

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Slider
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slider-slides-settings',
	'title'    => __('Slides', 'radium'),
	'pages'    => array('slider'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('The Slides', 'radium'),
			'id'   => $prefix . 'slider_slides',
			'type' => 'slider_slides',
			'std'  => '',
			'desc' => ''
		)
	)
);

$arg = array(
		array(
			'name'    => __('Select your Slider:', 'radium'),
			'id'      => $prefix . 'slider_type',
			'type'    => 'select',
			'std'     => 'flexslider',
			'desc'    => '',
			'options' => array(
				'accordion' 		=> 'Accordion',
				'content-carousel' 	=> 'Content-Carousel',
				'featured-content' 	=> 'Featured-Content',
				'flexslider' 		=> 'Flexslider',
				'metroslider' 		=> 'MetroSlider',
				'nivoslider'		=> 'Nivoslider',
				'radiumflex' 		=> 'Radiumflex',
				'refineslide' 		=> 'RefineSlide',
			)
	),
	
/*	 Content Carousel
--------------------------------------------------------------------- */
	array(
		'name'		=> 'Content Type',
		'id'		=> $prefix . 'content_carousel_pt',
		'type'		=> 'checkbox_list',
		'options'	=> array(
			'post'			=> 'Posts',
			'portfolio'		=> 'Portfolio',
			'gallery'		=> 'Gallery',
		),
		'std' => array(
			'1'     => 'post', 
			'0' 	=> 'portfolio', 
			'0'   	=> 'gallery'
		),
		'desc'		=> ''
	),

/*	Flexslider */
/* ---------------------------------------------------------------------- */
		array(
			'name'    => __('Transition:', 'radium'),
			'id'      => $prefix . 'slider_transition',
			'type'    => 'select',
			'std'     => 'slide-horizontal',
			'desc'    => '',
			'options' => array(
				'fade' => 'Fade',
				'slide-horizontal' => 'Slide-Horizontal',
				'slide-vertical' => 'Slide-Vertical',
				)
		),
		
		array(
			'name' => __('Hover Pause:', 'radium'),
			'id'   => $prefix . 'slider_pause_on_hover',
			'type' => 'checkbox',
			'std'  => 1,
			'desc' => 'Yes, pause on mouseover.'
		),
		
		 array(
		 	'name' => __('Display Controls:', 'radium'),
		 	'id'   => $prefix . 'slider_controls',
		 	'type' => 'checkbox',
		 	'std'  => 1,
		 	'desc' => 'Yes, show directional arrows.'
		),
		
		array(
			'name' => __('Slideshow Speed (ms):', 'radium'),
			'id'   => $prefix . 'slidershow_speed',
			'type' => 'text',
			'std'  => '6000',
			'desc' => ''
		),
		
		array(
			'name' => __('Transition Speed (ms):', 'radium'),
			'id'   => $prefix . 'slideranimation_speed',
			'type' => 'text',
			'std'  => '1000',
			'desc' => ''
		),
		
		
		/*array(
			'name' => __('Hide content box', 'radium'),
			'id'   => $prefix . 'slider_hide_content',
			'type' => 'checkbox',
			'std'  => 0,
			'desc' => ''
		), */
		
		/*array(
			'name' => __('Autoplay', 'radium'),
			'id'   => $prefix . 'slider_autoplay',
			'type' => 'checkbox',
			'std'  => 1,
			'desc' => 'Yes'
		), */
		
	
/*	 RefineSlider
--------------------------------------------------------------------- */
	array(
		'name'    => __('Transition:', 'radium'),
		'id'      => $prefix . 'refineslider_transition',
		'type'    => 'select',
		'std'     => 'random',
		'desc'    => '',
		'options' => array(
		    'fade' => 'Fade',
		    'cubeH'=>'CubeH',
		    'cubeV'=>'CubeV',
		    'sliceV'=>'SliceV',
		    'sliceH'=>'SliceH',
		    'slideH'=>'SlideH',
		    'slideV'=>'SlideV',
		    'scale'=>'Scale',
		    'blockscale' => 'BlockScale',
		    'kaleidoscope' => 'Kaleidoscope',
		    'fan' => 'Fan',
		    'blindH' => 'blindH',
		    'blindV' => 'BlindV',
		    'random' => 'Random',
		    
		)
	),

	array(
		'name'    => __('Choose Slider Control:', 'radium'),
		'id'      => $prefix . 'refineslider_controls',
		'type'    => 'select',
		'std'     => 'thumbs',
		'desc'    => '',
		'options' => array(
			'arrows' => 'Arrows',
			'thumbs' => 'Thumbs',
			'none' => 'None',
			)
	),
	
/*	 Nivoslider
--------------------------------------------------------------------- */
	array(
		'name'    => __('Transition', 'radium'),
		'id'      => $prefix . 'nivoslider_transition',
		'type'    => 'select',
		'std'     => 'random',
		'desc'    => '',
		'options' => array(
			'boxRandom' 			=> 'BoxRandom',
			'boxRain' 				=> 'BoxRain',
			'boxRainReverse' 		=> 'BoxRainReverse',
			'boxRainGrow' 			=> 'BoxRainGrow',
			'boxRainGrowReverse'	=> 'BoxRainGrowReverse',
		    'fade' 					=> 'Fade',
		    'fold'					=> 'Fold',
			'sliceDownRight'		=> 'SliceDownRight',
		    'sliceDownLeft'			=> 'SliceDownLeft',
		    'sliceUpRight'			=> 'SliceUpRight',
		    'sliceUpLeft'			=> 'SliceUpLeft',
		    'sliceUpDown'			=> 'SliceUpDown',
		    'sliceUpDownLeft'		=> 'SliceUpDownLeft',
		    'random' 				=> 'Random',
		) 
	),
		
	array(
		'name' => __('Slideshow Speed', 'radium'),
		'id'   => $prefix . 'nivoslidershow_speed',
		'type' => 'text',
		'std'  => '500',
		'desc' => 'In milliseconds.'
	),
	
	array(
		'name' => __('Slider Animation Speed', 'radium'),
		'id'   => $prefix . 'nivoslideranimation_speed',
		'type' => 'text',
		'std'  => '3000',
		'desc' => 'In milliseconds.'
	),

/*	 General
--------------------------------------------------------------------- */
	
	array(
		'name' => __('Container Height:', 'radium'),
		'id'   => $prefix . 'slider_height',
		'type' => 'text',
		'std'  => '400',
		'desc' => ''
	),
	
	array(
		'name' => __('Container Width:', 'radium'),
		'id'   => $prefix . 'slider_width',
		'type' => 'text',
		'std'  => '940',
		'desc' => ''
	), 
	
);

$meta_boxes[] = array(
	'id'       => 'slider-settings',
	'title'    => __('General Settings', 'radium'),
	'pages'    => array('slider'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => apply_filters( 'radium_slider_setting_metaboxes', $arg )
);
	