<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo @$title;?></title>
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css" media="screen"/>
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicon.ico"/>
<script src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
<link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script>
  $(function() {
    $( ".datepicker" ).datepicker({changeMonth: true,
	dateFormat: "dd-mm-yy",
	changeYear: true});
  });
  </script>
</head>
<body>

       <div class="navbar navbar-fixed-top">  
			<div class="navbar-inner">  
				<div class="container"> 
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo site_url();?>"><?php echo ORGANISATION;?></a>
			
				<!--navigation does here-->  
				<div class="nav-collapse collapse">
					<ul class="nav">  
						 <?php 
						if($this->session->userdata('user_login')){?>
						<li><a href="<?php echo base_url();?>"><i class="icon-home"></i> Dashboard</a></li> 
						<li class="dropdown">
						<a href="<?=BASE_URL()?>" class="dropdown-toggle" data-toggle="dropdown">
						  Leave Manager
						  <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<?php if($this->session->userdata('Apply Leave') == 1)
				  {?>
						  <li>
							<a href="<?php echo site_url('leavemanager/leave/applyleave');?>"><i class="icon-pencil shortcut-icon"></i> Apply Leave</a>
						</li>
						<?php } ?>
						<?php if($this->session->userdata('View Leave') == 1)
				  {?>
						<li><a href="<?php echo site_url('leavemanager/leave/leavelist');?>"><i class="icon-list"></i> My Leave List</a></li>
						<?php } ?>
						<?php if($this->session->userdata('User Management') == 1)
			  		{ ?>
                    <li>
            <a href="<?php echo site_url('leavemanager/leave/add_leave_type');?>"><i class="icon-th-list"></i> Add Leave Type</a>
            </li> 
			
           	 <?php }?>
			 <?php if($this->session->userdata('User Management') == 1)
			  		{ ?>
                    <li>
            <a href="<?php echo site_url('leavemanager/leave/typelist');?>"><i class="icon-th-list"></i> Leave Type List</a>
            </li> 
			
           	 <?php }?>
						<?php if($this->session->userdata('View All Employee Leave') == 1)
			  		{ ?>
						<li><a href="<?php echo site_url('leavemanager/admin/leavelist');?>"><i class="icon-th-list"></i> Leave Listing</a></li>
						<?php } ?>
						</ul>
					  </li>
					  	<?php if($this->session->userdata('User Management') == 1)
				  {?>
					  <li class="dropdown">
						<a href="<?=BASE_URL()?>" class="dropdown-toggle" data-toggle="dropdown">
						  User Manager
						  <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<?php if($this->session->userdata('User Management') == 1)
				  {?>
						  <li>
							<a href="<?php echo site_url('usermanager/manage/add');?>"><i class="icon-pencil"></i> Add User</a>
						</li>
						<?php } ?>
						<?php if($this->session->userdata('User Management') == 1)
				  {?>
						<li><a href="<?php echo site_url('usermanager/manage/userlist');?>"><i class="icon-th-list"></i> User Listing</a></li>
						<?php } ?>
						</ul>
					  </li>
					  <?php }?>
					  <?php if($this->session->userdata('Roles Management') == 1)
			 		{ ?>
					  <li class="dropdown">
						<a href="<?=BASE_URL()?>" class="dropdown-toggle" data-toggle="dropdown">
						  Role Manager
						  <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<?php if($this->session->userdata('Roles Management') == 1)
			 		{ ?>
						  <li>
							<a href="<?php echo site_url('rolemanager/role/add');?>"><i class="icon-pencil"></i> Add Role</a>
						</li>
						<?php } ?>
						<?php if($this->session->userdata('Roles Management') == 1)
			 		{ ?>
						<li><a href="<?php echo site_url('rolemanager/role/role_list');?>"><i class="icon-th-list"></i> Role Listing</a></li>
						<?php } ?>
						</ul>
					  </li>
					  <?php } ?>
					  <li class="dropdown">
						<a href="<?=BASE_URL()?>" class="dropdown-toggle" data-toggle="dropdown">
						  Task Manager
						  <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<?php if($this->session->userdata('Add Task') == 1)
			  		{ ?>
						  <li>
							<a href="<?php echo site_url('taskmanager/task/add');?>"><i class="icon-pencil"></i> Add Task</a>
						</li>
						<?php } ?>
						 <?php if($this->session->userdata('View Task') == 1)
			  		{ ?>
						<li><a href="<?php echo site_url('taskmanager/task');?>"><i class="icon-th-list"></i> My Task Listing</a></li>
						<?php } ?>
						 <?php if($this->session->userdata('View All Task') == 1)
			  		{ ?>
						<li><a href="<?php echo site_url('taskmanager/task/all');?>"><i class="icon-th-list"></i> All Task Listing</a></li>
						<?php } ?>
						</ul>
					  </li>
					</ul> 
					<ul class="nav pull-right">
					
			
					<li class="dropdown">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> 
							<?php $name= $this->session->userdata('user'); echo ucfirst($name); ?>
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('user/myprofile');?>">My Profile</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
						</ul>
						
					</li>
					<?php } ?>
				</ul>
					</div>
				</div>  
			</div>  
		</div>
	<div class="container body narrow-body">	