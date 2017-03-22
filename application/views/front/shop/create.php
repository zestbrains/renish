<div class="spacer-small"></div>
<!-- PAGEBODY -->         
<div class="spacer-small"></div>

<form method="post" id="create_garage" enctype="multipart/form-data" >
    <input type="hidden" name="iGarageId" value="<?php echo (isset($GarageData['iGarageId']) !='' ? $GarageData['iGarageId'] : ''); ?>">
    <div class="container" >
        <div id="msg" style="display: none;"  class="alert alert-info error_alert_bar"></div>
    </div>   
    <!----------------------------------------------------- first Step ------------------------------------------------------>     
    <div class="container" id="first_step">
       <div class="row about_container stepgrey">
       <h1 class="about-text difreg">What is your shop type? </h1>
          <div class="col-lg-6 garage-left">
          <div class="fstradio">
             <label class="radio-inline"><input type="radio" value="1" id="vGarageType" class="vGarageType" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==2) ? 'checked="checked"' : ''); ?> >Auto Repair Shop</label><br>
             <label class="radio-inline"><input type="radio" value="2" id="vGarageType" class="vGarageType" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==1) ? 'checked="checked"' : ''); ?> >Auto Body Shop</label><br>                       
             <label class="radio-inline"><input type="radio" value="3" id="vGarageType" class="vGarageType" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==3) ? 'checked="checked"' : ''); ?> >Both</label></div>
          </div>
          <div class="col-lg-6">
              <img src="<?php echo ASSETS_URL; ?>/manual/005.png" class="about-image"/>
          </div>
			<div class="col-lg-12 about_container">
				<div class="btn-garage">
					<a href="javascript:;" id="first_finished" next_div_id="second_step"  class="btn btn-primary btn-lg conti" style="width:20%;">Continue</a>
				 </div>
			</div>
       </div>


       <div class="spacer-medium"></div>

    </div>
    <!-- --------------------------------------------------second step------------------------------------------------------>
    <div class="container" id="second_step" style="display:none;">
       <div class="row about_container stepgrey">
       <h1 class="about-text difreg">Your shop location details</h1>
           <div class="col-lg-6 garage-left">
                    <div class="form-group">
                      <label for="inputdefault" class="profile-field-label">Name of Repair Shop<span class="mendatory_mark">*</span></label>
                      <input type="text" name="vGarageName" id="vGarageName" class="form-control input-sm profile-field" value="<?php echo (isset($GarageData['vGarageName']) !='' ? $GarageData['vGarageName'] : ''); ?>" placeholder="First Name" tabindex="1" >
                    </div>
                    
                    <div class="form-group">
                        <label for="inputdefault"  class="profile-field-label">State<span class="mendatory_mark">*</span></label>
                         <?php

                         ?>
                          <select name="iStateId" id="iStateId" class="form-control" tabindex="2">
                           <?php foreach ($states as $state) {$selected = ($GarageData['iStateId'] != '' ? ($state['iStateId'] == $GarageData['iStateId']) ? 'selected="selected"' : '' : '');?>
                              <option value="<?php echo $state['iStateId']; ?>" <?php echo $selected; ?>><?php echo $state['vState']; ?></option>
                           <?php }?>
                         </select>
                    </div>
                     <div class="form-group">
                      <label for="inputdefault" class="profile-field-label">City Of USA<span class="mendatory_mark">*</span></label>
                      <input type="text" name="vCityName" id="vCityName" class="form-control input-sm profile-field" value="<?php echo (isset($GarageData['vCityName']) !='' ? $GarageData['vCityName'] : ''); ?>" placeholder="City" tabindex="3" >
                    </div>
               
                    
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Zip Code<span class="mendatory_mark">*</span></label>
                           <input type="text" name="vZipCode" id="vZipCode" class="form-control input-sm profile-field" placeholder="zipcode" tabindex="4" value="<?php echo (isset($GarageData['vZipCode']) !='' ? $GarageData['vZipCode'] : ''); ?>" >
                        </div>
           </div>
           
          <div class="col-lg-6">
                    <img src="<?php echo ASSETS_URL; ?>/manual/002.png" class="about-image"/>
          </div>
		          <div class="col-lg-12 about_container">
             <div class="btn-garage">
                 <a href="javascript:;"  return_div_id="first_step"  current_div_id="second_step"  class="btn btn-primary btn-lg back" tabindex="6" style="width:20%;">Back</a>                
             
