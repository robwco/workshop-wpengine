<?php
# Database Configuration
define('DB_NAME','workshop-wpengine');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_HOST','localhost');
# define('DB_NAME','wp_robertwilliams');
# define('DB_USER','robertwilliams');
# define('DB_PASSWORD','3yV9gHBtp2Tmk7cz');
# define('DB_HOST','69.164.212.169');
define('DB_HOST_SLAVE','127.0.0.1');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY', 'K3^O$g`vn~)_J|&Z;-lfHZ]<7#@KzADGVb-H;O@063cD-,U, g&fKJ&#S:$,zv#x');
define('SECURE_AUTH_KEY', 'e2pV,*}UGe0R>#?-dkV=5>R}/!/+]5)RGX:X?.%&6|56_MbqzyfI3=H`E CfZ21]');
define('LOGGED_IN_KEY', 'ju{q)9aRL72}mtgG8x-&!cT+^X5]R%Gnu:u4L nplK7DFD~jaqmw7+r*yh$X<d;T');
define('NONCE_KEY', '|M@c?A24}S+:!|s=FT#);qPq(PWtkx-MD1<B<aylm+GCat<r%BfK~lcDG<>iJ#9C');
define('AUTH_SALT',        ']t8vVJFm*(KgOD oc6>?kA)%PN?m9^Q1lAKCv-Z-2[-:%C6zI8g~-Q|9-x=zR|0;');
define('SECURE_AUTH_SALT', 'h%BWa# [k~ZyreY)Xvu>-q4?RXm8Cc_S3@6LZ;DnO/eVB)_[;qPCgT+Y+4~ISQe#');
define('LOGGED_IN_SALT',   '2|D`%{ iKuKx Y$6GO`(HI;|H4>;s6y`4fEz~/uP%&>D2+Z]rFyfU&3tA*!3i#Kw');
define('NONCE_SALT',       'P`}gR--c!lgFtc|)!j?p3*jS;!q<Ab%sfj/N.!ViyX2E,x^([%nGm!B 9om3#kBA');


# Localized Language Stuff

define('WP_CACHE',TRUE);

define('PWP_NAME','robertwilliams');

define('FS_METHOD','direct');

define('FS_CHMOD_DIR',0775);

define('FS_CHMOD_FILE',0664);

define('PWP_ROOT_DIR','/nas/wp');

define('WPE_APIKEY','3dd9804024ad86199a458a8e1576a210eb2134bd');

define('WPE_FOOTER_HTML',"");

define('WPE_CLUSTER_ID','1548');

define('WPE_CLUSTER_TYPE','pod');

define('WPE_ISP',true);

define('WPE_BPOD',false);

define('WPE_RO_FILESYSTEM',false);

define('WPE_LARGEFS_BUCKET','largefs.wpengine');

define('WPE_CDN_DISABLE_ALLOWED',false);

define('DISALLOW_FILE_EDIT',FALSE);

define('DISALLOW_FILE_MODS',FALSE);

define('DISABLE_WP_CRON',false);

define('WPE_FORCE_SSL_LOGIN',false);

define('FORCE_SSL_LOGIN',false);

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define('WPE_EXTERNAL_URL',false);

define('WP_POST_REVISIONS',FALSE);

define('WP_TURN_OFF_ADMIN_BAR',false);

define('WPE_BETA_TESTER',false);

umask(0002);

$wpe_cdn_uris=array ();

$wpe_no_cdn_uris=array ();

$wpe_content_regexs=array ();

$wpe_all_domains=array (  0 => 'letsworkshop.com',  1 => 'robertwilliamsdesign.com',  2 => 'robertwilliams.wpengine.com',  3 => 'robw.co',  4 => 'www.robertwilliamsdesign.com',  5 => 'www.robw.co',);

$wpe_varnish_servers=array (  0 => 'pod-1548',);

$wpe_ec_servers=array ();

$wpe_largefs=array ();

$wpe_netdna_domains=array ();

$wpe_netdna_push_domains=array ();

$wpe_domain_mappings=array ();

$memcached_servers=array ();

define('WPE_WHITELABEL','wpengine');

define('WP_AUTO_UPDATE_CORE',false);

$wpe_special_ips=array ();

$wpe_netdna_domains_secure=array ();

define('WPE_CACHE_TYPE','standard');
define('WPLANG','');

# WP Engine ID


define('PWP_DOMAIN_CONFIG', 'www.robertwilliamsdesign.com' );

# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
