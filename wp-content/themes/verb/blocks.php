<?php 
/* 
Template Name: Blocks
*/ 
?>

<?php get_header(); ?>
		
		<div id="content">
			<?php if ( get_theme_mod('okay_theme_customizer_blocks_title') || get_theme_mod('okay_theme_customizer_blocks_subtitle') ) { ?>
				<div class="hero">
					<?php if ( get_theme_mod('okay_theme_customizer_blocks_title') ) { ?>
						<h2><?php echo '' .get_theme_mod( 'okay_theme_customizer_blocks_title', '' )."\n";?></h2>
					<?php } ?>
					
					<?php if ( get_theme_mod('okay_theme_customizer_blocks_subtitle') ) { ?>
						<h3><?php echo '' .get_theme_mod( 'okay_theme_customizer_blocks_subtitle', '' )."\n";?></h3>
					<?php } ?>
				</div><!-- hero -->
			<?php } ?>
			
			<div class="posts">
				<div class="post-box-wrap">
					<!-- Grab Portfolio Items -->
					<?php
						if ( get_query_var('paged') ) {
						    $paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
						    $paged = get_query_var('page');
						} else {
						    $paged = 1;
						}
						
						$args = array('post_type' => 'okay-portfolio', 'posts_per_page' => 12, 'paged' => $paged );
						
						$temp = $wp_query; 
						$wp_query = null; 
						$wp_query = new WP_Query(); 
						$wp_query->query( $args ); 
						
						while ($wp_query->have_posts()) : $wp_query->the_post(); 
					?>
	
					<article <?php post_class('post block-post'); ?>>
						<div class="post-inside">
							
							<a class="overlay-link" href="<?php the_permalink(); ?>"></a>			
									
							<div class="box-wrap">
								<!-- grab the featured image -->
								<?php if ( has_post_thumbnail() ) { ?>
									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'home-image' ); ?></a>
								<?php } ?>
								
								<div class="box">
									<header>			
										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
										<?php echo get_the_term_list( $post->ID, 'categories', '<h3 class="entry-by">' . __('Posted In: ', 'okay'), ', ', '</h3>' ); ?>
									</header>
								</div><!-- box -->
							</div><!-- box wrap -->
						</div><!-- image post -->
					</article><!-- post-->
					
					<?php endwhile; ?>
					
					<!-- post navigation -->
					<?php if( okay_page_has_nav() ) : ?>
						<div class="post-nav">
							<div class="post-nav-inside">
								<div class="post-nav-right"><?php previous_posts_link(__('Newer Posts', 'okay')) ?></div>
								<div class="post-nav-left"><?php next_posts_link(__('Older Posts', 'okay')) ?></div>	
							</div>
						</div>
					<?php endif; ?>
					
					<?php 
					  $wp_query = null; 
					  $wp_query = $temp;  // Reset
					?>
				</div><!-- post box wrap -->
			</div><!-- posts -->
		</div><!-- content -->
	
		<!-- footer -->
		<?php get_footer(); ?>