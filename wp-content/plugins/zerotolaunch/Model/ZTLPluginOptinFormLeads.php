<?php

define('ZTL_OPTIN_FORM_LEADS_TABLE', ZTL_TABLE_PREFIX . 'optin_form_leads');

class ZTLPluginOptinFormLeads extends ActiveRecord\Model{
	static $table_name = ZTL_OPTIN_FORM_LEADS_TABLE;
}