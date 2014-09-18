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
<?php if ( is_user_logged_in() ) : ?>

  <div class="profile-box signed-in">

    <a class="profile" href="<?php echo memberful_account_url(); ?>">

      <?php echo get_avatar( wp_get_current_user()->user_email, 48 ); ?>

      <?php echo wp_get_current_user()->display_name; ?>

    </a>

    <a class="sign-out" href="<?php echo memberful_sign_out_url(); ?>">Sign out</a>

  </div>

<?php else : ?>

  <div class="profile-box signed-out">

    Already a customer? Please <a title="Sign in" href="<?php echo memberful_sign_in_url(); ?>">sign in</a>.

  </div>

<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer( 'home' ); ?>
