<?php
/**
Default Template.
*/
?>

<?php get_header(); ?>

<div id="main" class="twelve columns clearfix" role="main">
	
	<?php 
	
 	    do_action('radium_before_content'); 
	
		while ( have_posts() ) : the_post();
	
			get_template_part( 'lib/content/content', 'page' ); 
	
		endwhile; // end of the loop.
	 
 	    do_action('radium_after_content'); 
	    
	   // If the theme supports comments in pages and comments are open or we have at least one comment, load up the comment template
	   if( radium_theme_supports( 'comments', 'pages' ) && ( comments_open() || '0' != get_comments_number() )  ) comments_template( '', true ); 
	    
	?>
	
</div><!-- END #main -->

<?php get_footer(); ?>