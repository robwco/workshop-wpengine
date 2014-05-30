<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Dribbble Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays your Dribbble shots.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that will load our widget.
add_action( 'widgets_init', 'radium_dribbler_widget' );

// Register widget.
function radium_dribbler_widget() {
	register_widget( 'Radium_Dribbble_Widget' );
}

class Radium_Dribbble_Widget extends WP_Widget {

	
	function Radium_Dribbble_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bean-dribbble-widget', 'description' => __('A widget that displays your Dribbble shots.', 'radium') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'radium-dribbble-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'radium-dribbble-widget', __('Dribbble Shots (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	}

/*--------------------------------------------------*/
/* Dribble API Functions
/*--------------------------------------------------*/

 	function do_radium_dribbbler( $account, $shots ) {
 	
 		// check for cached version
 		$key = 'radium_widget_dribbbler_' . $account;
 		$shots_cache = get_transient($key);
 
 		if( $shots_cache === false ) {
 		
 			$url 		= 'http://api.dribbble.com/players/' . $account . '/shots/?per_page=24';
 			$response 	= wp_remote_get( $url );
 
 			if( is_wp_error( $response ) ) 
 				return;
 
 			$xml = wp_remote_retrieve_body( $response );
 
 			if( is_wp_error( $xml ) )
 				return;
 
 			if( $response['headers']['status'] == 200 ) {
 
 				$json = json_decode( $xml );
 				$dribbble_shots = $json->shots;
 
 				set_transient($key, $dribbble_shots, 60*5);
 			}
 			
 		} else {
 			
 			$dribbble_shots = $shots_cache;
 		
 		}
 
 		if( $dribbble_shots ) {
 			
 			$i = 0;
 			$output = '<div class="bean-dribbble-shots">';
 
 			foreach( $dribbble_shots as $dribbble_shot ) {
 			
 				if( $i == $shots )
 					break;
 
 				$output .= '<div class="bean-shot">';
 				$output .= '<a href="' . $dribbble_shot->url . '" target="blank">';
 				$output .= '<img height="' . $dribbble_shot->height . '" width="' . $dribbble_shots[$i]->width . '" src="' . $dribbble_shot->image_url . '" alt="' . $dribbble_shot->title . '" />';
 				$output .= '</a>';
 				$output .= '</div>';
 				
 				$i++;
 			}
 
 			$output .= '</div>';
 			$output .= '</div>';
 		
 		} else {
 		
 			$output = '<em>' . __('Error retrieving Dribbble shots.', 'radium') . '</em>';
 		
 		}
 
 		return $output;
 	}

	 		
/*--------------------------------------------------*/
/* Widget API Functions
/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance		The current instance of the widget
	 */
	function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
		
		echo $before_widget;
		
    	// This is where you retrieve the widget values
    
		// Display the widget
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['description'];
		$account = $instance['account'];
		$shots = $instance['shots'];

		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;

		if( $desc ) echo '<p>' . $desc . '</p>';

		echo $this -> do_radium_dribbbler($account, $shots);
		
		echo $after_widget;
		
	} // END widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description'], '<a><b><strong><i><em>');
		$instance['account'] = trim($new_instance['account']);
		$instance['shots'] = trim($new_instance['shots']);
		
		return $instance;
		
	} // END widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form( $instance ) {
		
		// Display the admin form
    	$defaults = array(
			'title' => 'Recent Dribbble Shots.',
			'description' => '',
			'account' => 'themebeans',
			'shots' => 6
		);
	
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$title = $instance['title'];
		$desc = $instance['description'];
		$account = $instance['account'];
		$shots = $instance['shots'];
	
		?>
	
		<p><!-- Title -->
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'radium'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p><!-- Description -->
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'radium'); ?></label>
			<textarea class="widefat" rows="3" cols="15"  id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $desc; ?>" ><?php echo $desc; ?></textarea>
		</p>
		
		<p><!-- Account -->
			<label for="<?php echo $this->get_field_id('account'); ?>"><?php _e('<a href="http://www.dribbble.com/themebeans">Dribbble</a> account:', 'radium'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('account'); ?>" name="<?php echo $this->get_field_name('account'); ?>" type="text" value="<?php echo $account; ?>" />
		</p>
		
		<p><!-- Number of Shots -->
			<label for="<?php echo $this->get_field_id('shots'); ?>"><?php _e('Number of Shots:', 'radium'); ?></label>
			<select name="<?php echo $this->get_field_name('shots'); ?>">
				<?php for( $i = 1; $i <= 24; $i++ ) { ?>
					<option value="<?php echo $i; ?>" <?php selected( $i, $shots ); ?>><?php echo $i; ?></option>
				<?php } ?>
    		</select>
    	</p>
    	
    	<?php
		
	} // END form

	
} // END class
