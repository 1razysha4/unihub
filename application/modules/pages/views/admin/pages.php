<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
function Delete(page_id){
	if(confirm('<?php echo $this->lang->line('delete_confirmation');?>')){
		var form = document.pageForm;
		form.action = base_url+'admin/pages/delete/'+page_id;
		form.submit();
	}
}
</script>
<ul class="middleNavA">
            <li><a href="<?php echo site_url('admin/pages/create');?>" title="Add an article"><span class="iconb" data-icon="&#xe078;"></span><span>Add Page</span></a></li>
        </ul>
<div class="widget">
<div class="box-content">
            	<form method="post" action="<?php echo $this->uri->uri_string();?>" name="pageForm">
                        <div class="widget">
	                        <table class="tDark" width="100%">
	                        	<col width="1%"/><col /><col width="14%" /><col width="14%" /><col width="15%" />
		                        <thead>
			                        <tr>                         
			                        	<th>#</th>           
			                            <th><?php echo $this->lang->line('page');?></th>
			                            <th style="text-align:center">Type</th>
                                        <th style="text-align:center">Status</th> 
			                            <th style="text-align:center"><?php echo $this->lang->line('actions');?></th>                                    
			                        </tr>
			                    </thead>
			                    <tbody>
			                    <?php $i=1; foreach ($pages as $page){?>
			                    <tr>
			                    	<td><?php echo $i;?></td>
			                    	<td><?php echo $page->page_name;?></td>
                                    <td style="text-align:center"><?php echo $page->page_type;?></td>
			                    	<td style="text-align:center">
			                    	<?php 
			                    	if($page->page_active==1){?>
			                    	<span class="label label-success">Active&nbsp;&nbsp;</span>
								<?php }else{?>
								<span class="label label-failure">Inactive</span>
			                    	<?php }?>
			                    	</td>
			                    	<td class="tableActs" style="text-align:center">
			                    	<a href="<?php echo base_url('admin/pages/edit/'.$page->page_id);?>" class="tablectrl_small bBlue tipS"><i class="icon-edit icon-white"></i>Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
	                            <a class="tablectrl_small bRed tipS" onclick="Delete('<?php echo $page->page_id;?>');"><i class="icon-trash icon-white"></i>Delete <span class="iconb" data-icon="&#xe136;"></span></a>                            
			                    	</td>
			                    </tr>
			                    <?php $i++; }?>
			                    </tbody>
	                        </table>
                        </div>
                        </form>
            </div>
