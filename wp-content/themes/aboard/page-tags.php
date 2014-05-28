<?php
/*
Template Name: Tag Index
*/
?>

<?php get_header(); ?>

<div id="main" class="twelve columns clearfix" role="main">
	<?php 
	
		    do_action('radium_before_content'); 
	
		while ( have_posts() ) : the_post();
	
			get_template_part( 'lib/content/content', 'page' ); 
	
		endwhile; // end of the loop.
	 
		    do_action('radium_after_content'); 
	    
	?>

	<div class="tag-index">

		<?php
		
		    $characters = range('a','z');
		    
		    if( $characters && is_array( $characters ) ) {
		        foreach( $characters as $index=>$character ) {
	
		            $tags = get_tags( array('name__like' => $character, 'order' => 'ASC') );
		    
		            if ($index != 0 && $index % 4 == 0)  {
		                $html = "<div class='post-tags clearfix' style='clear:left;'>";
		            } else {
		            
		                $html = "<div class='post-tags clearfix'>";
		            }
		           	           
		            if ($tags) {
		            	$html .= "<h3 class='tags-title'>{$character}</h3>";
		            
		            if ($tags) {
		                $html .= "<ul>";
		                foreach ( (array) $tags as $tag ) {
		                    $tag_link = get_tag_link($tag->term_id);
		                    $html .= "<li class='tag-item'>";
		                    
		                    if ( $tag->count > 1 ) {
		                        $html .= "<p><a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
		                    } else {
		                        $html .= "<p><a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
		                    }
		                    $html .= "{$tag->name}</a><span class='tag-count'>{$tag->count}</span></p>";
		                    $html .= "</li>";
		                }
		                $html .= '</ul>';
		            }
		            
		            $html .= '</div>';
		            
		            echo $html;
		            
		            $index++;
		        }                    
		    }
		}
		?>
			
	</div><!-- END #tag-index -->
</div><!-- END #main -->

<?php get_footer(); ?>