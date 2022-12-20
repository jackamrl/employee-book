<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    
    <div class="well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>All Members Leave<small></small></h1>
	</div>
      <fieldset>
					<?php 
		 					//$user=array();
							$js = 'id="user" onChange="get_all();"';
							
							
			 				echo form_dropdown('user',$users,0,$js);
					?> 
    			
							 <input id="date1" name="date_from" class="datepicker" type="text"  onchange="get_all();" value="<?php echo ($_POST)? @$_POST['date_from'] : 'Select Date From'; ?>"/>
			
							<input id="date2" name="date_to" type="text" class="datepicker"  onchange="get_all();" value="<?php echo ($_POST)? @$_POST['date_to'] : 'Select Date To'; ?>"/>

             
					<?php 
		 				$js = 'id="stat" onChange="get_all();"';
						$stat=array(
									'0' => "Select Status",
									'Approved' => 'Approved',
									'Pending' => 'Pending',
									'Rejected' => 'Rejected',
							 );
				echo form_dropdown('status',$stat,'0',$js);
			?> 
		</fieldset>
                    <div class="hr"></div>
               <div id="usertable" class="userleave_list">      
               
                    <table id="updates" class="table table-bordered table-striped table-highlight">
                        <tr>
                      <th style="width:35px; padding:5px; " class="hidden-tablet hidden-phone">S.No.</th>
                            <th style="width:150px; padding:5px;">Applied By</th>
                            <th style="width:120px; padding:5px; " class="hidden-tablet hidden-phone">Leave Type</th>
                            <th style="width:106px; padding:5px;" class="hidden-phone">Status</th>
                            <th style="width:290px; padding:5px; ">Date</th>
                            <th style="width:300px; padding:5px; " class="hidden-tablet hidden-phone">Reason</th>
                            <?php if($this->session->userdata('Approve/Reject Leave') == 1){?>
                            <th style="width:285px; padding:5px;">Action</th>
                            <?php } ?>
                        </tr>
                       <?php 
		$i=$this->uri->segment(4);
		if($data != ""){
				foreach ($data->result_array() as $row)
				{
				$id =  $row['id']; 
		?> 
        
        <?php
        if($row['status']== 'Approved')
		{
			$Class = 'success';
		}
		elseif($row['status'] == 'Rejected')
		{
			$Class = 'error1';
		}
		elseif($row['status'] == 'Leave not taken')
		{
			$Class = 'info1';
		}
		elseif($row['status'] == 'Pending')
		{
			$Class = 'warning1';
		}
		?>
        
        <tr class="<?php echo $Class;?>" id="<?php echo $row['id'];?>">
        	<td class="hidden-tablet hidden-phone"><?php echo $i+=1; ?></td>
            <td><?php 
			$this->db->where('id',$row['emp_id']);
			$user_query=$this->db->get('users');
			$user_result=$user_query->row();
			echo ucwords($user_result->name); ?></td>
			<td class="hidden-tablet hidden-phone">
				<?php 			 $this->db->where('id',$row['leave_type']);
				 				 $leave1_query=$this->db->get('leave_types');
				 				 $result2=$leave1_query->row();?>

			<?php echo $result2->type_of_leave; ?></td>
             <td class="hidden-phone"><?php echo $row['status'] ?></td> <td>Date From : <?php echo date('j-M-Y',strtotime($row['date_from'])) ?><br>
			  Date To : <?php echo date('j-M-Y',strtotime($row['date_to'])) ?>
			  <br>
			  Days : 
			  <?php if($row['half_day']!='')
				  {
				  echo $row['number_of_days'].' ('.@$row['half_day'].' )';
				  }else
				  {
				  echo $row['number_of_days'];
				  } ?>
			  </td>

            <td class="hidden-tablet hidden-phone"><?php echo $row['reason'];?></td>
            			
                        <?php 
							
						if($this->session->userdata('Approve/Reject Leave') == 1)
						{?>
                            <td>
                            <?php 
                            if($row['status']!="Approved")
                            {
								
                            ?>
                                 <a class="btn btn-success btn-mini" style="margin:2px;" onclick="return con()" href="<?php echo site_url();?>/leavemanager/admin/approve_leave/<?php echo $row['id'];?>/<?php echo $row['emp_id'];?>/<?php echo $result2->type_of_leave; ?>/<?php echo $row['date_from'];?>/<?php echo $row['date_to'];?>/<?php echo $row['number_of_days'];?>/<?php echo @$half;?> ">Approve</a>
                             
                            <?php 
                            } ?> 
                            <?php 
                            if($row['status']!="Cancelled")
                            {?> 
                                <a class="btn btn-warning btn-mini" style="margin:2px;" onclick="return nottaken_con()" href="<?php echo site_url();?>/leavemanager/admin/cancel_leave/<?php echo $row['id']; ?>/<?php echo $row['emp_id'] ; ?>">Cancel</a>
                             <?php 
                            } ?>                       
                            <?php 
                            if($row['status']!="Rejected")
                            {
								?>
                              
                                <a class="btn btn-danger btn-mini" style="margin:2px;" onclick="show_form(this.id)" id="<?php echo $row['id'] ; ?>">Reject
                               </a>
                                 <div  style="display:none;width:55px;" id="resoan_form_<?php echo $row['id'] ; ?>">
                                <?php echo form_open_multipart('leavemanager/admin/reject_leave/'.$row['id'].'/'.$row['emp_id'].'/'.$result2->type_of_leave.'/'.$row['date_from'].'/'.$row['date_to'].'/'.$row['number_of_days'].'/'.@$half);?>
                               
                                    <textarea id="reason" name="reason" placeholder="Reject reason"></textarea><input type="submit" value="submit" class="btn btn-mini btn-primary" />
                                    </form>
                                 </div>   
                            <?php 
                            }?>
                            
                             
                      <?php 
					     }?>
                        </td>

        </tr>
<?php      } ?>
            <tr id="moreid">	<td class="paging" colspan="9" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="9" align="right">
						
<div class="morebox">
<input type="hidden" value="<?php echo $i; ?>" id="offset">
<input type="hidden" value="10" id="limit">
<input type="hidden" value="<?php echo $row['id'];?>" id="row">
<a href="#" class="btn btn-primary" id="<?php echo $i; ?>" onclick="more();" >More</a>
</div>
                    </td>
                </tr>  
		<?php }
		else
		{
			echo '<tr><td colspan="9" >There is no data to display</td></tr>';
		}
 ?>
	</table>
	
    </div>
    </div>
  </div>
