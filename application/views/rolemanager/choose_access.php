<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Module Permissions <small></small></h1>
	</div>
     <?php echo form_open('rolemanager/role/access_action');?>

<table class="table table-bordered table-striped table-highlight">
<?php $i=0;
foreach(@$all_modules->result() as $modules): ?>


<tr>
<td class="description"><?php echo $modules->module_name;?></td>

<input type="hidden" name="id_<?php echo $i?>" value="<?php echo $modules->id;?>" />
<input type="hidden" name="module_name_<?php echo $i?>" value="<?php echo $modules->module_name;?>" />

<td><input style="width:15px; height:15px; border:none; outline:none;" type="checkbox" id="check_<?php echo $i?>" name="check_<?php echo $i?>" value="Y" /></td>
</tr>

<?php  $i++;      
endforeach;  

?> 
<tr>
<td colspan="2" align="center">
<input type="submit" name='submit' value="Add" class="btn btn-primary">
</td>

</tr> 


</table>
 <?php echo form_close();?>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>	

