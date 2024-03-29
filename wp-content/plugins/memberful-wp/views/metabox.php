<?php if ( ! empty( $subscriptions ) || ! empty( $products ) ) : ?>
	<div class="memberful-restrict-access-options">
		<h4 style="font-size: 13px;"><?php _e( 'Who can read this post?', 'memberful' ); ?></h4>
		<div class="memberful-acl-block">
			<label>
				<input type="checkbox" name="memberful_viewable_by_any_registered_users" value="1" <?php if($viewable_by_any_registered_users): ?>checked="checked"<?php endif; ?> />
				Any registered user
			</label>
		</div>
		<div data-depends-on="memberful_viewable_by_any_registered_users" data-depends-value-not="1">
			<?php if ( ! empty( $subscriptions ) ) : ?>
				<div id="memberful-subscriptions" class="memberful-acl-block">
					<p class="memberful-access-label"><?php _e( 'Anybody subscribed to:', 'memberful' ); ?></p>
					<ul>
					<?php foreach($subscriptions as $id => $subscription): ?>
						<li>
							<label>
								<input type="checkbox" name="memberful_subscription_acl[]" value="<?php echo $id; ?>" <?php checked( $subscription['checked'] ); ?>>
								<?php echo esc_html( $subscription['name'] ); ?>
							</label>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $products ) ) : ?>
				<div id="memberful-downloads" class="memberful-acl-block">
					<p class="memberful-access-label"><?php _e( 'Anybody who owns:', 'memberful' ); ?></p>
					<ul>
					<?php foreach($products as $id => $product): ?>
						<li>
							<label>
								<input type="checkbox" name="memberful_product_acl[]" value="<?php echo $id; ?>" <?php checked( $product['checked'] ); ?>>
								<?php echo esc_html( $product['name'] ); ?>
							</label>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="memberful-marketing-content">
		<?php

		$editor_id = 'memberful_marketing_content';
		$settings  = array();
		wp_editor( $marketing_content , $editor_id, $settings );

		?>
		<div class="memberful-marketing-content-description">
			<label>
				<input type="checkbox" name="memberful_make_default_marketing_content" value="1">
				Make this the default marketing content for new posts and pages
			</label>
		</div>
	</div>
<?php else: ?>
	<div>
		<p><em><?php _e( "We couldn't find any products or subscriptions in your Memberful account. You'll need to add some before you can restrict access.", 'memberful' ); ?></em></p>
	</div>
<?php endif; ?>
