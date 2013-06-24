<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Application Name
|--------------------------------------------------------------------------
|
| Name of the application to be installed.
|
*/
$config['application_name'] = 'Test Application';

/*
|--------------------------------------------------------------------------
| Application Version
|--------------------------------------------------------------------------
|
| Version of the application to be installed.
|
*/
$config['application_version'] = '1.0';

/*
|--------------------------------------------------------------------------
| Application Folder
|--------------------------------------------------------------------------
|
| Location of the application folder (with trailing slash).
|
*/
$config['application_folder'] = 'app/';

/*
|--------------------------------------------------------------------------
| SQL File
|--------------------------------------------------------------------------
|
| Filename of the applications SQL file (to be installed to the server)
|
*/
$config['sql_file'] = 'hero_initial';

/*
|--------------------------------------------------------------------------
| Application Homepage
|--------------------------------------------------------------------------
|
| Application homepage (website).
|
*/
$config['application_url'] = 'http://www.google.com';

/*
|--------------------------------------------------------------------------
| Minimum PHP Version
|--------------------------------------------------------------------------
|
| The minimum PHP installation needed to run the application
|
*/
$config['min_php_version'] = '5.1';

/*
|--------------------------------------------------------------------------
| Minimum MySQL Version
|--------------------------------------------------------------------------
|
| The minimum MySQL installation needed to run the application
|
*/
$config['min_mysql_version'] = '3.23';

/*
|--------------------------------------------------------------------------
| Required Server Extensions
|--------------------------------------------------------------------------
|
| Extensions required by your application to function properly
|
*/
$config['required_extensions'] = array('SimpleXML', 'curl', 'mbstring', 'json');

/*
|--------------------------------------------------------------------------
| Optional Server Extensions
|--------------------------------------------------------------------------
|
| Optional extensions that can be used by your extension if present on the server
|
*/
$config['optional_extensions'] = array('gd');

/*
|--------------------------------------------------------------------------
| Required PHP Settings To Be Enabled
|--------------------------------------------------------------------------
|
| php.ini settings required to be enabled on the server
|
*/
$config['enabled_php_ini'] = array('allow_url_fopen', 'short_open_tag');

/*
|--------------------------------------------------------------------------
| Required PHP Settings To Be Disabled
|--------------------------------------------------------------------------
|
| php.ini settings required to be disabled on the server
|
*/
$config['disabled_php_ini'] = array('safe_mode');

/*
|--------------------------------------------------------------------------
| Required Writable Directories
|--------------------------------------------------------------------------
|
| Directories that need to have write access by the server
|
*/
$config['writable_directories'] = array();
	
/*
|--------------------------------------------------------------------------
| Required Writable Files
|--------------------------------------------------------------------------
|
| Files that need to have write access by the server
|
*/
$config['writable_files'] = array();

/* End of file application.php */