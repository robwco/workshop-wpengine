<?php 

/* Template name: Home */

get_header();
	the_post();
?>
	
	<div class="banner">
		<?php if ( $hero = crb_get_meta( '_home_image' ) ) : ?>
		<img src="<?php echo wpthumb( $hero, array( 'width' => 1600, 'height' => 460 ) ); ?>" alt="" class="bg"/>
		<?php endif; ?>
		<div class="shell">
			<div class="text">
				<?php the_content(); ?>

				<?php if ( $url = crb_get_meta('_start_url') ) :  ?>
				<a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Start Here' ); ?></a>
				<?php endif; ?>
			</div><!-- /.text -->
		</div><!-- /.shell -->
	</div><!-- /.banner -->

	<div class="container">
		<div class="shell cf home-main">
			<?php if ( $image = get_option( 'bio_image' ) ) : ?>
			<img src="<?php echo wpthumb( $image, array( 'width' => 140, 'height' => 140 ) ) ?>" alt="" class="alignleft" />
			<?php endif; ?>

			<?php echo apply_filters('the_content', get_option('bio_text')); ?>
		</div><!-- /.shell -->
	</div><!-- /.container -->

	<div class="main">
		<div class="shell cf">

			<?php get_sidebar(); ?>
			
			<div class="content left">
				<div class="posts">
					<h4 class="posts-title"><?php _e( 'Latest From my Blog' ); ?></h4>
					<?php
						$count = 3;
						if ( crb_get_meta( '_posts_count' ) ) {
							$count = crb_get_meta( '_posts_count' );
						}

						query_posts( 'posts_per_page=' . $count );
						$show_paging = false;
						include( locate_template('loop.php') );
						wp_reset_query();
					?>
				</div><!-- /.posts -->

			</div><!-- /.content -->

		</div><!-- /.shell -->
	</div><!-- /.main -->

<?php get_footer(); ?>