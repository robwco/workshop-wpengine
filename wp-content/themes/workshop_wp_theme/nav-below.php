<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
<!--<nav id="nav-below" class="navigation" role="navigation">
<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'workshop_wp_theme' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'workshop_wp_theme' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
</nav>-->
<p class="center small masthead">Curious about how I've helped other freelancers and shops? <a href="http://letsworkshop.com">See what my customers have said.</a></p>
<p class="center small masthead">Ready to automate how you find leads daily? <a href="http://letsworkshop.com">Get my guide to an endless stream of clients.</a></p>
<p class="center small masthead"><a href="http://letsworkshop.com">Read my story</a>, <a href="http://letsworkshop.com">read my essays</a>, and <a href="http://letsworkshop.com">follow me on twitter</a>.</p>
<?php } ?>