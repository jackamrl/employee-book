<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
   <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Edit Role <small></small></h1>
	</div>
     
<?php echo form_open('rolemanager/role/edit/'.$this->uri->segment(4));?>
<table class="table table-bordered table-striped table-highlight">

<tr>
<th>Module</th>
<th style="text-align:center;">Access</th>
</tr>
<?php $i=0;
foreach(@$edit_role_query->result() as $modules1): 

$this->db->where('id',$modules1->module_id);
$module_query=$this->db->get('modules');
$modules=$module_query->row();

?>


<tr>
<td class="description"><?php echo $modules->module_name;?></td>

<input type="hidden" name="id_<?php echo $i?>" value="<?php echo $modules->id;?>" />
<input type="hidden" name="module_name_<?php echo $i?>" value="<?php echo $modules->module_name;?>" />

<td style="text-align:center;"><?php if($modules1->check=="y"){?>
<input style="width:15px; height:15px; border:none; outline:none;" type="checkbox" id="check_<?php echo $i?>" name="check_<?php echo $i?>" value="y" checked="checked"/><?php }else{
?>
<input style="width:15px; height:15px; border:none; outline:none;" type="checkbox" id="check_<?php echo $i?>" name="check_<?php echo $i?>" value="n"/>
<?php } ?>
</td>
</tr>

<?php  $i++;      
endforeach;  
?> 
<input type="hidden" name="number" value="<?php echo $i?>" />

<tr>


</tr> 


</table>
<input type="submit" class="btn btn-primary pull-right" >
 <?php echo form_close();?>

    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>	  