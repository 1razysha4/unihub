<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $template['title']; ?></title>
<meta name='robots' content='noindex,follow' />
<script type="text/javascript">
var base_url = '<?php echo base_url();?>';
var site_url = '<?php echo site_url();?>';
</script>
<?php echo $template['metadata']; ?>
<link rel="shortcut icon" href="<?php echo base_url('assets/public/img/favicon.png');?>" />
<!-- Custom Styling -->
<style type="text/css">
.header .logo img {margin-top: -5px;}
</style>
<script type="text/javascript">/*<![CDATA[*/$(document).ready(function() {
            $("#catlvl0").attr("level", 0);
            if ($("#catlvl0 #cat").val() > 0) {
                js_cc_getChildrenCategories($(this), "catlvl-", 1, "")
            }
            $("#cat").live("change", function() {
                currentLevel = parseInt($(this).parent().attr("level"));
                js_cc_getChildrenCategories($(this), "catlvl", currentLevel + 1, "");
                $.each($(this).parent().parent().children(), function(b, a) {
                    if (currentLevel + 1 < b) {
                        $(a).remove()
                    }
                    if (currentLevel + 1 == b) {
                        $(a).removeClass("hasChild")
                    }
                });
                if ($(this).val() > 0) {
                    $("#chosenCategory input:first").val($(this).val())
                } else {
                    if ($("#catlvl" + (currentLevel - 1) + " select").val() > 0) {
                        $("#chosenCategory input:first").val($("#catlvl" + (currentLevel - 1) + " select").val())
                    } else {
                        $("#chosenCategory input:first").val("-1")
                    }
                }
            })
        });
        function js_cc_getChildrenCategories(d, a, c, b) {
            parent_dropdown = $(d).parent();
            category_ID = $(d).val();
            results_div = a + c;
            if (!$(parent_dropdown).hasClass("hasChild")) {
                $(parent_dropdown).addClass("hasChild").parent().append('<div id="' + results_div + '" level="' + c + '" class="childCategory"></div>')
            }
        }
        ;/*]]>*/</script>
<script type="text/javascript">
$(function() {
			   
			   function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#search_loc" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				source: function( request, response ) {
					$.getJSON( '<?php echo site_url('posts/getjsonuniversitybystate');?>', {
						term: extractLast( request.term ), state_id:$('#state_id').val()
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
					$('#university_id').val(ui.item.id);
				}
			});
	});
</script>
<style type="text/css">
.recentcomments a {
	display:inline !important;
	padding:0 !important;
	margin:0 !important;
}
		#spn_city_select,#spn_university_select{position: relative;}
		#spn_city_select .loading,#spn_university_select .loading{position: absolute;left: 0px;top: 0;width: 100%;height: 30px;margin: 0 auto;text-align: center;}

</style>
</head>
<body class="">
<div class="wrapper">
  <div class="container_24"> <?php echo $template['partials']['header']; ?>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <!--Start Search Wrapper-->
  <div class="search_wrapper">
    <div class="container_24">
      <div class="grid_24">
      <?php 
				echo form_open(site_url('posts'),'name="postSearch" id="postSearch" method="post"'); 
				$country_id = (isset($this->router->university->country_id))?$this->router->university->country_id:'1';
				$state_id = @$this->router->university->state_id;
				$university_id = @$this->router->university->university_slug;
				$countryOptions = $this->router->search_data['countries'];
				$stateOptions = $this->router->search_data['states'];
				$universityOptions = $this->router->search_data['universities'];
				
				if(@$this->router->university->country_id==0){
					$this->db->select('state_id AS value,state_name AS text');
					$this->db->where('country_id',1);
					$result = $this->db->get('ci_states');
					
					$stateOptions =  $result->result();				
				}
			$this->load->model(array('category/mdl_category','content/mdl_content','utilities/mdl_html'));
	        //array_unshift($countryOptions, $this->mdl_html->option( '', 'Select Country'));
	        $country_select=$this->mdl_html->genericlist( $countryOptions, "country_id",array('onchange'=>'getCityByCountry(this.value)','class'=>'validate[required] select'),'value','text',$country_id);
	        
	        array_unshift($stateOptions, $this->mdl_html->option( '', 'Select City/State'));
	        $state_select=$this->mdl_html->genericlist( $stateOptions, "state_id",array('class'=>'validate[required] select'),'value','text',$state_id);
			array_unshift($universityOptions, $this->mdl_html->option( '', 'Select University'));
	        $university_select=$this->mdl_html->genericlist( $universityOptions, "university_id",array('style'=>"width:271px;",'class'=>'validate[required] select'),'value','text',$university_id);
				?>
          <div class="search_item second">
           <?php echo $country_select;?>
          </div>
          <div class="search_item second">
            <span id="spn_city_select"><?php echo $state_select;?></span>
          </div>
          <div class="search_item second">
            <span id="spn_university_select"><?php echo $university_select;?></span>
          </div>
          <div class="search_button">
            <input type="submit" class="search_submit" value="search">
          </div>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <!--End Search Wrapper-->
  <div class="clear"></div>
  <!--Start Cotent Wrapper-->
  <div class="content_wrapper">
    <div class="container_24"> 
    
     <div class="grid_24">
     	<?php $this->load->view('home/system_messages');?>
    	<?php echo $template['body']; ?>
    	<?php echo $template['partials']['right']; ?>
        <?php echo $template['partials']['googleads']; ?>
    </div>
      <div class="clear"></div>
    </div>
  </div>
  <!--End Cotent Wrapper-->
  <!--End Cotent Wrapper-->
  <div class="clear"></div>
  <!--Start Footer Wrapper-->
  
  <?php echo $template['partials']['footer']; ?>
  <!--End Footer Wrapper-->  
</div>
<div style="visibility: hidden; display: block; clear: both;width: 100%; height: 20px;"></div>
</body>
</html>
