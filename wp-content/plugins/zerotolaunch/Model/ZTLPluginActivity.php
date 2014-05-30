<?php

define('ZTL_ACTIVITY_TABLE', ZTL_TABLE_PREFIX . 'activity');

class ZTLPluginActivity extends ActiveRecord\Model{
	static $table_name = ZTL_ACTIVITY_TABLE;
}