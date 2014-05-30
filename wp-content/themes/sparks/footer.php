	<?php zilla_footer_before(); ?>
	<!-- BEGIN #footer -->
	<div id="footer">
		
		<!-- BEGIN .block -->
		<div class="block clearfix">
	    
	    <?php zilla_footer_start(); ?>
	    
	    	<?php get_sidebar( 'footer' ); ?>
	    	
			<!-- BEGIN .footer-lower -->	    
		    <div class="footer-lower">
		    
				<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>. <?php _e('Powered by', 'zilla') ?> <a href="http://wpengine.com/">WPEngine</a>.</p>
			
				<p class="credit">The best freelance leads in your inbox every day. <div class="createsend-button" style="height:22px;display:inline-block;" data-listid="i/73/D03/F44/7211DBCF84C24438">
</div><script type="text/javascript">(function () { var e = document.createElement('script'); e.type = 'text/javascript'; e.async = true; e.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://btn.createsend1.com/js/sb.min.js?v=2'; e.className = 'createsend-script'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s); })();</script></p>


 
			<!-- END .footer-lower -->
			</div>
		
	    <?php zilla_footer_end(); ?>
	    <!--END .block -->
	    </div>
	    
	<!-- END #footer -->
	</div>
	<?php zilla_footer_after(); ?>
			
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	<?php zilla_body_end(); ?>
			
	<!-- <?php echo 'Ran '. $wpdb->num_queries .' queries '. timer_stop(0, 2) .' seconds'; ?> -->
<!--END body-->
</body>
<!--END html-->
</html>