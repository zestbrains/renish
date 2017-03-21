 <div class="spacer-small"></div>
 
 
      <!-- PAGEBODY -->
      <div class="container" style="margin-top: 100px !important;">
        <div class="row ">
          <div class="container" >
              <form method="post" id="create_garage" enctype="multipart/form-data" >
                  <input type="hidden" value="<?php echo (isset($GarageData['iGarageId']) !='' ? $GarageData['iGarageId'] : ''); ?>" name="iGarageId">  
               <div class="col-lg-3 profile-sidebar">
                                <div class="panel panel-default">
                                  <div class="panel-heading profile-title">
                                        <h3 style="margin-top: 10px !important;"><?php echo ($UserData['vName'] !='' ? $UserData['vName'] : ''); ?></h3>
                                  </div>
                                  <div class="panel-body profile-body">
                                  <div class="shopimgpara"><img src="<?php echo ($UserData['vProfileImage'] !='' ? DOMAIN_URL.$UserData['vProfileImage'] : ''); ?>" class="img-responsive profile-picture" id="preview_profile_pic"/></div>

                                        <p><i class="fa fa-user"></i> You since: <?php echo ($UserData['dCreatedDate'] !='' ? date('d M Y', strtotime($UserData['dCreatedDate'])) : ''); ?></p>
                                        <p><i class="fa fa-user"></i> Last modified: <?php echo ($UserData['dModifyDate'] !='' ? date('d M Y', strtotime($UserData['dModifyDate'])) : ''); ?></p>
                                        <p><a href="<?php echo DOMAIN_URL; ?>/user/edit_profile" class=""><i class="fa fa-plus-circle"></i>Edit profile</a></p>

                                        <div class="edit-profile-btn">
                                            <a id="updateData" href="javascript:void(0);" class="sr-button button-1 button-icon-text button-mini rounded"><i class="fa fa-save"></i>Update</a>
                                           
                                        </div> 
                                  </div>
                                </div>




            </div>
            
               
               <div class="col-lg-9 profile-container">
                   <div id="msg" style="display: none;" class="alert alert-info error_alert_bar"></div>
              <div class="panel panel-default">
                <div class="panel-heading profile-small-title">
                  <h3>Create Repair Shop:</h3>
                </div>
                <div id="loading-image"  style="display: none;">
                           <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>
               </div>
                <div class="panel-body">
                  
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="inputdefault" class="profile-field-label">Name of Repair Shop:</label>
                          <input type="text" name="vGarageName" id="vGarageName" class="form-control input-sm profile-field" value="<?php echo (isset($GarageData['vGarageName']) !='' ? $GarageData['vGarageName'] : ''); ?>" placeholder="First Name" tabindex="1" >
                        </div>
                      </div>
                    </div>                  
                    
                     <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Country:</label>
                          <?php
                          if($GarageData['iCountryId']==''){
                              $GarageData['iCountryId']=DEFAULT_COUNTRY;
                          }
                          ?>
                          <select name="iCountryId" id="iCountryId" class="form-control">
                              <option value="">select country</option>
                            <?php foreach ($countries as $country) {$selected = ($GarageData['iCountryId'] != '' ? ($country['iCountryId'] == $GarageData['iCountryId']) ? 'selected="selected"' : '' : '');?>
                               <option value="<?php echo $country['iCountryId']; ?>" <?php echo $selected; ?>><?php echo $country['vCountry']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                         
                         
                      <div class="col-lg-4">
                        <div class="form-group">
                         <label for="inputdefault"  class="profile-field-label">State:</label>
                          <?php
                         
                          ?>
                           <select name="iStateId" id="iStateId" class="form-control">
                            <?php foreach ($states as $state) {$selected = ($GarageData['iStateId'] != '' ? ($state['iStateId'] == $GarageData['iStateId']) ? 'selected="selected"' : '' : '');?>
                               <option value="<?php echo $state['iStateId']; ?>" <?php echo $selected; ?>><?php echo $state['vState']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                         
                        <div class="col-lg-4">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">City:</label>
                          <?php
                         
                          ?>
                           <select name="iCityId" id="iCityId" class="form-control">
                            <?php foreach ($cities as $city) {$selected = ($GarageData['iCityId'] != '' ? ($city['iCityId'] == $GarageData['iCityId']) ? 'selected="selected"' : '' : '');?>
                               <option value="<?php echo $city['iCityId']; ?>" <?php echo $selected; ?>><?php echo $city['vCity']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>   
                         
                     
                      
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Zipcode:</label>
                           <input type="text" name="vZipCode" id="vZipCode" class="form-control input-sm profile-field" placeholder="zipcode" tabindex="1" value="<?php echo (isset($GarageData['vZipCode']) !='' ? $GarageData['vZipCode'] : ''); ?>" >
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                           <label for="inputdefault"  class="profile-field-label">Mobile No:</label>
                           <input type="text" name="vMobile" id="vMobile" class="form-control input-sm profile-field" placeholder="mobile number" tabindex="1" value="<?php echo (isset($GarageData['vMobile']) !='' ? $GarageData['vMobile'] : ''); ?>" >
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                           <label for="inputdefault"  class="profile-field-label">Office number:</label>
                           <input type="text" name="vOffice_mobile" id="vOffice_mobile" class="form-control input-sm profile-field" placeholder="office number" tabindex="1" value="<?php echo (isset($GarageData['vOffice_mobile']) !='' ? $GarageData['vOffice_mobile'] : ''); ?>" >
                        </div>
                      </div>  
                      
                    </div>
                     <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">Address:</label>
                          <textarea rows="3" name="vAddress" id="vAddress" class="form-control profile-field" placeholder="Address" style="height:auto !important;"><?php echo (isset($GarageData['vAddress']) !='' ? $GarageData['vAddress'] : ''); ?></textarea>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="inputdefault"  class="profile-field-label">About Shop:</label>
                          <textarea rows="3" id="tDescription" name="tDescription" class="form-control profile-field" placeholder="Write About your Business" style="height:auto !important;"><?php echo (isset($GarageData['tDescription']) !='' ? $GarageData['tDescription'] : ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-lg-12">
                        <label for="inputdefault" class="profile-field-label">Shop Type:</label>
                         <label class="radio-inline"><input type="radio" value="1" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==2) ? 'checked="checked"' : ''); ?> >Repair Shop</label>
                         <label class="radio-inline"><input type="radio" value="2" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==1) ? 'checked="checked"' : ''); ?> >Body Shop</label>                       
                         <label class="radio-inline"><input type="radio" value="3" name="vGarageType" <?php echo ((isset($GarageData['vGarageType']) !='' && $GarageData['vGarageType']==3) ? 'checked="checked"' : ''); ?> >Both</label>
                      </div>
                     </div> 
                    <br>
                      <div class="row ">  
                      <div class="col-lg-12">
                        <div class="">
                          <label for="inputdefault" class="profile-field-label">Total mechanics:</label>
                          <select id="iTotalMechanic" name="iTotalMechanic" class="form-control2">
                            <option value="1" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==1) ? 'selected="selected""' : ''); ?>>1</option>
                            <option value="2" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==2) ? 'selected="selected""' : ''); ?> >2</option>
                            <option value="3" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==3) ? 'selected="selected""' : ''); ?>>3</option>
                            <option value="4" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==4) ? 'selected="selected""' : ''); ?>>4</option>
                            <option value="5" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==5) ? 'selected="selected""' : ''); ?>>5</option>
                            <option value="6" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==6) ? 'selected="selected""' : ''); ?>>6</option>
                            <option value="7" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==7) ? 'selected="selected""' : ''); ?>>7</option>
                            <option value="8" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==8) ? 'selected="selected""' : ''); ?>>8</option>
                            <option value="9" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==9) ? 'selected="selected""' : ''); ?>>9</option>
                            <option value="10" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']==10) ? 'selected="selected""' : ''); ?>>10</option>
                            <option value="10+" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']=='10+') ? 'selected="selected""' : ''); ?>>10+</option>
                            <option value="20+" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']=='20+') ? 'selected="selected""' : ''); ?>>20+</option>
                            <option value="50+" <?php echo ((isset($GarageData['iTotalMechanic']) !='' && $GarageData['iTotalMechanic']=='50+') ? 'selected="selected""' : ''); ?>>50+</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row section-break working-days">
                        <div class="col-lg-12 days">
                          <h3>Working Hours</h3>
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
                            <div class="col-lg-12 days">
                              <div class="col-lg-4 days text-center">
                                  <label><input type="checkbox" value=""  class="work-checkbox <?php echo $working_day; ?>" <?php echo ((isset($workingHours[$i]['start']) && $workingHours[$i]['start']!='0:00') !='' ? 'checked' : ''); ?>><?php echo $dayfull; ?></label>
                              </div>
                              <div class="col-lg-4 days">
                                  <input type="text" class="form-control single-input" id="<?php echo $start_time; ?>" name="<?php echo $start_time; ?>"  value="<?php echo ((isset($workingHours[$i]['start']) && $workingHours[$i]['start']!='0:00') !='' ? $workingHours[$i]['start'] : ''); ?>" placeholder="00.00">
                              </div>
                              <div class="col-lg-4 days">
                                <input type="text" class="form-control single-input" id="<?php echo $end_time; ?>" name="<?php echo $end_time; ?>" value="<?php echo ((isset($workingHours[$i]['end']) && $workingHours[$i]['end']!='0:00') !='' ? $workingHours[$i]['end'] : ''); ?>" placeholder="00.00">
                              </div>
                            </div>
                        <?php } ?> 
                        
                        
                    
                    </div>
                    
                    <div class="row section-break">
