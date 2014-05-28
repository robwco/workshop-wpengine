<!DOCTYPE html>

<!--[if lt IE 7]>     <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]>        <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>>       <![endif]-->
<!--[if IE 8]>        <html class="no-js lt-ie9" <?php language_attributes(); ?>>              <![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?>><!--                               <![endif]-->

<!-- DESIGN & CODE BY THEMEBEANS OF HTTP://WWW.THEMEBEANS.COM. -->

<head>

<!-- META TAGS -->
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php if ( defined('WPSEO_VERSION') ) { wp_title(''); } else { if(is_home() OR is_404() OR is_search() ) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo bloginfo("name"); echo " | "; echo get_the_title();  } } ?></title>

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- RSS & PINGBACKS -->
<link rel="alternate" type="application/rss+xml" href="<?php radium_feed_url(); ?>"/>
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'radium' ), esc_html ( get_bloginfo('name'), 1 ) ); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

<?php wp_head(); do_action('radium_seo'); radium_analytics(true); ?>	

</head>

<body <?php body_class(); ?>>

	<?php do_action('radium_before_header'); ?>
	
	<div id="header" class="container top-bar clear">
	
		 <header id="top-header">
		 
		 <?php if ( radium_theme_supports( 'primary', 'responsive' ) ) { ?>
		 								
		 	<div id="responsive-nav" class="show-for-small">
		 		
		 		<?php
		 			radium_dropdown_menu(
		 				array( 
		 					'depth' 			=> 6,
		 					'sort_column' 		=> 'menu_order',
		 					'theme_location' 	=> 'main-menu', 
		 					'dropdown_title' 	=> ' ',
		 					'indent_string' 	=> '&nbsp;&nbsp;&nbsp;&nbsp;',
		 					'indent_after' 		=> '',
		 					'fallback_cb' 		=> 'radium_mobile_nav_fallback_cb'
		 				) 
		 			); 
		 		?>
		 		
		 	</div> <!-- END #responsive-nav --> 
		 
		 	<?php } ?>	
		 	
		 	<div class="row">
			 	
			 	<div class="twelve columns">	
			 	
					<div id="top">
						
						<div class="row">
							
							<div class="three columns">
								
								<div id="branding">
									
									<div id="logo">
		 							
		 								<?php do_action( 'radium_header_logo' ); ?>
									
									</div>
								
								</div><!-- END #branding -->
							
							</div><!-- END .three columns -->	
							
							<?php if ( radium_theme_supports( 'primary', 'menu') ){ ?>	
							
								<nav id="navigation" class="hide-for-small" role="navigation">
									
									<div class="nine columns">
										
										<div class="container">
												
												<div class="main_menu">
													
													<?php
														$args = array(
														    'container' 	=> '',
														    'menu_id' 		=> 'main-menu',
														    'menu_class' 	=> 'radium_mega menu',
														    'fallback_cb' 	=> 'radium_fallback_menu',
														    'depth' 		=> 5,
														    'menu' 			=> 'Main Menu',
															'theme_location' => 'main-menu',
														    //'walker' 		=> new radium_walker()
														);
																
														wp_nav_menu( apply_filters( 'radium_main_menu_args', $args ) );
													 ?>
													 
												</div><!-- END .main_menu -->	
											
											</div><!-- END .container -->
									
									</div><!-- END .nine columns -->
								
								</nav><!-- END #navigation -->

							<?php } ?>
														
						</div><!-- END .row -->
					
					</div><!-- END #top -->
			 	
			 	</div><!-- END .twelve columns -->
			
			</div><!-- END .row -->
		
		</header><!-- END #top-header -->
		 
	</div><!-- END #header -->
	
	<?php 
	
	do_action( 'radium_after_header' );
	
  	if( !is_singular( 'post' )  ) { ?>
	 	
	 	<header id="page-header" class="clear">
	 		
	 		<div class="inner">
		 		
		 		<div class="row">
					
					<div class="twelve columns">
						
						<div id="header-title">
							
							<?php get_template_part( 'lib/content/content', 'header' ); ?>
						
						</div><!-- END #header-title -->
		 	      	
		 	      	</div><!-- END .twelve columns -->
		 	    
		 	    </div><!-- END .row -->
	 	    
	 	    </div><!-- END .inner-->
	 	
	 	</header><!-- END #page-header -->
	
	<?php 
	}
	
	do_action( 'radium_before_content_container' ); ?>
	
	<section id="main-container" class="clear">
		
		<div class="row">