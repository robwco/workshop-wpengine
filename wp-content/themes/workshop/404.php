<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Workshop
 */

get_header(); ?>
<section class="big-wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<center>
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page isn&rsquo;t here.', 'workshop' ); ?></h1>
					<p>This shouldn't have happened, so please let me know how you got here: <a href="MAILTO:robert@letsworkshop.com">robert@letsworkshop.com</a></p>
				</header><!-- .page-header -->
			</center>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer('home'); ?>
</section>