<!--                      <div class="col-lg-6">
                        <div class="form-group cover-image">
                          <label for="inputdefault"  class="profile-field-label">Cover Photo:</label>
                          
                        </div>
                      </div>-->
                       <div class="col-lg-12">
                        <div class="form-group cover-image">
                          <label for="inputdefault" class="profile-field-label">Cover Photo:</label>
						  <br>
                          <span class="note"><b>Note:</b>Cover image should be minimun 900*500 size </span>
                        </div>
                      </div> 
                     <div class="clearfix"></div>
                      <div class="col-lg-12">
                        <a href="javascript:void(0);" id="UploadCoverImg"> 
                            <?php if(isset($GarageData['vCoverImage']) && $GarageData['vCoverImage']!='') { ?>
                               <img  id="cover_image_preview" class='image big-image' src="<?php echo DOMAIN_URL.'/'.$GarageData['vCoverImage']; ?>" alt="SEO Name"/>                              
                               
                            <?php }else{?>
                               <img  id="cover_image_preview" class='image big-image' src="<?php echo ASSETS_URL; ?>/uploads/placeholder.jpg" alt="SEO Name"/>                               
                             <?php } ?>  
                            <div class="div">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </div>                            
                        </a>
                          <div id="error_message" class="error" style="  font-weight: bold;"></div>
                          <input type="file" name="vCoverImage" id="cover_image" value="<?php echo (isset($GarageData['vCoverImage']) !='' ? $GarageData['vCoverImage'] : ''); ?>" style="display: none;" >
                      </div>
                    </div>
                    <?php if(isset($GarageData['vCoverImage']) && $GarageData['vCoverImage']!='') { ?>
                        <input type="hidden" value="1" name="is_cover_image">
                    <?php } else{ ?>
                        <input type="hidden" value="0" name="is_cover_image">
                    <?php } ?>
                </div>
                      
              </div>
              <div class="panel panel-default">
                <div class="panel-heading profile-small-title">
                  <h3>Coupon Code:</h3>
                </div>
                <div class="panel-body">
                  <div class="checkbox">
                    <input type="checkbox" value="" id="coupon"   class="work-checkbox" checked>
                      <label>I will give 
                        <select id="vCouponDiscount" name="vCouponDiscount" class="form-control2" style="border: none;border-bottom: 2px solid #CCC;" >
                             <?php foreach ($discouts as $discount) {$selected = ($GarageData['vCouponDiscount'] != '' ? ($discount['iDiscountId'] == $GarageData['vCouponDiscount']) ? 'selected="selected"' : '' : '');?>
                               <option value="<?php echo $discount['iDiscountId']; ?>" <?php echo $selected; ?>><?php echo $discount['iPercentage']; ?></option>
                            <?php }?>                        
                          </select> % Discount, when bill amount should be more then $ <input type="text" name="vAmountForCoupon" id="vAmountForCoupon" class="form-control2 coupon-code input-sm profile-field work-input" placeholder="amount" tabindex="2"  value="<?php echo (isset($GarageData['vAmountForCoupon']) !='' ? $GarageData['vAmountForCoupon'] : '00'); ?>"> </label>
                  </div>
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
                
               <?php if(isset($GarageImages) && $GarageImages!=''){ ?>    
                <div class="panel panel-default">
                      <div class="panel-heading profile-small-title">
                          <h3>Existing Images</h3>                          
                      </div>
                      <div class="panel-body photos-garage">
                          <ul>
                              <?php
                              for($k=0;$k<count($GarageImages);$k++){
                              ?>
                              
                              <li class="garageImage" data-id="<?php echo $GarageImages[$k]['iImageId']; ?>">
                                  <span>
                                      <a href="#" data-id="<?php echo $GarageImages[$k]['iImageId']; ?>" class="deleteImage"> <i class="fa fa-close" aria-hidden="true"></i></a>
                                  </span>
                                    <a href="#" >
                                            <img class="image" src="<?php echo DOMAIN_URL.'/'.$GarageImages[$k]['vImage']; ?>" alt="SEO Name">
                                            <div class="div">
<!--                                                       <i class="fa fa-camera" aria-hidden="true"></i>-->
                                            </div>
                                    </a>
				</li>
                              <?php } ?> 
				 
			  </ul>
                     </div>
                 </div>  
               <?php } ?>  
                   
                <div class="panel panel-default">
                      <div class="panel-heading profile-small-title">
                          <h3>Photos</h3>
                          <a id="add_more" href="#" class="add-more-btn-services"><i class="fa fa-plus-circle"></i> Add More Photos</a>
                          <input type="file" id="add_more_images" style="display: none;" >
                      </div>
                      <div class="panel-body photos-garage">
                              
                          <ul id="more_images_preview"></ul>
                     </div>
                </div>
              
			  
                            
                 </div>  
                  
                  <input type="submit" id="submitForm" name="submit" style="opacity: 0;">   
              </form>    
                     
	      </div>          
          </div>
        </div>
     

