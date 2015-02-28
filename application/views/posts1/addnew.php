<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('posts/script'); ?>
<style type="text/css">
#spn_sub_category_select {
	position: relative;
}
#spn_sub_category_select .loading {
	position: absolute;
	left: 0px;
	top: 0;
	width: 100%;
	height: 30px;
	margin: 0 auto;
	text-align: center;
}
.timepicker1, .timepicker2 {
	width:72%!important;
}
.ui-datepicker-next span,.ui-datepicker-prev span{ font-size:0px!important;}
.ui-datepicker-trigger{margin-left:3px;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#category_id').change(function(){
		if($('#category_id').val()==9){
			$('#misc').show();
		}else{
			$('#misc').val('');
			$('#misc').hide();
		}
	});						   
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
			}
		}
	});
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
	
	$("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    <?php if(set_value('type',$this->input->post('type'))==1){?>
	$("#tabs li:first").attr("id","");
	$("#content div").hide();
    $("#tabs li:first").next().attr("id","current");
    $("#content div:first").next().fadeIn();
	<?php } ?>
	<?php if(set_value('type',$this->input->post('type'))==3){?>
	$("#tabs li:first").attr("id","");
	$("#content div").hide();
    $("#tabs li:first").next().next().attr("id","current");
    $("#content div:first").next().next().fadeIn();
	<?php } ?>
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
	
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
<div class="grid_17 alpha">
  <!--Start Cotent-->
  <div class="content" id="dashboard">
    <div id="add_post">
      <h1 class="post_title" style="text-align:center; color:#d65b27;"><?php echo @$this->router->university->university_name;?></h1>
      <div id="wrap">
        <header>
          <ul id="tabs">
            <li><a href="#" title="classified">POST CLASSIFIEDS</a></li>
            <li><a href="#" title="events">POST EVENTS</a></li>
            <li><a href="#" title="board">CREATE THREADS</a></li>
          </ul>
          <div class="clear"></div>
        </header>
        <div class="clear"></div>
        <div id="content">
          <div id="classified">
          		<ul id="products" class="list clearfix">
                    <li class="thumbnail"></li>
                    <li class="thumbnail">
                        <span id="add_post">                                            
                        <h1>Add New Classified Ads</h1>
                                 <?php
				echo form_open('','class="postForm" name="classifiedForm" id="classifiedForm"  enctype="multipart/form-data"');?>
                <span class="label">
                  <label for="classified_subject">Ads Title</label>
                </span>
                <span class="row">
                  <input type="text" required name="classified_subject" id="classified_subject" value="<?php echo set_value('classified_subject');?>" class="validate[required]"/>
                </span>
                <span class="label">
                  <label for="category_id">Select Category</label>
                </span>
                <span class="row"> <?php echo $category_select;?> </span>
              <span class="row">
              	<input style="display:none; width:40%" type="text" name="misc" id="misc" value="" />
              </span>                               
                <span class="label">
                    <label for="file_image">Upload Ad Image</label>
                </span>
                <span class="row">
                    <input type="file" name="file_image" id="file_image" value="" />
                <span class="clear"></span>
                </span>
                
                <span class="label">
                  <label for="classified_description">Description</label>
                </span>
                <span class="row">
                  <textarea requred id="classified_description" name="classified_description" class=""><?php echo set_value('classified_description');?></textarea>
                </span>
                <input type="hidden" name="type" value="2" />
                <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
                &nbsp;&nbsp;
                <input type="submit" name="saveclassified" value="Submit" class="btnSubmit"/>
                </form>
                   
                        </span>
                    </li>
                </ul>
          </div>
          <div id="events">
                <ul id="products" class="list clearfix">
                    <li class="thumbnail"></li>
                    <li class="thumbnail">
		                <span id="add_post">
		                <h1>Add New Event</h1>
        	<?php
            echo form_open('','class="postForm" name="eventForm" id="eventForm"  enctype="multipart/form-data" autocapitalize="off"');?>
            <span class="label">
              <label for="event_name">Event Title</label>
            </span>
            <span class="row">
              <input type="text" class="validate[required] text" name="event_name" id="event_name" value="<?php echo set_value('event_name');?>">
            </span>
            <span class="row">
              <label for="event_location">Location</label>
            </span>
            <span class="row">
              <input type="text" class="validate[required] text" name="event_location" id="event_location" value="<?php echo set_value('event_location');?>" />
            </span>
            <span class="row">
              <label for="event_date">Date</label>
            </span>
            <span class="row" style="display:block">
              <input type="text" class="validate[required] text datepicker" name="event_date" id="event_date" value="<?php echo set_value('event_date');?>" autocomplete="off" style="width:100px; display:inline" />
            </span>
            <span class="row" style="display:block">
              <label for="event_time">Time</label>
            </span>
            <span class="row" style="display:block">
              <input type="text" class="validate[required] text timepicker" name="event_time" id="event_time" value="<?php echo set_value('event_time',$this->input->post('event_time'));?>" autocomplete="off" readonly="readonly"  style="width:100px; display:inline">
              <img style="display:inline;" src="<?php echo base_url('assets/public/img/calendar.gif');?>" class="timepicker_button" />
            </span>
            <span class="label" style="display:block">
              <label for="event_details">Description</label>
            </span>
            <span class="row">
              <textarea class="validate[required] text" name="event_details" id="event_details" style="width:400px;" rows="7"><?php echo set_value('event_details');?></textarea>
            </span>
             <span class="label">
               <label for="cc_image2">Upload Ad Image</label>
             </span>
             <span class="row">
               <input type="file" name="file_image" id="file_image" value="" />
               <span class="clear"></span>
             </span>
            <input type="hidden" name="type" value="1" />
            <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
            &nbsp;&nbsp;
            <input type="submit" name="saveevent" class="btnSubmit" value="Submit"/>
            </form>
                        </span>
                	</li>
                </ul>
          </div>
          <div id="board">
          		<ul id="products" class="list clearfix">
                    <li class="thumbnail"></li>
                    <li class="thumbnail">
		                <span id="add_post">
        		        <h1>Add New Threads</h1>
			<?php echo form_open('','class="postForm" name="threadForm" id="threadForm"  enctype="multipart/form-data"');?>            
                    <span class="label">
                        <label for="thread_name">Thread Title<span class="required">*</span></label>
                    </span>
                    
                    <span class="row">
                        <input type="text" name="thread_name" id="thread_name" class="validate[required]" value="<?php echo set_value('thread_name');?>" />
                    </span>   
                                                   
                    
                   <span style="clear:both;"></span> 
                    <span class="label">
                        <label for="thread_description">Thread Description<span class="required">*</span></label>
                    </span>
                    <span class="row">
                        <textarea class="validate[required]" name="thread_description" id="thread_description"><?php echo set_value('thread_description');?></textarea>           
                        <span class="desc_error"></span>
                    </span>
                    <input type="hidden" name="type" value="3" />
            <input type="hidden" name="university" value="<?php echo @$this->router->university->university_id;?>" />
                <input class="btnSubmit" type="submit" name="savethread" value="Submit">
            </form>
            </span>
                	</li>
                </ul>
                
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <!--End Cotent-->
</div>
