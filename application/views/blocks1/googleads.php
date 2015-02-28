<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php if($this->router->details->show_google_ad==1){ ?>
<div class="clear"></div>
<div id="categories" style="padding:0px;">
  <div class="catcoladd"<?php if($this->uri->segment(1)=='contact-us' || $this->uri->segment(1)=='feedback'){ echo ' style="width:auto!important"';}?>>
  <?php echo $this->router->details->google_ad_html;?>
  </div>
</div>
<div class="clear"></div>
<?php } ?>