<!--<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="z-index:9999999;">
      <div class="modal-dialog service-popup" style="">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Handyman</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">?/span><span class="sr-only">Close</span></button>
          </div>
          <div class="modal-body service-popup-body">
            <div class="row">
               content goes here 
              <div class="col-lg-12">
                <ul class="nav nav-tabs">
                  <li class="active" style="margin-top: 10px;"><a data-toggle="tab" href="#home">Overview</a></li>
                  <li><a data-toggle="tab" href="#menu1">Reviews</a></li>
                  <li><a data-toggle="tab" href="#menu2">Photos / Videos</a></li>
                </ul>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to makeLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                  </div>
                  <div id="menu1" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Some content in menu 1.</p>
                  </div>
                  <div id="menu2" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Some content in menu 2.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
              </div>
              <div class="btn-group btn-delete hidden" role="group">
                <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
              </div>
              <div class="btn-group" role="group">
                <button type="button" id="saveImage" class="btn btn-primary" data-action="save" role="button"><i class="fa fa-cart-arrow-down"></i> 	Order Now</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
 
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/jquery-clockpicker.min.css" type="text/css" media="all" />      
<script src="<?php echo ASSETS_URL; ?>/js/jquery-clockpicker.min.js" type="text/javascript"></script>     
<script type="text/javascript">
   

