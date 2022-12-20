<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9">
	
	<div class="page-header">
	  <h1>Password Management<small></small></h1>
	</div>
     <?php 
	 $attributes = array('class' => 'form-horizontal', 'id' => '');
	 echo form_open('user/change',$attributes); ?>
<div class="control-group">
    <label for="currentpass" class="control-label">Current Password <span class="required">*</span></label>
	<div class='controls'>
       <input id="currentpass" type="password" name="currentpass" maxlength="255" value="<?php echo set_value('currentpass'); ?>"  />
		 <?php echo form_error('currentpass'); ?>
	</div>
</div><div class="control-group">
    <label for="password" class="control-label">New Password <span class="required">*</span></label>
	<div class='controls'>
       <input id="password" type="password" name="password" maxlength="255" value="<?php echo set_value('password'); ?>"  />
		 <?php echo form_error('password'); ?>
	</div>
</div><div class="control-group">
    <label for="passconf" class="control-label">Confirm Password</label>
	<div class='controls'>
       <input id="passconf" type="password" name="passconf" maxlength="255" value="<?php echo set_value('passconf'); ?>"  />
		 <?php echo form_error('passconf'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
        <?php echo form_submit( 'submit', 'Submit'); ?>
	</div>
</div>
<?php echo form_close(); ?>    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>