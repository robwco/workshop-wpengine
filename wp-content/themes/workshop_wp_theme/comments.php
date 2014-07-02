<?php if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?>
<section id="comments">
	<hr>
<?php
if ( have_comments() ) :
global $comments_by_type;
$comments_by_type = &separate_comments( $comments );
if ( ! empty( $comments_by_type['comment'] ) ) :
?>

<section id="comments-list" class="comments">
<h3 class="comments-title"><?php comments_number(); ?></h3>
<?php if ( get_comment_pages_count() > 1 ) : ?>
<nav id="comments-nav-above" class="comments-navigation" role="navigation">
<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
</nav>
<?php endif; ?>
<ul>
<?php wp_list_comments( 'type=comment' ); ?>
</ul>
<?php if ( get_comment_pages_count() > 1 ) : ?>
<nav id="comments-nav-below" class="comments-navigation" role="navigation">
<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
</nav>
<?php endif; ?>
</section>
<?php
endif;
if ( ! empty( $comments_by_type['pings'] ) ) :
$ping_count = count( $comments_by_type['pings'] );
?>
<section id="trackbacks-list" class="comments">
<h3 class="comments-title"><?php echo '<span class="ping-count">' . $ping_count . '</span> ' . ( $ping_count > 1 ? __( 'Trackbacks', 'workshop_wp_theme' ) : __( 'Trackback', 'workshop_wp_theme' ) ); ?></h3>
<ul>
<?php wp_list_comments( 'type=pings&callback=workshop_wp_theme_custom_pings' ); ?>
</ul>
</section>
<?php
endif;
endif;
if ( comments_open() ) comment_form(array('title_reply' => "Are you a happy Workshop member? Leave Your Testimonial!", 'comment_notes_after' => "", 'label_submit' => 'Leave your Testimonial' ));
?>
</section>