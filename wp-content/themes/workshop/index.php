<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workshop
 */

get_header( 'home' ); ?>

	<div id="primary" class="content-area weekly" >
		<main id="main" class="site-main" role="main">

<section class="small-wrap" style="margin-top: 2em;">

<p>Dear web maker,</p>

<p>I'll never forget putting a letter on my tiny website and making hundreds of thousands of dollars from it.</p>

<p>One person at a time reading it. Each word telling them something.</p>

<p>Now when I look back at my days as a freelancer, it's clear my portfolio wasn't what got me hired. Neither was my sleek website that didn't say anything. It was the emails I wrote. My sales letters.</p>

<p>So pick someone out and say, "Hey you! I know exactly what you are going through. That's why I need to tell you this." Our attention spans are too short for anything else. </p>


<p>I look at the web as a letter from one person to another. If you want to learn to look at it this way too, read on.</p>


<h3>Every week I analyze a new modern sales letter.<br> Sign up and I'll send it to you.
	</h3>
</section>
<section class="large-wrap">

	<form class="weekly" action="http://letters.letsworkshop.com/t/i/s/qhdij/" method="post">
	    <p>
	        <input id="fieldName" name="cm-name" type="text" placeholder="Your Name" />
	    </p>
	    <p>
	        <input id="fieldEmail" name="cm-qhdij-qhdij" type="email" required placeholder="Your Email"/>
	    </p>
	    <p>
	        <button type="submit">Yes, send it.</button>
	    </p>
	</form>
</section>


<div class="big-wrap" style="margin-top: 7em;">
	<h4>RECENT SALES LETTER BREAKDOWNS</h4>
	<hr>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'essay' );
				?>

			<?php endwhile; ?>


		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
</div>

<section class="small-wrap" style="margin-top: 4em;">
	<center>
		<h3>
			The Web as a Sales Letter
		</h3>
	<p style="margin: -1em 0 3em 0;">
		A weekly publication by <a href="http://twitter.com/letsworkshop">Robert Williams</a>
	</p></center>
</section>
			<div class="small-wrap" style="text-align: center; margin-bottom: 2em;">

				<?php posts_nav_link('|','Back','More Breakdowns'); ?> </div>

		</main><!-- #main -->
	</div><!-- #primary -->
