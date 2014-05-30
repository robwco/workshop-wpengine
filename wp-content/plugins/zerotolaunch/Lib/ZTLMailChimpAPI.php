<?php
require_once ABSPATH.'wp-includes/option.php';
require_once ZTL_PLUGIN_PATH . 'Vendor/MailChimp/src/Mailchimp.php';

class ZTLMailChimpAPI {
	var $apiKey;
	
	//60*60*24 = '86400' = 1 day
	var $cacheTime = '7200'; //2hrs
	
	public function __construct($apikey) {
		$this->apiKey = $apikey;
	}
	
	public function isApiValid($apiKey) {
		$this->apiKey = $apiKey;
		try {
			$lists = $this->getAllLists(false);	
			return true;
		}
		catch (Exception $e) {
			if (get_class($e) == "Mailchimp_Invalid_ApiKey") {
				return false;		
			}
		
			return false;
		}		
	}
	
	public function getAllLists($useCache=true) {
		if ($useCache) {
			$cached = get_transient('ztl_plugin_all_lists');
			if (!empty($cached)) {
				return $cached;
			}
		}
		
		$mailchimp = new Mailchimp($this->apiKey);

		$limit = 100;
		$sortBy = 'created';
		$sortOrder = 'ASC';
	
		$lists = $mailchimp->lists->getList(
				array(), 0, $limit, $sortBy, $sortOrder);
	
		$page = 0;
		$retrieved = array();
		do {
			foreach ($lists['data'] as $list) {
				$retrieved[] = $list;
			}
			
			$lists = $mailchimp->lists->getList(
							array(), ++$page, $limit, $sortBy, $sortOrder
						);
		}
		while(!empty($lists['data']));
		
		set_transient('ztl_plugin_all_lists', $retrieved);
		return $retrieved;
	
	}
	
	public function addSubscriber($listID, $email, $firstName, $lastName) {
		$mailchimp = new Mailchimp($this->apiKey);
									//http://apidocs.mailchimp.com/api/2.0/#api-endpoints
		$email_type='html'; 		//optional - optional email type preference for the email (html or text - defaults to html) 
		$double_optin=false; 		//optional - optional flag to control whether a double opt-in confirmation message is sent, defaults to true. Abusing this may cause your account to be suspended.
		$update_existing=false; 	//optional - optional flag to control whether existing subscribers should be updated instead of throwing an error, defaults to false 
		$replace_interests=true; 	//optional - optional flag to determine whether we replace the interest groups with the groups provided or we add the provided groups to the member's interest groups (optional, defaults to true) 
		$send_welcome=false; 		//optional - optional if your double_optin is false and this is true, we will send your lists Welcome Email if this subscribe succeeds - this will *not* fire if we end up updating an existing subscriber. If double_optin is true, this has no effect. defaults to false. 
		
		return $mailchimp->lists->subscribe($listID, 
					array(
						'email'=>$email), 
					array(
						'FNAME'=>$firstName,
						'LNAME'=>$lastName
					), 
					$email_type, 
					$double_optin, 
					$update_existing, 
					$replace_interests, 
					$send_welcome
				);
	}
	public function findSubscriberByEmail($listID, $email, $useCache=true) {
		$subscribers = $this->findAllSubscribers($listID, $useCache);
		foreach ($subscribers as $subscriber) {
			if ($subscriber['email'] == $email) {
				return $subscriber;
			}
		}
		
		return null;
	}
	public function findAllSubscribers($listID, $useCache=true) {
		if ($useCache) {
			$cached = get_transient('ztl_plugin_subscribers_of_list-'.$listID);
			if (!empty($cached)) {
				return $cached;
			}
		}
		
		$mailchimp = new Mailchimp($this->apiKey);
		
		$limit = 100;
		$sortBy = 'created';
		$sortOrder = 'ASC';		
		
		$lists = $mailchimp->lists->members(
					$listID, 
					'subscribed',  
					array(
						'start'=>0,
						'limit'=>$limit,
						'sort_field'=>$sortBy,
						'sort_dir'=>$sortOrder
					)
		);
		
		$page = 0;
		$retrieved = array();
		do {
			foreach ($lists['data'] as $list) {
				$retrieved[] = $list;
			}
			
			$lists = $mailchimp->lists->members(
						$listID, 
						'subscribed',  
						array(
							'start'=>++$page,
							'limit'=>$limit,
							'sort_field'=>$sortBy,
							'sort_dir'=>$sortOrder
						)
			);
					
		}	
		while(!empty($lists['data']));
		
		set_transient('ztl_plugin_subscribers_of_list-'.$listID, $retrieved);
		
		return $retrieved;
	}
}
?>