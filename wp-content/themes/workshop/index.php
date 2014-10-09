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
	<center>
		<h2 style="margin: 0 0 2em 0;">
			The Web as a Sales Letter
		</h2>
	</center>

<p>If you make websites, I know you have trouble writing. It's hard to connect with someone you want to sell something to and not feel sleazy.</p>

<p>If you feel like you're not creating a site people want to read, it's because you don't even want to read what you write. Next time, instead of using lorem ipsum, write a letter.</p>

<p>I'll never forget putting a letter on my website and making hundreds of thousands of dollars as a result. Nothing fancy, just me explaining what I was selling with words. A sales letter.</p>

<p>A sales letter picks someone out of a crowd and says, <em>&lsquo;You! I know exactly what you're going through. That's why I need to tell you this.&rsquo;</em></p>

<p>At first, websites like this stick out at us. Soon, we won't settle for anything else. That's why I look at the web as a letter from one person to another. If you want to learn to look at it this way too, I have something for you.</p>

<h2>This site is a collection of evergreen principles for writing words on the web. Sign up to get updates.
	</h2>
</section>

<section class="big-wrap">

	<form class="weekly" action="http://letters.letsworkshop.com/t/i/s/qhdij/" method="post">
	    <p>
	        <input id="fieldName" name="cm-name" type="text" placeholder="Your Name" />
	    </p>
	    <p>
	        <input id="fieldEmail" name="cm-qhdij-qhdij" type="email" required placeholder="Your Email"/>
	    </p>
	    <p>
	        <button type="submit">Yes, email me.</button>
	    </p>
	</form>
</section>




<div class="big-wrap" style="margin-top: 3em;">
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




			<div class="small-wrap" style="text-align: center; margin-bottom: 2em;">

				<?php posts_nav_link('|','Back','More Breakdowns'); ?> </div>


<section class="small-wrap" style="margin: 2em auto;">
<center>
	<p style="margin: 0 0 3em 0;">
		Brought to you by <a class="logo" href="http://letsworkshop.com">
			<span style="font-size: 1.3em; color: #111; font-weight: 700;"><img src="/images/logo/workshop-hd-100.png" style="width: 1.75em; display: inline-block; vertical-align: -.4em; margin-right: .15em;"><span style="letter-spacing: -.075em;">W</span>orkshop</span>
		</span></a>
	</p>
	</center>
</section>

		</main><!-- #main -->
	</div><!-- #primary -->