</div>           
<script type="text/javascript">
function con() {
 var answer = confirm("Are you sure you want to approve this leave?");
 if (answer) {
  return true;
 }

 return false;
}

function nottaken_con() {
 var answer = confirm("Are you sure that this leave has not been taken?");
 if (answer) {
  return true;
 }

 return false;
}

</script>

   
<script type="text/javascript">
function show_form(id){
	$('#resoan_form_'+id).toggle("slow");

}

 function get_all()
 {
	 var user_id=$('#user').val();
	 var date_from=$('#date1').val();
	 var date_to=$('#date2').val();
	var status=$('#stat').val();
	
	
	$.ajax({
  		 type: "POST",
   		 url: "<?php echo site_url();?>/leavemanager/admin/getall",
   		 data: 'user='+user_id+'&date from='+date_from+'&date to='+date_to+'&stat='+status,
   		success: function(msg){
    		 $('#usertable').html(msg);
   		}
 	});
 }
 function more()
 {
	 var user_id=$('#user').val();
	 var date_from=$('#date1').val();
	 var date_to=$('#date2').val();
	var status=$('#stat').val();
	var limit = $('#limit').val();
	var row = $('#row').val();
	$('html, body').animate({ scrollTop: $("#"+row).offset().top }, 'slow');
		var offset = $('#offset').val();
	$.ajax({
  		 type: "POST",
   		 url: "<?php echo site_url();?>/leavemanager/admin/getmore",
   		  data: 'user='+user_id+'&date from='+date_from+'&date to='+date_to+'&stat='+status+'&limit='+limit+'&offset='+offset,
   		success: function(msg){
			$('#moreid').remove();
    		 $('#updates tbody').append(msg);
			
   		}
 	});
 }
</script>
<?php $this->load->view('footer');?>
