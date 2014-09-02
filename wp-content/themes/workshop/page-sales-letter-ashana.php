<?php
/*
Template Name: Sales Letter - Ashana
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


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!--Don't remove-->
			<?php include("inc/sales-letter.php"); ?>
						<!--Don't remove-->
			<?php include("inc/plan-ashana.php"); ?>
			<!--Don't remove-->
			<?php include("inc/sales-letter-end.php"); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer( 'home' ); ?>