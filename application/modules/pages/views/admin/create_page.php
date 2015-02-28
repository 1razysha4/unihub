<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('dashboard/jquery_editor');
?>
    <div class="widget fluid">
    <?php echo form_open(site_url($this->uri->uri_string()),'enctype="multipart/form-data" class="form-horizontal"');?>
      <div class="whead">
      <h6> <?php echo $page_details[0]->page_name;?></h6>
    </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label"><?php echo $this->lang->line('page');?></label></div>
          <div class="grid9">
            <input class="input-xlarge" id="page_name" name="page_name" type="text" value="<?php echo $page_details[0]->page_name;?>">
          </div>
        </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label"><?php echo $this->lang->line('description');?></label></div>
          <div class="grid9">
            <textarea class="editor" rows="20" name="page_description"><?php echo $page_details[0]->page_description;?></textarea>
          </div>
        </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label"><?php echo $this->lang->line('slug');?></label></div>
          <div class="grid9">
            <input type="text" name="page_slug" value="<?php echo $page_details[0]->page_slug;?>" />
          </div>
        </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label" for="date01"><?php echo $this->lang->line('active');?></label></div>
          <div class="grid9">
          	<input name="page_active" data-no-uniform="true" <?php if($page_details[0]->page_active){?>checked<?php }?> type="checkbox" class="iphone-toggle">
          </div>
        </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label" for="date01"><?php echo $this->lang->line('type');?></label></div>
          <div class="grid9">
          	 <input type="text" name="page_type" value="<?php echo $page_details[0]->page_type;?>" />
          </div>
        </div>
        <div class="formRow">
          <div class="grid3"><label class="control-label" for="date01"><?php echo $this->lang->line('order');?></label></div>
          <div class="grid9">
          	 <input type="text" name="page_order" value="<?php echo $page_details[0]->page_order;?>" />
          </div>
        </div>
        <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('allow_facebook_cooment');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $status_select;?></label>
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('show_google_ad');?></label>
      </div>
      <div class="grid9">
        <label><?php echo $google_ad_select;?></label>
        <textarea name="google_ad_html" rows="10" cols="60" class="input-xlarge"><?php echo $page_details[0]->google_ad_html;?></textarea>
      </div>
    </div>
        <div class="form-actions">
          <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
          <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
          <input type="button" class="buttonS bGreen" onclick="javascript:window.location='<?php echo base_url();?>admin/pages';" value="<?php echo $this->lang->line('cancel');?>"/>
        </div>
        <input type="hidden" name="page_id" value="<?php echo $page_details[0]->page_id;?>" />
      </form>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	//$('.iphone-toggle').iphoneStyle();
	//$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();						   
});
</script>
