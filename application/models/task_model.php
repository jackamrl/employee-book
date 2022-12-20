<?php
class Task_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function SaveForm($form_data)
	{
		$form_data['emp_id'] = $this->session->userdata('id');
		$this->db->insert('task', $form_data);
		if ($this->db->affected_rows() == '1')
		{
		$insertID = $this->db->insert_id();
			$data = array(
					'emp_id' => $this->session->userdata('id'),
					'content' => ' added a task. ',
					'type' => 'Task',
					'details'=>$insertID
				);
				SetUpdates($data);
			return TRUE;
		}
		return FALSE;
	}
	function SaveFormEdit($form_data,$id)
	{
		$this->db->where('id', $id); 
		$this->db->update('task',$form_data);
		if ($this->db->affected_rows() == '1')
		{
		$insertID = $this->db->insert_id();
			$data = array(
					'emp_id' => $this->session->userdata('id'),
					'content' => ' updated a task. ',
					'type' => 'Task',
					'details'=>$insertID
				);
				SetUpdates($data);
			return TRUE;
		}
		return FALSE;
	}
	function getTask($id)
	{
		$query = $this->db->get_where('task',array('id' => $id));
		if($query->num_rows() > 0)
		{
			return $query->row();	
		}
		else
		{
			return FALSE;
		}
	}
	function getTasks()
	{
	$emp_id = $this->session->userdata('id');
	$this->db->where('emp_id',$emp_id );
	$this->db->order_by('id','desc');
		$query = $this->db->get('task',10,0);
	
		if($query->num_rows() > 0)
		{
			return $query;	
		}
		else
		{
			return FALSE;
		}
	}
	function getTasksall()
	{
	$this->db->order_by('id','desc');
		$query = $this->db->get('task',10,0);
	
		if($query->num_rows() > 0)
		{
			return $query;	
		}
		else
		{
			return FALSE;
		}
	}
		function show_more()
		{
			
			$limit = @$this->input->post('limit');
			$offset = @$this->input->post('offset');
			
			
			$this->db->where('emp_id',$this->session->userdata('id'));
			$this->db->order_by('id','desc');
			$query=$this->db->get('task',$limit,$offset);	
			if($query->num_rows() > 0)
				return $query;
		
		}
		function show_more_all()
		{
			
			$limit = @$this->input->post('limit');
			$offset = @$this->input->post('offset');
			
			$this->db->order_by('id','desc');
			$query=$this->db->get('task',$limit,$offset);	
			if($query->num_rows() > 0)
				return $query;
		
		}
}
?>