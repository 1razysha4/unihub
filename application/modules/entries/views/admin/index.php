<?php defined('BASEPATH') or die('Direct access script is not allowede');?>

<div class="widget check grid6">
            <div class="whead">
                <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
                <h6>Media table</h6>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
                <thead>
                    <tr>
                        <td><img src="<?php echo base_url(); ?>/assets/admin/images/elements/other/tableArrows.png" alt="" /></td>
                        <td width="50">Name</td>
                        <td class="sortCol"><div>Image<span></span></div></td>
                        <td width="130" class="sortCol"><div>Date<span></span></div></td>
                        <td width="100">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category){?>
                    <tr>
                        <td><input type="checkbox" name="checkRow" /></td>
                        <td><a class="textL"><?php echo $category->category_name;?></a></td>
                        <td  href="images/big.png" title="" class="lightbox"><a href="#" title=""><?php echo $category->category_image;?></a></td>
                        <td><?php echo $category->category_created_ts;?></td>
                        <td class="tableActs">
                            <a href="<?php echo site_url('admin/category/edit/'.$category->category_id);?>" class="tablectrl_small bBlue tipS" title="Edit"><span class="iconb" data-icon="&#xe1db;"></span></a>
                            <a href="#" class="tablectrl_small bRed tipS" title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a>
                        </td>
                    </tr>                    
                    <?php }?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="itemActions">
                                <label>Apply action:</label>
                                <select class="styled">
                                    <option value="">Select action...</option>
                                    <option value="Add">Add</option>
                                    <option value="Edit">Edit</option>
                                    <option value="Delete">Delete</option>
                                </select>
                            </div>
                            <div class="tPages">
                                <?php echo $pagination;?>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>