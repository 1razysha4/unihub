<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if($this->input->is_ajax_request()==1)
{
	$user_id = $this->session->userdata('user_id');
	if((int)$user_id>0){		
		echo $this->load->view('users/check_login_session');
		return '';
	}
}
?>
<div class="content">
  <h1>Forgot your password?</h1>
  <div id="fotget_pw"> <?php echo form_open('','class="recoverform" id="recover-form"');?>
    <h1 class="form_tag">Enter your email address</h1>
    <div class="row">
      <input type="text" class="text required" name="email_address" id="email_address" value="" autocomplete="off" />
    </div>
    <div class="row">
      <input type="submit" name="user-submit" value="Reset my password" class="user-submit" />
      <input type="hidden" name="return" value="<?php echo $this->input->get('return');?>"  />
    </div>
    </form>
  </div>
  <div class="clear"></div>
</div>
