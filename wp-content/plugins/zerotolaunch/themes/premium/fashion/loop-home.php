<?php if (have_posts()) : ?>	
	<?php while (have_posts()) : the_post(); ?>
	
	<div <?php post_class( 'post cf' ); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<a class="thumbnail" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( array( 'width' => 158, 'height' => 112, 'crop' => true, 'crop_to_position' => 'center,center', 'class' => 'alignnone' ) ); ?>
			</a>
		<?php endif; ?>
		
		<div class="text">
		
			<span class="meta">
				<span class="date"><?php the_time( 'F j. Y.' ); ?></span>
				<span class="comment-number"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
			</span>
			
			<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						
			<p class="more"><a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'ztl-fashion' ); ?></a></p>
		</div>
	</div><!-- /.post -->
	
	<?php endwhile; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="pagination-nav cf">
			<?php mt_numeric_pagination(); ?>
		</div>
	<?php endif; ?>
	
	<?php else : ?>
	<div id="post-0" class="post error404 not-found">
		<h2><?php _e('No posts found!', 'ztl-fashion'); ?></h2>
		
		<div class="entry">
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>