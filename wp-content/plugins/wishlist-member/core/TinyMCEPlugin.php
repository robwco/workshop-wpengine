<?php

/**
 * WishList Member TinyMCE Plugin
 * @author Fel Jun Palawan <feljunpalawan@gmail.com>
 */
if (!class_exists('WLMTinyMCEPluginOnly')) {

	class WLMTinyMCEPluginOnly {

		public $codes = array();

		function __construct() {
			//tinymce additional plugins for shortcode
			add_action('init', array(&$this, 'TMCE_InsertButton'));
		}

		/**
		 * Inserts WishList Member Button on tinymce editor
		 */
		function TMCE_InsertButton() {
			//for users who can edit only
			if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
				return false;
			//for rich editing only
			if (get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', array(&$this, 'TNMCE_RegisterPlugin'));
				add_filter('tiny_mce_before_init', array(&$this, 'TNMCE_RegisterButton'));
			}
		}

		/**
		 * Add the plugin button on tinymce menu
		 *
		 * @param array $in Array of all buttons in tinymce editor
		 */
		function TNMCE_RegisterButton($in) {
			//where would you like to put the new dropdown?
			$advance_button_place = 1; //1,2,3,4
			$key = 'theme_advanced_buttons' . $advance_button_place;
			$holder = explode(",", $in[$key]);
			$holder[] = 'wlmonly_shortcodes'; //add our plugin on the menu
			$in[$key] = implode(",", $holder);
			return $in;
		}

		/**
		 * Register our Tinymce Plugin
		 *
		 * @param array $plugin_array Array of registered tinymce plugins
		 */
		function TNMCE_RegisterPlugin($plugin_array) {
			$pagenow = $GLOBALS['pagenow'];
			$page = isset($_GET['page']) ? $_GET['page'] : "";
			$p = $page != "" ? "?page={$page}&WLMOnlyTNMCEPlugin=1" : "?WLMOnlyTNMCEPlugin=1";
			$url = admin_url() . $pagenow . $p;
			$plugin_array['wlmonly_shortcodes'] = $url;
			return $plugin_array;
		}

		/**
		 * Ganerate JS Code for WishList Member Tinymce Plugin
		 *
		 * @param string $title The title of tinymce plugin
		 * @param string $name The name of tinymce plugin
		 * @param string $icon_path The path of icon
		 * @param int $max_width The width of tinymce plugin
		 */
		function TNMCE_GeneratePlugin($ptitle, $icon_path, $plugin_name, $max_width) {
			$pagenow = $GLOBALS['pagenow'];
			header('Content-type: text/javascript');
			$shortcodes = "";
			foreach ($this->codes as $WLPShortcodes) {
				$code_js = "";
				//if for post only, skip if not in post section
				if (isset($WLPShortcodes['wponly']) && $pagenow != "post.php" && $pagenow != "post-new.php")
					break;

				//for shortcodes
				if (isset($WLPShortcodes['shortcode']) && count($WLPShortcodes['shortcode']) > 0) {
                    $shortcode = $WLPShortcodes['shortcode'][0];
                    $stitle = isset($shortcode['replace_title']) && $shortcode['replace_title'] != '' ? $shortcode['replace_title'] : 'Shortcodes';
					$code_js .= "sub2 = sub.addMenu({title : '{$stitle}' })\n";
					foreach ($WLPShortcodes['shortcode'] as $index => $scode) {
						$title = $scode['title'];
						$value = $scode['value'];
						$short_func = <<<EOT
						sub2.add({title : '{$title}', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '{$value}');
						}});
EOT;
					$code_js .=$short_func;
					}
				}
				//for mergecodes
				if (isset($WLPShortcodes['mergecode']) && count($WLPShortcodes['mergecode']) > 0) {
					$code_js .= "sub2 = sub.addMenu({title : 'Mergecodes'})\n";
					foreach ($WLPShortcodes['mergecode'] as $index => $scode) {
						$title = $scode['title'];
						$value = $scode['value'];
						$scode2 = substr_replace($value, '/', 1, 0);
						$merge_func = <<<EOT
						sub2.add({title : '{$title}', onclick : function() {
							var t = tinyMCE.activeEditor.selection.getContent();
							tinyMCE.activeEditor.selection.setContent('{$value}' +t +'{$scode2}');
							if(t == ''){
								tinyMCE.activeEditor.focus();
							}
						}});
EOT;
						$code_js .=$merge_func;
					}
				}

                //for special codes
                if(isset($WLPShortcodes['special']) && count($WLPShortcodes['special']) >0){
                    foreach($WLPShortcodes['special'] as $index=>$scodes){
                        $code_js .= "sub2 = sub.addMenu({title : '{$index}'})\n";
                        foreach($scodes as $ind=>$scode){
                            if(count($ind) == count($ind, COUNT_RECURSIVE)) {
                                    $code_js .= "sub3 = sub2.addMenu({title : '{$ind}'})\n";
                                foreach($scode as $parent=>$code) {
                                    $title = $code['title']; $value=$code['value'];
                                    $code_js .= "sub3.add({title : '{$title}', onclick : function() {\n";
                                    $code_js .= "  tinyMCE.activeEditor.execCommand('mceInsertContent', false, '{$value}');\n";
                                    $code_js .= "}});\n";
                                }
                            } else {

                                foreach($scode as $parent=>$code) {
                                    $title = $code['title']; $value=$code['value'];
                                    $code_js .= "sub3.add({title : '{$title}', onclick : function() {\n";
                                    $code_js .= "  tinyMCE.activeEditor.execCommand('mceInsertContent', false, '{$value}');\n";
                                    $code_js .= "}});\n";
                                }
                            }
                        }
                    }
                }

                if ($WLPShortcodes['name']) {
                    if ($code_js != "") {
                        $shortcodes .= "sub = m.addMenu({title : '{$WLPShortcodes['name']}'})\n" . $code_js;
                    } else {
                        if ($WLPShortcodes['jsfunction']) {
                            $shortcodes .= "sub = m.add({title : '{$WLPShortcodes['name']}', onclick:{$WLPShortcodes['jsfunction']}})\n";
                        } else {
                            $shortcodes .= "sub = m.add({title : '{$WLPShortcodes['name']}'})\n";
                        }
                    }
                }
            }
			if ($shortcodes == "") return;
			echo <<<EOT
	tinymce.create('tinymce.plugins.{$plugin_name}', {
	        createControl: function(n, cm) {
	                switch (n) {
	                        case '{$plugin_name}':
	                                var c = cm.createMenuButton('{$plugin_name}', {
	                                        title : '{$ptitle}',
	                                        image : '{$icon_path}',
	                                        icons : false
	                                });

	                                c.onRenderMenu.add(function(c, m) {
	                                        var sub;
	                                        m.settings['max_width'] = {$max_width};
	                                        //add our shortcodes
	                                        {$shortcodes}
	                                });

	                                // Return the new menu button instance
	                                return c;
	                }

	                return null;
	        }
	});
	// Register plugin with a short name
	tinymce.PluginManager.add('{$plugin_name}', tinymce.plugins.{$plugin_name});
EOT;
		}

		/**
		 * admin_init hook to ganerate JS Code for WishList Member Tinymce Plugin
		 *
		 */
		function TNMCE_PluginJS() {
			global $WishListMemberInstance;
			//generate WishList Member Tinymce Plugin
			if (isset($_GET['WLMOnlyTNMCEPlugin']) && wlm_arrval($_GET,"WLMOnlyTNMCEPlugin") == "1") {
				$icon_path = $WishListMemberInstance->pluginURL . "/images/WishList-Icon-Blue-16.png";
				$title = "WLM Shortcodes";
				$plugin_name = "wlmonly_shortcodes";
				$max_width = 600;
				$this->TNMCE_GeneratePlugin($title, $icon_path, $plugin_name, $max_width);
				exit(0);
			}
		}

	    /**
	    * Function to be called to register your shortcodes on your plugin
	    *
	    *@param string $name The name of your shortcode that will appear on the menu
	    *@param array $shortcodes (optional) Multi-dimensional array of shortcodes eg. array('title'=>'[wlm_fname]','value'=>'[wlm_fname]')
	    *@param array $mergecodes (optional) Multi-dimensional array of shortcodes eg. array('title'=>'[wlm_ismember]','value'=>'[wlm_ismember]')
	    *@param int $wponly (optional) Specify if your shortcode appear on post only
	    *@param string $jsfunc (optional) Applicable only when $shortcode and $mergecode were empty. The js function to be called when the $name is click
	    */
	    function RegisterShortcodes($name,$shortcodes=array(),$mergecodes=array(),$wponly=0,$jsfunc=null,$specialcodes=array()){
			$code = array();
			$code['name'] = $name;
			if($wponly == 1) $code['wponly'] = 1;
			if(!is_null($jsfunc)) $code['jsfunction'] = $jsfunc;
			if(count($shortcodes) > 0) $code['shortcode'] = $shortcodes;
			if(count($mergecodes) > 0) $code['mergecode'] = $mergecodes;
			if(count($specialcodes) > 0) $code['special'] = $specialcodes;
			$this->codes[] = $code;
	    }

	}

}
?>