$(function(){ 
   var URL='<?php echo DOMAIN_URL; ?>';  
    getStates();
  $("#iCountryId").change(function (){     
    getStates();
  });
  $("#iStateId").change(function (){     
    getCities();
  });
  function getStates(){
    var URL='<?php echo DOMAIN_URL; ?>';  
    options='<option value="">Please Select State</option>';

    if($("#iCountryId").val() != "")
    {
      var iCountryId = $("#iCountryId option:selected").val();
      $.post(URL+'/setting/getState/',{id:iCountryId}, function(data) {
         
      var obj=JSON.parse(data);
      state='<?php echo isset($GarageData['iStateId']) ? $GarageData['iStateId']:''; ?>';
      for(i=0;i<obj.length;i++){
            options += '<option value="'+obj[i].iStateId+'" '+(state==obj[i].iStateId?"selected":"")+'>'+obj[i].vState+'</option>';
         }
      $('#iStateId').html(options);
      });
    }else{
      $('#iStateId').html(options);
    }
  }
  function getCities(){
   
    options='<option value="">Please Select City</option>';

    if($("#iStateId").val() != "")
    {
      var iStateId = $("#iStateId option:selected").val();
     
      $.post(URL+'/setting/getCity/',{id:iStateId}, function(data) {         
      var objc=JSON.parse(data);
     // console.log(data);
      
      city='<?php echo isset($GarageData['iCityId']) ? $GarageData['iCityId']:''; ?>';
      for(i=0;i<objc.length;i++){
            options += '<option value="'+objc[i].iCityId+'" '+(city==objc[i].iCityId?"selected":"")+'>'+objc[i].vCity+'</option>';
         }
      $('#iCityId').html(options);
      });
    }else{
      $('#iCityId').html(options);
    }
  }

});

