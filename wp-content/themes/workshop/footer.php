<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Workshop
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
<!-- 		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'workshop' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'workshop' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'workshop' ), 'Workshop', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div> --><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!--Don't remove-->
<?php include("inc/all-footers.php"); ?>

</body>
</html>
