<?php
/*
Template Name: Team Members
*/

get_header(); 

//Get Global Page Settings
$page_columns = get_post_meta ($post->ID, '_radium_ctp_page_columns', true);
     
//Setup thumbs	
$thumb_w = '140'; //Define width
$thumb_h = '140'; // Define height
$crop = true; //resize 
$single = true; //return array
	 
?>

<div id="main" class="twelve columns clearfix" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="page-box">
		
	  		<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?> 
				</div>
			<?php endwhile; endif;  // end of the loop. 
		
 			//Load Query
			$args = array(
			    'post_type' => 'team',
			    'orderby' => 'menu_order',
			    'order' => 'ASC',
			    'posts_per_page' => -1,
			    
			); 		  
		
			query_posts($args);
			
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
				<div class="team">
				
					<div class="row">
					
					   <div class="two columns">
					   
							<div class="team-profile">							
											
								<div class="profile-photo">
									
									<?php if( has_post_thumbnail() ) { 
									 
										//get featured image
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
			
										$image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
									
									} else {
									 
										//fallback if all image urls are false
										$image = RADIUM_IMAGES_URL . '/placeholder.gif'; 
									
									}?>
									
									<div class="team-thumb post-thumb preload">
									
										<img src="<?php echo $image ?>" alt=""/>
										
									</div><!-- END .team-thumb .post-thumb preload -->
								
								</div><!-- END .profile-photo -->
								
								<div class="team-content content">
								
									<header class="entry-header">
									
										<h3>
											<?php if(get_post_meta ($post->ID, '_radium_job_title', true)) {
											      
											      echo get_the_title(),"<br/><span class='job-title'>", get_post_meta ($post->ID, '_radium_job_title', true)."</span>";
											
											}     else { get_the_title();
												
											}
											?>
										</h3>
										
										<div class="team-twitter">
										
											<?php if(get_post_meta ($post->ID, '_radium_twitter_username', true)) {
												  echo "<span>@</span>";
											}		
												  else { 
												  
												  echo "<span>&nbsp;</span>";											
											}
											
											?><a href="http://www.twitter.com/<?php echo get_post_meta ($post->ID, '_radium_twitter_username', true); ?>"><?php echo get_post_meta ($post->ID, '_radium_twitter_username', true); ?></a>
										
										</div><!-- END .team-twitter -->
										
									</header><!-- END .entry-header -->
									
									<?php
										$content = get_the_content();
										$content = apply_filters( 'the_content', $content ); 
									?>
									
								</div><!-- END .team-content .content -->					
																
							</div><!-- END .team-profile -->
							
						</div><!-- END .two columns -->
						
					</div><!-- END .row -->
					
				</div><!-- END .team -->
		
			<?php endwhile; endif; ?>	
		
		<?php wp_reset_query(); ?>
		
		</div><!-- END .page-box -->
		
	</article>
	
</div><!-- #main -->

<?php get_footer(); ?>