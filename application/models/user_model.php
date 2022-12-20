<?php 
class User_model extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function GetDetails()
	{	
		$query = $this->db->get_where('users',array('username' => $_POST['username'],'password' => md5(@$_POST['password'])));
		return $query;
	}
	
	
	function CheckEmailID($EmailID)
	{
		$query = $this->db->get_where('users',array('email' => $EmailID));
		if($query->num_rows() > 0)
		{
			return TRUE;	
		}
		else
		{
			return FALSE;
		}
	}
	
	function generatePassword($length=5,$level=0)
	{
		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));
		$validchars[0] = "0123456789";
		$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
		$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
		
		$password = "";
		$counter = 0;
		
		while ($counter < $length) 
		{
			$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
			
			// All character must be different
			if (!strstr($password, $actChar)) 
			{
				$password .= $actChar;
				$counter++;
			}
		}
		return $password;
	}
	function user_already_exist()
	{  
		$this->db->select('id');
		$this->db->where('username',$_POST['username']);
		
		$user_exist_query=$this->db->get('users');
		$user_exist_result=$user_exist_query->num_rows();
		return $user_exist_result;
	}
	
	function email_already_exist()
	{  
		$this->db->select('id');
		$this->db->where('email',$_POST['email']);
		
		$email_exist_query=$this->db->get('users');
		$email_exist_result=$email_exist_query->num_rows();

		return $email_exist_result;
	}
	function login()
	{
		$query = $this->db->get('admin');
		return $query;
	}
	
	function insert_user()
	{
			$this->username   = strtolower($this->input->post('username')); 
			$this->name   = $this->input->post('name');
        	$this->password = md5($this->input->post('password'));
        	$this->email    = $this->input->post('email');
			$this->date_of_joining   = @date("Y-m-d", strtotime($this->input->post('date_of_joining')));
        	$this->db->insert('users', $this);
			if($this->db->affected_rows())
				return true;
			else
				return false;
	}
	
	function insert_role($user_id)
	{
	  
	  $role_arr=$_POST['role_id'];
		for($j=0;$j<count($role_arr);$j++)
		{
			$this->db->set('emp_id',$user_id);
			$this->db->set('role_id',$role_arr[$j]);
			$this->db->insert('emp_role');
		}
	}
	function insert_team($user_id)
	{
	  
	  $supervisor=$this->input->post('supervisor');
		
			$this->db->set('emp_id',$user_id);
			$this->db->set('supervisor_id',$supervisor);
			$this->db->insert('emp_info');
		
	}
	
	function edit_role($id)
	{
	  
	    $this->db->where('emp_id',$id);
		$this->db->delete('emp_role');
		$role=$this->input->post('role_id');
		
		
		$this->db->set('emp_id',$id);
		$this->db->set('role_id',$role);
		$this->db->insert('emp_role');
		
	}
	function edit_supervisor($id)
	{
	  
	    $this->db->where('emp_id',$id);
		$this->db->delete('emp_info');
		$supervisor=$this->input->post('supervisor');
		
		
		$this->db->set('emp_id',$id);
		$this->db->set('supervisor_id',$supervisor);
		$this->db->insert('emp_info');
		
	}
	function user($limit = NULL, $offset = NULL)
 	{
  		$this->db->limit($limit, $offset);
		$this->db->where_not_in('username','admin');
		$this->db->order_by('name','asc');
 		return $this->db->get('users');
	 }
	 function update_entry()
		{
			$id=$this->session->userdata('id');
			$currentpass   = md5($_POST['currentpass']); 
			$password = $_POST['password'];
			$data = array('password' => md5($password));
			$this->db->update('users', $data, array('id' => $id,'password' => $currentpass));
			if($this->db->affected_rows())
					return true;
			else
					return false;		
		}
	
}
?>