<!--                 <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>                -->
                    <a href="javascript:;" id="second_finished" next_div_id="third_step"  class="btn btn-primary btn-lg conti" tabindex="7" style="width:20%;">Continue</a>
             </div>
        </div>
       </div>
        


       <div class="spacer-medium"></div>

    </div>
    
    <!---------------------------------------------------- Third Step ------------------------------------------------------>     
     <div class="container" id="third_step" style="display:none;" >
     
     <div class="third-step-garage stepgrey">
     <div class="tstep-parent">
 <h1 class="about-text difreg">More details for your shop.</h1>
       <div class="row">
            <div class="col-lg-6">
                        <div class="form-group">
                           <label for="inputdefault"  class="profile-field-label">Mobile Number<span class="mendatory_mark">*</span></label>
                           <input type="text" name="vMobile" id="vMobile" class="form-control "  placeholder="Mobile Number" tabindex="1" value="<?php echo (isset($GarageData['vMobile']) !='' ? $GarageData['vMobile'] : ''); ?>" >
                           <div id="mobile_num" style="color:red;"></div>
                           
                        </div>
            </div>
            <div class="col-lg-6">
                        <div class="form-group">
                           <label for="inputdefault"  class="profile-field-label">Office Number<span class="mendatory_mark">*</span></label>
                           <input type="text" name="vOffice_mobile" id="vOffice_mobile" class="form-control " placeholder="Office Number" tabindex="2" value="<?php echo (isset($GarageData['vOffice_mobile']) !='' ? $GarageData['vOffice_mobile'] : ''); ?>" >
                           <div id="ofc_num" style="color:red;"></div>
                        </div>
             </div>
           <input type="hidden" name="iTotalMechanic" value="0">
       </div>
        <div class="row">
                <div class="col-lg-6">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Address Line 1<span class="mendatory_mark">*</span></label>
                          <input type="text" name="vAddress" id="vAddress" tabindex="3" class="form-control profile-field" placeholder="Address Line 1" style="height:auto !important;" value="<?php echo (isset($GarageData['vAddress']) !='' ? $GarageData['vAddress'] : ''); ?>">
                        </div>
                </div>
                <div class="col-lg-6">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Address Line 2</label>
                          <input type="text" name="vAddress_second" id="vAddress_second" tabindex="3" class="form-control profile-field" placeholder="Address Line 2" style="height:auto !important;" value="<?php echo (isset($GarageData['vAddress_second']) !='' ? $GarageData['vAddress_second'] : ''); ?>">
                        </div>
                </div>
        </div>
         <div class="row">
                <div class="col-lg-12">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">About Shop<span class="mendatory_mark">*</span></label>
                          <textarea rows="3" id="tDescription" tabindex="4" name="tDescription" class="form-control profile-field" placeholder="Write About your Business" style="height:auto !important;"><?php echo (isset($GarageData['tDescription']) !='' ? $GarageData['tDescription'] : ''); ?></textarea>
                        </div>
                 </div>
		<div class="col-lg-12">           
             <div class="btn-garage">
                 <a href="javascript:;"  return_div_id="second_step" tabindex="5"  current_div_id="third_step"  class="btn btn-primary btn-lg back" style="width:20%;">Back</a>                
             
<!--                 <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>                -->
                    <a href="javascript:;" id="third_finished" next_div_id="fourth_step" tabindex="6"  class="btn btn-primary btn-lg conti" style="width:20%;">Continue</a>
             </div>
       
        </div>
				 </div> 
        

		</div>
        

       <div class="spacer-medium"></div>
