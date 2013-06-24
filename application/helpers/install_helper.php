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
 * CodeIgniter Installer Helpers
 *
 * @package		CodeIgniter Installer
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Shea Lewis (Kai) - Electric Function
 */

// ------------------------------------------------------------------------

/**
 * Create database file
 *
 * Copies our template database config file from the installer assets folder,
 * replacing the basic data with information from the user.
 *
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('create_database_file'))
{
	function create_database_file($hostname = '', $username = '', $password = '', $database = '')
	{
		$CI =& get_instance();
		
		// Retrieve our template database file
		$template	= file_get_contents('./assets/config/database_template.php');
		
		// Create our replace array
		$replace 	= array(
			'__HOSTNAME__'		=> $hostname,
			'__USERNAME__'		=> $username,
			'__PASSWORD__'		=> $password,
			'__DATABASE__'		=> $database
		);
		
		// Follow through and replace our filler text with the data from the user.
		$replace_text	= str_replace(array_keys($replace), $replace, $template);
		
		// Open our application's database file so we can write to it
		$database_file	= @fopen('../'.$CI->config->item('application_folder').'config/database.php', 'w+');
		
		if($database_file)
		{
			@fwrite($database_file, $replace_text);
			return TRUE;
		}
		
		// If it failed, return so
		return FALSE;
	}
}

/**
 * Install SQL
 *
 * Queries and installs the supplied SQL file to the users database.
 *
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('install_sql'))
{
	function install_sql()
	{
		$CI =& get_instance();
		
		// Connect to the server
		$connection = @mysql_connect($CI->session->userdata('hostname'), $CI->session->userdata('username'), $CI->session->userdata('password'));
		
		// Select the database
		@mysql_select_db($CI->session->userdata('database'), $connection);
		
		// Let's retrieve our SQL file and store it in our $sql variable
		$sql 		= file_get_contents(APPPATH.'sql/'.$CI->config->item('sql_file').'.sql');
		
		// We'll split our SQL file line by line
		$structure	= explode("\n", $sql);
		
		// Initialize our query variables
		$query = "";
		$querycount = 0;
				
		foreach($structure as $sql_line):
			if (trim($sql_line) != "" and substr($sql_line,0,2) != "--")
					{
						$query .= $sql_line;
						if (substr(trim($query), -1, 1) == ";")
						{
							// this query is finished, execute it
						    if (@mysql_query($query, $connection))
						    {
						    	$query = "";
						    	$querycount++;
						    }
						    else {
						    	show_error('There was a critical error importing the initial database structure.  Please contact support.<br /><br />Query:<br /><br />' . $query);
						    	die();
						    }
						}
					}
		endforeach;
		
		// If there were no errors before, success!
		return TRUE;
	}

/**
 * Create config file
 *
 * Copies our template config file from the installer assets folder,
 * replacing the basic data with information from the user.
 *
 * @param	array 		$replace		array containing the fields to replace in the config file
 * @return	boolean		TRUE or FALSE
 */
if ( ! function_exists('create_config_file'))
{
	function create_config_file($replace = NULL)
	{
		$CI =& get_instance();
		
		if($replace):	
			// Retrieve our template database file
			$template	= file_get_contents('./assets/config/config_template.php');
			
			// Follow through and replace our filler text with the data from the user.
			$replace_text	= str_replace(array_keys($replace), $replace, $template);
			
			// Open our application's database file so we can write to it
			$config_file	= @fopen('../'.$CI->config->item('application_folder').'config/config.php', 'w+');
			
			if($config_file)
			{
				@fwrite($config_file, $replace_text);
				return TRUE;
			}
			
			// If it failed, return so
			return FALSE;
		endif;
	}
}
}