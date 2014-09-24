<?php
/**
 * @package Workshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link( __( 'Edit', 'workshop' ), '<span class="edit-link">', '</span>' ); ?>
<section class="mid-wrap">
	<div class="entry-content weekly">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'workshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</section>
	<footer class="entry-footer">



	<section class="big-wrap" style="display:table; margin-bottom: 2em; font-family: proxima-nova, sans-serif;">
		<hr>
			<h3>
				Thanks for reading <em><?php the_title(); ?></em>
			</h3>
			<p>

				If you got value from it, and would like to see me keep writing stuff like it every week, the best thing you can do to ensure this happens is pay me. You will receive future updates and support me in continuing this project.<br><a href="https://workshop.memberful.com/checkout?plan=2993">Click here to subscribe.</a>
			</p>
			<p>
				Secondly, if this essay really had an effect on you, please share it. However, this is a long read that takes some investment on the reader's part so don't just share it with your "network". Instead, highlight a single portion, and send that to somebody you know will benefit.
			</p>
			<p>
				Lastly, if you liked this and want to read more, <a href="/weekly">you should sign up here</a>.
			</p>
			<p>Cheers, Robert</p>
	</section>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
