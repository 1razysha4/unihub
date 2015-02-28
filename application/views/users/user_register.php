<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function(){
	$("#form_register").validationEngine('attach', {
		scroll:false
	});
});
</script>
<!--------login-tab-------->
        	<div class="tabbed_area">
            <div style="width:100%; text-align:center; padding:5px; color:#000; font-size:18px; margin-bottom:10px;font-family: Oswald; text-transform: uppercase;">Register for free</div>
        <ul class="tabs">
            <li><a href="javascript:tabSwitch_2(1, 2, 'tab_', 'content_');" id="tab_1" class="active"  style="text-align:center;">Register</a></li>
            <li><a href="javascript:tabSwitch_2(2, 2, 'tab_', 'content_');" id="tab_2">Login</a></li>
         </ul>
         
        <div id="content_1" class="content">
        <?php echo validation_errors(); ?>
        	<ul>
           		<?php echo form_open(site_url('register'),'id="form_register"'); ?>
                	<label>Name:</label><br />
                    <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" class="validate[required]" /><br />
                    <label>Email Id:</label><br />
                    <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" class="validate[required]" /><br />
                    <label>User Name:</label><br />
                    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" class="validate[required]" /><br />
                    <label>Password:</label><br />
                    <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" class="validate[required]" /><br />
                    <label>Confirm Password:</label><br />
                    <input type="password" id="cpassword" name="cpassword" value="<?php echo set_value('cpassword'); ?>" class="validate[required]" /><br />
                    <input type="checkbox"  style="width:30px;"/><label style="font-weight:normal;">I accept Terms & Conditions.</label><br />
                    <input type="submit" id="btn_submit" style=" text-align:center; width:146px; height:31px; margin-top: 10px" class="reg-btn" value="" />
                    
                </form>
            </ul>
        </div>
        <div id="content_2" class="content">
        	<ul>
        		
                <?php echo form_open(site_url('login')); ?>
                	<label>Username:</label><br />
                    <input type="text" id="" name="username" value="" /><br />
                    <label>Password:</label><br />
                    <input type="password" id="" name="password" value="" /><br />
                    <input type="checkbox"  style="width:30px;"/><label style="font-weight:normal;">Remember Me</label><br />
                    <a href="#" style="">Forgot my password</a><br /><br /><input type="submit" class="login-btn"  style="margin-left:16px; width:61px; height:32px;" value="" />
                    
                </form>
     		</ul>
        </div>
        
    </div>