<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
   <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>View Role Access <small></small></h1>
	</div>
     <table class="table table-bordered table-striped table-highlight" style="width:90%;" align="center">
<tr>
	<th style="width:90%;">Module</th>
	<th>Access</th>
</tr>

  <?php 
   foreach($module_access_rights->result() as $modules): 
  // echo $modules->module_name;
   
   $this->db->where('id',$modules->module_id);
   $mod_query=$this->db->get('modules');
   $mod_res=$mod_query->row();
   ?>
			<tr>
            <td width="35%" class="description"><?php 
			
			echo $mod_res->module_name;
			
			?></td>
            <td class="description" >
			<?php if($modules->check=='y')
			{
			?>
           <i class="icon-ok"></i>
            <?php } 
			else
			{ ?>
			 <i class="icon-remove"></i>
			<?php } ?>
            </td>
             <?php 
			
			endforeach;?>
           </tr>
   

</table>

    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>			
			

