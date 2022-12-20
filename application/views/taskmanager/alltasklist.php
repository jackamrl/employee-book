<?php echo $this->load->view('header'); ?>
<script type="text/javascript">
function con() {
 var answer = confirm("Are you Sure");
 if (answer) {
  return true;
 }

 return false;
}
</script>
<script type="text/javascript">
function con1() {
 var answer = confirm("Are you sure you want to deactivate the user");
 if (answer) {
  return true;
 }

 return false;
}
</script>
<script type="text/javascript">
function con2() {
 var answer = confirm("Are you sure you want to activate the user");
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
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Task Listing<small></small></h1>
	</div>
        	<p class="error" align="center"><?php  echo $this->session->flashdata('error_user');?></p>
            <div class="userleave_list">
  			 <table class="table table-bordered table-striped table-highlight" id="updates">
    			<tr>
                    <th style="width:35px;text-align:center; " class="displayblock">S.No.</th>
					 <th style="width:150px; ">Added By</th>
                    <th style="width:150px; ">Title</th>
                    <th style="width:300px; " class="displayblock">Description</th>
                    <th style="width:150px; " class="displayblockstatus">Status</th>
                    <th>Action</th>
               </tr>
				<?php 
                    $i=$this->uri->segment(3); 
                    if($data != ""){	
						foreach ($data->result_array() as $row)
						{
							$id =  $row['id']; 
						?>
						<tr id="<?php echo $row['id'];?>">
							 <td class="displayblock"><?php echo $i+=1; ?></td>
							 <td><?php echo @GetName($row['emp_id']);?>
							 <td>
										<?php echo ucwords($row['title']);?>
							</td>
                             <td class="displayblock"><?php echo $row['description'];?></td>
							 <td class="displayblockstatus"><?php echo $row['status'];?>
							</td>
							 <td>
								<a href="<?php echo site_url()?>/taskmanager/task/edit/<?php echo $id;?>" class="btn btn-primary btn-mini">Edit</a>
                                
								
                            </td>
						</tr>  
                        
				 <?php }
 						
				?>
                
                 <tr id="moreid">	<td class="paging" colspan="9" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="9" align="right">
						
<div class="morebox">
<input type="hidden" value="<?php echo $i; ?>" id="offset">
<input type="hidden" value="10" id="limit">
<input type="hidden" value="<?php echo $row['id'];?>" id="row">
<a href="#" class="btn btn-primary"  onclick="more();" >More</a>
</div>
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
        
    <div class="clear"></div>
<script type="text/javascript">
 function more()
 {
	 
	var row = $('#row').val();
	$('html, body').animate({ scrollTop: $("#"+row).offset().top }, 'slow');
		var offset = $('#offset').val();
		var limit = $('#limit').val();
	$.ajax({
  		 type: "POST",
   		 url: "<?php echo site_url();?>/taskmanager/task/getmoreall",
   		  data: '&offset='+offset+'&limit='+limit,
   		success: function(msg){
			$('#moreid').remove();
    		 $('#updates tbody').append(msg);
			
   		}
 	});
 }
 </script>	
<?php echo $this->load->view('footer');?>