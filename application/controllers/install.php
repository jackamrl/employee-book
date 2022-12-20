<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		
		}

	//--------------------------------------------------------------------

	public function index()
	{
	
	
		if (INSTALLED)
		{
			redirect('user');
		}
		else
		{
			$this->form_validation->set_rules('hostname', 'Database Hostname', 'required|trim|max_length[255]');			
		$this->form_validation->set_rules('username', 'Database Username', 'required|trim|max_length[255]');	
		$this->form_validation->set_rules('database', 'Database Name', 'required|max_length[255]');
	$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
			if ($this->form_validation->run() !== false)
			{
			
				
				$dbname = strip_tags($this->input->post('database'));
	
				
				$data1 = array(
						'hostname'	=> strip_tags($this->input->post('hostname')),
						'username'	=> strip_tags($this->input->post('username')),
						'password'	=> strip_tags($this->input->post('password')),
						'database'	=> $dbname
					
				);
	
				$this->session->set_userdata('db_data', $data1);
				if ($this->session->userdata('db_data'))
				{
					$db = @mysql_connect(strip_tags($this->input->post('hostname')), strip_tags($this->input->post('username')),strip_tags($this->input->post('password')));
	
					if (!$db)
					{
						$data['error']['mysql_connection'] =  'MySQL connection error! Could not connect to the mysql server with the provided settings.';
					}
					else
					{
					
						$db_selected = mysql_select_db($dbname, $db);

						if (!$db_selected)
						{
							
							if (!mysql_query("CREATE DATABASE $dbname", $db))
							{
								
								$data['error']['mysql_error'] ="Unable to create database.";
							}
							else
							{
							
							$data['error']['import_errors'] = $this->import_sql($db,$dbname);
								if(!$data['error']['import_errors']){
									redirect('install/account');
								}
								
							
							}
							
						}
						else{
							$data['error']['import_errors'] = $this->import_sql($db,$dbname);
								if(!$data['error']['import_errors']){
									redirect('install/account');
								}
						}
	
					}
				}
				else
				{
					$data['error']['error']='Session error.';
				}
				$this->load->view('install/install',$data);
			}
			else{
			
			$this->load->view('install/install');
			}
			//$this->load->view('install/index');
			
		}
		
	}

	//--------------------------------------------------------------------

	public function account()
	{
		$view = 'install/account';

		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('organisation_name', 'Organisation Name', 'required|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('username', 'Adminstration Username', 'required|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('password', 'Administration Password', 'required|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|xss_clean|max_length[255]|matches[password]');			
		$this->form_validation->set_rules('email', 'Administration Email', 'xss_clean|valid_email|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');

			if ($this->form_validation->run() !== false)
			{
				if ($this->update_admin_details())
				{
					$view = 'install/success';
				}
				
			}
		}
	
		$this->load->view($view);
	}

	public function rename_folder() 
	{
		$folder = FCPATH;
	
		if (strpos($folder, 'install') === false)
		{
			$folder .= '/install/';
		}
		
		$new_folder = str_replace('install/', 'install_bak', $folder);
	
		rename($folder, $new_folder);
		
		$url = str_replace('install', '', base_url());
		$url = str_replace('http://', '', $url);
		$url = str_replace('//', '/', $url);
		$url = 'http://'. $url;
		
		redirect($url);
	}
	
	
	private function is_installed() 
	{	
		if (!file_exists('../config/database.php'))
		{
			return false;
		}
		
		require('../config/database.php');
		
		if (!isset($db) || !isset($db['default']))
		{
			return false;
		}

		$this->load->database($db['default']);
		
		if (!$this->db->table_exists('users'))
		{
			return false;
		}
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
		{
			return false;
		}
		
		return true;
	}
	public function import_sql($db='',$dbname='')
	{
	if (!file_exists('./employeebook.sql'))
		{
			return 'SQL file does not exist.';

		}
		else{
		$sql = @file_get_contents('./employeebook.sql');
		}
		if(empty($sql)){
		return 'SQL file is empty.';
		}
		// Split the sql into usable commands on ';'
		$queries = explode(';', $sql);
		$db_selected = mysql_select_db($dbname, $db);
		
		foreach ($queries as $q)
		{
			if (trim($q))
			{
			mysql_query(trim($q), $db);
			}
		}
		return false;
	}
	public function update_admin_details()
	{
	if($this->session->userdata['db_data']['database']){
		$db = @mysql_connect(strip_tags($this->session->userdata['db_data']['hostname']), strip_tags($this->session->userdata['db_data']['username']),strip_tags($this->session->userdata['db_data']['password']));
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$email = $this->input->post('email');
		$db_selected = mysql_select_db($this->session->userdata['db_data']['database'],$db);
		$update = mysql_query("UPDATE `users` SET username = '$username', password = '$password', email = '$email' WHERE id = '1'");
		//for writing database.php and .htaccess
		//var_dump(file_exists('./application/config/database.php'));exit;
		if (!file_exists('./application/config/database.php'))
		{
			return false;
		}
		else{
			$contents = @file_get_contents('./application/config/database.php');
		}
		
		if(empty($contents)){
			return false;
		}
		foreach ($this->session->userdata['db_data'] as $name => $value)
			{
				
				$start = strpos($contents, '$db[\'default\'][\''. $name .'\']');
				$end = strpos($contents, ';', $start);

				$search = substr($contents, $start, $end-$start+1);

				$contents = str_replace($search, '$db[\'default\'][\''. $name .'\'] = \''. $value .'\';', $contents);
			}
		
		$result = write_file('./application/config/database.php', $contents);
		
		//for writing the constants.php
		$contents1 = @file_get_contents('./application/config/constants.php');
		$start = strpos($contents1, 'define(\'INSTALLED\', false);');
		$end = strpos($contents1, ';', $start);
		$search = substr($contents1, $start, $end-$start+1);
		$contents1 = str_replace($search, 'define(\'INSTALLED\', true);', $contents1);
		//for writing organisation name
		$start1 = strpos($contents1, 'define(\'ORGANISATION\', \'EmployeeBook\');');
		$end1 = strpos($contents1, ';', $start1);
		$search1 = substr($contents1, $start1, $end1-$start1+1);
		$organisationName = $this->input->post('organisation_name');
		$contents1 = str_replace($search1, 'define(\'ORGANISATION\', \''.$organisationName.'\');', $contents1);
		
	$result = write_file('./application/config/constants.php', $contents1);
		return $update;
		}
	else{
			return false;
		}	
	}
}