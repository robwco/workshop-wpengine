<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workshop
 */

get_header( 'home' ); ?>

	<div id="primary" class="content-area" >
		<main id="main" class="site-main" role="main">


<h2>Essays on design, writing, and business by <img src="/images/logo/workshop-hd-100.png" style="width:1em; vertical-align: -.2em; margin-right: -.1em;"> <a href="/" style="font-weight:800; color: #000; font-size: .9em;vertical-align:0em; border-bottom: 1px solid #9F9D99;">Workshop</a>.</h2>
<hr>


<div style="padding-top: 1em; max-width: 28em; margin: auto; padding-top: 2em;">
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

<hr>
			<div class="masthead" style="text-align: center; margin-bottom: 2em;"><?php posts_nav_link('|','Back','More Essays'); ?> </div>

		</main><!-- #main -->
	</div><!-- #primary -->
