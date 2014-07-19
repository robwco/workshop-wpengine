<?php
/**
 * @package Workshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link( __( 'Edit', 'workshop' ), '<span class="edit-link">', '</span>' ); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title single">', '</h1>' ); ?>

		<div class="entry-meta">
			<p class="author full-opacity">by  <?php echo get_avatar( get_the_author_email(), '30' ); ?> <?php the_author(); ?></p>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'workshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer" style="margin-top:3em;">
<hr>
<div style="display: table;">
		<p class="center" style="font-size: 1.2em; line-height: 1.2em;"><strong>If you learned something new in this essay</strong>, check out <a href="/" style="text-decoration: underline;">my free course on finding work online.</a>  It's helped thousands & comes with 10 free leads.</p>
	</div>
</div>
	</div>



	<hr>
	<div style="width:30em; margin: 0 auto 0 auto;">
	<div style="margin-top:2em; float: left;">
	<?php echo get_avatar( get_the_author_email(), '100' ); ?>
	</div>
	<div style="width:24em; float: right;">
	<p style="margin-bottom: 0;"><strong>About the author <?php the_author(); ?></strong></p>
	<p style="margin-top: .5em;"><?php the_author_description(); ?></p>
	</div>
	</div>
<div style="width:100%; padding-top:0em; display: table;">
	<hr>

	<nav id="site-navigation" class="main-navigation" role="navigation">
			<p class="masthead" style="margin:1.5em;">Want to see everything I've written? <a href="/blog">Here are all my essays</a>.</p>
		</nav><!-- #site-navigation -->

</div>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
