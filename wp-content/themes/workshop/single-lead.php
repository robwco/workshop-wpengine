<?php
/*
Template Name: Single Lead
*/
/**
 * The template for displaying all single posts.
 *
 * @package Workshop
 */

get_header( 'home' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<h1><?php the_field('lead_title'); ?></h1>
			<p><strong>Budget:</strong><?php the_field('lead_budget'); ?></p>
			<p><?php the_field('lead_date'); ?></p>
			<p><a href="<?php the_field('lead_link'); ?>">Original Posting</a></p>
			<p><?php the_field('lead_description'); ?></p>
			<p><?php the_field('lead_description'); ?></p>

			<?php workshop_post_nav(); ?>


		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
