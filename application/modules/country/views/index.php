<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<ul class="middleNavA">
	<li><a href="<?php echo site_url('admin/country/add');?>" title="Add country"><span class="iconb" data-icon="&#xe078;"></span><span>Add Country</span></a></li>
</ul>
<div class="widget">
<?php echo form_open('','name="countryForm" id="countryList"');?>
<table class="tDark" cellpadding="0" cellspacing="0" width="100%">
	<col width="1%" /><col /><col width="15%" />
	<thead>
		<tr>
			<td>S.N.</td>
			<td>Country Name</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($countries as $country){
		$trstyle = ($i%2)?' class="even"':' class="odd"';
		?>
	<tr<?php echo $trstyle?>>
		<td><?php echo $i;?></td>
		<td><?php echo $country->country_name;?></td>
		<td style="text-align:center" class="tableActs">
        <a href="<?php echo site_url('admin/country/edit/'.$country->country_id); ?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
        <a onclick="Delete('<?php echo $country->country_id;?>')" class="tablectrl_small bRed tipS" title="Remove">Delete <span class="iconb" data-icon="&#xe136;"></span></a></td>
	</tr>
	<?php $i++; }?>		
	</tbody>
	<tfoot>
		<tr><td colspan="4"><?php echo $navigation;?></td></tr>
	</tfoot>
</table>
<input type="hidden" name="country_id" id="country_id" value="" />
<?php echo form_close();?>
</div>
<script type="text/javascript">
function Delete(country_id){
	if(confirm('Are you sure to delete coutry?')){
		var form = document.countryForm;
		form.country_id.value=country_id;
		form.action = '<?php echo site_url('admin/country/delete');?>';
		form.submit();
	}
}
</script>