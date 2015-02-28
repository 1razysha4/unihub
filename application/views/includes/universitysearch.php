<div class="container clearfix">
    <div class="row">        
        <br>
              <form class=" form" action="#" method="POST">
              <div class="col-md-8 col-md-offset-2">

                <div class="col-sm-3">
                <label>Country</label>
                  <select name="country" class="country_name  form-control col-sm-3">
                    <option value="">--select--</option>
                    <?php if($countries != false){ 
                        if(is_array($countries)){
                          foreach($countries as $country):
                    ?>
                      <option value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                    <?php 
                        endforeach;
                      } 
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-3">
                <label>State</label>
                 <select name="state" class="state_name  form-control col-sm-3">
                   <option value="">--select--</option>
                 </select>
                 <div class="loader1" style="display:none"></div>
                </div>


                <div class="col-sm-3">
                <label>University</label>
                 <select name="university" class="university  form-control col-sm-3">
                   <option value="">--select--</option>
                 </select>
                 <div class="loader" style="display:none"></div>
                </div>

                <div class="col-sm-3">
                  <label></label>
                  <input type="submit" value="Search" class="btn btn-primary search">
                </div>
</div><!--/span3-->
              </form>
        
      </div>
</div>
<script type="text/javascript">
        jQuery(document).ready(function(){

          jQuery('.country_name').change(function(){
            var country_code = jQuery(this).val();
            jQuery('.loader').html("<img src='<?php echo site_url();?>assets/images/loader.gif'>").show();
            jQuery('.state_name,.university').find('option').remove();
            jQuery('.state_name,.university').append("<option>--select--</option>");
             jQuery.ajax({
                type:"post",
                url:"<?php echo site_url();?>welcome/getStates",
                data:"country_id="+country_code,
                success:function(done){
                  if(done){
                    jQuery('.loader').hide();
                    jQuery.each(jQuery.parseJSON(done), function(idx, obj) {
                      jQuery('.state_name').append("<option value="+obj.state_id+">"+obj.state_name+"</option>");
                    });
                  }
                }
              });
          });

          jQuery(document).on('change', '.state_name',function(){
              var state_id = jQuery(this).val();
            jQuery('.loader1').html("<img src='<?php echo site_url();?>assets/images/loader.gif'>").show();
            jQuery('.university').find('option').remove();
            jQuery('.university').append("<option>--select--</option>");

              jQuery.ajax({
                type:"post",
                url:"<?php echo site_url();?>welcome/getUniversity",
                data:"state_id="+state_id,
                success:function(msg){
                  if(msg){
                     jQuery('.loader1').hide();
                   jQuery.each(jQuery.parseJSON(msg), function(idx, obj) {
                      jQuery('.university').append("<option value="+obj.university_id+">"+obj.university_name+"</option>");
                    }); 
                  }
                }
              });
          });    
        jQuery(document).on('click','.search',function(e){
          e.preventDefault();
            var country = jQuery('.country_name option:selected').val();
            var state   = jQuery('.state_name option:selected').val();
            var university = jQuery('.university option:selected').val();

            if(country == ''){
              alert('Please select country');return false;
            }
            else if(state == ''){
              alert('Please select state');return false;
            }else if(university == ''){
              alert('Please select university');return false;
            }else{
               jQuery.ajax({
                type:"post",
                url:"<?php echo site_url();?>welcome/getUniversityData",
                data:"university_id="+university,
                success:function(msg){
                  if(msg){
                    
                    var slug = msg;
                    var url = "<?php echo site_url();?>university/"+slug;
                    window.open(url, '_blank');
                  }
                }
              });
            }
        });

        });
      </script>