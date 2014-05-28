<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Social Profiles Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays your social profiles.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'radium_social_media_widgets' );

// Register widget
function radium_social_media_widgets() {
	register_widget( 'radium_Social_media_Widget' );
}

// Widget class
class radium_social_media_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
function radium_Social_media_Widget() {

	// Widget settings
	$widget_ops = array (
		'classname' => 'radium_Social_media_Widget',
		'description' => __('A widget that displays your social profiles.', 'radium')
	);

	// Widget control settings
	$control_ops = array (
		'width' => 200,
		'height' => 350,
		'id_base' => 'radium_social_media_widget'
	);

	// Create the widget
	$this->WP_Widget( 'radium_social_media_widget', __('Social Profiles (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$style = $instance['style'];
	
	//icons
	$twitter = $instance['twitter'];
	$facebook = $instance['facebook'];
	$googleplus = $instance['googleplus'];
	$linkedin = $instance['linkedin'];
	$zerply = $instance['zerply'];
	$rss = $instance['rss'];
	$dribbble = $instance['dribbble'];
	$reddit = $instance['reddit'];
	$vimeo = $instance['vimeo'];
	$youtube = $instance['youtube'];
	$forrst = $instance['forrst'];
	$flickr = $instance['flickr'];
	$digg = $instance['digg'];
	$github = $instance['github'];
	$pinterest = $instance['pinterest'];
	$stumbleupon = $instance['stumbleupon'];
	$delicious = $instance['delicious'];
	$foursquare = $instance['foursquare'];
	$behance = $instance['behance'];
	$yelp = $instance['yelp'];
		
	// Before widget (defined by theme functions file)
	echo $before_widget;

	/* Display Widget */
	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
		echo $before_title . $title . $after_title;
	
	?>
	
	<div class="bean-social-profiles clearfix">                        
	                   	
	    <ul <?php if ( $style_class ) { echo 'class="' .$style_class . '"'; } ?>>
			<?php if($twitter != '') : ?>
			    <li class="twitter">
			        <a href="<?php echo $twitter; ?>" title="Twitter"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($facebook != '') : ?>
			    <li class="facebook">
			        <a href="<?php echo $facebook; ?>" title="Facebook"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($googleplus != '') : ?>
			    <li class="googleplus">
			        <a href="<?php echo $googleplus; ?>" title="Google Plus"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($linkedin != '') : ?>
			    <li class="linkedin">
			        <a href="<?php echo $linkedin; ?>" title="LinkedIn"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($zerply != '') : ?>
			    <li class="zerply">
			        <a href="<?php echo $zerply; ?>" title="Zerply"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($rss != '') : ?>
			    <li class="rss">
			        <a href="<?php echo $rss; ?>" title="RSS Feed"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($dribbble != '') : ?>
			    <li class="dribbble">
			        <a href="<?php echo $dribbble; ?>" title="Dribbble"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($reddit != '') : ?>
				<li class="reddit">
				    <a href="<?php echo $reddit; ?>" title="Reddit"></a>
				</li>
			<?php endif; ?>
			
			<?php if($vimeo != '') : ?>
			    <li class="vimeo">
			        <a href="<?php echo $vimeo; ?>" title="Vimeo"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($youtube != '') : ?>
			    <li class="youtube">
			        <a href="<?php echo $youtube; ?>" title="YouTube"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($forrst != '') : ?>
			    <li class="forrst">
			        <a href="<?php echo $forrst; ?>" title="Forrst"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($flickr != '') : ?>
			    <li class="flickr">
			        <a href="<?php echo $flickr; ?>" title="Flickr"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($digg != '') : ?>
			    <li class="digg">
			        <a href="<?php echo $digg; ?>" title="Digg"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($github != '') : ?>
			    <li class="github">
			        <a href="<?php echo $github; ?>" title="Github"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($pinterest != '') : ?>
			    <li class="pinterest">
			        <a href="<?php echo $pinterest; ?>" title="Pinterest"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($stumbleupon != '') : ?>
			    <li class="stumbleupon">
			        <a href="<?php echo $stumbleupon; ?>" title="Stumble Upon"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($delicious != '') : ?>
			    <li class="delicious">
			        <a href="<?php echo $delicious; ?>" title="Delicious"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($foursquare != '') : ?>
			    <li class="foursquare">
			        <a href="<?php echo $foursquare; ?>" title="FourSquare"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($behance != '') : ?>
			    <li class="behance">
			        <a href="<?php echo $behance; ?>" title="Behance"></a>
			    </li>
			<?php endif; ?>
			
			<?php if($yelp != '') : ?>
			    <li class="yelp">
			        <a href="<?php echo $yelp; ?>" title="Yelp"></a>
			    </li>
			<?php endif; ?>
		</ul>		
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
	$instance['style'] = strip_tags( $new_instance['style'] );
	
	// No need to strip tags
	$instance['twitter'] = $new_instance['twitter'];
	$instance['facebook'] = $new_instance['facebook'];
	$instance['googleplus'] = $new_instance['googleplus'];
	$instance['linkedin'] = $new_instance['linkedin'];
	$instance['zerply'] = $new_instance['zerply'];
	$instance['rss'] = $new_instance['rss'];
	$instance['dribbble'] = $new_instance['dribbble'];
	$instance['reddit'] = $new_instance['reddit'];
	$instance['vimeo'] = $new_instance['vimeo'];
	$instance['youtube'] = $new_instance['youtube'];
	$instance['forrst'] = $new_instance['forrst'];
	$instance['flickr'] = $new_instance['flickr'];
	$instance['digg'] = $new_instance['digg'];
	$instance['github'] = $new_instance['github'];
	$instance['pinterest'] = $new_instance['pinterest'];
	$instance['stumbleupon'] = $new_instance['stumbleupon'];
	$instance['delicious'] = $new_instance['delicious'];
	$instance['foursquare'] = $new_instance['foursquare'];
	$instance['behance'] = $new_instance['behance'];
	$instance['yelp'] = $new_instance['yelp'];
			
	return $instance;
}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	
function form( $instance ) {

	// Set up some default widget settings
	$style = $instance[ 'style' ];
	
	$defaults = array(
		'title' => 'Connect with Us.',	
		'twitter' => '',
		'facebook' => '',
		'googleplus' => '',
		'linkedin' => '',
		'zerply' => '',
		'rss' => '',
		'dribbble' => '',
		'reddit' => '',
		'vimeo' => '',
		'youtube' => '',
		'forrst' => '',
		'flickr' => '',
		'digg' => '',
		'github' => '',
		'pinterest' => '',
		'stumbleupon' => '',
		'delicious' => '',
		'foursquare' => '',
		'behance' => '',
		'yelp' => '',
	);
		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 	
 	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<!-- Behance: Text Input -->	
	<p>
		<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e('Behance URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo $instance['behance']; ?>" />
	</p>
	
	<!-- Delicious: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" />
	</p>
	
	<!-- Digg: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'digg' ); ?>"><?php _e('Digg URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'digg' ); ?>" name="<?php echo $this->get_field_name( 'digg' ); ?>" value="<?php echo $instance['digg']; ?>" />
	</p>
	
	<!-- Dribbble: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e('Dribbble URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" />
	</p>

	<!-- Facebook: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
	</p>	
	
	<!-- Flickr: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" />
	</p>
	
	<!-- Forrst: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'forrst' ); ?>"><?php _e('Forrst URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'forrst' ); ?>" name="<?php echo $this->get_field_name( 'forrst' ); ?>" value="<?php echo $instance['forrst']; ?>" />
	</p>
	
	<!-- FourSquare: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'foursquare' ); ?>"><?php _e('FourSquare URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'foursquare' ); ?>" name="<?php echo $this->get_field_name( 'foursquare' ); ?>" value="<?php echo $instance['foursquare']; ?>" />
	</p>

	<!-- Github: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e('Github URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo $instance['github']; ?>" />
	</p>
	
	<!-- Google Plus: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e('Google Plus URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" />
	</p>
	
	<!-- LinkedIn: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
	</p>
	
	<!-- Pinterest: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
	</p>
	
	<!-- Reddit: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'reddit' ); ?>"><?php _e('Reddit URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'reddit' ); ?>" name="<?php echo $this->get_field_name( 'reddit' ); ?>" value="<?php echo $instance['reddit']; ?>" />
	</p>
	
	<!-- RSS: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" />
	</p>
	
	<!-- StumbleUpon: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'stumbleupon' ); ?>"><?php _e('StumbleUpon URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'stumbleupon' ); ?>" name="<?php echo $this->get_field_name( 'stumbleupon' ); ?>" value="<?php echo $instance['stumbleupon']; ?>" />
	</p>
	
	<!-- Twitter: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
	</p>
	
	<!-- Vimeo: Text Input -->	
	<p>
		<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
	</p>
	
	<!-- Yelp: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'yelp' ); ?>"><?php _e('Yelp URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'yelp' ); ?>" name="<?php echo $this->get_field_name( 'yelp' ); ?>" value="<?php echo $instance['yelp']; ?>" />
	</p>
	
	<!-- YouTube: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('YouTube URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
	</p>
	
	<!-- Zerply: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'zerply' ); ?>"><?php _e('Zerply URL:', 'radium') ?></label>
		<input type="text" class="widefat"  id="<?php echo $this->get_field_id( 'zerply' ); ?>" name="<?php echo $this->get_field_name( 'zerply' ); ?>" value="<?php echo $instance['zerply']; ?>" />
	</p>
  	
	<br>
		
	<?php
	}
}
?>