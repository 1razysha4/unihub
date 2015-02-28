			<table style="width: 100%;" class="tDark">

				<tr>
					<th scope="col" class="first"><?php echo $this->lang->line('name'); ?></th>
					<th scope="col"><?php echo $this->lang->line('description'); ?></th>
					<th scope="col"><?php echo $this->lang->line('version'); ?></th>
					<th scope="col"><?php echo $this->lang->line('author'); ?></th>
					<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
				</tr>

				<?php foreach ($modules as $module) { ?>

				<tr>
					<td class="first"><?php if ($module->module_enabled) { echo anchor($module->module_path, $module->module_name); } else { echo $module->module_name; } ?></td>
					<td><?php echo $module->module_description; ?></td>
					<td>
						<?php if($module->module_version < $module->module_available_version) {
							echo anchor('admin/mcb_modules/upgrade/' . $module->module_path, $module->module_version . ' - ' . $this->lang->line('upgrade') . ' (' . $module->module_available_version .')', array('style'=>'color: red; font-weight: bold;'));
						}
						else {
							echo $module->module_version;
						} ?>
					</td>
					<td><a href="<?php echo $module->module_homepage; ?>"><?php echo $module->module_author; ?></a></td>
					<td class="last"><?php if($module->module_enabled) {echo anchor('admin/mcb_modules/uninstall/' . $module->module_path, $this->lang->line('uninstall'));}else {echo anchor('admin/mcb_modules/install/' . $module->module_path, $this->lang->line('install'));} ?></td>
				</tr>

				<?php } ?>

			</table>