<?php 
	
/* Template name: Landing */

get_header();
	the_post();
?>
	
	<div class="main">
		<div class="shell cf">
			<h2><?php the_title(); ?></h2>

			<?php get_sidebar(); ?>
			
			<div class="content left">
				<?php the_content(); ?>
			</div><!-- /.content -->

		</div><!-- /.shell -->
	</div><!-- /.main -->	

<?php get_footer(); ?>