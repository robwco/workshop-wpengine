<?php get_header(); ?>
	
	<div class="main">
		<div class="shell cf">
			<div class="content left">
				<div class="post cf">
					<h2 class="post-title"><?php _e('Error 404 - Not Found'); ?></h2>

					<p><?php printf(__('Please check the URL for proper spelling and capitalization. If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>'), get_option('home')); ?></p>
				</div><!-- /.post -->

			</div><!-- /.content -->

			<?php get_sidebar(); ?>

		</div><!-- /.shell -->
	</div><!-- /.main -->

<?php get_footer(); ?>