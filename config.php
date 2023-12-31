<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Dubai');

define('apiurl',"http://dev.rivatrip.com");                                 // DOMAIN NAME WITHOUT / SLASH ON END EXAMPLE https://domain.com
if(substr(apiurl, -1) == '/') { $apiurl = substr(apiurl, 0, -1);             // IF URL HAS SLASH IN END THEN CLEAN IT
} else { $apiurl =  apiurl; }                                                // ELSE TAKE API SERVER URL WITHOUT SLASH
define('api_url',$apiurl."/api/");                                           // DEFINE API URL
define('api_key',"phptravels");                                              // YOUR API KEY
define('dev',"1");                                                           // USE 1 FOR DEV AND 0 FOR PRODUCTION
define('gmkey', 'AIzaSyDk_iQ6QWOTHW-TWoXSFLwbcnhaxlcnXXk');                  // GOOGLE MAPS KEY
$currency_key = '';                                                          // CURRENCY API KEY  https://currencylayer.com/signup/free

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => "localhost",
	'username' => "rivatrip_user",
	'password' => "rivatrip_#$#@11",
	'database' => "rivatrip_dev",
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
