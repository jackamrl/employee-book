<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Add Task <small></small></h1>
	</div>
     <?php     
$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('taskmanager/task/add', $attributes); ?>
<div class="control-group">
    <label for="title" class="control-label">Title <span class="required">*</span></label>
	<div class='controls'>
       <input id="title" type="text" name="title" maxlength="255" value="<?php echo set_value('title'); ?>" class="input-xxlarge" /><input class="datepicker" type="hidden" name="date"  value="<?php echo date("Y-m-d"); ?>"  />
		 <?php echo form_error('title'); ?>
	</div>
</div><div class="control-group">
    <label for="description" class="control-label">Description <span class="required">*</span></label>
<div class='controls'>
	<?php echo form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description'),'class'=>'input-xxlarge' ) )?>
	<?php echo form_error('description'); ?>
</div>
</div>
<div class="control-group">
    <label for="estimated_time" class="control-label">Estimated Time</label>
	<div class='controls'>
       <input id="estimated_time" type="text" name="estimated_time" maxlength="255" value="<?php echo set_value('estimated_time'); ?>"  />
		 <?php echo form_error('estimated_time'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
      
		<input type="submit" name="submit" value="add" class="btn btn-primary">
	</div>
</div>
<?php echo form_close(); ?></fieldset>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>