<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Add Leave Type<small></small></h1>
	</div>
 <?php     
$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('leavemanager/leave/edit_leave_type/'.$id, $attributes); ?>
<div class="control-group">
    <label for="type_of_leave" class="control-label">Leave Type <span class="required">*</span></label>
	<div class='controls'>
       <input id="type_of_leave" type="text" name="type_of_leave" maxlength="255" value="<?php if(set_value('type_of_leave')){echo set_value('type_of_leave');}else{echo $leavetype->type_of_leave;} ?>"  />
		 <?php echo form_error('type_of_leave'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
        <?php echo form_submit( 'submit', 'Submit'); ?>
	</div>
</div>
<?php echo form_close(); ?></fieldset>
</div>
</div>
</div>
<?php $this->load->view('footer');?>