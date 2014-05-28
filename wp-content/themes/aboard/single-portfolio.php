<?php 

get_header();  

$options = get_option('radium_theme');

?>
 
<div id="main" class="<?php echo $radium_content_class; ?> clearfix" role="main">
    <?php 
        //Before content action hook 
        do_action('radium_before_portfolio'); 
   		
   		if (have_posts()) : 
   		
   		//Before portfolio content action hook 
   		do_action('radium_before_portfolio_content');
   		
   		while (have_posts()) : the_post();
   		 
			$mediaType = get_post_meta($post->ID, '_radium_portfolio_type', true);
			$portfolio_class = strtolower($mediaType); 
			
			$options = get_option('radium_theme');
			
			$image_w = '910 '; 	//Define width
			//$image_h = '999'; // Define height
			
		?>
		
 		<section <?php post_class("entry-content $portfolio_class") ?> id="post-<?php the_ID(); ?>">

		    <div class="row">
				
				<div class="twelve columns">
				
					<div class="entry-content-media">
				
						<?php 
							// Get the media elements
						    switch ( $mediaType ) {
  				                    
				                case "slideshow":
				                    radium_gallery($post->ID, $image_w , false);
				                    break;
				
				                case "video":
				                    $embed = get_post_meta($post->ID, '_radium_portfolio_embed_code', true);
				                    if( !empty($embed) ) {
				                    	echo "<div class='video-frame'>";
				                        	echo stripslashes(htmlspecialchars_decode($embed));
				                        echo "</div>";
				                    } else {
				                        radium_video($post->ID);
				                    }
				                    break;
				
				                case "audio":
    					                radium_audio($post->ID);
				                    break;
				
				                default:
			                		$thumb = get_post_thumbnail_id();
			                		$img_url = wp_get_attachment_url( $thumb,'full' ); //Get full URL to image (use "large" or "medium" if the image is too big)
			                		$image = radium_resize( $img_url, $image_w , true ); //Resize & crop the image
			                		?> 
			                		
			                		<img src="<?php echo $image; ?>" class="wp-post-image"  alt="<?php the_title(); ?>"/>
			                 		
			                 		<?php
				                    break;
							}
						?>
						
					</div><!-- END .entry-content-media -->
				
				</div><!-- END .twelve-columns -->
				
			</div><!-- END .row -->
			
			<?php 
			// Get the meta information and display if available
			$portfolioClient = get_post_meta($post->ID, '_radium_portfolio_client', true);
			$portfolioURL = get_post_meta($post->ID, '_radium_portfolio_url', true);
			
			?>
 				<article class="row">
				
				    <div class="twelve columns">
				
						    <div class="portfolio-entry-meta clearfix">
				
							<h5>Published  <?php the_time('F jS, Y') ?>, for 
							<?php if ( $portfolioURL != '' ) : ?>
								<a target="_blank" href="<?php echo $portfolioURL; ?>"><?php echo $portfolioClient; ?></a>.  
							<?php else : ?>
								<?php echo $portfolioClient; ?>.
							<?php endif; ?>
							</h5> 

						</div><!-- END .portfolio-entry-meta clearfix-->	
					
						<div class="entry-content">
				
							<?php the_content(); ?>
				
						</div><!-- END .entry-content-->
				
					</div><!-- END .twelve columns-->
        		
        		</article><!-- END .row-->
         	<?php 
           	
         	$related_posts = isset($options['related_posts']) ? $options['related_posts'] : false;
         	
 			$related_items_count = 2;
 			
 		    $related = radium_get_posts_related_by_taxonomy($post->ID, 'portfolio_category', array('posts_per_page' => $related_items_count));
 		    $i = 0;
 	
         	
         	if ( ( $related_posts && array_key_exists('portfolio', $related_posts) ) && $related->have_posts()  ) {
          	
         	?>
        	<div class="row">
        		
        		<div class="twelve columns">
        			<!-- Related Portfolio Posts-->
        			<?php
        					
						if ( $related_items_count === 2 ) {
						
							$page_columns = 'two-columns';
							$thumb_w = '370'; //Define width
							$thumb_h = '220'; // Define height
						
						} else {
						
							$page_columns = 'two-columns';
							$thumb_w = '370'; //Define width
							$thumb_h = '220'; // Define height
						 
						}
        			?>

        			<div class="related-content clearfix" >
          			            
    			     	<h5 class="entry-title"><span><?php do_action('radium_port_related_text'); ?></span></h5>
    			            
    			          <?php while( $related->have_posts() ) : $related->the_post(); 
    			            
    			            if ( has_post_thumbnail() ) {
    			               $thumb = get_post_thumbnail_id();
    			                $img_url = wp_get_attachment_url( $thumb,'full' ); 
    			              
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
    			                
    			                 @$img_url = wp_get_attachment_url( $first_attachment->ID,'full' ); 
    			            
    			            }
    			            
    			            $crop = true; 
    			            $single = true; 
    			            $image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
    			            
    			            if (empty($img_url)) { $image = RADIUM_IMAGES_URL . '/placeholder.gif'; } ?>
    					    
    			            	<article id="post-<?php the_ID(); ?>" class="page-grid-item <?php echo $page_columns; if($i%3==2) { echo ' last'; } ?>">
    			            	
	    			            		<h4><a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	    			            		
	    			            		<p>Published <?php the_time('F j') ?> in <?php the_terms($post->ID, 'portfolio_category', '', ', ', ''); ?></p>
    			            	
    					    			<div class="post-thumb">
    				    				
	    				    				<a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
	    				    					
	    				    					<span class="post-thumb-overlay"><?php do_action('radium_port_hover_text'); ?></span>
	    				     					
	    				     						<img src="<?php echo $image ?>" alt="<?php the_title();?>"/>
	    				    				    
	    				    				    <div class="stripes"></div>
	    				    				
	    				    				</a>
	    				    				
										</div><!-- END .post-thumb-->
    			    			</article>	
    			    			
    						<?php $i++; ?>		
    		
    			        <?php endwhile; wp_reset_postdata(); ?>
     		
     			    </div><!-- END .related content-->		
        	
        		</div><!-- END .twelve columns-->
        	
        	</div><!-- END .row -->
        	
        	<?php } ?>
        	
        <?php 
       
       	do_action('radium_after_portfolio_content'); 
       	
       	if( radium_theme_supports( 'comments', 'portfolio' ) && ( comments_open() || '0' != get_comments_number() )  ) comments_template( '', false );  
       	
        ?>
        
    </section>
		
	<?php endwhile; 
	
	do_action('radium_after_portfolio');
	
	else : 			
	
		get_template_part( 'lib/content/content', 'not-found' ); 
	?>
	
	<?php endif; wp_reset_postdata(); ?>
	
</div><!-- END .twelve columns -->

<?php get_footer(); ?>