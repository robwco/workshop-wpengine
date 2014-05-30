<?php
/**
 * The main template file.
 * 
 * @package Frontline
 * @since RadiumFramework 1.0.0
 */

get_header(); 

$options = get_option('radium_theme');

radium_sidebar_loader( $options['post_archives_layout'] ); 

?>
<div id="main" class="<?php echo $radium_content_class; ?> clearfix" role="main">

    <?php do_action('radium_before_content'); ?>
    
	<div id="post-box">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
	
				$format = get_post_format(); 
				if( false === $format ) { $format = 'standard'; }
				if( $format == 'aside' || $format == 'gallery' || $format == 'image' || $format == 'link' || $format == 'quote' || $format == 'status') { }
			
			    get_template_part( 'lib/content/content', $format ); 
			
			endwhile; else : 
	
				get_template_part( 'lib/content/content', 'not-found' ); 
	
		 	endif; 
				
		echo radium_theme_pagination(); ?>

	</div><!-- END #post-box -->
	
	<?php 
	    //After content action hook 
	    do_action('radium_after_content'); 
	?>

</div><!-- END #main -->
 
<?php if( $radium_sidebar_location === 'left' || $radium_sidebar_location === 'right' ) { ?>
 
	<aside id="sidebar" class="sidebar <?php echo $radium_sidebar_class; ?>">
		
		<div id="sidebar-main" class="sidebar">
		
			<?php get_sidebar('Sidebar'); ?>
		
		</div><!--END #sidebar-main-->
	
	</aside>

<?php }

get_footer(); ?>