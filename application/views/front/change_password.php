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
                    <form role="form" id="ChangePasswordForm" method="post" enctype="multipart/form-data">
                        <div class="col-lg-3 profile-sidebar">
                                <div class="panel panel-default">
                                  <div class="panel-heading profile-title">
                                        <h3><?php echo ($UserData['vName'] !='' ? $UserData['vName'] : ''); ?></h3>
                                  </div>
                                  <div class="panel-body profile-body"><img src="<?php echo ($UserData['vProfileImage'] !='' ? DOMAIN_URL.$UserData['vProfileImage'] : ''); ?>" class="img-responsive profile-picture" id="preview_profile_pic"/>

                                        <p><i class="fa fa-user"></i> You since: <?php echo ($UserData['dCreatedDate'] !='' ? date('d M Y', strtotime($UserData['dCreatedDate'])) : ''); ?></p>
                                        <p><i class="fa fa-user"></i> Last modified: <?php echo ($UserData['dModifyDate'] !='' ? date('d M Y', strtotime($UserData['dModifyDate'])) : ''); ?></p>
                                        <p style="display:none;"><a href="<?php echo DOMAIN_URL; ?>/shop/create" class=""><i class="fa fa-plus-circle"></i> Add Repair Shop</a></p>
                                        
 
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
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                        <label for="vOldPassword" class="profile-field-label">Old Password:</label>
                                                       <input type="password" name="vOldPassword" id="vFirstName" class="form-control input-sm profile-field" placeholder="Old Password" tabindex="1" value="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">

                                                <div class="col-lg-10">  
                                                        <div class="form-group">
                                                        <label for="vPassword"  class="profile-field-label">New Password:</label>
                                                                <input type="password" name="vPassword" id="vPassword" class="form-control input-sm profile-field" placeholder="Password" tabindex="2"  value="">
                                                        </div>
                                                </div>
                                                

                                        </div>
                                      <div class="row">

                                                <div class="col-lg-10">  
                                                        <div class="form-group">
                                                        <label for="vConfirmPassword"  class="profile-field-label">Confirm New Password:</label>
                                                                <input type="password" name="vConfirmPassword" id="vConfirmPassword" class="form-control input-sm profile-field" placeholder="Confirm Password" tabindex="2"  value="">
                                                        </div>
                                                </div>
                                                <div class="col-lg-10">  
                                                  <div class="edit-profile-btn">
                                                    <a id="updateData" href="javascript:void(0);" class="btn btn-default">SAVE PASSWORD</a>
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

<script type="text/javascript">
    $(document).ready(function() {

        $("#ChangePasswordForm").validate({
            rules: {
                vOldPassword: {
                    required: true
                },
                vPassword: {
                    required: true
                },
                vConfirmPassword: {
                    required: true,                    
                    equalTo: '#vPassword' 
                }
            },
            messages: {
                vOldPassword: {
                    required: "Old Password is required"
                },
                 vPassword: {
                    required: "New Password is required"
                },
                 vConfirmPassword: {
                    required: "Confirm Password is required",
                    equalTo: "Confirm Password and password should be same"
                }
            }

        });

        $("#updateData").click(function(){
            $('#ChangePasswordForm').submit();
            if($("#ChangePasswordForm").valid())
            {

                var formData = new FormData($("#ChangePasswordForm")[0]);

                $.ajax({
                    url: 'save_New_password',
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
                       if(data=='New Password Successfully Updated!!'){
                            $("#msg").show();
                            $("#msg").removeClass('error_alert_bar');
                            $("#msg").addClass('success_alert_bar');
                            $("#msg").html(data);
                            $("#loading-image").hide();
                        }else{
                            $("#msg").show();
                            $("#msg").removeClass('success_alert_bar');
                            $("#msg").addClass('error_alert_bar');
                            $("#msg").html(data);
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
        