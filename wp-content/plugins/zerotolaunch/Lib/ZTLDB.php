<?php

require_once ABSPATH . 'wp-config.php';
require_once ZTL_PLUGIN_PATH . 'Vendor/php-activerecord/ActiveRecord.php';

// Setup our table prefix as a constant so that we can reference
// it in static class variables (in order to specify AR table names).
global $wpdb;

define('ZTL_TABLE_PREFIX', $wpdb->prefix . 'ztl_plugin_');

/**
 * Class ZTLDB handles the setup, migration, and seeding of our ZTl-specific tables.
 */
class ZTLDB {
	public $modelDir;

	public static function register() {
		$db = new ZTLDB();
		$db->setup();

		return $db;
	}

	public function __construct() {
		$this->modelDir = ZTL_PLUGIN_PATH . 'Model/';
	}

	public function setup() {
		// PHP 5.3 doesn't support using $this within a closure
		$dir = $this->modelDir;

		//initialize script for PHPActiveRecord
		ActiveRecord\Config::initialize(function($cfg) use ($dir) {
			$cfg->set_model_directory($dir);

			$connectionStrings = array(
				'default' => 'mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/'.DB_NAME
			);

			$cfg->set_connections(array(
				'development'=>$connectionStrings['default']
			));
		});

		$this->eagerLoadModels();
	}

