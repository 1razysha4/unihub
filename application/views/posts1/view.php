<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$return = base64_decode($this->input->get('return'));
?>
<script type="text/javascript">
//Flexslider
$(window).load(function() {
    $('.flexslider').flexslider();
	hitpage();
});
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
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="grid_17 alpha">
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
          <li class="cate">In&nbsp;<a href="" rel="tag"><?php echo $content_details->content_name;?></a></li>
          <li class="author">by&nbsp;<?php echo $content_details->username;?><a href="" title="Posts by admin" rel="author">
            <?php ;?>
            </a></li>
        </ul>
        <div class="meta_boxes">
          <div class="meta_slider">
            <div class="flexslider">
              <ul class="slides">
              <?php
				if($content_details->content_image==''){
					$content_details->content_image = 'blank-medium.jpg';
				}
			  ?>
                <li> <img src="<?php echo base_url('uploads/contents/mediumthumbs/'.$content_details->content_image);?>" /> </li>
              </ul>
            </div>
          </div>
          <div class="meta_table">
          <?php if($content_details->content_type==1){?>
            <p align="justify"><strong>Event Date:</strong> <?php echo date('M d Y',strtotime($content_details->content_date));?></p>
            <p align="justify"><strong>Event Time: </strong><?php echo date('h:i a',strtotime($content_details->content_time));?></p>
            <p align="justify"><strong>Event Venue:</strong> <?php echo $content_details->content_location;?></p>
            <?php } ?>
            <p align="justify"> <?php echo $content_details->content_long_desc;?> </p>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
       <ul class="post_meta" style="float:right;">
        <li class="estimate lik_btn">
            <div class="fb-like" data-href="<?php echo $this->uri->uri_string();?>" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
        </li>
        <li class="cate share_btn">
            <div class="fb-share-button" data-type="button_count" data-href="<?php echo site_url($this->uri->uri_string());?>" data-width="100"></div>
        </li>        
        </ul>  
        <div class="clear"></div>
    </div>
  </div>
  <!--End Cotent-->
</div>