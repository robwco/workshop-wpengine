<?php
/**
*The template for displaying the Member.
*/

get_header(); ?>

<div id="main" class="twelve columns" role="main">

	<?php 
		$thumb_w 	= '220'; //Define width
		$thumb_h 	= '220'; // Define height
		$crop 		= false; //resize 
		$single 	= true; //return array
		
	    //before content action hook 
	    do_action('radium_before_content'); 
	    
	    $social_links = array(
	    	'behance', 'delicious', 'digg', 'reddit', 'dribbble', 'zerply', 'facebook', 'flickr', 'forrst', 'github', 'pinterest', 'googleplus', 'yelp', 'linkedin', 'foursquare', 'skype', 'stumbleupon', 'tumblr', 'twitter', 'vimeo', 'youtube', 'email'
	    );
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="page-box entry-content">
	
			<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
			
				<div class="team row">
					
					<div class="profile-photo four columns">
				
						<?php if( has_post_thumbnail() ) { 
						 
							//get featured image
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
				
							$image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
						
						} else {
						 
							//fallback if all image urls are false
							$image = RADIUM_IMAGES_URL . '/placeholder.gif'; 
						
						}?>
						
						<div class="team-thumb post-thumb preload">
							<img src="<?php echo $image ?>" alt=""/>
						</div>
						
						<div class="social-media-links">
										
							<ul class="style3">
				
								<?php 
								
								foreach ( $social_links as $social_link ) {
				
									$address = '';
				
									if ( $social_link == 'twitter' ) 
										$address = 'http://twitter.com/';
									
									if ( $social_link == 'email' ) 
										$address = 'mailto:';
									
									if ( get_post_meta($post->ID, '_radium_social_link_'.$social_link, true ) ) { ?>
										<li class="<?php echo esc_attr( $social_link ); ?>">
											<a href="<?php echo $address,  get_post_meta ($post->ID, '_radium_social_link_'.$social_link, true); ?>"><?php echo esc_attr( ucfirst( $social_link ) ); ?></a>
										</li>
									<?php } 
									
								} 
								
								?>
				
							</ul><!-- end .social-links -->
							
						</div>	
						
					</div>
					
					<div class="content eight columns">
				
						<header class="entry-header">
							<h3>
								<?php 
								
								if(get_post_meta ($post->ID, '_radium_job_title', true)){
									echo get_the_title(),", ",get_post_meta ($post->ID, '_radium_job_title', true); 
								} else {
									get_the_title();	
								}
								
								?>
							</h3>
							<div class="entry-meta"> 
								<div class="date">
									<?php echo get_post_meta ($post->ID, '_radium_twitter_username', true); ?>
								</div>
							</div>
						</header>
				
						<?php
						 
							$content = get_the_content();
							$content = apply_filters( 'the_content', $content ); 
							
						?>
				
						<div class="entry-content"><?php echo $content; ?></div>
				
					</div><!-- end .content -->
				
				</div><!-- end .team -->
			
			<?php endwhile; // end of the loop.?>
			
			</div>
			
	</article>
	
	<?php 
	
	else : 		
		
		get_template_part( 'lib/content/content', 'not-found' ); 
	
	endif; 
	 
	    //after content action hook 
	    do_action('radium_after_content'); 
	?>
	
</div><!-- #main -->

<?php get_footer(); ?>
