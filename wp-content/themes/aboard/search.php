<?php
/*
The Search.
*/

get_header(); ?>

<div id="main" class="twelve columns" role="main">
	<?php 
	
	//before content action hook 
	do_action('radium_before_content'); 
	
	global $query_string;
	
	query_posts( $query_string . '&posts_per_page=-1' );
	
	if ( have_posts() ) : ?>
	
		<div id="post-box">
			        
		<div class="row">
			
			<div class="twelve columns">
			
			<p>
				<?php printf( __('Keyword: <strong>"%s"</strong> matched the following results below:','radium'), get_search_query() ); ?>
			</p> 
			
				 <div class="search_posts">
                   
		        		<?php 
		        		    // Return only our Post Items
		        		    $i = 0;
		        		    while( have_posts() ) : the_post(); 
		        		    
		                        if( $post->post_type == 'post'|| $format == 'gallery' ) { $i++; printf('<div class="search-item-%4$s"><h5><a href="%1$s">%2$s</a></h5><p>%3$s</p></div>', get_permalink(), get_the_title(), get_the_excerpt(), get_post_format() ); }
		                    
		                    endwhile; ?>

		            <?php if( $i == 0 ) { printf('<p>%s</p>', __('No posts match the search terms', 'radium') ); } ?>
				
				</div><!-- END .search_posts -->
								
			 </div><!-- END .twelve columns -->
		
		</div><!-- END .row -->
	
	</div><!-- END .#post-box -->
		
	<?php else : ?>
			
			<div class="page-box entry-content">
			
				<div id="post-0" class="post no-results not-found">
			
					<h2 class="entry-search">
						<?php printf( __('"%s" did not match any entries.','radium'), get_search_query() ); ?>
					</h2> 
					
					<div class="entry-content">
		    							
						<?php get_search_form(); ?>
					
					</div><!-- END .entry-content -->
				
				</div><!--END .post-0 -->
			
			</div><!--END .page-box .entry-content -->
		
	<?php endif; 	

	    //After content action hook 
	    do_action('radium_after_content'); 
	?>
	
</div><!-- END #main -->

<?php get_footer(); ?>