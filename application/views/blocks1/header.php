<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php
$this->load->model(array('pages/mdl_pages'));
$pages_header = $this->mdl_pages->getPages('header');
?>
<div class="grid_24">
  <div class="top_header">
    <ul id="user_acces">
    <?php if($this->session->userdata('user_id')){?>
    <li class="dashboard"><a href="<?php echo site_url('dashboard');?>">My Dashboard</a></li>
    <li class="logout"><a href="<?php echo site_url('logout');?>">Logout</a></li>
	<?php }else{?>
      <li class="login"><a href="<?php echo site_url('login');?>">Login</a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="header">
    <div class="grid_16 alpha">
      <div class="logo"> <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/public/img/logo.png');?>" alt="" /></a></div>
    </div>
    <div class="grid_8 omega">
      <div class="post_btn"> <a class="post_add_btn" href="<?php echo site_url(@$this->router->university->university_slug.'/posts/addnew');?>"><span class="btn_left"></span><span class="btn_center">POST NEW ADS</span><span class="btn_right"></span></a> </div>
    </div>
    <div class="clear"></div>
    <!--Start Menu Wrapper -->
    <div class="menu_wrapper"> <menu id="menu"><a href="#" class="mobile_nav closed">Pages Navigation Menu<span class="tip"></span></a>
      <ul class="ddsmoothmenu">
        <?php foreach($pages_header as $page){?>
        <li class="page_item page-item-259"><a href="<?php echo site_url().$page->page_slug;?>"><?php echo $page->page_name;?></a></li>
        <?php }?>
      </ul>
      </menu>
      <div class="clear"></div>
    </div>
    <!--End Menu Wrapper-->
    <div class="clear"></div>
    
  </div>
</div>
