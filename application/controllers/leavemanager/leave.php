<?php
class leave extends CI_Controller {
 	function __construct()
	{
		parent::__construct();
		$this->load->model('leavemanager/leave_login');
		$this->load->library('pagination');	
		$this->load->library('encrypt');
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('global');
		$this->load->helper('leavemanager');
		$this->load->helper('download');
		$this->db = $this->load->database('default', TRUE);
	}
	
	/*
	* @function Index function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Index function
	*  
	*/

	function index()
	{
		
		
		if($this->session->userdata('user_login')==1)
		{
			redirect('leavemanager/leave/applyleave');
		}
		else
		{
			$this->load->view('employee_login');
		}
	}
	/*
	* @function Home function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Shows the dashboard
	*  
	*/
	function home()
	{
		isUserLogin();
		$sitesdata['title']="Home";
		$this->load->vars($sitesdata);
		$this->load->view('leavemanager/dashboard');
	}
	
	
	
	/*
	* @function applyleave function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use leave application
	*  
	*/
	function applyleave()
	{
		isUserLogin();
		
		$sitesdata['title']="Apply For Leave";
		$this->load->vars($sitesdata);
		check_access('Apply Leave');
		
		if(isset($_POST['reason']))
	    {
				$this->form_validation->set_rules('leave_type', 'Leave type', 'is_natural_no_zero');
				$this->form_validation->set_rules('date_from', 'Date from', 'required');
			    $this->form_validation->set_rules('date_to', 'Date to', 'required');
			   $this->form_validation->set_rules('number_of_days', 'number of days', 'required');
			    $this->form_validation->set_rules('reason', 'reason', 'required');
			    $this->form_validation->set_message('is_natural_no_zero', 'Leave type must be selected');
		   
			$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
			if ($this->form_validation->run() == FALSE)
			{
					$this->load->view('leavemanager/dashboard');
			}
			else
			{
				$result = $this->leave_login->insert_entry();
				if($result){
				
				}
				redirect('leavemanager/leave/leavelist');
			}
		}
		else
		{
			$this->load->view('leavemanager/dashboard');
		}		
	}
	/*
	* @function leavelist function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Shows the leave listing of the loggedin employee
	*  
	*/
	function leavelist()
	{
		isUserLogin();
		$sitesdata['title']="Your Leavelist";
		$this->load->vars($sitesdata);
		check_access('View Leave'); 
	 	$result['data'] = $this->leave_login->get_leave_info();
		$this->load->view('leavemanager/leave_list',$result);
	}
	/*
	* @function cancel_ownleave function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Cancel leave application
	*  
	*/
    function cancel_ownleave($leaveid)
	{
	    $this->db->where('id',$leaveid);
	    $this->db->set('status','Cancelled');
	    $this->db->update('leave_information');
	redirect('leavemanager/leave/leavelist');
	}
	/*
	* @function show_all function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used for ajax request to show results on filtering.
	*  
	*/
	function show_all()
	{
		$result['data']=$this->leave_login->show_all();
		$this->load->view('leavemanager/view_leavelist',$result);
	}
	/*
	* @function getmore function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to show more results.
	*  
	*/
	function getmore()
	{
		$result['data']=$this->leave_login->show_more();
		$result['limit']=$this->input->post('limit');
		$result['offset']=$this->input->post('offset') + $this->input->post('limit');
		$this->load->view('leavemanager/view_more',$result);
	}
	function add_leave_type()
	{			
		$this->form_validation->set_rules('type_of_leave', 'Leave Type', 'required|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->load->view('leavemanager/leavetypeform');
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'type_of_leave' => @$this->input->post('type_of_leave')
						);
					
			// run insert model to write data to db
		
			if ($this->leave_login->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
			$this->session->set_flashdata('success', 'Leave type added successfully.');
				redirect('leavemanager/leave/typelist');   // or whatever logic needs to occur
			}
			else
			{
			$this->session->set_flashdata('error', 'Leave type could not be added.');
			redirect('leavemanager/leave/typelist'); 
			}
		}
	}
	function edit_leave_type($id=0)
	{			
		$this->form_validation->set_rules('type_of_leave', 'Leave Type', 'required|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
	$data = array();
		$data['id'] = $id; 
		$data['leavetype'] = @$this->db->get_where('leave_types',array('id'=>$id))->row();
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->load->view('leavemanager/editleavetypeform',$data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'type_of_leave' => @$this->input->post('type_of_leave')
						);
			$this->db->where('id',$id);
			$this->db->set('type_of_leave',$this->input->post('type_of_leave'));
			$res = $this->db->update('leave_types');
			if($res){
		$this->session->set_flashdata('success', 'Leave type edited successfully.');
		}
		else{
		$this->session->set_flashdata('error', 'Leave type could not be edited.');
		}
			
			redirect('leavemanager/leave/typelist'); 
		}
	}
	function delete_leave_type($id=0)
	{			$this->db->where('id',$id);
		$res = $this->db->delete('leave_types');
		if($res){
		$this->session->set_flashdata('success', 'Leave type deleted successfully.');
		}
		else{
		$this->session->set_flashdata('error', 'Leave type could not be deleted.');
		}
					
			redirect('leavemanager/leave/typelist'); 
		
	}
	
	/*
	* @function typelist function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use View leave type listing
	*  
	*/
	function typelist()
	{
		/*-----new code ----*/
		$sitesdata['title']="Leave Type List";
		/*------end----*/
	check_access('User Management');
		$this->load->vars($sitesdata);
		$data['types']=@$this->db->get('leave_types')->result_array();
		$this->load->view('leavemanager/typelist',$data);
	}
}