<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php 
$this->load->model(array('pages/mdl_pages'));
$pages_footer_left = $this->mdl_pages->getPages('footer-left');
$pages_footer_middle = $this->mdl_pages->getPages('footer-middle');
$pages_footer_right = $this->mdl_pages->getPages('footer-right');
?>
    <div class="footer_wrapper">
    <div class="container_24">
      <div class="grid_24">
        <!--Start Footer-->
        <div class="footer">
          <div class="grid_6 alpha">
            <div class="footer_widget">
              <h4 class="head">About This Site</h4>
              <ul>
               <?php foreach($pages_footer_left as $page){?>
            <li><a href="<?php echo site_url().$page->page_slug;?>"><?php echo $page->page_name;?></a></li>
            <?php }?>
              </ul>
            </div>
          </div>
          <div class="grid_6">
            <div class="footer_widget">
              <h4 class="head">Archives Widget</h4>
              <ul>
               <?php foreach($pages_footer_middle as $page){?>
            <li><a href="<?php echo site_url().$page->page_slug;?>"><?php echo $page->page_name;?></a></li>
            <?php }?>
              </ul>
            </div>
          </div>
          <div class="grid_6">
            <div class="footer_widget">
              <h4 class="head">Help</h4>
              <ul style="margin:0px;">
                <?php foreach($pages_footer_right as $page){?>
                <li><a href="<?php echo site_url().$page->page_slug;?>"><?php echo $page->page_name;?></a></li>
                <?php }?>
              </ul>
            </div>
          </div>
          <div class="grid_6 omega">
            <div class="footer_widget last">
              <h4 class="head">Search University</h4>
              <form role="search" method="get" id="searchform" action="#" >
                <div>
                  <input onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}"  value="Search" type="text" name="Search" id="searchtxt" />
                  <input type="submit" id="searchsubmit" value="" />
                </div>
              </form>
              <p align="justify">
                             	<strong>Collegewaves LLC</strong><br />
                                5675 Roswell Rd #54D<br />
                                Atlanta GA 30342<br />

               </p>     
            </div>
          </div>
        </div>
        <!--Start Footer-->
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="footer_bottom">
    <div class="container_24">
      <div class="grid_24">
        <div class="grid_12 alpha">
          <div class="bottom_content">
            <ul class="social_icon">
              <li><a  href="https://www.facebook.com/collegewaves" target="_blank"><img src="<?php echo base_url('assets/public/img/facebook.png');?>" title="Facebook" alt="facebook"/></a></li>
              <li><a  href="https://www.twitter.com/collegewaves" target="_blank"><img src="<?php echo base_url('assets/public/img/twitter.png');?>" title="Twitter" alt="twitter"/></a></li>
              <li><a  href="https://www.linkedin.com/company/collegewaves-llc" target="_blank"><img src="<?php echo base_url('assets/public/img/linkedin.png');?>" title="Linkedin" alt="linkedin"/></a></li>
            </ul>
          </div>
        </div>
        <div class="grid_12 omega">
          <div class="bottom_content">
            <p style="float:" class="copyright">&copy; 2014 CollegeWaves. All Right Reserved.</p>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
  <script type="text/javascript">
  $(function() {
	 function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}		 
	  $( "#searchtxt" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				source: function( request, response ) {
					$.getJSON( '<?php echo site_url('posts/getjsonuniversity');?>', {
						term: extractLast( request.term )
					}, response );
				},
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					window.location.href=site_url+ui.item.id+'/posts/index';
				}
			});
});			
  </script>