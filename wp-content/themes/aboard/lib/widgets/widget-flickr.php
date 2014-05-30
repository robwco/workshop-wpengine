<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Flickr Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays your Flickr photos.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'radium_flickr_widgets' );

// Register widget
function radium_flickr_widgets() {
	register_widget( 'radium_FLICKR_Widget' );
}

// Widget class
class radium_flickr_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function radium_FLICKR_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'radium_flickr_widget',
		'description' => __('A widget that displays your Flickr photos.', 'radium')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 200,
		'height' => 350,
		'id_base' => 'radium_flickr_widget'
	);

	// Create the widget
	$this->WP_Widget( 'radium_flickr_widget', __('Flickr Photos  (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$flickrID = $instance['flickrID'];
	$postcount = $instance['postcount'];
	$type = $instance['type'];
	$display = $instance['display'];
	$desc = $instance['desc'];
	

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display Flickr Photos
	 ?>
		
	<?php if ( $desc ) { echo '<p>'.$desc.'</p>'; } ?>
		
	<div id="flickr_badge_wrapper" class="clearfix">
	
		<div class="flicker-image-wrapper">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
		</div>	
			
	</div>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
	
	// No need to strip tags
	$instance['postcount'] = $new_instance['postcount'];
	$instance['type'] = $new_instance['type'];
	$instance['display'] = $new_instance['display'];
	$instance['desc'] = $new_instance['desc'];

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Our Flickr Feed.',
		'flickrID' => '40579917@N00',
		'postcount' => '10',
		'type' => 'user',
		'display' => 'latest',
		'desc' => 'Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper.',
		
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'radium') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p><!-- Description -->
	<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description:', 'radium') ?></label>
	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
	</p>
	
	<!-- Flickr ID: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'radium') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	
	<!-- Postcount: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'radium') ?></label>
		<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
			<option <?php if ( '8' == $instance['postcount'] ) echo 'selected="selected"'; ?>>8</option>
			<option <?php if ( '10' == $instance['postcount'] ) echo 'selected="selected"'; ?>>10</option>
		</select>
	</p>
	
	<!-- Type: Select Box -->
	<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'radium') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
			<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
		</select>
	</p>
	
	<!-- Display: Select Box -->
	<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'radium') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
		</select>
	</p>
	
	<?php
	}
}
?>