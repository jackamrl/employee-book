<?php	
class role extends CI_Controller {
 
 	function __construct()
	{
		parent::__construct();
		
		$this->load->model('rolemanager/role_model');
		$this->load->helper('global');
		$this->load->library('Form_validation');
		$this->db = $this->load->database('default', TRUE);
		
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
			redirect('rolemanager/role/role_list');
		}
		else
		{
			redirect('employee_login');
		}
	}
	
	/*
	* @function add function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Add new role functionality
	*  
	*/	
	function add()
	{
		/*-----new code ----*/
		$sitesdata['title']="Add New Role";
		$this->load->vars($sitesdata);
		/*------end----*/
		check_access('Roles Management');
		if(isset($_POST['submit']))
	   {
	   
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('rolemanager/role_login');
		}
		else
		{
		
					
					$this->db->select('id');
					$this->db->where('role',$_POST['role']);
					$role_id_qry=$this->db->get('role_table');
					$role_id_qry_result=$role_id_qry->num_rows();
					//end query
					if($role_id_qry_result==0)
					{
						$this->db->set('role',$this->input->post('role'));
						$this->db->set('description',$this->input->post('description'));
						$this->db->insert('role_table');
						redirect('rolemanager/role/choose_access');
					}	
					else
					{
						$msg['role_msg']='The role you entered already exist. Please choose another';
						$this->load->view('rolemanager/role_login',$msg);
					}

	
	   }
	   }
	   else
	   {
	   	$this->load->view('rolemanager/role_login');
	   }
	}
	function editRole($id=0)
	{
		/*-----new code ----*/
		$sitesdata['title']="Edit Role";
		$this->load->vars($sitesdata);
		/*------end----*/
		check_access('Roles Management');
		$data = array();
		$data['id'] = $id; 
		$data['roleValue'] = @$this->db->get_where('role_table',array('id'=>$id))->row(); 
		if(isset($_POST['submit']))
	   {
	   
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('rolemanager/role_edit',$data);
		}
		else
		{
		
					if($id != 1){
					$this->db->where('id',$id);
					$this->db->set('role',$this->input->post('role'));
					$this->db->set('description',$this->input->post('description'));
					$this->db->update('role_table');
					$this->session->set_flashdata('msg', 'Role edited successfully');
					}
					redirect('rolemanager/role/role_list');

	
	   }
	   }
	   else
	   {
	   	$this->load->view('rolemanager/role_edit',$data);
	   }
	}
	
	/*
	* @function choose_access function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Set module wise permissions
	*  
	*/
	function choose_access()
	{
	    check_access('Roles Management');
		$head_content['title']='Choose Access';
		$this->load->vars($head_content);
		$modules_name['all_modules']=$this->role_model->get_modules();
		$this->load->view('rolemanager/choose_access',$modules_name);
	}
	/*
	* @function access_action function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Process module wise permissions
	*  
	*/
	function access_action()
	{
		check_access('Roles Management');
		$last_role=$this->role_model->last_role_id();
		$role_name=$last_role->row();
		$role=$role_name->id;
		
		$modules_query=$this->role_model->get_modules();
		$no_of_modules=$modules_query->num_rows();
			for($i=0;$i<$no_of_modules;$i++){
				$val=@$_POST['check_'.$i];
				
				if($val ==''){
					$val='n';
				}
				
				$this->db->set('check',$val);
				$this->db->set('role_id',$role);
				$this->db->set('module_id',$_POST['id_'.$i]);
				$this->db->insert('role_access');
				
		}
		
		
			redirect('rolemanager/role/view_access');

    }
	/*
	* @function view_access function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use View module wise permissions
	*  
	*/
		function view_access()
	{
		/*-----new code ----*/
		$sitesdata['title']="View Module Permissions";
		
		$this->load->vars($sitesdata);
		/*------end----*/
		
		check_access('Roles Management');
		$role['module_access_rights']=$this->role_model->module_access(); 
		
		$this->load->view('rolemanager/view_access',$role);
	}
	/*
	* @function view_access function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use View module wise permissions
	*  
	*/
	function view_module_access_detail($id)
	{
		/*-----new code ----*/
		$sitesdata['title']="View Module Access";
		$this->load->vars($sitesdata);
		/*------end----*/
		check_access('Roles Management');
		$role['module_access_rights']=$this->role_model->module_particular_access($id); 
		$this->load->view('rolemanager/view_access',$role);
	}	

	/*
	* @function role_list function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use View role listing
	*  
	*/
	function role_list()
	{
		/*-----new code ----*/
		$sitesdata['title']="Role List";
		/*------end----*/
	check_access('Roles Management');
		$this->load->vars($sitesdata);
		$role_list['listing_of_roles']=$this->role_model->role_list();
		$this->load->view('rolemanager/role_list',$role_list);
	}
	/*
	* @function edit function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Edit role permissions
	*  
	*/
   function edit($id)
   { 
   		/*-----new code ----*/
		$sitesdata['title']="Edit Role";
		$this->load->vars($sitesdata);
		check_access('Roles Management');
		if(isset($_POST['number']))
		{
			for($i=0;$i<$_POST['number'];$i++){
				$val=@$_POST['check_'.$i];
				if($val ==''){
					$val='n';
				}else{
					$val='y';
				}
			  $this->db->where('role_id',$id);
			  $this->db->where('module_id',$_POST['id_'.$i]);
			  $this->db->set('check',$val);
			  $this->db->update('role_access');
			}
			redirect('rolemanager/role/view_module_access_detail/'.$id);
			
		}
		else
		{
			$role_list['edit_role_query']=$this->role_model->module_access_edit($id);
			$this->load->view('rolemanager/edit_role',$role_list);
		}
		
   }
   function delete($id=0)
	{
		isUserLogin();
		check_access('Roles Management');
		if($id != 1){
		$this->db->where('id',$id);
		$res = $this->db->delete('users');
		$this->session->set_flashdata('error_user', 'User deleted');
		}
		redirect('usermanager/manage/userlist');
	}

}
?>