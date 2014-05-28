<?php get_header(); ?>


<a href="http://letsworkshop.com/blog" class="back-btn">← Go back to blog</a>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article role="main" class="primary-content" id="post-<?php the_ID(); ?>">
            <header>
                <h1><?php the_title(); ?></h1> <a href="http://letsworkshop.com" class="newsletter-sticker"><div class="newsletter-sticker"><span class="small">Get More</span> Work</div></a>
            </header>
            <footer class="entry-meta">
            	<p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time></p> 
            </footer>
			
			<?php the_post_thumbnail('full');?>
			
			<?php the_content(); ?>

			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>

<hr>
            


<div class="author-info">
<div class="author-gravatar"><?php echo get_avatar( get_the_author_email(), '100' ); ?></div>
<p><strong>Written by <?php the_author(); ?></strong><br> <?php the_author_description(); ?>  </p>
</div>

<hr>
<?php get_sidebar(); ?>


			

            <ul class="navigation">
                <li class="older">
					<?php previous_post_link( '%link', '&larr; %title' ); ?>
                </li> 
                <li class="newer">
					<?php next_post_link( '%link', '%title &rarr;' ); ?>
                </li>
            </ul>
    
            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>