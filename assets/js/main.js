jQuery(function ($) {
      $('.login').click(function(e){
          e.preventDefault();
          var email = $('.email').val();
          var pass  = $('.pass').val();

          if(email == ''){
            $('.user_error').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Please input email</p>').show();
          }

          if(pass == ''){
            $('.user_password').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Please input password</p>').show();
          }

          $('.email,.pass').change(function(){
            if($('.email').val() !='')
              $('.user_error,.error').hide();
            else
              $('.user_error').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Please input email</p>').show();
            if($('.pass').val() !='')
              $('.user_password,.error').hide();
            else
              $('.user_password').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Please input password</p>').show();
          });

          if(email!='' && pass!=''){
             var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
             var valid = emailReg.test(email);

          if(!valid) {
                $('.user_error').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Please input valid email address</p>').show();
                return false;
            }else{
                 $.ajax({
                    type :"post",
                    url:"<?php echo site_url();?>user/login",
                    data:"email="+email+"&password="+pass,
                    success:function(msg){
                      if(msg == 'logged_in'){
                        location.href = "<?php echo site_url();?>user/dashboard";
                        $('.email,.pass').val('');
                        
                      }else{
                        $('.error').html('<p style="text-align:center;color:red; margin:0px;position:relative;top:-10px;">Invalid email and password</p>').show();
                      }
                    }
                  });
            } 
          }
      });

    $('.close').click(function(e){
      e.preventDefault();
      $('.user_error,.user_password,.error').hide();
       $('.email,.pass').val('');
    });

    $(document).keypress(function(e) {
    // Enable esc
    if (e.keyCode == 27) {
      $('.user_error,.user_password,.error').hide();
       $('.email,.pass').val('');
    }
});


  });
 
