<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$this->load->model(array('content/mdl_content','category/mdl_category','university/mdl_university'));
$featured_list = $this->mdl_content->getLatestContentList(5);
?>
 <div id="college-web-main-body-right">
<div class="shadowblock_out widget_smSticky" id="smsticky-2"><div class="shadowblock"><h2 class="dotted">Featured Listings</h2><ul class="featured-sidebar">			
			<span  style="padding-top:15px;"></span>
			<?php foreach($featured_list as $f_list){
				
			$description=$f_list->content_long_desc;
			$length_of_description = strlen($description);
			if($length_of_description>=40){
				$whitespaceposition = strpos($description," ",40);
				$description_br = ($whitespaceposition?substr($description,0,$whitespaceposition).'...':$description);
			}
			else{
				$description_br= $description;
			}	
			?>
            <li>
				
				<h3><a href="<?php echo site_url($f_list->university_slug.'/posts/view/'.$f_list->content_id);?>" rel="tag"><?php echo $f_list->content_name;?></a></h3>
				<p class="side-meta"><span class="folder"><?php echo $f_list->category_name;?></span>																										<!--Nrs. 5,500,000</p>-->
				</p><p><?php echo $description_br;?></p>
			</li>
            <?php }?>
			</ul></div><!-- /shadowblock --></div>
            </div>