<?php
/*
Template Name: Account Page
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


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

      <div class="mid-wrap"
<?php if ( is_user_logged_in() ) : ?>

  <div class="profile-box signed-in">

<div style="text-align:right; margin-top:3em; font-family: proxima-nova;">
  <span style="vertical-align: -8px;"><?php echo get_avatar( wp_get_current_user()->user_email, 30 ); ?></span> <a class="profile" href="<?php echo memberful_account_url(); ?>">Account</a> | <a class="sign-out" href="<?php echo memberful_sign_out_url(); ?>">Sign out</a>
</div>
      <h1 style="margin-top: 0em; font-size: 30px;">   
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
        </span> <?php echo wp_get_current_user()->display_name; ?>...
      </h1>
      <hr>
      <p>
        You're Workshop subscription is active. <a class="profile" href="<?php echo memberful_account_url(); ?>">You can update account details here.</a>
      </p>

      <p style="background-color: #f5f3f0; padding: .75em 1.25em; font-family: proxima-nova;">
       At an hourly consulting rate of <strong>$100</strong>, you save <strong>$1,200+</strong> each month in billable hours with your subscription. Go <?php echo wp_get_current_user()->first_name; ?>! No seriously, go land some work.
      </p>

<h3 style="margin-top:2em;">Get the most out of your Workshop subscription:</h3>

<?php
    $guide_posts = get_posts(array(
      'numberposts' => -1,
      'post_type' => 'guide',
    ));


    if($guide_posts)
    {



      echo '';

      foreach($guide_posts as $post)
      {

        echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '<hr>' ;
      }

      echo '';
    }

    ?>



<?php else : ?>

  <div class="profile-box signed-out">

    Already a customer? Please <a title="Sign in" href="<?php echo memberful_sign_in_url(); ?>">sign in</a>.

  </div>

<?php endif; ?>

</div>

		</main><!-- #main -->
	</div><!-- #primary -->

