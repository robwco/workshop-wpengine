<?php

define('ZTL_SKU_TABLE', ZTL_TABLE_PREFIX . 'skus');

class ZTLPluginSkus extends ActiveRecord\Model{
	static $table_name = ZTL_SKU_TABLE;
}