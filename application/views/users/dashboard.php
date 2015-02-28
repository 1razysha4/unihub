<?php 
$this->load->view('includes/newsticker');
$this->load->view('includes/header');

?>

          <!-- container -->
    <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="section-title">Welcome to User Dashboard.</h3>
                        <p><a href="<?php echo site_url();?>user/logout">Logout</a></p>
                       
                    </div>
                        <div class="col-md-4">
  <h3>Profile Settings</h3>
  <ul class="list-group">
  <li class="list-group-item"><a href="<?php echo site_url();?>user/changepassword">Change Password</a></li>
  
</ul>
    </div>

                </div>
            </div>
    <!-- /container -->
<?php $this->load->view('includes/footer');?>