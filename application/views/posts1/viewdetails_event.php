<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<img src="<?php echo base_url('assets/public/images/step2.png');?>"  />
<?php echo form_open();?>

<input type="hidden" name="content_name" value="<?php echo $content_name;?>" class="text-input"  />
<br />

2.	Location
<?php echo $content_name;?><input type="hidden" name="content_location" value="<?php echo $content_location;?>" class="text-input"  />
<br />
3.	Date
<?php echo $content_date;?><input type="hidden" name="content_date" value="<?php echo $content_date;?>" class="text-input"  />
<br />
4.	Start time
<?php echo $content_start_time;?><input type="hidden" name="content_start_time" value="<?php echo $content_start_time;?>" class="text-input"  />
<br />
5.	Finish Time
<?php echo $content_finish_time;?><input type="hidden" name="content_finish_time" value="<?php echo $content_finish_time;?>" class="text-input"  />
<br />
6.	Organizer
<?php echo $content_organizer;?><input type="hidden" name="content_organizer" value="<?php echo $content_organizer;?>" class="text-input"  />
<br />
7.	Contact Organizer
<?php echo $content_contact_organizer;?><input type="hidden" name="content_contact_organizer" value="<?php echo $content_contact_organizer;?>" class="text-input"  />
<br />
<input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
<input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>" />
<input type="hidden" name="step_no_2" value="1" />
<input type="submit" name="submit" value="submit" class="button btn-submit"  />
</form>