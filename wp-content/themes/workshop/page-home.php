<?php
/*
Template Name: Drip Sign Up
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

get_header( 'home' ); ?>
<section class="small-wrap plan">
<div class="home-optin">
<h1 class="value-prop center">Get your 10 sample freelance leads&mdash;worth thousands of dollars in consulting work&mdash;and actionable tools to help you land them sent straight to your inbox.</h1>
<div class="cta-arrow" align="left"><p>END<span> </span>YOUR<span> </span>DRY<span> </span>SPELL</p></div>
<form class="drip-opt-in" action="https://www.getdrip.com/forms/9298754/submissions" method="post" target="_blank" data-drip-embedded-form="1306">
<div style="width:15em; margin: auto; text-align: center;">
    <input type="text" name="fields[name]" value="" placeholder="Your name" />
    <input type="email" name="fields[email]" value="" placeholder="Your email" />
</div>
  <div style="width:15em; margin: auto; text-align: center;">
    <input type="submit" name="submit" value="Get more work" data-drip-attribute="sign-up-button" />
  </div>
	<div style="margin: 1em auto; text-align: center;">
		<p>Brought to you by
			<a href="/about"><strong style="font-weight:900; font-size: 1em;"><img src="/images/logo/workshop-hd-100.png" style="width: 2em; display: inline-block; vertical-align: -.5em; margin-right: .3em;"><?php bloginfo( 'name' ); ?></strong></a>
		</p>
	</div>
</form>
<hr>
<div style="display: table; padding: 2em 0;">


<img src="/images/marketing/kurt-illustration.png" align="left" class="customer-illustration">

<iframe src="//fast.wistia.net/embed/iframe/j99rjad3m8" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="300" height="169"></iframe>
<div class="customer-pointer">
<img src="/images/marketing/kurt-arrow.png" align="left" style="margin: 2em .5em  0 0;">
<p>This is Kurt, a world-class consultant / Workshop member.<br><a href="/saying-nope-to-spec-work/">See how his agency in Chicago uses Workshop</a>.</p>

</div>

</div>





</div><!-- #content -->



</div><!-- #page -->
</section>

<?php wp_footer(); ?>

<!--Don't remove-->
<?php include("inc/all-footers.php"); ?>

</body>
</html>


