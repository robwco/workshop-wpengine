<?php

Carbon_Container::factory('theme_options', 'Theme Options')
	->add_fields(array(
		Carbon_Field::factory('separator', 'general_settings'),
		Carbon_Field::factory('image', 'website_logo'),
		Carbon_Field::factory('image', 'bio_image'),
		Carbon_Field::factory('rich_text', 'bio_text'),
		Carbon_Field::factory('rich_text', 'top_landing_text'),
		Carbon_Field::factory('text', 'disclosure_url'),
		Carbon_Field::factory('text', 'copyright'),
		Carbon_Field::factory('separator', 'misc_settings'),
		Carbon_Field::factory('header_scripts', 'header_script'),
		Carbon_Field::factory('footer_scripts', 'footer_script'),
	));

if ( carbon_twitter_widget_registered() ) {
	Carbon_Container::factory('theme_options', 'Twitter Settings')
		->set_page_parent('Theme Options')
		->add_fields(array(
			Carbon_Field::factory('html', 'twitter_settings_html')
				->set_html('
					<div style="position: relative; margin-left: -230px; background: #eee; border: 1px solid #ccc; padding: 10px;">
						<p><strong>Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:</strong></p>
						<ol>
							<li>Go to <a href="https://dev.twitter.com/apps/new" target="_blank">https://dev.twitter.com/apps/new</a> and log in, if necessary</li>
							<li>Supply the necessary required fields, accept the Terms of Service, and solve the CAPTCHA. Callback URL field may be left empty</li>
							<li>Submit the form</li>
							<li>On the next screen scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button</li>
							<li>Copy the following fields: Access token, Access token secret, Consumer key, Consumer secret to the below fields</li>
						</ol>
					</div>
				'),
			Carbon_Field::factory('text', 'twitter_oauth_access_token')
				->set_default_value(''),
			Carbon_Field::factory('text', 'twitter_oauth_access_token_secret')
				->set_default_value(''),
			Carbon_Field::factory('text', 'twitter_consumer_key')
				->set_default_value(''),
			Carbon_Field::factory('text', 'twitter_consumer_secret')
				->set_default_value(''),
		));
}