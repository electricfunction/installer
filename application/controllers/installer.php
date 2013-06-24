<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installer extends CI_Controller {
	
	/**
	 * Constructor method
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Index method - also our starting welcome page
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// Render the view
		$this->template->build('welcome');
	}
	
	/**
	 * Step 1 method
	 * 
	 * Step 1 of the installation process consists of checking the web server, 
	 * PHP version, and writable folder/file access.
	 *
	 * @access public
	 * @return void
	 */
	public function step_1()
	{
		$data['server_check_number']		= 0;
		
		// Initialize our server test variables
		$data['server_test_fail']			= FALSE;
		$data['server_test_pass']			= FALSE;
		
		// Define our variables here so we don't get errors down the road
		// if they're not utilized
		$data['required_extension_pass']	= NULL;
		$data['optional_extension_pass']	= NULL;
		$data['enabled_php_ini']			= NULL;
		$data['disabled_php_ini']			= NULL;
		$data['writable_directories']		= NULL;
		$data['writable_files']				= NULL;
				
		// Lets perform our tests and store them
		$data['php_pass'] 	= is_php($this->config->item('min_php_version'));
		$data['mysql_pass'] = is_mysql($this->config->item('min_mysql_version'));
		
		// Check if both the PHP and MySQL checks pass - if not, set our server test fail variable to TRUE
		if(!$data['php_pass'] || !$data['mysql_pass'])
		{
			$data['server_test_fail'] = TRUE;
		}
		
		// Let's check the server for our required extensions - if they're defined in our config file
		if($this->config->item('required_extensions'))
		{
			foreach($this->config->item('required_extensions') as $extension)
			{
				$data['required_extension_pass'][] = array(
					'name' => $extension,
					'result' => server_has_extension($extension)
				);
				
				if(!server_has_extension($extension))
				{
					$data['server_test_fail'] = TRUE;
				}
			}
		}
		
		// We'll do the same thing for our optional extensions - if they're defined in our config file
		if($this->config->item('optional_extensions'))
		{
			foreach($this->config->item('optional_extensions') as $extension)
			{
				$data['optional_extension_pass'][] = array(
					'name' => $extension,
					'result' => server_has_extension($extension)
				);
			}
		}
		
		// PHP Settings check (enabled)
		if($this->config->item('enabled_php_ini'))
		{
			foreach($this->config->item('enabled_php_ini') as $setting)
			{
				$data['enabled_php_ini'][] = array(
					'name' => $setting,
					'result' => php_setting_check($setting)
				);
			}
		}
		
		// PHP Settings check (disabled)
		if($this->config->item('disabled_php_ini'))
		{
			foreach($this->config->item('disabled_php_ini') as $setting)
			{
				$data['disabled_php_ini'][] = array(
					'name' => $setting,
					'result' => php_setting_check($setting)
				);
			}
		}
		
		// Writable directories check
		if($this->config->item('writable_directories'))
		{
			foreach($this->config->item('writable_directories') as $directory)
			{
				// Lets attempt to change the permissions on our own.
				// Save the user a trip to their FTP client!
				@chmod('../'.$directory, 0777);
				
				// Now let's check if the directory is really writable
				$data['writable_directories'][] = array(
					'name' => $directory,
					'writable' => is_really_writable('../'.$directory)
				);
			}
		}
		
		// Writable files check
		if($this->config->item('writable_files'))
		{
			foreach($this->config->item('writable_files') as $file)
			{
				// Lets attempt to change the permissions on our own.
				// Save the user a trip to their FTP client!
				@chmod('../'.$file, 0666);
				
				// Now let's check if the directory is really writable
				$data['writable_files'][] = array(
					'name' => $file,
					'writable' => is_really_writable('../'.$file)
				);
			}
		}
		
		/**
		 * Did all the tests pass? Great! Let's move on to step 2. 
		 * If not )= boo. No worries though, we'll show the user 
		 * some information to help them get things straigtened out =)
		*/
		if(!$data['server_test_fail'])
		{
			$data['server_test_pass'] = TRUE;
		}
		
		// Render the view
		$this->template->build('step_1', $data);
	}
	
	/**
	 * Step 2 method
	 * 
	 * Step 2 of the installation process consists of obtaining the MySQL information
	 * from the user, and testing the connection.
	 *
	 * @access public
	 * @return void
	 */
	public function step_2()
	{
		$this->load->library('form_validation');
		
		$validation_rules = array(
			array(
				'field' => 'hostname',
				'label' => '"Hostname"',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'username',
				'label' => '"Username"',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => '"Password"',
				'rules' => 'trim'
			),
			array(
				'field' => 'database',
				'label' => '"Database"',
				'rules' => 'trim|required|xss_clean'
			),
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		// Load our form
		$data['form']		= 'forms/database';
		
		if ($this->form_validation->run())
		{
			// Save our variables in an array for this session's use
			$config = array(
				'hostname'	=> $this->input->post('hostname'),
				'username'	=> $this->input->post('username'),
				'password'	=> $this->input->post('password'),
				'database'	=> $this->input->post('database')
			);
			
			/**
			 * We'll go ahead and save the connection information to the
			 * session for later use
			 */
			$this->session->set_userdata($config);
			
			redirect('check-mysql-connection');
		}
		
		// Render the view
		$this->template->build('step_2', $data);
	}
	
	/**
	 * Check MySQL Connection
	 * 
	 * check_mysql_connection() verifies that we can connect to the users database
	 * using the credentials they supplied to us.
	 *
	 * @access public
	 * @return void
	 */
	public function check_mysql_connection()
	{
		$data['db_connected']	= FALSE;
		
		// Attempt to connect to the database
		if(!$connection = @mysql_connect($this->session->userdata('hostname'), $this->session->userdata('username'), $this->session->userdata('password')))
		{	
			@mysql_close($connection);
		}
		else
		{
			if (@mysql_select_db($this->session->userdata('database'), $connection))
			{
				$data['db_connected']		= TRUE;
				
				// Close the connection
				@mysql_close($connection);
				
				// Create our database config file
				create_database_file($this->session->userdata('hostname'), $this->session->userdata('username'), $this->session->userdata('password'), $this->session->userdata('database'));
			}
		}
		
		// Render the view
		$this->template->build('check_mysql_connection', $data);
	}
	
	/**
	 * Step 3 method
	 * 
	 * Step 3 of the installation process consists of installing the database.
	 *
	 * @access public
	 * @return void
	 */
	public function step_3()
	{
		$data['sql_installed'] = FALSE;
		
		if(install_sql())
		{
			$data['sql_installed'] = TRUE;
		}
		
		// Render the view
		$this->template->build('step_3', $data);
	}
}