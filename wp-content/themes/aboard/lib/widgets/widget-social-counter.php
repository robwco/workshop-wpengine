<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Footer Social Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays the footer social counter.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'radium_social_icons_widgets' );

// Register widget
function radium_social_icons_widgets() {
	register_widget( 'radium_Social_icons_Widget' );
}

// Widget class
class radium_social_icons_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function radium_Social_icons_Widget() {

	// Widget settings
	$widget_ops = array (
		'classname' => 'radium_Social_icons_Widget',
		'description' => __('A widget that displays the footer social counter.', 'radium')
	);

	// Widget control settings
	$control_ops = array (
		'width' => 200,
		'height' => 350,
		'id_base' => 'radium_social_icons_widget'
	);

	// Create the widget
	$this->WP_Widget( 'radium_social_icons_widget', __('Footer Social (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	
	//Profiles 
	$twitterprofile = $instance['twitterprofile'];
	$twitteraction = $instance['twitteraction'];
	$facebookpage = $instance['facebookpage'];
	$facebookaction = $instance['facebookaction'];
	$dribbbleprofile = $instance['dribbbleprofile'];
	$dribbbleaction = $instance['dribbbleaction'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	/* Display Widget */
	
	?>
		<div class="bean-social-counter">                      
		           	
            <ul class="social-links">				
				<?php if( $twitterprofile != '' ) : ?>
	                <li>
	                    <a href="http://twitter.com/<?php echo $twitterprofile; ?>" target="_blank"><?php echo $twitteraction; ?></a>	
	                    <span class="social-count">
	                    	<?php echo $this->do_twitter_followers_count($twitterprofile); ?>
	                    </span>
	                </li>
				<?php endif; ?>
                
                <?php if( $facebookpage != '' ) : ?>
	                <li>
	              		<a href="http://www.facebook.com/<?php echo $facebookpage; ?>" target="_blank">
	              			<?php echo $facebookaction; ?>
		                </a>
	                   	<span class="social-count">
	                   		 <?php echo $this->do_count_facebook_likes( $facebookpage ); ?>
	                   	</span> 
	                </li>
               	<?php endif; ?>

                <?php if( $dribbbleprofile != '' ) : ?>
	                 <li>
	                 	<a href="http://dribbble.com/<?php echo $dribbbleprofile; ?>" target="_blank"><?php echo $dribbbleaction; ?></a>	
	             		<span class="social-count">
	             			<?php echo $this->do_count_dribbbler( $dribbbleprofile ); ?>
	             		</span>
	                </li> 
                <?php endif; ?>
            
            </ul><!-- END .social-links -->
      	</div><!-- END .bean-social-counter -->
      
		
	<?php
	// After widget (defined by theme functions file)
	echo $after_widget;
	
}



/*----------------------------------------------------------------------------------*/
/*	Twitter API Function
/*-----------------------------------------------------------------------------------*/
function do_twitter_followers_count( $screen_name = 'radiumthemes' ) {
	$key = 'rm__twit_followers_count_' . $screen_name;

	// Let's see if we have a cached version
	$followers_count = get_transient($key);
	if ($followers_count !== false)
		return $followers_count;
	else
	{
		// If there's no cached version we ask Twitter
		$response = wp_remote_get("http://api.twitter.com/1/users/show.json?screen_name={$screen_name}");
		if (is_wp_error($response))
		{
			// In case Twitter is down we return the last successful count
			return get_option($key);
		}
		else
		{
			// If everything's okay, parse the body and json_decode it
			$json = json_decode(wp_remote_retrieve_body($response));
			$count = $json->followers_count;

			// Store the result in a transient, expires after 1 day
			// Also store it as the last successful using update_option
			set_transient($key, $count, 60*60*24);
			update_option($key, $count);
			return $count;
		}
	}
}


 /*--------------------------------------------------*/
 /* Facebook API Function
 /*--------------------------------------------------*/

function do_count_facebook_likes( $account ) {
		
	// check for cached version
	$key = 'rm_counter_facebook_' . $account;
	$cache = get_transient($key);
	
	if( $cache === false ) {
		
		$url = "https://graph.facebook.com/$account"; 
		$response 	= wp_remote_get( $url );
				
		if( is_wp_error( $response ) ) 
			return;
		
		$xml = wp_remote_retrieve_body( $response );
		
		if( is_wp_error( $xml ) )
			return;
				
		if( $response['response']['code'] == 200 ) {
			
			$json = json_decode( $xml );
			
			$followers = $json->likes;
					
			set_transient($key, $followers, 60*5);
			
		}
		
	}  else {
	
		$followers = $cache;
			
	}
	
	return $followers;
}
	 	
/*--------------------------------------------------*/
/* Dribble API Function
/*--------------------------------------------------*/

function do_count_dribbbler( $account ) {
		
	// check for cached version
	$key = 'rm_counter_dribbble_' . $account;
	$cache = get_transient($key);
	
	if( $cache === false ) {
		
		$url = "http://api.dribbble.com/$account"; 
		$response 	= wp_remote_get( $url );
				
		if( is_wp_error( $response ) ) 
			return;
		
		$xml = wp_remote_retrieve_body( $response );
		
		if( is_wp_error( $xml ) )
			return;
		
		if( $response['headers']['status'] == 200 ) {
			
			$json = json_decode( $xml );
			
			$followers = $json->followers_count;
			
			set_transient($key, $followers, 60*5);
			
		}
		
	}  else {
	
		$followers = $cache;
			
	}
	
	return $followers;
}
	

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );

	// No need to strip tags
	$instance['twitterprofile'] = $new_instance['twitterprofile'];
	$instance['twitteraction'] = $new_instance['twitteraction'];
	$instance['facebookpage'] = $new_instance['facebookpage'];
	$instance['facebookaction'] = $new_instance['facebookaction'];
	$instance['dribbbleprofile'] = $new_instance['dribbbleprofile'];
	$instance['dribbbleaction'] = $new_instance['dribbbleaction'];	
 	
	return $instance;
}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	
function form( $instance ) {

	// Set up some default widget settings
	
	$defaults = array(
		'twitteraction' => 'Tweets',
		'twitterprofile' => 'ThemeBeans',
		'facebookaction' => 'Facebook',
		'facebookpage' => 'ThemeBeans',
		'dribbbleaction' => 'Dribbble',
		'dribbbleprofile' => 'ThemeBeans',
	);
		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'twitteraction' ); ?>"><?php _e('<a href="http://www.twitter.com/themebeans">Twitter</a> Text:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitteraction' ); ?>" name="<?php echo $this->get_field_name( 'twitteraction' ); ?>" value="<?php echo $instance['twitteraction']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'twitterprofile' ); ?>"><?php _e('Twitter Username (ex: <a href="http://www.twitter.com/themebeans">ThemeBeans</a>):', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitterprofile' ); ?>" name="<?php echo $this->get_field_name( 'twitterprofile' ); ?>" value="<?php echo $instance['twitterprofile']; ?>" />
	</p>
	
	<br>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'facebookaction' ); ?>"><?php _e('<a href="http://www.facebook.com/themebeans">FaceBook</a> Text:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebookaction' ); ?>" name="<?php echo $this->get_field_name( 'facebookaction' ); ?>" value="<?php echo $instance['facebookaction']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'facebookpage' ); ?>"><?php _e('Facebook Page Name:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebookpage' ); ?>" name="<?php echo $this->get_field_name( 'facebookpage' ); ?>" value="<?php echo $instance['facebookpage']; ?>" />
	</p>
	
	<br>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'dribbbleaction' ); ?>"><?php _e('<a href="http://www.dribbble.com/themebeans">Dribbble</a> Text:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbbleaction' ); ?>" name="<?php echo $this->get_field_name( 'dribbbleaction' ); ?>" value="<?php echo $instance['dribbbleaction']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'dribbbleprofile' ); ?>"><?php _e('Dribbble Username:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbbleprofile' ); ?>" name="<?php echo $this->get_field_name( 'dribbbleprofile' ); ?>" value="<?php echo $instance['dribbbleprofile']; ?>" />
	</p>


 			
	<?php
	}
}
  
?>