</div>
    </div>
     
    <!----------------------------------------------------Fourth Step ------------------------------------------------------>
    <div class="container" id="fourth_step"  style="display:none;"  >

       <div class="row about_container stepgrey">
     <h1 class="about-text difreg">Your shop hours</h1>
          <div class="col-lg-6 garage-left">
               <div class="col-lg-12 days">
                          
                        </div>
                        <div class="col-lg-12 days">
                          <div class="col-lg-4 days text-center">
                            <label>Shows Days</label>
                          </div>
                          <div class="col-lg-4 days">
                            <label>Start Time</label>		
                          </div>
                          <div class="col-lg-4 days">
                            <label>End Time</label>
                          </div>
                        </div>
                       <?php
                       if(isset($GarageData['tWorkingHour'])){
                        $workingHours=json_decode($GarageData['tWorkingHour'],true);
                       }else{
                           $workingHours='';
                       }
                      // pre($workingHours);
                        $dayMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
                        $dayFull = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                        for($i=0;$i<count($dayMap);$i++){
                            
                         $dayshort=$dayMap[$i];  
                         $dayfull=$dayFull[$i];  
                         
                         $start_time=$dayshort.'_start_time';
                         $end_time=$dayshort.'_end_time';
                         $working_day=$dayshort.'_working_day';
                        
                         
                        ?>
                        <div class="col-lg-12 days"  >
                              <div class="col-lg-4 days text-center">
                                  <label><input type="checkbox" value=""  class="checked_day work-checkbox <?php echo $working_day; ?>" <?php echo ((isset($workingHours[$i]['start']) && $workingHours[$i]['start']!='0:00') !='' ? 'checked' : ''); ?>><?php echo $dayfull; ?></label>
                              </div>
                              <div class="col-lg-4 days">
                                  <input type="text" class="form-control single-input start_date" id="<?php echo $start_time; ?>" name="<?php echo $start_time; ?>"  value="<?php echo ((isset($workingHours[$i]['start']) && $workingHours[$i]['start']!='0:00') !='' ? $workingHours[$i]['start'] : ''); ?>" placeholder="00.00">
                              </div>
                              <div class="col-lg-4 days">
                                <input type="text" class="form-control single-input end_date" id="<?php echo $end_time; ?>" name="<?php echo $end_time; ?>" value="<?php echo ((isset($workingHours[$i]['end']) && $workingHours[$i]['end']!='0:00') !='' ? $workingHours[$i]['end'] : ''); ?>" placeholder="00.00">
                              </div>
                            </div>
                        <?php } ?> 
          </div>
          <div class="col-lg-6">
              <img src="<?php echo ASSETS_URL; ?>/manual/007.png" class="about-image"/>
          </div>
		          <div class="col-lg-12">          
            <div class="btn-garage">
                 <a href="javascript:;"  return_div_id="third_step"  current_div_id="fourth_step"  class="btn btn-primary btn-lg back" style="width:20%;">Back</a>                
            
<!--                 <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>                -->
                    <a href="javascript:;" id="fourth_finished" next_div_id="fifth_step"  class="btn btn-primary btn-lg conti" style="width:20%;">Continue</a>
             </div>
        </div>
       </div>


       <div class="spacer-medium"></div>

    </div>
     <!---------------------------------------------------- fifth Step ------------------------------------------------------>     
     <div class="container" id="fifth_step" style="display:none;" >
   
       <div class="row fifth-step-garage stepgrey">
  <h1 class="about-text difreg">Professional banner will help your business attract more customers.</h1>
            <div class="col-lg-12">
                        <div class="form-group cover-image">
                          <label for="inputdefault" class="profile-field-label">Cover Photo<span class="mendatory_mark">*</span></label>
						  <br>
                          <span class="note"><b>Note:</b>Cover image should be minimun 900*500 size </span>
                        </div>
            </div> 
           
            <div class="col-lg-12">
              <a href="javascript:void(0);" id="UploadCoverImg">
              <div class="forfivestep"> 
                  <?php if(isset($GarageData['vCoverImage']) && $GarageData['vCoverImage']!='') { ?>
                     <input type="hidden" name="is_cover_image" id="is_cover_image" value="1">
                     <img  id="cover_image_preview" class='image big-image' src="<?php echo DOMAIN_URL.'/'.$GarageData['vCoverImage']; ?>" alt="SEO Name"/>                              

                  <?php }else{?>
                      <input type="hidden" name="is_cover_image" id="is_cover_image" value="0">
                     <img  id="cover_image_preview" class='image big-image' src="<?php echo ASSETS_URL; ?>/uploads/placeholder.jpg" alt="SEO Name"/>                               
                   <?php } ?>  
                   </div>
                  <div class="div">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                  </div>                            
              </a>
                <div id="error_message" class="error" style="  font-weight: bold;"></div>
                <input type="file" name="vCoverImage" id="cover_image" value="<?php echo (isset($GarageData['vCoverImage']) !='' ? $GarageData['vCoverImage'] : ''); ?>" style="display: none;" >
               
            </div>
            
            <div class="col-lg-12">           
             <div class="btn-garage">
                 <a href="javascript:;"  return_div_id="fourth_step"  current_div_id="fifth_step"  class="btn btn-primary btn-lg back" style="width:20%;float:left;">Back</a>                
             
