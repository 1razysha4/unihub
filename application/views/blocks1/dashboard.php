<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
            <div class="grid_7 omega">
                <div class="sidebar">
                        <div class="sidebar_dashboard">
        <h2 class="head">Account Information</h2>
        <div class="author-meta">
            <img alt='' src='<?php
             if(isset($user->user_image)){
             	echo ($user->user_image && file_exists(FCPATH.('uploads/users/thumbs/'.$user->user_image)))?base_url('uploads/users/thumbs/'.$user->user_image):base_url('assets/public/img/avatar.png');
             }
             ?>' class='avatar avatar-40 photo' height='40' width='40' />            <h4>Welcome,&nbsp;<?php echo $this->session->userdata('user_name');?></h4>
            <small>Member Since :&nbsp;<?php echo date('d/m/y',strtotime($this->session->userdata('created_dt')));?>            </small>
        </div>                          
    </div>
    <div class="sidebar_dashboard">
        <h2 class="head">User Options</h2>                         
        <ul class="dash-list">
            <li class="addnew"><a href="<?php echo site_url('posts/addnew');?>">Add Classifieds / Events / Threads</a></li>
            <li class="view"><a href="<?php echo site_url('dashboard/classified');?>">View Classifieds</a></li>
            <li class="comment"><a href="<?php echo site_url('dashboard/events');?>">View Events</a></li>
            <li class="lead"><a href="<?php echo site_url('dashboard/threads');?>">View Threads</a></li>
            <li class="profile"><a href="<?php echo site_url('profile');?>">Edit Profile</a></li>
        </ul>
    </div>
</div>
</div>