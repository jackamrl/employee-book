<?php echo $this->load->view('header'); ?>
<?php 

 $username = array(
 				        
              'name'        => 'username',
              'id'          => 'username',
			 
              'value'       => @$_POST['username'],
            );

?>
<?php 

 $name = array(
 				        
              'name'        => 'name',
              'id'          => 'name',
			 
              'value'       => @$_POST['name'],
            );

?>
<?php 

 $password = array(
 				        
              'name'        => 'password',
              'id'          => 'password',
			 
              
            );

?>
<?php 

 $passconf = array(
 				        
              'name'        => 'passconf',
              'id'          => 'passconf',
			 
              
            );

?>
<?php 

 $email = array(
 				        
              'name'        => 'email',
              'id'          => 'email',
			 
              'value'       => @$_POST['email'],
            );

?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well"style="background:#fff;">
	
	<div class="page-header">
	  <h1>Add New Employee<small></small></h1>
	</div>
                  <?php  
				  $attributes = array('class' => 'form-horizontal', 'id' => '');
				  echo form_open('usermanager/manage/add',$attributes); ?>
<div class="control-group">
    <label for="username" class="control-label">Username <span class="required">*</span></label>
	<div class='controls'>
       <input id="username" type="text" name="username" maxlength="255" value="<?php echo set_value('username'); ?>"  />
		 <?php echo form_error('username'); ?>
	</div>
</div><div class="control-group">
    <label for="name" class="control-label">Full Name <span class="required">*</span></label>
	<div class='controls'>
       <input id="name" type="text" name="name" maxlength="255" value="<?php echo set_value('name'); ?>"  />
		 <?php echo form_error('name'); ?>
	</div>
</div><div class="control-group">
    <label for="password" class="control-label">Password <span class="required">*</span></label>
	<div class='controls'>
       <input id="password" type="password" name="password" maxlength="255" value="<?php echo set_value('password'); ?>"  />
		 <?php echo form_error('password'); ?>
	</div>
</div><div class="control-group">
    <label for="passconf" class="control-label">Confirm Password <span class="required">*</span></label>
	<div class='controls'>
       <input id="passconf" type="password" name="passconf" maxlength="255" value="<?php echo set_value('passconf'); ?>"  />
		 <?php echo form_error('passconf'); ?>
	</div>
</div><div class="control-group">
    <label for="email" class="control-label">Email <span class="required">*</span></label>
	<div class='controls'>
       <input id="email" type="text" name="email" maxlength="255" value="<?php echo set_value('email'); ?>"  />
		 <?php echo form_error('email'); ?>
	</div>
</div><div class="control-group">
    <label for="date_of_joining" class="control-label">Date of Joining <span class="required">*</span></label>
	<div class='controls'>
       <input class="datepicker" type="text" name="date_of_joining"  value="<?php echo set_value('date_of_joining'); ?>"  />
	   <?php echo form_error('date_of_joining'); ?>
	</div>
</div><div class="control-group">
    <label for="role_id" class="control-label">Role <span class="required">*</span>
</label>
<div class="controls"><?php $options = $roles; ?>
 
<?php echo form_dropdown('role_id', $options, $this->input->post('role_id'))?>
		<?php echo form_error('role_id'); ?>
	</div>
</div><div class="control-group">
    <label for="supervisor" class="control-label">Supervisor <span class="required">*</span>
</label>
<div class="controls"><?php $options =  $users; ?>
 
<?php echo form_dropdown('supervisor', $options, $this->input->post('supervisor'))?>
		<?php echo form_error('supervisor'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
        <?php echo form_submit( 'submit', 'Submit','class="btn btn-primary"'); ?>
	</div>
</div>
</div>
</div>
</div>         
<?php $this->load->view('footer');?>