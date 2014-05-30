			<div class="footer-push notext">&nbsp;</div><!-- /.footer-push notext -->
		</div><!-- /.wrapper -->
		<div class="footer">

				<?php if ( is_page_template( 'template-landing.php' ) ) : ?>
				
				<div class="navigation">
					<div class="shell">
						<ul class="menu">
							<li><a href="<?php echo esc_url( get_option('disclosure_url') ); ?>">Disclosure</a></li>
						</ul><!-- /.menu -->
						<p class="copyright"><?php echo get_option( 'copyright' ); ?></p>
					</div><!-- /.shell -->
				</div><!-- /.nav -->	
								
				<?php else : ?>

				<div class="navigation">
					<div class="shell">
					<?php
						$args = array(
							'container' 		=> false,
							'theme_location' 	=> 'main-menu',
							'menu_class' 		=> 'menu',
						);
						wp_nav_menu( $args );
					?>
					<p class="copyright"><?php echo get_option( 'copyright' ); ?></p>
					</div><!-- /.shell -->
				</div><!-- /.navigation -->				
				
				<a class="footer-logo" href="<?php echo home_url('/') ?>"><?php bloginfo( 'name' ); ?> <span class="footer-tagline"><?php bloginfo('description'); ?></span></a>
				
				<?php endif; ?>
				

		</div><!-- /.footer -->

		<?php wp_footer(); ?>
	</body>
</html>