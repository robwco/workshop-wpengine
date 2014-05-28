<?php
/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*                    																			  */
/*                    																			  */ 
/*     GENERAL THEME FUNCTIONS																	  */
/*     PLAY SAFE YOUNG ONE, INCORRECT MOsDIFICATIONS TO THIS CODE CAN BREAK THINGS BIG TIME. 	  */
/*                    																			  */
/*                    																			  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/


/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     CLEAN UP THE <HEAD>																		  */ 
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/

//remove_action('wp_head','feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
//remove_action('wp_head','feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
//remove_action('wp_head','rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
//remove_action('wp_head','wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
//remove_action('wp_head','index_rel_link'); // index link
//remove_action('wp_head','parent_post_rel_link', 10, 0); // prev link
//remove_action('wp_head','start_post_rel_link', 10, 0); // start link
//remove_action('wp_head','adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.

  remove_action('wp_head','wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version



//Remove Inline Style added by Multisite in the Signup Form
if ( !function_exists('radium_wpmu_signup_stylesheet') ) {
	
	function radium_wpmu_signup_stylesheet() {
		remove_action( 'wp_head', 'wpmu_signup_stylesheet');
	}
	add_action( 'wp_head', 'radium_wpmu_signup_stylesheet', 1 );
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*      REMOVE UNNECESSARY DASHBOARD WIDGETS													  */
/*      @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html	  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_remove_dashboard_widgets') ) {

	function radium_remove_dashboard_widgets() {
	  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	}
	
	add_action('admin_init', 'radium_remove_dashboard_widgets');
	
}
		
		
		
/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     ADD THEME OPTIONS BUTTON TO ADMIN HEADER													  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
add_action('admin_bar_menu', 'bean_add_toolbar_items', 100);
function bean_add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'theme-options',
		'title' => 'Theme Options',
		'href'  => ''.get_admin_url().'themes.php?page=bean_options',	
		'meta'  => array(
		'title' => __('Theme Options'),			
		),
	));
}



		
/*--------------------------------------------------------------------*/         							
/*  FOOTER TYPE EDIT									 					
/*--------------------------------------------------------------------*/
function bean_footer_admin () {  
  echo 'Thank you for creating with <a href="http://themebeans.com/?ref=wp_footer" target="blank">ThemeBeans</a>. You rock.';  
}  
  
add_filter('admin_footer_text', 'bean_footer_admin');  




		
/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     FIX FOR CATEGORY REL TAG (PRODUCES INVALID HTML5 CODE)									  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_add_nofollow_cat') ) {
	 
	function radium_add_nofollow_cat( $text ) {
	
		$text = str_replace('rel="category tag"', "", $text); 
		
		return $text;
		
	}
	add_filter( 'the_category', 'radium_add_nofollow_cat' ); 
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/* 	 OVERRIDE DEFAULT LOGO IF SET IN OPTIONS RADIUM_CUSTOM_LOGO()								  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_custom_logo') ) {

	function radium_custom_logo() {
	  	
	  	$options = get_option('radium_theme');
	  
	  	?>
	  	
	  	<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home">
	
	 		<?php 
	 		
	 		// if there is text defined (instead of logo), display it
			if(!$options['logo']) { ?>
			
				 <h1 id="logo_text"><?php echo bloginfo( 'name' ); ?></h1>
				 
	 		 <?php 
	 		 
	 		 } else { // display custom logo (if defined) or default logo
			
				$logo_img = $options['logo'];
				
				if(empty($logo_img)) { $logo_img = RADIUM_IMAGES_URL.'/logo.png'; } ?>
				
				<!-- Custom Logo -->
				<img src=" <?php echo $logo_img; ?>" class="logo" alt="logo"/>	
							
			<?php } 
			
			if( isset($options['site_description']) ){ ?><div id='branding-tagline'><p><?php echo bloginfo( 'description' ); ?></p></div> <?php } 
			
			?>
			  
		</a>
		
		<?php  
	 
	 }
	add_action('radium_header_logo', 'radium_custom_logo');
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     CUSTOM ADMIN & LOGIN LOGO																  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_login_head') ) {
 
	function radium_login_head() {
	  	
	  	$options = get_option('radium_theme');
	
		/* Setup settings to use */
		$logo_url = '';
		if ( isset($options['logo']) && $options['logo'] != '' ) {
			$logo_url = $options['logo'];
		}
		if ( $logo_url != '' ) {
			$dimensions = @getimagesize( $logo_url );
			echo '<style>' . "\n" . 'body.login #login h1 a { background: url("' . $logo_url . '") no-repeat scroll center top transparent; height: ' . $dimensions[1] . 'px; width: auto!important; background-size: auto !important; }' . "\n" . '</style>' . "\n";
			
		}
	
	} // End radium_login_head()
	add_filter('login_head', 'radium_login_head');	
}

