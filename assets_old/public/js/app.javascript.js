$(document).ready(function(){					   
});
function ajaxunq(){
	var d = new Date();
    var unq = d.getYear()+''+d.getMonth()+''+d.getDay()+''+d.getHours()+''+d.getMinutes()+''+d.getSeconds();
	return unq;
	}
function showloading(){
	$(".loading").show();
	}
function hideloading($msg){
	$(".loading").hide();
	if($msg){$('.message_text').show();$(".message_text").html($msg);}
	if($msg)$('.message_text').delay(7000).fadeOut("slow");
}
function getCityByCountry(country_id){
	loading('spn_city_select');
	var params = 'country_id='+country_id+"&unq="+ajaxunq();
	$.ajax({			
			type	:	"GET",
			url		:	site_url+"posts/getcitybycountry",
			data	:	params,
			success	:	function (data){
							$('#spn_city_select').html(data);
							$('.select').dropkick({
								change: function (value, label) {
										getUniversityByState(value);				
								}
							});
				}								
	});
}
function getUniversityByState(state_id){
	loading('spn_university_select');
	var params = 'state_id='+state_id+"&unq="+ajaxunq();
	$.ajax({			
			type	:	"GET",
			url		:	site_url+"posts/getuniversitybystate",
			data	:	params,
			success	:	function (data){
							$('#spn_university_select').html(data);		
							$('.select').dropkick();
				}								
	});
}
function btn_login(){
	var name = $('#name').val();
	var user_name = $('#user_name').val();
	var password = $('#password').val();
	var cpassword = $('#cpassword').val();
	var email_address = $('#email_address').val();
	var params = 'name='+name+"&user_name="+user_name+"&password="+password+"&cpassword="+cpassword+"&email_address="+email_address+"&unq"+ajaxunq();
	$.ajax({			
			type	:	"POST",
			url		:	site_url+"register",
			data	:	params,
			success	:	function (data){
				}								
	});
	
}
function loading(selector)
{
	$("#"+selector).append('<span class="loading"><img src="'+site_url+'assets/public/icons/loading.gif" /></span>');
}
$(function ($) {
    $('.select').dropkick({
		change: function (value, label) {
			if($(this).attr('id')=='country_id'){
				getCityByCountry(value);
				$('.select').dropkick();
			}
			if($(this).attr('id')=='state_id'){
				getUniversityByState(value);				
			}
		}
	});
});