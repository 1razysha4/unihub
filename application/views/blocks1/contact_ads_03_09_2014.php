<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<script src="<?php echo base_url('assets/public/js/jquery.validate.min.js');?>"></script>
<?php
$num1 = rand(1,4);
$num2 = rand(5,9);
$num = $num1+$num2;
?>
<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#lead_form").validate({
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
			},
			captcha:{
				required:true,
				equalTo: "#code"
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
<div class="grid_7 omega">
                <!--Start Sidebar-->
<div class="sidebar">
    <!--Start sidebar_widget-->
<div class="sidebar_widget">
    <div class="contact_widget">
        <div class="subscribe_form">
            <h5 class="contact_header">Contact This Person</h5>
            <div class="form_element">
                <?php 
				echo form_open($this->uri->uri_string().(($this->input->get('return'))?('?return='.$this->input->get('return')):''),'name="lead_form" id="lead_form"');?>
                    <input placeholder="Name" id="name" type="text" name="name"/>
                    <input placeholder="Email" id="email" type="text" name="email"/> 
                    <textarea placeholder="Message" id="message" name="message"></textarea>
                    <input class="captcha" id="captcha" placeholder="Enter Captcha" type="text" name="captcha" value=""/>
                    <input type="hidden" id="code" name="code" value="<?php echo $num;?>"/>
                    <span style="" class="show_captcha"><?php echo $num1;?> + <?php echo $num2;?></span>
                    <div class="clear"></div>                                        
                    <input type="hidden" name="content_id" value="<?php echo $content_details->content_id;?>" />
                    <input type="submit" name="submit"/>                    
                </form>                
            </div>
        </div>
    </div>
</div>

      
            </div>
        </div>