$(document).ready(function(){
        // UL = .TabsPostsTabs
        // Tab contents = .TabsPostsInside
        
       var tag_cloud_class = '#tag-cloud'; 
       
       var tag_cloud_height = $('#tag-cloud').height();

       $('.TabsPostsInside ul li:last-child').css('border-bottom','0px') // remove last border-bottom from list in tab conten
       $('.TabsPostsTabs').each(function(){
       	$(this).children('li').children('a:first').addClass('selected'); // Add .selected class to first tab on load
       });
       $('.TabsPostsInside > *').hide();
       $('.TabsPostsInside > *:first-child').show();
       

       $('.TabsPostsTabs li a').click(function(evt){ // Init Click funtion on TabsPostsTabs
        
            var clicked_tab_ref = $(this).attr('href'); // Strore Href value
            
            $(this).parent().parent().children('li').children('a').removeClass('selected'); //Remove selected from all TabsPostsTabs
            $(this).addClass('selected');
            $(this).parent().parent().parent().children('.TabsPostsInside').children('*').hide();
            
            $('.TabsPostsInside ' + clicked_tab_ref).fadeIn(500);
             
             evt.preventDefault();

        })
    
})
  
				
				