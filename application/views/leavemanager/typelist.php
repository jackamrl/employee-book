<?php $this->load->view('header');?>
<script type="text/javascript">

function con1() {
 var answer = confirm("Are you sure you want to delete this leave type.");
 if (answer) {
  return true;
 }

 return false;
}


</script>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well"style="background:#fff;">
		<div class="page-header">
	  <h1>Leave Type Listing	  <small></small></h1>
	</div>
	<?php if($this->session->flashdata('success')){?>
        	<p class="alert alert-success" align="center"><button type="button" class="close" data-dismiss="alert">&times;</button><?php  echo $this->session->flashdata('success');?></p><?php }?>
	<?php if($this->session->flashdata('error')){?>
        	<p class="alert alert-success" align="center"><button type="button" class="close" data-dismiss="alert">&times;</button><?php  echo $this->session->flashdata('error');?></p><?php }?>		
    <table class="table table-bordered table-striped table-highlight">
<tr>
<th>Leave Type</th>
                    <th>Action</th>
                    </tr>

  <?php 
   foreach ($types as $type)
	{ 
	?>
           	<td>
				<?php echo ucfirst($type['type_of_leave']) ;?></td>
           	<td>
			
			
			<a  href="<?php echo site_url();?>/leavemanager/leave/edit_leave_type/<?php echo $type['id'];?>" class="btn btn-primary btn-mini">Edit</a>
           	<a  onclick="return con1()" href="<?php echo site_url();?>/leavemanager/leave/delete_leave_type/<?php echo $type['id'];?>" class="btn btn-danger btn-mini">Delete</a>
            </tr>
  <?php           
		}
  ?>  
</table>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>	  
			
