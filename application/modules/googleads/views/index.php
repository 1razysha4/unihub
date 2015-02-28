<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<ul class="middleNavA">
	<li><a href="<?php echo site_url('admin/googleads/add');?>" title="Add googleads"><span class="iconb" data-icon="&#xe078;"></span><span>Add Google Ad</span></a></li>
</ul>
<div class="widget">
<?php echo form_open('','name="googleadFormList" id="stateFormList"');?>
<table class="tDark" cellpadding="0" cellspacing="0" width="100%">
	<col width="1%" /><col /><col width="15%" /><col width="15%" />
	<thead>
		<tr>
			<td>S.N.</td>
			<td style="text-align:left">Google Ads</td>
			<td style="text-align:left">Page</td>
            <td style="text-align:center">Active</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($googleads as $googlead){
		$trstyle = ($i%2)?' class="even"':' class="odd"';
		?>
	<tr<?php echo $trstyle?>>
		<td><?php echo $i;?></td>
		<td style="text-align:left"><?php echo $googlead->google_ad_title;?></td>
		<td style="text-align:left"><?php echo $googlead->page;?></td>
        <td style="text-align:center">
        <?php 
		if($googlead->google_ad_active==1){?>
			<span class="label label-success">Active&nbsp;&nbsp;</span>
		<?php }else{?>
			<span class="label label-failure">Inactive</span>
		<?php }?>
        </td>
		<td style="text-align:center" class="tableActs">
        <a href="<?php echo site_url('admin/googleads/edit/'.$googlead->google_ad_id); ?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
        <a onclick="Delete('<?php echo $googlead->google_ad_id;?>')" class="tablectrl_small bRed tipS" title="Remove">Delete <span class="iconb" data-icon="&#xe136;"></span></a></td>
	</tr>
	<?php $i++; }?>		
	</tbody>
	<tfoot>
		<tr><td colspan="4"><?php echo $navigation;?></td></tr>
	</tfoot>
</table>
<input type="hidden" name="google_ad_id" id="google_ad_id" value="" />
<?php echo form_close();?>
</div>
<script type="text/javascript">
function Delete(google_ad_id){
	if(confirm('Are you sure to delete sate?')){
		var form = document.googleadFormList;
		form.google_ad_id.value = google_ad_id;
		form.action = '<?php echo site_url('admin/googleads/delete');?>';
		form.submit();
	}
}
</script>