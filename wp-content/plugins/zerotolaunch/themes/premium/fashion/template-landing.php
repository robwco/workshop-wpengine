<?php 
	
/* Template name: Landing Page */

get_header();
	the_post();
?>
	
	<div class="main">
		<div class="shell cf">
			
			<div class="content left">
				<h2 class="title"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div><!-- /.content -->
			
			<?php get_sidebar(); ?>

		</div><!-- /.shell -->
	</div><!-- /.main -->	

<?php get_footer(); ?>