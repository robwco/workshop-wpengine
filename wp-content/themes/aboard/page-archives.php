<?php
/*
Template Name: Archives
*/

get_header(); 

?>

<div id="main" class="twelve columns clearfix" role="main">
		
	<?php while ( have_posts() ) : the_post(); 
	
		get_template_part( 'lib/content/content', 'page' ); 
	
	endwhile; // end of the loop. 
		
	$options = get_option('radium_theme');
	
	$sitemap_content = isset($options['archives_content']) ? $options['archives_content'] : false;
	
	 if ( $sitemap_content && array_key_exists('posts', $sitemap_content)) { ?>
	<div class="twelve columns">
	
		<div class="archives">
			
			<div class="row">
			
				<h2 class="entry-header"><?php do_action('radium_archive_all_text'); ?></h2>
			   	
			   	<div class="archives-list">
			   	
			         <ul>
			             <?php $archive_query = new WP_Query('showposts=60');
			             while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
			             
			             <li>
			                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
			                    <?php the_title(); ?>
			                </a> 
			            </li>
			            
			         	<?php endwhile; ?>
			         	
			      	</ul>
			      	
			   </div><!-- END .list-style1 -->
			   
			</div><!-- END .row -->
		
			<?php } if ( $sitemap_content && array_key_exists('latest', $sitemap_content) ) { ?>
			
				<div class="row">
				   	
				   	<h2 class="entry-header"><?php do_action('radium_archive_latest'); ?></h2>
			   		
			   		<div class="archives-list">
				   	
				   		<ul>
				   	
				   		<?php $archive_30 = get_posts('numberposts=30');
				   			foreach($archive_30 as $post) : ?>
				   			<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
				   		<?php endforeach; ?>
				   	
				   		</ul>
			   		
			   		</div><!-- END .list-style1 -->
				
				</div><!-- END .row -->
				
			<?php } if ( $sitemap_content && array_key_exists('month', $sitemap_content)) { ?>
			
				<div class="row">	
				  
				   	<h2 class="entry-header"><?php do_action('radium_archive_monthly'); ?></h2>
				   	
				   	<div class="archives-list">
				  
				   		<ul><?php wp_get_archives('type=monthly'); ?></ul>
				  
				   	</div><!-- END .list-style1 -->
				
				</div><!-- END .row -->
			
			<?php } if ( $sitemap_content && array_key_exists('category', $sitemap_content)) { ?>
			
				<div class="row">
				   	
				   	<h2 class="entry-header"><?php do_action('radium_archive_category'); ?></h2>
				   	
				   	<div class="archives-list">
				   	
				   		<ul><?php wp_list_categories( 'title_li=' ); ?></ul>
				   	
				   	</div><!-- END .list-style1 -->
				
				</div><!-- END .row -->
				
		 	<?php } if ( $sitemap_content && array_key_exists('pages', $sitemap_content) ) { ?>
		 	
				<div class="row">	
				
					<h2 class="entry-header"><?php do_action('radium_archive_sitemap'); ?></h2>
					
					<div class="archives-list">
				
						<ul><?php wp_list_pages('title_li='); ?></ul>
				
					</div><!-- END .list-style1 -->
				
				</div><!-- END .row -->
		
		 	<?php }?>
		
		</div><!-- END .archives -->    
	
	</div><!-- END .twelve columns -->     

</div><!-- END #main -->

<?php get_footer(); ?>