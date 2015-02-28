<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style type="text/css">
.timepicker1,.timepicker2{ width:72%!important;}
</style>
<?php $this->load->view('dashboard/system_messages');?>
<script type="text/javascript">
            $(document).ready(function() {
                $('.timepicker1').timepicker({
					showMinutes: true,
                    showPeriod: false,
                    showLeadingZero: true,
					hours: {
						starts: 0,                
						ends: 23                  
					},
					showCloseButton: true,
					closeButtonText: 'Done',
					showNowButton: true,
					nowButtonText: 'Now',
					showOn: 'both',
					button: '.timepicker_button_1'
                });
				$('.timepicker2').timepicker({
					showMinutes: true,
                    showPeriod: false,
                    showLeadingZero: true,
					hours: {
						starts: 0,                
						ends: 23                  
					},
					showCloseButton: true,
					closeButtonText: 'Done',
					showNowButton: true,
					nowButtonText: 'Now',
					showOn: 'both',
					button: '.timepicker_button_2'
                });
            });
	$(function() {
		$( ".datepicker" ).datepicker({
			buttonText:'English Calendar',
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "<?php echo base_url();?>assets/public/images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});			
</script>
<?php echo form_open();?>
<img src="<?php echo base_url('assets/public/images/step1.png');?>"  />
<table width="100%">
<col width="25%"  /><col />
	<tr>
    	<td>Category</td>
        <td><?php echo $category->category_name;?>[ <a href="<?php echo site_url('posts/addnew');?>">change</a>] </td>
    </tr>
	<tr>
    	<td>1.	Name</td>
        <td><input type="text" name="content_name" value="<?php echo set_value('content_name'); ?>" class="text-input"  /></td>
    </tr>
    <tr>
    	<td>2.	Location</td>
        <td><input type="text" name="content_location" value="<?php echo set_value('content_location'); ?>" class="text-input"  /></td>
    </tr>
    <tr>
    	<td>3.	Date</td>
        <td><input type="text" readonly="readonly" name="content_date" value="<?php echo set_value('content_date',date('Y-m-d')); ?>" class="datepicker text-input"  /></td>
    </tr>
        <tr>
    	<td>4.	Start time</td>
        <td><input type="text" readonly="readonly" name="content_start_time" value="<?php echo set_value('content_start_time'); ?>" class="timepicker1 text-input"  />
<span class="timepicker_button_1" id="btn1"><img src="<?php echo base_url();?>assets/public/images/calendar.gif" /></span></td>
    </tr>
        <tr>
    	<td>5.	Finish Time</td>
        <td><input type="text" readonly="readonly" name="content_finish_time" value="<?php echo set_value('content_finish_time'); ?>" class="timepicker2 text-input"  />
<span class="timepicker_button_2" id="btn2"><img src="<?php echo base_url();?>assets/public/images/calendar.gif" /></span></td>
    </tr>
    <tr>
    	<td>6.	Organizer</td>
        <td><input type="text" name="content_organizer" value="<?php echo set_value('content_organizer'); ?>" class="text-input"  /></td>
    </tr>
        <tr>
    	<td>7.	Contact Organizer</td>
        <td><input type="text" name="content_contact_organizer" value="<?php echo set_value('content_contact_organizer'); ?>" class="text-input"  /></td>
    </tr>
        <tr>
    	<td></td>
        <td><input type="submit" name="next" value="Next" class="button btn-filldetails"  /></td>
    </tr>
</table>
<input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
<input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>" />
<input type="hidden" name="step_no_1" value="1" />
</form>