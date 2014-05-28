<?php get_header(); 
	the_post(); 
	
// Check for theme options
$disable_social = carbon_get_theme_option('disable_social');
	
?>
	
	<?php if ( ! $disable_social ) { ?>
	<div class="social-bar">
		<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
		<a class="addthis_button_tweet" tw:count="vertical"></a>
		<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
		<a class="addthis_counter"></a>
	</div><!-- /.social-bar -->
	<?php } ?>

	<div class="main">
		<div class="shell cf">
			<div class="content left">
				<div class="post cf">
					<h2 class="post-title"><?php the_title(); ?></h2>
					<p class="post-meta">by <?php the_author(); ?> on <?php the_time( 'F j. Y.' ); ?>, posted in <?php the_category(', '); ?></p>

					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'post-large', array( 'class' => 'alignnone' ) );
						}
					?>

					<?php the_content(); ?>
				</div><!-- /.post -->
				
				<?php if ( ! $disable_social ) { ?>
				<div class="socials">
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
				</div><!-- /.socials -->
				<?php } ?>

				<div class="comments">
					<h3><?php _e( 'Comments' ); ?></h3>
					<?php comments_template(); ?>
				</div><!-- /.comments -->
			</div><!-- /.content -->

			<?php get_sidebar(); ?>

		</div><!-- /.shell -->
	</div><!-- /.main -->

<?php get_footer(); ?>