<?php
class Task extends CI_Controller {
	private $custom_errors = array();
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('task_model');
		$this->load->helper('global');
	}	
	function index()
	{	isUserLogin();
		check_access('View Task');
$sitesdata['title']="Task Listing";
		$this->load->vars($sitesdata);		
		$result['data'] = $this->task_model->getTasks($this->session->userdata('id'));
		$this->load->view('taskmanager/tasklist',$result);
		
	}
	function all()
	{	isUserLogin();
check_access('View All Task');
$sitesdata['title']="Task Listing for All Employees";
		$this->load->vars($sitesdata); 	
		$result['data'] = $this->task_model->getTasksall();
		$this->load->view('taskmanager/alltasklist',$result);
		
	}
	function add()
	{	isUserLogin();
		check_access('Add Task'); 
		$sitesdata['title']="Add Task";
		$this->load->vars($sitesdata);
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');			
		$this->form_validation->set_rules('description', 'Description', 'required');			
		$this->form_validation->set_rules('estimated_time', 'Estimated Time', 'required|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->load->view('taskmanager/addtask');
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'date' => @$this->input->post('date'),
					       	'title' => @$this->input->post('title'),
					       	'description' => @$this->input->post('description'),
					       	'estimated_time' => @$this->input->post('estimated_time')
						);
					
			// run insert model to write data to db
		
			if ($this->task_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				redirect('taskmanager/task');   // or whatever logic needs to occur
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
	}
	
	function edit($id=0)
	{	
	isUserLogin();	
	check_access('Edit Task'); 
	$sitesdata['title']="Edit Task";
		$this->load->vars($sitesdata);
		$result['task'] = $this->task_model->getTask($id);
		$result['id'] = $id;
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');			
		$this->form_validation->set_rules('description', 'Description', 'required');
$this->form_validation->set_rules('status', 'Status', 'required|max_length[255]');		
		$this->form_validation->set_rules('estimated_time', 'Estimated Time', 'max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="text-error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->load->view('taskmanager/edittask',$result);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'date' => @$this->input->post('date'),
					       	'title' => @$this->input->post('title'),
					       	'description' => @$this->input->post('description'),
					       	'estimated_time' => @$this->input->post('estimated_time'),
							'status' => @$this->input->post('status')
						);
					
			// run insert model to write data to db
		
			if ($this->task_model->SaveFormEdit($form_data,$id) == TRUE) // the information has therefore been successfully saved in the db
			{
			
				redirect('taskmanager/task');   // or whatever logic needs to occur
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
	}
	public  function check_file($field,$field_value)
	{
		if(isset($this->custom_errors[$field_value]))
		{
			$this->form_validation->set_message('check_file', $this->custom_errors[$field_value]);
			unset($this->custom_errors[$field_value]);
			return FALSE;
		}
		return TRUE;
	}
	function upload_file($config,$fieldname)
	{
		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->do_upload($fieldname);
		$error = $this->upload->display_errors();
		if(empty($error))
		{
			$data = $this->upload->data();
			$this->$fieldname = $data['file_name'];
		}
		else
		{
			$this->custom_errors[$fieldname] = $error;
		}
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
		$result['data']=$this->task_model->show_more();
		$result['limit']=$this->input->post('limit');
		
		$result['offset']=$this->input->post('offset') + $this->input->post('limit');
		$this->load->view('taskmanager/view_more',$result);
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
	function getmoreall()
	{
		$result['data']=$this->task_model->show_more_all();
		$result['limit']=$this->input->post('limit');
		
		$result['offset']=$this->input->post('offset') + $this->input->post('limit');
		$this->load->view('taskmanager/view_more_all',$result);
	}
	function success()
	{
		$this->load->view("header");
		$this->load->view("success");
		$this->load->view("footer");
	}
}
?>