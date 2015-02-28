<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style type="text/css">
.timepicker1,.timepicker2{ width:72%!important;}
</style>
<?php $this->load->view('dashboard/system_messages');?>
<script type="text/javascript">
$(document).ready(function() {
		   
});			
</script>
<?php echo form_open();?>
<img src="<?php echo base_url('assets/public/images/step1.gif');?>"  />
<table width="100%">
<col width="25%"  /><col />
	<tr>
    	<td>Category:</td>
        <td><?php echo $category->category_name;?>[ <a href="<?php echo site_url('posts/addnew');?>">change</a>] </td>
    </tr>
	<tr>
    	<td>Subject:</td>
        <td><input type="text" name="content_subject" value="<?php echo set_value('content_subject'); ?>" class="text-input"  /></td>
    </tr>
    <tr>
    	<td>Price:</td>
        <td><input type="text" name="content_price" value="<?php echo set_value('content_price'); ?>" class="text-input"  /></td>
    </tr>
    <tr>
    	<td>Description:</td>
        <td><textarea rows="10" cols="50" class="forminput" name="content_description"><?php echo set_value('content_description'); ?></textarea></td>
    </tr>
    <tr>
    	<td></td>
        <td><input type="submit" name="next" value="Next" class="button btn-filldetails"  /></td>
    </tr>
</table>
<input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
<input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>" />
<input type="hidden" name="post_university_id" value="<?php echo $this->router->university->university_id;?>" />
<input type="hidden" name="step_no_1" value="1" />
</form>