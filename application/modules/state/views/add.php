<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php echo form_open('','name="countryForm"');?>
<fieldset>
<div class="widget fluid">
	<div class="formRow">
		<div class="grid3">
        	<label>State Name:</label>
      	</div>
		<div class="grid9">
			<input class="input-xlarge" type="text" name="state_name" id="state_name" value="<?php echo $state->state_name; ?>" />		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Country:</label>
      	</div>
		<div class="grid9">
      		<h6><?php echo $country_select;?></h6>
		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Show In Front Page:</label>
      	</div>
		<div class="grid9">
      		<h6><?php echo $show_select;?></h6>
		</div>    
	</div>
    <div class="grid6">
     <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo site_url('admin/state');?>';" value="<?php echo $this->lang->line('cancel');?>"/>
	<input type="hidden" name="state_id" id="state_id" value="<?php echo $state->state_id;?>" />
</div>
</div>
</fieldset>
<input type="hidden" name="state_id" id="state_id" value="<?php echo $state->state_id;?>" />
<?php echo form_close();?>