	public function migrate()
	{
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$ztl_db_version = '1.0';

		// WARNING Primary keys that are defined at the end of the table (not inline with the column)
		// MUST have two spaces between "PRIMARY KEY" and the column list. e.g. "PRIMARY KEY	(id)",
		// otherwise WP will have issues trying to add another primary key when rerun.
		$sql = "CREATE TABLE IF NOT EXISTS " . ZTL_TABLE_PREFIX . "optin_forms (
						id int(11) NOT NULL AUTO_INCREMENT,
						mailing_list_id varchar(255) DEFAULT NULL,
						name varchar(125) NOT NULL,
						slug varchar(255) NOT NULL,
						headline varchar(255) DEFAULT NULL,
						sub_headline varchar(255) DEFAULT NULL,
						name_field_text varchar(255) DEFAULT NULL,
						email_field_text varchar(255) DEFAULT NULL,
						c2a_button_text varchar(255) DEFAULT NULL,
						body text,
						description varchar(255) DEFAULT NULL,
						redirect_url varchar(255) DEFAULT NULL,
						display_image boolean DEFAULT true,
						display_name_field boolean DEFAULT true,
						image_url varchar(255) DEFAULT NULL,
						image_alt varchar(255) DEFAULT NULL,
						image_width integer DEFAULT NULL,
						image_height integer DEFAULT NULL,
						theme varchar(255) DEFAULT NULL,
						PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS " . ZTL_TABLE_PREFIX . "landing_pages (
						id int(11) NOT NULL AUTO_INCREMENT,
						optin_form_id int(11),
						slug varchar(255) DEFAULT NULL,
						name varchar(255) DEFAULT NULL,
						body text,
						before_optin text DEFAULT NULL,
						after_optin text DEFAULT NULL,
						header text DEFAULT NULL,
						logo_url varchar(255) DEFAULT NULL,
						logo_alt varchar(255) DEFAULT NULL,
						logo_width integer DEFAULT NULL,
						logo_height integer DEFAULT NULL,
						theme varchar(255) DEFAULT 'demo',
						status varchar(20) DEFAULT 'draft',
						PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS " . ZTL_TABLE_PREFIX . "popups (
					id int(11) NOT NULL AUTO_INCREMENT,
					optin_form_id int(11),
					slug varchar(255) DEFAULT NULL,
					name varchar(255) DEFAULT NULL,
					time_to_popup int(11) DEFAULT 7,
					timeout_in_days int(11) DEFAULT 3,
					page_delay int(11) DEFAULT 2,
						display_location varchar(40) DEFAULT NULL,
					valid_page_ids text DEFAULT NULL,
					view_count int(11) DEFAULT NULL,
					optin_count int(11) DEFAULT NULL,
					theme_id int(11) DEFAULT NULL,
					created date DEFAULT NULL,
					modified date DEFAULT NULL,
					status varchar(20) DEFAULT 'draft',
					PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS " . ZTL_TABLE_PREFIX . "adapters (
					id int(11) NOT NULL AUTO_INCREMENT,
					type varchar(255) DEFAULT NULL,
					name varchar(255) DEFAULT NULL,
					api_id varchar(255) DEFAULT NULL,
					api_key varchar(255) DEFAULT NULL,
					created date DEFAULT NULL,
					modified date DEFAULT NULL,
					PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS " . ZTL_TABLE_PREFIX . "activity (
				id int(11) NOT NULL AUTO_INCREMENT,
				date date DEFAULT NULL,
				optin_form_id int(11) DEFAULT NULL,
				landing_page_id int(11) DEFAULT NULL,
				category varchar(20) DEFAULT NULL,
				type varchar(80) DEFAULT NULL,
				slug varchar(255) DEFAULT NULL,
				hits int(11) DEFAULT NULL,
				PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS ".ZTL_TABLE_PREFIX."skus (
				id int(11) NOT NULL AUTO_INCREMENT,
				wl_level_unique_id int(11) DEFAULT NULL,
				level_name varchar(255) DEFAULT NULL,
				sku varchar(255) DEFAULT NULL,
				PRIMARY KEY	 (id)
			) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
			";
		dbDelta($sql);

		$sql = "CREATE TABLE IF NOT EXISTS ".ZTL_TABLE_PREFIX."optin_form_leads (
					id int(11) NOT NULL AUTO_INCREMENT,
					optin_form_id int(11) DEFAULT NULL,
					name varchar(255) DEFAULT NULL,
					email varchar(255) DEFAULT NULL,
					created datetime DEFAULT NULL,
					PRIMARY KEY	 (id)
				) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
				";
		dbDelta($sql);

		add_option( "ztl_db_version", $ztl_db_version );
	} // END public static function activate

	public function insertSeedData() {
		global $wpdb;


		if (0 == $wpdb->get_var('SELECT COUNT(*) FROM ' . ZTL_TABLE_PREFIX . 'adapters WHERE id = 1')) {
			$wpdb->insert(
				ZTL_TABLE_PREFIX . 'adapters',
				array(
					'id'=>'1',
					'type'=>'1',
					'name'=>'MailChimp',
					'api_id'=>'1'
				)
			);
		}

		if (0 == $wpdb->get_var('SELECT COUNT(*) FROM ' . ZTL_TABLE_PREFIX . 'adapters WHERE id = 2')) {
			$wpdb->insert(
				ZTL_TABLE_PREFIX . 'adapters',
				array(
					'id'=>'2',
					'type'=>'2',
					'name'=>'Gumroad',
					'api_id'=>'2',
					'api_key'=>'Add your Gumroad API Key.'
				)
			);
		}
	}

	public function insertDefaultContent() {
		global $wpdb;

		// Insert Opt-in
		if (0 == $wpdb->get_var('SELECT COUNT(*) FROM ' . ZTL_TABLE_PREFIX . 'optin_forms WHERE id = 1')) {
			$wpdb->insert(
				ZTL_TABLE_PREFIX . 'optin_forms',
				array(
					'id'=>'1',
					'name'=>'Free Newsletter',
					'slug'=>'free-newsletter',
					'headline'=>'Sign up for my FREE newsletter',
					'sub_headline'=>'Submit your name and email below and I\'ll send my free newsletter. (No spam. Unsubscribe at any time.',
					'name_field_text'=>'Your Name',
					'email_field_text'=>'Your Email',
					'c2a_button_text'=>'Sign me up!',
					'body'=>'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque molestie lacus arcu, at tristique purus malesuada ut. Vestibulum at sem vitae risus interdum dapibus. Ut adipiscing felis bibendum leo volutpat, ac pharetra tellus viverra. Aliquam posuere lectus nec elit gravida suscipit. Proin ultrices et tortor vitae ultrices.</p>',
					'redirect_url'=>'/thank-you/',
					'display_image'=>'1',
					'display_name_field'=>'1',
					'theme' => 'light-grey',
				)
			);
		}

		// Insert Landing Page
		if (0 == $wpdb->get_var('SELECT COUNT(*) FROM ' . ZTL_TABLE_PREFIX . 'landing_pages WHERE id = 1')) {
			$wpdb->insert(
				ZTL_TABLE_PREFIX . 'landing_pages',
				array(
					'id'=>'1',
					'optin_form_id'=> 1,
					'slug'=>'free-newsletter',
					'name'=>'Free Newsletter',
					'body' => '<p>One of the things I&#39;ve been quietly working on lately is helping people find their dream jobs</p>
				<p>In fact, I&#39;ve been helping people crush interviews, negotiate salaries, and find what they love to do since my sophomore year of college -- and keeping detailed notes on every technique I use.</p>
				<p>And now it&#39;s time to start revealing some of them.</p>
				<p>Today, I invite you to sign up for my <strong>Dream Job Insider&#39;s List</strong>. Here&#39;s just some of what I&#39;ll be sending you in the coming weeks and months:</p>
				<ul>
					<li>How to find out what you LOVE to do -- and would be profitable</li>
					<li>Psychological techniques for outshining competing job applicants (like how I beat out 5+ Stanford business-school students for a job...as a sophomore)</li>
					<li>Direct answers to the toughest interview questions</li>
					<li>Often ignored techniques to instantly make your resume shine</li>
					<li>&ldquo;Before and after&rdquo; commentary on interviews that succeeded and failed</li>
					<li>Tear-downs of real resumes from my students</li>
				</ul>
				<p><strong>Sign up for free to get started <span class="highlight">&rarr;</span></strong></p>',
					'header'=>'<h1 class="center">Get specific tips on landing your<br /><strong>dream job</strong> in months instead of years</h1>',
					'logo_url' => 'http://www.iwillteachyoutoberich.com/dreamjob-partner-page/images/iwt-logo.png',
					'theme' => 'ztl-iwt'
				)
			);
		}

		// Insert Popup(Lightbox)
		if (0 == $wpdb->get_var('SELECT COUNT(*) FROM ' . ZTL_TABLE_PREFIX . 'popups WHERE id = 1')) {
			$wpdb->insert(
				ZTL_TABLE_PREFIX . 'popups',
				array(
					'id'=>'1',
					'optin_form_id'=>'1',
					'name'=>'Your First Lightbox',
					'slug'=>'your-first-lightbox',
					'time_to_popup'=>'9',
					'timeout_in_days'=>'3',
					'page_delay'=>'3',
					'display_location'=>'everywhere',
					'status' => 'draft'
				)
			);
		}

		// Always insert Thankyou Page if it doesn't exist already
		if (1 > $wpdb->get_var('SELECT COUNT(*) FROM wp_posts WHERE post_name = "thank-you" AND post_status = "publish"')) {
			wp_insert_post(
				array(
					'post_author' => 1,
					'post_date' => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_content' => '<p>Thanks for signing up to my newsletter! You confirm you want to join, and you\'ll start getting my best material. Here\'s all you need to do:</p>
				<p><strong>Step 1</strong>: Check your inbox for the confirmation email I sent you.</p>
				<p><strong>Step 2</strong>: Click the confirmation link in that email.</p>
				<p>If you don\'t click the confirmation link, you won\'t receive anything from me. But once you confirm your email, you\'re all set.</p>
				<p>Use Gmail? If my email is in your "Promotions" tab, just drag it into your "Primary" folder so you always see your newsletter.</p>
				<p>(Note: If you didn\'t receive my email within the next hour, check your spam folder.)</p>',
					'post_title' => 'Thanks for signing up for my newsletter!',
					'post_name' => 'thank-you',
					'post_excerpt' => '',
					'post_status' => 'publish',
					'comment_status' => 'open',
					'ping_status' => 'open',
					'post_modified' => date('Y-m-d H:i:s'),
					'post_modified_gmt' => date('Y-m-d H:i:s'),
					'post_parent' => 0,
					'post_type' => 'page',
					'comment_count' => 0
				)
			);
		}

		// Insert Homepage
		if (5 > $wpdb->get_var('SELECT COUNT(*) FROM wp_posts WHERE post_type = "post" OR post_type = "page" AND post_status = "publish"')) {
			wp_insert_post(
				array(
					'post_author' => 1,
					'post_date' => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque molestie lacus arcu, at tristique purus malesuada ut. Vestibulum at sem vitae risus interdum dapibus. Ut adipiscing felis bibendum leo volutpat, ac pharetra tellus viverra. Aliquam posuere lectus nec elit gravida suscipit. Proin ultrices et tortor vitae ultrices.',
					'post_title' => 'Homepage',
					'post_name' => 'homepage',
					'post_excerpt' => '',
					'post_status' => 'publish',
					'comment_status' => 'open',
					'ping_status' => 'open',
					'post_modified' => date('Y-m-d H:i:s'),
					'post_modified_gmt' => date('Y-m-d H:i:s'),
					'post_parent' => 0,
					'post_type' => 'page',
					'comment_count' => 0
				)
			);
			wp_insert_post(
				array(
					'post_author' => 1,
					'post_date' => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_content' => '<p>This is your "About Me" page. Use this space to introduce yourself and let people know how you can help them.</p>',
					'post_title' => 'About Me',
					'post_name' => 'about-me',
					'post_excerpt' => '',
					'post_status' => 'publish',
					'comment_status' => 'open',
					'ping_status' => 'open',
					'post_modified' => date('Y-m-d H:i:s'),
					'post_modified_gmt' => date('Y-m-d H:i:s'),
					'post_parent' => 0,
					'post_type' => 'page',
					'comment_count' => 0
				)
			);
			wp_insert_post(
				array(
					'post_author' => 1,
					'post_date' => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_content' => '<h2>How to automate your finances for life</h2>
					<p><strong>(INTRO)</strong><br />
					Have you ever forgotten to pay a bill? Wondered why there’s never money in your savings account? Been frustrated because you don’t know where your money goes?</p>
					<p>I’d like to show you a better way -- the system I created so you can make sure every bill is paid automatically, funnel money to your savings and fun activity accounts, and free up more time to do the things you love.</p>
					<p>Here’s how it works:</p>
					<p><strong>(SUBTOPIC #1 HEADLINE)</strong><br />
					Make a list of all your accounts and monthly bills</p>
					<p><strong>(MORE ABOUT SUBTOPIC #1)</strong><br />
					It’s easy to get overwhelmed when all our bills, bank accounts, and other payments are scattered around different places. When’s the cable bill due -- and where do I send it? Where’s the bill for rent again?</p>
					<p>With the right systems, you won’t have to spent frustrating hours scouring your bank account and paperwork, just so your finances don’t fall apart. Here’s the first step...</p>
					<p><strong>(SUBTOPIC #2 HEADLINE)</strong><br />
					Set up auto-billpay for your online banking</p>
					<p><strong>(MORE ABOUT SUBTOPIC #2)</strong><br />
					Have you ever wasted a lunch break going to the bank? Spent part of your weekend writing and mailing checks? Man, I hate writing checks and going to the bank when I don’t have to.</p>
					<p>With automatic billpaying, you can go months without needing to head to the bank or write a check...</p>
					<p><strong>(MORE SUBTOPICS...)</strong></p>
					<p><strong>(CONCLUSION)</strong><br />
					In just a few hours, your finances will be automated for life... so you’ll never have to worry about whether your bills are paid or where your money’s going again.</p>
					<p><strong>(CALL TO ACTION)</strong><br />
					Want to learn more systems to save time and frustration with your finances? Just give me your name and email address, and you’ll get access to my private email list, including strategies and tactics I won’t share anywhere else.</p>',
					'post_title' => 'Welcome to My First ZTL Blog Post',
					'post_name' => 'welcome-to-my-first-ztl-blog-post',
					'post_excerpt' => '',
					'post_status' => 'publish',
					'comment_status' => 'open',
					'ping_status' => 'open',
					'post_modified' => date('Y-m-d H:i:s'),
					'post_modified_gmt' => date('Y-m-d H:i:s'),
					'post_parent' => 0,
					'post_type' => 'post',
					'comment_count' => 0
				)
			);
			//Makes Lighbox active
			$wpdb->update(
				ZTL_TABLE_PREFIX . 'popups',
				array(
					'status' => 'publish'
				),
				array( 'id'=> 1 ) ,
				array(
					'%s'
				)
			);
		}

	}

	// On case-sensitive filesystems we sometimes have an issue with our naming convention ("ZTL")
	// not matching the auto-loader naming conventions, so we explicitly require our models.
	protected function eagerLoadModels() {
		if (is_dir($this->modelDir)) {
			if ($modelFiles = scandir($this->modelDir)) {
				foreach ($modelFiles as $file) {
					if (strpos($file, '.') !== 0) {
						require_once $this->modelDir . $file;
					}
				}
			}
		}
	}
}
