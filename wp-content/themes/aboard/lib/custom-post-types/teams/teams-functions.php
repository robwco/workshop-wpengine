<?php

/* -------------------------------------------------- */
/*	Team Member
/* -------------------------------------------------- */

function radium_team_member_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'id'     => '',
		'single' => '',			
	), $atts ) );
	
	//Setup thumbs	
	$thumb_w = '220'; //Define width
	$thumb_h = '220'; // Define height
	$crop 	 = false; //resize 
	$single  = true; //return array
	 
	global $post;

	$args = array('name'           => esc_attr( $id ),
				  'post_type'      => 'team',
				  'posts_per_page' => '1'
			  );

	$social_links = array(
		'behance', 'delicious', 'deviantart', 'digg', 'reddit', 'dribbble', 'zerply', 'facebook', 'flickr', 'forrst', 'github', 'pinterest', 'googleplus', 'yelp', 'lastfm', 'linkedin', 'foursquare', 'myspace', 'gowalla', 'skype', 'stumbleupon', 'tumblr', 'twitter', 'vimeo', 'youtube', 'email'
	);

	query_posts( $args );

	if( have_posts() ) while ( have_posts() ) : the_post();

		if( has_post_thumbnail() ){
		
			//get featured image
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)

			$image = radium_resize($img_url, $thumb_w, $thumb_h, $crop, $single);
		
		} else {
		
			//fallback if all image urls are false
			$image = RADIUM_IMAGES_URL . '/placeholder.gif'; 
		} 
		
		if ( radium_get_custom_field ( '_radium_job_title' ) ){
		
			$title = get_the_title() . ", " . radium_get_custom_field ( '_radium_job_title' );
			 
		} else {
		
			$title  = get_the_title();	
		
		}
		
		$output ='<div class="team"><div class="row">';
		
		$output .='<div class="four columns"><div class="profile-photo">';
		
		$output .='<div class="team-thumb post-thumb preload"><img src="'.$image.'" alt=""/></div>';
		
		$output .='<div class="social-media-links">
						<ul class="style3">';
		
						foreach ( $social_links as $social_link ) {
		
							$address = '';
		
							if( $social_link == 'twitter' )
								$address = 'http://twitter.com/';
		
							if( $social_link == 'email' )
								$address = 'mailto:';
		
							if( radium_get_custom_field( '_radium_social_link_'.$social_link ) )
								$output .= '<li class="' . esc_attr( $social_link ) . '"><a href="' . $address . radium_get_custom_field( '_radium_social_link_'.$social_link ) . '">' . esc_attr( ucfirst( $social_link ) ) . '</a></li>';
		
						}
		
		$output .= '</ul></div><!-- end .social-links -->';
		
		$output .= '</div></div>';

		$output .= '<div class="content eight columns">';

		$output .= '<header class="entry-header"><h3 class="name">'.$title.'</h3>';
					
		$output .= '<div class="entry-meta"> 
						<div class="date">
							'.radium_get_custom_field ('_radium_twitter_username').'
						</div>
					</div>
				    </header>';

		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$output .= '<div class="entry-content">'.$content.'</div>';
				
		$output .= '</div><!-- end .content -->';

		$output .= '</div></div><!-- end .team-member -->';

	endwhile;

	wp_reset_query();

	return $output;

}
//add_shortcode('team_member', 'radium_team_member_sc');