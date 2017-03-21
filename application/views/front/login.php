

<div class="spacer-small"></div>

<!-- PAGEBODY -->

<div class="container loginpara" style="margin-top: 100px !important;">

  <div class="row loginrow">

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 simple-login">

      <form role="form" id="LoginForm" method="post">

        <div class="col-xs-12 col-sm-12 col-md-12 title-hading">

          <h3>Login</h3>

        </div>

        <div id="msg" class="error"></div>

        <div class="form-group">

          <input type="text" name="email" id="display_name" class="form-control input-lg" placeholder="Email" tabindex="3">

        </div>

        <div class="form-group">

          <input type="password" name="password" id="email" class="form-control input-lg" placeholder="Password" tabindex="4">

        </div>

        <div class="form-group">

          <input type="submit" value="Login" class="btn btn-primary btn-lg" style="width:100%;">

        </div>

        <div id="loading-image"  style="display: none;">

          <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>

        </div>

        <div class="form-group"> <a href="javascript:;" class="small-link">Forgot Password?</a> </div>

        <!--                     <div class="form-group">

                         New User ? <a href="javascript:;" id="myBtn" class="small-link">Create Account</a> 

                     </div>-->

      </form>

      <div class="logcontone">Search our networks of many shops.</div>

    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 socialog">

      <div class="innerlogu">

        <h3>Login with Social</h3>

        <ul>

          <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>

          <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>

          <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>

        </ul>

      </div>

      <div class="logconttwo">View a map of local shops.</div>

    </div>

    

  </div>

</div>

<div class="spacer-big"></div>

<script>

         $(document).ready(function () {



        $("#LoginForm").validate({

            rules: {

                email: {

                    required: true

                },

                password: {

                    required: true,

                    minlength: 6  // <-- removed underscore

                }

            },

            messages: {

                email: {

                    required: "email is required"

                },

                password: {

                    required: "Password is required",

                    minlength: "Password should be at least {6} characters long" // <-- removed underscore

                }

            },

            submitHandler: function (form) { 

                $("input[type=submit]").attr("disabled", "disabled");

                var FormData=$('form#LoginForm').serialize();

                var redirect_url='<?php echo DOMAIN_URL.'/'.$last_page; ?>';

                

                 $.ajax({

                    type: "POST",

                    url: 'CheckLogin',

                    data: FormData,

                    beforeSend: function() {

                       $("#loading-image").show();

                    },

                    success: function(data) {                        

                        if(data=='Login successfully'){

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

