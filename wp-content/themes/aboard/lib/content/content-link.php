<?php /* Link Post Format */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : do_action( 'radium_post_format_icon' ); ?>
	
		<header class="entry-header clearfix">
			<?php if ( is_sticky() ) : ?>

				<?php if( is_singular() ) { ?>
					
					<h2 class="entry-title">
					    <a href="http://<?php echo $link; ?>"> <?php the_title(); ?> </a>
					</h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
				
				<?php } else { ?>
				    
					<h2 class="entry-title">
					    <a href="http://<?php echo $link; ?>"> <?php the_title(); ?> </a>
					</h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
								
				<?php } ?>
				
			<?php else : ?>

			<?php $link = get_post_meta($post->ID, '_radium_link_url', true); ?>
				
			<?php if( is_singular() ) { ?>
			    
			    <h2 class="entry-title">
			        <a href="http://<?php echo $link; ?>"> <?php the_title(); ?> </a>
			    </h2>
			    
			<?php } else { ?>
			    
			    <h2 class="entry-title">
			        <a href="http://<?php echo $link; ?>"> <?php the_title(); ?> </a>
			    </h2>
			    
			<?php } ?>
			
			<p><a href="http://<?php echo $link; ?>"><?php echo $link; ?></a></p>
				
				<?php endif; ?>
	
		</header><!-- .entry-header -->	
			
		<article class="entry-content">
		
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
		
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
		
		</article><!-- END .entry-content -->
		
	<?php endif; ?>
		
</section><!-- #post-<?php the_ID(); ?> -->
