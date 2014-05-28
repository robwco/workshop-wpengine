<?php if ( is_tax( 'portfolio_tag' ) ||  is_tax( 'portfolio_category' ) ) { // A few checks for Portfolio archives ?>
	<div class="page-header page-entry-meta">
		<h1 class="entry-title">
			<span>
				<?php if ( is_tax( 'portfolio_tag' ) ):?>
				
					<?php _e( 'Portfolio: ', 'radium' ); ?>
					<?php $i = 0; $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>
					
				<?php else : ?>
				
					<?php _e( 'Portfolio: ', 'radium' ); ?>
					<?php $i = 0; $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>
					
				<?php endif; ?>
			</span>
		</h1>
	</div>
<?php } elseif 	 ( is_tax( 'faq_category' ) ) { // A few checks for FAQ archives ?>
	<div class="page-header page-entry-meta">
		<h1 class="entry-title">
			<span><?php _e( 'FAQ Groups', 'radium' ); ?></span>
		</h1>
	</div>
<?php } elseif (is_archive()) { // A few checks for archives ?>
	<div class="row page-entry-meta">
	
		<div class="twelve columns">
	
		    <h1 class="page-title">
		
		    	<span>
		    	    <?php 
		    	    if(is_tag() ): ?>
		    		    <?php printf( __( 'Tagged: %s', 'radium' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
		    		    <?php $tag_description = tag_description();
		    		    if ( ! empty( $tag_description ) )
		    		    	echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' ); ?>
		    		<?php elseif (is_category() ) : ?>
		    		    <?php printf( __( 'Category Archive: %s', 'radium' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		    		    <?php $category_description = category_description();
		    		    	if ( ! empty( $category_description ) )
		    		    		echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' ); ?>
		    		<?php elseif ( is_day() ) : ?>
		    			<?php printf( __( 'Daily Archive: %s', 'radium' ), '<span>' . get_the_date() . '</span>' ); ?>
		    		<?php elseif ( is_month() ) : ?>
		    			<?php printf( __( 'Monthly Archive: %s', 'radium' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'radium' ) ) . '</span>' ); ?>
		    		<?php elseif ( is_year() ) : ?>
		    			<?php printf( __( 'Yearly Archive: %s', 'radium' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'radium' ) ) . '</span>' ); ?>
		    		<?php elseif ( is_author() ) : ?>
		    		    <?php global $post; $author_id=$post->post_author;  ?>
		    		    
		    		    <?php _e( 'Author Archives.', 'radium' ); ?> <span> </span>
		    		    <h3 class="subheader">
		    		    	All posts by <?php
		    		    	$field='display_name';
		    		    	the_author_meta( $field, $author_id );
		    		    	?>.
		    		    </h3>
		    		 <?php elseif (  radium_theme_supports( 'plugin', 'bbpress' ) && bbp_get_topic_tag_tax_id() ) : ?>
		    		    <?php printf( __( 'Topic Tag: %s', 'radium' ), '<span>' . bbp_get_topic_tag_name() . '</span>' ); ?>
		    		<?php else : ?>
		    			<?php printf(  __( 'Archives', 'radium' ) ); ?>
		    		<?php endif; ?>
		    	</span>
		  
		    </h1>
		
		</div>
	
	</div>	


<?php } elseif( is_search() ) { ?>	

	<h1 class="entry-title"><?php printf( __('Search.', 'radium'), get_search_query()); ?></h1>

	<h3 class="subheader">
		<?php do_action('radium_search_header_text'); ?>
	</h3>


<?php } elseif ( 'post'== get_post_type() ) { 	
	$blog = get_post(get_option('page_for_posts')); 
	?>
	
	<h1 class="entry-title"><?php do_action('radium_blog_header_text'); ?></h1>
	
	<h3 class="subheader"><?php do_action('radium_blog_sub_header_text'); ?></h3>	
	
<?php } elseif ( 'page'== get_post_type() && is_front_page()) {
	//Get Frontpage Page ID, extract and show the title  	
	$frontpage = get_post(get_option('page_on_front')); ?><h1 class="entry-title"><span><?php echo $frontpage->post_title; ?></span></h1><?php if( get_post_meta( $post->ID, '_radium_subtitle', true ) ) { ?><h3 class="subheader"><?php echo get_post_meta( $post->ID, '_radium_subtitle', true ); ?></h3><?php } ?>
<?php } else { ?><h1 class="entry-title"><span><?php wp_title(''); ?></span></h1><?php if( get_post_meta( $post->ID, '_radium_subtitle', true ) ) { ?><h3 class="subheader"><?php echo get_post_meta( $post->ID, '_radium_subtitle', true ); ?></h3><?php } ?>
<?php } ?>