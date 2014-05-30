<?php get_header(); ?>
		
	<div class="main">
		<div class="shell cf">
			
			<div class="content left">
				<div class="posts">
					<?php if ( is_category() ) : ?>
					<div class="post cf">
						<h2 class="post-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
					</div><!-- /.post -->
					<?php endif; ?>

					<?php get_template_part( 'loop' ); ?>
				</div><!-- /.posts -->
			</div><!-- /.content -->

			<?php get_sidebar(); ?>
			
		</div><!-- /.shell -->
	</div><!-- /.main -->
	
<?php get_footer(); ?>