<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<p class="center small masthead">Curious about how I've helped other freelancers and shops? <a href="http://letsworkshop.com/testimonials">See what my customers have said.</a></p>
<p class="center small masthead">Ready to automate how you find leads daily? <a href="http://letsworkshop.com">Get my guide to an endless stream of clients.</a></p>
<p class="center small masthead"><a href="http://letsworkshop.com/about">Read my story</a>, <a href="http://letsworkshop.com/blog">read my essays</a>, and <a href="http://twitter.com/letsworkshop">follow me on twitter</a>.</p>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>