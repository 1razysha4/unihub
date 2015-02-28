<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $template['title']; ?></title>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
	var site_url = '<?php echo site_url();?>';
	</script>
	<?php echo $template['metadata']; ?>
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
</head>

<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
        <?php /*?><a href="<?php echo site_url('admin');?>" title="" class="logo"><img src="<?php echo base_url().ADMIN_ASSETS;?>/images/logo.png" alt="" /></a><?php */?>
        
        <!-- Right top nav -->
        
        
        <!-- Responsive nav -->
       
    </div>
</div>
<!-- Top line ends -->


<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">
        <!-- Main nav -->
         <?php $this->load->view('dashboard/menus');?>
    </div>
    
    <!-- Secondary nav -->
</div>
<!-- Sidebar ends -->
    
    
<!-- Content begins -->
<div id="content">
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
            <?php 
					$crumbs = array();
					foreach( $template['breadcrumbs'] as $crumb){
						if($crumb['uri']){
							$crumbs[] = '<li><a href="'.$crumb['uri'].'">'.$crumb['name'].'</a></li>';
						}else{
							$crumbs[] = ($crumb['name'])?'<li><a href="">'.$crumb['name'].'</a></li>':'';
						}
					}
					echo implode('',$crumbs);
					?>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
    	<?php $this->load->view('dashboard/system_messages');?>
    	<?php echo $template['body']; ?>
    </div>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->

</body>
</html>
