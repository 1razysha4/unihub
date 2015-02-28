<?php $this->load->view('includes/header');?>
<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3 class="section-title">Create an Account</h3>
						<?php if($this->session->flashdata('success')){?>
							<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success');?></div>
						<?php } ?>

						<form class="form-light mt-20" role="form" id="register" action="<?php echo site_url();?>user/register" method="post">
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" name="username" placeholder="Username">
									</div>
									<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="emailaddress" placeholder="Email address">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
								<div class="form-group">
									<label>Confrim Password</label>
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
								</div>
								<div class="form-group">
									<!-- <label>Confrim Password</label> -->
									<!-- <input type="password" class="form-control" name="confirm_password" placeholder="Confrim Password"> -->
									<input type="checkbox" name="agree">I agree <a href="javascript:void(0);" id="terms-condition"> terms and conditions </a>
								</div>
							</div>
							</div>
							<br>
							<input type="submit" class="btn btn-two" name="submit" value="Register">
						</form>
					</div>
				</div>
			</div>
	<!-- /container -->
<script type="text/javascript">
	jQuery(function ($) {
		 $("#register").validate({
                rules: {
                    username: {
                    	required: true,
                        minlength: 5
                    },
                    emailaddress: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                   confirm_password: { 
	                   	required: true,
	                    equalTo: "#password",
	                     minlength: 5,
           			},
                    agree: "required"
                },
                messages: {
                    username: "Please enter your username",
                    password: {
                        required: "Please enter password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please enter  confirm password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    emailaddress: "Please enter a valid email address",
                    agree: "Please accept our terms and condition"
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
<?php $this->load->view('includes/footer');?>