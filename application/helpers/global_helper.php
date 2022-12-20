<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Returns the Name of user 
 *
 * @access	public
 * @return	string
 */
 	function GetName($ID)
	{
		$CI =& get_instance();
		$CI->db->select('name');
		$query = $CI->db->get_where('users',array('id' => $ID, 'active' => 1),1);
		return $query->row()->name;
	}
	function Getmodules($ID)
	{
		$CI =& get_instance();
		
		$query = $CI->db->query("select * from module where project_id = '$ID'");
		return $query;
	}
	function GetmodulesCount($ID)
	{
		$CI =& get_instance();
		
		$query = $CI->db->query("select count(*) as count from module where project_id = '$ID'");
		return $query->row()->count;
	}

/**
 *
 * Returns the Date of birth of current user
 *
 * @access	public
 * @return	string
 */	
	function GetDOB($ID)
	{
		$CI =& get_instance();
		$CI->db->select('dob');
		$query = $CI->db->get_where('users',array('id' => $ID, 'active' => 1),1);
		return $query->row()->dob;
	}

/**
 *
 * Returns the id of supervisor
 *
 * @access	public
 * @return	string
 */	
	function GetSuperviser($ID)
	{
		$CI =& get_instance();
		$CI->db->select('supervisor_id');
		$query = $CI->db->get_where('emp_info',array('emp_id' => $ID),1);
		return $query->row()->supervisor_id;
	}
	
/**
 *
 * Returns the Full name of supervisor
 *
 * @access	public
 * @return	string
 */	
	function GetSupervisorName($ID)
	{
		$CI =& get_instance();
		$CI->db->select('supervisor_id');
		$query = $CI->db->get_where('emp_info',array('emp_id' => $ID),1);
		$sup_id = $query->row()->supervisor_id;
		$CI->db->select('name');
		$query1 = $CI->db->get_where('users',array('id' => $sup_id),1);
		return $query1->row()->name;
	}	

/**
 *
 * Returns the date of joining
 *
 * @access	public
 * @return	string
 */	
	function GetDOJ($ID)
	{
		$CI =& get_instance();
		$CI->db->select('date_of_joining');
		$query = $CI->db->get_where('users',array('id' => $ID, 'active' => 1),1);
		return $query->row()->date_of_joining;
	}

/**
 *
 * Returns the photo name of current user
 *
 * @access	public
 * @return	string
 */	
	function getPhoto($ID)
	{
		$CI =& get_instance();
		$CI->db->select('user_image');
		$query = $CI->db->get_where('users',array('id' => $ID, 'active' => 1),1);
		return $query->row()->user_image;
	}
	
	/**
 *
 * Returns the all the details of logged in user
 *
 * @access	public
 * @return	string
 */	
	function GetUserDetail($ID)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('users',array('id' => $ID),1);
		return $query;
	}

/**
 *
 * Returns the email id of supervisor
 *
 * @access	public
 * @return	string
 */	
	function GetSupervisorEmailI($ID)
	{
		$CI =& get_instance();
		$CI->db->select('supervisor_id');
		$query = $CI->db->get_where('emp_info',array('emp_id' => $ID),1);
		$sup_id = $query->row()->supervisor_id;
		$CI->db->select('name');
		$query1 = $CI->db->get_where('users',array('id' => $sup_id),1);
		return $query1->row()->name;
	}
	
/**
 *
 * Returns all users having role supervisor, employee, group-leader.
 *
 * @access	public
 * @return	string
 */		
	 function GetAllUsers()
	 {
    	$CI =& get_instance();
		$s = "select distinct(users.id) as id,users.name as name from users join emp_role on users.id = emp_role.emp_id where users.active = '1' order by users.name asc";
   		$rid = $CI->db->query($s);
		$count = $rid->result_array(); 
		$treeArray = array();
		$treeArray[0] = 'Please Select'; 
		if($rid->num_rows() > 0)
		{
			foreach ($count as $row) 
			{
				$treeArray[$row['id']] = ucwords($row['name']);
			}
		}
    	return $treeArray;
	}
/**
 *
 * Returns the remark for passed user id and date
 *
 * @access	public
 * @return	string
 */
	function GetRemark($user_id,$date){
		$CI =& get_instance();
		$query1 = $CI->db->query("SELECT  remark,color from remark where uid = '$user_id' and date = '$date'");
		if($query1->num_rows() > 0)
			{
				return $query1;
			}
		else
			{
				return $query1;
			}
	}
/**
 *
 * Returns the role listing
 *
 * @access	public
 * @return	string
 */
	function GetRoleListing(){
		$CI =& get_instance();
		$query1 = $CI->db->query("SELECT  * from role_table");
		if($query1->num_rows() > 0)
			{
				return $query1->result_array();
			}
		else
			{
				return 0;
			}
	}		
/**
 *
 * Returns the role
 *
 * @access	public
 * @return	string
 */
	function GetRole($id){
		$CI =& get_instance();
		$query1 = $CI->db->query("SELECT  role_id from emp_role where emp_id = '$id'");
		if($query1->num_rows() > 0)
			{
				return $query1->row()->role_id;
			}
		else
			{
				return 0;
			}
	}
	
	function check_access($module_name)
	{
	$CI =& get_instance();
		if($CI->session->userdata($module_name) != 1)
		{
			redirect('user/access');
		}
	}	
	function isUserLogin()
	{
	$CI =& get_instance();
		if($CI->session->userdata('user_login')!=1)
			redirect('user');
	}
	/**
 *
 * Insert entry into the updates table 
 *
 * @access	public
 * @return	string
 */
 	function SetUpdates($data)
	{
		$CI =& get_instance();
		$CI->db->insert('updates', $data);
		if ($CI->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	/**
 *
 * Returns the recent updates
 *
 * @access	public
 * @return	array
 */
	function GetUpdates(){
		$CI =& get_instance();
		$query1 = $CI->db->query("SELECT  * from updates order by id desc limit 0,5");
		if($query1->num_rows() > 0)
			{
				return $query1->result_array();
			}
		else
			{
				return 0;
			}
	}
/**
 *
 * Returns the task 
 *
 * @access	public
 * @return	array
 */
 	function GetTask($ID)
	{
		$CI =& get_instance();
		$CI->db->select('title');
		$query = $CI->db->get_where('task',array('id' => $ID),1);
		return $query->row()->title;
	}
/**
 *
 * Returns the leave details
 *
 * @access	public
 * @return	array
 */
 	function GetLeave($ID)
	{
		$CI =& get_instance();
		$CI->db->select('date_from,date_to,reason');
		$query = $CI->db->get_where('leave_information',array('id' => $ID),1);
		return $query->row();
	}	