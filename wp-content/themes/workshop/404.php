<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Workshop
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'workshop' ); ?></h1>
					<h2>This shouldn't have happened, so please let me know how you got here: <a href="MAILTO:robert@letsworkshop.com">robert@letsworkshop.com</a></h2>
				</header><!-- .page-header -->

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
