<script src="<?php echo site_url();?>assets/admin/js/jquery-1.7.2.min.js"></script>
<link href="<?php echo site_url();?>assets/admin/css/styles.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/elfinder.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/fancybox.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/font.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/ie.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/plugins.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/reset.css" type="text/css" rel="stylesheet">
<link href="<?php echo site_url();?>assets/admin/css/ui_custom.css" type="text/css" rel="stylesheet">


<?php $this->load->view('dashboard/system_messages');?>
<?php echo form_open('admin/login');?>
        <div class="loginPic">
            <a href="#" title=""></a>
            <span>Login</span>
            <div class="loginActions">
                <div><a href="#" title="Change user" class="logleft flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>
        
        <input type="text" name="username" placeholder="Username" class="loginEmail" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />
        
        <div class="logControl">
            <input type="submit" name="submit" value="<?php echo $this->lang->line('sign_in');?>" class="buttonM bBlue" />
        </div>
<?php echo form_close();?>