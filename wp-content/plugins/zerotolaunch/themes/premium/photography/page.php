<?php get_header(); 
	the_post(); ?>
	
	<div class="main">
		<div class="shell cf">
			<div class="content left">
				<div class="post cf">
					<h2 class="post-title"><?php the_title(); ?></h2>

					<?php the_content(); ?>
				</div><!-- /.post -->

			</div><!-- /.content -->

			<?php get_sidebar(); ?>

		</div><!-- /.shell -->
	</div><!-- /.main -->

<?php get_footer(); ?>