<?php
/**
 * The Sidebar.
 *
 * @package Frontline
 * @since RadiumFramework 1.0.0
 */
 ?>	
<div class="sidebar">    
  
	<?php 
	
		do_action('radium_before_sidebar'); 
	    
		// Display the Blog/Page Sidebar
	    dynamic_sidebar();
	
		do_action('radium_after_sidebar'); 
	      
	 ?>
	
</div>