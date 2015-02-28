Hi <?php echo $username;?>,
<br />
<p>You are registered successfully .Please follow the link to complete the registration.</p><br>
<a href="<?php echo site_url();?>user/activation/<?php echo $user_id.'/'.$activation_key?>">Click to activate your account</a>

