<?php

define('ZTL_POPUP_TABLE', ZTL_TABLE_PREFIX . 'popups');

class ZTLPluginPopups extends ActiveRecord\Model{
	static $table_name = ZTL_POPUP_TABLE;
	static $statuses = array('publish', 'draft');
	static $attr_protected = array('id');

	static $validates_presence_of = array(
		array('name', 'message'=>"'Lightbox Name' is blank. Please select the 'Lightbox Name'"),
		array('display_location', 'message'=>"'Active Page' is empty. Please select the 'Active Page'")
	);
	
	static $validates_inclusion_of = array(
		array('status', 'in' => array('publish', 'draft'))
	);

	static $validates_uniqueness_of = array(
		array('name')
	);

	//static $validates_format_of = array(
	//	array('slug', 'with'=>"/^[a-z0-9-]+$/", 'message'=>'should not contain spaces, only letters, numbers, hyphen or underscores are allowed.')
	//);

	static $validates_numericality_of = array(
		array('optin_form_id', 'greater_than' => 0, 'allow_blank' => false, 'allow_null' => false, 
			'message' => "'Opt-in Form' is empty. Please select an 'Opt-in Form'")
	);

	/**
	 * Get a count of optin forms by status.
	 *
	 * In addition to the statuses in the database, an "all" status is also included
	 * with the total number of optin forms counted.
	 *
	 * @return array Keys are status, values are the number of optin forms with that status.
	 *
	 */
	public static function status_counts() {
		$raw_results = self::find('all', array(
			'select' => '`status`, COUNT(*) form_count',
			'group' => 'status'));

		$results = array_fill_keys(self::$statuses, 0);

		foreach ($raw_results as $popup) {
			$results[$popup->status] = $popup->form_count;
		}

		$results['all'] = array_sum($results);
		return $results;
	}
}

