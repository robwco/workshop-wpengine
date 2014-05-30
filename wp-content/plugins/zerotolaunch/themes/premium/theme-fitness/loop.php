<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class( 'post cf' ); ?>>
			<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			<?php if ( $post->post_type == 'post' ): ?>
				<p class="post-meta">by <?php the_author(); ?> on <?php the_time( 'F j. Y.' ); ?>, posted in <?php the_category(', '); ?></p>
			<?php endif; ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'post-large', array( 'class' => 'alignnone' ) ); ?>
				</a>
			<?php endif; ?>

			<?php the_excerpt(); ?>
			<p class="more"><a href="<?php the_permalink(); ?>"><?php _e( 'Continue reading' ); ?></a></p>
		</div><!-- /.post -->

	<?php endwhile; ?>

	<?php if ( $show_paging != false && $wp_query->max_num_pages > 1 ) : ?>
		<div class="pagination-nav cf">
			<div class="alignleft"><?php next_posts_link(__( 'Older Posts' )); ?></div>
			<div class="alignright"><?php previous_posts_link(__( 'Newer Posts' )); ?></div>
		</div>
	<?php endif; ?>
	
<?php else : ?>
	<div id="post-0" class="post error404 not-found">
		<h2>Not Found</h2>
		
		<div class="entry">
			<?php  
				if ( is_category() ) { // If this is a category archive
					printf("<p>Sorry, but there aren't any posts in the %s category yet.</p>", single_cat_title('',false));
				} else if ( is_date() ) { // If this is a date archive
					echo("<p>Sorry, but there aren't any posts with this date.</p>");
				} else if ( is_author() ) { // If this is a category archive
					$userdata = get_user_by('id', get_queried_object_id());
					printf("<p>Sorry, but there aren't any posts by %s yet.</p>", $userdata->display_name);
				} else if ( is_search() ) {
					echo("<p>No posts found. Try a different search?</p>");
				} else {
					echo("<p>No posts found.</p>");
				}
			?>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>