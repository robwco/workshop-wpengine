<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
	
				<!-- titles -->
				<?php if(is_search()) { ?>
					<h2 class="archive-title"><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $count = $allsearch->post_count; _e('&nbsp;', 'okay'); echo $count . ' '; wp_reset_query(); ?><?php _e('Results for','okay'); ?> "<?php the_search_query() ?>" </h2>
				<?php } else if(is_tag()) { ?>
					<h2 class="archive-title"><?php _e('Tag','okay'); ?> / <?php single_tag_title(); ?></h2>
				<?php } else if(is_day()) { ?>
					<h2 class="archive-title"><?php _e('Archive:','okay'); ?> / <?php echo get_the_date(); ?></h2>
				<?php } else if(is_month()) { ?>
					<h2 class="archive-title"><?php _e('Archive','okay'); ?> / <?php echo get_the_date('F Y'); ?></h2>
				<?php } else if(is_year()) { ?>
					<h2 class="archive-title"><?php _e('Archive','okay'); ?> / <?php echo get_the_date('Y'); ?></h2>
				<?php } else if(is_404()) { ?>
					<h2 class="archive-title"><?php _e('Page Not Found!','okay'); ?></h2>
				<?php } else if(is_category()) { ?>
					<h2 class="archive-title"><?php _e('Category','okay'); ?> / <?php single_cat_title(); ?></h2>
				<?php } else if(is_post_type_archive()) { ?>
					<h2 class="archive-title"><?php _e('Category','okay'); ?> / <?php post_type_archive_title(); ?></h2>
				<?php } else if(is_author()) { ?>
					<h2 class="archive-title"><?php _e('Author','okay');
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo ' / '; echo $curauth->display_name; ?></h2>
				<?php } ?>
				
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
							
							<!-- grab the video -->
							<?php if ( get_post_meta($post->ID, 'video', true) ) { ?>
								<div class="fitvid">
									<?php echo get_post_meta($post->ID, 'video', true) ?>
								</div>
							
							<?php } else { ?>
								
								<!-- grab the featured image -->
								<?php if ( has_post_thumbnail() ) { ?>
									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'large-image' ); ?></a>
								<?php } ?>
							
							<?php } ?>
						
							<!-- post content -->
							<div class="post-content">
								<?php if(is_search() || is_archive()) { ?>
									<div class="excerpt-more">
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php _e('Read More','okay'); ?></a>
									</div>
								<?php } else { ?>
									<?php the_content(__( 'Read More','okay')); ?>
									
									<?php if(is_single() || is_page()) { ?>
										<div class="pagelink">
											<?php wp_link_pages(); ?>
										</div>
									<?php } ?>
									
									<?php if(is_single()) { ?>
										<div class="meta-wrap">
											<ul class="meta">
												<li><?php _e('Posted In:','okay'); ?> <?php the_category(', '); ?></li>
												<?php $posttags = get_the_tags(); if ($posttags) { ?>
													<li><?php _e('Tags:','okay'); ?> <?php the_tags('', ', ', ''); ?></li>
												<?php } ?>
											</ul>
											
											<div class="share">
												<!-- google plus -->
												<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><i class="icon-google-plus-sign"></i></a>
												
												<!-- facebook -->
												<a class="share-facebook" onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>"  target="blank"><i class="icon-facebook-sign"></i></a>
												
												<!-- twitter -->
												<a class="share-twitter" onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank"><i class="icon-twitter-sign"></i></a>
											</div><!-- share -->
										</div>
									<?php } ?>
								<?php } ?>
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->
				
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			
			<?php if(is_single()) { ?>	
				<div class="post-navigation-wrap">
					<ul class="post-navigation clearfix">
						<li class="prev-nav"><?php previous_post_link('%link', '<strong><i class="icon-arrow-left"></i></strong> %title'); ?></li>
						<li class="next-nav"><?php next_post_link('%link', '%title <strong><i class="icon-arrow-right"></i></strong>'); ?></li>
					</ul>
				</div>
			<?php } ?>
			
			<!-- post navigation -->
			<?php if( okay_page_has_nav() ) : ?>
				<div class="post-nav">
					<div class="post-nav-inside">
						<div class="post-nav-right"><?php previous_posts_link(__('Newer Posts', 'okay')) ?></div>
						<div class="post-nav-left"><?php next_posts_link(__('Older Posts', 'okay')) ?></div>	
					</div>
				</div>
			<?php endif; ?>
			
			<!-- comments -->
			<?php if( is_single () ) { ?>
				<?php if ('open' == $post->comment_status) { ?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
				<?php } ?>
			<?php } ?>
		</div><!-- content -->
		
		<?php get_sidebar(); ?>
	
		<!-- footer -->
		<?php get_footer(); ?>