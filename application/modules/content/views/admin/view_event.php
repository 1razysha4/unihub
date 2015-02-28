<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo form_open(site_url($this->uri->uri_string()),' enctype="multipart/form-data" class="main"');?>
<fieldset>
  <div class="widget fluid">
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('category_name');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge"  name="category_name" id="category_name" type="text" value="<?php echo $content_details->category_name;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('category_details');?></label>
      </div>
      <div class="grid9">
        <textarea class="input-xlarge" id="category_details" name="category_details"><?php echo $category->category_details;?></textarea>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_date');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge"  name="category_name" id="category_name" type="text" value="<?php echo $content_details->category_date;?>" />
      </div>
    </div>
    <div class="grid6">
      <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo base_url();?>admin/content';" value="<?php echo $this->lang->line('cancel');?>"/>
    </div>
    <input type="hidden" name="category_id" value="<?php echo $category->category_id;?>" />
  </div>
  <?php echo form_close();?>
</fieldset>
<script type="text/javascript">
$(document).ready(function(){
	$(".styled, input:radio, input:checkbox, .dataTables_length select").uniform();
});
</script>
