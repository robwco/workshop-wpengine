<?php
/*
The template for displaying all FAQs.
*/
?>

<?php get_header(); ?>

<div id="main" class="twelve columns" role="main">
	
	<?php 
	
	if (have_posts()) : 
	
		//Before content action hook 
		do_action('radium_before_content'); 
		
		while ( have_posts() ) : the_post(); 
		
			get_template_part( 'lib/content/content', 'page' );
		
		endwhile; // End of the loop. 
	
		do_action('radium_after_post');
	
		comments_template( '', true );
		
		//After content action hook 
		do_action('radium_after_content'); 
		
	endif; ?>
	
</div><!-- END #main -->

<?php get_footer(); ?>