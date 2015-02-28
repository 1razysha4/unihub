<?php $this->load->view('includes/header');?>
<!-- container -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h3 class="section-title">Login</h3>
						<?php if($this->session->flashdata('error')){?>
							<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error');?></div>
						<?php } ?>
				<form class="form-light mt-20" role="form" id="login" action="<?php echo site_url();?>user/login" method="post">
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>E-mail</label>
							<input type="text" class="form-control" name="username" placeholder="Username">
						</div>
	
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div>
					</div>
					<input type="submit" class="btn btn-two" name="login" value="Login">
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	jQuery(function ($) {
		 $("#login").validate({
                rules: {
                    username: "required",
                    password: "required",
                },
                messages: {
                    username: "Please enter your username",
                    password: "Please enter password",
 
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
	});
</script>
<?php $this->load->view('includes/footer');?>