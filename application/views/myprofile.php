<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9">
	
	<div class="page-header">
	  <h1>My Profile<small></small></h1>
	</div>
     <p class="user_link"><a href="#"><?php echo $userdetails->row()->name; ?></a></p>
                        <?php 
							$old_date_timestamp = strtotime($userdetails->row()->dob);
							$new_date = date('d F Y', $old_date_timestamp);
						?>
                       <span class="user_info"><?php echo "Email : ".$userdetails->row()->email."<br>"."Date of Birth : ".$new_date;?></span>
   
   </div>
  </div>
</div>           
<?php $this->load->view('footer');?>
