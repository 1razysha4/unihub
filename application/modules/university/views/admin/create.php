<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo form_open(site_url($this->uri->uri_string()),' enctype="multipart/form-data" class="main"');?>
<fieldset>
  <div class="widget fluid">
    <div class="whead">
      <h6><?php echo $university->university_name;?></h6>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('state_name');?></label>
      </div>
      <div class="grid9">
			<?php echo $state_select;?>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('university_name');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge"  name="university_name" id="university_name" type="text" value="<?php echo $university->university_name;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('university_address');?></label>
      </div>
      <div class="grid9">
        <textarea class="input-xlarge" id="university_address" name="university_address"><?php echo $university->university_address;?></textarea>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('university_slug');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge" id="university_slug" name="university_slug" type="text" value="<?php echo $university->university_slug;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('image');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge" id="university_image" name="university_image" type="file" />
        <input type="hidden" name="university_image_old" id="university_image_old" value="<?php echo $university->university_image;?>"  /><br /><br />
        <img src="<?php echo base_url('uploads/university/thumbs/'.$university->university_image);?>"  />
      </div>
    </div>
    
    <div class="formRow">
          <div class="grid3"><label class="control-label" for="date01"><?php echo $this->lang->line('is_top');?></label></div>
          <div class="grid9">
          	<input name="is_top" data-no-uniform="true" <?php if($university->is_top){?>checked<?php }?> type="checkbox" class="iphone-toggle">
          </div>
        </div>
    <div class="grid6">
      <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo base_url();?>admin/university';" value="<?php echo $this->lang->line('cancel');?>"/>
    </div>
    <input type="hidden" name="university_id" value="<?php echo $university->university_id;?>" />
  </div>
  <?php echo form_close();?>
</fieldset>
<script type="text/javascript">
$(document).ready(function(){
	//$(".styled, input:radio, input:checkbox, .dataTables_length select").uniform();
});
</script>
