<?php $this->load->view('/includes/header');?>
  <!--tab module -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquerymobile-tabs.css">
  <script type='text/javascript' src='<?php echo site_url();?>assets/js/jquery-1.11.1.min.js'></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/tabmodule.js"></script>
 <!-- container -->
     <?php /* <section class="container">
<?php 
if(is_array($university)){
    if($university[0]['university_image']!='')
        $image = site_url().'uploads/university/mediumthumbs/'.$university[0]['university_image'];
    else
        $image  = site_url().'assets/images/fallback.jpg';

} ?>
<div style="height:200;width:150px;">
    <img src="<?php echo $image;?>">
</div>

<h3><?php echo $university[0]['university_name'];?></h3>
<hr/>


   <?php  if(is_array($recordData)){
      foreach($recordData as $rec):
    ?>
        <div class="row">
            <!-- main content -->
            <section class="col-sm-8 maincontent">
            <?php 
                if($rec['content_image']!='')
                    $cimage = site_url().'uploads/contents/mediumthumbs/'.$rec['content_image'];
                else
                    $cimage = site_url().'assets/images/fallback.jpg';
            ?>
            <div style="height:100px;width:100px;">
                <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><img src="<?php echo $cimage;?>"></a>
            </div>

                <h3>
                    <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><?php echo $rec['content_name'];?></a>
                </h3>
                <hr />
                <p>
                  <?php echo substr(nl2br($rec['content_long_desc']),0,150);?>
                </p>         
                <!--End Cotent-->       
            </section>
            <!-- /main -->
        </div>
<?php 
    endforeach;
    }else{
      echo '<div class="row"><section class="col-sm-8 maincontent"><p>No data found</p></section></div>';
    }
  ?>
    </section> */?>
<div class="container clearfix">
    <div class="col-md-8">
    <?php 
if(is_array($university)){
    if($university[0]['university_image']!='')
        $image = site_url().'uploads/university/mediumthumbs/'.$university[0]['university_image'];
    else
        $image  = site_url().'assets/images/fallback.jpg';

} ?>
    <h3><?php echo $university[0]['university_name'];?></h3>
        <div class="row">
            <div class="col-md-6">
            <img src="<?php echo $image;?>" class="img-responsive">
                
            </div>
            <div class="col-md-6">
                <p>
Perspiciatis unde omnis iste natus error sit voluptatem. Cum sociis natoque penatibus et magnis dis parturient montes ascetur ridiculus musull dui.</p>


            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
               <div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Classfied</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Discussion Board</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Events</a></li>
  
  </ul>

  <!-- Tab panes -->
 
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
            <?php  
            if(is_array($recordData)){
                foreach($recordData as $rec):
                    if($rec['content_image']!='')
                        $cimage = site_url().'uploads/contents/mediumthumbs/'.$rec['content_image'];
                    else
                        $cimage = site_url().'assets/images/fallback.jpg';
            ?>
            <div style="height:100px;width:100px;">
                <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><img src="<?php echo $cimage;?>"></a>
            </div>

                <h3>
                    <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><?php echo $rec['content_name'];?></a>
                </h3>
                <hr />
                <p>
                  <?php echo substr(nl2br($rec['content_long_desc']),0,150);?>
                </p>
                <?php
                    endforeach; 
                    } else { ?>
                  <p>No data found</p>
                <?php } ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
          <?php  
            if(is_array($recordData)){
                foreach($recordData as $rec):
                    if($rec['content_image']!='')
                        $cimage = site_url().'uploads/contents/mediumthumbs/'.$rec['content_image'];
                    else
                        $cimage = site_url().'assets/images/fallback.jpg';
            ?>
            <div style="height:100px;width:100px;">
                <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><img src="<?php echo $cimage;?>"></a>
            </div>

                <h3>
                    <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><?php echo $rec['content_name'];?></a>
                </h3>
                <hr />
                <p>
                  <?php echo substr(nl2br($rec['content_long_desc']),0,150);?>
                </p>
                <?php
                    endforeach; 
                    } else { ?>
                  <p>No data found</p>
                <?php } ?>
    
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
         <?php  
            if(is_array($recordData)){
                foreach($recordData as $rec):
                    if($rec['content_image']!='')
                        $cimage = site_url().'uploads/contents/mediumthumbs/'.$rec['content_image'];
                    else
                        $cimage = site_url().'assets/images/fallback.jpg';
            ?>
            <div style="height:100px;width:100px;">
                <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><img src="<?php echo $cimage;?>"></a>
            </div>

                <h3>
                    <a href="<?php echo site_url();?>university/articles/<?php echo $rec['content_alias'];?>"><?php echo $rec['content_name'];?></a>
                </h3>
                <hr />
                <p>
                  <?php echo substr(nl2br($rec['content_long_desc']),0,150);?>
                </p>
                <?php
                    endforeach; 
                    } else { ?>
                  <p>No data found</p>
                <?php } ?>

    </div>
  </div>

</div>
            </div>


        </div>
    </div>
    <div class="col-md-4">
    <script type="text/javascript">
		$(document).ready(function(){
			 tabModule.init();
		});
	</script>
<div class="demo">
		<div class="tab tab-horiz">
			<ul class="tab-legend">
				<li class="active">Latest Posts</li>
				<li>Recent Posts</li>
				
			</ul>
			<ul class="tab-content">
				<li>
					<!--TAB CONTENT-->
					<h4>Content</h4>
				</li>
				<li>
					<!--TAB CONTENT-->
					<h4>Content</h4>
				</li>
				
			</ul>
		</div>
	</div>
    </div>

</div>



    <?php $this->load->view('/includes/footer');?>

