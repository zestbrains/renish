<div class="spacer-small"></div>
<div class="container" style="margin-top: 100px !important;">
  <div class="row">
    <?php if($is_activation_pending){ ?>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-sm-offset-1" id="activationForm" >
      <form role="form" id="activation_form" method="post">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 title-hading" style="text-align:center;"> <img src="<?php echo ASSETS_URL; ?>/manual/email.png"/>
            <h3>Check your email<br>
              Activate Your account here..</h3>
            <p>We sent you varification code into your register email address.</p>
          </div>
        </div>
        <div id="msg" class="error"></div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <input type="text" name="vActivationToken" id="vActivationToken" class="form-control input-lg" placeholder="Varirifcation code" tabindex="5">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <input type="submit" value="Verify" class="btn btn-primary btn-lg" style="width:100%;">
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php }else{ ?>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 customer-login-form col-sm-offset-1" id="registrationForm">
      <form role="form" id="RegisterForm" method="post">
        <input type="hidden" name="eUserRole" value="<?php echo $user_type; ?>" >
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 title-hading" style="text-align:center;">
            <h3><?php echo $heading ? $heading :'Register Here'; ?></h3>
            <p><?php echo $semi_heading ? $semi_heading :'Provide below detail'; ?></p>
          </div>
        </div>
        <div id="msg" class="error"></div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="vFirstName" id="vFirstName" class="form-control input-lg" placeholder="First Name" tabindex="1">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="vLastName" id="vLastName" class="form-control input-lg" placeholder="Last Name" tabindex="2">
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="text" name="vPinCode" id="vPinCode" class="form-control input-lg" placeholder="Zip Code" tabindex="3">
        </div>
        <div class="form-group">
          <input type="email" name="vEmail" id="vEmail" class="form-control input-lg" placeholder="Email Address" tabindex="4">
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="password" name="vPassword" id="vPassword" class="form-control input-lg" placeholder="Password" tabindex="5">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="password" name="vPassword_confirm" id="vPassword_confirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <input type="submit" value="Register" class="btn btn-primary btn-lg" style="width:100%;" tabindex="7">
            </div>
            <div class="form-group"> Already have Account ? <a href="<?php echo DOMAIN_URL; ?>/user/login" tabindex="8" class="small-link" >Login</a> </div>
          </div>
          <div id="loading-image"  style="display: none;">
            <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>
          </div>
        </div>
      </form>
    </div>
    <?php } ?>
    <?php if($is_invitation){ ?>
    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 invite-friends col-sm-offset-1">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 title-hading" style="text-align:center;">
          <h3>Enter Invitation Code</h3>
          <img src="<?php echo ASSETS_URL; ?>/manual/activation-code.png" height="113" style="height:124px;margin-bottom:20px;"/>
          <p>You can also register with us using invitation code</p>
        </div>
      </div>
      <div class="loginvi">
        <div class="form-group">
          <input type="text" name="invitationcode" id="email" class="form-control input-lg" placeholder="Enter Invitation Code" >
        </div>
        <div class="form-group">
          <input type="submit" value="Invite" class="btn btn-primary btn-lg" style="width:100%;">
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="spacer-big"></div>
<!--- Registration Confirmation modal for customers-->
        <div id="Confirm_customer_registration" class="modal">
               <div class="modal-content">
                   <span class="close" id="close_modal">&times;</span>
                 <div align="center">
                     <h3>Congratulations!<span>You have successfully registered with Sureforless.com!</span></h3>
                        
                      <span>Explore unlimited repair & body shops, view reviews and get discounts.</span>
                        
                                <a href="javascript:void(0);" id="registration_completed" class="btn btn-lg btn-default read-more model-btn">Start Exploring</a>
                        
                 </div>         
               </div>
        </div>
<!--- END ------>
<script>
     $(document).ready(function () {
         $("#close_modal").click(function(){
             var redirect_url='<?php echo DOMAIN_URL.'/'.$last_page; ?>';  
             window.location.href=redirect_url;
         });
        $("#RegisterForm").validate({
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
                    required: true,
                },
                vPassword: {
                    required: true,
                    minlength: 6  // <-- removed underscore
                },
                 vPassword_confirm: {
                    required: true,
                    equalTo: '#vPassword'  // <-- removed underscore
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
                },
                vPassword: {
                    required: "Password is required",
                    minlength: "Password should be at least {6} characters long" // <-- removed underscore
                },
                vPassword_confirm: {
                    required: "Password is required",
                    equalTo: "Password and confirm password should be same" // <-- removed underscore
                }
            },
            submitHandler: function (form) { 
                $("input[type=submit]").attr("disabled", "disabled");
                var redirect_url='<?php echo DOMAIN_URL.'/'.$last_page; ?>';             
                var FormData=$('form#RegisterForm').serialize();
                var user_type='<?php echo $user_type; ?>';
                 $.ajax({
                    type: "POST",
                    url: '<?php echo DOMAIN_URL; ?>/user/Registration',
                    data: FormData,
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function(data) {
                        console.log(data);
                        if(data=='Registration successfully.'){
                            if(user_type=='<?php echo VEHICLE_OWNER; ?>'){
                                var modal = document.getElementById('Confirm_customer_registration'); 
                                 modal.style.display = "block";
                                 $("#loading-image").hide();
                                 $("#registration_completed").attr('href',redirect_url);
                               // window.location.href=redirect_url;
                            }else{
                               location.reload();
                            }
                            
                        }else{
                            $("#msg").html(data);
                            $("#loading-image").hide();
                            $("input[type=submit]").removeAttr("disabled");
                        }
                    }
               });
                return false;  // for demo
            }
        });
        
        $("#activation_form").validate({
            rules: {
                vActivationToken: {
                    required: true
                }
            },
            messages: {
                vActivationToken: {
                    required: "Please enter the varification code"
                }
            },
            submitHandler: function (form) { 
                $("input[type=submit]").attr("disabled", "disabled");
                var redirect_url='<?php echo DOMAIN_URL.'/'.$last_page; ?>';
                var FormData=$('form#activation_form').serialize();
                 $.ajax({
                    type: "POST",
                    url: '<?php echo DOMAIN_URL; ?>/user/CheckVarificationCode',
                    data: FormData,
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function(data) {
                       // console.log(data);
                        if(data==1){
                               window.location.href=redirect_url;                           
                        }else{
                            $("#msg").html(data);
                            $("#loading-image").hide();
                            $("input[type=submit]").removeAttr("disabled");
                        }
                    }
               });
                return false;  // for demo
            }
        });
     });
     </script> 
     <script>
jQuery(document).ready(function(){
	jQuery("#vFirstName").focus();
if (jQuery("#registrationForm").next().length > 0) {
  jQuery("#registrationForm").removeClass('nonext');    
}else{
  jQuery("#registrationForm").addClass('nonext'); 
  }
});
</script>
