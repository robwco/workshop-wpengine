<footer class="entry-footer">
<p class="author">This essay was written by  <?php echo get_avatar( get_the_author_email(), '30' ); ?> <?php the_author(); ?></p>
<span class="tag-links"><?php the_tags(); ?></span>
<?php if ( comments_open() ) {
echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'workshop_wp_theme' ) ) . '</a></span>';
} ?>
</footer>