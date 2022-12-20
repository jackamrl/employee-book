<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well"style="background:#fff;">
		<div class="page-header">
	  <h1>Role Listing	  <small></small></h1>
	</div>
	<?php if($this->session->flashdata('msg')){?>
        	<p class="alert alert-success" align="center"><button type="button" class="close" data-dismiss="alert">&times;</button><?php  echo $this->session->flashdata('msg');?></p><?php }?>
    <table class="table table-bordered table-striped table-highlight">
<tr>
<th>Role</th>
 <th style="width:65%;" class="displayblock1">Description</th>
                    <th>Action</th>
                    </tr>

  <?php 
   foreach ($listing_of_roles->result() as $role_result)
	{ 
	?>
           	<td>
				<?php echo ucfirst($role_result->role) ;?></td>
           <td class="displayblock1"><?php echo ucfirst($role_result->description) ;?></td></td>
           	<td>
			
			<a href="<?php echo site_url();?>/rolemanager/role/view_module_access_detail/<?php echo $role_result->id;?>" class="btn btn-info btn-mini">View</a>
			<a href="<?php echo site_url();?>/rolemanager/role/editRole/<?php echo $role_result->id;?>" class="btn btn-primary btn-mini">Edit</a>
           	<a href="<?php echo site_url();?>/rolemanager/role/edit/<?php echo $role_result->id;?>" class="btn btn-inverse btn-mini">Permissions</a>
            </tr>
  <?php           
		}
  ?>  
</table>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>	  
			