if ( !function_exists('radium_login_header_url') ) {

	function radium_login_header_url($url) {
		
		$options = get_option('radium_theme');
		
		/* Setup settings to use */
		$login_url = home_url();
	
		return $login_url;
	    
	} // End radium_login_header_url()
	add_filter('login_headerurl', 'radium_login_header_url');
}

if ( !function_exists('radium_login_header_title') ) {

	function radium_login_header_title($title) {
	
		$title_text = get_bloginfo('name').' &raquo; Log In';
	
		return $title_text;
	
	} // End radium_login_header_title()
	add_filter('login_headertitle', 'radium_login_header_title');
}	
	
	
	

/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     CUSTOM FAVICON AND APPLE TOUCH ICON														  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_add_favicon') ) {

	function radium_add_favicon() { 
	
	 	$options = get_option('radium_theme');
		
		$favicon = $options['favicon'];
		$appleicon = $options['appleicon'];
		
		if(empty($favicon)) { 
			$favicon = RADIUM_IMAGES_URL.'/favicon.png';
		}
		
		if(empty($appleicon)) { 
			$appleicon = RADIUM_IMAGES_URL.'/apple-touch-icon.png';
		}
		?>
			<link rel="shortcut icon" href="<?php echo $favicon ?>"/> 
			<link rel="apple-touch-icon-precomposed" href="<?php echo $appleicon ?>"/>
			
		<?php 
	}
	
	add_action('wp_head', 'radium_add_favicon');
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     RENDERS THE THEME FEED URL (USER OR WORDPRESS FEED)										  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_feed_url') ) {
	
	function radium_feed_url() {
		
 		$options = get_option('radium_theme');
 	
 		if ( isset( $options['feedburner_url'] ) ) {
 		
 			echo $options['feedburner_url'];
 			
		} else {
		
			 echo get_bloginfo_rss('rss2_url');
			 
		}
		
	} // end get_feed_url
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     PASSWORD BOX FILTER																		  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('custom_password_form') ) {

	function custom_password_form() {
	
		global $post;
	  	
			$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
			
			$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="post-password-form">
			<p>' . __("This post is password protected. To view it please enter your password below:", 'radium') . '</p>
			
			<div class="row">
				<label for="' . $label . '">' . __( "Password:", 'radium' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input class="button" type="submit" name="Submit" value="' . esc_attr__("Submit") . '" />
			</div>
		</form>
			';
			return $output;
	}
	add_filter( 'the_password_form', 'custom_password_form' );
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     POST META 																				  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_posted_on') ) {
	
	/* Time and Date*/
	function radium_posted_on() {
		printf( __( '<p>Posted <time class="entry-date" datetime="%3$s">%4$s</time>', 'radium' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'radium' ), get_the_author() ) ),
			get_the_author()
		);
	}

}



