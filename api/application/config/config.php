<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$root=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
$root.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$config['base_url'] = $root;
$config['index_page'] = '';
$config['uri_protocol']	= 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']	= 'en';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = TRUE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = TRUE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.,:_+\-\'';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
// $config['log_threshold'] = [1,2];
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = '73L1DmftGB1OOCYOTb3KPPhAJJz8J5jiH';
$config['sess_driver'] = 'files';
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 10000000000;
$config['sess_save_path'] =  BASEPATH . 'cache/';
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'pt_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 86400;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['is_offline'] = TRUE;
$config['is_demo'] = FALSE;
$config['ban_ip'] = TRUE;
ini_set("memory_limit","1000M");
