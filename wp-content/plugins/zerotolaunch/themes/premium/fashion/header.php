<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory'); ?>/images/favicon.ico" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

<script type="text/javascript">var addthis_config = {'data_track_addressbar' : false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ed37e1a67d958a7"></script>

</head>
<body <?php body_class(); ?>>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=645583505474931";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div class="wrapper">
		<div class="header">
			<div class="shell cf">
			
				<?php 
					// Check for theme options
					$website_logo = carbon_get_theme_option('website_logo');			
				?>
				
				<h1 class="logo">
				
					<?php if( ! is_page_template( 'template-landing.php' ) ) : // Remove link on landing page ?>
						<a href="<?php echo home_url('/') ?>">
					<?php endif;  ?>						
						
						<?php if( $website_logo ) : ?>
							<img src="<?php echo wpthumb( $website_logo ); ?>" alt="" />
						<?php else : ?>
							<span><?php bloginfo( 'name' ); ?></span>
						<?php endif; ?>
						
					<?php if( ! is_page_template( 'template-landing.php' ) ) echo '</a>'; // Remove link on landing page ?>					

				</h1>
				
				<h2 class="tagline"><?php bloginfo('description'); ?></h2>
				
				<?php if ( ! is_page_template( 'template-landing.php' ) ) : ?>			
					<?php get_search_form(); ?>
					<a class="nav-toggle notext" href="#">&nbsp;</a>
				<?php endif; ?>

			</div><!-- /.shell -->
		</div><!-- /.header -->
		
		<?php if ( ! is_page_template( 'template-landing.php' ) ) : ?>
			<div class="navigation">
				<div class="shell">
				<?php
					$args = array(
						'container' 		=> false,
						'theme_location' 	=> 'main-menu',
						'menu_class' 		=> 'menu',
					);
					wp_nav_menu( $args );
				?>
				</div><!-- /.shell -->
			</div><!-- /.navigation -->	
		
		<?php 	
			// Check for theme options
			$background_image = carbon_get_theme_option( 'header_graphic' );
			$header_graphic_homepage_only = carbon_get_theme_option( 'header_graphic_homepage_only' ); 
			
			$banner_enabled = true;
			
			if( $header_graphic_homepage_only ) {
				if ( ! is_front_page() ) $banner_enabled = false;
			}			
		?>
		
		<?php if( $banner_enabled == 'true' ) : ?>
			<div class="banner">
				<div class="shell">
					<?php if( $background_image ) : ?>
						<img src="<?php echo wpthumb( $background_image, array( 'width' => 1080, 'crop' => true, 'crop_from_position' => 'center,center' ) ); ?>" alt="" />
					<?php else : ?>
						<img src="<?php bloginfo('template_directory'); ?>/images/header-sample.jpg" alt="" />
					<?php endif; ?>
					
				</div><!-- /.shell -->
			</div><!-- /.banner -->
		<?php endif; ?>
				
		<?php endif; ?>