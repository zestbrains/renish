<?php
$explodeName=explode(' ',$UserData['vName']);
$fname=$explodeName[0];
$lname=$explodeName[1];
?>
 <div class="spacer-small"></div>
	<!-- PAGEBODY -->
    	 <div class="container" style="margin-top: 100px !important;">

                <div class="row ">
                <div class="container" >
                    <form role="form" id="EditProfileForm" method="post" enctype="multipart/form-data">
                        <div class="col-lg-3 profile-sidebar">
                                <div class="panel panel-default">
                                  <div class="panel-heading profile-title">
                                        <h3 style="margin-top: 10px !important;"><?php echo ($UserData['vName'] !='' ? $UserData['vName'] : ''); ?></h3>
                                  </div>
                                  <div class="panel-body profile-body"><img src="<?php echo ($UserData['vProfileImage'] !='' ? DOMAIN_URL.$UserData['vProfileImage'] : ''); ?>" class="img-responsive profile-picture" id="preview_profile_pic"/>

                                        <p><i class="fa fa-user"></i> You since: <?php echo ($UserData['dCreatedDate'] !='' ? date('d M Y', strtotime($UserData['dCreatedDate'])) : ''); ?></p>
                                        <p><i class="fa fa-user"></i> Last modified: <?php echo ($UserData['dModifyDate'] !='' ? date('d M Y', strtotime($UserData['dModifyDate'])) : ''); ?></p>
                                        <p><a href="<?php echo DOMAIN_URL; ?>/user/change_psw" class=""><i class="fa fa-plus-circle"></i>Change password</a></p>
                                        <p><a href="<?php echo DOMAIN_URL; ?>/shop/create" class=""><i class="fa fa-plus-circle"></i> Add Repair Shop</a></p>
                                        
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
                                       <h3>Basic information</h3>
                                  </div>
                                  <div class="panel-body">
                                      <div id="error_message" class="error" style="  font-weight: bold;"></div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                        <label for="FirstName" class="profile-field-label">FirstName:</label>
                                                       <input type="text" name="vFirstName" id="vFirstName" class="form-control input-sm profile-field" placeholder="Firstname" tabindex="1" value="<?php echo ($fname !='' ? $fname : ''); ?>">
                                                </div>
                                            </div>
                                             <div class="col-lg-4">
                                                <div class="form-group">
                                                        <label for="vLastName" class="profile-field-label">LastName:</label>
                                                       <input type="text" name="vLastName" id="vLastName" class="form-control input-sm profile-field" placeholder="Lastname" tabindex="1" value="<?php echo ($lname !='' ? $lname : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                        <div class="form-group">
                                                        <label for="Email"  class="profile-field-label">Email:</label>
                                                        <input type="email" name="vEmail" id="vEmail" class="form-control input-sm profile-field" placeholder="Email address" tabindex="2"  value="<?php echo ($UserData['vEmail'] !='' ? $UserData['vEmail'] : ''); ?>" readonly>
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                                <div class="col-lg-6">  
                                                        <div class="form-group">
                                                        <label for="Zipcode"  class="profile-field-label">Zipcode:</label>
                                                                <input type="text" name="vPinCode" id="last_name" class="form-control input-sm profile-field" placeholder="Zipcode" tabindex="2"  value="<?php echo ($UserData['vPinCode'] !='' ? $UserData['vPinCode'] : ''); ?>">
                                                        </div>
                                                </div>
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                        <label for="inputdefault"  class="profile-field-label">Mobile Number:</label>
                                                                <input type="text" name="vMobileNo" id="vMobileNo" class="form-control input-sm profile-field" placeholder="Mobile Number" tabindex="2"  value="<?php echo ($UserData['vMobileNo'] !='' ? $UserData['vMobileNo'] : ''); ?>">
                                                        </div>
                                                </div>

                                        </div>
                                        <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="inputdefault"  class="profile-field-label">Profile Photo:</label>
                                                            <input type="file" name="vProfileImage" id="vProfileImage" value=""/>
                                                       </div>

                                                    </div>
                                        </div>
                                  </div>
                             </div>
                        </div>
                        <input type="hidden" name="iUserId" value="<?php echo ($UserData['iUserId'] !='' ? $UserData['iUserId'] : ''); ?>">
                         <input type="submit" name="submit"  value="Update" style="opacity: 0; visibility: hidden;">
                    </form>   
                </div>

                </div>
              <div id="loading-image"  style="display: none;">
                           <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>
              </div>
    </div>
	<!-- PAGEBODY -->
    
        <div class="spacer-big"></div>
       
<script>

 
 function readURL(input) {
     var fileTypes = ['png', 'jpg', 'gif', 'jpeg', 'bmp'];
    if (input.files && input.files[0]) {
        var reader = new FileReader();
       
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;
              if (isSuccess) {
                    reader.onload = function (e) {
                        $("#error_message").html('');   
                        $('#preview_profile_pic').attr('src', e.target.result);
                    };
                     
                    reader.readAsDataURL(input.files[0]);
              }else{
                  $("#error_message").append('Invalid Image!');
              }      
        
    }
}

$("#vProfileImage").change(function(){
    readURL(this);
});

</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#EditProfileForm").validate({
            rules: {
                vFirstName: {
                    required: true
                },
                vLastName: {
                    required: true
                },
                vPinCode: {
                    required: true,                    
                     minlength: 5, 
                     number: true
                },
                 vEmail: {
                    required: true
                }
            },
            messages: {
                vFirstName: {
                    required: "FIrstname is required"
                },
                 vLastName: {
                    required: "Lastname is required"
                },
                 vPinCode: {
                    required: "zipcode is required",
                    minlength: "Zipcode should be at least {5} characters long",
                    number: "Zipcode Should be number"
                },
                vEmail: {
                    required: "email is required"
                }
            }

        });

        $("#updateData").click(function(){
            $('#EditProfileForm').submit();
            if($("#EditProfileForm").valid())
            {

                var formData = new FormData($("#EditProfileForm")[0]);

                $.ajax({
                    url: 'save_profile_data',
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
                       if(data=='Successfully Updated!!'){
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

    });


    

</script>
        