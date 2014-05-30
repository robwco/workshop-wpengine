<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
	
	<!-- media queries -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/styles/ie9.css" media="screen"/>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/styles/ie.css" media="screen"/>
	<![endif]-->
	
	<!-- add js class -->
	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>
	
	<!-- load scripts -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="header-wrap clearfix">
		<header class="header">
			<!-- grab the logo and site title -->
			<?php if ( get_theme_mod('okay_theme_customizer_logo') ) { ?>
		    	<h1 class="logo-image">
					<a href="<?php echo home_url( '/' ); ?>"><img class="logo" src="<?php echo '' .get_theme_mod( 'okay_theme_customizer_logo', '' )."\n";?>" alt="<?php the_title(); ?>" /></a>
				</h1>
		    <?php } else { ?>
		    
			    <hgroup>	
			    	<h1 class="logo-text">Digital Design Consultant <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a> <!--<i class="icon-th-large"></i>--></h1>
			    	<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
			    </hgroup>
		    
		    <?php } ?>
		    
		    <nav role="navigation" class="header-nav">	
		    	<!-- nav menu -->
		    	<?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'nav')); ?>
		    </nav>	
		</header>
	</div>

	<div id="wrapper" class="clearfix">
		<div class="inside-wrap clearfix">