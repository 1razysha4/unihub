<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
	$(document).ready(function(){
		$( "#search_category" ).focus();
		$( "#search_category" ).val('');
	});
	$(function() {
			   
			   function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#search_category" )
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
					window.location = '<?php echo site_url();?>'+ui.item.id+'/posts/addnew';
				}
			});
	});
	</script>
    
<div class="grid_17 alpha">
                <!--Start Cotent-->
                <div class="content">
                	<h1>Select University</h1>
					<div id="fotget_pw">
        
                        <form id="" action="" method="post" onsubmit="return false;">
                           
                            
                            <div class="row">
                                <input style="font-style:italic" placeholder="Type University or State / City name." type="text" name="search_category" id="search_category" value="" class="text required autocomplete ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                            </div>
                            
                            
                            
                         </form>	
    
   				 </div>

					<div class="clear"></div>
                </div>
                <!--End Cotent-->
            </div>
