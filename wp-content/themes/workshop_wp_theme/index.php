<?php get_header(); ?>
<section id="content" role="main">
<h3 class="masthead">Written by <a href="http://letsworkshop.com">Workshop</a>, a tiny newsletter and community for web design and development consultancies.</h3>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>