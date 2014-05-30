<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<article <?php post_class('post'); ?>>
					<!-- grab the video -->
					<?php if ( get_post_meta($post->ID, 'video', true) ) { ?>
						<div class="fitvid">
							<?php echo get_post_meta($post->ID, 'video', true) ?>
						</div>
					<?php } ?>
					
					<div class="image-wrap">	
						<?php if (function_exists('okay_gallery')) { okay_gallery(); } else { ?>
				
							<!-- Backwards compatible gallery. Updating is encouraged, as this will be removed in a few versions.  -->		
							
							<?php 
								//find images in the content with "wp-image-{n}" in the class name
								preg_match_all('/<img[^>]?class=["|\'][^"]*wp-image-([0-9]*)[^"]*["|\'][^>]*>/i', get_the_content(), $result);  
								
								$exclude_imgs = $result[1];
								
								$args = array(
									'order'          => 'ASC',
									'orderby'        => 'menu_order ID',
									'post_type'      => 'attachment',
									'post_parent'    => $post->ID,
									'exclude'		 => $exclude_imgs,
									'post_mime_type' => 'image',
									'post_status'    => null,
									'numberposts'    => -1,
								);
								
								$attachments = get_posts($args);
								if ($attachments) {
								
								echo "<div class='gallery-wrap'><div class='flexslider'><ul class='slides'>";
									foreach ($attachments as $attachment) {
										echo "<li> <a class='view' rel='lightbox' href='". get_attachment_link($attachment_id) ."'>";
										echo wp_get_attachment_image($attachment->ID, 'large-image', false, false);
										echo "</a></li>";
									}
								echo "</ul></div></div>"; 
								
								}
							?>
						
						<?php } ?>
					</div><!-- image wrap -->
				</article><!-- post-->
				
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			
		</div><!-- content -->
		
		<div id="sidebar" class="sidebar-portfolio">
			<div class="widget">
				<div class="portfolio-title">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
			</div>
			
			<?php echo get_the_term_list( $post->ID, 'categories', '<div class="widget"><ul><li>' . __('Posted In: ', 'okay'), ', ', '</li></ul></div>' ); ?>
			
			<div class="widget">
				<ul class="next-prev-side">														
					<li><?php next_post_link('%link', __('<span>Next:</span> %title', 'okay')) ?></li>
					<li><?php previous_post_link('%link', __('<span>Previous:</span> %title', 'okay')) ?></li>
				</ul>
			</div>
		</div>
	
		<!-- footer -->
		<?php get_footer(); ?>