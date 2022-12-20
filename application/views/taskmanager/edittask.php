<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Edit Task <small></small></h1>
	</div>
     <?php     
$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('taskmanager/task/edit/'.$id, $attributes); ?>
<div class="control-group">
    <label for="title" class="control-label">Title <span class="required">*</span></label>
	<div class='controls'>
       <input id="title" type="text" name="title" maxlength="255" value="<?php if(set_value('title')){echo set_value('title');}else{echo $task->title;} ?>" class="input-xxlarge" /><input class="datepicker" type="hidden" name="date"  value="<?php echo date("Y-m-d"); ?>"  />
		 <?php echo form_error('title'); ?>
	</div>
</div><div class="control-group">
    <label for="description" class="control-label">Description <span class="required">*</span></label>
<div class='controls'>
<textarea name="description" class="input-xxlarge" rows="5"><?php if(set_value('description')){echo set_value('description');}else{echo $task->description;} ?></textarea>
	
	<?php echo form_error('description'); ?>
</div>
</div>
<div class="control-group">
    <label for="estimated_time" class="control-label">Estimated Time</label>
	<div class='controls'>
       <input id="estimated_time" type="text" name="estimated_time" maxlength="255" value="<?php if(set_value('estimated_time')){echo set_value('estimated_time');}else{echo $task->estimated_time;} ?>"  />
		 <?php echo form_error('estimated_time'); ?>
	</div>
</div>
<div class="control-group">
    <label for="status" class="control-label">Status <span class="required">*</span>
</label>
<div class="controls"><?php $options = array(''  => 'Please Select','completed'    => 'Completed','cancelled'    => 'Cancelled'); ?>
 
<?php 
$status = '';
if(set_value('status')){$status =  set_value('status');}else{$status = $task->status;} 
echo form_dropdown('status', $options, $status)?>
		<?php echo form_error('status'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
      
		<input type="submit" name="submit" value="Edit" class="btn btn-primary">
	</div>
</div>
<?php echo form_close(); ?></fieldset>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>