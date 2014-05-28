<?php
/*-----------------------------------------------------------------------------------*/
/* Faq group Shortcode */
/*-----------------------------------------------------------------------------------*/

function radium_faq_group_sc( $atts ){ 
  	
 	$atts = extract( shortcode_atts( array(
		'group' => 'all', 
  	), $atts ) );
 	
  	$output = null;
?>
  
	<div class="faq-group">
		<?php
							
			$terms = get_terms( 'faq_category', array( 'fields' => $group ) );
			
			foreach( $terms as $term ) {
				$args = array(
					'post_type'		=>	'faq',
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page'=>	-1,
					'tax_query'		=>	array(
						array(
							'taxonomy'		=>	'faq_category',
							'field'			=>	'id',
							'terms'			=>	array( $term->term_id )
						)
					)
				);
				
				query_posts( $args );
				
				if( have_posts() ) : ?>
				
					<div class="faq">
					
						<h4><?php echo $term->name; ?></h4>
						
						<div class="faq">
						
							<?php while( have_posts() ) : the_post(); ?>
						
								<div data-id='closed' class="radium-toggle">
								
									<span class="radium-toggle-title">
										<?php the_title(); ?>
									</span>
									
									<div class="radium-toggle-inner">
									
										<div class="target">
											<?php the_content(); ?>
										</div><!-- END .target -->	
									
									</div>
									
								</div>
								
							<?php endwhile; ?>
							
						</div><!-- end .faq -->
					
					</div>
					
				<?php endif;
				
				wp_reset_query();
				
			}
		?>
	
	</div>
	
<?php 
	return $output;

}

add_shortcode('faq', 'radium_faq_group_sc');
 