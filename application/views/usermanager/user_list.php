<?php echo $this->load->view('header'); ?>
<script type="text/javascript">
function con() {
 var answer = confirm("Are you Sure");
 if (answer) {
  return true;
 }

 return false;
}

function con1() {
 var answer = confirm("Are you sure you want to deactivate the user");
 if (answer) {
  return true;
 }

 return false;
}

function con2() {
 var answer = confirm("Are you sure you want to activate the user");
 if (answer) {
  return true;
 }

 return false;
}
function con3() {
 var answer = confirm("Are you sure you want to delete the user");
 if (answer) {
  return true;
 }

 return false;
}
</script>
  <div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    
    <div class="span3 sidebar">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>User Listing<small></small></h1>
	</div>
	<?php if($this->session->flashdata('error_user')){?>
        	<p class="alert alert-success" align="center"><button type="button" class="close" data-dismiss="alert">&times;</button><?php  echo $this->session->flashdata('error_user');?></p><?php }?>
            <div>
			<div class="displayblock">
  			 <table class="table table-bordered table-striped table-highlight" >
    			<tr>
                    <th style="width:35px;text-align:center; ">S.No.</th>
                    <th style="width:150px; ">Full Name</th>
                    <th style="width:150px; ">Username</th>
                    <th style="width:225px; ">E-Mail</th>
                    <th>Action</th>
               </tr>
				<?php 
                    $i=$this->uri->segment(3); 
                    if($data != ""){	
						foreach ($data->result_array() as $row)
						{
							$id =  $row['id']; 
						?>
						<tr>
							 <td><?php echo $i+=1; ?></td>
							 <td>
										<?php echo ucwords($row['name']);?>
							</td>
                             <td><?php echo $row['username'];?></td>
							 <td><?php echo $row['email'];?>
							</td>
							 <td>
							 
								<a href="<?php echo site_url()?>/usermanager/manage/edit/<?php echo $id;?>" class="btn btn-primary btn-mini">Edit</a>
                                
								
                                <?php if($row['active']==1){?>
                                <a class="btn btn-warning btn-mini" onclick="return con1()" href="<?php echo site_url();?>/usermanager/manage/deactivate/<?php echo $id;?>">Deactivate</a>
                                <?php }else {?><a class="btn btn-success btn-mini" onclick="return con2()" href="<?php echo site_url();?>/usermanager/manage/activate/<?php echo $id;?>">Activate</a>
							       <?php }?>
								    <a class="btn btn-danger btn-mini" onclick="return con3()" href="<?php echo site_url();?>/usermanager/manage/delete/<?php echo $id;?>">Delete</a>
                               
                            </td>
						</tr>  
                        
				 <?php }
 						
				?>
                
                <tr>
                	<td class="paging" rowspan="2" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="7" align="right">
						<?php echo $this->pagination->create_links(); ?>
                    </td>
                </tr>  
                <?php		
				}else{
					echo '<tr><td colspan="5" align="center">There is no Data to display</td></tr>';
				}
		 ?>
		</table>
		</div>
		<div class="display">
		<table class="table table-bordered table-striped table-highlight display" >
    			<tr>
                    
                    <th style="width:80%;">Name</th>
                    <th>Action</th>
               </tr>
				<?php 
                    $i=$this->uri->segment(3); 
                    if($data != ""){	
						foreach ($data->result_array() as $row)
						{
							$id =  $row['id']; 
						?>
						<tr>
							
							 <td>
										<?php echo ucwords($row['name']);?>
							</td>
                            
							 <td>
							 
								<a href="<?php echo site_url();?>/usermanager/manage/edit/<?php echo $id;?>" class="btn btn-primary btn-mini">Edit</a>
                                
								
                                <?php if($row['active']==1){?>
                                <a class="btn btn-warning btn-mini" onclick="return con1()" href="<?php echo site_url();?>/usermanager/manage/deactivate/<?php echo $id;?>">Deactivate</a>
                                <?php }else {?><a class="btn btn-success btn-mini" onclick="return con2()" href="<?php echo site_url();?>/usermanager/manage/activate/<?php echo $id;?>">Activate</a>
							       <?php }?>
                               
                            </td>
						</tr>  
                        
				 <?php }
 						
				?>
                
                <tr>
                	<td class="paging" rowspan="2" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="7" align="right">
						<?php echo $this->pagination->create_links(); ?>
                    </td>
                </tr>  
                <?php		
				}else{
					echo '<tr><td colspan="5" align="center">There is no Data to display</td></tr>';
				}
		 ?>
		</table>
		</div>
                   
                  </div>  
                </div>
            </div>
        
    <div class="clear"></div>
<?php echo $this->load->view('footer');?>