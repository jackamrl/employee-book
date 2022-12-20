<?php echo $this->load->view('header'); ?>
<div class="container-fluid" style="padding-top:90px;" >
  <div class="row-fluid">
    
    <div class="well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>My Leave List<small></small></h1>
	</div>

          <fieldset>
                        <?php 
                                $leave_type=array();
                                $js = 'id="leave_type" onChange="show_all();"';
                                $leave_type[0]="Select leave type";
                                $sql = $this->db->query("select * from leave_types order by id");
                                foreach ($sql->result_array() as $rows):
                                    $leave_type[$rows['id']] = $rows['type_of_leave'];
                                endforeach;
                                echo form_dropdown('leave_type',$leave_type,0,$js);
                        ?> 
                    
                                 <input id="date1" class="datepicker" name="date_from" type="text"   onchange="show_all();" value="<?php echo ($_POST)? @$_POST['date_from'] : 'Select Date From'; ?>"/>
                        
                   
                                <input id="date2" class="datepicker" name="date_to" type="text"  onchange="show_all();" value="<?php echo ($_POST)? @$_POST['date_to'] : 'Select Date To'; ?>"/>
    
                  
                        <?php 
                            $js = 'id="stat" onChange="show_all();"';
                            $stat=array(
                                        '0' => "Select Status",
                                        'Approved' => 'Approved',
                                        'Pending' => 'Pending',
                                        'Rejected' => 'Rejected',
                                        'Cancelled' => 'Cancelled',
                                 );
                    echo form_dropdown('status',$stat,'0',$js);
                ?> </fieldset>
          <div class="hr"></div>
          <div id="usertable" class="userleave_list">
          <table id="updates" class="table table-bordered table-striped table-highlight">
            <tr>
              <th style="width:35px;">S.No.</th>
              <th style="width:150px;">Leave Type</th>
              <th style="width:95px;">Date From</th>
              <th style="width:95px;" class="hidden-tablet hidden-phone">Date To</th>
              <th style="width:250px;" class="hidden-tablet hidden-phone">Reason</th>
              <th style="width:100px;" class="hidden-tablet hidden-phone">No. Of Days</th>
              <th style="width:126px;">Status</th>
            </tr>
            <?php 
            $i=$this->uri->segment(3);
            if($data != ""){
                    foreach ($data->result_array() as $row)
                    {
                    $id =  $row['id']; 
            ?>
               <?php
            if($row['status']== 'Approved')
            {
                $Class = 'ApproveClass';
            }
            elseif($row['status'] == 'Rejected')
            {
                $Class = 'RejectClass';
            }
            elseif($row['status'] == 'Leave not taken')
            {
                $Class = 'LNTClass';
            }
            elseif($row['status'] == 'Pending')
            {
                $Class = 'PendingClass';
            }
            elseif($row['status'] == 'Cancelled')
            {
                $Class = 'CancelledClass';
            }
            ?>
            <tr class="<?php echo $Class;?>" id="<?php echo $row['id'];?>">
              <td><?php echo $i+=1; ?></td>
              <td><?php 
                $this->db->where('id',$row['leave_type']);
                $leave_type_query=$this->db->get('leave_types');
                $leave_type_res=$leave_type_query->row();
                
                echo $leave_type_res->type_of_leave;?></td>
              <td><?php echo date('j-M-Y',strtotime($row['date_from'])) ?></td>
              <td class="hidden-tablet hidden-phone"><?php echo date('j-M-Y',strtotime($row['date_to'])) ?></td>
              <td class="hidden-tablet hidden-phone"><?php echo $row['reason'];?></td>
              <td class="hidden-tablet hidden-phone">
              <?php 
              if($row['half_day']!='')
              {
				  $half = $row['half_day'];
                echo $row['number_of_days'].' ('.@$row['half_day'].' )';
              }
              else
              {
				   $half = "No";
                echo $row['number_of_days'];
              } 
              ?>
              </td>       <td><?php 
                            if($row['status']=="Approved")
                            {
                            ?>
                        Approved&nbsp;
                <?php }?>
                <?php 
                            if($row['status']=="Rejected")
                            {?>
               <span class="hotspot" onmouseover="tooltip.show('<?php echo $row['reject_reason']; ?>');" onmouseout="tooltip.hide();">
                    <span class="<?php echo $Class;?>">Rejected&nbsp;</span>
               </span>
                <?php }
                            if($row['status']=="Pending")
                            {?>
                Pending&nbsp;
                <a class="btn btn-danger btn-mini" onclick="return cancel_con()" href="<?php echo site_url();?>/leavemanager/leave/cancel_ownleave/<?php echo $row['id'];?>">Cancel</a>
                <?php }
                         
                if($row['status']=="Cancelled")
                            {?>
                Cancelled&nbsp;
                <?php }?>
                </td>
            </tr>
            <?php 			}?>
            
              <tr id="moreid">	<td class="paging" colspan="9" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="9" align="right">
						
<div class="morebox">
<input type="hidden" value="<?php echo $i; ?>" id="offset">
<input type="hidden" value="10" id="limit">
<input type="hidden" value="<?php echo $row['id'];?>" id="row">
<a href="#" class="btn btn-primary" id="<?php echo $i; ?>" onclick="more();" >More</a>
</div>
                    </td>
                </tr> 
            
        <?php	}else{
                echo '<tr><td colspan="7" style="background:#fff;  vertical-align:top;" align="center">There is no data to display</td></tr>';
            }
     
     ?>
          </table>
		 
</div>
          </div>
        </div>
      </div>
    


<?php echo $this->load->view('footer'); ?> 
<script type="text/javascript">
 function show_all()
 {
	 var leave_type=$('#leave_type').val();
	 var date_from=$('#date1').val();
	 var date_to=$('#date2').val();
	 var status=$('#stat').val();
	 var data ='leave type='+leave_type+'&date from='+date_from+'&date to='+date_to+'&stat='+status;
	 $.ajax({
  		 type: "POST",
   		 url: "<?php echo site_url();?>/leavemanager/leave/show_all",
   		 data: 'leave type='+leave_type+'&date from='+date_from+'&date to='+date_to+'&stat='+status,
   		success: function(msg){
    		 $('#usertable').html(msg);
   		}
 	});
 }
 function more()
 {
	 var leave_type=$('#leave_type').val();
	 var date_from=$('#date1').val();
	 var date_to=$('#date2').val();
	var status=$('#stat').val();
	var limit = $('#limit').val();
	var row = $('#row').val();
	$('html, body').animate({ scrollTop: $("#"+row).offset().top }, 'slow');
		var offset = $('#offset').val();
	$.ajax({
  		 type: "POST",
   		 url: "<?php echo site_url();?>/leavemanager/leave/getmore",
   		  data: 'leave_type='+leave_type+'&date from='+date_from+'&date to='+date_to+'&stat='+status+'&limit='+limit+'&offset='+offset,
   		success: function(msg){
			$('#moreid').remove();
    		 $('#updates tbody').append(msg);
			
   		}
 	});
 }
 </script>