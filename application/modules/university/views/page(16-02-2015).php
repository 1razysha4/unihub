<?php $this->load->view('/includes/header');?>

 <!-- container -->
    <section class="container">
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
    </section>

    <?php $this->load->view('/includes/footer');?>

