<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="free-educational-responsive-web-template-webEdu">
  <meta name="author" content="webThemez.com">
  <title><?php echo ucwords($title);?> - UniHub</title>
  <link rel="favicon" href="<?php echo base_url();?>/assets/images/favicon.png">
  <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap-theme.css" media="screen"> 
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
  <link rel='stylesheet' id='camera-css'  href='<?php echo base_url();?>/assets/css/camera.css' type='text/css' media='all'> 
  <script type='text/javascript' src='<?php echo site_url();?>assets/js/jquery.min.js'></script>
  <script src="<?php echo site_url();?>assets/js/jquery.validate.min.js"></script>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="assets/js/html5shiv.js"></script>
  <script src="assets/js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <!-- Button for smallest screens -->
       
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
       
        <a class="navbar-brand" href="<?php echo site_url();?>">
          <img src="<?php echo base_url();?>/assets/images/logo.png" alt="" style=" margin-top:-10px"></a>
      </div>

      <div class="navbar-collapse collapse">
       <div class="nav navbar text-right">
        <?php if(@$this->session->userdata['is_loggedin'] != "1"){ ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Post Classfied</button>  
         <?php }else{ ?>
          <a class="btn btn-primary" href="<?php echo site_url();?>post/add">Post Classfied</a>  
          <a href="<?php echo site_url();?>user/logout">Logout</a>
          <?php } ?>
          
      </div>
        <ul class="nav navbar-nav pull-right mainNav">

          <li <?php if($this->uri->segment(1) == false){?> class="active" <?php }?>>

            <a href="<?php echo site_url();?>">Home</a>
          </li>
          <li <?php if($this->uri->segment(1)== 'about-us'){ ?> class="active" <?php } ?>>
            <a href="<?php echo site_url();?>about-us">About</a>
          </li>
          <li <?php if($this->uri->segment(1)== 'contact-us'){ ?> class="active" <?php } ?>>
            <a href="<?php echo site_url();?>contact-us">Contact</a>
          </li>
          <?php if($this->session->userdata('is_loggedin')== 1):?>
           <li <?php if($this->uri->segment(1)== 'logout'){ ?> class="active" <?php } ?>>
            <a href="<?php echo site_url();?>/user/logout">Logout</a>
          </li>
          <?php endif;?>
          
          

        </ul>
      </div>
      
      <!--/.nav-collapse -->
    </div>
  </div>
  <!-- /.navbar -->

  <!-- Header -->
  <?php if($this->uri->segment(1) == false){ ?>
  <header id="head">
    <div class="container">
             <div class="heading-text">             
              <h1 class="animated flipInY delay1">UniHub</h1>
              <p>Together we achieve</p>
            </div>
            
          <div class="fluid_container">                       
                    <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                        <div data-thumb="assets/images/slides/thumbs/img1.jpg" data-src="assets/images/slides/img1.jpg">
                            <h2>We develop.</h2>
                        </div> 
                        <div data-thumb="assets/images/slides/thumbs/img2.jpg" data-src="assets/images/slides/img2.jpg">
                        </div>
                        <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slides/img3.jpg">
                        </div> 
                    </div><!-- #camera_wrap_3 -->
          </div><!-- .fluid_container -->
    </div>
  </header>
  <?php }else{ ?>
  <hr/>
  <?php } ?>
  <!-- /Header -->


  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login  or <a href="<?php echo site_url();?>register">Create a Account</a></h4>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="loginForm" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Email</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control email" name="username" />
                        </div>
                    </div>

                    <div class="user_error" style="display:none;"></div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">Password</label>
                        <div class="col-xs-5">
                            <input type="password" class="form-control pass" name="password" />
                        </div>
                    </div>

                    <div class="user_password" style="display:none;"></div>

                    <div class="error" style="display:none;"></div>

                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary login">Login</button>
                            <br>
                            <a href="<?php echo site_url();?>user/resetpassword"> Forgot Password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
  </script>


  