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
function Delete(university_id){
	if(confirm('Are you sure to delete this university ?')){
		var form = document.listForm;
		form.action = '<?php echo site_url('admin/university/delete');?>';
		form.university_id.value = university_id;
		form.submit();
	}
}
</script>
<ul class="middleNavA">
            <li><a href="<?php echo site_url('admin/university/add');?>" title="Add an article"><span class="iconb" data-icon="&#xe078;"></span><span>Add University</span></a></li>
        </ul>
<form>	
    <div class="formRow">
            <input style="width:200px;" placeholder="Name of university" type="text" name="search" value="<?php echo $this->input->get('search');?>" class="input-xlarge"  />
        </div>
</form>
<div class="widget">
<?php echo form_open('','name="listForm"'); ?>
        <table class="tDark" width="100%">
            <thead>
                <tr>                         
                    <th width="1%">#</th>           
                    <th style="text-align:left">University</th>
                    <th width="20%" style="text-align:left">State</th>                                    
                    <th width="20%" style="text-align:left">Country</th>
                    <th width="15%" style="text-align:center">Actions</th>                                    
                </tr>
            </thead>
            <tbody>
            <?php $i=1;foreach($universities as $university){
                ?>
                <tr>                                 
                    <td><?php echo $this->uri->segment(4)+$i;?></td>   
                    <td style="text-align:left"><?php echo $university->university_name;?></td>
                    <td style="text-align:left"><?php echo $university->state_name;?></td>
                    <td style="text-align:left"><?php echo $university->country_name;?></td>
                    <td class="tableActs" width="5%" style="text-align:center">
                        <a href="<?php echo site_url('admin/university/edit/'.$university->university_id);?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
                        <a onclick="Delete('<?php echo $university->university_id;?>')" class="tablectrl_small bRed tipS">Delete <span class="iconb" data-icon="&#xe136;"></span></a>
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
        <input type="hidden" name="university_id" id="university_id" value="0" />
    </form>
</div>