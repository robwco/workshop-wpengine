<?php

function radium_load_framework_theme_options() {

$sections[] = array(
				'icon' => RADIUM_OPTIONS_URL.'assets/images/icons/icon-settings.png',
				'title' => __('General Options', 'radium'),
				'desc' => __('<p class="description">This page contains general theme options.</p>', 'radium'),
				'fields' => array(
				
					array(
						'id' => 'theme_style',
						'type' => 'radio_img',
						'title' => __('Theme Style', 'radium'), 
						'sub_desc' => __('Please select a style for your site. There are currently 2 styles included in this theme.', 'radium'),
						'icon' => '',
 						'options' => array(
								'default' => array(
									'title' => 'style 1', 
									'img' => RADIUM_STYLES_URL.'/default.jpg'
								),
								'2' => array(
									'title' => 'style 2', 
									'img' => RADIUM_STYLES_URL.'/2/style-thumb.jpg'
								),
							),
						'std' => '1'
						),
						
					array(
						'id' => 'logo',
						'type' => 'upload', 
						'title' => __('Upload Logo', 'radium'),
						'sub_desc' => __('Upload your custom logo here. If left empty, the site title will be displayed instead.', 'radium'),
						),
 					
					array(
						'id' => 'favicon',
						'type' => 'upload', 
						'title' => __('Upload Favicon', 'radium'),
						'sub_desc' => __('Upload a favicon here that will override the default favicon. (16px by 16px)', 'radium'),
						),
					
					array(
						'id' => 'appleicon',
						'type' => 'upload', 
						'title' => __('Upload Apple Touch Icon', 'radium'),
						'sub_desc' => __('Upload you custom icon which will be displayed when your website is saved to an iOS device homescreen. (144px by 144px)', 'radium'),
						),
					
					array(
						'id' => 'not_animated',
						'type' => 'checkbox',
						'title' => __( 'Disable Theme Animations', 'bean'), 
						'sub_desc' => __('Elect to turn off the CSS3 animations.', 'bean'),
						'desc' => __('Yes do it', 'bean'),
						'std' => 0 
						),
					
					array(
						'id' => 'header_analytics',
						'type' => 'textarea',
						'title' => __('Header Analytics', 'radium'),
						'sub_desc' => __('Paste any analytics code that belongs in the head element of your site here.', 'radium'),
						'std' => ''
						),
					
					array(
						'id' => 'other_analytics',
						'type' => 'textarea',
						'title' => __('Footer Analytics', 'radium'),
						'sub_desc' => __('Paste any analytics code that belongs before the closing body tag here.', 'radium'),
						'std' => ''
						),
							
					array(
						'id' => 'footer_copyright_text',
						'type' => 'textarea',
						'title' => __('Footer Copyright', 'radium'),
						'sub_desc' => __('This text overrides the default copyright message located in the theme footer.', 'radium'),
						'std' => 'Copyright © 2013 <a href="http://themeforest.net/item/aboard-responsive-premium-portfolio-theme/3614657/?ref=themebeans">Aboard</a>.  A <a href="http://www.themebeans.com">ThemeBeans</a> Production.'
						),			
 					)
				);
				
$sections[] = array(
				'icon' => RADIUM_OPTIONS_URL.'assets/images/icons/icon-page.png',
				'title' => __('Posts Settings', 'radium'),
				'desc' => __('<p class="description">Manage multiple general page & blog view settings.</p>', 'radium'),
				'icon' => '',
				'fields' => array(
 					
 					array(
 						'id' => 'blog_header_text',
 						'type' => 'text',
 						'title' => __('Blog Home Title:', 'radium'),
 						'sub_desc' => __('Customize the header title of the blog posts page.', 'radium'),
 						'std' => 'Ramblings'
 						),	
 					
 					array(
 						'id' => 'blog_sub_header_text',
 						'type' => 'text',
 						'title' => __('Blog Home SubHeader:', 'radium'),
 						'sub_desc' => __('Customize the subheader of the blog posts page.', 'radium'),
 						'std' => 'Welcome to the Aboard Blog. We sure are wild about posts...'
 						),	
 								
					array(
						'id' => 'post_tags',
						'type' => 'multi_checkbox',
						'title' => __( 'Show Post Tags', 'radium'), 
						'sub_desc' => __('Elect to display post tags on your blog single pages which will appear below the content.', 'radium'),
						'options' => array(
							'posts'     => 'Yes, do it.',
						),
						'std' => array(
							'posts'     => '0', 
							'portfolio' => '0', 
						)
					),
					
					array(
						'id' => 'post_author_label',
						'type' => 'checkbox',
						'title' => __( 'Display Post Author', 'radium'), 
						'sub_desc' => __('Elect to display the post author in the blog meta, beneath the post title.', 'radium'),
						'desc' => __('Yes do it', 'radium'),
						'std' => 1 
						),

					array(
						'id' => 'blog_about_author',
						'type' => 'checkbox',
						'title' => __( 'Display About the Author', 'radium'), 
						'sub_desc' => __('Elect to display the post author in the blog meta, beneath the post title.', 'radium'),
						'desc' => __('Yes do it', 'radium'),
						'std' => 1 
						),
						
					array(
						'id' => 'post_archives_layout',
						'type' => 'radio_img',
						'title' => __('Blogroll Index Layout', 'radium'), 
						'sub_desc' => __('Select a sidebar layout option for your blogroll index page.', 'radium'),
							'options' => array(
									'none' 		=> array('title'	=> 'Full', 'img' 		=> RADIUM_OPTIONS_URL.'assets/images/1col.png'),
									'left' 		=> array('title' 	=> 'Left ', 'img'      	=> RADIUM_OPTIONS_URL.'assets/images/2cl.png'),
									'right' 	=> array('title' 	=> 'Right', 'img'      	=> RADIUM_OPTIONS_URL.'assets/images/2cr.png')
									),
						'std' => 'none'
					),										

					array(
						'id' => 'single_post_layout',
						'type' => 'radio_img',
						'title' => __('Single Post Layout', 'radium'), 
						'sub_desc' => __('Select a sidebar layout option for your blog single posts.', 'radium'),
							'options' => array(
									'none' 		=> array('title'	=> 'Full', 'img' 	=> RADIUM_OPTIONS_URL.'assets/images/1col.png'),					
									'left' 		=> array('title' 	=> 'Left ', 'img'   => RADIUM_OPTIONS_URL.'assets/images/2cl.png'),
									'right' 	=> array('title' 	=> 'Right', 'img'   => RADIUM_OPTIONS_URL.'assets/images/2cr.png')
									),
						'std' => 'none'
					),
				)
			);


$sections[] = array(
				'icon' => RADIUM_OPTIONS_URL.'assets/images/icons/icon-page.png',
				'title' => __('Social Sharing', 'radium'),
				'desc' => __('<p class="description">Manage the sharing facet of your blog posts.</p>', 'radium'),
				'icon' => '',
				'fields' => array(					
					array(
						'id' => 'display_social_share',
						'type' => 'checkbox',
						'title' => __( 'Display Social Share', 'radium'), 
						'sub_desc' => __('Elect to display your post social buttons on your blog single pages, below the content.', 'radium'),
						'desc' => __('Yes do it', 'radium'),
						'std' => 1 
						),	

					array(
						'id' => 'twitter_share_button_text',
						'type' => 'text',
						'title' => __('Twitter Button:', 'radium'),
						'sub_desc' => __('Customize the text on Twitter button. ', 'radium'),
						'std' => 'Tweet This'
						),	
						
					array(
						'id' => 'facebook_share_button_text',
						'type' => 'text',
						'title' => __('Facebook Button:', 'radium'),
						'sub_desc' => __('Customize the text on FaceBook button. ', 'radium'),
						'std' => 'Send to Facebook'
						),
						
					array(
						'id' => 'facebook_summary',
						'type' => 'textarea',
						'title' => __('Facebook Summary Text:', 'radium'),
						'sub_desc' => __('Write a small description to be displayed along with the post link, when users share via Facebook.', 'radium'),
						'std' => ''
						),
				)
			);


$sections[] = array(
				'title' => __('Portfolio Settings', 'radium'),
				'desc' => __('<p class="description">Customize your Home / Portfolio page.</p>', 'radium'),
 				'fields' => array(
						array(
							'id' => 'filter_text',
							'type' => 'text',
							'title' => __('Filter Header:', 'radium'),
							'sub_desc' => __('Replace the leading text on the portfolio filter.', 'radium'),
							'std' => 'Categories'
							),	
						
						array(
							'id' => 'port_hover_text',
							'type' => 'text',
							'title' => __('Portfolio Hover:', 'radium'),
							'sub_desc' => __('Customize the text displayed when your portfolio images are hovered. ', 'radium'),
							'std' => 'View Project'
							),	

						array(
							'id' => 'port_related_text',
							'type' => 'text',
							'title' => __('Related Posts Header:', 'radium'),
							'sub_desc' => __('Customize the text title for the related portfolio posts', 'radium'),
							'std' => 'Some Related Posts'
							),							
						
						
						array(
							'id' => 'related_posts',
							'type' => 'multi_checkbox',
							'title' => __( 'Show Related Porfolio Posts', 'radium'), 
							'sub_desc' => __('Elect to display the portfolio related posts on single view pages.', 'radium'),
							'options' => array(
								'portfolio' => 'Yes, do it.',
							),
							'std' => array( 
								'portfolio' => '1', 
								
							)
							
						),
							array(
								'id' => 'related_posts_type',
								'type' => 'select',
								'title' => __('Related Content Type', 'radium'), 
								'sub_desc' => __('Related content type by tags or category', 'radium'),
									'options' => array( 
										'tags' => 'Tags', 
										'cat'  => 'Category'
									),
								'std' => 'tags'
						),	
																					
					)
  				); 				
  				
  				
  				
$sections[] = array(
				'title' => __('404 Error Page', 'radium'),
				'desc' => __('<p class="description">Manage & customize your theme 404 error page.</p>', 'radium'),
 				'fields' => array(
						array(
							'id' => '404_error_btn_text',
							'type' => 'text',
							'title' => __('Back Button', 'radium'),
							'sub_desc' => __('Customize the text that is displayed on the 404 Page "Back" button.', 'radium'),
							'std' => 'Head on Back'
							),	
						
						array(
							'id' => '404_error_text',
							'type' => 'textarea',
							'title' => __('404 Page Header', 'radium'),
							'sub_desc' => __('Customize the bold header text displayed under the "Page Not Found" on the 404 page.', 'radium'),
							'std' => 'Oh Snap! It appears the page you are looking for has disappeared (or never even existed). #mindblown'
							),	
													
						array(
							'id' => '404_error_p_text',
							'type' => 'textarea',
							'title' => __('404 Page Paragraph', 'radium'),
							'sub_desc' => __('Customize the paragraph text displayed on the 404 page to say anything you would like.', 'radium'),
							'std' => 'Please <a href="http://www.twitter.com/themebeans.com">shoot us a tweet</a> if something iss really broken. We hate these little bugs just as much as you do. Really. If its a human error, just head on back to what cha were looking at. We appreciate it! '
							),									
					)
  				);


$sections[] = array(
				'title' => __('Site Archives', 'radium'),
				'desc' => __('<p class="description">Customize the headers and content displayed on the Archives Template.</p>', 'radium'),
 				'fields' => array(
						array(
							'id' => 'archives_content',
							'type' => 'multi_checkbox',
							'title' => __( 'Archive Page Content', 'radium'), 
							'sub_desc' => __('Select which contexts are displayed on the Archives page.', 'radium'),
							'options' => array(
								'posts'    => 'All Posts',
								'latest'   => 'Latest Posts', 
								'month'    => 'Archives by Month',
								'category' => 'Archives by Category', 
								'pages'    => 'Site Map',
							),//Must provide key => value pairs for multi checkbox options
							'std' => array(
								'posts'    => '1', 
								'latest'   => '1', 
								'category' => '1', 
								'month'    => '1',
								'pages'    => '1', 
							)
						),	
						
						array(
							'id' => 'archive_all_text',
							'type' => 'text',
							'title' => __('All Published Posts.', 'radium'),
							'sub_desc' => __('Replace the text above the all posts archive content.', 'radium'),
							'std' => 'All Published Posts.'
							),	
							
						array(
							'id' => 'archive_latest',
							'type' => 'text',
							'title' => __('Last 30 Posts Header', 'radium'),
							'sub_desc' => __('Replace the text above the latest 30 posts archive content.', 'radium'),
							'std' => 'The Latest 30 Posts.'
							),
															
						array(
							'id' => 'archive_monthly',
							'type' => 'text',
							'title' => __('Monthly Archive Header', 'radium'),
							'sub_desc' => __('Replace the text above the monthly posts archive content.', 'radium'),
							'std' => 'Archives by Month.'
							),	
							
						array(
							'id' => 'archive_category',
							'type' => 'text',
							'title' => __('Category Archive Header', 'radium'),
							'sub_desc' => __('Replace the text above the all category archive content.', 'radium'),
							'std' => 'Archives by Category.'
							),	
							
						array(
							'id' => 'archive_sitemap',
							'type' => 'text',
							'title' => __('Site Map Header', 'radium'),
							'sub_desc' => __('Replace the text above the site map content.', 'radium'),
							'std' => 'Our Site Map.'
							),	
						
						array(
							'id' => 'search_header_text',
							'type' => 'text',
							'title' => __('Search Page Sub-Header', 'radium'),
							'sub_desc' => __('Customize the text sub-header displayed on the Search Results page.', 'radium'),
							'std' => 'Search our website & find the good stuff.'
							),
																							
					)
  				); 
  				
$sections[] = array(
				'title' => __('Custom Colors', 'radium'),
				'desc' => __('<p class="description">Easily manipulate various CSS elements throughout the theme. <b>Note:</b> These colors will override all other theme stylesheets. Deleting the color values inputted here will allow the stylesheets display.
				</p>', 'radium'),
				'icon' => '',
				'fields' => array(
					array(
						'id' => 'accent_color',
						'type' => 'color',
						'title' => __('Theme Accent Color', 'radium'), 
						'sub_desc' => __('Default color of this element: #3FB5E4', 'radium'),
						'std' => ''
						),

					array(
						'id' => 'header_bg_color',
						'type' => 'color',
						'title' => __('Navigation Background', 'radium'), 
						'sub_desc' => __('Default color of this element: #1E1E1E', 'radium'),
						'std' => ''
						),
						
					array(
						'id' => 'page_header_bg_color',
						'type' => 'color',
						'title' => __('Page Header Background', 'radium'), 
						'sub_desc' => __('Default color of this element: #FFFFFF', 'radium'),
						'std' => ''
						),	
						
					array(
						'id' => 'body_bg_color',
						'type' => 'color',
						'title' => __('Body Color', 'radium'), 
						'sub_desc' => __('Default color of this element: #FFFFFF', 'radium'),
						'std' => ''
						),
							
					array(
						'id' => 'footer_bg_color',
						'type' => 'color',
						'title' => __('Footer Background', 'radium'), 
						'sub_desc' => __('Default color of this element: #1E1E1E', 'radium'),
						'std' => ''
						),
					
					)
				);
	
$sections[] = array(
				'title' => __('Custom CSS', 'radium'),
				'desc' => __('<p class="description">Overwrite or customize various CSS elements throughout the theme by implementing your styles in this textarea.
				</p>', 'radium'),
				'fields' => array(
	
					array(
						'id' => 'bean_custom_css_input',
						'type' => 'textarea',
						'title' => __('Custom StyleSheet', 'radium'), 
						'sub_desc' => __('The CSS entered here will override all other CSS elements thoughout the theme.', 'radium'),
						'std' => ''
						),

					)
				);
								
  return $sections;
  
}//function

add_filter('radium-opts-sections-radium_theme', 'radium_load_framework_theme_options');

?>