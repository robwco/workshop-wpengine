<?php
/**
 * The template for displaying the footer.
 *
 * @package RadiumFramework
 * @subpackage Aboard
 * 
 * 
 * @since RadiumFramework 1.0.0
 */
 
 $options 	= get_option('radium_theme');
 
?>
 	</div><!--.row-->
	
	<?php do_action('radium_after_content_container'); ?>
	
	<?php do_action('radium_before_footer'); ?>

</section>

<footer id="bottom-footer">
	
	<div class="row">
		
		<div class="twelve columns">
			
			<?php do_action('radium_before_footer_widgets'); ?>
	
			<div class="container">
			 	
			 	<aside id="footer-widgets" class="clearfix">
			 		
			 		<div class="row">
	
				 		<div class="widget_row">
			 				
			 				<div class="twelve columns">
			 					
			 					<div class="footer-widgets-full">
			 						
			 						<?php if ( !dynamic_sidebar( 'Footer Full' ) ): ?><?php endif; ?>
			 					
			 					</div><!-- END .twelve columns -->
			 				
			 				</div><!-- END .twelve columns -->
				 		
				 		</div><!-- END widget_row -->
				 		
				 		<div class="widget_row">
				 			
				 			<div class="six columns">
				 				
				 				<div class="footer-widgets-left">
				 					
				 					<?php if ( !dynamic_sidebar( 'Footer Left' ) ): ?><?php endif; ?>
				 				
				 				</div>
				 			
				 			</div><!-- END .six columns -->
				 			
				 			<div class="six columns">
				 				
				 				<div class="footer-widgets-right">
				 					
				 					<?php if ( !dynamic_sidebar( 'Footer Right' ) ): ?><?php endif; ?>
				 				
				 				</div><!-- END .six columns -->
				 			
				 			</div><!-- END .six columns -->
				 		
				 		</div><!-- END widget_row -->
				 		
					</div><!-- END .row -->
				
				</aside><!-- END #footer-widgets -->
				
				<?php do_action('radium_after_footer_widgets'); ?>
				
		 	</div><!-- END .container -->	 	
 		
 		</div><!-- END .twelve columns -->
 	
 	</div><!-- END .row -->

</footer><!-- END #bottom-footer -->

<div id="colophon" role="contentinfo">	
	
	<div class="row">
	
		<div class="six columns">
			
			<?php do_action('radium_copyright'); ?>
		
		</div><!-- END .six columns -->
		
		<div class="six columns">
			
			<div class="footer-widgets-bottom">
				
				<?php if ( !dynamic_sidebar( 'Footer Bottom' ) ): ?><?php endif; ?>
			
			</div><!-- END .footer-widgets-bottom -->
		
		</div><!-- END .six columns -->
	
	</div><!-- END .row -->

</div><!--END #colophon-->

<?php 

do_action('radium_after_footer'); 

do_action('radium_developer');

radium_analytics(false); 

wp_footer();  
?>

</body>
</html>