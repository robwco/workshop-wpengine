<?php 
/* 
Template Name: Custom Archive
*/ 
?>

<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<article <?php post_class('post'); ?>>
					<div class="box-wrap">
						<div class="box">
							<header>
								<?php if(is_page()) {} else { ?>
									<div class="date-title"><?php echo get_the_date(); ?></div>
								<?php } ?>
								
								<?php if(is_single() || is_page()) { ?>
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
								<?php } else { ?>					
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<?php } ?>
							</header>
							
							<!-- grab the featured image -->
							<?php if ( has_post_thumbnail() ) { ?>
								<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'large-image' ); ?></a>
							<?php } ?>							
							
							<!-- post content -->
							<div class="post-content">
								<?php the_content(__( 'Read More','okay')); ?>
								
								<div id="archive">
									<div class="archive-col">
										<div class="archive-box">
											<h3><?php _e('Latest Posts','okay'); ?></h3>
											<ul>
												<?php wp_get_archives('type=postbypost&limit=10'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Pages','okay'); ?></h3>
											<ul>
												<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Categories','okay'); ?></h3>
											<ul>
												<?php wp_list_categories('orderby=name&title_li='); ?> 
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Archive By Day','okay'); ?></h3>
											<ul>
												<?php wp_get_archives('type=daily&limit=15'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Archive By Month','okay'); ?></h3>
											<ul>
												<?php wp_get_archives('type=monthly&limit=12'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Archive By Year','okay'); ?></h3>
											<ul>
												<?php wp_get_archives('type=yearly&limit=12'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h3><?php _e('Contributors','okay'); ?></h3>
											<ul>
												<?php wp_list_authors('show_fullname=1&optioncount=0&orderby=post_count&order=DESC'); ?>
											</ul>
										</div>
									</div><!-- column -->
								</div><!-- archive -->
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->	
				
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div><!-- content -->
		
		<?php get_sidebar(); ?>
	
		<!-- footer -->
		<?php get_footer(); ?>