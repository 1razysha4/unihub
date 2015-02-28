$(document).ready(function () {
//check email validation 
    $('form input[name="email"]').blur(function () {
       var email = $(this).val();
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
        if (re.test(email)) {
            $('.msg').hide();
            $('.success-message').show();
        } else {
            $('.msg').hide();
            $('.error-message').show();
            return false;
        }

    });
    
  
    $("#submit").click(function(){
        $(".error").hide();
        var hasError = false;
        var newpasswordVal = $("#newpassword").val();
        var checkVal = $("#confirmpassword").val();
        if (newpasswordVal == '') {
            $('.error-message').show();
            $("#newpassword").after('<span class="error">Please enter a password.</span>');
            hasError = true;
        } else if (checkVal == '') {
            $("#confirmpassword").after('<span class="error">Please re-enter your password.</span>');
            hasError = true;
        } else if (newpasswordVal != checkVal ) {
            $("#confirmpassword").after('<span class="error">Passwords do not match.</span>');
            hasError = true;
        }
        if(hasError == true) {
            return false;
        }
    });


})



