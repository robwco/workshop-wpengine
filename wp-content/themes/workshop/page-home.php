<?php
/*
Template Name: Home Drip Opt-in
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

<section id="content" role="main">
<h1>Don't waste another day not knowing how to generate new work.</h1>
<h2>You have a growing consultancy – referrals are great – but relying on them too much causes dry spells.</h2>
<aside>
	<ul>
		<li><strong>Sign up now to access my free course on creating an endless stream of clients:</strong></li>
		<li>Watch 2 advanced freelance strategy sessions with Nick Disabato and Samuel Hulick (2+ hours).</li>
		<li>Download my endless leads cheatsheet, a massive list of the best links for finding work (updated regularly).</li>
		<li>Perfect your client's feedback with my world-class feedback generator.</li>
	</ul>
</aside>
<form class="drip-opt-in" action="https://www.getdrip.com/forms/9298754/submissions" method="post" target="_blank" data-drip-embedded-form="1306">
	<p class="center"><strong>Take control.</strong></p>
	<p>Get the guide to finding an endless stream of clients and actionable tips on how to land them.</p>
<div>
    <input type="text" name="fields[name]" value="" placeholder="Your name" />
    <input type="email" name="fields[email]" value="" placeholder="Your email" />
</div>
<div class="bonus"><p><strong>Bonus:</strong> Get 10 complimentary leads delivered straight to your inbox upon sign up.</p></div>
  <div>
    <input type="submit" name="submit" value="Subscribe for free" data-drip-attribute="sign-up-button" />
  </div>
<p class="trust">I’ll never share your email address or spam you.</p>
</form>
<p class="testimonial">&ldquo;Since starting with Workshop, I've had an unbroken chain of daily lead generation activity no matter what.&rdquo;</p>
<p class="center"><img src="/images/testimonials/kurt.png" class="testimonial-img"> – Kurt Elster, Founder and Creative Director, <img src="../images/testimonials/logo-ethercycle.png" style="width:20px; border-radius:3px; vertical-align: -2px;"> Ethercycle</p>
</section>
<?php get_footer( 'home' ); ?>
