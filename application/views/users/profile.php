<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(window).load(function(){
})
</script>
<div class="grid_17 alpha">
                <!--Start Cotent-->
                <div class="content" id="dashboard">
<h1>Edit Profile</h1>
<div id="add_post">
<?php echo form_open(site_url('profile'),'class="loginform" id="login-form"  enctype="multipart/form-data" autocomplete="off"'); ?>
        <div class="label">
            <label for="user">User Name:</label>
        </div>
        <div class="row">
            <input type="text" autocomplete="off" id="user" name="user" readonly="readonly" value="<?php echo $this->session->userdata('user_name'); ?>"/>
            <span class="description">Usernames cannot be changed.</span>
        </div> 
        
        
        <div class="label">
            <label for="email">Your Email:</label>
        </div>
        <div class="row">
            <input type="text" autocomplete="off" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>"/>
            <span class="description">Your email (Required).</span>
        </div>
        
        <div class="form_row">
                    <div class="label">
                        <label for="file_image">Upload Your Image</label>
                    </div>
                    <div class="row">                       
                        <input type="file" name="file_image" id="file_image" value="" />
                        <span class="description">Yur Profile Picture.</span>  
                        <?php if($this->session->userdata('user_image')){?>
                        <img src="<?php echo base_url('uploads/users/thumbs/'.$this->session->userdata('user_image'));?>" width="46"  />
						<?php } ?>
                    </div>
                </div>
        
        <div class="label">
            <label for="npass">New Password:</label>
        </div>
        <div class="row">
            <input type="password" class="text required" name="password" id="password" autocomplete="off" />
            <span class="description">If you would like to change the password type a new one. Otherwise leave this blank.</span>
        </div>
        <div class="label">
            <label for="passagain">Please re-enter new password.</label>
        </div>
        <div class="row">
            <input type="password" class="text required" name="cpassword" id="cpassword" value="" autocomplete="off" />
            <span class="description">Type your new password again.</span>
        </div>
        <div class="row">
            <input type="submit" name="edit_profile" value="Update Profile" />
        </div>
            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>" />
    </form>
</div>
</div></div>