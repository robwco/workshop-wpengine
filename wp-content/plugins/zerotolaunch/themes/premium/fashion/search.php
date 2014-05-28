<?php get_header(); ?>
		
	<div class="main">
		<div class="shell cf">
			
			<div class="content left">
				<div class="posts">
				
					<h3>Search results for: <em><?php echo get_search_query(); ?></em></h3>

					<?php get_template_part( 'loop' ); ?>
				</div><!-- /.posts -->
			</div><!-- /.content -->

			<?php get_sidebar(); ?>
			
		</div><!-- /.shell -->
	</div><!-- /.main -->
	
<?php get_footer(); ?>