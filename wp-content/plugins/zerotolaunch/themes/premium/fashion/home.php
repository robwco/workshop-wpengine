<?php get_header();
	
// Let's grab the custom content we need
$featured = new WP_Query();
$featured->query('posts_per_page=1&category_name=Featured');

$recent = new WP_Query();
$recent->query('posts_per_page=1');

?>
	
	<div class="main">
		<div class="shell cf">
		
			<?php if ( ! is_paged() ) :	// Check to make sure we're on a page other than page #1 ?>
		
			<div class="content left">

				<div class="featured-articles cf">
					<div class="featured left">
						<h3><?php _e('Featured', 'ztl-fashion'); ?></h3>
						
						<?php if( $featured->have_posts() ) : ?>
							<?php while ($featured->have_posts()) : $featured->the_post(); ?>
							
								<a class="thumbnail" href="<?php the_permalink(); ?>">		
									<?php the_post_thumbnail( array( 'class' => 'alignnone', 'width' => 315, 'height' => 220, 'crop' => true, 'crop_from_position' => 'center,center') ); ?>
								</a>
								
								<h2 class="title"><?php the_title(); ?></h2>
								<span class="meta">
									<span class="date"><?php the_time( 'F j. Y.' ); ?></span>
									<span class="comment-number"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
								</span>
								
								<div class="excerpt">
									<?php the_excerpt(); ?>
								</div>
								
								<a href="<?php the_permalink(); ?>" class="more"><?php _e('Read More', 'ztl-fashion'); ?></a>
							 
							<?php endwhile; ?>
							
						<?php else : ?>
							<p><?php _e( 'Whoops! There\'s no featured content yet! Just create a category called "Featured" and add a post to it. The latest post in the "Featured" category will show up here automatically.', 'ztl-fashion'); ?></p>
						<?php endif; ?>				
					</div>
					
					<div class="recent right">
						<h3><?php _e('Recent', 'ztl-fashion'); ?></h3>
						
						<?php if( $recent->have_posts() ) : ?>
							<?php while ($recent->have_posts()) : $recent->the_post(); ?>
										
								<a class="thumbnail" href="<?php the_permalink(); ?>">		
									<?php the_post_thumbnail( array( 'class' => 'alignnone', 'width' => 315, 'height' => 220, 'crop' => true, 'crop_from_position' => 'center,center') ); ?>
								</a>
								
								<h2 class="title"><?php the_title(); ?></h2>
								<span class="meta">
									<span class="date"><?php the_time( 'F j. Y.' ); ?></span>
									<span class="comment-number"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
								</span>
								
								<div class="excerpt">
									<?php the_excerpt(); ?>
								</div>
								
								<a href="<?php the_permalink(); ?>" class="more"><?php _e('Read More', 'ztl-fashion'); ?></a>
							<?php endwhile; ?>
							
						<?php else : ?>
							<p><?php _e( 'Whoops! There\'s no recent content yet! Go write some!', 'ztl-fashion'); ?></p>
						<?php endif; ?>
					</div>
				</div><!-- .featured-articles -->
			
				<div class="posts">
					<?php get_template_part( 'loop', 'home' ); ?>										
				</div><!-- /.posts -->
			</div><!-- /.content -->
			
			<?php else : // We're on page #2 and beyond ?>
			
				<div class="content left">
				<div class="posts">
					<?php get_template_part( 'loop' ); ?>										
				</div><!-- /.posts -->
			</div><!-- /.content -->
			
			<?php endif; ?>

			<?php get_sidebar(); ?>
			
		</div><!-- /.shell -->
	</div><!-- /.main -->
	
<?php get_footer(); ?>