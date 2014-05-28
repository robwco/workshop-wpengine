<?php /* Aside Post Format */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : do_action( 'radium_post_format_icon' ); ?>
					
		<article class="entry-content">
		
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
		
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
		
		</article><!-- END .entry-content -->
		
	<?php endif; ?>
	
</section><!-- #post-<?php the_ID(); ?> -->
