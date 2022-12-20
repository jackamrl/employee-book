<ul class="nav nav-pills nav-stacked well sidebar" style="background:#fff;">
					 <li <?php if($this->uri->segment(2) == 'dashboard' && $this->uri->segment(1) == 'user'){echo 'class="active"';}?>>
            			<a href="<?php echo site_url('user/dashboard');?>"><i class="icon-home"></i> Dashboard</a>
                  </li> 
				<li class="divider"></li>
			<?php if($this->session->userdata('Apply Leave') == 1)
				  {?>
                  <li <?php if($this->uri->segment(3) == 'applyleave' && $this->uri->segment(2) == 'leave'){echo 'class="active"';}?>>
            			<a href="<?php echo site_url('leavemanager/leave/applyleave');?>"><i class="icon-pencil"></i> Apply Leave</a>
                  </li> 
				<li class="divider"></li>				  
            <?php }?>
			<?php if($this->session->userdata('View Leave') == 1)
				  {?>
                  <li>
            			<a href="<?php echo site_url('leavemanager/leave/leavelist');?>"><i class="icon-user"></i>  My Leave List</a>
                  </li> 
				<li class="divider"></li>				  
            <?php }?>
			<?php if($this->session->userdata('User Management') == 1)
			  		{ ?>
                    <li>
            <a href="<?php echo site_url('leavemanager/leave/add_leave_type');?>"><i class="icon-th-list"></i> Add Leave Type</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			 <?php if($this->session->userdata('User Management') == 1)
			  		{ ?>
                    <li>
            <a href="<?php echo site_url('leavemanager/leave/typelist');?>"><i class="icon-th-list"></i> Leave Type List</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			 <?php if($this->session->userdata('View All Employee Leave') == 1)
			  		{ ?>
                    <li>
            <a href="<?php echo site_url('leavemanager/admin/leavelist');?>"><i class="icon-th-list"></i> Leave Listing</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			  <?php if($this->session->userdata('Add Task') == 1)
			  		{ ?>
                    <li <?php if($this->uri->segment(3) == 'add' && $this->uri->segment(2) == 'task'){echo 'class="active"';}?>>
            <a href="<?php echo site_url('taskmanager/task/add');?>"><i class="icon-th-list"></i> Add Task</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			 
			  <?php if($this->session->userdata('View Task') == 1)
			  		{ ?>
                    <li <?php if($this->uri->segment(2) == 'task' && $this->uri->segment(3) == ''){echo 'class="active"';}?>>
            <a href="<?php echo site_url('taskmanager/task');?>"><i class="icon-th-list"></i> My Task Listing</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			  <?php if($this->session->userdata('View All Task') == 1)
			  		{ ?>
                    <li <?php if($this->uri->segment(3) == 'all' && $this->uri->segment(2) == 'task'){echo 'class="active"';}?>>
            <a href="<?php echo site_url('taskmanager/task/all');?>"><i class="icon-th-list"></i> All Task Listing</a>
            </li> 
			<li class="divider"></li>
           	 <?php }?>
			 <?php if($this->session->userdata('User Management') == 1)
				  {?>
                  <li <?php if($this->uri->segment(3) == 'add' && $this->uri->segment(2) == 'manage'){echo 'class="active"';}?>>
            			<a href="<?php echo site_url('usermanager/manage/add');?>"><i class="icon-user"></i>  Add User</a>
                  </li> 
				<li class="divider"></li>				  
            <?php }?>
            <?php if($this->session->userdata('User Management') == 1)
				  {?>
                  <li>
            			<a href="<?php echo site_url('usermanager/manage/userlist');?>"><i class="icon-list shortcut-icon"></i> User Listing</a>
                  </li> 
				<li class="divider"></li>				  
            <?php }?>
			
             <?php if($this->session->userdata('Roles Management') == 1)
			 		{ ?>
                    <li <?php if($this->uri->segment(3) == 'add' && $this->uri->segment(2) == 'role'){echo 'class="active"';}?>>
            <a href="<?php echo site_url('rolemanager/role/add');?>" ><i class="icon-lock"></i> Add Role</a>
            </li> 
			<li class="divider"></li>
           		 <?php }?>
            
           <?php if($this->session->userdata('Roles Management') == 1)
				  {?>
                  <li <?php if($this->uri->segment(3) == 'role_list' && $this->uri->segment(2) == 'role'){echo 'class="active"';}?>>
            			<a href="<?php echo site_url('rolemanager/role/role_list');?>"><i class="icon-list"></i> Role Listing</a>
                  </li> 
				<li class="divider"></li>				  
            <?php }?>
             
           
       <li <?php if($this->uri->segment(2) == 'change' && $this->uri->segment(1) == 'user'){echo 'class="active"';}?>>
            <a href="<?php echo site_url('user/change');?>"><i class="icon-edit"></i> My Control</a>
        </li>
		<li class="divider"></li>
</ul>