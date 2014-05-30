<?php
/*
Template Name: Default, Left Sidebar
*/
?>

<?php get_header(); ?>

<div id="main" class="eight columns push-four clearfix" role="main">
	
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

<div class="sidebar four columns pull-eight">
	
	<?php if ( !dynamic_sidebar( 'Sidebar' ) ): ?><?php endif; ?>

</div><!-- END .sidebar .three columns -->

<?php get_footer(); ?>