<?php
$this->load->library('menus');
?>
<div class="well nav-collapse sidebar-nav">
 <ul class="nav nav-tabs nav-stacked main-menu">
<?php echo $this->menus->printMenu('','','');?>
</ul>  
</div>
