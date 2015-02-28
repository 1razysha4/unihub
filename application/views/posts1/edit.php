<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function() {
	$( ".datepicker" ).datepicker({
			buttonText:'English Calendar',
			autoSize: false,
			showOn: "button",
			buttonImage: "<?php echo base_url();?>assets/public/img/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd',
			beforeShow: function(){    
           	$(".ui-datepicker").css({'font-size': 11, 'line-height': 1.2});
    		}
		});
	$('.timepicker').timepicker({
					showMinutes: true,
                    showPeriod: false,
                    showLeadingZero: true,
					hours: {
						starts: 0,                
						ends: 23                  
					},
					showCloseButton: true,
					closeButtonText: 'Done',
					showNowButton: true,
					nowButtonText: 'Now',
					showOn: 'button',
					button: '.timepicker_button',
					beforeShow: function(){    
						$(".ui-timepicker").css({'font-size': 11, 'line-height': 1.2});
					}
                });
});
function Cancel(){
	window.location = '<?php echo site_url();?>';
}
</script>
<?php $this->load->view('posts/script'); ?>
<div class="grid_17 alpha">
  <!--Start Cotent-->
  <div class="content" id="dashboard">
    <div id="add_post">
      <?php if($content_details->content_type==2){?>
      <script type="text/javascript">
	  $(document).ready(function(){
			var validator = $("#classifiedForm").validate({
			errorPlacement: function(error, element) {
				$( element )
					.closest( "form" )
						.find( "label[for='" + element.attr( "id" ) + "']" )
							.append( error );
			},
			errorElement: "span",
			rules: {
				classified_description: {
					required: true
				},
				category_id: {
					required: true
				}
			},
			messages: {
				classified_subject: {
					required: " (required)",
					minlength: " (must be at least 3 characters)"
				},
				classified_description: {
					required: " (required)"
				},
				category_id:{
					required: "(required)"
				},
				file_image:{
					required: "(required)"
				}
			}
		});
	  })
	  </script>
      <?php echo form_open('','name="edit_post_form" class="classifiedForm" id="classifiedForm"  enctype="multipart/form-data"');?>
      <h1 class="post_title" style="text-align:center; color:#d65b27;"><?php echo @$this->router->university->university_name;?></h1>
      <div class="label">
        <label for="classified_subject">Ads Title</label>
      </div>
      <div class="row">
        <input type="text" class="text required" name="classified_subject" id="classified_subject" value="<?php echo set_value('classified_subject',$content_details->content_name);?>">
      </div>
      <div class="label">
        <label>Select Category</label>
      </div>
      <div class="row"> <?php echo $category_select;?> </div>
      <div class="label">
        <label for="classified_description">Description</label>
      </div>
      <div class="row">
        <textarea class="text required" name="classified_description" id="classified_description" style="width:400px; " rows="14"><?php echo set_value('classified_description',$content_details->content_long_desc);?></textarea>
      </div>
      <!--Start Row-->
      <div class="form_row">
        <div class="label">
          <label for="file_image">Upload Ad Image</label>
        </div>
        <div class="row">
          <input type="file" name="file_image" id="file_image" value="" />
          <?php if(file_exists(FCPATH.'uploads/contents/'.$content_details->content_image)){?>
          <div> <img src="<?php echo base_url('uploads/contents/thumbs/'.$content_details->content_image);?>" /> </div>
          <?php }?>
        </div>
      </div>
      <input type="hidden" name="type" value="2" />
      <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
      <input type="hidden" name="return" value="<?php echo $this->input->get('return');?>" />
      <input type="hidden" name="content_image_old" value="<?php echo $content_details->content_image;?>" />
      <input type="hidden" name="content_id" value="<?php echo $content_details->content_id;?>" />
      <input type="button"  onclick="window.location.href='dashboard'" value="Cancel" />
      &nbsp;&nbsp;
      <input type="submit" name="update" value="Update"/>
      <!--Start Row-->
      <!--End Row-->
      </form>
      <?php } ?>
      <?php if($content_details->content_type==1){?>
      <script type="text/javascript">
	  $(document).ready(function(){
	  	var validator1 = $("#eventForm").validate({
			errorPlacement: function(error, element) {
				$( element )
					.closest( "form" )
						.find( "label[for='" + element.attr( "id" ) + "']" )
							.append( error );
			},
			errorElement: "span",
			rules: {
				event_name: {
					required: true,
					minlength: 3
				},
				event_location: {
					required: true
				},
				event_date:{
					required: true
				},
				event_time:{
					required: true
				},
				event_details:{
					required: true
				}
			},
			messages: {
				event_name: {
					required: " (required)",
					minlength: " (must be at least 3 characters)"
				},
				event_location: {
					required: " (required)"
				},
				event_date:{
					required: "(required)"
				},
				event_time:{
					required: "(required)"
				},
				event_details: {
					required: "(required)"
				}
			}
		});
	  });
	  </script>
      <div id="content" class="content">
        <div class="left-box"> <?php echo form_open('','class="eventForm" id="eventForm" enctype="multipart/form-data"');?>
          <div class="label">
            <label for="event_name">Ads Title</label>
          </div>
          <div class="row">
            <input type="text" class="text required" name="event_name" id="event_name" value="<?php echo set_value('event_name',$content_details->content_name);?>" />
          </div>
          <div class="label">
            <label for="event_location">Location</label>
          </div>
          <div class="row">
          <input type="text" class="text required" name="event_location" id="event_location" value="<?php echo set_value('event_location',$content_details->content_location);?>" />
          </div>
          <div class="label">
            <label for="event_date">Date</label>
          </div>
          <div class="row">
           <input type="text" readonly="readonly" class="text required datepicker" name="event_date" id="event_date" value="<?php echo set_value('event_date',$content_details->content_date);?>" style="width:100px; display:inline;" />           
          </div>
          <div class="label">
            <label for="event_time">Time</label>
          </div>
          <div class="row">
			<input readonly="readonly" type="text" class="text required timepicker" name="event_time" id="event_time" value="<?php echo set_value('event_time',$content_details->content_time);?>" style="width:100px; display:inline;">
            <img class="timepicker_button" src="<?php echo base_url();?>assets/public/img/calendar.gif" />
          </div>
          
          <div class="label">
            <label for="event_details">Event Details</label>
          </div>
          <div class="row">
          	<textarea class="text required" name="event_details" id="event_details" style="width:400px;" rows="7"><?php echo set_value('event_details',$content_details->content_long_desc);?></textarea>
          </div>
          <div class="form_row">
            <div class="label">
              <label for="file_image">Upload Ad Image</label>
            </div>
            <div class="row">
              <input type="file" name="file_image" id="file_image" value="" />
              <?php if(file_exists(FCPATH.'uploads/contents/'.$content_details->content_image)){?>
              <div> <img src="<?php echo base_url('uploads/contents/thumbs/'.$content_details->content_image);?>" /> </div>
              <?php }?>
            </div>
          </div>
          <div class="clr"></div>
          <div id="checksave">
            <p class="submit">
              <input type="hidden" name="type" value="1" />
              <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
              <input type="button" onclick="Cancel()" class="btn_orange" name="register" id="login" value="Cancel">
              <input type="submit" class="btn_orange" name="edit" id="edit" value="Edit">
            </p>
          </div>
          <input type="hidden" name="return" value="<?php echo $this->input->get('return');?>" />
          <input type="hidden" name="content_id" value="<?php echo $content_details->content_id;?>" />
          </form>
          <!-- autofocus the field -->
          <script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>
        </div>
      </div>
      <?php } ?>
      <?php if($content_details->content_type==3){?>
      <script type="text/javascript">
	  $(document).ready(fnction(){
	  		var validator2 = $("#threadForm").validate({
			errorPlacement: function(error, element) {
				$( element )
					.closest( "form" )
						.find( "label[for='" + element.attr( "id" ) + "']" )
							.append( error );
			},
			errorElement: "span",
			rules: {
				thread_name: {
					required: true,
					minlength: 3
				},
				thread_description: {
					required: true
				}
			},
			messages: {
				thread_name: {
					required: " (required)",
					minlength: " (must be at least 3 characters)"
				},
				thread_description: {
					required: " (required)"
				}
			}
		});
	  })
	  </script>
      <?php echo form_open('','name="edit_post_form" class="threadForm" id="threadForm"  enctype="multipart/form-data"');?>
      <h1 class="post_title" style="text-align:center; color:#d65b27;"><?php echo @$this->router->university->university_name;?></h1>
      <div class="label">
        <label for="thread_name">Thread Title</label>
      </div>
      <div class="row">
        <input type="text" class="text required" name="thread_name" id="thread_name" value="<?php echo set_value('classified_subject',$content_details->content_name);?>">
      </div>
      <div class="label">
        <label for="thread_description">Description</label>
      </div>
      <div class="row">
        <textarea class="text required" name="thread_description" id="thread_description" style="width:400px; " rows="14"><?php echo set_value('classified_description',$content_details->content_long_desc);?></textarea>
      </div>
      <!--Start Row-->
      <input type="hidden" name="type" value="3" />
      <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
      <input type="hidden" name="return" value="<?php echo $this->input->get('return');?>" />
      <input type="hidden" name="content_id" value="<?php echo $content_details->content_id;?>" />
      <input type="button"  onclick="window.location.href='dashboard'" value="Cancel" />
      &nbsp;&nbsp;
      <input type="submit" name="update" value="Update" class="btnSubmit"/>
      <!--Start Row-->
      <!--End Row-->
      </form>
      <?php } ?>
      <div class="clear"></div>
    </div>
  </div>
  <!--End Cotent-->
</div>
<?php
//echo '<pre>';
//print_r($content_details);
//echo '</pre>';
?>
<script type="text/javascript">
function Cancel(){
	window.location = '<?php echo site_url(base64_decode($this->input->get('return')));?>';
}
</script>
<?php $this->load->view('posts/script'); ?>
<style type="text/css">
#spn_sub_category_select{position: relative;}
#spn_sub_category_select .loading{position: absolute;left: 0px;top: 0;width: 100%;height: 30px;margin: 0 auto;text-align: center;}
.timepicker1,.timepicker2{ width:72%!important;}
.ui-datepicker-next span,.ui-datepicker-prev span{ font-size:0px!important;}
.ui-datepicker-trigger{margin-left:3px;}
</style>
<?php $this->load->view('posts/script'); ?>
