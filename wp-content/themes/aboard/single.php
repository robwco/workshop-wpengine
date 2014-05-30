<?php /* Single Post */

get_header(); 

radium_sidebar_loader();

$options = get_option('radium_theme');
  
?>

<div id="main" class="<?php echo $radium_content_class; ?> clearfix" role="main">

    <?php do_action('radium_before_post'); ?>
	
	<div id="post-box">

		<?php 
	
		if (have_posts()) : 
			
			do_action('radium_before_post_content');
		
			while (have_posts()) : the_post();
		    	
			    $format = get_post_format(); 
			    
			    if( false === $format ) { $format = 'standard'; }
		
			endwhile; 
			?>
			
			<h2 class="entry-title"><span><?php the_title(); ?></span></h2> 
			
			<?php do_action( 'radium_post_meta' ); ?>
			
			<h3 class="subheader"><?php echo get_post_meta( $post->ID, '_radium_subtitle', true ); ?></h3>
			
			<article class="entry-content">
				
				<?php the_content( __( '<br><br><span>Continue Reading.</span>', 'radium' ) ); ?>
				
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'radium' ) . '</span>', 'after' => '</div>' ) ); ?>
			
			</article><!-- END .entry-content -->
				
				
			<?php if ( isset($options['display_social_share'] ) ) { ?>	
			
				<div class="share-btns"> 	 					
				
						<div class="share-inner">
						
							<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text= <?php the_title(); ?> <?php the_permalink(); ?> " target="_blank" class="post-share-btn twitter-btn"><?php do_action('radium_twitter_share_button_text'); ?></a> 
							
							<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title(); ?>&amp;p[summary]=<?php do_action('radium_facebook_summary'); ?>&amp;p[url]=<?php the_permalink(); ?>&amp;&amp;p[images][0]=','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="post-share-btn facebook-btn"><?php do_action('radium_facebook_share_button_text'); ?></a> 		
							
						</div><!-- END .share-inner -->
					
				</div><!-- END .share-btns --> 
				
			<?php } // END if display_social_share (via Theme Options)	
				
				if ( isset($options['blog_about_author'] ) ) { // Show / Hide About the Author ?>
					
						<div class="about-author">
							
							<h6><span><?php _e('Meet the Author,', 'radium'); ?>&nbsp;<?php the_author_meta('display_name'); ?>.</span></h6> 
							
							<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><span class="author-count"><?php the_author_posts(); ?></span></a>
							
							<?php echo get_avatar( get_the_author_meta('user_email'), '60', '' ); ?>
							
							<div class="author-right">
							
								<p><?php the_author_meta('description'); ?></p>
							
							</div><!-- END #author-right --> 
						
						</div><!-- END #about-author --> 
			
			<?php } ?>
							
			<?php do_action('radium_after_post_content');
			
			// If the theme supports comments in posts and comments are open or we have at least one comment, load up the comment template
			// Using a customized version of 
			if( radium_theme_supports( 'comments', 'posts' ) && ( comments_open() || '0' != get_comments_number() )  ) comments_template( '', true );  
			
		 endif; ?>
		
 	</div><!-- END #postbox -->
 	
	<?php do_action('radium_after_post'); ?>
		
</div><!-- END #main -->

<?php 
	
	if ( function_exists( 'dynamic_sidebar' ) && function_exists( 'is_active_sidebar' ) ) { 

		if ( $radium_sidebar_location === 'left' || $radium_sidebar_location === 'right' ) { ?>
	 
		<aside id="sidebar" class="sidebar <?php echo $radium_sidebar_class; ?>">
			
			<div id="sidebar-main" class="sidebar">
			
				<?php get_sidebar('Sidebar'); ?>
			
			</div><!--END #Sidebar-main-->
		
		</aside>
	
		<?php }
} ?>

<?php get_footer(); ?>