<!--                 <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>                -->
                    <a href="javascript:;" id="fifth_finished" next_div_id="six_step"  class="btn btn-primary btn-lg conti" style="width:20%;     margin-right: 14px;">Continue</a>
             </div>
       
        </div>
       </div>
        
         
       

       <div class="spacer-medium"></div>

    </div>
     <!---------------------------------------------------- Six Step ------------------------------------------------------>     
     <div class="container" id="six_step" style="display:none;"  >

            <div class="row about_container stepgrey">
                 <h1 class="about-text difreg">More images is even better.</h1>
				 <div class="col-lg-12 add_more_div">
				 <a id="add_more" href="#" class="add-more-btn-services"><i class="fa fa-photo"></i> Add More Photos</a>
				 </div>
               <div class="col-lg-12">
			   
                  <div class="panel panel-default">
                      <div class="panel-heading profile-small-title">
                          <h3>More Images of your shop</h3>                          
                          <input type="file" id="add_more_images" style="display: none;" >
                      </div>
                      <div class="panel-body photos-garage">
                        <?php for($k=0;$k<count($GarageImages);$k++){ ?>  
                            <div  class="garageImage" style="display: block;" data-id="<?php echo $GarageImages[$k]['iImageId']; ?>">
                                <li class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <span></span>
                                    <a class="file_preview" href="javascript:void(0);" style="display: none;">
                                        <img class="image" src="<?php echo DOMAIN_URL; ?>/assets/files/uploads/placeholder.jpg" alt="SEO Name">
                                        <div class="div">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div  class="abcd">
                                        <img class="image"  src="<?php echo DOMAIN_URL.'/'.$GarageImages[$k]['vImage']; ?>">
                                        <img src="<?php echo DOMAIN_URL; ?>/assets/files/remove.png"  data-id="<?php echo $GarageImages[$k]['iImageId']; ?>" class="remove_image_icon deleteImage">
                                    </div>
                                    <input type="file" name="file[]" id="morefiles" style="display:none;">
                                </li>
                            </div>
                          <?php } ?> 
                          
                            
                          
                          <ul id="more_images_preview"></ul>
                     </div>
                  </div>
               </div>
              <div class="col-lg-12">
                <div class="btn-garage">
                    <a href="javascript:;"  return_div_id="fifth_step"  current_div_id="six_step"  class="btn btn-primary btn-lg back" style="width:20%;">Back</a>                
            
   <!--                 <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>                -->
                       <a href="javascript:;" id="six_finished" next_div_id="seventh_step"  class="conti btn btn-primary btn-lg" style="width:20%;">Continue</a>
                </div>
             </div>  
            </div>


       <div class="spacer-medium"></div>

    </div>
       <!----------------------------------------------------- seventh Step ------------------------------------------------------>     
    <div class="container" id="seventh_step" style="display:none;" >

       <div class="row about_container stepgrey">
         <h1 class="about-text difreg">Better discount will help attract more business</h1>
          <div class="col-lg-12 seventh-step-garage">
                <div class="panel-heading profile-small-title">
<!--                  <h3>Coupon Code<span class="mendatory_mark">*</span></h3>-->
                </div>
                <div class="panel-body">
                  <div class="checkbox">
