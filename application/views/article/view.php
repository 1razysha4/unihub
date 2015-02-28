<?php defined('BASEPATH') or die('Direct access is not allowed');?>
<?php
if(strlen($article->article_image)==0){
	$article->article_image='blank-medium.jpg';
}
?>
<script type="text/javascript">
//Flexslider
$(window).load(function() {
    $('.flexslider').flexslider();
	hitpage();
});
function hitpage(){
	var article_id = '<?php echo $article->article_id;?>';
	var csrf_test_name ='<?php echo  $this->security->get_csrf_hash(); ?>';
	var params='csrf_test_name='+csrf_test_name+'&article_id='+article_id+"&content_type=article&unq="+ajaxunq();
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
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="content">
                                                <!--Start Post-->
                            <div class="post classi">           
                                <div class="post_content">
                                	
                                    <h3 class="post_title" style="border:none;"><?php echo $article->article_name;?></h3>
                                    <span class="price_meta">
                                        <span class="price_left"></span><span class="price_center"><?php echo $article->article_page_views;?> views</span><span class="price_right"></span></span>                                     <ul class="post_meta">
                                        <li class="estimate"><?php echo strtolower(timespan(strtotime($article->article_created_ts)));?> ago</li>
                                       
                                        <li class="author">by&nbsp;<a href="" title="Posts by admin" rel="author">admin</a></li>
                                    </ul>  

                                    <div class="meta_boxes">
                                        <div class="meta_slider">
                                            <div class="flexslider">
                                                <ul class="slides">
                                                	<li> <img src="<?php echo base_url('uploads/articles/mediumthumbs/'.$article->article_image);?>" lass="postimg" /> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="meta_table">
                                          
                                                                	<p align="justify">
                                                                    <?php echo $article->article_long_desc;?>
                                                                    </p>
                                                                
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>                                                                       
                                </div>
                                <ul class="post_meta" style="float:right;">
                                        <li class="estimate like_btn">
                                        	<div class="fb-like" data-href="<?php echo $this->uri->uri_string();?>" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                                        </li>
                                        <li class="cate share_btn">
                                        	<div class="fb-share-button" data-type="button_count" data-href="<?php echo site_url($this->uri->uri_string());?>" data-width="100"></div>
                                        </li>
                                       
                                    </ul>  
                                    <div class="clear"></div>
                            </div>
                </div>
<?php if($article->show_fb_comment == 1){?>                
<div id="fb-root"></div>
<?php /*?><script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><?php */?>
<div class="fb-comments" data-href="<?php echo site_url($this->uri->uri_string());?>" data-numposts="5" data-colorscheme="light"></div><?php } ?>                