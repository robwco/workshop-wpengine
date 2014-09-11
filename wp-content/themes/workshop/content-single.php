<?php
/**
 * @package Workshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link( __( 'Edit', 'workshop' ), '<span class="edit-link">', '</span>' ); ?>
<section class="mid-wrap">
	<div class="entry-content weekly">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'workshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</section>
	<footer class="entry-footer">



	<section class="mid-wrap" style="display:table; margin-bottom: 2em;">
	<hr>
			
			<p>
				You're reading <em><?php the_title(); ?></em> by  <?php the_author(); ?></strong>.
			<br>
				If you liked this and want to read more like this, <a href="/weekly">you should sign up here</a>.
			</p>
	</section>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