<!--                    <input type="checkbox" value="" id="coupon"   class="work-checkbox" checked>-->
                      <label>I love to attract customers with offer of
                        <select id="vCouponDiscount" name="vCouponDiscount" class="form-control2" style="border: none;border-bottom: 2px solid #CCC;" >
                             <?php foreach ($discouts as $discount) {$selected = ($GarageData['vCouponDiscount'] != '' ? ($discount['iDiscountId'] == $GarageData['vCouponDiscount']) ? 'selected="selected"' : '' : '');?>
                               <option value="<?php echo $discount['iDiscountId']; ?>" <?php echo $selected; ?>><?php echo $discount['iPercentage']; ?></option>
                            <?php }?>                        
                          </select> discount on the final bill.</label>
                  </div>
                    <input type="hidden" value="00" name="vAmountForCoupon"> 
                    <?php
                     if($GarageData['vCouponDiscount']==1){
                         $display='block';
                     }else{
                         $display='none';
                     }
                     ?>
                       <div id="coupon_msg" class="error" style="display: <?php echo $display; ?>;">If you provide 0% discount than customer will not able to post review!!</div> 
                </div>
          </div>
		          
            <div class="col-lg-12">
                <div class="btn-garage">
                       <a href="javascript:;"  return_div_id="six_step"  current_div_id="seventh_step"  class="btn btn-primary btn-lg back" style="width:20%;">Back</a>   
                       <a href="javascript:;" id="save_shop"  class="btn btn-primary btn-lg" style="width:20%;">Save</a>
                </div>
             </div>  
    
    
    
         
       </div>


       <div class="spacer-medium"></div>

    </div>
    <input type="submit" id="submitForm" name="submit" style="opacity: 0;">   
</form>    
<div class="spacer-small"></div>
<!--- confirm mobile number dialog -->
        <div id="Confirm_mobile_num_modal" class="modal">
               <div class="modal-content">
                 <span class="close">&times;</span>
                 <div align="center">
                     <h3>Confirm your communication number twice,<span>Customer can able to contact you!!</span></h3>
                        <div class="row">
                                <div class="col-lg-6 border-right">                                    
                                    <p><input type="text" id="mobile_number"></p>
                                </div>
                                <div class="col-lg-6">                 
                                    <p><input type="text" id="office_number"> </p>
                                </div>
                            <div class="col-lg-12">
                                <a href="javascript:void(0);" id="confirm_mobile_num" class="btn btn-lg btn-default read-more model-btn">Confirm</a>
                            </div>
                        </div>
                 </div>         
               </div>
        </div>
<!--- END ------>
<style>
    .mendatory_mark{color:red;}
</style>
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/jquery-clockpicker.min.css" type="text/css" media="all" />      
<script src="<?php echo ASSETS_URL; ?>/js/jquery-clockpicker.min.js" type="text/javascript"></script>     
    
 <script type="text/javascript">
  //add Hyphen in mobile number
 $('#vMobile').keyup(function(){
    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));         
   
 });
 $('#vOffice_mobile').keyup(function(){
     $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));    
    
 });
  
  //Clock
$('.single-input').clockpicker({
      placement: 'bottom',
      align: 'right',
      autoclose: true,
      'default': '20:48'
  });
           
