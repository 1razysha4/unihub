<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function(){
	$('#category_id').change(function(){searchByCategory('classified'); })
});
function searchByCategory(type){
	var category_id = $('#category_id').val();
	if(type == 'classified'){
		if($('#category_id').length>0){
			window.location='<?php echo site_url($this->router->university->university_slug.'/posts');?>/'+type+'/'+category_id;
		}else{
			window.location='<?php echo site_url($this->router->university->university_slug.'/posts');?>/'+type;
		}
	}else{
		window.location='<?php echo site_url($this->router->university->university_slug.'/posts');?>/'+type;
	}
}
</script>
<div class="content">
  <h1 class="post_title" style="text-align:center; color:#d65b27;"></h1>
  <!--Start featured_item-->
  <div class="featured_item">
    <div id="wrap">
      <header>
      <?php $type = $this->uri->segment(3);
		$type = ($type!='events')?'classified':$type;
		?>
        <div class="clear"></div>
      </header>
      <div class="clear"></div>
      <div id="content">
        <div id="classified">
          <ul id="products" class="list clearfix">           
           <?php                 
							$return  = '?return='.base64_encode($this->uri->uri_string());
							
							$i=1; foreach($posts as $post){
							$url = $post->university_slug.'/posts/view/'.$post->content_id.$return;
							?>
            <li class="thumbnail">
              <section class="thumbs"> <a href="<?php echo site_url($url); ?>"><img src="<?php echo base_url('uploads/contents/thumbs/'.$post->content_image); ?>" class="postimg" alt='Post Image'/></a>
                <section class="thumb_item">
                  <div class="clear"></div>
                  <a class="view" href="<?php echo site_url($url);?>">View it!</a> </section>
              </section>
              <section class="contents">
                <h6 class="title"><a href="<?php echo site_url($url);?>" rel="bookmark" title="Permanent Link to South Eastern Cargo Movers And packers Bangalore"><?php echo $post->content_name;?></a></h6>
                <section class="grid_content">
                <?php
				$description=$post->content_long_desc;
				$length_of_description = strlen($description);
				if($length_of_description>=200){
					$whitespaceposition = strpos($description," ",200);
					$description_br = ($whitespaceposition?substr($description,0,$whitespaceposition):$description);
				}
				else{
					$description_br= $description;
				}
				?>
                  <p><?php echo $description_br;?> [&hellip;]</p>
                </section>
                <div class="clear"></div>
                <ul class="post_meta home">
                  <li class="estimate"><?php echo strtolower(timespan(strtotime($post->content_created_ts)));?> ago</li>
                  <li class="cate"><a href="" rel="tag"><?php echo $post->category_name;?></a></li>
                  <li class="author">by&nbsp;<a href="" title="Posts by <?php echo $post->posted_by;?>" rel="author"><?php echo $post->posted_by;?></a></li>
                </ul>
              </section>
            </li>
           <?php } ?>
          </ul>
          <?php echo $navigation;?>
        </div>        
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <!--End featured_item-->
</div>
