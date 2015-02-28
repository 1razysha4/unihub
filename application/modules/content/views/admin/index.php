<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>        
<script type="text/javascript">
function changeStatus(content_id,status){
	if(confirm('Are you sure to approve this post?')){
		var form = document.listForm;
		form.action = '<?php echo site_url('admin/content/changestatus');?>';
		form.content_id.value = content_id;
		form.submit();
	}
}
function Delete(content_id){
	if(confirm('Are you sure to delete this post?')){
		var form = document.listForm;
		form.action = '<?php echo site_url('admin/content/delete');?>';
		form.content_id.value = content_id;
		form.submit();
	}
}
</script>
<div class="widget">
<?php echo form_open('','name="listForm"'); ?>
        <table class="tDark" width="100%">
            <thead>
                <tr>                         
                    <th width="1%">#</th>           
                    <th style="text-align:left">Post</th>
                    <th width="20%" style="text-align:left">University</th>
                    <th width="10%" style="text-align:left">Type</th>
                    <th width="10%">Posted Date</th>                                    
                    <th width="12%" style="text-align:left">Status</th>       
                    <th width="15%" style="text-align:center">Actions</th>                             
                </tr>
            </thead>
            <tbody>
            <?php $i=1;foreach($contents as $content){
                ?>
                <tr>                                 
                    <td><?php echo $this->uri->segment(4)+$i;?></td>   
                    <td style="text-align:left"><?php echo $content->content_name;?></td>
                    <td style="text-align:left"><?php echo $content->university_name;?></td>
                    <td style="text-align:left"><?php echo ($content->content_type==1)?"Event":'';echo ($content->content_type==2)?"Classified":''; ?></td>
                    <td style="text-align:center"><?php echo $content->content_date;?></td>                                    
                    <td style="text-align:left">
                    <?php
                    if($content->content_status==0){
					?>
                    <a class="row-pending" onclick="changeStatus('<?php echo $content->content_id;?>','<?php echo $content->content_status;?>');"><?php echo 'Approval Pending';?></a>
               <?php 
					}else{
						echo 'Aproved';
					}
			   ?>     
                    </td>   
                    <td style="text-align:center" class="tableActs">
                        <a href="<?php echo site_url('admin/content/view/'.$content->content_id);?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
                        <a onclick="Delete('<?php echo $content->content_id;?>')" class="tablectrl_small bRed tipS">Delete <span class="iconb" data-icon="&#xe136;"></span></a>
                    </td>                            
               </tr>
            <?php $i++; }?>    
            </tbody>
            <tfoot>
            	<tr>
                	<td colspan="6"><?php echo $pagination;?></td>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="content_id" id="content_id" value="0" />
    </form>
</div>