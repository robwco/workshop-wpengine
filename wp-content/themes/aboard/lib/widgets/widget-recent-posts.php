<?php

/*-----------------------------------------------------------------------------------

 	Widget Name: Bean Recent Posts Widget
 	Widget URI: http://www.themebeans.com
 	Description:  A custom widget that displays your recent posts.
 	Author: ThemeBeans
 	Author URI: http://www.themebeans.com
 	Version: 1.0
 
-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'radium_recent_posts_widget' );


// Register widget.
function radium_recent_posts_widget() {
	register_widget( 'radium_Recent_Posts_Widget' );
	
}

// Widget class.
class radium_recent_posts_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function radium_Recent_Posts_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'radium_recent_posts_widget', 
		    'description' => __('A widget that displays your recent posts.', 'radium') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 200, 
		    'height' => 350, 
		    'id_base' => 'radium_recent_posts_widget' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'radium_recent_posts_widget', __('Recent Posts (ThemeBeans)', 'radium'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$number = ( isset($instance['number']) ) ? $instance['number'] : 0;

		/* Before widget (defined by themes). */
		echo $before_widget;
        ?>
			
		<div class="radium-recent-posts-widget">
		
			<?php
			//Set Thumbs
			$thumb_w 	= '48'; //Define width
			$thumb_h 	= '48'; // Define height
			$crop 		= true; //resize 
			$single 	= true; //return array
	
			$args = array(
				'ignore_sticky_posts' => 1,
			    'showposts' => $number,
			    
			     
			);	
			$recentPosts = new WP_Query( $args );
			
			// Display recent posts
			echo '<ul>';	
				
			while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); 
	
			//Check if post has a featured image set else get the first image from the gallery and use it. If both statements are false display fallback image. 
			if ( has_post_thumbnail() ) {
				
				//get featured image
			    $thumb = get_post_thumbnail_id();
			    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
			  
			} else {
			
				$attachments = get_children(
			        array(
			        	'post_parent' => get_the_ID(), 
			        	'post_type' => 'attachment', 
			        	'post_mime_type' => 'image', 
			        	'orderby' => 'menu_order'
			        	
			        	)
			    );
			    
			    if ( ! is_array($attachments) ) continue;
			    	$count = count($attachments);
			    	$first_attachment = array_shift($attachments);
			    
			     @$img_url = wp_get_attachment_url( $first_attachment->ID,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
			
			}
	
			$image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
			
			//add thumbnail fallback
			if(empty($image)){		
				$image = RADIUM_IMAGES_URL . '/placeholder.gif';
			}
			?>
			<li class="news-content post-format <?php echo get_post_format() ?>">
				
				<h3 class="widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<?php the_excerpt(); ?>
				
				<div class="news-meta">
					<span>
						By <span class="recent-bold"><?php the_author(); ?> </span> on <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>
					</span>
				</div><!-- END .news-meta -->

				<div class="recent-tags">
					<?php the_tags('',' ',''); ?>
				</div><!-- END .recent-tags -->
			
			</li><!-- END .news-content .post-format -->
			<?php endwhile; 
						
			echo '</ul>';
			
			?>
                               
        </div><!-- END .radium-recent-posts-widget -->
	
	<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['number'] = strip_tags( $new_instance['number'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		    'number' => 1
 		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Posts:', 'radium') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
 	
	<?php
	}
}
 
?>
