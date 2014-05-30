<?php /* Image Post Format */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : 
	
		do_action( 'radium_post_format_icon' );

		$thumb_w = 780; //Define width
		$thumb_h = 500; // Define height
		
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
		$image = radium_resize( $img_url, $thumb_w, $thumb_h, true ); //resize & crop the image
		
		if($image) : ?>	
		
		<div class="entry-content-media">
			<div class="post-thumb preload">
				
				<?php if( is_singular() ) { ?>
				    
					<img src="<?php echo $image; ?>" class="wp-post-image" alt="" />
						
					<?php } else { ?>
		
					<img src="<?php echo $image; ?>" class="wp-post-image" alt=""/>
												
				<?php } ?>
				
			</div><!-- END .post-thumb .preload -->
		</div><!-- END .entry-content-media -->		
	
		<article class="entry-content">
		
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
		
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
		
		</article><!-- END .entry-content -->
		
		<?php endif; ?>
    	
    <?php endif; ?>
		
</section><!-- #post-<?php the_ID(); ?> -->
