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



	<section class="big-wrap" style="display:table; margin: 2em auto; ">
		<hr>
		<section class="big-wrap">
			<h3>
				Thanks for reading <em><?php the_title(); ?></em>
			</h3>
			<p>

				If you got value from the article, please share it with other people. However, it's pretty long so instead of just sharing it with your &ldquo;network&rdquo;, try highlighting only a portion, and sending that to somebody you know. Thanks.
			</p>

		</section>

				<form class="weekly" action="http://letters.letsworkshop.com/t/i/s/qhdij/" method="post">
			<p>
				<b>I write one of these every week. Sign up to get them:</b>
			</p>
	    <p>
	        <input id="fieldName" name="cm-name" type="text" placeholder="Your Name" />
	    </p>
	    <p>
	        <input id="fieldEmail" name="cm-qhdij-qhdij" type="email" required placeholder="Your Email"/>
	    </p>
	    <p>
	        <button type="submit">Send me more</button>
	    </p>
	</form>
			<hr>
	</section>

	<section class="big-wrap">


</section>

<section class="big-wrap">

	<center>
		<h3 style="margin-bottom: 2em;"><a style="color: #111;" href="/weekly">&larr; Back to the Web as a Sales Letter</a></h3>
	</center>
</section>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
