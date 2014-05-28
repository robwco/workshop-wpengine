<?php /* The default template for displaying content */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : do_action( 'radium_post_format_icon' ); ?>
	
		<header class="entry-header clearfix">
		
			<?php if ( is_sticky() ) : ?>
	
				<?php if( is_singular() ) { ?>
				
					<h2 class="entry-title"><span><?php the_title(); ?></span></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
								
				<?php } else { ?>
				    
					<h2 class="entry-title"><span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'radium' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
								
				<?php } ?>
				
			<?php else : ?>
	
				<?php if( is_singular() ) { ?>
				
					<h2 class="entry-title"><span><?php the_title(); ?></span></h2> 
					
				<?php } else { ?>
				
					<h2 class="entry-title">
						<span>
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'radium' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</span>
					</h2>
					
				<?php } ?>
				
			<?php endif; ?>
				
			<?php do_action( 'radium_post_meta' ); ?>
	
		</header><!-- .entry-header -->
			
		<?php 
		
		$thumb_w = 940; //Define width
		$thumb_h = 350; // Define height
		
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
		$image = radium_resize( $img_url, $thumb_w, $thumb_h, true ); //resize & crop the image
	
		if($image) : ?>	
				
		    <div class="entry-content-media">
				
				<div class="post-thumb preload">
					<?php if( is_singular() ) { ?>
					    
						<img src="<?php echo $image; ?>" class="wp-post-image" width="<?php echo $thumb_w; ?>" height="<?php echo $thumb_h; ?>" alt="" />
							
						<?php } else { ?>
					    
							<a title="<?php printf(__('Permanent Link to %s', 'radium'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
								<img src="<?php echo $image; ?>" class="wp-post-image" alt="" />
							</a>
													
					<?php } ?>
					
				</div>
				
			</div>
			
		<?php endif; ?>
			
		<article class="entry-content">
		
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
		
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
		
		</article><!-- END .entry-content -->

		
	<?php endif; ?>
	
</section><!-- #post-<?php the_ID(); ?> -->
