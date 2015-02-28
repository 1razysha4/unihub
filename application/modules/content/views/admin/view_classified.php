<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo form_open(site_url($this->uri->uri_string()),'name="contentForm" enctype="multipart/form-data" class="main"');?>
<fieldset>
  <div class="widget fluid">
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('category_name');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $content_details->category_name;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_name');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $content_details->content_name;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_description');?></label>
      </div>
      <div class="grid9">
        <span><?php echo $content_details->content_long_desc;?></span>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_date');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $content_details->content_date;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_created_by');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $content_details->username;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_status');?></label>
      </div>
      <div class="grid9">
        <label><?php echo ($content_details->content_status==1)?'Approved':'Approval Pending';?></label>
      </div>
    </div>
    <div class="grid6">
<?php /*?>      <input type="button" onclick="changeStatus();" name="apply" value="<?php echo $this->lang->line('approve');?>" class="buttonS bGreen"  /><?php */?>
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo base_url();?>admin/content';" value="<?php echo $this->lang->line('cancel');?>"/>
    </div>
    <input type="hidden" name="content_id" value="<?php echo $content_details->content_id;?>" />
  </div>
  <?php echo form_close();?>
</fieldset>
<script type="text/javascript">
$(document).ready(function(){
	//$(".styled, input:radio, input:checkbox, .dataTables_length select").uniform();
});
function changeStatus(){
	if(confirm('Are you sure to approve this post?')){
		var form = document.contentForm;
		form.action = '<?php echo site_url('admin/content/changestatus');?>';
		form.submit();
	}
}

</script>