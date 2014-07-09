<?php
/**
*Template Name: Account
*/
?>
<?php get_header( 'account' ); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
</header>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php endwhile; endif; ?>
<?php if ( is_subscribed_to_memberful_plan( '1775-workshop-payment-plan-12-payments-of' ) ) : ?>

<h1>
<script type="text/javascript">
	function greeting() {
	Now = new Date()
	Hour = Now.getHours();
	if (Hour < 5)
	msg ="Happy late-night,"
	else if(Hour < 12)
	msg ="Good morning,"
	else if(Hour < 18)
	msg ="Good afternoon,"
	else if (Hour < 24)
	msg ="Good evening,"
	return( msg )
	}
	document.write(greeting())
</script>



<span style="font-weight:800;"><?php get_currentuserinfo(); echo $current_user->user_firstname; ?></span> <span style="vertical-align: middle;"><?php
       global $current_user;
       get_currentuserinfo();
       echo get_avatar( $current_user->ID, 40 );
?>
</span> ... </h1>
<hr>
<h3 style="font-weight:800;">Get Started! Customize your Workshop account</h3>
<ol id="guide-checklist">
	<li><a href="../guides/tour/">Take a tour of Workshop and see how it all works.</a></li>
	<li><a href="../guides/lead-preferences/">Set your lead preferences to receive only the leads you want in your inbox.</a></li>
	<li><a href="../guides/multiple-email-addresses/">Share your leads with the entire team.</a></li>
	<li><a href="mailto:support@letsworkshop.com?subject=I'd like an invite to Workshop's groupbuzz">Get an invite to the Shed (typically takes up to 24 hours).</a></li>
</ol>


<hr>

<h3 style="font-weight:800;">Your Workshop Account</h3>
<p><span class="lead">
  You're membership is <span style="margin-right:-.1em; color: #19963C;">&#10004;</span>
  <?php if ( is_subscribed_to_memberful_plan( array( '2185-workshop-yearly-plan-plasso-no-charge-for-365-days', '2020-workshop-current-member-switch-to-memberful-discount', '1798-workshop-growing-consultancy-annual-subscription', '1775-workshop-payment-plan-12-payments-of' ) ) ) : ?>

 <strong>Currently Active</strong>, you receive <strong>10+ leads per day</strong>.
</span>

<p>
  That means if your hourly rate is <strong>$100</strong>, you save <strong>$1,200+/month</strong> in billable hours with your subscription. Go <?php get_currentuserinfo(); echo $current_user->user_firstname; ?>! No seriously, go land some work.
</p>
<hr>

<table>
	<tr>
		<td style="padding:0 1em 0 0; text-align:center;">
				<h3 style="font-weight:800;"><img src="../images/logo/workshop-logo-handdrawn.png" style="width: 1.75em; vertical-align: middle; margin-bottom: .3em;"><br>Lead Factory <span class="new">New!</span></h3>
					<p class="masthead" style=" margin-top: -1em;">An easy-to-scan digest of every lead sent your way.</p>
				<div class="launchpad-image">
				      <p>Coming soon</p>
				</div>
		</td>

		<td style="padding:0 0 0 1em; text-align:center;">
				<h3 style="font-weight:800;"><img src="../images/marketing/happy-hour1.png" style="width: 3.2em; vertical-align: middle; margin-bottom: .3em;"><br>Happy Hour</h3>
					<p class="masthead" style=" margin-top: -1em;">Periodic round-table chats with members and guests.</p>
				<div class="launchpad-image">
					<a href="http://letters.letsworkshop.com/h/i/CC87F61930AF6586">
					      <p>Get on the list</p>
					</a>
				</div>
		</td>
				<td style="padding:0 .5em 0 .5em; text-align:center;">
				<h3 style="font-weight:800;"><img src="../images/marketing/theshed1.png" style="width: 3em; vertical-align: middle; margin-bottom: .3em;"><br>The Shed</h3>
					<p class="masthead" style="margin-top: -1em;">A members-only discussion community full of valuable tips.</p>
				<div class="launchpad-image">
					<a href="http://workshop.groupbuzz.io/topics">
					      <p>Go to the Shed</p>
					</a>
				</div>
		</td>
	</tr>
</table>



<?php endif; ?>




<?php endif; ?>
</section>
			<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>