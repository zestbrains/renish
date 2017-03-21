<!doctype html>
<html class="no-js" lang="en-US">
    <head>
       
       <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/bootstrap/bootstrap.min.css"/>
      <!-- DEFAULT META TAGS -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
      <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-8">
      <meta property="og:url"           content="<?php echo DOMAIN_URL; ?>" />
      <meta property="og:type"          content="Repair shops and discounts" />
        <meta property="og:title"         content="Awesome shops in sureforless" />
        <meta property="og:description"   content="Really a good shop finder in area" />
      <meta charset="ISO-8859-1">
      <!-- FONTS -->
      <!-- CSS -->
      <link href="https://fonts.googleapis.com/css?family=Exo+2:300,300i,400,500,600,600i,700,800" rel="stylesheet">
      <link rel="stylesheet" id="fontawesome-style-css" href="<?php echo ASSETS_URL; ?>/css/font-awesome.min.css" type="text/css" media="all" />
      <link rel="stylesheet" id="ionic-icons-style-css" href="<?php echo ASSETS_URL; ?>/css/ionicons.css" type="text/css" media="all" />
      <link rel="stylesheet" id="mqueries-style-css"  href="<?php echo ASSETS_URL; ?>/css/mqueries.css" type="text/css" media="all" />
      <link rel="stylesheet" id="owlcarousel-css" href="<?php echo ASSETS_URL; ?>/css/owl.carousel.css" type="text/css" media="all">    
      <!-- FAVICON -->
      <link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>/uploads/favicon.png"/>
	<link rel="stylesheet" id="default-style-css"  href="<?php echo ASSETS_URL; ?>/css/style.css" type="text/css" media="all" />	  
	  <link rel="stylesheet" id="default-style-css"  href="<?php echo ASSETS_URL; ?>/css/custom.css" type="text/css" media="all" />
      <script src="<?php echo DOMAIN_URL; ?>/themes/admin/plugins/jquery.min.js" type="text/javascript"></script> 
      <!-- DOCUMENT TITLE -->
      <!-- <title>Repair Surity</title> -->

  <title>Sure For Less - Trusted Auto Shops</title>
    <!-- TWITTER FOLLOW -->
    
    <?php if($module == 'front/home'){?>
    <script>window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);
    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };
    return t;
    }(document, "script", "twitter-wjs"));</script>
    <?php }?>

    <!-- TWITTER FOLLOW -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
<body>
    
    <!-- FACEBOOK LIKE -->
    <?php if($module == 'front/home'){?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=253879668395910";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php }?>
    <!-- FACEBOOK LIKE -->
       <div id="page-loader">
         <div class="page-loader-inner"> 
             <span class="loader-figure"></span> 
             <img class="loader-logo" src="<?php echo ASSETS_URL; ?>/uploads/favicon.png" srcset="<?php echo ASSETS_URL; ?>/uploads/favicon.png 1x, <?php echo ASSETS_URL; ?>/uploads/favicon@2x.png 2x" alt="Loader Logo">         </div>
      </div>
      <div id="page-content">
        <?php
       
          if($header_panel){
              if($is_login=='Yes'){
                $this->load->view('front/include/header_with_login');  
              }else{
                  $this->load->view('front/include/header_without_login');  
              }  
          }
        ?> 
        <?php  $this->load->view($module); ?>
        <?php if($footer_panel){$this->load->view('front/include/footer');}?>
      </div>    
   
   
   

<script src="<?php echo ASSETS_URL; ?>/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/jquery.visible.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/jquery.min.bgvideo.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/jquery.backgroundparallax.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/jquery.owl.carousel.js"></script>
<script src="<?php echo DOMAIN_URL; ?>/themes/admin/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>   

<?php if($is_datatable){ ?>
   <script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/datatables.min.js"></script>
   <script src="<?php echo ASSETS_URL; ?>/css/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
          $('#example').DataTable();
       } );
    </script>  
<?php } ?>   
 

<script src="<?php echo ASSETS_URL; ?>/js/jquery.raty.js"></script>
<script>
	
      $('#rate').raty();

</script>    
<script type="text/javascript">
 jQuery(document).ready(function($){

        // Get current url
        // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
        var url = window.location.href;
  
        if(url=="http://repairsurety.com/")
        {
          url=url+"home"; 
        }

        $('#main-nav ul li a[href="'+url+'"]').addClass('active');
    });
</script>
</body>
    <!-- END BODY -->

</html>
<style>
    .error {color:red;}
</style>
