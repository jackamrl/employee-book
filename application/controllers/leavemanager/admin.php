<?php
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('leavemanager/leave_login');
		$this->db = $this->load->database('default', TRUE);
		$this->load->library('pagination');
		$this->load->helper('global');
		$this->load->helper('leavemanager');
		
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
			redirect('leavemanager/admin/leavelist');
		}
		else
		{
			$this->load->view('employee_login');
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
		$sitesdata['title']="View All Leave";
		$this->load->vars($sitesdata);
		check_access('View All Employee Leave');
		$per_page = 10;
		$config['base_url'] =  base_url()."leavemanager/admin/leavelist";
		$config['total_rows'] = $this->db->count_all('leave_information');
		$config['per_page'] = '10';
		$this->pagination->initialize($config); 
	 	$result['data'] = $this->leave_login->get_all_leave_info($per_page, $this->uri->segment(3));
		$result['users'] = GetAllUsers();
		$this->load->view('leavemanager/admin/leave_list',$result);
		
	}
	
	/*
	* @function approve_leave function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to approve the leave application
	*  
	*/
	function approve_leave($leave_id,$emp_id,$type,$date_from,$date_to,$no_of_days,$half='')
	{
	  /*------query to update emp leave info table------*/
		isUserLogin();
	  	$this->db->where('id',$leave_id);
		$this->db->set('status','Approved');
		$this->db->update('leave_information');
		/*----end----*/
		redirect('leavemanager/admin/leavelist');
	}
	/*
	* @function reject_leave function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to reject the leave application
	*  
	*/
	function reject_leave($id,$emp_id,$type,$date_from,$date_to,$no_of_days,$half='')
	{
		$this->db->where('id',$id);
				$this->db->set('status','Rejected');
				$this->db->set('reject_reason',@$this->input->post('reason',true));
				$this->db->update('leave_information');
			redirect('leavemanager/admin/leavelist');
		
	}
	/*
	* @function cancel_leave function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to cancel the leave application
	*  
	*/
	function cancel_leave($id)
	{
	 
	    $this->db->where('id',$id);
		$this->db->set('status','Cancelled');
		$this->db->update('leave_information');
		redirect('leavemanager/admin/leavelist'); 
	
	}
	/*
	* @function getall function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to process the ajax request when filter is used in all leave listing
	*  
	*/
	function getall()
	{
		$result['data']=$this->leave_login->get_all();
		$this->load->view('leavemanager/admin/view_status_all',$result);
	}
	/*
	* @function getmore function
	* @author Pawan Jangid
	* @version 1.1
	* @copyright Pawan Jangid
	* @since version1.0
	* @use Used to process the ajax request when more button is clicked
	*  
	*/
	function getmore()
	{
		$result['data']=$this->leave_login->get_more();
		$result['limit']=$this->input->post('limit');
		$result['offset']=$this->input->post('offset') + $this->input->post('limit');
		
		$this->load->view('leavemanager/admin/view_more',$result);
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
		$result['data']=$this->admin_lists->show_all();
		$this->load->view('view_leavelist',$result);
	}
	
	
}