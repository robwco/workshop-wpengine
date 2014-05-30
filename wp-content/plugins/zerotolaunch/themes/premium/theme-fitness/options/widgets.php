<?php
/**
 * Register the new widget classes here so that they show up in the widget list 
 */
function crb_load_widgets() {
	register_widget('ThemeWidgetBio');
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
		$this->setup('Theme Widget - Bio', 'Displays a block with image/text', array(
			Carbon_Field::factory('image', 'image'),
			Carbon_Field::factory('rich_text', 'content')
		), 'widget-text');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		extract($args);
		extract($instance);

		?>

		<?php if ( $image ) : ?>
		<img src="<?php echo wpthumb( $image, array( 'width' => 300 ) ); ?>" alt="" />
		<?php endif; ?>
	
		<?php echo apply_filters('the_content', $content); ?>		

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

		<div class="fb-like-box" data-href="<?php echo esc_url( $facebook_page_url ); ?>" data-width="300" data-height="240" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

		<?php
	}
}