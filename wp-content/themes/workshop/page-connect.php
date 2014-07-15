<?php
/*
Template Name: Post to Workshop
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

get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<div id="wufoo-zk3c41g1wyrseh">
Fill out my <a href="https://letsworkshop.wufoo.com/forms/zk3c41g1wyrseh">online form</a>.
</div>
<div id="wuf-adv" style="font-family:inherit;font-size: small;color:#a7a7a7;text-align:center;display:block;">There are tons of <a href="http://www.wufoo.com/features/">Wufoo features</a> to help make your forms awesome.</div>
<script type="text/javascript">var zk3c41g1wyrseh;(function(d, t) {
var s = d.createElement(t), options = {
'userName':'letsworkshop',
'formHash':'zk3c41g1wyrseh',
'autoResize':true,
'height':'1087',
'async':true,
'host':'wufoo.com',
'header':'show',
'ssl':true};
s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'wufoo.com/scripts/embed/form.js';
s.onload = s.onreadystatechange = function() {
var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
try { zk3c41g1wyrseh = new WufooForm();zk3c41g1wyrseh.initialize(options);zk3c41g1wyrseh.display(); } catch (e) {}};
var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');</script>


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
