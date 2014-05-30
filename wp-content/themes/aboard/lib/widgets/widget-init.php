<?php 

$options 	= get_option('radium_theme');

/*--------------------------------------------------------------------*/
/*	REGISTER WIDGET AREAS 
/*--------------------------------------------------------------------*/
if ( function_exists('register_sidebar') ) {
    $allWidgetizedAreas = 
        array(
        		__( 'Sidebar', 'radium' ),
                __( 'Footer Full', 'radium' ), 
                __( 'Footer Left', 'radium' ), 
                __( 'Footer Right', 'radium' ), 
                __( 'Footer Bottom', 'radium' ), 
                  
            );
            
    foreach ($allWidgetizedAreas as $WidgetAreaName) {
        register_sidebar(array(
           'name'=> $WidgetAreaName,
           'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
           'after_widget' => '</div>',
           'before_title' => '<h3 class="widget-title"><span>',
           'after_title' => '</span></h3>',
        ));
    }
    
    
	// Footer widgetized area
	$footer_widget_count = null;
	$footer_widget_left_count = null;
	$footer_widget_right_count = null;
	$footer_layout = null;
 	
	if(isset($options['footer_layout']))
		$footer_layout = $options['footer_layout'];
	
	if ( $footer_layout == '50-25-25' ) {
				
		$footer_widget_left_count = 1;
		$footer_widget_right_count = 2; 
		 
		/* Dynamic Widget Areas */    
		for($i = 1; $i<= $footer_widget_left_count; $i++) {
		
			register_sidebar(array(
				'name' => __('Footer Widgets Left', 'radium'),
				'before_widget' => '<div class="footer_widget %2$s">',
				'after_widget' => '</div><!-- END "div.footer_widget" -->',
				'before_title' => '<h2>',
				'after_title' => '</h2>',
			));
		}
		
		/* Dynamic Widget Areas */    
		for($i = 1; $i<= $footer_widget_right_count; $i++) {
		
			register_sidebar(array(
				'name' => __('Footer Widget Right '.$i, 'radium'),
				'before_widget' => '<div class="footer_widget %2$s">',
				'after_widget' => '</div><!-- END "div.footer_widget" -->',
				'before_title' => '<h2>',
				'after_title' => '</h2>',
			));
		}
		 
	} else {
			
			if ( $footer_layout == '100' ) { 
			
				$footer_widget_count = 1; 
				
			} elseif ( $footer_layout == '50-50' ) { 
			
				$footer_widget_count = 2; 
				
			} elseif ($footer_layout == '33-33-33' ) {
						 					
				$footer_widget_count = 3; 
				
			} elseif ($footer_layout == '25-25-25-25' ) {
						 					
				$footer_widget_count = 4; 
				
			}	
			 
			 /* Dynamic Widget Areas */    
		     for($i = 1; $i<= $footer_widget_count; $i++) {
		 
		         register_sidebar(array(
		             'name' => __('Footer Widgets '.$i, 'radium'),
		             'before_widget' => '<div class="footer_widget %2$s">',
		             'after_widget' => '</div><!-- END "div.footer_widget" -->',
		             'before_title' => '<h2>',
		             'after_title' => '</h2>',
		         ));
		     }
	} 
	
	
}

/**
 * @uses unregister_widget() Unregisters a registered widget.
 * @link http://codex.wordpress.org/Function_Reference/unregister_widget
 */
function radium_unregister_widgets() {
	/* Unregister the default WordPress widgets. */
	unregister_widget( 'WP_Widget_Recent_Posts' ); //We replaced this with more specific 
}
/* Unregister WP widgets. */
add_action( 'widgets_init', 'radium_unregister_widgets' );
?>