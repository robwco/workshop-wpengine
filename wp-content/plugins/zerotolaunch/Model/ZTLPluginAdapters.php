<?php

define('ZTL_INTEGRATIONS_TABLE', ZTL_TABLE_PREFIX . 'adapters');

class ZTLPluginAdapters extends ActiveRecord\Model{
	static $table_name = ZTL_INTEGRATIONS_TABLE;

	public static function getApiKey() {
		

	}
}

