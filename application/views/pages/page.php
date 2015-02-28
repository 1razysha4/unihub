<?php $this->load->view('includes/header');?> 
    <!-- container -->
    <section class="container">
        <div class="row">
            <!-- main content -->
            <section class="col-sm-8 maincontent">
                <h3><?php echo $page->page_name;?></h3>
                <hr />
                <p>
                    <?php echo nl2br($page->page_description);?>
                </p>

                <?php if($page->show_fb_comment == 1){?>                
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-comments" data-href="<?php echo site_url($this->uri->uri_string());?>" data-numposts="5" data-colorscheme="light"></div>'
                <?php } ?>              
                <!--End Cotent-->       
            </section>
            <!-- /main -->
        </div>
    </section>
    <!-- /container -->
<?php $this->load->view('includes/footer');?>

