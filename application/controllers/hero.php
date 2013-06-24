<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hero extends CI_Controller {
	
	/**
	 * Constructor method
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('string');
	}
	
	/**
	 * Index method
	 * 
	 * Simply redirects to the configuration method.
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		redirect('hero/config');
	}
	
	/**
	 * Configuration method
	 *
	 * @access public
	 * @return void
	 */
	public function config()
	{
		$this->load->library('form_validation');
		
		$validation_rules = array(
			array(
				'field' => 'domain',
				'label' => '"Base Server URL"',
				'rules' => 'trim|required|xss_clean'
			)
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		// Get domain name
		$data['domain'] = ($this->input->post('base_url')) ? $this->input->post('base_url') : rtrim(str_replace(array('install','index'),'',$this->current_url()), '/') . '/';
		
		// Default values
		$data['site_name'] = ($this->input->post('site_name')) ? $this->input->post('site_name') : 'Your Website';
		
		// Build email from $data['domain']
		$email_domain = str_replace(array('http://','www.','/'),'',$data['domain']);
		$data['site_email'] = ($this->input->post('site_email')) ? $this->input->post('site_email') : 'you@' . $email_domain;
		
		// Generate random keys
		$data['cron_key'] = random_string('unique');
		$data['encryption_key'] = random_string('unique');
		
		// User hit the submit button
		if ($this->form_validation->run())
		{
			// Pull the values we want to be placed in our config file
			$replace = array(
				'__BASE_URL__' 			=> $this->input->post('domain'),
				'__ENCRYPTION_KEY__'	=> $this->input->post('encryption_key'),
				'__CRON_KEY__'			=> $this->input->post('cron_key')
			);
			
			// Create our config file passing along the $replace array with our data
			create_config_file($replace);
			
			// The database credentials are still stored within the session.
			// So we're still able to connect to the database to run queries.
			// So lets go ahead and connect to the MySQL server:
			$connection = @mysql_connect($this->session->userdata('hostname'), $this->session->userdata('username'), $this->session->userdata('password'));
		
			// Select the database
			@mysql_select_db($this->session->userdata('database'), $connection);
			
			// Update settings (code pulled straight from original hero install controller)
			mysql_query('UPDATE `settings` SET `setting_value`=\'' . $this->input->post('site_name') . '\' WHERE `setting_name`=\'site_name\' or `setting_name`=\'email_name\'');
			mysql_query('UPDATE `settings` SET `setting_value`=\'' . $this->input->post('site_email') . '\' WHERE `setting_name`=\'site_email\'');
			
			// We're done updating the settings so let's close the connection.
			@mysql_close($connection);		
		}
		
		// Render the view
		$this->template->build('hero/config', $data);
	}
	
	private function current_url()
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on")
		{
			$pageURL .= "s";
		}
		
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		return $pageURL;
	}
}