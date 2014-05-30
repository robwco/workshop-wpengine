<?php get_header(); ?>

<div id="main" class="twelve columns archive-portfolio" role="main">

    <?php 
        //before content action hook 
        do_action('radium_before_content'); 
    ?>
     
	<section class="row">
 	    <div id="stage" class="clearfix fullwidth">
 	    
             <?php
             
              $thumb_w = '370'; //Define width
              $thumb_h = '220'; // Define height
 			  $page_columns = 'two-columns';
              
              if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  	    	        
 	    	    //Generate portfolio terms list (required by portfolio sorter)
 	    	    $terms =  get_the_terms( $post->ID, 'portfolio_category' ); 
 	    	    $term_list = '';
 	    	    if( is_array($terms) ) {
 	    	        foreach( $terms as $term ) {
 	    	            $term_list .= $term->slug;
 	    	            $term_list .= ' ';
 	    	        }
 	    	    } 
 	    	    		
 	    		?>
 	    					
 	    		<article id="post-<?php the_ID(); ?>" <?php post_class("$term_list isotope-item page-grid-item $page_columns"); ?> >
 	    		
 	    			<div class="porfolio-thumb post-thumb preload <?php if( $page_columns == 'one-column'){ ?> eight columns <?php } ?>">
 	    				
 	    				<a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
 	    		
 	    			<?php
 	    			//Check if post has a featured image set else get the first image from the portfolio and use it. If both statements are false display fallback image. 
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
 	    			
 	    			$crop = true; //resize but retain proportions
 	    			$single = true; //return array
 	    			$image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
 	    			
 	    			//fallback if all image urls are false
 	    			if (empty($img_url)) { $image = RADIUM_IMAGES_URL . '/placeholder.gif'; } 
 	    			
					$mediaType = get_post_meta($post->ID, '_radium_portfolio_type', true);
				
				    switch ( $mediaType ) {
			                    
		                case "slideshow":
		                    radium_gallery( $post->ID, $thumb_w, $thumb_h, true );
		                    break;
		
		             	case "video":
		                    $embed = get_post_meta($post->ID, '_radium_portfolio_embed_code', true);
		                    if( !empty($embed) ) {
		                    	echo "<div class='video-frame'>";
		                        	echo stripslashes(htmlspecialchars_decode($embed));
		                        echo "</div>";
		                    } else {
		                        ?>
		                        
								<img src="<?php echo $image ?>" alt="<?php echo get_the_title(); ?>"/>
 		                         	    			
		                    <?php
		                    } 
		                    
		                    break;
		
		                default: ?>

 	    					<img src="<?php echo $image ?>" alt="<?php echo get_the_title(); ?>"/>
    	    	
 					<?php break;
 					}	 ?>
 					
	 					<span class="post-thumb-overlay">
	 					
	 						<?php do_action('radium_port_hover_text'); ?>
	 					
	 					</span><!-- END .post-thumb-overlay -->
	 					
	 					<span class="stripes"></span>
 						
 						</a>
 					
 					</div>
 					
 					<?php 
 					
 					if( $page_columns == 'one-column') { ?>
 					
 	    				 <div class="entry-summary four columns">
 	    				 	
 	    				 	<h2><a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
 	    				 
 	    				 </div><!-- END .entry-summary -->
 	    				 
 	   				<?php } else { ?>
 	   				
 	   					<h4><a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
 	   						<p>Published in: <?php the_terms($post->ID, 'portfolio_category', '', ', ', ''); ?></p>
 	   					
 	   				<?php } ?>
 	    		</article>
 	    		
     		<?php endwhile; endif; ?>				
 
 		</div><!-- END #stage.clearfix.fullwidth -->
 		
 		<div class="hr hr_invisible"></div>
 		
 		<?php echo radium_theme_pagination(); ?>
 		
     </section>
    <?php wp_reset_postdata(); ?>
    
    <?php 
        //after content action hook 
        do_action('radium_after_content'); 
    ?>
</div> 
   
<?php get_footer(); ?>