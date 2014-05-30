<?php

Carbon_Container::factory('custom_fields', __('Page Data', 'ztl-fashion'))
	->show_on_post_type('page')
	->add_fields(array(
		Carbon_Field::factory('choose_sidebar', 'page_sidebar')
	));