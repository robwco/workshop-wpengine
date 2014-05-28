<?php
/**
 * Register the new widget classes here so that they show up in the widget list 
 */
function crb_load_widgets() {
	register_widget('ThemeWidgetBio');
	register_widget('ThemeWidgetImage');
	register_widget('ThemeWidgetTestimonial');
	register_widget('ThemeWidgetTwitter');
	register_widget('ThemeWidgetFacebook');
}
add_action('widgets_init', 'crb_load_widgets');

/**
 * Displays a block with latest tweets from particular user
 */
class CrbLatestTweetsWidget extends Carbon_Widget {
	protected $form_options = array(
		'width' => 300
	);

	function __construct() {
		$this->setup('Latest Tweets', 'Displays a block with your latest tweets', array(
			Carbon_Field::factory('text', 'title', 'Title'),
			Carbon_Field::factory('text', 'username', 'Username'),
			Carbon_Field::factory('text', 'count', 'Number of Tweets to show')->set_default_value('5')
		));
	}

	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		if ( !carbon_twitter_is_configured() ) {
			return; //twitter settings are not configured
		}

		$tweets = TwitterHelper::get_tweets($instance['username'], $instance['count']);
		if (empty($tweets)) {
			return; //no tweets, or error while retrieving
		}

		extract($args);
		if ($instance['title']) {
			echo $before_title . $instance['title'] . $after_title;
		}
		?>
		<ul>
			<?php foreach ($tweets as $tweet): ?>
				<li><?php echo $tweet->tweet_text ?> - <span><?php echo $tweet->time_distance ?> ago</span></li>
			<?php endforeach ?>
		</ul>
		<?php
	}
}

/**
 * A Bio widget
 */
class ThemeWidgetBio extends Carbon_Widget {
	protected $form_options = array(
		'width' => 500
	);	

	/**
	 * Register widget function. Must have the same name as the class
	 */
	function ThemeWidgetBio() {
		$this->setup('Theme Widget - Bio', 'Displays a block with photo, name, title, and text', array(
			Carbon_Field::factory('image', 'bio_photo'),
			Carbon_Field::factory('text', 'bio_name'),
			Carbon_Field::factory('text', 'bio_title'),
			Carbon_Field::factory('textarea', 'bio_content')
		), 'widget-bio');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		?>

		<?php if ( $bio_photo ) : ?>
		<img src="<?php echo wpthumb( $bio_photo, array( 'width' => 100 ) ); ?>" alt="" />
		<?php endif; ?>
	
		<?php if ( $bio_name ) : ?><h3 class="name"><?php echo apply_filters( 'the_content', $bio_name ); ?></h3><?php endif; ?>
		<?php if ( $bio_title ) : ?><span class="title"><?php echo apply_filters( 'the_content', $bio_title ); ?></span><?php endif; ?>
		
		<div class="bio"><?php echo apply_filters('the_content', $bio_content); ?></div>	

		<?php
	}
}


/**
 * An image widget
 */
class ThemeWidgetImage extends Carbon_Widget {
	protected $form_options = array(
		'width' => 300
	);	

	/**
	 * Register widget function. Must have the same name as the class
	 */
	function ThemeWidgetImage() {
		$this->setup('Theme Widget - Image with Link', 'Displays an image along with an optional link.', array(
			Carbon_Field::factory('image', 'image')->help_text('Maximum width 313px. Larger images will automatically be cropped and resized.'),
			Carbon_Field::factory('text', 'link'),
		), 'widget-image');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		?>
		
		<?php if ( $link ) echo '<a href="' . $link .'">'; ?>
		<img src="<?php echo wpthumb( $image, array( 'width' => 313, 'crop' => true, 'crop_from_position', 'center,center' ) ); ?>" alt="" />
		<?php if ( $link ) echo '</a>'; ?>
	
		<?php
	}
}

/**
 * A testimonial widget
 */
class ThemeWidgetTestimonial extends Carbon_Widget {
	protected $form_options = array(
		'width' => 400
	);	

	/**
	 * Register widget function. Must have the same name as the class
	 */
	function ThemeWidgetTestimonial() {
		$this->setup('Theme Widget - Testimonial', 'Displays a testimonial along with image, name, and title.', array(
			Carbon_Field::factory('image', 'image')->help_text('Width and height of 100px. Larger images will automatically be cropped and resized.'),
			Carbon_Field::factory('text', 'name'),
			Carbon_Field::factory('text', 'title'),
			Carbon_Field::factory('textarea', 'testimonial'),
		), 'widget-testimonial');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		?>
		
		<?php if ( $image ) : ?>
		<img src="<?php echo wpthumb( $image, array( 'width' => 100, 'height' => '100px', 'crop' => true, 'crop_from_position', 'center,center' ) ); ?>" alt="" />
		<?php endif; ?>
		
		<?php if ( $name ) : ?><h3 class="name"><?php echo apply_filters( 'the_content', $name ); ?></h3><?php endif; ?>
		<?php if ( $title ) : ?><span class="title"><?php echo apply_filters( 'the_content', $title ); ?></span><?php endif; ?>
		
		<div class="testimonial"><?php echo apply_filters('the_content', $testimonial ); ?></div>	
	
		<?php
	}
}


/**
 * A Twitter widget
 */
class ThemeWidgetTwitter extends Carbon_Widget {
	/**
	 * Register widget function. Must have the same name as the class
	 */
	function ThemeWidgetTwitter() {
		$this->setup('Theme Widget - Twitter', 'Displays a Twitter Follow button', array(
			Carbon_Field::factory('text', 'content')
				->set_default_value( 'Follow me on twitter and get daily quick and easy fitness tips' ),
			Carbon_Field::factory('text', 'twitter_url')
				->set_default_value( '#' ),
		), 'widget-twitter');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		if ( empty($twitter_url) )
			return;

		?>

		<p><?php echo $content; ?></p>
		<a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><img src="<?php bloginfo( 'stylesheet_directory'); ?>/images/follow-us.png" alt="" /></a>

		<?php
	}
}


/**
 * A Facebook widget
 */
class ThemeWidgetFacebook extends Carbon_Widget {
	/**
	 * Register widget function. Must have the same name as the class
	 */
	function ThemeWidgetFacebook() {
		$this->setup('Theme Widget - Facebook', 'Displays a Facebook Like box', array(
			Carbon_Field::factory('text', 'facebook_page_url')
				->set_default_value( 'https://www.facebook.com/FacebookDevelopers' ),
		), 'widget-social');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		if ( empty($facebook_page_url) )
			return;

		?>

		<div class="fb-like-box" data-href="<?php echo esc_url( $facebook_page_url ); ?>" data-width="292" data-height="240" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>

		<?php
	}
}