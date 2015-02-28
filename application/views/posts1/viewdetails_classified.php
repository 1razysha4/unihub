<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<img src="<?php echo base_url('assets/public/images/step2.gif');?>"  />
<?php echo form_open();?>

Subject: <?php echo $content_subject;?>
<input type="hidden" name="content_subject" value="<?php echo $content_subject;?>" class="text-input"  />
<br />

Price
<?php echo $content_price;?><input type="hidden" name="content_price" value="<?php echo $content_price;?>" class="text-input"  />
<br />
Date
<?php echo $content_date;?><input type="hidden" name="content_date" value="<?php echo $content_date;?>" class="text-input"  />
<br />
Description
<?php echo $content_description;?><input type="hidden" name="content_description" value="<?php echo $content_description;?>" class="text-input"  />
<br />
<input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
<input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>" />
<input type="hidden" name="post_university_id" value="<?php echo $university_id;?>" />
<input type="hidden" name="step_no_2" value="1" />
<input type="submit" name="submit" value="submit" class="button btn-submit"  />
</form>