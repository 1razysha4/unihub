<script type="text/javascript">
$(document).ready(function(){
	/*$('#category_id').change(function(){
		getSubCategory($(this).val());
	})*/					   
});
function getSubCategory(parent_id){
	loading("spn_sub_category_select");
	var params="parent_id="+parent_id+"&unq="+ajaxunq();
	$.ajax({			
			type	:	"GET",
			url		:	"<?php echo site_url();?>posts/getsubcategory",
			data	:	params,
			success	:	function (data){
				$("#spn_sub_category_select").html(data);
				}								
		});//end  ajax	
}
</script>