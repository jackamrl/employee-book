<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 *
 * Returns the Leave type 
 *
 * @access	public
 * @return	string
 */
 	function GetLeavetype($ID)
	{
		$CI =& get_instance();
		$CI->db->select('type_of_leave');
		$query = $CI->db->get_where('leave_types',array('id' => $ID),1);
		return $query->row()->type_of_leave;
	}
/**
 *
 * Returns the Leave types 
 *
 * @access	public
 * @return	array
 */
 	function GetLeavetypes()
	{
		$CI =& get_instance();
		$CI->db->select('type_of_leave');
		$CI->db->select('id');
		$query = $CI->db->get('leave_types');
		$leaveTypes = array();
		$leaveTypes[0] = 'Please Select'; 
		$count = $query->result_array(); 
		if($query->num_rows() > 0)
		{
			foreach ($count as $row) 
			{
				$leaveTypes[$row['id']] = ucwords($row['type_of_leave']);
			}
		}
		return $leaveTypes;
	}	
/**
 *
 * Returns the Total leave available 
 *
 * @access	public
 * @return	string
 */
 	function GetTotalleave($ID)
	{
		$CI =& get_instance();
		$year = date("Y");
		$query = $CI->db->query("select SUM(eligibility) as total from emp_leave_status where  emp_id = '$ID' and year = '$year'");
		return $query->row()->total;
	}
	
/**
 *
 * Returns the Leave available according to the type leave available 
 *
 * @access	public
 * @return	string
 */
 	function GetTypeleaveavailable($ID,$type)
	{
		$CI =& get_instance();
		$year = date("Y");
		$query = $CI->db->query("select eligibility as total from emp_leave_status where  emp_id = '$ID' and year = '$year' and leave_type = '$type'");
		return $query->row()->total;
	}	
	
/**
 *
 * Returns the email of the user by passing id. 
 *
 * @access	public
 * @return	string
 */
 	function Getemailid($ID)
	{
		$CI =& get_instance();
		$query = $CI->db->query("select email from users where id = '$ID'");
		return $query->row()->email;
	}
	
/**
 *
 * Returns the leave information of the user by passing id. 
 *
 * @access	public
 * @return	string
 */
 	function Getleaveinfo($ID)
	{
		$CI =& get_instance();
		$query = $CI->db->query("select * from leave_information where id = '$ID'");
		return $query->result_array();
	}
	
/**
 *
 * Returns the pending leaves of the user by passing id. 
 *
 * @access	public
 * @return	string
 */
 	function PendingLeaves($emp_id, $leave_type)
		{
			$CI =& get_instance();
			$CI->db->where('type_of_leave',$leave_type);
			$query=$CI->db->get('leave_types');	
			$lid=$query->row()->id;
			$query=$CI->db->query('Select sum(number_of_days) as tot from leave_information where emp_id = "'.$emp_id.'" and year ="'.date('Y').'" and status = "Pending" and leave_type = "'.$lid.'"');
			return $query->row()->tot;
		}	
			
		