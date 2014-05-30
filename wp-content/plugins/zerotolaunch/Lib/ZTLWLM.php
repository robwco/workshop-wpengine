<?php

class ZTLWLM {
	public static function setWLMLicenseKeyIfMissing($userEmail, $licenseKey) {
		if (!empty($licenseKey)) {
			global $wpdb;
			//is wlm installed?
			$wlmOptionsTblName = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."wlm_options'");

			if (!empty($wlmOptionsTblName)) {
				//save email and wlm key if exists
				$output = $wpdb->get_var("SELECT option_value FROM ".$wpdb->prefix."wlm_options
												WHERE option_name = 'LicenseKey'");
				if (empty($output)) {
					$wpdb->query("INSERT INTO ".$wpdb->prefix."wlm_options (
										ID, option_name, option_value, autoload
									)
									VALUES (
										NULL, 'LicenseKey', '".$licenseKey."', 'yes');");
				}

				$output = $wpdb->get_var("SELECT option_value FROM ".$wpdb->prefix."wlm_options
												WHERE option_name = 'LicenseEmail'");
				if (empty($output)) {
					$wpdb->query("INSERT INTO ".$wpdb->prefix."wlm_options (
											ID, option_name, option_value, autoload
										)
										VALUES (
											NULL, 'LicenseEmail', '".$userEmail."', 'yes');");
				}

				$output = $wpdb->get_var("SELECT option_value FROM ".$wpdb->prefix."wlm_options
												WHERE option_name = 'LicenseStatus'");
				if (empty($output)) {
					$wpdb->query("INSERT INTO ".$wpdb->prefix."wlm_options (
											ID, option_name, option_value, autoload
										)
										VALUES (
											NULL, 'LicenseStatus', '1', 'yes');");
				}

				$wpdb->query("UPDATE ".$wpdb->prefix."wlm_options SET option_value = ".time()." WHERE option_name = 'LicenseLastCheck'");
			}
		}
	}
}