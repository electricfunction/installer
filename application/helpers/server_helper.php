<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Installer
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter Installer
 * @author		Shea Lewis (Kai) - Electric Function
 * @link		http://electricfunction.com
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Installer Server Helpers
 *
 * @package		CodeIgniter Installer
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Shea Lewis (Kai) - Electric Function
 */

// ------------------------------------------------------------------------

/**
 * MySQL version check
 *
 * Checks installed MySQL installation present on the server against
 * the supplied version variable. Returns TRUE when the check returns
 * equals or greater than. Returns FALSE when the MySQL installation
 * present on the server is below the supplied version variable.
 *
 * @access	public
 * @param	string		Minimum MySQL version to check against
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('is_mysql'))
{
	function is_mysql($min_version = '1.0.0')
	{
		// Let's start our output buffering call.
		ob_start();
		
		// Tell the server to spit out information on the server.
		phpinfo(INFO_MODULES);
		
		// Save the information from our output buffer to an array for later use.
		$info = ob_get_contents();
		
		// That's all the information we needed! Let's clean up the output buffer and end it.
		ob_end_clean(); 
		
		// Let's look for the MySQL information from the info pulled from the output buffer.
		$info = stristr($info, 'Client API version'); 
		preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
		
		// Save it to an array
		$mysql_version = $match[0]; 
		
		// Now, we'll check the installed MySQL version against the application's minimum requirement.
		// Applications minimum MySQL version is defined in the application.php config file.
		if(intval($mysql_version) >= intval($min_version)):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

/**
 * MySQL version
 *
 * Returns the installed MySQL version number
 *
 * @access	public
 * @return	string		Installed MySQL version number
 */
if ( ! function_exists('mysql_version'))
{
	function mysql_version()
	{
		// Let's start our output buffering call.
		ob_start();
		
		// Tell the server to spit out information on the server.
		phpinfo(INFO_MODULES);
		
		// Save the information from our output buffer to an array for later use.
		$info = ob_get_contents();
		
		// That's all the information we needed! Let's clean up the output buffer and end it.
		ob_end_clean(); 
		
		// Let's look for the MySQL information from the info pulled from the output buffer.
		$info = stristr($info, 'Client API version'); 
		preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
		
		// Return the MySQL version
		return $match[0];		
	}
}

/**
 * Server extension check
 *
 * Checks the server to see if it has the supplied extension installed
 *
 * @access	public
 * @param	string		Extension to search for
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('server_has_extension'))
{
	function server_has_extension($extension = '')
	{
		if(in_array ($extension, get_loaded_extensions())):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

/**
 * PHP setting check
 *
 * Checks the server to see if it has the supplied extension installed
 *
 * @access	public
 * @param	string		PHP setting to check
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('php_setting_check'))
{
	function php_setting_check($setting = '')
	{
		if(ini_get($setting)):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}