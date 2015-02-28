<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('dashboard/editor');
?>
<?php echo form_open(site_url($this->uri->uri_string()),'name="contentForm" enctype="multipart/form-data" class="main"');?>
<fieldset>
  <div class="widget fluid">
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('category_name');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $category_select;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('article_title');?></label>
      </div>
      <div class="grid9">
        <label><input type="text" name="article_name" id="article_name" value="<?php echo set_value('article_name',$article_details->article_name);?>"  /></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('article_alias');?></label>
      </div>
      <div class="grid9">
        <label><input type="text" name="article_alias" id="article_alias" value="<?php echo set_value('article_alias',$article_details->article_alias);?>"  /></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_description');?></label>
      </div>
      <div class="grid9">
        <span><textarea name="article_long_desc"><?php echo set_value('article_long_desc',$article_details->article_long_desc);?></textarea></span>
      </div>
    </div> 
    
    <div class="formRow">
      <div class="grid3">
        <label>Image</label>
      </div>
      <div class="grid9">
        <span><input type="file" name="file_image" id="file_image" /></span>
        <img src="<?php echo base_url('uploads/articles/thumbs/'.$article_details->article_image);?>" />
      </div>
    </div> 
    
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('content_status');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $status_select;?></label>
      </div>
    </div>
    <div class="grid6">
<input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo base_url();?>admin/article';" value="<?php echo $this->lang->line('cancel');?>"/>
    </div>
    <input type="hidden" name="article_id" value="<?php echo $article_details->article_id;?>" />
    <input type="hidden" name="article_image" value="<?php echo $article_details->article_image;?>" />
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