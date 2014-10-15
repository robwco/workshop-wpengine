<?php
/*
Template Name: Workshop Essays
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

<div class="sales-letter" >
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" style="margin-bottom:3em;">
		<section class="small-wrap">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
					
			<?php endwhile; // end of the loop. ?>
			</section>
		<section class="big-wrap">
			<hr>
		</section>
			<section class="small-wrap">
				<h2><img src="/images/logo/workshop-hd-100.png" style="width: 1.25em; display: inline-block; vertical-align: -.25em; margin-right: .3em;"> Want to see if Workshop is right for your consultancy?</h2>

				<p>Awesome! I'd love to give you a sneak peak.</p>
				<p>Get ten real leads sent to your inbox right now by signing up below. Upon signing up, the email you get will include thousands of dollars worth of real leads that you can contact today.</p>
				<p><strong>If you want to see a demo of Workshop, just sign up below.</strong></p>
<form class="drip-opt-in" action="https://www.getdrip.com/forms/9298754/submissions" method="post" target="_blank" data-drip-embedded-form="1306">
<div style="width:15em; margin: auto; text-align: center;">
    <input type="text" name="fields[name]" value="" placeholder="Your name" />
    <input type="email" name="fields[email]" value="" placeholder="Your email" />
</div>
  <div style="margin: auto; text-align: center;">
    <input type="submit" name="submit" value="Send me a demo!" data-drip-attribute="sign-up-button" />
  </div>
</form>
</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer( 'home' ); ?>
</div>