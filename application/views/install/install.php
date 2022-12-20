<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css" media="screen"/>
<link rel="icon" type="image/png" href="<?php echo base_url();?>images/favicon.ico"/>
<script src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

 <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

       <div class="navbar navbar-fixed-top">  
			<div class="navbar-inner">  
				<div class="container"> 
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo base_url();?>"></a>
			<div class="nav-collapse collapse">				
				<!--navigation does here-->  
					
					</div>
				</div>  
			</div>  
		</div>	

<div class="container" style="padding-top:90px;">
<div class="container-fluid">
<div class="row-fluid">
<div class="span3"></div>
<div class="span6">
<div class="page-header"><p></p>
</div>
<fieldset>
<h3>Installation</h3>
<?php
if(!empty($error)){
echo "<ul class='nav'>";
	foreach($error as $value){
		echo "<li class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
		echo $value;
		echo "</li>";
	}
echo "</ul>";
}    
$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('install', $attributes); ?>
<div class="control-group">
    <label for="hostname" class="control-label">Database Hostname <span class="required"></span></label>
	<div class='controls'>
       <input id="hostname" type="text" name="hostname" maxlength="255" class="input-block-level" value="<?php echo set_value('hostname'); ?>"  />
		 <?php echo form_error('hostname'); ?>
	</div>
</div><div class="control-group">
    <label for="username" class="control-label">Database Username <span class="required"></span></label>
	<div class='controls'>
       <input id="username" type="text" name="username" maxlength="255" class="input-block-level" value="<?php echo set_value('username'); ?>"  />
		 <?php echo form_error('username'); ?>
	</div>
</div><div class="control-group">
    <label for="password" class="control-label">Database Password <span class="required"></span></label>
	<div class='controls'>
       <input id="password" type="password" name="password" maxlength="255" class="input-block-level" value="<?php echo set_value('password'); ?>"  />
		 <?php echo form_error('password'); ?>
	</div>
</div><div class="control-group">
    <label for="database" class="control-label">Database Name <span class="required"></span></label>
	<div class='controls'>
       <input id="database" type="text" name="database" maxlength="255" class="input-block-level" value="<?php echo set_value('database'); ?>"  />
		 <?php echo form_error('database'); ?>
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
</div>
<?php $this->load->view('footer'); ?>