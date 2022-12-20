<?php $this->load->view('header');?>
<?php 
 $role = array(
 				        
              'name'        => 'role',
              'id'          => 'role',
			 
              'value'       => '',
            );
?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Add New Role<small></small></h1>
	</div>
    <?php 
	$attributes = array('class' => 'form-horizontal', 'id' => '');
	echo form_open('rolemanager/role/add',$attributes);?>
					 <div class="control-group">
    <label for="role" class="control-label">Role Name <span class="required">*</span></label>
	<div class='controls'>
       <input id="role" type="text" name="role" maxlength="255" value="<?php echo set_value('role'); ?>"  />
		 <?php echo form_error('role'); ?>
	</div>
</div><div class="control-group">
    <label for="description" class="control-label">Description <span class="required">*</span></label>
<div class='controls'>
	<?php echo form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description') ) )?>
	<?php echo form_error('description'); ?>
</div>
</div>

<div class="control-group">
	<label></label>
	<div class='controls'>
        <?php echo form_submit( 'submit', 'Submit'); ?>
	</div>
</div>
<?php echo form_close(); ?>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>	  