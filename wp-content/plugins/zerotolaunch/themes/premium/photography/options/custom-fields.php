<?php

Carbon_Container::factory('custom_fields', __('Page Home Data', 'domain'))
	->show_on_post_type('page')
	->show_on_template('template-home.php')
	->add_fields(array(
		Carbon_Field::factory('image', 'home_image')
			->help_text('Size: 1600px * 460px. Larger images will be automatically scaled & cropped to fit that size.'),
		Carbon_Field::factory('text', 'start_url'),
		Carbon_Field::factory('text', 'posts_count')
			->set_default_value(3),
	));

Carbon_Container::factory('custom_fields', __('Page Data', 'domain'))
	->show_on_post_type('page')
	->add_fields(array(
		Carbon_Field::factory('choose_sidebar', 'page_sidebar')
	));