<?php /* Gallery Post Format */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : do_action( 'radium_post_format_icon' ); ?>
		
		<div class="entry-content-media clearfix">
		
			<?php
			
			$thumb_w = 780; //Define width
			$thumb_h = 500; // Define height
			
			radium_gallery( $post->ID, $thumb_w, $thumb_h, true ); 
			
			?>
	
		</div>		
	 	        
		<article class="entry-content">
			
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
			
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
	
		</article><!-- END .entry-content -->
    	
    <?php endif; ?>
		
</section><!-- #post-<?php the_ID(); ?> -->
