<?php get_header(); ?>

<div id="main" class="twelve columns clearfix" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="page-box">
	
		<?php
						
		$terms = get_terms( 'faq_category', array( 'fields' => 'all' ) );
		
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
								
								<span class="radium-toggle-title"><?php the_title(); ?></span>
								
								<div class="radium-toggle-inner">
								
									<div class="target">
										
										<?php the_content(); ?>
									
									</div><!-- END .target -->	
								
								</div><!-- END .radium-toggle-inner -->
							
							</div><!-- END .radium-toggle -->
							
						<?php endwhile; ?>
						
					</div><!-- END .faq -->
				
				</div><!-- END .faq -->
				
			<?php endif;
			
			wp_reset_query();
			
		}
		?>
		</div><!-- END .page-box -->
		
	</article><!-- END .post-class -->
	
</div><!-- END #main -->

<?php get_footer(); ?>