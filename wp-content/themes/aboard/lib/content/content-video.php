<?php /* Video Post Format */ ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	
	<?php if ( 'post' == get_post_type() ) : do_action( 'radium_post_format_icon' ); ?>
		
		<div class="entry-content-media">
		    <?php 
		    	$embed = get_post_meta($post->ID, '_radium_video_embed', true);
		    	if( !empty($embed) ) {
		    		echo "<div class='video-frame'>";
		    	    echo stripslashes(htmlspecialchars_decode($embed));
		    	    echo "</div>";
		    	} else {
		    	    radium_video($post->ID);
		    	}
		     ?>
		 </div>
		 
		<header class="entry-header clearfix">
		
			<?php if ( is_sticky() ) : ?>
	
				<?php if( is_singular() ) { ?>
				
					<h2 class="entry-title"><?php the_title(); ?></a></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
								
				<?php } else { ?>
				    
					<h2 class="entry-title"><?php the_title(); ?></a></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'radium' ); ?></h3>
								
				<?php } ?>
				
			<?php else : ?>
	
				<?php if( is_singular() ) { ?>
				
					<h2 class="entry-title"><?php the_title(); ?></a></h2>
					 
					
				<?php } else { ?>
				
					<h2 class="entry-title"><?php the_title(); ?></a></h2>
					
				<?php } ?>
				
			<?php endif; ?>
			
			<?php do_action( 'radium_post_meta' ); ?>
	
		</header><!-- .entry-header -->
				
		<article class="entry-content">
		
			<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
		
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
		
		</article><!-- END .entry-content -->
		
	<?php endif; ?>
		
</section><!-- #post-<?php the_ID(); ?> -->
