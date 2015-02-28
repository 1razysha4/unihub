<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($this->uri->segment(1)=='about-us'){?><div class="grid_17 alpha"><?php }?>
                <!--Start Cotent-->
                <div class="content">
                                                <!--Start Post-->
                            <div class="post classi">           
                                <div class="post_content">
                                	<h1 class="post_title"><?php echo $page->page_name;?></h1>
                                                                         

                                    <div class="meta_boxes">
                                        
                                        <div class="meta_table">
                                            <p align="justify"><?php echo $page->page_description;?></p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                                                       
                                </div>
                            </div>
                </div>
                <!--End Cotent-->				
<?php if($this->uri->segment(1)=='about-us'){?>				</div><?php }?>