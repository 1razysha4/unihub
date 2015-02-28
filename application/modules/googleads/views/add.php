<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php echo form_open('','name="googleadsForm"');?>
<style type="text/css">
#page{ padding:0px!important;}
</style>
<fieldset>
<div class="widget fluid">
	<div class="formRow">
		<div class="grid3">
        	<label>Google Ads Title:</label>
      	</div>
		<div class="grid9">
			<input class="input-xlarge" type="text" name="google_ad_title" id="google_ad_title" value="<?php echo $google_ad->google_ad_title; ?>" />		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Page:</label>
      	</div>
		<div class="grid9">
      		<?php echo $page_select;?>
		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Html:</label>
      	</div>
		<div class="grid9">
      		<textarea rows="10" name="google_ad_html" cols="60"><?php echo $google_ad->google_ad_html; ?></textarea>
		</div>    
	</div>
    <div class="formRow">
		<div class="grid3">
        	<label>Active:</label>
      	</div>
		<div class="grid9">
      		<h6><?php echo $status_select;?></h6>
		</div>    
	</div>
    <div class="grid6">
     <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo site_url('admin/googleads');?>';" value="<?php echo $this->lang->line('cancel');?>"/>
	<input type="hidden" name="google_ad_id" id="google_ad_id" value="<?php echo $google_ad->google_ad_id;?>" />
</div>
</div>
</fieldset>
<input type="hidden" name="state_id" id="state_id" value="<?php echo $google_ad->google_ad_id;?>" />
<?php echo form_close();?>