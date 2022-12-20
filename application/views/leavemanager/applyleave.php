<?php @$this->session->userdata('Roles Management');?>
<div id="errorBlock">
</div>
<?php 
$attributes = array('class'=>'form-horizontal');
echo form_open('leavemanager/leave/applyleave',$attributes);?>
	<div class="control-group">
		<label class="control-label">Leave Type</label>
		<div class="controls">
		  <?php
			$list = GetLeavetypes();
                echo form_dropdown('leave_type',@$list,set_value('leave_type'));
            ?>
            <?php echo form_error('leave_type');?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Date From</label>
		<div class="controls">
		 <input class="datepicker" id="dateFrom" name="date_from" type="text" value="<?php  echo set_value('date_from'); ?>" onchange="getNumberOfDays();" /><?php echo form_error('date_from');?>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label">Date To</label>
		<div class="controls">
		  <input class="datepicker" id="dateTo" name="date_to" type="text" value="<?php  echo set_value('date_to'); ?>" onchange="getNumberOfDays();" /><?php echo form_error('date_to');?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Number of days </label>
		<div class="controls">
		   <input id="total_days" name="number_of_days" value="<?php echo set_value('number_of_days'); ?>" readonly="readonly" type="text" size="20" />
		   <?php echo form_error('number_of_days');?>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label">Reason</label>
		<div class="controls">
		   <textarea name="reason" style="width:80%;"><?php echo set_value('reason'); ?></textarea>
			<?php echo form_error('reason');?>
		</div>
	</div>
   
   <div class="control-group">
    <div class="controls">
      <input type="submit" name="submit" value="submit"   class="btn btn-primary"/>
    </div>
  </div>
<?php echo form_close();?>
<script>
function getNumberOfDays()
{
	var diff = daydiff(parseDate($('#dateFrom').val()), parseDate($('#dateTo').val()));
	var diff = parseInt(diff) + 1;
	
    if(isNaN(diff)){
    	return;
    }
	else{
		if(diff > 0){
			$('#total_days').val(diff);
		}
		else{
		$('#errorBlock').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Please select valid dates</div>');
		$('#dateTo').focus();
		}
	}
}
function parseDate(str) {
    var mdy = str.split('-')
    return new Date(mdy[2], mdy[1]-1, mdy[0]);
}

function daydiff(first, second) {
    return (second-first)/(1000*60*60*24)
}
</script>