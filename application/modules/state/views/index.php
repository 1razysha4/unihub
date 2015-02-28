<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<ul class="middleNavA">
	<li><a href="<?php echo site_url('admin/state/add');?>" title="Add country"><span class="iconb" data-icon="&#xe078;"></span><span>Add State</span></a></li>
</ul>
<div class="widget">
<?php echo form_open('','name="stateFormList" id="stateFormList"');?>
<table class="tDark" cellpadding="0" cellspacing="0" width="100%">
	<col width="1%" /><col /><col /><col width="15%" /><col width="15%" />
	<thead>
		<tr>
			<td>S.N.</td>
			<td style="text-align:left">State Name</td>
			<td style="text-align:left">Country Name</td>
			<td>Show Front In Page</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($states as $state){
		$trstyle = ($i%2)?' class="even"':' class="odd"';
		?>
	<tr<?php echo $trstyle?>>
		<td><?php echo $i;?></td>
		<td style="text-align:left"><?php echo $state->state_name;?></td>
		<td style="text-align:left"><?php echo $state->country_name;?></td>
		<td style="text-align:center"><?php echo ($state->show_front==1)?'Yes':'No';?></td>
		<td style="text-align:center" class="tableActs">
        <a href="<?php echo site_url('admin/state/edit/'.$state->state_id); ?>" class="tablectrl_small bBlue tipS">Edit <span class="iconb" data-icon="&#xe1db;"></span></a>
        <a onclick="Delete('<?php echo $state->state_id;?>')" class="tablectrl_small bRed tipS" title="Remove">Delete <span class="iconb" data-icon="&#xe136;"></span></a></td>
	</tr>
	<?php $i++; }?>		
	</tbody>
	<tfoot>
		<tr><td colspan="4"><?php echo $navigation;?></td></tr>
	</tfoot>
</table>
<input type="hidden" name="state_id" id="state_id" value="" />
<?php echo form_close();?>
</div>
<script type="text/javascript">
function Delete(state_id){
	if(confirm('Are you sure to delete sate?')){
		var form = document.stateFormList;
		form.state_id.value = state_id;
		form.action = '<?php echo site_url('admin/state/delete');?>';
		form.submit();
	}
}
</script>