<?php $this->load->view('dashboard/system_messages');?>
<form action="<?php echo site_url();?>users/user/login" method="post">
<label for="login">Username:</label>
<input id="login" name="username" class="text" type="text" />
<label for="pass">Password:</label>
<input id="pass" name="password" type="password" class="text" />
<div class="sep"></div>
<button type="submit" class="ok">Login</button> <a class="button" href="">Forgotten password?</a>
</form>
