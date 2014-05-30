<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class( 'post cf' ); ?>>
		
			<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<span class="meta">
				<span class="date"><?php the_time( 'F j. Y.' ); ?></span>
				<span class="comment-number"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
			</span>
		
			<?php if ( has_post_thumbnail() ) : ?>
				<a class="thumbnail" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( array( 'width' => 320, 'height' => 320, 'crop' => true, 'crop_from_position' => 'center,center' ) ); ?>
				</a>
			<?php endif; ?>
			
			<div class="text">
	
				<?php the_excerpt(); ?>
				
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
		</div>
	</div>
<?php endif; ?>