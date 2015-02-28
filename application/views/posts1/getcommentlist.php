<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(count($comments)>0){
?>
            <ul id="products" class="list clearfix">
              <li class="thumbnail"></li>
              <?php foreach($comments as $comment){
				  if($comment->user_image==""){
				  $comment->user_image = 'avatar.png';
				  }
				  ?>
              <li class="thumbnail">
                <section class="thumbs"> <a href=""><img src="<?php echo base_url('uploads/users/thumbs/'.$comment->user_image);?>" class="" alt="Post Image"></a>
                  <section class="thumb_item">
                    <div class="clear" style="display: none;"></div>
                  </section>
                </section>
                <section class="contents">
                  <h6 class="title"></h6>
                  <section class="grid_content">
                    <p><?php echo $comment->comment_text;?></p>
                  </section>
                  <div class="clear" style="display: none;"></div>
                  <ul class="post_meta home">
                    <li class="estimate"><?php echo strtolower(timespan(strtotime($comment->comment_dt)));?> ago</li>
                    <li class="author">by&nbsp;<a href="" title="Posts by <?php echo $comment->username;?>" rel="author"><?php echo $comment->username;?></a></li>
                  </ul>
                </section>
              </li>
              <?php } ?>
            </ul>
           <div class="navigation"><?php echo $navigation;?></div>
		   <?php /*?> <ul class="paginate">
              <li><a href="" class="current">1</a></li>
              <li><a href="" class="inactive">2</a></li>
              <li><a href="" class="inactive">3</a></li>
              <li><a href="">›</a></li>
              <li><a href="">»</a></li>
            </ul><?php */?>
            
            <script type="text/javascript">
$(document).ready(function(){	
	$(".navigation a").click(function(){
		$("#currentpage").val(this.id);
			getCommentList();
	});
	$('#total_reviews').html('<?php echo $total;?>');
});
</script>
<?php } ?>