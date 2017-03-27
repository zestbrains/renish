<header id="header" class="header-transparent transparent-light">
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
    </div>
  </div>
  <div class="header-inner clearfix"> 
    <!-- MAIN NAVIGATION -->
    <div id="menu" class="right-float afterin"> <a href="#" class="responsive-nav-toggle"> <span class="hamburger"> </span> </a>
      <div class="menu-inner header_with_login <?php echo ($_SESSION['USER_TYPE']!=SHOP_OWNER) ? 'normal_user':''; ?> ">
        <nav id="main-nav">
          <ul>
            
            <!--        <li><a id="auto_shop" href="<?php echo DOMAIN_URL; ?>/home">Auto Shop</a></li>
            <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/home/body_shop">Body Shop</a></li>-->
            <li><a id="body_shop" href="javascript:void(0);">CHECK REPAIR STATUS</a></li>
            <li><a id="body_shop" href="javascript:void(0);">Reviews</a></li>
            <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/blog/">Blog</a></li>
            <li><a id="body_shop" href="javascript:void(0);">Support</a></li>
                        <li class="navlogo"><a href="<?php echo DOMAIN_URL; ?>"><img id="light-logo" src="<?php echo ASSETS_URL; ?>/uploads/coin_logo.png"  alt="Logo Light"></a></li>

            <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/home/about_us">How it works</a></li>
            <li><a id="body_shop" href="javascript:void(0);">REFER FOR CREDIT</a></li>
           
             <?php if($_SESSION['USER_TYPE']==VEHICLE_OWNER || ($_SESSION['USER_TYPE']==SHOP_OWNER && $_SESSION['ACTIVATION_PENDING']==TRUE)){ ?>
            <li><a id="body_shop" href="<?php echo DOMAIN_URL; ?>/user/register/shop">Register shop</a></li>
            <?php }else{ ?>
            <li><a id="body_shop" href="#">Promote Bussiness</a></li>
            <?php } ?>
            
            <li class="menu-item-has-children">
              <?php if($_SESSION['USER_TYPE']==SHOP_OWNER && $_SESSION['ACTIVATION_PENDING']==FALSE){ ?>
                    <div class="submenupar"> <a href="javascript:void(0);" class="forhov"> <img src=" <?php echo $_SESSION['USERIMAGE'] ? $_SESSION['USERIMAGE']:'';  ?> " class="top-header-image"> <?php echo $_SESSION['USERNAME'] ? $_SESSION['USERNAME']:'Welcome Guest';  ?> <i class="ion ion-ios-arrow-down"></i> </a>
                      <ul class="submenu">
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/edit_profile">View Profile</a></li>
                        <li><a href="<?php echo DOMAIN_URL; ?>/shop/create">Your Shop</a></li>
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/order_history">Your orders</a></li>
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/sell_history">Your selling</a></li>
                       
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/logout">Logout</a></li>
                      </ul>
                    </div>
              <?php }else if($_SESSION['USER_TYPE']==VEHICLE_OWNER){ ?>
                    <div class="submenupar"> <a href="javascript:void(0);" class="forhov"> <img src=" <?php echo $_SESSION['USERIMAGE'] ? $_SESSION['USERIMAGE']:'';  ?> " class="top-header-image"> <?php echo $_SESSION['USERNAME'] ? $_SESSION['USERNAME']:'Welcome Guest';  ?> <i class="ion ion-ios-arrow-down"> </i> </a>
                      <ul class="submenu">
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/edit_profile">View Profile</a></li>
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/order_history">Your orders</a></li>
                        <li><a href="<?php echo DOMAIN_URL; ?>/user/logout">Logout</a></li>
                      </ul>
                    </div>
                    <a href="#" id="show-search"> <i class="fa fa-usd"> <span> <?php echo $_SESSION['USERWALLET'] ? $_SESSION['USERWALLET']:0;  ?> </span> </i> </a>
              <?php } ?>
            </li>
          </ul>
          <div class="profile-header"> </div>
        </nav>
      </div>
      <!-- END .menu-inner --> 
    </div>
    <!-- END #menu --> 
  </div>
  <!-- END .header-inner --> 
</header>
