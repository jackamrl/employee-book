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

       
<script>
 function show_user(){
 var flag=0;
	var multipleValues=new Array; 
multipleValues.push($("#s1").val());

var id=multipleValues.toString(",");
	for(var i=0 ; i < id.length ; i++){
		if(id[i]!=1){
			$('#user_tb').show();	
			flag=1;
		}else{
		if(flag==0)
			$('#user_tb').hide();	
		}
	}
 }
 
 </script>                    
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Edit Employee<small></small></h1>
	</div>
                  <?php  
				  $attributes = array('class' => 'form-horizontal', 'id' => '');
				  echo form_open('usermanager/manage/edit/'.$this->uri->segment('4'),$attributes); ?>
<div class="control-group">
    <label for="username" class="control-label">Username <span class="required">*</span></label>
	<div class='controls'>
       <input id="username" type="text" name="username" maxlength="255" value="<?php if(set_value('username')){echo set_value('username');}else{echo $user->username;} ?>"  />
		 <?php echo form_error('username'); ?>
	</div>
</div><div class="control-group">
    <label for="name" class="control-label">Full Name <span class="required">*</span></label>
	<div class='controls'>
       <input id="name" type="text" name="name" maxlength="255" value="<?php if(set_value('name')){echo set_value('name');}else{echo $user->name;} ?>"  />
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
       <input id="email" type="text" name="email" maxlength="255" value="<?php if(set_value('email')){echo set_value('email');}else{echo $user->email;} ?>"  />
		 <?php echo form_error('email'); ?>
	</div>
</div><div class="control-group">
    <label for="date_of_joining" class="control-label">Date of Joining <span class="required">*</span></label>
	<div class='controls'>
       <input class="datepicker" type="text" name="date_of_joining"  value="<?php if(set_value('date_of_joining')){echo set_value('date_of_joining');}else{echo $user->date_of_joining;} ?>"  />
	   <?php echo form_error('date_of_joining'); ?>
	</div>
</div><div class="control-group">
    <label for="role_id" class="control-label">Role <span class="required">*</span>
</label>
<div class="controls"><?php $options = $roles; ?>
<?php if(set_value('role_id')){$rol = set_value('role_id'); }else{$rol = $selected_role;}?>
<?php echo form_dropdown('role_id', $options, $rol)?>
		<?php echo form_error('role_id'); ?>
	</div>
</div><div class="control-group">
    <label for="supervisor" class="control-label">Supervisor <span class="required">*</span>
</label>
<div class="controls"><?php $options =  $users; ?>
<?php if(set_value('supervisor')){$supervisor = set_value('supervisor'); }else{$supervisor = $supervisor;}?> 
<?php echo form_dropdown('supervisor', $options, $supervisor)?>
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