if ( !function_exists('radium_post_meta') ) {

	/* Meta Loader for Frontend */
	function radium_post_meta() { ?>
	
	    <div class="entry-meta ">
	    	
	    	<?php radium_posted_on(); ?>
	    	
<!--	    	<?php /* translators: used between list items, there is a space after the comma */
	    	    $categories_list = get_the_category_list( __( ' &#92; ', 'radium' ) );
	    	    if ( $categories_list ):        			
	    	?>
	    	
	 		<?php echo 'in '; printf( __( ' %2$s', 'radium' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>

	    	<?php endif; // End if categories ?>
-->	    	
	    	
	    	<?php $options = get_option('radium_theme'); ?>
	    	
	    	<?php if ( isset($options['post_author_label'] ) ) { ?>
	    	
	    		<?php echo 'by '; the_author(); ?> 
	    	
	    	<?php } 
	    	
	    	?>
	    	
	    	<?php if ( comments_open() && ! post_password_required() ) : ?>
	    	
		    	<?php // Check to see if post has commments
		    	if (get_comments_number()==0) {
		    	    // post has no comments
		    	} else {
		    	     echo 'with';
		    	}
		    	?>
		    	
		    	<?php comments_popup_link( '', _x( '1 Comment.', 'comments number', 'radium' ), _x( '% Comments.', 'comments number', 'radium' ) ); ?>
	    	
	    	<?php endif; 
	    	
	    	edit_post_link( __( '&nbsp;&nbsp;&nbsp;( Edit )', 'radium' ), '', '</p>' ); ?>
	    	
	    </div><!-- END .entry-meta --><?php
	
	}
	add_action('radium_post_meta','radium_post_meta');

}


  
  
/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     FOOTER TRACKING CODE																		  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_footer_trackingcode') ) {

	function radium_footer_trackingcode() {
		$options = get_option('radium_theme');
		
		if ( isset($options['trackingcode'] ) )
			echo $options['trackingcode'];
	}

}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*      LOAD SINGLE POST NAVIGATION																  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_single_posts_navigation') ) {

	function radium_single_posts_navigation() { 
	
		if( is_single() ) : ?>
	
			<div class="pagination">
				<span class="pagination-arrows">
					<span class="page-previous">
						<?php previous_post_link('%link', ''); ?>
					</span>
				</span>
				<span class="pagination-arrows">
					<span class="page-next">
						<?php next_post_link('%link', ''); ?>
					</span>
				</span>
			</div>
		
		<?php endif; // End if Nav 
		
	}
	add_action('radium_after_post', 'radium_single_posts_navigation');
	add_action('radium_after_portfolio', 'radium_single_posts_navigation');
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     POST TAGS																				  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_single_post_tags') ) {
  
	/* Show/hide Tags */
	function radium_single_post_tags() {
	 	
		$options = get_option('radium_theme');
		$post_tags = isset($options['post_tags']) ? $options['post_tags'] : false;
				
		if ( is_single() && ( $post_tags && array_key_exists('posts', $post_tags )) ) :  
	  		
	  		$tags_list = get_the_tag_list( '', __( '&nbsp;', 'radium' ) );
	  
			if ( $tags_list ): ?>
				<div class="tags entry-meta clearfix" >
					<div class="tags-list">
						<?php printf( __( ' %2$s', 'radium' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</div>
				</div>
			<?php endif; 
	
		endif;
	}
	add_action('radium_after_post_content', 'radium_single_post_tags');

}





/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*      RENDER THE ANALYTICS EITHER IN THE FOOTER OR HEADER DEPENDING     						  */
/*      ON WHICH PART OF THE PAGE IS CALLING THE FUNCTION						 				  */
/*                    																			  */
/*      @IsHeader                   															  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_analytics') ) {

	function radium_analytics($IsHeader) {
	
		$options = get_option('radium_theme');
		
		if($IsHeader):
			if ($options['header_analytics']):
				echo $options['header_analytics'];
			endif;
		else:
			if($options['other_analytics']):
				echo $options['other_analytics'];
			endif;
		endif;
		
	} // end radium_analytics

}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     LOAD FOOTER COPYRIGHT																	  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_footer_copyright') ) {
 
	function radium_footer_copyright(){ 
		
		$options = get_option('radium_theme');
		
		if ( isset($options['footer_copyright_text'] ) )
			echo $options['footer_copyright_text'];
	
	}
	
	add_action('radium_copyright', 'radium_footer_copyright', 1);
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     MANAGE CUSTOM 404 PAGE																	  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_404_errortext') ) {
 
	function radium_404_errortext(){ 
		
		$options = get_option('radium_theme');
		if (isset( $options['404_error_text'] ))
			echo $options['404_error_text'];
	
	}
	
	add_action('radium_errortext', 'radium_404_errortext', 1);
	
}


if( !function_exists('radium_404_error_p_text') ) {
 
	function radium_404_error_p_text(){ 
		
		$options = get_option('radium_theme');
		if (isset( $options['404_error_p_text'] ))
			echo $options['404_error_p_text'];
	
	}
	
	add_action('radium_errorptext', 'radium_404_error_p_text', 1);
	
}


if( !function_exists('radium_404_error_btntext') ) {
 
	function radium_404_error_btntext(){ 
		
		$options = get_option('radium_theme');
		if (isset( $options['404_error_btn_text'] ))
			echo $options['404_error_btn_text'];
	
	}
	
	add_action('radium_errorbtntext', 'radium_404_error_btntext', 1);
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     MANAGE PORTFOLIO TEMPLATE																  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_filtertext') ) {
 
	function radium_filtertext(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['filter_text'] ))
			echo $options['filter_text'];
	
	}
	
	add_action('radium_filter_text', 'radium_filtertext', 1);
	
}


if( !function_exists('radium_porthovertext') ) {
 
	function radium_porthovertext(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['port_hover_text'] ))
			echo $options['port_hover_text'];
	
	}
	
	add_action('radium_port_hover_text', 'radium_porthovertext', 1);
	
}


if( !function_exists('radium_portrelatedtext') ) {
 
	function radium_portrelatedtext(){ 
		
		$options = get_option('radium_theme');
				
		if (isset( $options['port_related_text'] ))
			echo $options['port_related_text'];
	
	}
	
	add_action('radium_port_related_text', 'radium_portrelatedtext', 1);
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     MANAGE ARCHIVES TEMPLATE & SEARCH													  	  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_archive_alltext') ) {
 
	function radium_archive_alltext(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['archive_all_text'] ))
			echo $options['archive_all_text'];
	
	}
	
	add_action('radium_archive_all_text', 'radium_archive_alltext', 1);
	
}


if( !function_exists('radium_archive_latest') ) {
 
	function radium_archive_latest(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['archive_latest'] ))
			echo $options['archive_latest'];
	
	}
	
	add_action('radium_archive_latest', 'radium_archive_latest', 1);
	
}


if( !function_exists('radium_archive_monthly') ) {
 
	function radium_archive_monthly(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['archive_monthly'] ))
			echo $options['archive_monthly'];
	
	}
	
	add_action('radium_archive_monthly', 'radium_archive_monthly', 1);
	
}


if( !function_exists('radium_archive_category') ) {
 
	function radium_archive_category(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['archive_category'] ))
			echo $options['archive_category'];
	
	}
	
	add_action('radium_archive_category', 'radium_archive_category', 1);
	
}


if( !function_exists('radium_archive_sitemap') ) {
 
	function radium_archive_sitemap(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['archive_sitemap'] ))
			echo $options['archive_sitemap'];
	
	}
	
	add_action('radium_archive_sitemap', 'radium_archive_sitemap', 1);
	
}


if( !function_exists('radium_search_header_text') ) {
 
	function radium_search_header_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['search_header_text'] ))
			echo $options['search_header_text'];
	
	}
	
	add_action('radium_search_header_text', 'radium_search_header_text', 1);
	
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     MANAGE COMMENTS / POSTS																  	  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_comment_btntext') ) {
 
	function radium_comment_btntext(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['comment_btntext'] ))
			echo $options['comment_btntext'];
	
	}
	
	add_action('radium_commentbtntext', 'radium_comment_btntext', 1);
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     CONTROL EXCERPT LOOK & LENGTH   															  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
function custom_excerpt_length( $length ) {
	return 21;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     HIDE VIEW POST FUNCTIONALITY FOR CUSTOM POST FORMATS   									  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
function posttype_admin_css() {
    global $post_type;
    if($post_type == 'team'|| $post_type == 'slider') {
    echo '<style type="text/css">#view-post-btn,#post-preview,.updated a, span.view {display: none;}</style>';
    }
}




/*------------------------------------------------------------------------------------------------*/
/*                    																			  */
/*     LOAD PORTFOLIO FILTER MENU (IF SELECTED)			   										  */
/*                    																			  */
/*------------------------------------------------------------------------------------------------*/
if ( !function_exists('radium_portfolio_filter') ) {

function radium_portfolio_filter() {
if ( is_page_template('page-portfolio.php') && radium_get_custom_field ('_radium_cpt_sorting') !== '0' ) { ?>

<div id="content-nav-bar">
	
	<div class="row">
	
	   <div class="twelve columns">
	
	        <nav id="filter">
	
		        <h5><?php do_action('radium_filter_text'); ?></h5>
		        
		        <ul id="sort-by">
		        
		           <li><a href="#all" data-filter="page-grid-item" class="active"><?php _e('All', 'radium'); ?></a></li>
		        
		           <?php 
		               wp_list_categories( array(
		                   'title_li' => '', 
		                   'taxonomy' => 'portfolio_category', 
		                   'walker' => new Portfolio_Walker() )
		               ); 
		           ?>
		        
		        </ul><!-- END #sort-by --> 
		        
	        </nav><!--END #filter--> 
	   
	    </div><!--END #filter--> 
	
	</div><!-- END .row --> 

</div><!-- END #content-nav-bar --> 

<?php }
}

add_action('radium_after_content', 'radium_portfolio_filter', 999);

}





/*------------------------------------------------------------------------------------------------*/
/*                    						
/*     MANAGE SOCIAL SHARE THEME OPTIONS		
/*                    						
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_share_title_text') ) {
 
	function radium_share_title_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['share_title_text'] ))
			echo $options['share_title_text'];
	
	}
	
	add_action('radium_share_title_text', 'radium_share_title_text', 1);
	
}


if( !function_exists('radium_facebook_share_button_text') ) {
 
	function radium_facebook_share_button_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['facebook_share_button_text'] ))
			echo $options['facebook_share_button_text'];
	
	}
	
	add_action('radium_facebook_share_button_text', 'radium_facebook_share_button_text', 1);
	
}


if( !function_exists('radium_twitter_share_button_text') ) {
 
	function radium_twitter_share_button_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['twitter_share_button_text'] ))
			echo $options['twitter_share_button_text'];
	
	}
	
	add_action('radium_twitter_share_button_text', 'radium_twitter_share_button_text', 1);
	
}


if( !function_exists('radium_facebook_summary') ) {
 
	function radium_facebook_summary(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['facebook_summary'] ))
			echo $options['facebook_summary'];
	
	}
	
	add_action('radium_facebook_summary', 'radium_facebook_summary', 1);
	
}





/*------------------------------------------------------------------------------------------------*/
/*                    						
/*     BLOG HOME PAGE THEME OPTIONS INPUT		
/*                    						
/*------------------------------------------------------------------------------------------------*/
if( !function_exists('radium_blog_header_text') ) {
 
	function radium_blog_header_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['blog_header_text'] ))
			  echo $options['blog_header_text'];
	
	}
	
	add_action('radium_blog_header_text', 'radium_blog_header_text', 1);
}


if( !function_exists('blog_sub_header_text') ) {
 
	function radium_blog_sub_header_text(){ 
		
		$options = get_option('radium_theme');
		
		if (isset( $options['blog_sub_header_text'] ))
			  echo $options['blog_sub_header_text'];
	
	}
	
	add_action('radium_blog_sub_header_text', 'radium_blog_sub_header_text', 1);
}




/*--------------------------------------------------------------------*/                							
/*  CUSTOM CSS LOADER - THEME OPTIONS INPUT				                							
/*--------------------------------------------------------------------*/
// CSS INPUT
if( !function_exists('bean_custom_css_input') ) {
 
	function bean_custom_css_input(){ $options = get_option('radium_theme');
		
		if ( isset($options['bean_custom_css_input'] ) )
			  echo $options['bean_custom_css_input'];
	
	}
	
	add_action('bean_custom_css_input', 'bean_custom_css_input', 1);
	
}
// CSS OUTPUT
if ( !function_exists('bean_custom_css_styles') ) {

	function bean_custom_css_styles() { ?>
	
		<style><?php do_action('bean_custom_css_input'); ?></style>		
				
<?php } add_action('wp_head','bean_custom_css_styles'); }