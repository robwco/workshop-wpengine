<?php /* The template used for displaying page content in page.php and custom templates */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-box entry-content">
	
		<?php the_content(); ?>

	</div><!-- .entry-content -->
 	
</article><!-- #post-<?php the_ID(); ?> -->
