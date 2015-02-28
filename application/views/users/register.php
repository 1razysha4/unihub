<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function(){
	$('#user_name').focus();
	$('#password').val("");
});
</script>
<div class="shadowblock">
                	<h2 class="dotted">Register</h2>
                    <p style="padding-top:15px; font-size:12px;">Please complete the fields below to create your free account. Your login details will be emailed to you for confirmation so make sure to use a valid email address.</p>
                	<div class="left-box">

							<?php echo form_open(site_url('register'),'class="loginform" id="login-form"'); ?>

							<p>
								<label for="login_username">Username:</label>
								<input type="text" class="text required" name="user_name" id="user_name" value="<?php echo set_value('user_name'); ?>">
							</p>
                            
                            <p>
								<label for="login_password">E-mail:</label>
								<input type="text" class="text required" name="email_address" id="email_address" value="<?php echo set_value('email_address'); ?>" />
							</p>

							<p>
								<label for="login_password">Password:</label>
								<input type="password" class="text required" name="password" id="password" value="<?php echo set_value('password'); ?>">
							</p>
                            
                            <p>
								<label for="login_password">Confirm Password:</label>
								<input type="password" class="text required" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword'); ?>">
							</p>
                            
                            <p align="" style="display:none;">
								 
								<label for="security_code">&nbsp; </label>
								<script type="text/javascript">
									var RecaptchaOptions = {
									theme : 'red'
									};
                                </script>
                                <?php
                                $this->load->helper('recaptchalib');                    
                                echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
                                ?>
                                
							</p>
                            
							<div class="clr"></div>

							<div id="checksave">

								<p class="rememberme">
									<input name="agree" class="checkbox" id="agree" value="" type="checkbox" checked="checked">
									<label for="rememberme" style="float:none; padding:0 5px; font-weight:normal;">I accept Terms & Conditions.</label>
								</p>

								<p class="submit">
									<input type="submit" class="btn_orange" name="register" id="login" value="Create Account &raquo;">
									
								</p>

								
							</div>

						</form>

						<!-- autofocus the field -->
						<script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

					</div>
                </div>