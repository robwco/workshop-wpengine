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


<footer>
<section class="big-wrap" style="margin:5em auto;"><hr></section>
<center>
<h3>Learn more</h3>
<nav id="site-navigation" class="main-navigation" role="navigation" style="margin-bottom: 5em;">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->

</center>
</footer>


</div><!-- #page -->


<?php wp_footer(); ?>

<!--Don't remove-->
<?php include("inc/all-footers.php"); ?>

</body>
</html>
