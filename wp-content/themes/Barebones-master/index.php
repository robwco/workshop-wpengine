<?php get_header(); ?>
    <header role="banner">
	<p class="desc">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) );  ?>" rel="home" class="logo"><?php bloginfo( 'name' ); ?></a>
        
	

	
	<?php bloginfo( 'description' ); ?>
        </p>
<hr>
        <!-- <?php get_search_form(); ?> -->
	<?php get_template_part( 'loop', 'index' ); ?>
<?php get_footer(); ?>