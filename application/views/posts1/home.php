<script type="text/javascript">
$(document).ready(function($) {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
});
        $(document).ready(function($){
            $("a.switcher").bind("click", function(e){
                e.preventDefault();

                var theid = $(this).attr("id");
                var theproducts = $("ul#products");
                var classNames = $(this).attr('class').split(' ');
                var postmeta = $(".post_meta");
                var text = $(".contents p");
                var gridthumb = "images/products/grid-default-thumb.png";
                var listthumb = "images/products/list-default-thumb.png";

                if($(this).hasClass("active")) {
                    // if currently clicked button has the active class
                    // then we do nothing!
                    return false;
                } else {
                    // otherwise we are clicking on the inactive button
                    // and in the process of switching views!

                    if(theid == "gridview") {
                        $(this).addClass("active");
                        $("#listview").removeClass("active");

                        $("#listview").children("img").attr("src","images/list-view.png");

                        var theimg = $(this).children("img");
                        theimg.attr("src","images/grid-view-active.png");

                        // remove the list class and change to grid
                        theproducts.removeClass("list");
                        theproducts.addClass("grid");
                        postmeta.hide();
                        text.hide();
                        // update all thumbnails to larger size
                        //$("img.thumb").attr("src",gridthumb);
                    }

                    else if(theid == "listview") {
                        $(this).addClass("active");
                        $("#gridview").removeClass("active");

                        $("#gridview").children("img").attr("src","images/grid-view.png");

                        var theimg = $(this).children("img");
                        theimg.attr("src","images/list-view-active.png");
                        postmeta.show();
                        text.show();
                        // remove the grid view and change to list
                        theproducts.removeClass("grid")
                        theproducts.addClass("list");
                        // update all thumbnails to smaller size
                        //$("img.thumb").attr("src",listthumb);
                    } 
                }

            });
        });
        //Crousel
        function mycarousel_initCallback(carousel)
        {
            // Disable autoscrolling if the user clicks the prev or next button.
            carousel.buttonNext.bind('click', function() {
                carousel.startAuto(0);
            });

            carousel.buttonPrev.bind('click', function() {
                carousel.startAuto(0);
            });

            // Pause autoscrolling if the user moves with the cursor over the clip.
            carousel.clip.hover(function() {
                carousel.stopAuto();
            }, function() {
                carousel.startAuto();
            });
        };
        $(document).ready(function() {
            $('#cc_carousel').jcarousel({
                wrap: 'circular',
                scroll: 1,
                auto: 1,
                initCallback: mycarousel_initCallback
            });
        });
    </script>
<div class="grid_24">
  <div id="slider_wrapper">
    <ul id="cc_carousel" class="jcarousel-skin-tango">
    <?php foreach($slider_contents as $content){
		 $url = $content->university_slug.'/posts/view/'.$content->content_id;		
		 if($content->content_image==''){
		 	$content->content_image='blank.jpg';
		 }
		?>
      <li> <a href="<?php echo site_url($url); ?>"><img src="<?php echo base_url('uploads/contents/thumbs/'.$content->content_image);?>" class='postimg ' alt='Post Image'/></a> </li>
      <?php } ?>
    </ul>
  </div>
