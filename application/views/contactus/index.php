<?php
$this->load->view('includes/newsticker');
$this->load->view('includes/header');
?>
<!-- container -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3 class="section-title">Your Message</h3>
            <p>Please contact us if you have any query</p>

            <form class="form-light mt-20" role="form" id="contact_form" action="<?php echo base_url('contactus/save')?>" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Your name">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone number">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" id="message" name="contact_message" placeholder="Write you message here..." style="height:100px;"></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-two" value="Send message">
            </form>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="section-title">Office Address</h3>
                    <div class="contact-info">
                        <h5>Address</h5>
                        <p>5675 Roswell RD 54, Atlanta, GA 30342 - United States</p>

                        <h5>Email</h5>
                        <p>admin@collegewaves.com</p>

                        <h5>Phone</h5>
                        <p>404-717-3334</p>

                        <h5>Fax</h5>
                        <p>404-475-2018</p>
                    </div>
                </div> 
            </div> 						
        </div>
    </div>
</div>
<!-- /container -->
<script type="text/javascript">
	jQuery(function ($) {
		 $("#contact_form").validate({
                rules: {
                    name: {
                    	required: true,
                       
                    },
                    subject: {
                    	required: true,
                       
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_message: {
                        required: true,
                        minlength: 100,
                    },
                 },
                    messages: {
                    name: "Please enter your name",
                    subject: {
                        required: "Please enter subject",
                        
                    },
                    contact_message: {
                        required: "Please enter your message",
                        minlength: "Your message must not be less than 100 characters long"
                    },
                    email: {
                        required: "Please enter a valid email address",
                       
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
	