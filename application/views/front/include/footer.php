  <footer id="footer">
            <div class="footer-inner wrapper">
               <div class="column-section clearfix">
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 footsocial">
                     <div class="widget">
                        <img src="<?php echo ASSETS_URL; ?>/uploads/coin_logo.png" alt="Logo">
                        <div class="spacer-mini"></div>
                        <p>Surety means confidence to customers shopping for automobile repair services. Accountability is assured by not-public reviews and ratings on our site.  </p>
                     </div>
                     <div class="widget social-links">
                        <ul class="socialmedia-widget style-rounded hover-slide-3">
                           <li class="facebook"><a href="#"></a></li>
                           <li class="twitter"><a href="#"></a></li>
                           <li class="linkedin"><a href="#"></a></li>
                           <li class="rss"><a href="#"></a></li>
                           <li class="googleplus"><a href="#"></a></li>
                           <li class="pinterest"><a href="#"></a></li>
                           <li class="youtube"><a href="#"></a></li>
                           <li class="instagram"><a href="#"></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 quick-links-container">
                     <div class="widget quick-links">
                        <h6 class="widget-title uppercase">Quick Menu</h6>
                        <ul class="menu">
                            <li><a href="<?php echo DOMAIN_URL; ?>/home/about_us">About Us</a></li>
                           <li><a href="<?php echo DOMAIN_URL; ?>/home">Repair Auto Shop</a></li>
                           <li><a href="<?php echo DOMAIN_URL; ?>/home/body_shop">Repair Body Shop</a></li>
<!--                           <li><a href="#">Our Team</a></li>
                           <li><a href="#">Support</a></li>-->
                           <li><a href="#">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>
                 <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 footnews">
				 <div class="row widget">
				 <h6 class="widget-title uppercase">Newsletter</h6>
				<p>Get latest discounts arrival straight to your inbox. Enter your email address below</p>
    <form role="form" id="SubscribeForm" method="post">
      <div class="input-group">
        <input type="hidden" value="submit_email" name="action">
        <input type="text" data-error-container="#msgspan" class="form-control" name="SubEmail" id="SubEmail" placeholder="Enter Your Email Address...">
        <span class="input-group-btn">
          <input type="submit" id="btn_subscribe" value="Subscribe" class="btn btn-default"> 
          <!-- <button class="btn btn-default" type="button">Subscribe</button> -->
        </span>
      </div>
      <span id="msgspan"></span>
      <?php if(isset($_SESSION['sub']) && $_SESSION['sub']!=''){?>
        <div id="succmsg" class="alert alert-info success_alert_bar"><?php echo $_SESSION['sub'];unset($_SESSION['sub']);?></div>
      <?php }?>
      <div id="msger" class="error"></div>  
    </form>
</div>
				 </div>
                  
               </div>
               <a id="backtotop" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
            </div>
            <div class="copyright"><small>Copyright &copy; 2017 by Sure-for-Less</small></div>
         </footer>
<script>
$(document).ready(function () {
  $("#SubscribeForm").validate({
      rules: {
           SubEmail: {
              required: true,
              remote:{
                   url: '<?php echo DOMAIN_URL; ?>/user/Subscribtion',
                   type: "post",
                   async:false,
                   data: {SubEmail: function() {return $("#SubscribeForm #SubEmail").val();},action:'check_email'},
                      complete: function(data){
                      return data;
                    }
              }
          }
      },
      messages: {
          SubEmail: {
              required: "email is required",
              remote:"email already subscribe."
          }
      },
      errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
              error.appendTo(element.attr("data-error-container"));
            } else {
              error.insertAfter(element);
            }
      },
      submitHandler: function (form) { 
          $("#btn_subscribe").attr("disabled", "disabled");
          var FormData=$('form#SubscribeForm').serialize();
           $.ajax({
              type: "POST",
              url: '<?php echo DOMAIN_URL; ?>/user/Subscribtion',
              data: FormData,
              success: function(data) {
                  if(data=='success'){
                      window.location.reload();
                  }else{
                      $("#msger").html(data);
                      $("#btn_subscribe").removeAttr("disabled");
                  }
              }
         });
          return false;  // for demo
      }
  });
});
</script>