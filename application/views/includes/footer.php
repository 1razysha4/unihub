<footer id="footer">
 
    <div class="container">
   <div class="row">
  <div class="footerbottom">
    <div class="col-md-3 col-sm-6">
      <div class="footerwidget">
        <h4>
          Course Categories
        </h4>
        <div class="menu-course">
          <ul class="menu">
            <li><a href="#">
                List of Technology 
              </a>
            </li>
            <li><a href="#">
                List of Business
              </a>
            </li>
            <li><a href="#">
                List of Photography
              </a>
            </li>
            <li><a href="#">
               List of Language
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
 
    <div class="col-md-3 col-sm-6">
      <div class="footerwidget">
        <h4>
          Browse by Categories
        </h4>
        <div class="menu-course">
          <ul class="menu">
            <li><a href="#">
                All Courses
              </a>
            </li>
            <li> <a href="#">
                All Instructors
              </a>
            </li>
            <li><a href="#">
                All Members
              </a>
            </li>
            <li>
              <a href="#">
                All Groups
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6"> 
              <div class="footerwidget"> 
                         <h4>Contact</h4> 
                        <p>Lorem reksi this dummy text unde omnis iste natus error sit volupum</p>
            <div class="contact-info"> 
            <i class="fa fa-map-marker"></i>5675 Roswell RD 54, Atlanta, GA 30342 - US<br>
            <i class="fa fa-phone"></i>404-717-3334 <br>
             <i class="fa fa-envelope-o"></i> admin@collegewaves.com
              </div> 
                </div><!-- end widget --> 
    </div>
  </div>
</div>
      <div class="social text-center">
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-flickr"></i></a>
        <a href="#"><i class="fa fa-github"></i></a>
      </div>

      <div class="clear"></div>
      <!--CLEAR FLOATS-->
    </div>
    <div class="footer2">
      <div class="container">
        <div class="row">

          <div class="col-md-6 panel">
            <div class="panel-body">
              <p class="simplenav">
                <a href="index.html">Home</a> | 
                <a href="about.html">About</a> |
                <a href="contact.html">Contact</a>
              </p>
            </div>
          </div>

          <div class="col-md-6 panel">
            <div class="panel-body">
              <p class="text-right">
                Copyright &copy; 2015. Uni-Hub<a href="http://collegewaves.com/" rel="developer">Unihub.com</a>
              </p>
            </div>
          </div>

        </div>
        <!-- /row of panels -->
      </div>
    </div>
  </footer>

  <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url();?>/assets/js/modernizr-latest.js"></script> 
  <script type='text/javascript' src='<?php echo base_url();?>/assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>/assets/js/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='<?php echo base_url();?>/assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>/assets/js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='<?php echo base_url();?>/assets/js/camera.min.js'></script> 
    <script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script> 
  <script src="<?php echo base_url();?>/assets/js/custom.js"></script>
    <script>
    jQuery(function(){
      
      jQuery('#camera_wrap_4').camera({
                transPeriod: 500,
                time: 3000,
        height: '600',
        loader: 'false',
        pagination: true,
        thumbnails: false,
        hover: false,
                playPause: false,
                navigation: false,
        opacityOnGrid: false,
        imagePath: 'assets/images/'
      });

    });
      
  </script>
    
</body>
</html>