<div class="sidebar right">
	<ul>
			
		<?php 
			$id = get_the_ID();

			$sidebar = crb_get_meta( '_page_sidebar', $id );

			if ( is_home() || is_singular( 'post' ) ) {
				$sidebar = 'Blog Sidebar';
			}

			if ( ! $sidebar ) {
				$sidebar = 'Default Sidebar';
			}

			dynamic_sidebar( $sidebar );
		?>
		
	</ul>
</div><!-- /.sidebar -->