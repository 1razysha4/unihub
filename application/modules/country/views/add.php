<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php echo form_open('','name="countryForm"');?>
<fieldset>
<div class="widget fluid">
	<div class="formRow">
		<div class="grid3">
        	<label>Country Name:</label>
      	</div>
		<div class="grid9">
      		<h6>
            	<input class="input-xlarge" type="text" name="country_name" id="country_name" value="<?php echo $country->country_name; ?>" />
            </h6>
		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Country Code:</label>
      	</div>
		<div class="grid9">
      		<h6>
            	<input class="input-xlarge" type="text" name="country_code" id="country_code" value="<?php echo $country->country_code; ?>" />
            </h6>
		</div>    
	</div>
    <div class="grid6">
     <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo site_url('admin/country');?>';" value="<?php echo $this->lang->line('cancel');?>"/>
      <input type="hidden" name="country_id" id="country_id" value="<?php echo $country->country_id;?>" />
</div>
</div>
</fieldset>
<?php echo form_close();?>