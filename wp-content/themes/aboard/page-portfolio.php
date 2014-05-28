<?php
/*
Template Name: Portfolio
*/
get_header();

//Get Global Page Settings
$page_items = get_post_meta ($post->ID, '_radium_cpt_items_count', true);
         
//Pagination Loader
$paged = 1;

if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

//Set number of columns, set column class and thumb sizes
$page_columns = 'two-columns'; 
$thumb_w = '370'; //Define width
$thumb_h = '220'; // Define height


//Before content action hook 
do_action('radium_before_content'); 
?>
    
<div id="main" class="twelve columns clearfix page-portfolio" role="main">
    
	<div class="entry-content">
	
		<?php 
		do_action('radium_before_content'); 
		
		while ( have_posts() ) : the_post();
		
		get_template_part( 'lib/content/content', 'page' ); 
		
		endwhile; // end of the loop.
		
		do_action('radium_after_content'); 
		
		?>
	
	</div><!-- END .entry-content -->
     
    <section>
	    
	    <div id="stage" class="isotope clearfix fullwidth">
	    
            <?php
             
            //Load Query
            $args = array(
                'post_type' 		=> 'portfolio',
                'orderby' 			=> 'menu_order',
                'order' 			=> 'ASC',
                'posts_per_page' 	=> $page_items,
                'paged' 			=> $paged
            ); 
                 
            query_posts($args);
            
            if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 	    	        
	    	    //Generate portfolio terms list (required by portfolio sorter)
	    	    $terms =  get_the_terms( $post->ID, 'portfolio_category' ); 
	    	    $term_list = null;
	    	    if( is_array($terms) ) {
	    	        foreach( $terms as $term ) {
	    	            $term_list .= $term->slug;
	    	            $term_list .= ' ';
	    	        }
	    	    } 
	    	    
	    		?>
	    					
	    		<article id="post-<?php the_ID(); ?>" <?php post_class("$term_list isotope-item page-grid-item $page_columns"); ?> >
	    		
	    		<h4><a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	    		
	    		<p>Published <?php the_time('F j') ?> in <?php the_terms($post->ID, 'portfolio_category', '', ', ', ''); ?></p>
	    	
	    			<?php
	    			if (empty($img_url)) { $image = RADIUM_IMAGES_URL . '/placeholder.gif'; } ?>
	    			
	    			<div class="porfolio-thumb post-thumb preload <?php if( $page_columns == 'one-column'){ ?> eight columns <?php } ?>">
	    			
	    				<a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
	    				
	    				<?php 
	    				
		                if ( has_post_thumbnail() ) {
		                	
		                	//get featured image
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
		                    
		                     $img_url = @wp_get_attachment_url( $first_attachment->ID,'full' );
		                
		                }
		                
		                $crop = true; //resize but retain proportions
		                $single = true; //return array
		                $image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
		            
		                //add thumbnail fallback
		                if(empty($image)){		
		                	$image = RADIUM_IMAGES_URL . '/placeholder.gif';
		                }
	    					                
	    				
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
 									<img src="<?php echo $image ?>" alt="<?php the_title();?>"/>
			                        
			                    <?php 
			                    
			                    } 
			                    break;
			                default: 
 			            	
 			            	?>
			                 
			                 	<img src="<?php echo $image ?>" alt="<?php the_title();?>"/>
			                 
			                  <?php  break;
							  }	
							  ?>
							  
  							<span class="post-thumb-overlay">
  								<?php do_action('radium_port_hover_text'); ?>
  							</span><!-- END .post-thumb-overlay -->
  							
  							<span class="stripes"></span>
   	    				</a>
	    			
	    			</div><!-- END .portfolio-thumb -->  					
 	    
 	    		</article>
	    		
    		<?php endwhile; endif; ?>				

		</div><!-- END #stage -->
		
		<?php echo radium_theme_pagination(); ?>
		
    </section>
    
    <?php wp_reset_postdata(); ?>

</div><!-- END #main -->

<?php 
    //after content action hook 
    do_action('radium_after_content'); 
 
get_footer(); ?>