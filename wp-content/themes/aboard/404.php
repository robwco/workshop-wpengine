<?php
/**
The 404 Template.
*/

get_header(); 

$options = get_option('radium_theme');

?>
  
<div id="main" class=" twelve columns clearfix" role="main">

	<h2><?php do_action('radium_errortext'); ?></h2>
	
	<p><?php do_action('radium_errorptext'); ?></p>
	
	<a class="btn square large" href="javascript:javascript:history.go(-1)">
		
		<?php do_action('radium_errorbtntext'); ?>
	
	</a>

</div><!-- END #main -->

<?php get_footer(); ?>