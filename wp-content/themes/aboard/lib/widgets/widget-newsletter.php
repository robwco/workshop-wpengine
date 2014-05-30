<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Newsletter Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays a newsletter sign up feild.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that will load our widget.
add_action( 'widgets_init', 'radium_newsletter_widget' );

// Register widget.
function radium_newsletter_widget() {
	register_widget( 'Radium_Newsletter_Widget' );
}

// Widget class.
class Radium_Newsletter_Widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function Radium_newsletter_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'radium_newsletter_widget', 'description' => __('A custom widget that displays a newsletter subscribe field.', 'radium') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'radium_newsletter_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'radium_newsletter_widget', __('Newsletter (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget 
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$desc = $instance['desc'];
		$placeholder = $instance['placeholder'];
		$subscribecode = $instance['subscribecode'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
			
			<div class="bean-newsletter">
				
           		<?php if ( $desc ) { echo '<p>'.$desc.'</p>'; } ?>
				
				<form action="<?php echo $subscribecode; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
				
					<input type="email" name="EMAIL" class="email-newsletter" id="mce-EMAIL" value="<?php echo $placeholder; ?>" required="" onfocus="this.value='';" onblur="if(this.value=='')this.value='<?php echo $placeholder; ?>';">
					
					<button class="newsletter-button" type="submit"><?php _e('Submit','radium'); ?></button>
				
				</form><!-- END /form -->
				
				<div class="clear"></div>
			
            </div><!--END .bean-newsletter-->
		
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['desc'] = $new_instance['desc'];
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['subscribecode'] = stripslashes( $new_instance['subscribecode'] );
		$instance['placeholder'] = stripslashes( $new_instance['placeholder'] );
		
		/* No need to strip tags for.. */

		return $instance;
	}
	
/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Subscribe to our Newsletter.',
			'desc' => '<b>ddDonec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo. </b> Tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean eu leo quam. ',
			'placeholder' => 'Click here & enter your email',
			'subscribecode' => '',
 		);
 		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
         
		<p><!-- Widget Title -->
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'radium') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

        <p><!-- Description -->
        	<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description:', 'radium') ?></label>
        	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
       	</p>
        
        <p><!-- Placeholder (Value) -->
        	<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>"><?php _e('Placeholder Text:', 'radium') ?></label>
        	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" value="<?php echo $instance['placeholder']; ?>" />
        </p>
        
        <p><!-- Subscribe Code -->
			<label for="<?php echo $this->get_field_id( 'subscribecode' ); ?>"><?php _e('Subscribe Code:', 'radium') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subscribecode' ); ?>" name="<?php echo $this->get_field_name( 'subscribecode' ); ?>" value="<?php echo $instance['subscribecode']; ?>" />
		</p>

		<?php
	}
}
?>