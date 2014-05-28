			<div class="footer-push notext">&nbsp;</div><!-- /.footer-push notext -->
		</div><!-- /.wrapper -->
		<div class="footer">
			<div class="shell cf">

				<?php if ( is_page_template( 'template-landing.php' ) ) : ?>
				<div class="nav">
					<ul class="menu">
						<li><a href="<?php echo esc_url( get_option('disclosure_url') ); ?>">Disclosure</a></li>
					</ul><!-- /.menu -->
				</div><!-- /.shell -->					
				<?php else : ?>

				<div class="nav">
					<?php
						$args = array(
							'container' 		=> false,
							'theme_location' 	=> 'main-menu',
							'menu_class' 		=> 'menu',
						);

						wp_nav_menu( $args );
					?>
				</div><!-- /.shell -->
				
				<?php endif; ?>

				<p class="copyright"><?php echo get_option( 'copyright' ); ?></p>
			</div><!-- /.nav -->
		</div><!-- /.footer -->

		<?php wp_footer(); ?>
	</body>
</html>