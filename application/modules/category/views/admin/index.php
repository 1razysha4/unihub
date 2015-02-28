<?php defined('BASEPATH') or die('Direct access script is not allowede');?>
<ul class="middleNavA">
            <li><a href="<?php echo site_url('admin/category/create');?>" title="Add an article"><span class="iconb" data-icon="&#xe078;"></span><span>Add Category</span></a></li>
</ul>
<div class="widget check grid6">            
            <table cellpadding="0" cellspacing="0" width="100%" class="tDark" id="checkAll">
            	<col width="1%" /><col  /><col width="10%"  /><col width="15%" />
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Name</td>
                        <td class="sortCol"><div>Date<span></span></div></td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($categories as $category){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td style="text-align:left!important"><?php echo $category->category_name;?></td>                        
                        <td><?php echo $category->category_created_ts;?></td>
                        <td class="tableActs">
                            <a href="<?php echo site_url('admin/category/edit/'.$category->category_id);?>" class="tablectrl_small bBlue tipS" title="Edit">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
                            <a href="#" class="tablectrl_small bRed tipS" title="Remove">Delete <span class="iconb" data-icon="&#xe136;"></span></a>
                        </td>
                    </tr>                    
                    <?php $i++; }?>
                </tbody>
            </table>
        </div>