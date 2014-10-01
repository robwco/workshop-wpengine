<?php
/*
Template Name: Live Event
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

get_header( 'page' ); ?>

<div class="sales-letter" >
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" style="margin-bottom:3em;">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<center>

	<img style="width: 7em;"src="/images/marketing/success.png">

	<a href="/start"><h2>24-hour special only for attendees of this event!</h2>
		<p class="lead">Get $48-off Workshop subscription until October 2nd, 1:00PM PST.</p></a>

	</center>

</div>