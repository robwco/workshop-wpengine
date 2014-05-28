<?php
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLTwigView.php';
require_once 'ZTLAppController.php';

class ZTLSkuController extends ZTLAppController {
	public static function renderAjaxIfExists($getData) {
		if ($getData['page']=='ztl-integration' && $getData['action'] == 'add-new-sku') {
			
			$levels = self::checkWLMembershipCreated();	

			if (empty($levels)) {
				$skus = ZTLPluginSkus::find('all');
				if (empty($skus)) {
					echo json_encode(
						array('error'=>'Sorry, no membership levels added yet. <a href="/wp-admin/admin.php?page=WishListMember&wl=membershiplevels">Click here to add a new membership level now.</a>')
					);
				}
				else {
					echo json_encode(
						array('alert'=>'You have added all your levels')
					);					
				}
				exit;
			}			
			
			$view = new ZTLTwigView();
			$i='new';
			
			if (!empty($levels)) {
				echo json_encode(
					array('result'=>$view->render('admin/integrations/edit_wl_sku.twig', compact('levels', 'i')))
						);
			}
			exit; //ajax - prevent the whole page from displaying.			
    }
	}

	public static function checkWLMembershipCreated() {
		$skuIDs = array();
		$skus = ZTLPluginSkus::find('all');
		if (!empty($skus)) {
			foreach ($skus as $sku) {
				$skuIDs[] = $sku->wl_level_unique_id;
			}
		}

		global $wpdb;
		$wpdb->hide_errors();
		
		$levels = array();
		$serialized = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'wpm_levels'");
		if (!empty($serialized)) {
			$optionVal = unserialize($serialized);		
			foreach ($optionVal as $key=>$row) {
				if (!in_array($key, $skuIDs)) {
					$levels[$key] = $row;
				}
			}
		}

		return $levels;
	}

	public static function webhook($sku) {
		global $wpdb;
		$levels = array();
		$serialized = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'wpm_levels'");
		if (!empty($serialized)) {
			$rows = unserialize($serialized);
			foreach ($rows as $key=>$row) {
				if ($key == $sku) {

                    // Get the Secret Key and POST URL for WLM
                    // if they haven't set up WLM for generic integration, they won't have the secret key and
                    // POSTURL set, so we need to create those for them.
                    // --------------------------------------------------------
					$secretKey = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'genericsecret'");
					$postSlug = $wpdb->get_var("SELECT option_value FROM wp_wlm_options WHERE option_name = 'genericthankyou'");

                    // Set the SecretKey in WLM if it doesn't exist
                    if(empty($secretKey)){
                        $secretKey = uniqid();
                        $wpdb->insert('wp_wlm_options',array(
                            'option_name' => 'genericsecret',
                            'option_value' => $secretKey
                        ));
                    }

                    // Set the SecretKey in WLM if it doesn't exist
                    if(empty($postSlug)){
                        $postSlug = substr(uniqid(), rand(0, 15), 6);
                        $count = $wpdb->get_var("SELECT count(option_value) FROM wp_wlm_options WHERE option_name = 'genericthankyou'");
                        if ($count == 0) {
	                        $wpdb->insert('wp_wlm_options',array(
	                            'option_name' => 'genericthankyou',
	                            'option_value' => $postSlug
	                        ));
	                    }
                        else if ($cout == 1) {
                        	$wpdb->query("Update wp_wlm_options SET option_value = '".$postSlug."'
                        		WHERE option_name = 'genericthankyou'");
                        }
                    }

                    // Turn this into the URL we need to send to, with HTTPS support

                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    $postURL = $protocol . $_SERVER['HTTP_HOST'] . '/index.php/register/' . $postSlug;
                    // --------------------------------------------------------

					$data = array ();
					$data['cmd'] = 'CREATE';

                    // Create a transaction id from the purchase based on the email address, SKU and date
                    // This is used to look up the purchase later, or refer to it for a refund, etc.
                    // We don't actually use this, but we insert it for future-proofing
                    $data['transaction_id'] = md5( $sku . $_POST['email'] . date('Y-m-d') );
					
					//split first name last
					$lastName = "(Last Name Not Given)";

					if (!empty($_POST['full_name'])) {
						$firstName = $_POST['full_name'];

						//make firstName and lastName pretty
						$displayName = explode(" ", $_POST['full_name'], 2);
						if (!empty($displayName[0])) {
							$firstName = $displayName[0];
						}

						if (!empty($displayName[1])) {
							$lastName = $displayName[1];
						}
					} else {
						$firstName = '(First Name Not Given)';
					}
					
					$data['lastname'] = $lastName;
					$data['firstname'] = $firstName;
					
					$data['email'] = $_POST['email'];
					$data['level'] = $sku;
					
					$delimiteddata = strtoupper(implode('|', $data));
					$hash = md5($data['cmd'] . '__' . $secretKey . '__' . $delimiteddata); 
					$data['hash'] = $hash;
					
//					var_dump($data);
//					die('POSTING TO: '. $postUrl);
					
					$ch = curl_init ($postURL);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$returnValue = curl_exec($ch);
					
					list ($cmd, $url) = explode ("\n", $returnValue); 
					if ($cmd == 'CREATE') {
						echo $url;
						exit;
					}
					else {
						die('error');
					}

					die();
				}
			}
		}
		
		die();
	}
	public static function handleDelete($getData) {
		if ($getData['page']=='ztl-integration' && $getData['action']=='delete' && !empty($getData['id'])) {
			try {
				$ztlPluginSkus = ZTLPluginSkus::find($getData['id']);
				$ztlPluginSkus->delete($getData['id']);
				
				set_transient('ztl-messages', 'The record was deleted', 3600*4);
			}
			catch (ActiveRecord\RecordNotFound $e) {
				
			}
			header('location: ?page=ztl-integration&integration=gumroad');
		}
	}
	public static function save($postData) {	
		if (!empty($postData['Wishlist'])) {
			foreach ($postData['Wishlist'] as $key=>$row) {
				if ($key=='new') {
					ZTLPluginSkus::create(array(
							'wl_level_unique_id'=>$row['levelID'],
							'level_name'=>$row['level'],
							'sku'=>$row['sku']
						));
					
					set_transient('ztl-messages', 'Copy and paste the webhook url to your gumroad product', 3600*4);				
				}
			}
		}
		
		header('location: ?page=ztl-integration&integration=gumroad');
	}
}
