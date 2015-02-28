<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo form_open(site_url($this->uri->uri_string()),' enctype="multipart/form-data" class="main"');?>
<fieldset>
  <div class="widget fluid">
    <div class="whead">
      <h6><?php echo $user_details->username;?></h6>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('first_name');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge"  name="first_name" id="first_name" type="text" value="<?php echo $user_details->first_name;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('last_name');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge"  name="last_name" id="last_name" type="text" value="<?php echo $user_details->last_name;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('username');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge" id="username" name="username" type="text" value="<?php echo $user_details->username;?>" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('password');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge" id="password" name="password" type="password" value="" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label><?php echo $this->lang->line('cpassword');?></label>
      </div>
      <div class="grid9">
        <input class="input-xlarge" id="cpassword" name="cpassword" type="text" value="" />
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label for="date01"><?php echo $this->lang->line('active');?></label>
      </div>
      <div class="grid9">
        <input name="user_active" data-no-uniform="true" <?php if($user_details->active){?>checked<?php }?> type="checkbox" class="iphone-toggle">
      </div>
    </div>
    <div class="formRow">
      <div class="grid3">
        <label for="date01"><?php echo $this->lang->line('email');?></label>
      </div>
      <div class="grid9">
        <input type="text" name="email" value="<?php echo $user_details->email;?>" />
      </div>
    </div>
    <div class="grid6">
      <input type="submit" name="save" value="<?php echo $this->lang->line('save');?>" class="buttonS bGreen"  />
      <input type="submit" name="apply" value="<?php echo $this->lang->line('apply');?>" class="buttonS bGreen"  />
      <input type="button" class="buttonS bRed" onclick="javascript:window.location='<?php echo base_url();?>admin/users';" value="<?php echo $this->lang->line('cancel');?>"/>
    </div>
    <input type="hidden" name="user_id" value="<?php echo $user_details->user_id;?>" />
  </div>
  <?php echo form_close();?>
</fieldset>
<script type="text/javascript">
$(document).ready(function(){
	$(".styled, input:radio, input:checkbox, .dataTables_length select").uniform();
});
</script>
