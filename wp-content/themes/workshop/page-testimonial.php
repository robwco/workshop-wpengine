<?php
/*
Template Name: Testimonials
*/
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Workshop
 */

get_header( 'page' ); ?>
<h1>My members have made well over 6-figures</h1>
<h2>Hundreds of freelance and consultancy businesses don't worry about finding new work anymore because they've switched to Workshop.</h2>
<hr>
<section id="content" role="main" style="max-width:30em; margin: auto; margin-bottom: 2em;">



<?php

$testimonial_posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'testimonial',
));



if($testimonial_posts)
{



	echo '<ul>';

	foreach($testimonial_posts as $post)
	{

		echo '<div class="box-shadow"><p class="center">' . get_field('testimonial') . '			</p><span class="quote-arrow"></span></div>' . '<p class="center">
			<img src="' . get_field('profile_photo') . '" class="testimonial-img"> – ' . get_field('testimonial_name') . ', ' . get_field('job_title') . ', <img src="' . get_field('logo') . '" style="width:20px; border-radius:3px; vertical-align: -2px;"> ' . get_field('business_name') . '</p>';
	}

	echo '</ul>';
}

?>


</section>
<hr>
<center>
	<h2 style="font-weight: bold; color: #111;">Ready to put your work finding worries at ease? <br><a href="/sign_up/#pricing" style="font-weight: normal;">Try Workshop risk-free for 30 days.</a></h2>
</center>


<hr>
<?php get_footer( 'home' ); ?>
