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
				<h1 class="logo notext"><a href="<?php echo home_url('/') ?>"><?php bloginfo( 'name' ); ?></a></h1><!-- /.logo notext -->

				<?php if ( is_page_template( 'template-landing.php' ) ) : ?>
					
					<div class="top-text">
						<img src="<?php bloginfo( 'stylesheet_directory'); ?>/images/top-image.jpg" alt="" class="alignright" />
						<?php echo apply_filters('the_content', get_option('top_landing_text')); ?>
					</div><!-- /.text -->

				<?php else : ?>

				<a href="#" class="nav-toggle notext">&nbsp;</a>
				<div class="navigation">
					<?php
						$args = array(
							'container' 		=> false,
							'theme_location' 	=> 'main-menu',
							'menu_class' 		=> 'menu',
						);

						wp_nav_menu( $args );
					?>
				</div><!-- /.navigation -->
				
				<?php endif; ?>

			</div><!-- /.shell -->
		</div><!-- /.header -->