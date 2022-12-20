<?php
class role_model extends CI_Model {
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		 $this->load->helper('url');
		$this->load->library('session'); 
		$this->load->database();
		 
    }

	function get_modules()
	{
		$module_query=$this->db->get('modules');
		return @$module_query;
	}
	
		
	function last_role_id()
	{
		$this->db->order_by('id','desc');
		$role_query=$this->db->get('role_table');
		return $role_query;
	}
	
	function module_access()
	{
		$last_role_id=$this->last_role_id();
		$last_role=$last_role_id->row();
		$role=$last_role->id;
		$this->db->where('role_id',$role);
		$module_query=$this->db->get('role_access');
		return $module_query;
	}
	
	function mrp_module_particular_access($id)
	{
		
		$this->db->where('role',$id);
		$module_mrp_query=$this->db->get('role_access_mrp_modules');
		return $module_mrp_query;
	}

	function module_particular_access($id)
	{
		
		$this->db->where('role_id',$id);
		$module_query=$this->db->get('role_access');
		return $module_query;
	}
	
	function mrp_module_access()
	{
		$last_role_id=$this->last_role_id();
		$last_role=$last_role_id->row();
		$role=$last_role->id;
		$this->db->where('role',$role);
		$module_mrp_query=$this->db->get('role_access_mrp_modules');
		return $module_mrp_query;
	}
	
	function role_list()
	{
		$role_list_query=$this->db->get('role_table');
		return $role_list_query;
	}
	
	function role_access_data()
	{
		
		$this->db->where('role',$this->uri->segment(3));
		$role_access_query=$this->db->get('role_access');
		return $role_access_query;
	}
	
	function user_module()
	{
      		$this->db->where('user_id',$this->session->userdata('user_id'));
	  	$this->db->where('module_id',6);
		$user_access=$this->db->get('user_role_module_access');
		return $user_access;	
	}
	
	function brand_check()
   	{
        	$this->db->select('id');
		$this->db->where('module','Brand');
		$brand_check_query=$this->db->get('mrp_modules');
		$module_access_result=$brand_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$brand_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $brand_result_query;
	 
	}

	function product_check()
   	{
        	$this->db->select('id');
		$this->db->where('module','Product');
		$product_check_query=$this->db->get('mrp_modules');
		$module_access_result=$product_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$product_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $product_result_query;
	}

	function purchase_check()
   	{
        	$this->db->select('id');
		$this->db->where('module','Purchase');
		$purchase_check_query=$this->db->get('mrp_modules');
	    	$module_access_result=$purchase_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$purchase_result_query=$this->db->get('user_role_mrp_module_access');
	    return $purchase_result_query;
	}

	function purchase_id()
   	{
        	$this->db->select('id');
		$this->db->where('module','Purchase');
		$purchase_check_query=$this->db->get('mrp_modules');
	    	$module_access_result=$purchase_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		$purchase_result_query=$this->db->get('user_role_mrp_module_access');
	   	 return $purchase_result_query;
	}
	
	function sales_check()
   	{
        	$this->db->select('id');
		$this->db->where('module','Sales');
		$sales_check_query=$this->db->get('mrp_modules');
	    	$module_access_result=$sales_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$sales_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $sales_result_query;
	}

     //Following query for showing user name in to drop down
	function sales_id()
   	{
        	$this->db->select('id');
		$this->db->where('module','Sales');
		$sales_check_query=$this->db->get('mrp_modules');
	   	 $module_access_result=$sales_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		$sales_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $sales_result_query;
	}


	function supplier_check()
       	{
        	$this->db->select('id');
		$this->db->where('module','Supplier');
		$supplier_check_query=$this->db->get('mrp_modules');
	   	 $module_access_result=$supplier_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$supplier_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $supplier_result_query;
	}

	function customer_check()
      {
        	$this->db->select('id');
		$this->db->where('module','Customer');
		$customer_check_query=$this->db->get('mrp_modules');
	    	$module_access_result=$customer_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$customer_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $customer_result_query;
	}

	function warehousing_check()
      {
              $this->db->select('id');
		$this->db->where('module','Warehousing');
		$warehousing_check_query=$this->db->get('mrp_modules');
	   	 $module_access_result=$warehousing_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$warehousing_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $warehousing_result_query;
	}

      function warehousing_module_edit_access_users()
	{
		$this->db->select('id');
		$this->db->where('module','Warehousing');
		$warehousing_check_query=$this->db->get('mrp_modules');
	    	$module_access_result=$warehousing_check_query->row();
		$this->db->where('module_id',$module_access_result->id);
		$this->db->where('edit_check','Y');
		$warehousing_result_query=$this->db->get('user_role_mrp_module_access');
	    	return $warehousing_result_query;
	}

	function purchaser_email()
	{
		$this->db->select('id');
		$this->db->where('module','Purchase');
		$purchase_email_query=$this->db->get('mrp_modules');
	    	$purchase_email_result=$purchase_email_query->row();
		$this->db->where('view_check','Y');
		$this->db->where('module_id',$purchase_email_result->id);
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		$purchase_email_access_query=$this->db->get('user_role_mrp_module_access');
	    	return $purchase_email_access_query;
	}
	
	function sales_module_user_access()
	{
		$this->db->select('id');
		$this->db->where('module','Sales');
		$purchase_email_query=$this->db->get('mrp_modules');
	    	$purchase_email_result=$purchase_email_query->row();
		$this->db->where('view_check','Y');
		$this->db->where('edit_check','Y');
		$this->db->where('module_id',$purchase_email_result->id);
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		$purchase_email_access_query=$this->db->get('user_role_mrp_module_access');
	    	return $purchase_email_access_query;
	}

	function left_bar_modules_access($var)
	{
		$this->db->where('module',$var);
		$left_bar_query=$this->db->get('modules');
		$left_bar_result_id=$left_bar_query->row();
		$this->db->where('module_id',$left_bar_result_id->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$module_access=$this->db->get('user_role_module_access');
		return $module_access;
	}
	
	function left_bar_mrp_modules_access($var)
	{
		$this->db->where('module',$var);
		$left_bar_forecast_query=$this->db->get('mrp_modules');
		$forecast_result_id=$left_bar_forecast_query->row();
		$this->db->where('module_id',$forecast_result_id->id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$mrp_module_access=$this->db->get('user_role_mrp_module_access');
		return $mrp_module_access;
	}
	
	function module_access_edit($id)
	{
		$this->db->where('role_id',$id);
		$edit_role_query=$this->db->get('role_access');
		return $edit_role_query;
	}
	
	
}	