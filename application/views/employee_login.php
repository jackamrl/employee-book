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
            <a class="brand" href="<?php echo base_url();?>"><?php echo ORGANISATION;?> </a>
			<div class="nav-collapse collapse">				
				<!--navigation does here-->  
					
					</div>
				</div>  
			</div>  
		</div>	
<div class="container" style="padding-top:50px;">
 <form class="form-signin" action="<?php echo site_url('user/login');?>" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
		<?php if($this->session->flashdata('error')){?>
		<p class="alert alert-error" align="center"><button type="button" class="close" data-dismiss="alert">&times;</button><?php  echo $this->session->flashdata('error');?></p><?php }?>
        <input type="text" name="username" class="login username-field input-block-level" placeholder="Username" value="<?php echo set_value('usermane');?>" >
		<?php echo form_error('username', '<div class="error">', '</div>'); ?>
        <input type="password" name="password" class="login password-field input-block-level" placeholder="Password" value="<?php echo set_value('password');?>">
		<?php echo form_error('password','<div class="error">', '</div>'); ?>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>
     
         <?php  echo form_close(); ?>
</div> 

<div id="footer" class="navbar-inner" style="color:#fff;height:30px;padding:20px;margin-top: 50px;">
<div id="footer_wrap">
Copyright &copy; <?php echo @ORGANISATION;?>
</div>
</div>

</body>
</html>           
</body>
</html>