</div>
<div class="clear"></div>
<div class="grid_24">
  <script type="text/javascript">
                        function show_child(ref){                             
                                jQuery("#sub_child"+ref.id).slideToggle();
                        }
                    </script>
  <div id="categories">
    <?php
	$i=0;
	$k=0;
	$state_id = 0;
	$category_id = 0;
	$col = 1;
	//echo '<pre>';
	//print_r($states);
	foreach($states as $state){
		$style= ($col%4==0)?'style="margin:0px;"':'';
		?>
    <?php if($k%4==0){?><div class="catcol  first" <?php echo $style;?>><?php }?>
    <?php
    if($state->state_id!=$state_id){
	 $k++;
	?>
      <ul class="main">
        <li class="maincat cat-item-<?php echo $state->state_id;?>"><a id="<?php echo $state->state_id;?>" onclick="show_child(this);" href="javascript:void(0);" title=""><?php echo $state->state_name;?>	<span class="add_plus"></span></a> </li><?php } ?>
        
        <?php
    if($state->state_id!=$state_id){
	
	?><ul style="display:none;" id="sub_child<?php echo $state->state_id;?>" class="sub_child"><?php } ?>
          <?php if($state->category_id>0){?>
          <li class="cat-item cat-item-<?php echo $i;?>"><a href="<?php echo site_url('posts/state/'.$state->state_slug.'/'.$state->category_id);?>" title=""><?php echo $state->category_name;?> ( <?php echo $state->total_posts;?> ) </a> </li>
          <?php } ?>
        <?php if($states[$i]->state_id != @$states[$i+1]->state_id){ ?></ul><?php } ?>
      
      <?php if($states[$i]->state_id!=@$states[$i+1]->state_id){?></ul><?php } ?>
    <?php if($k%4==0){ $col++;?></div><?php }?>
    <?php $state_id = $state->state_id;$category_id = $state->category_id; $i++;}?>
  </div>
  <div class="clear"></div>
  <!--Start Cotent-->
  <div class="content">
    <!--Start featured_item-->
    <div class="featured_item">
      <div id="wrap">
        <header>
          <ul id="tabs">
            <li><a href="#" title="recent">RECENTLY LISTED</a></li>
            <li><a href="#" title="popular">POPULAR ADS</a></li>
            <li><a href="#" title="article">ARTICLES</a></li>
          </ul>
          <div class="clear"></div>
        </header>
        <div class="clear"></div>
        <div id="content">
          <div id="recent">
            <ul id="products" class="list clearfix">
              <?php
			  $return  = '';
			  foreach($contents as $content){
				  if($content->content_image==''){
				  	$content->content_image='blank.jpg';
				  }
				  $url = $content->university_slug.'/posts/view/'.$content->content_id.$return;
				  ?>
              <li class="thumbnail">
                <section class="thumbs"> <a href="<?php echo site_url($url); ?>"><img src="<?php echo base_url('uploads/contents/thumbs/'.$content->content_image);?>" class='postimg ' alt='Post Image'/></a>
                  <section class="thumb_item">
                    <div class="clear"></div>
                    <a class="view" href="<?php echo site_url($url); ?>">View it!</a> </section>
                </section>
                <section class="contents">
                  <h6 class="title"><a href="<?php echo site_url($url); ?>" rel="bookmark" title="<?php echo $content->content_name;?>"> <?php echo $content->content_name;?> </a></h6>
                  <section class="grid_content">
                  <?php
				$description=$content->content_long_desc;
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
                    <li class="estimate"><?php echo strtolower(timespan(strtotime($content->content_created_ts)));?> ago</li>
                    <?php if($content->category_name){?>
                    <li class="cate"><a href="<?php echo site_url($url); ?>" rel="tag"><?php echo $content->category_name;?></a></li>
                    <?php } ?>
                    <li class="author">by&nbsp;<a href="<?php echo site_url($url); ?>" title="Posts by <?php echo $content->username;?>" rel="author"><?php echo $content->username;?></a></li>
                  </ul>
                </section>
              </li>
            <?php } ?>
            </ul>
          </div>
          <div id="popular">
            <ul id="products" class="list clearfix">
              <?php 
			   $return  = '';
			  foreach($popular_contents as $content){
				   if($content->content_image==''){
				  	$content->content_image='blank.jpg';
				  }
				  $url = $content->university_slug.'/posts/view/'.$content->content_id.$return;
				  ?>
              <li class="thumbnail">
                <section class="thumbs"> <a href=""><img src="<?php echo base_url('uploads/contents/thumbs/'.$content->content_image);?>" class="postimg" alt="Post Image" /></a>
                  <section class="thumb_item"> <a class="view" href="<?php echo site_url($url); ?>">View it!</a> </section>
                </section>
                <section class="contents">
                  <h6 class="title"><a href="<?php echo site_url($url); ?>" rel="bookmark" title="Permanent Link to <?php echo $content->content_name;?>"><?php echo $content->content_name;?></a></h6>
                  <?php
				$description=$content->content_long_desc;
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
                  <div class="clear"></div>
                  <ul class="post_meta home">
                    <li class="estimate"><?php echo strtolower(timespan(strtotime($content->content_created_ts)));?> ago</li>
                    <?php if($content->category_name){?>
                    <li class="cate"><a href="<?php echo site_url($url); ?>" rel="tag"><?php echo $content->category_name;?></a></li>
                    <?php } ?>
                    <li class="author">by&nbsp;<a href="<?php echo site_url($url); ?>" title="Posts by <?php echo $content->content_name;?>" rel="author"><?php echo $content->username;?></a></a></li>
                  </ul>
                </section>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div id="article">
            <ul id="products" class="list clearfix">
            	<?php foreach($articles as $article){
					$url = 'articles/'.$article->article_alias;
					?>
                <li class="thumbnail">
                <section class="thumbs"> <a href=""><img src="" class='postimg ' alt='Post Image'/></a>
                  <section class="thumb_item">
                    <div class="clear"></div>
                    <a class="view" href="<?php echo site_url($url); ?>">View it!</a> </section>
                </section>
                <section class="contents">
                  <h6 class="title"><a href="<?php echo site_url($url); ?>" rel="bookmark" title=""> <?php echo $article->article_name;?> </a></h6>
                  <section class="grid_content">
                    <p><?php echo $article->article_long_desc;?> [&hellip;]</p>
                  </section>
                  <div class="clear"></div>
                  <ul class="post_meta home">
                    <li class="estimate"><?php echo strtolower(timespan(strtotime($article->article_created_ts)));?> ago</li>
                    <li class="cate"><a href="<?php echo site_url($url); ?>" rel="tag"><?php echo $article->category_name;?></a></li>
                    <li class="author">by&nbsp;<a href="" title="Posts by " rel="author"><?php echo $article->username;?></a></li>
                  </ul>
                </section>
              </li>
              	<?php } ?>
            </ul>
          </div>  
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <!--End featured_item-->
  </div>
  <!--End Cotent-->
</div>
