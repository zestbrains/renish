<div class="beforeheader">
<div class="befhedleft">
    	<ul>
        <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>sureforless@mail.com</a></li>
        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>9999999999</a></li>
        </ul>
    </div>
<div class="befhedright">
      <ul>
        <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
      </ul>
    </div></div>
<header id="header" class="header-transparent transparent-light">

            <div class="header-inner clearfix">

               <!-- LOGO -->

               

               <!-- MAIN NAVIGATION -->

               <div id="menu">

                  <a href="#" class="responsive-nav-toggle"><span class="hamburger"></span></a>

                  <div class="menu-inner">

                     <nav id="main-nav">

                        <ul>

<!--                            <li><a id="auto_shop" href="<?php echo DOMAIN_URL; ?>/home">Auto Shop</a><li>

                           <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/home/body_shop">Body Shop</a><li>-->

                            <li><a id="body_shop" href="javascript:void(0);">Check REPAIR status</a></li>

                            <li><a id="body_shop" href="javascript:void(0);">Reviews</a></li>

                            <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/blog/">Blog</a></li>

                            <li><a id="body_shop" href="javascript:void(0);">Support</a></li>

                            

                           <li class="navlogo"><a href="<?php echo DOMAIN_URL; ?>"><img id="light-logo" src="<?php echo ASSETS_URL; ?>/uploads/coin_logo.png"  alt="Logo Light"></a></li>

<!--                           <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/banner/view">Get Banner For Shop</a><li>       -->

                           <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/home/about_us">How it works</a></li> 

                           <li><a id="body_shop" href="javascript:void(0);">Trust & safety</a></li> 

                           <li><a href="<?php echo DOMAIN_URL; ?>/user/login">Login</a><li>


                            <li><a href="javascript:;" id="myBtn" >Register</a><li>   

                               

                        </ul>

                     </nav>

                  </div>

                  <!-- END .menu-inner -->

               </div>

               <!-- END #menu -->

            </div>

            <!-- END .header-inner -->

 </header>



    <!--========- popup=====================-->

  



     <div id="myModal" class="modal">

       <div class="modal-content">

         <span class="close">&times;</span>

         <div align="center">

             <h3> Register as</h3>

                <div class="row">

                        <div class="col-lg-6 border-right"> 

                            <img id="light-logo" src="<?php echo ASSETS_URL; ?>/uploads/car-key.png"  alt="Logo Light" width="100" height="100" class="model-img">

                            <p>In order to getting discounts on your vehicle, you need to create your profile as a vehicle owner which will guide you through the process.</p>

                            <a href="<?php echo DOMAIN_URL; ?>/user/register/vehicle" class="btn btn-lg btn-default read-more model-btn">Vehicle Owner</a>

                        </div>

                        <div class="col-lg-6">                   

                            <img id="light-logo" src="<?php echo ASSETS_URL; ?>/uploads/mechanical-service-of-a-car.png"  alt="Logo Light"  width="100" height="100"  class="model-img">

                            <p>Become highly recommended shop in your area, with real reviews from real cutomers.You need to create profile as a shop owner. </p>

                            <a href="<?php echo DOMAIN_URL; ?>/user/register/shop" class="btn btn-lg btn-default read-more model-btn">Shop Owner</a>

                        </div>

                </div>





         </div>

          

       </div>



     </div>

    

    <script>

        var modal = document.getElementById('myModal');

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {

            modal.style.display = "block";

        },

        span.onclick = function() {

            modal.style.display = "none";

        },

        window.onclick = function(event) {

            if (event.target == modal) {

                modal.style.display = "none";

            }

        };

</script>   

