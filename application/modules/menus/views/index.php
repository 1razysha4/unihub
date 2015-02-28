<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <ul class="middleNavA">
            <li><a href="#" title="Add an article"><img src="<?php echo base_url().ADMIN_IMAGES;?>/icons/color/order-149.png" alt="" /><span>New tasks</span></a></li>
            <li><a href="#" title="Upload files"><img src="<?php echo base_url().ADMIN_IMAGES;?>/icons/color/issue.png" alt="" /><span>My invoices</span></a></li>
            <li><a href="<?php echo base_url('admin/users/create');?>" title="Add something"><img src="<?php echo base_url().ADMIN_IMAGES;?>/icons/color/hire-me.png" alt="" /><span>Add users</span></a><strong>8</strong></li>
            <li><a href="#" title="Messages"><img src="<?php echo base_url().ADMIN_IMAGES;?>/icons/color/donate.png" alt="" /><span>Donations</span></a></li>
            <li><a href="#" title="Check statistics"><img src="<?php echo base_url().ADMIN_IMAGES;?>/icons/color/config.png" alt="" /><span>Parameters</span></a></li>
        </ul>
        
<div class="widget">
    <table class="tDark" width="100%">
        <thead>
            <tr>                         
                <th width="1%">#</th>           
                <th width="25%">User Name</th>
                <th width="">Name</th>
                <th width="25%">E-mail</th>
                <th width="10%"></th>                                    
            </tr>
        </thead>
        <tbody>
        <?php $i=1;foreach($menus as $user){?>
            <tr>                                 
                <td><?php echo $i;?></td>   
                <td><?php echo $user->username;?></td>
                <td><?php echo $user->first_name." ".$user->last_name;?></td>
                <td><?php echo $user->email;?></td>
                <td style="text-align:center">
                	<a href="<?php echo base_url();?>admin/users/edit/<?php echo $user->user_id;?>" class="tablectrl_small bBlue tipS" title="Edit"><span class="iconb" data-icon="&#xe1db;"></span></a>
                    <a href="#" class="tablectrl_small bRed tipS" title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a>
                </td>                                    
            </tr>
        <?php $i++; }?>    
        </tbody>
    </table>
</div>