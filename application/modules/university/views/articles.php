<?php $this->load->view('/includes/header');?>

 <!-- container -->
    <section class="container">
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
            <div style="height:200px;width:150px;">
                <img src="<?php echo $cimage;?>">
            </div>
                <h3>
                    <?php echo $rec['content_name'];?>
                </h3>
                <hr />
                <p>;
                  <?php echo nl2br($rec['content_long_desc']);?>
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