//Country city and state selection
$(function(){ 
    var URL='<?php echo DOMAIN_URL; ?>';  
        getStates();
        
  
  function getStates(){
        var URL='<?php echo DOMAIN_URL; ?>';  
        options='<option value="">Please Select State</option>';

       
          var iCountryId ='<?php echo DEFAULT_COUNTRY; ?>';
          $.post(URL+'/setting/getState/',{id:iCountryId}, function(data) {
                var obj=JSON.parse(data);
                state='<?php echo isset($GarageData['iStateId']) ? $GarageData['iStateId']:''; ?>';
                for(i=0;i<obj.length;i++){
                      options += '<option value="'+obj[i].iStateId+'" '+(state==obj[i].iStateId?"selected":"")+'>'+obj[i].vState+'</option>';
                }
                $('#iStateId').html(options);
          });
        
 }
 

});
//Stepping
 $(document).ready(function() {
       // step form jqueries 
       $(".back").click(function(){
           
           var backDiv=$(this).attr('return_div_id');          
           var CurrentDiv=$(this).attr('current_div_id');
           $("#"+CurrentDiv).hide();
           $("#"+backDiv).show();
       }); 
       $("#first_finished").click(function(){
           if($('.vGarageType').is(':checked')){
               $("#msg").hide();
               $("#first_step").hide();
               $("#second_step").show();
           }else{
               $("#msg").show();
               $("#msg").text('Please select your shop type');
        }
           
       });
       $("#second_finished").click(function(){
           if($('#vGarageName').val()!='' && $('#iCountryId').val()!='' && $('#iStateId').val()!='' && $('#vCityName').val()!='' && $("#vZipCode").val()!=''){
               $("#msg").hide();
               $("#second_step").hide();
               $("#third_step").show();
           }else{
               $("#msg").show();
               $("#msg").text('Please correct all mendatory fields');
        }
           
       });
       $("#third_finished").click(function(){
           if($('#vMobile').val()!='' && $('#vOffice_mobile').val()!='' && $('#vAddress').val()!='' && $('#tDescription').val()!='' && $('#iTotalMechanic').val()!=''){
                var regexp = /^\d+(-\d+)*$/;
                if ($('#vMobile').val().search(regexp) == -1 || $('#vMobile').val().length!=12 || $('#vOffice_mobile').val().length!=12  || $('#vOffice_mobile').val().search(regexp) == -1 )
                {                    
                    $("#msg").show().html('Invalid Phone number!!'); 
                }else { 
                    
                    $("#msg").hide();
                    var modal = document.getElementById('Confirm_mobile_num_modal');               
                    var span = document.getElementsByClassName("close")[0]; 
                    $("#mobile_number").val($('#vMobile').val());
                    $("#office_number").val($('#vOffice_mobile').val());
                    modal.style.display = "block";

                    span.onclick = function() {
                        modal.style.display = "none";
                    },
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    };
                }
           }else{
               $("#msg").show();
               $("#msg").text('Please correct all mendatory fields');
        }
           
       });
       $("#confirm_mobile_num").click(function(){
           if($("#office_number").val()!='' && $("#mobile_number").val()!=''){
               $("#vMobile").val($('#mobile_number').val());
               $("#vOffice_mobile").val($('#office_number').val());
               
               $("#Confirm_mobile_num_modal").hide();
               $("#third_step").hide();
               $("#fourth_step").show(); 
           }
       });
       $("#fourth_finished").click(function(){
           var is_valid='yes';
           if($(".sun_working_day").prop('checked') == true){               
               if($("#sun_start_time").val()=='' && $("#sun_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".mon_working_day").prop('checked') == true){
               if($("#mon_start_time").val()=='' && $("#mon_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".tue_working_day").prop('checked') == true){
               if($("#tue_start_time").val()=='' && $("#tue_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".wed_working_day").prop('checked') == true){
               if($("#wed_start_time").val()=='' && $("#wed_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".thu_working_day").prop('checked') == true){
               if($("#thu_start_time").val()=='' && $("#thu_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".fri_working_day").prop('checked') == true){
               if($("#fri_start_time").val()=='' && $("#fri_end_time").val()==''){
                   is_valid='no';
               }
           }
           if($(".sat_working_day").prop('checked') == true){
               if($("#sat_start_time").val()=='' && $("#sat_end_time").val()==''){
                   is_valid='no';
               }
           }
           if(is_valid=='yes'){
               $("#msg").hide();
               $("#fourth_step").hide();
               $("#fifth_step").show();
           }else{
                $("#msg").show();
               $("#msg").text('Please fill shop start and end time for selected days.');
           }
          
           
       });
       $("#fifth_finished").click(function(){
           if($('#vCoverImage').val()!='' && $("#is_cover_image").val()==1 ){
               $("#msg").hide();
               $("#fifth_step").hide();
               $("#six_step").show();
           }else{
               $("#msg").show();
               $("#msg").text('You have to add cover image.');
        }
           
       });
       $("#six_finished").click(function(){           
               $("#msg").hide();
               $("#six_step").hide();
               $("#seventh_step").show();           
           
       });
       
   
        
        $("#save_shop").click(function(){
            $('#create_garage').submit();
            

                var formData = new FormData($("#create_garage")[0]);
                $.ajax({
                    url: '<?php echo DOMAIN_URL; ?>/shop/save_garage_data',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,                    
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function (data) {
                        console.log(data);
                       if(data=='successfully!!'){
                            $("#msg").show();
                            $("#msg").removeClass('error_alert_bar');
                            $("#msg").addClass('success_alert_bar');
                            $("#msg").html(data);
                            $("#loading-image").hide();
                            window.location.href = '<?php echo DOMAIN_URL;?>';
                        }else{
                            $("#msg").show();
                            $("#msg").removeClass('success_alert_bar');
                            $("#msg").addClass('error_alert_bar');
                            $("#msg").html('Somethings went wrong,Please try again later!!');
                            $("#loading-image").hide();
                        }     
                    },
                    error: function (data) {
                        $("#msg").show();
                        $("#msg").removeClass('success_alert_bar');
                        $("#msg").addClass('error_alert_bar');
                        $("#msg").html('Somethings went wrong,Please try again later!!');
                        $("#loading-image").hide();
                    }
                });
              return false;

           
        });
        
        
        //Cover Image and all images    Selection
        $("#UploadCoverImg").on('click', function(e){
             e.preventDefault();
            $("#cover_image:hidden").trigger('click');
        });        
        function readURL(input,target) {
            var fileTypes = ['png', 'jpg', 'gif', 'jpeg', 'bmp'];
            if (input.files && input.files[0]) {
               var reader = new FileReader();

                   var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                   isSuccess = fileTypes.indexOf(extension) > -1;
                     if (isSuccess) {
                           reader.onload = function (e) {
                               var image = new Image();
                               image.src = e.target.result;

                               image.onload = function() {
                                   // access image size here 

                                   if(this.width > 899 && this.height > 499){
                                        $("#is_cover_image").val(1);
                                       $("#error_message").html('');   
                                       $('#'+target).attr('src', e.target.result);
                                   }else{
                                       $("#error_message").html("");
                                       $("#error_message").append('Cover image should be atleast 900*500!');
                                   }                          
                               };


                           };

                           reader.readAsDataURL(input.files[0]);
                     }else{
                         $("#error_message").html('Invalid Image!');
                     }      

           }
        }
        $("#cover_image").change(function(){
          
            readURL(this,'cover_image_preview');
        });    
        $(".deleteImage").on('click',function(e){
            e.preventDefault();
            var imageID=$(this).attr('data-id');
            //alert(imageID);
             $(this).closest('.garageImage').remove();
            if (confirm('Are you sure you want to delete this?')) {
              $.ajax({
                    url: 'delete_garage_images',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: {iImageId:imageID},         
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function (data) {                       
                       if(data=='succssfully'){
                         $(this).parents(".garageImage").remove(); 
                         $("#loading-image").hide();
                       }
                           
                    },
                    error: function (data) {
                       
                    }
                });
              return false;
            }  
            
        });

        var ASSETS_URL='<?php echo ASSETS_URL; ?>';  
        var abc = 0;
        $('#add_more').click(function(e) {
        e.preventDefault();
         
       
        $("#more_images_preview").before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $('<li class="col-sm-3 col-md-3 col-lg-3 col-xs-12"><span>'+'</span>'+'<a class="file_preview" href="javascript:void(0);">'+'<img class="image" src="'+ASSETS_URL+'/uploads/placeholder.jpg" alt="SEO Name">'+
                  '<div class="div">'+'<i class="fa fa-camera" aria-hidden="true"></i>'+'</div>'+'</a>'+'<input type="file" name="file[]" id="morefiles" style="display:none;">'+'</li>')
                ));
    }); 
        $('body').on('click', '.file_preview', function(){ 
     $(this).next('input').trigger('click');

 });
        function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
 };

        //following function will executes on change event of file input to select different file	
        $('body').on('change', '#morefiles', function(){
                    if (this.files && this.files[0]) {
                         abc += 1; 				
                        var z = abc - 1;
                        var x = $(this).parent().find('#previewimg' + z).remove();
                        $(this).before("<div id='abcd"+ abc +"' class='abcd'><img class='image' id='previewimg" + abc + "' src=''/></div>");

                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);

                        $(this).hide();
                        $('.file_preview').hide();
                        $("#abcd"+ abc).append($("<img src='"+ASSETS_URL+"/remove.png' class='remove_image_icon'/>").click(function() {    
                        $(this).parent().parent().remove();
                        }));
                    }
         }); 
         
        $("#coupon").on("click", function (e) {
          var checkbox = $(this);
            if (checkbox.is(":unchecked")) {
                // do the confirmation thing here
                e.preventDefault();
                return false;
            }
        });
        $("#vCouponDiscount").on("change", function (e) {
            var discountValue=$(this).val();
             //console.log(discountValue);
            if(discountValue==1){
                console.log(33);
                $("#coupon_msg").show();
            }else{
                $("#coupon_msg").hide();
            }
            return true;
        }); 
      

 });


    

</script>  
