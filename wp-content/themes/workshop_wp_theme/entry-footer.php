<footer class="entry-footer">
<span class="cat-links"><?php _e( 'Categories: ', 'workshop_wp_theme' ); ?><?php the_category( ', ' ); ?></span>
<span class="tag-links"><?php the_tags(); ?></span>
<?php if ( comments_open() ) {
echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'workshop_wp_theme' ) ) . '</a></span>';
} ?>
</footer>