<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9">
	
	<div class="page-header">
	  <h1>Dashboard<small></small></h1>
	</div>
	<?php if($this->session->userdata('Apply Leave') == 1)
				  {?>
      <a href="<?php echo site_url('leavemanager/leave/applyleave');?>" title="Leave Manager" class="btn btn-large shortcut" style="margin: 10px;" >
       <img src="<?php echo base_url();?>img/leave.png">
      </a>
	  <?php }?>
	  <?php if($this->session->userdata('User Management') == 1)
				  {?>
    <a href="<?php echo site_url('usermanager/manage/userlist');?>" title="Employee Manager" class="btn btn-large shortcut" style="margin: 10px;">
       <img src="<?php echo base_url();?>img/employee.png">
      </a>
	  <?php }?>
	  <?php if($this->session->userdata('Roles Management') == 1)
			 		{ ?>
	  <a href="<?php echo site_url('rolemanager/role/role_list');?>" title="Role Manager" class="btn btn-large shortcut" style="margin: 10px;" >
       <img src="<?php echo base_url();?>img/role.png">
      </a>
	   <?php }?>
	   <?php if($this->session->userdata('Add Task') == 1)
			  		{ ?>
	  <a href="<?php echo site_url('taskmanager/task/add');?>" title="Task Manager" class="btn btn-large shortcut" style="margin: 10px;">
        <img src="<?php echo base_url();?>img/task.png">
      </a>
	  <?php }?>
    
   <?php
	if($updates){?>
	<div class="well" style="background:#fff;margin-top:20px;">
	<div class="page-header" style="margin-top:0px;">
	<h3>Recent Updates</h3>
	</div>
	<ul class="unstyled">
		<?php foreach($updates as $update){ 
		$task = '';
		$leave = '';
		?>
		<li  style="padding:10px;background:#f5f5f5;margin:10px;">
		<blockquote>
		<p>
		<?php if($update['type'] == 'Leave'){?><span class="label label-success">Leave</span><?php }?>
		<?php if($update['type'] == 'Task'){?><span><span class="label label-info">Task</span></span><?php }?>
		<span><strong class="indent" style="color:#393939;color: #393939;font-weight: 400;font-size: 11px;margin-left: 10px;"><?php echo @GetName($update['emp_id']);?></strong> <span style="color:#999;font-size:11px;"><?php echo $update['content'];?></span></span>
		<small><?php if($update['type'] == 'Task'){ $task = @GetTask($update['details']); echo $task;?><?php }?>
		<?php if($update['type'] == 'Leave'){ $leave = @GetLeave($update['details']); echo "Date : ".@date("j M Y",strtotime($leave->date_from));?><?php }?>
		</small>
		<?php if($update['type'] == 'Leave'){ $leave = @GetLeave($update['details']); echo "<small> Reason : ".$leave->reason."</small>";?><?php }?>
		
		</p>
		</blockquote>
		
		</li>
		<?php }?>
	</ul>
	</div>
	<?php } ?>
   </div>
  </div>
</div>           
<?php $this->load->view('footer');?>
