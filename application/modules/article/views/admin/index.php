<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>        
<script type="text/javascript">
function changeStatus(article_id,status){
	if(confirm('Are you sure to approve this post?')){
		var form = document.listForm;
		form.action = '<?php echo site_url('admin/article/changestatus');?>';
		form.article_id.value = article_id;
		form.submit();
	}
}
function Delete(article_id){
	if(confirm('Are you sure to delete this post?')){
		var form = document.listForm;
		form.action = '<?php echo site_url('admin/article/delete');?>';
		form.article_id.value = article_id;
		form.submit();
	}
}
</script>
<ul class="middleNavA">
	<li><a href="<?php echo site_url('admin/article/add');?>" title="Add Article"><span class="iconb" data-icon="&#xe078;"></span><span>Add Article</span></a></li>
</ul>
<div class="widget">
<?php echo form_open('','name="listForm"'); ?>
        <table class="tDark" width="100%">
            <thead>
                <tr>                         
                    <th width="1%">#</th>           
                    <th style="text-align:left">Article Title</th>
                    <th width="20%" style="text-align:left">Category</th>
                    <th width="12%" style="text-align:left">Status</th>       
                    <th width="15%" style="text-align:center">Actions</th>                             
                </tr>
            </thead>
            <tbody>
            <?php $i=1;foreach($articles as $article){
                ?>
                <tr>                                 
                    <td><?php echo $this->uri->segment(4)+$i;?></td>   
                    <td style="text-align:left"><?php echo $article->article_name;?></td>
                    <td style="text-align:left"><?php echo $article->category_name;?></td>
                    <td style="text-align:left">
                    <?php 
						if($article->article_status==1){?>
						<span class="label label-success">Active&nbsp;&nbsp;</span>
					<?php }else{?>
					<span class="label label-failure">Inactive</span>
						<?php }?>
                    </td>   
                    <td style="text-align:center" class="tableActs">
                        <a href="<?php echo site_url('admin/article/edit/'.$article->article_id);?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
                        <a onclick="Delete('<?php echo $article->article_id;?>')" class="tablectrl_small bRed tipS">Delete <span class="iconb" data-icon="&#xe136;"></span></a>
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
        <input type="hidden" name="article_id" id="article_id" value="0" />
    </form>
</div>