<div><?php echo $this->load->view('usergroups/addgroup');?></div>
<div class="toolbar1">
<form onsubmit="return false">Search <input type="text" name="searchtxt"
	id="searchgrptxt" class="text-input" value=""
	onKeydown="Javascript: if (event.keyCode==13) showGroupTable();" /> <img
	src="<?php echo base_url();?>assets/style/img/icons/search.gif"
	class="searchbtn" onclick="showGroupTable();" /> <span class="message"><span
	class="message_text"></span></span>
</form>
</div>

<div id="grouplist"
	style="display: none;"></div>
