<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="grid_24">
  <!--Start Cotent-->
  <div class="content">
    <!--Start Post-->
    <div class="post classi">
      <div class="post_content">
        <h1 class="post_title" style="text-align:center; color:#d65b27;"><?php echo $content_details->university_name;?></h1>
        <h3 class="post_title" style="border:none;"><?php echo $content_details->content_name;?></h3>
        <span class="price_meta"> <span class="price_left"></span><span class="price_center"><?php echo $content_details->content_page_views;?> views</span><span class="price_right"></span></span>
        <ul class="post_meta">
          <li class="estimate"><?php echo strtolower(timespan(strtotime($content_details->content_created_ts)));?> ago</li>
          <li class="cate">post&nbsp;<a href="" rel="tag">[<span id="total_reviews">0</span>]</a></li>
          <li class="author">by&nbsp;<a href="" title="Posts by admin" rel="author"><?php echo $content_details->username;?></a></li>
        </ul>
        <div id="content">
          <div id="commentlist" style="display:none;">          
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <?php if($this->session->userdata('user_id')>0) {?>
    <div id="fotget_pw">
      <h1 class="form_tag">Drop Your Reply</h1>
      <div id="contact">
      <div id="message"></div>
      <?php
      echo form_open('class="contactform" method="post" id="contactForm" onsubmit="return false"');
	  ?>
          <label for="commentsText">Your Message <span class="required">*</span></label>
          <br>
          <textarea name="comments" id="comments" rows="20" cols="30"></textarea>
          <span id="comment_error"></span> <br />
          <input type="checkbox" name="emailnotify" id="emailnotify" checked="checked">
          Check here to get notification when someone replies to this thread. <br>
          <input class="btnSubmit" type="submit" onclick="comment()" name="submit" value="Submit" style="margin-bottom:15px;">
        </form>
      </div>
    </div>
    <?php } ?>
	<input type="hidden" name="currentpage" id="currentpage" value="0">
  </div>
  <!--End Cotent-->
  <div class="grid_7 omega">
    <!--Start Sidebar-->
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){	
	getCommentList();
});
function getCommentList(){
	var content_id = '<?php echo $content_details->content_id;?>';		
	var currentpage = $('#currentpage').val();
	var params='content_id='+content_id+"&currentpage="+currentpage+"&unq="+ajaxunq();
	$.ajax({			
			type	:	"GET",
			url		:	base_url+"ajax/getcommentlist",
			data	:	params,
			success	:	function (data){
							if(data){
								$('#commentlist').html(data);
								$('#commentlist').slideDown();
								hitpage();
							}
				}								
	});
}
function comment(){
	var comment_resource_id = '<?php echo $content_details->content_id;?>';					   
	var comment_resource_type = 'content';
	var comments = $('#comments').val();
	if(comments){
		$('#message').html('');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		var emailnotify = $('#emailnotify').val();
		var params='csrf_test_name='+csrf_test_name+'&comment_resource_id='+comment_resource_id+"&comment_resource_type="+comment_resource_type+"&comments="+comments+"&unq="+ajaxunq();
		$.ajax({			
				type	:	"POST",
				url		:	base_url+"ajax/comment",
				data	:	params,
				success	:	function (data){
						$('#message').html(data);
						$('#comments').val('');
						$('#comments').focus()
						getCommentList();
					}								
		});
	}else{
		$('#message').html('<p class="notification">The Comments field is required.</p>');
	}
}
function hitpage(){
	var content_id = '<?php echo $content_details->content_id;?>';
	var csrf_test_name ='<?php echo  $this->security->get_csrf_hash(); ?>';
	var params='csrf_test_name='+csrf_test_name+'&content_id='+content_id+"&content_type=content&unq="+ajaxunq();
		$.ajax({			
				type	:	"POST",
				url		:	base_url+"ajax/hitpage",
				data	:	params,
				success	:	function (data){
					}								
		});
}
</script>