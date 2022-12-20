<?php	
class Manage extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->db = $this->load->database('default', TRUE);
		$this->load->library('pagination');
		$this->load->helper('global');
		$this->load->dbutil();
	}
	/*
	* @function Index function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Main index function
	*  
	*/	
	function index()
	{
		if($this->session->userdata('user_login')==1)
		{
			redirect('usermanager/admin/leavelist');
		}
		else
		{
			$this->load->view('employee_login');
		}
	}
	
	
    /*
	* @function userlist function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Shows user listing
	*  
	*/	
	function userlist()
	{
		isUserLogin();
		$sitesdata['title']="Users";
		$this->load->vars($sitesdata);
		check_access('User Management');
		
		/*---new----*/
		$config['base_url'] =  base_url()."usermanager/manage/userlist";
			$page = $this->uri->segment(4) ? $this->uri->segment(4) :0;
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '';
			$config['first_tag_close'] = '';
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '';
			$config['last_tag_close'] = '';
			$config['next_link'] = 'Next >>';
			$config['next_tag_open'] = '';
			$config['next_tag_close'] = '';
			$config['prev_link'] = '<< Prev';
			$config['prev_tag_open'] = '';
			$config['prev_tag_close'] = '';
			$config['cur_tag_open'] = '<span class="current">';
			$config['cur_tag_close'] = '</span>';
			$config['num_tag_open'] = '';
			$config['num_tag_close'] = '';
			$config['total_rows'] = $this->db->count_all('users', $page,  $this->uri->segment(4));
			$config['per_page'] = '50';
			$config['num_links'] = 4; 
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config); 
		    $result['data'] = $this->user_model->user($config['per_page'], $this->uri->segment(4));
			$result['selected'] = $this->uri->segment(4);
			$result['page_no']=$page;
			$this->load->view('usermanager/user_list',$result);
	}
	/*
	* @function add function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Add new user functionality
	*  
	*/	
	function add()
	{
		isUserLogin();
		$sitesdata['title']="Users";
		$this->load->vars($sitesdata);
		check_access('User Management');
		$result['users'] = GetAllUsers(); 
		$roles = GetRoleListing();
		$result['roles'] = array('0'=>'Select Role');
		if(!empty($roles)){
			foreach($roles as $value){
				$result['roles'][$value['id']] = ucfirst($value['role']);
			}
		}
		if(isset($_POST['submit']))
		{
		   $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
			$this->form_validation->set_rules('name', 'Full Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
			$this->form_validation->set_message('matches','Password not matched');
			$this->form_validation->set_message('valid_email', 'Please Enter Valid E-mail Address');
			$this->form_validation->set_rules('date_of_joining', 'Date of joining', 'required');
			$this->form_validation->set_rules('role_id','Role','required');
			$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
            if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('usermanager/add',$result);
				}
				else
				{
				
					$query = $this->user_model->insert_user();
					$this->db->order_by('id','desc');
					$this->db->limit(1);
					$id_query=$this->db->get('users');
					$res=$id_query->row();
					$user_id=$res->id;
					
					$role_query= $this->user_model->insert_role($user_id);
					if(@$_POST['supervisor'] !=""){	
						$team= $this->user_model->insert_team($user_id);
					}
					if($query){
						$this->session->set_flashdata('error_user', 'User Added Successfully');	
					}else{
						$this->session->set_flashdata('error_user', 'There is an Error.Please Try Again.');	
					}
					redirect('usermanager/manage/userlist'); 
				}
		}
		else{
				$this->load->view('usermanager/add',$result);
		}
	}
	
	function check_username()
	{
	     $username_space=$_POST['username'];
		 $get_username=(explode(" ",$username_space));
		    @$final_username=$get_username[1];
			if(@$final_username!='')
			{ 
			 $this->form_validation->set_message('check_username', 'Username: Spaces are not allowed');
			 return FALSE;
			}
			
		$user_exist_rows=$this->user_model->user_already_exist(); // if user already exists
		if($user_exist_rows!=0 )
		{
			$this->form_validation->set_message('check_username', 'Username: Please choose different username');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	
	}
	
	function email_check()
	{
		$user_exist_rows=$this->user_model->email_already_exist(); // if user already exists
		if($user_exist_rows!=0 )
		{
			$this->form_validation->set_message('email_check', 'E-mail: Please choose different E-mail Address');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	/*
	* @function edit function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Edit user details functionality
	*  
	*/	
	function edit($id)
	{
	    isUserLogin();
		$sitesdata['title']="Users";
		$this->load->vars($sitesdata);
		check_access('User Management');
		$data['user'] = $this->db->get_where('users', array('id' => $id))->row();
		$data['users'] = @GetAllUsers(); 
		$roles = @GetRoleListing();
		$data['roles'] = array('0'=>'Select Role');
		if(!empty($roles)){
			foreach($roles as $value){
				$data['roles'][$value['id']] = ucfirst($value['role']);
			}
		}
		$data['selected_role'] = @GetRole($id);
		$data['supervisor'] = @GetSuperviser($id);
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_space');
			$this->form_validation->set_rules('name', 'Full Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('date_of_joining', 'Date of joining', 'required');
			$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('usermanager/edit',$data);
			}
			else
			{	
					$data = array(
							 'username' => strtolower($this->input->post('username')),
							 'name' =>$this->input->post('name'),
							 'email' =>$this->input->post('email'),
							 'date_of_joining' =>$this->input->post('date_of_joining'),
						);
		      $this->db->where('id', $id);
              $this->db->update('users', $data);
			 $role1_query= $this->user_model->edit_role($id); 
			  $team= $this->user_model->edit_supervisor($id);
			  $this->db->order_by('id','desc');
			  $this->db->limit(1);
			  
			       redirect('usermanager/manage/userlist');
			}
		}
		else
		{
			$this->load->view('usermanager/edit',$data);
		}
	}
	
	function check_space()
	{
	     $username_space=$_POST['username'];
		 $get_username=(explode(" ",$username_space));
		    @$final_username=$get_username[1];
			if(@$final_username!='')
			{ 
			 $this->form_validation->set_message('check_space', 'Username: Spaces are not allowed');
			 return FALSE;
			}
		
			else
			{
				return TRUE;
			}
	}
	
	function delete($id=0)
	{
		isUserLogin();
		check_access('User Management');
		if($id != 1){
		$this->db->where('id',$id);
		$res = $this->db->delete('users');
		$this->session->set_flashdata('error_user', 'User deleted');
		}
		redirect('usermanager/manage/userlist');
	}
	
	function deactivate($id=0)
	{
	isUserLogin();
		check_access('User Management');
		if($id != 1){
		$this->db->where('id',$id);
		$this->db->set('active','0');
		$this->db->update('users');
		$this->session->set_flashdata('error_user', 'User deactivated');
		}
		redirect('usermanager/manage/userlist');
		
	}
	
	function activate($id=0)
	{
	if($id != 1){
	   $this->db->where('id',$id);
	   $this->db->set('active','1');
	   $this->db->update('users');
	   $this->session->set_flashdata('error_user', 'User Activated');
	   }
		redirect('usermanager/manage/userlist');
	}
	
	
}