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

<section class="mid-wrap">
	<h1 style="font-size: 2em; text-align: left;">The web is a sales letter.</h1>
	<p>
		It's read by one person at a time. If you work on the web it's your job to say something people will want to read. Yet, as makers, we ignore our words.
	</p>
	<p>
		I first realized this as a freelancer when the emails I wrote – <em>not my portfolio</em> – decided if I got hired. Later, when most people sold their product using a sleek website that didn't say anything, <a href="http://letsworkshop.com">I put a letter on mine</a>. In 8 months I made over one-hundred thousand dollars.
	</p>
	<p>
		Below is a study of modern sales letters. I believe every word we write should point to one person in a crowd and say, <em>'I know what you're going through, that's why I'm talking to you now'</em>. Time is too short for anything else. These essays are an example of their own principles.
	</p>

</section>
<section class="big-wrap">

	<form class="weekly" action="http://letters.letsworkshop.com/t/i/s/qhdij/" method="post">
			<h3>I'd love to deliver them to your inbox each week. Sign up below.
	</h3>
	    <p>
	        <input id="fieldName" name="cm-name" type="text" placeholder="Your Name" />
	    </p>
	    <p>
	        <input id="fieldEmail" name="cm-qhdij-qhdij" type="email" required placeholder="Your Email"/>
	    </p>
	    <p>
	        <button type="submit">Subscribe</button>
	    </p>
	</form>
</section>

<div class="big-wrap">
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

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer( 'home' ); ?>
