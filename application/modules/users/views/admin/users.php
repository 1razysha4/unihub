<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>        
<div class="widget">
<script type="text/javascript">
$(document).ready(function(){
});
function Delete(user_id){
	if(confirm('Are you sure to delete this user ?')){
		var form = document.listForm;
		form.user_id.value = user_id;
	 	form.action= '<?php echo site_url('admin/users/delete');?>';
		form.submit();
	}	
}
</script>
<?php echo form_open('listForm','name="listForm" action=""');?>
    <table class="tDark" width="100%">
        <thead>
            <tr>                         
                <th width="1%">#</th>           
                <th width="25%">User Name</th>
                <th width="">Name</th>
                <th width="25%">E-mail</th>
                <th width="5%">Status</th>  
                <th width="15%"></th>                                    
            </tr>
        </thead>
        <tbody>
        <?php $i=1;foreach($users as $user){?>
            <tr>                                 
                <td><?php echo $i;?></td>   
                <td><?php echo $user->username;?></td>
                <td><?php echo $user->name;?></td>
                <td><?php echo $user->email;?></td>
                <td>
                <?php 
				if($user->active==1){?>
					<span class="label label-success">Active&nbsp;&nbsp;</span>
				<?php }else{?>
					<span class="label label-failure">Inactive</span>
				<?php }?>
                </td>
                <td style="text-align:center" class="tableActs">
                	<a href="<?php echo base_url();?>admin/users/edit/<?php echo $user->user_id;?>" class="tablectrl_small bBlue tipS" title="Edit">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
                    <?php if($user->user_id!=$this->session->userdata('user_id')){?>
                    <a onclick="Delete('<?php echo $user->user_id;?>')" class="tablectrl_small bRed tipS" title="Remove">Delete <span class="iconb" data-icon="&#xe136;"></span></a>
                    <?php } ?>
                </td>                                    
            </tr>
        <?php $i++; }?>    
        </tbody>
    </table>
    <input type="hidden" name="user_id" id="user_id" value="0" />
</form>    
</div>