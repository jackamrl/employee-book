<?php
class User extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->db = $this->load->database('default', TRUE); 
		$this->load->helper('global');
		if(!INSTALLED){
		redirect('install');
		}
	}
	
	/*
	 * Index function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			Dashboard
	 *
	 */
	
	function index()
	{
		if($this->session->userdata('user_login')==1)
		{
			redirect('user/dashboard');
		}
		else
		{
			$this->load->view('employee_login');
		}
	}
	
	/*
	 * login function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			To verify the login details and redirect accordingly to pages
	 *
	 */
	function login()
	{
		if(isset($_POST['username']))
		{
		   $this->form_validation->set_rules('username', 'Username', 'required');
		   $this->form_validation->set_rules('password', 'Password', 'required');
		   if ($this->form_validation->run() == FALSE)
		   {
			   $this->load->view('employee_login');
		   }
		   else
		   {
		     $GetUserDetails = $this->user_model->GetDetails();
		     $UserDetails = $GetUserDetails->row();
		     if(@$UserDetails->username == $_POST['username'] && @$UserDetails->password == md5($_POST['password']))
			 {
				if($UserDetails->active == 1){
					   	$this->session->set_userdata('user_login',true);
						$id = $UserDetails->id;
						$username = $UserDetails->username;
						$emailid = $UserDetails->email;
					  	
					$get_role = $this->db->query("select role,role_table.id from emp_role join role_table on emp_role.role_id = role_table.id where emp_role.emp_id = '$id'");
					if($get_role->num_rows() > 0)
							{
						$role1 = $get_role->row();
						$role = $role1->role;
						$roleID = $role1->id;
						$this->session->set_userdata(array('user'=> $username,'id'=> $id,'mail_add'=> $emailid,'role' => $role )); 
						$role = $this->db->query("SELECT DISTINCT role_access.module_id,modules.module_name FROM `role_access` JOIN modules ON modules.id = role_access.module_id WHERE role_access.check = 'y' AND role_access.role_id = '$roleID'");
						if($role->num_rows() > 0)
							{
								 foreach ($role->result() as $row)
								{
									
									$this->session->set_userdata($row->module_name,true);
								}
							}
						
	                   }
					    redirect('user');
						}
						else{
						$this->session->set_flashdata('error', 'Your Account has been deactivated.');	
						redirect('user');
						}
			 }
			 else
			 {
					   $this->session->set_flashdata('error', 'Use a valid username and password');					   
					   redirect('user');
			 }
		   }
		}
		else
		{
			redirect('user');
		}
	}
	
	/*
	 * logout function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			User Log-out
	 *
	 */
	function logout()
	{
		$this->session->sess_destroy();
        redirect('user');
	}
	
	/*
	 * dashboard function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			Redirect the user to his dashboard after successful login
	 *
	 */
	function dashboard()
	{
		if($this->session->userdata('user_login')==1)
		{
			$data['title'] = "Dashboard";
			$data['userdetails'] = GetUserDetail($this->session->userdata('id'));
			$data['updates'] = @GetUpdates();
			$this->load->view('dashboard',$data);
		}
		else
		{
			redirect('user');
		}
	}
	/*
	 * dashboard function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			Redirect the user to his dashboard after successful login
	 *
	 */
	function myprofile()
	{
		if($this->session->userdata('user_login')==1)
		{
			$data['title'] = "My Profile ";
			$data['userdetails'] = GetUserDetail($this->session->userdata('id'));
			$this->load->view('myprofile',$data);
		}
		else
		{
			redirect('user');
		}
	}
	
	/*
	 * Change function 
	 * @author   Pawan Jangid
	 * @version		1.0
	 * @copyright	Pawan Jangid
	 * @since		version1.0
	 * @use			Password Management
	 *
	 */
	function change()
	{
	   isUserLogin();	
		$sitesdata['title']=" Password Control";
		$this->load->vars($sitesdata);
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('currentpass', 'Currentpass', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('change_view');
			}
			else
			{
				$sql = $this->user_model->update_entry();
				if($sql){
					$this->session->set_flashdata('msg','Password sucessfully changed.');
					redirect('user');
				}else{
					$this->session->set_flashdata('msg','You filled an incorrect password. Please try again.');
					redirect('user/change');
				}
			}
		}
		else
			$this->load->view('change_view');
	}
	function access()
	{
		$this->load->view('access');
	}
}	