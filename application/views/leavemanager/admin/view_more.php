
                       <?php 
		$i=$offset-$limit;
		if($data != "")
		{
				foreach ($data->result_array() as $row)
				{
					$id =  $row['id']; 
		?> 
        
       <?php
        if($row['status']== 'Approved')
		{
			$Class = 'success1';
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
             <td class="hidden-phone"><?php echo $row['status'] ?></td>
              <td>Date From : <?php echo date('j-M-Y',strtotime($row['date_from'])) ?><br>
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
                                 <div align="center" style="display:none; width:55px;" id="resoan_form_<?php echo $row['id'] ; ?>">
                                <?php echo form_open_multipart('leavemanager/admin/reject_leave/'.$row['id'].'/'.$row['emp_id'].'/'.$result2->type_of_leave.'/'.$row['date_from'].'/'.$row['date_to'].'/'.$row['number_of_days'].'/'.@$half);?>
                               
                                    <textarea id="reason" name="reason" placeholder="Reject reason"></textarea><input type="submit" value="submit" class="btn btn-mini btn-primary " />
                                    </form>
                                 </div>   
                            <?php 
                            }?>
                            
                            </td> 
                      <?php 
					     }?>
                        
        </tr>
		
        <?php }?>
		 <tr id="moreid">	<td class="paging" colspan="9" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" colspan="9" align="right">
						
<div class="morebox">
<input type="hidden" value="<?php echo @$offset; ?>" id="offset">
<input type="hidden" value="<?php echo @$limit;?>" id="limit">
<input type="hidden" value="<?php echo $row['id'];?>" id="row">
<a href="#" class="btn btn-primary" id="<?php echo $i; ?>" onclick="more();" >More</a>
</div>
                    </td>
                </tr> 
 <?php }else{
			echo '<tr><td colspan="9">There is no more data.</td></tr>';
		}
 
 ?>
