<?php $this->load->view('header');?>
<div class="container-fluid" style="padding-top:90px;">
  <div class="row-fluid">
    <div class="span3">
	 <?php $this->load->view('sidebar');?>
    </div>
    <div class="span9 well" style="background:#fff;">
	
	<div class="page-header">
	  <h1>Apply For Leave <small></small></h1>
	</div>
     <?php $this->load->view('leavemanager/applyleave');?>
    </div>
  </div>
</div>           
<?php $this->load->view('footer');?>
