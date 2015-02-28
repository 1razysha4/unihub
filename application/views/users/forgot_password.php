<!--<script src="<?php echo site_url(); ?>assets/js/jquery-2.1.3.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/jquery_validate.js"></script>-->
<style>
    .msg {
        display: none;
    }
    .error-message{
        color: red;
    }
    .success-message {
        color: green;
    }

</style>
<?php
$this->load->view('includes/newsticker');
$this->load->view('includes/header');
$sessiondata = $this->session->userdata['user_id'];
$user_id  = $sessiondata['id'];
?>
<!-- container -->
<div class="container">
    <div class="row">
<?php if ($title == "Forgot Password"): ?>
            <div class="col-md-12">
                <h3 class="section-title">Forgot Password</h3>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div>
    <?php } ?>
                <form class="form-light mt-20" role="form" id="forgotpassword" action="<?php echo site_url(); ?>user/recoverpassword" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter your e-mail * </label>
                                <input id="email" name="email" type="text" class="form-control required" title="This is a required field" /> 
                                <span class="msg error-message">Please enter a valid email address</span>
                                <span class="msg success-message">You have entered a valid email address</span>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-two" name="submit" value="Submit">
                </form>
            </div>
        <?php endif; ?>
<?php if ($title == "Change Password"): ?>
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3 class="section-title">Change Password</h3>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
    <?php } ?>

                    <form class="form-light mt-20" role="form" id="change-password" action="<?php echo site_url();?>user/changepassword" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Current Password * :</label>
                                    <input name="password" class="form-control" id="password" type="password" /> 
                                </div>
                                <div class="form-group">
                                    <label>New Password *:</label>
                                <input name="newpassword" id="newpassword" type="password" class="form-control" /> 

                                </div>
                                <div class="form-group">
                                <label>Confirm Password:</label><br />
                                <input name="confirmpassword" id="confirmpassword" type="password" class="form-control" /> 
                                </div>
                                
                            </div>
                        </div>
                        <br>
                        <input type="hidden" class="btn btn-two" name="id_user" value="<?php echo isset($user_id) ? $user_id : 0; ?>">
                        <input type="submit" class="btn btn-two" name="submit" value="Submit">
                    </form>
                </div>  

    </div>
        <?php endif;?>
</div>
</div>

<!-- container -->
<script type="text/javascript">
	jQuery(function ($) {
		 $("#change-password").validate({
                rules: {
                    password: {
                    	required: true,
                        minlength: 5
                    },
                    newpassword: {
                        required: true,
                        minlength: 5
                    },
                   confirmpassword: { 
	                   required: true,
	                   equalTo: "#newpassword",
	                   minlength: 5,
           			},
                   
                },
                messages: {
                    password: "Please enter your password",
                    newpassword: {
                        required: "Please enter new password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirmpassword: {
                        required: "Please enter  confirm password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                   
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
	});
</script>
<style type="text/css">
#agree-error {
position: absolute;
left: 15px;
top: 100%;
text-transform: none;
width: 300px;
margin-top: -18px;
}
.error {
	font-style: italic;
	font-size: 12px;
	color: red;
}
</style>
<?php $this->load->view('includes/footer'); ?>