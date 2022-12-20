<?php 
		$i=$offset-$limit;
		
                  
                    if($data != ""){	
						foreach ($data->result_array() as $row)
						{
							$id =  $row['id']; 
						?>
						<tr>
							 <td class="displayblock"><?php echo $i+=1; ?></td>
							 <td>
										<?php echo ucwords($row['title']);?>
							</td>
                             <td class="displayblock"><?php echo $row['description'].$row['id'];?></td>
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
<a href="#" class="btn btn-primary" id="<?php echo $i; ?>" onclick="more();" >More</a>
</div>
                    </td>
                </tr> 
                <?php		
				}else{
					echo '<tr><td colspan="5" align="center">There is no Data to display</td></tr>';
				}
		 ?>