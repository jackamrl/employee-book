
                       <?php 
		$i=$offset-$limit;
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
		  echo $row['number_of_days'].' ('.@$row['half_day'].' )';
		  }else
		  {
		  echo $row['number_of_days'];
		  } ?></td>
          <td><?php 
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
<input type="hidden" value="<?php echo @$offset; ?>" id="offset">
<input type="hidden" value="<?php echo @$limit;?>" id="limit">
<input type="hidden" value="<?php echo $row['id'];?>" id="row">
<a href="#" class="btn btn-primary" id="<?php echo $i; ?>" onclick="more();" >More</a>
</div>
                    </td>
                </tr> 
 		
	<?php	}else{
			echo '<tr><td colspan="7" style="background:#fff; padding:3px 0px 3px 2px; vertical-align:top;" align="center">There is no data to display</td></tr>';
		}
 
 ?>