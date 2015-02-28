<div class="grid_17 alpha">
  <!--Start Cotent-->
  <div class="content" id="dashboard">
    <div class="box-head">
      <h2><?php echo $content_heading;?></h2>
    </div>
    <div class="box-content no-pad">
      <?php if(count($contents) == 0){?>
      <p align="center">You currently have no  posts. <a href="<?php echo site_url('posts/addnew');?>">Post ads now</a></p>
      <?php } else{?>
      <table class="display dataTable">
        <thead>
          <tr>
            <th><?php echo $content_title;?></th>
            <th>Views</th>
            <th>Type</th>
            <th>Date</th>
            <th>Options</th>
          </tr>
        </thead>
        
          <?php echo form_open('','name="postList" method="post"');
						$return = '?return='.base64_encode($this->uri->uri_string());
						$i=1;
						foreach($contents as $content){
							$trstyle=($i%2)?'':'odd';
						?>
                        <tbody>
          <tr class="<?php echo $trstyle;?>">
            <td><?php
				$description=$content->content_name;
				$length_of_description = strlen($description);
				if($length_of_description>=30){
					$whitespaceposition = strpos($description," ",30);
					$description_br = ($whitespaceposition?substr($description,0,$whitespaceposition).'...':$description);
				}
				else{
					$description_br= $description;
				}
				echo $description_br;?></td>
            <td><?php echo $content->content_page_views;?> Views</td>
            <td><?php 
				if($content->content_type=='2'){
					echo 'Classified';
				}elseif($content->content_type==1){
					echo 'Events';
				}elseif($content->content_type==3){
					echo 'Thread';
				}?></td>
            <td><?php echo $content->content_date;?></td>
            <td><?php /*if($content->content_status==1){
									$url = $content->university_slug.'/posts/view/'.$content->content_id;
									$url = $url.$return;*/
								?>
              <?php /*?><a href="<?php echo site_url($url);?>">View</a> <?php */?>
              <?php /* } else{*/
								$url = $content->university_slug.'/posts/edit/'.$content->content_id;
								$url = $url.$return;
							?>
              <?php //} ?>
              <a href="<?php echo site_url($url);?>" title="Edit Ad"><img src="<?php echo base_url('assets/public/img/pencil.png');?>"/></a>&nbsp; <a href="javascript:void();" onclick="Delete('<?php echo $content->content_id;?>')"  title="Delete Ad"><img src="<?php echo base_url('assets/public/img/cross.png');?>"/></a></td>
          </tr>
        </tbody>
          <?php $i++; } ?>
        <input type="hidden" name="content_id" value="0" />
        </form>
        
        <?php if($pagination){?>
        <tbody>
          <tr>
            <td colspan="5">
              <?php echo $pagination; ?>
              </td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
      <?php } ?>
      <p></p>
    </div>
    <div class="clear"></div>
  </div>
  <!--End Cotent-->
</div>
<script type="text/javascript">
function Delete(id){
	if(confirm('Are you sure to delete this post ?')){
		var form = document.postList;
		form.action = '<?php echo site_url('posts/delete');?>';
		form.content_id.value = id;
		form.submit();
	}
}
</script>