//Cover Image Selection
$("#UploadCoverImg").on('click', function(e){
     e.preventDefault();
    $("#cover_image:hidden").trigger('click');
});
    
 //Clock
$('.single-input').clockpicker({
      placement: 'bottom',
      align: 'right',
      autoclose: true,
      'default': '20:48'
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
                  $("#error_message").append('Invalid Image!');
              }      
        
    }
}

$("#cover_image").change(function(){
    readURL(this,'cover_image_preview');
});
//More images
var ASSETS_URL='<?php echo ASSETS_URL; ?>';  
 var abc = 0;
  $('#add_more').click(function(e) {
        e.preventDefault();
         
       
        $("#more_images_preview").before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $('<li><span>'+'</span>'+'<a class="file_preview" href="javascript:void(0);">'+'<img class="image" src="'+ASSETS_URL+'/uploads/placeholder.jpg" alt="SEO Name">'+
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
                $("#abcd"+ abc).append($("<img src='"+ASSETS_URL+"/x.png'/>").click(function() {    
                $(this).parent().parent().remove();
                }));
            }
 }); 
 
 
 //validation
   

</script>    
      
 <script type="text/javascript">
    $(document).ready(function() {
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

        $("#create_garage").validate({
             ignore: "",
            rules: {
                vGarageName: {
                    required: true
                },
                mon_start_time:{
                  required: function (element) {
                     if($(".mon_working_day").is(':checked')){
                         var e =document.getElementById("mon_start_time");                   
                           return e.value=="" ;                     
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                mon_end_time:{
                   required: function (element) {
                      if($(".mon_working_day").is(':checked')){
                          var e =document.getElementById("mon_start_time");                    
                           return e.value=="" ;                           
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                tue_start_time:{
                  required: function (element) {
                     if($(".tue_working_day").is(':checked')){
                         var e = document.getElementById("tue_start_time");
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                tue_end_time:{
                   required: function (element) {
                      if($(".tue_working_day").is(':checked')){
                          var e = document.getElementById("tue_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                wed_start_time:{
                  required: function (element) {
                     if($(".wed_working_day").is(':checked')){
                         var e = document.getElementById("wed_start_time");
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                wed_end_time:{
                   required: function (element) {
                      if($(".wed_working_day").is(':checked')){
                          var e = document.getElementById("wed_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                thu_start_time:{
                  required: function (element) {
                     if($(".thu_working_day").is(':checked')){
                         var e = document.getElementById("thu_start_time");
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                thu_end_time:{
                   required: function (element) {
                      if($(".thu_working_day").is(':checked')){
                          var e = document.getElementById("thu_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                fri_start_time:{
                  required: function (element) {
                     if($(".fri_working_day").is(':checked')){
                         var e = document.getElementById("fri_start_time");
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                fri_end_time:{
                   required: function (element) {
                      if($(".fri_working_day").is(':checked')){
                          var e = document.getElementById("fri_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                sat_start_time:{
                  required: function (element) {
                     if($(".sat_working_day").is(':checked')){
                         var e = document.getElementById("sat_start_time");
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                sat_end_time:{
                   required: function (element) {
                      if($(".sat_working_day").is(':checked')){
                          var e = document.getElementById("sat_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                sun_start_time:{
                  required: function (element) {
                     if($(".sun_working_day").is(':checked')){
                         var e = document.getElementById("sun_start_time");
                         
                         return e.value=="" ;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
                sun_end_time:{
                   required: function (element) {
                      if($(".sun_working_day").is(':checked')){
                          var e = document.getElementById("sun_end_time");
                          return e.value=="" ;                            
                      }
                      else
                      {
                          return false;
                      }  
                   }  
                },
                vAmountForCoupon:{
                   required: function (element) {                      
                        if($("#coupon").is(':checked')){                          
                             var e = document.getElementById("vAmountForCoupon");
                             return e.value=="" ;     
                        }
                        else
                        {
                           return false;     
                        }  
                     
                   }  
                },
                iCountryId:{required: true},
                iStateId:{required: true},
                vAddress:{required: true},
                tDescription:{required: true},
                vGarageType:{required: true},
                iTotalMechanic:{required: true},
                vZipCode:{required: true},
                vMobile:{required: true}
                
                
            },
            messages: {
                vGarageName: {
                    required: "Garage name is required"
                },
                mon_start_time: {
                    required: "required"
                },
                mon_end_time:{
                    required: "required"
                },
                tue_start_time: {
                    required: "required"
                },
                tue_end_time:{
                    required: "required"
                },
                wed_start_time: {
                    required: "required"
                },
                wed_end_time:{
                    required: "required"
                },
                thu_start_time: {
                    required: "required"
                },
                thu_end_time:{
                    required: "required"
                },
                fri_start_time: {
                    required: "required"
                },
                fri_end_time:{
                    required: "required"
                },
                sat_start_time: {
                    required: "required"
                },
                sat_end_time:{
                    required: "required"
                },
                sun_start_time: {
                    required: "required"
                },
                sun_end_time:{
                    required: "required"
                },
                vAmountForCoupon:{
                    required: "Amount is required!!"
                }
            }

        });
        $("#updateData").click(function(){
            $('#create_garage').submit();
            if($("#create_garage").valid())
            {

                var formData = new FormData($("#create_garage")[0]);
                $.ajax({
                    url: 'save_garage_data',
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
                        //console.log(data);
                       if(data=='successfully!!'){
                            $("#msg").show();
                            $("#msg").removeClass('error_alert_bar');
                            $("#msg").addClass('success_alert_bar');
                            $("#msg").html(data);
                            $("#loading-image").hide();
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

            }
            else{
                $("#msg").show();
                $("#msg").removeClass('success_alert_bar');
                $("#msg").addClass('error_alert_bar');
                $("#msg").html('Please check mendatory fields!!');
            }
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

      

    });


    

</script>     