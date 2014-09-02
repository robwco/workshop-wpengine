<?php
/*
Template Name: Blog Index
*/
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Workshop
 */


get_header( 'home' ); ?>

	<div id="primary" class="content-area sales-letter" >
		<main id="main" class="site-main" role="main">


<div class="small-wrap">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'essay' );
				?>

			<?php endwhile; ?>


		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
</div>


			<div class="small-wrap" style="text-align: center; margin-bottom: 2em;">
<hr>
				<?php posts_nav_link('|','Back','More Essays'); ?> </div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer( 'home' ); ?>



