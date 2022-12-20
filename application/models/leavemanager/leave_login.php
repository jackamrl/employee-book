<?php
class leave_login extends CI_Model {
		 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		 $this->load->helper('url');
		$this->load->library('session'); 
		$this->load->database();
		 
    }
		   
		function login()
		{	
			$query = $this->db->get_where('users',array('username' => $_POST['username'],'password' => md5(@$_POST['password']), 'active' => '1'));
			return $query;
		}
		
		function insert_entry()
		{ 
			$curYear = date('Y');
			$remain_days = @$this->input->post('number_of_days',true);
			$this->leave_type   = @$this->input->post('leave_type');
			$this->date_from = @date( 'Y-m-d' , strtotime($this->input->post('date_from')));
			$this->date_to = @date( 'Y-m-d' , strtotime($this->input->post('date_to')));
			$this->leave_applied_on = date('Y-m-d'); 
			$this->number_of_days   = $remain_days;
			$this->reason = @$this->input->post('reason');
			$year = date( 'Y' , strtotime($this->date_from));
			if($this->number_of_days=='0.50')
			{
				$this->half_day = @$_POST['to_radio'];
			}
			$this->emp_id = $this->session->userdata('id');
			$this->status ="Pending";
			$this->year = $year;
			$this->reject_reason = NULL;
			if($this->db->insert('leave_information', $this))
			{
			$insertID = $this->db->insert_id();
			$data = array(
					'emp_id' => $this->session->userdata('id'),
					'content' => ' applied for a leave. ',
					'type' => 'Leave',
					'details'=>$insertID
					
				);
				SetUpdates($data);
				return true;
			}
			else{return false;}
		}
		
		function get_leave_info($limit = NULL, $offset = NULL)
		{
			$id=$this->session->userdata('id');
			$this->db->order_by('year','desc');
			$this->db->order_by('id','desc');
			$this->db->where('emp_id',$id);
			$query=$this->db->get('leave_information',5,0);	
			if($query->num_rows() > 0)
				return $query;
		}

		
		function get_leave_status()
		{ 
			$curYear = date('Y');
			$id=$this->session->userdata('id');
			/*$this->db->where('emp_id',$id);
			$this->db->where('year',$curYear);
			$this->db->where('leave_type!=',"Optional leave");
			$query=$this->db->get('emp_leave_status');*/
			$query=$this->db->query("select * from emp_leave_status where emp_id = '$id' and year = '$curYear' and leave_type != 'Optional leave'");	
			if($query->num_rows() > 0)
			return $query;
		}	
		
		function unappleave($emp_id, $leave_type)
		{
			$this->db->where('type_of_leave',$leave_type);
			$query=$this->db->get('leave_types');	
			$lid=$query->row()->id;
			$query=$this->db->query('Select sum(number_of_days) as tot from leave_information where emp_id = "'.$emp_id.'" and year ="'.date('Y').'" and status = "Pending" and leave_type = "'.$lid.'"');
			return $query->row()->tot;
		}
		
		function get_team_info($limit = NULL, $offset = NULL)
		{
			if($offset=='')
				$offset=0;
			
			$id=$this->session->userdata('id');
				$query=$this->db->query("select * from leave_information where emp_id in (select emp_id from emp_info where supervisor_id='".$id."') and status!='Cancelled' order by id  desc limit ".$offset.",".$limit."");
			if($query->num_rows() > 0)
			return $query;
		}	

		function get_all_leave_info($limit = NULL, $offset = NULL)
		{
			    $this->db->limit($limit, $offset);
				$this->db->order_by('id','desc');
				$this->db->where_not_in('status','Cancelled');
				$query=$this->db->get('leave_information');	
				if($query->num_rows() > 0)
					return $query;
		}	
		
		function get_all()
		{
			$userid=$this->input->post('user');
			$stat=$this->input->post('stat');
			$datefrom=$this->input->post('date_from');
			$dateto=$this->input->post('date_to');
		
			
			if($userid != "0")
			{
				$this->db->where('emp_id',$userid);
			}
			
			if(($datefrom != "Select Date From") && ($dateto != "Select Date To"))
			{
			$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
			$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
			    $this->db->where("date_from BETWEEN '$datefrom' and '$dateto'");
			}
			else
			{
				if($datefrom != "Select Date From")
				{
				$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
					$this->db->where('date_from',$datefrom);
				}
				if($dateto != "Select Date To")
				{
				$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
					$this->db->where('date_to',$dateto);
				}
			}
			if($stat != "0")
			{
				$this->db->where('status',$stat);
			}
			
			$this->db->order_by('id','desc');
			$this->db->where_not_in('status','Cancelled');
			$query=$this->db->get('leave_information',10,0);	
			if($query->num_rows() > 0)
			{
				return $query;
			}
		}
		function get_more()
		{
			$userid=$this->input->post('user');
			$stat=$this->input->post('stat');
			$datefrom=$this->input->post('date_from');
			$dateto=$this->input->post('date_to');
			$limit = @$this->input->post('limit');
			$offset = @$this->input->post('offset');
			if($limit == ''){$limit = 5;}
			if($offset==''){$offset = 0;}
			if($userid != "0")
			{
				$this->db->where('emp_id',$userid);
			}
			
			if(($datefrom != "Select Date From") && ($dateto != "Select Date To"))
			{
			$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
			$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
			    $this->db->where("date_from BETWEEN '$datefrom' and '$dateto'");
			}
			else
			{
				if($datefrom != "Select Date From")
				{
				$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
					$this->db->where('date_from',$datefrom);
				}
				if($dateto != "Select Date To")
				{
				$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
					$this->db->where('date_to',$dateto);
				}
			}
			if($stat != "0")
			{
				$this->db->where('status',$stat);
			}
			
			$this->db->order_by('id','desc');
			$this->db->where_not_in('status','Cancelled');
			$query=$this->db->get('leave_information',$limit,$offset);	
			if($query->num_rows() > 0)
			{
				return $query;
			}
		}
		function show_all()
		{
			$leavetype=$this->input->post('leave_type');
			$stat=$this->input->post('stat');
			$datefrom=$this->input->post('date_from');
			$dateto=$this->input->post('date_to');
			$limit = @$this->input->post('limit');
			$offset = @$this->input->post('offset');
			if($limit == ''){$limit = 5;}
			if($offset==''){$offset = 0;}
			
			if($leavetype != "0"){
				$this->db->where('leave_type',$leavetype);
			}
			if(($datefrom != "Select Date From") && ($dateto != "Select Date To"))
			{
			$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
			$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
			    $this->db->where("date_from BETWEEN '$datefrom' and '$dateto'");
			}
			else
			{
				if($datefrom != "Select Date From")
				{
				$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
					$this->db->where('date_from',$datefrom);
				}
				if($dateto != "Select Date To")
				{
				$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
					$this->db->where('date_to',$dateto);
				}
			}
			if($stat != "0")
			{
				$this->db->where('status',$stat);
			}
			$this->db->where('emp_id',$this->session->userdata('id'));
			$this->db->order_by('id','desc');
			$query=$this->db->get('leave_information');	
			if($query->num_rows() > 0)
				return $query;
		
		}
		function show_more()
		{
			$leavetype=$this->input->post('leave_type');
			$stat=$this->input->post('stat');
			$datefrom=$this->input->post('date_from');
			$dateto=$this->input->post('date_to');
			$limit = @$this->input->post('limit');
			$offset = @$this->input->post('offset');
			if($limit == ''){$limit = 5;}
			if($offset==''){$offset = 0;}
			
			if($leavetype != "0"){
				$this->db->where('leave_type',$leavetype);
			}
			if(($datefrom != "Select Date From") && ($dateto != "Select Date To"))
			{
			$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
			$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
			    $this->db->where("date_from BETWEEN '$datefrom' and '$dateto'");
			}
			else
			{
				if($datefrom != "Select Date From")
				{
				$datefrom=@date('Y-m-d',strtotime($this->input->post('date_from')));
					$this->db->where('date_from',$datefrom);
				}
				if($dateto != "Select Date To")
				{
				$dateto=@date('Y-m-d',strtotime($this->input->post('date_to')));
					$this->db->where('date_to',$dateto);
				}
			}
			if($stat != "0")
			{
				$this->db->where('status',$stat);
			}
			$this->db->where('emp_id',$this->session->userdata('id'));
			$this->db->order_by('id','desc');
			$query=$this->db->get('leave_information',$limit,$offset);	
			if($query->num_rows() > 0)
				return $query;
		
		}
		function team_all()
		{
			$leavetype=$_POST['leave_type'];
			$datefrom=$_POST['date_from'];
			$dateto=$_POST['date_to'];
			$stat=$_POST['stat'];
			$userid=$_POST['user'];
			/****************************New Code (Dec 16, 2011)****************************/
			
			 $q = $this->db->query("select id, emp_id from leave_information where emp_id in (select emp_id from emp_info where supervisor_id='".$this->session->userdata('id')."')");
			$emp_list = array();
			foreach ($q->result_array() as $rows):
			$emp_list[$rows['id']] = $rows['id'];
			endforeach;
			
			if(!empty($emp_list))
			{
				$this->db->where_in('id', $emp_list);	
			}
			/****************************Till here****************************/
			if($leavetype != "0")
			{
				$this->db->where('leave_type',$leavetype);
			}
			/*********************Updated 'WHERE' clause (Dec 15, 2011), to select leaves in between Date from & Date to*************************/
			if(($datefrom != "Select Date From") && ($dateto != "Select Date To"))
			{
			    $this->db->where("date_from BETWEEN '$datefrom' and '$dateto'");
				$this->db->where("date_to BETWEEN '$datefrom' and '$dateto'");
			}
			else
			{
				if($datefrom != "Select Date From")
				{
					$this->db->where('date_from',$datefrom);
				}
				if($dateto != "Select Date To"){
					$this->db->where('date_to',$dateto);
				}
			}
			/********************************Till here*****************************************/
			if($stat != "0")
			{
				$this->db->where('status',$stat);
			}
			if($userid != "0")
			{
				$this->db->where('emp_id',$userid);
			}
			$this->db->where_not_in('status','Cancelled');
			$this->db->order_by('id','desc');
			$query=$this->db->get('leave_information');	
			if($query->num_rows() > 0)
				return $query;
		}
		function SaveForm($form_data)
	{
		$this->db->insert('leave_types', $form_data);
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
					
		
}