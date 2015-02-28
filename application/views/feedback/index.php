<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#contactForm").validate({
		errorPlacement: function(error, element) {
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
		},
		errorElement: "span",
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email:true
			},
			message:{
				required: true
			}
		},
		messages: {
			name: {
				required: " (required)",
				minlength: " (must be at least 3 characters)"
			},
			email: {
				required: " (required)"
			},
			message:{
				required: "(required)"
			}
		}
	});
});
function Cancel(){
	window.location = '<?php echo site_url();?>';
}
</script>
<div class="grid_24">
            <div class="grid_15 alpha">
                <!--Start Cotent-->
                <div class="content">
                    <h1 class="page_title"><?php echo $title;?></h1>
                                                                                    <div id="contact">
                                                                                    <?php echo form_open(site_url($this->uri->uri_string()),'class="contactForm" id="contactForm"'); ?>
                                <label for="name">Your Name <span class="required">*</span></label>
                                <br/>
                                                        
                                <input type="text" name="name" id="name" value="" />
                                <span id="username_error"></span>
                                <br/>
                                <label for="email">Your Email: <span class="required">*</span></label>
                                <br/>
                                                        
                                <input type="text" name="email" id="email" value="" />
                                <span id="email_error"></span>
                                <br/>
                                
                                <label for="message">Your Message <span class="required">*</span></label>
                                <br/>
                                                                <textarea name="message" id="message" rows="20" cols="30"></textarea>
                                <span id="comment_error"></span>
                                <br/>
                                <input  class="btnSubmit" type="submit" name="submit" value="Submit"/>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                            </form>
                         
                    </div>
                </div>
                <!--End Cotent-->
            </div>   
            <div class="grid_9 alpha">
             <?php echo $template['partials']['googleads_2']; ?>
             </div>         
        </div>