<div class="spacer-small"></div>
<!-- PAGEBODY -->
<div class="container" style="margin-top: 100px !important;">
   <div class="row ">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <div class="panel-heading profile-small-title">
               <h3>ORDER SUMMARY</h3>
            </div>
            <div class="panel-body">
              
                    <div class="col-lg-4 order-amounts">
                       <h3>Order Amount:</h3>
                       <h4 class="depend"><b><?php echo $PaymentData['payment_gross'] ? $PaymentData['payment_gross'] : '0.00' ; ?>$</b></h4>
                    </div>
                    <div class="col-lg-4 order-amounts">
                       <h3>Wallet Amount:</h3>
                       <h4 class="depend"><b><?php echo $PaymentData['userWalletamount'] ? $PaymentData['userWalletamount'] : '0.00' ; ?>$</b></h4>
                    </div>
                     
                    <div class="col-lg-4 order-amounts">
                       <h3>Actual Amount:</h3>
                       <h4 class="depend"><b><?php echo ($PaymentData['userWalletamount']+$PaymentData['payment_gross']).'.00'; ?>$</b></h4>
                    </div>
              
            </div>
         </div>
      </div>
      <div class="col-lg-12">
          
         <div class="panel panel-default order-summary">
            <div class="panel-body">
               <div class="col-lg-6">
                  <label for="inputdefault" class="profile-field-label">Shop Name:</label>
                   <h6 class="depend"><b><?php echo $summaryData['vGarageName'] ? $summaryData['vGarageName'] : 'Garage Name' ; ?></b></h6>
                  <label for="inputdefault" class="profile-field-label">Occupation:</label>
                  <h6 class="depend"><b>
                      <?php
                        if($summaryData['vGarageType']==1){
                            $garageType='Repair Auto shop';
                        }else if($summaryData['vGarageType']==2){
                            $garageType='Repair Body shop';
                        }else if($summaryData['vGarageType']==3){
                            $garageType='Repair Auto & Body shop';
                        }else{
                            $garageType='General';
                        }
                        echo $garageType;
                        ?>
                      </b>   
                  </h6>
                  <label for="inputdefault" class="profile-field-label">Discount:</label>
                  <h6 class="depend"><b><?php echo $summaryData['iPercentage'] ? $summaryData['iPercentage'] : '0' ; ?>% Discount on upto <?php echo $summaryData['vAmountForCoupon'] ? $summaryData['vAmountForCoupon'] : '0' ; ?>$</b></h6>
                  <label for="inputdefault" class="profile-field-label">Discount Valid Until:</label>
                  <h6 class="depend"><b><?php echo $summaryData['expiration_date'] ? $summaryData['expiration_date'] : '-' ; ?></b></h6>
               </div>
               <div class="col-lg-6">
                   <img src="<?php echo DOMAIN_URL.'/'.$summaryData['vCoverImage']; ?>"/>
               </div>
            </div>
             <div class="panel-body">              
               <div class="col-lg-6">
                  <label for="inputdefault" class="profile-field-label">Order No:</label>
                  <h6><?php echo $PaymentData['txn_id'] ? $PaymentData['txn_id'] : '-' ; ?></h6>
                     <label for="inputdefault" class="profile-field-label">Payment Date:</label>
                     <h6><?php echo $PaymentData['payment_date'] ? date('d M Y', strtotime($PaymentData['payment_date'])) : '-' ; ?></h6>
                 
                
               </div>
               <div class="col-lg-6">
                     <label for="inputdefault" class="profile-field-label">Coupon:</label>
                     <h6><?php echo $PaymentData['txn_id'] ? $PaymentData['txn_id'] : '-' ; ?></h6>
                 
                    <?php
                   if($summaryData['payment_status']==PAYMENT_COMEPLTED_STATUS){
                       $color='green';
                   }else{
                       $color='red';
                   }
                   ?>
                   <label for="inputdefault" class="profile-field-label">Payment Status:</label>
                   <h6 style="color:<?php echo $color; ?>"><b><?php echo $summaryData['payment_status'] ? $summaryData['payment_status'] : '-' ; ?></b></h6>
                
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-12 ">
            <div class="panel panel-default order-summary">
            <div class="panel-body">
                <div class="col-lg-12">
                    <label>
                        
                             <?php if(isset($CommentData) && !empty($CommentData)){ 
                                   if($CommentData['iRefundAmount']!=0){   
                              ?>                             
                                 <p style="color:green;">
                                    <b><?php echo $CommentData['iRefundAmount'] ? $CommentData['iRefundAmount'].'.00' : '0.00' ; ?>$ Successfully Added to your wallet.</b>
                                </p>
                             <?php } } else { ?>
                                <p class="depend">
                                    <b> You will get <?php echo $summaryData['iRefund'] ? $summaryData['iRefund'].'.00' : '0.00' ; ?>$ cashback once you write review, you can write review <a href="#reviewPost">here</a></b>
                                </p>
                             <?php } ?>
                                <p class="depend">
                                   <b> Cashback is Repair Surety wallet loyalty cashback given by Pay with Repair Surety payment platform. It can be used to pay for goods & services sold by merchants that accept Pay with Repair Surety.</b>
                                </p>
                    </label>
                </div>
                
            </div>
                    
            </div>
      </div>
    
   </div>
   <?php 
   
    if(isset($CommentData) && !empty($CommentData)){ 
           $IsdisplayList='display:block;';
           $IsdisplayPost='display:none;';
            $commentPostedDate=date('Y-m-d',strtotime($CommentData['dCreatedDate']));
            $today=date('Y-m-d');
            
            $startTimeStamp = strtotime($commentPostedDate);
            $endTimeStamp = strtotime($today);
            $timeDiff = abs($endTimeStamp - $startTimeStamp);
            $numberDays = $timeDiff/86400;  // 86400 seconds in one day
            $days = intval($numberDays);
            if($days<=COMMENT_EDIT_DAY){
                $isCommentEdit=TRUE;
                $remainingDays=COMMENT_EDIT_DAY-$days.' Days';
            }else{
                $isCommentEdit=FALSE;
            }
           
     } else { 
           $IsdisplayList='display:none;';
           $IsdisplayPost='display:block;';
         
     }
   ?> 
    <div class="row " id="reviewList" style="<?php echo $IsdisplayList; ?>">
        <div class="col-sm-12">
           <hr>
           <div class="review-block" id="commentlisting">
               <?php if($isCommentEdit) { ?>
                 <span id="edit_comment"  title="You can edit your comment untill next <?php echo $remainingDays ?$remainingDays:0; ?>">Edit</span> 
               <?php } ?> 
              <div class="row customer-review">
                 <div class="col-sm-1">
                   <img src="<?php echo DOMAIN_URL.$CommentData['vProfileImage']; ?>" class="img-rounded customer-review-image" alt="User Profile Pic">
                </div>
                <div class="col-sm-11">
                   <div class="review-block-name"><a href="#"><?php echo $CommentData['vName']!='' ? $CommentData['vName'] : '-'; ?></a>
                   </div>
                   <div class="review-block-date"><?php echo ($CommentData['dCreatedDate'] !='' ? date('d M Y', strtotime($CommentData['dCreatedDate'])) : ''); ?></div>
                   <div class="review-block-rate">
                      <span class="star-reviews-customer">
                      <?php
                         $star='';
                         for($k=1;$k<=5;$k++){
                             if($k<=$CommentData['fRating']){
                                 $star.='<i class="fa fa-star"></i>';
                             }else{
                                 $star.='<i class="fa fa-star-o"></i>';
                             }                                                
                         }
                         echo $star;
                         ?>
                      </span>
                      <?php echo $CommentData['fRating']!='' ? $CommentData['fRating'] : 0; ?>/5
                   </div>
                   <div class="review-block-title"><?php echo $CommentData['vCommentTitle']!='' ? $CommentData['vCommentTitle'] : '-'; ?></div>
                   <div class="review-block-description"><?php echo $CommentData['vComment']!='' ? $CommentData['vComment'] : '-'; ?></div>
                </div>
                  
              </div>
           </div>
           
        </div>
    </div>
    <div class="row " id="shareComment" style="<?php echo $IsdisplayList; ?>">
        <div class="col-sm-12">
             <div class="review-block" id="commentlisting">
                 <div class="row customer-review">
                    <p style="color:green;">Share your experience with social medias.</p>
                    <div class="col-lg-6">                      
                              <div class="fb-share-button" data-href="<?php echo DOMAIN_URL; ?>" data-layout="button_count"></div>
                    </div>
                    <div class="col-lg-6 align-right">                      
                             <a target="_blank" href="http://twitter.com/share?text=<?php echo $CommentData['vComment']!='' ? $CommentData['vComment'] : ''; ?>&amp;url=http://zestbrains.com/repair_surity/shop/detail/2" title="Twitter Share"><img src="<?php echo ASSETS_URL.'/manual/tw.png'; ?>"/></a>                  
                    </div> 
                 </div> 
             </div>        
          </div>
    </div>
   
    <div class="row" id="reviewPost" style="<?php echo $IsdisplayPost; ?>">
        <div id="msg" style="display: none;" class="alert alert-info error_alert_bar"></div>
       <form role="form" id="PostCommentForm" method="post" >
           <input type="hidden" value="<?php echo $PaymentData['iGarageId'] ? $PaymentData['iGarageId'] : '' ; ?>" name="iGarageId">
           <input type="hidden" value="<?php echo $PaymentData['iUserId'] ? $PaymentData['iUserId'] : '' ; ?>" name="iUserId">
           <input type="hidden" value="<?php echo $summaryData['iRefund'] ? $summaryData['iRefund'].'.00' : '0.00' ; ?>" name="refund">
           <input type="hidden" value="<?php echo $PaymentData['txn_id'] ? $PaymentData['txn_id'] : '' ; ?>" name="txn_id">
           <input type="hidden" value="<?php echo $CommentData['iCommentId'] ? $CommentData['iCommentId'] : '' ; ?>" name="iCommentId">
         <div class="col-lg-6  col-md-offset-3 write-review">
            <div class="panel panel-default">
               <div class="panel-body">
                  <h3>Write Shop  Review</h3>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div id="rate"></div>
                  </div></div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div id="rate"></div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="inputdefault" class="profile-field-label">Title:</label>
                        <input type="text" name="vCommentTitle" id="vCommentTitle" class="form-control input-sm profile-field" placeholder="Comment Title" tabindex="1" value="<?php echo $CommentData['vCommentTitle']!='' ? $CommentData['vCommentTitle'] : ''; ?>">
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="inputdefault" class="profile-field-label">Description:</label>
                        <textarea rows="3" id="vComment" name="vComment" class="form-control profile-field" placeholder="Comment Description" style="height:auto !important;"><?php echo $CommentData['vComment']!='' ? $CommentData['vComment'] : ''; ?></textarea>
                     </div>
                  </div>
                  <div class="col-lg-6 align-right">                      
                      <a href="javascript:void(0);" class="btn btn-gray cancle_comment">Cancel</a>
                     
                  </div>
                  <div class="col-lg-6 align-right">
                      <input type="submit" class="btn btn-primary" value="Submi Review">
                     
                  </div>
               </div>
            </div>
         </div>
       </form>   
      </div>
    
    
    
</div>
<div id="loading-image"  style="display: none;">
              <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>
 </div>
<div class="spacer-small"></div>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1473210109658718";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#PostCommentForm").validate({
            ignore: [],
            rules: {
                vCommentTitle: {
                    required: true
                },
                vComment: {
                    required: true,                    
                    minlength: 15,
                    maxlength: 100
                },
                 fRating: {
                    required: true
                }
            },
            messages: {
                vName: {
                    required: "name is required"
                },
                 vPinCode: {
                    required: "Description is required",
                    minlength: "Description should be at least {10} characters long",
                    maxlength: "Description should be maximum 100 word long"
                },
                fRating: {
                    required: "Ratting is required"
                }
            },
            submitHandler: function (form) { 
                $("input[type=submit]").attr("disabled", "disabled");
                var FormData=$('form#PostCommentForm').serialize();
                var redirect_url='<?php echo DOMAIN_URL.'/'.'user/save_comment'; ?>';
                
                 $.ajax({
                    type: "POST",
                    url: redirect_url,
                    data: FormData,
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function (data) {
                        console.log(data);
                       if(data==1){
                            $("#msg").show();
                            $("#msg").removeClass('error_alert_bar');
                            $("#msg").addClass('success_alert_bar');
                            $("#msg").html('Comment Successfully posted!!');
                            $("#loading-image").hide();
                            $("input[type=submit]").removeAttr("disabled");
                            location.reload();
                        }else{
                            $("#msg").show();
                            $("#msg").removeClass('success_alert_bar');
                            $("#msg").addClass('error_alert_bar');
                            $("#msg").html('Somethings went wrong,Please try again later!!');
                            $("#loading-image").hide();
                            $("input[type=submit]").removeAttr("disabled");
                        }     
                    },
                    error: function (data) {
                        $("#msg").show();
                        $("#msg").removeClass('success_alert_bar');
                        $("#msg").addClass('error_alert_bar');
                        $("#msg").html('Somethings went wrong,Please try again later!!');
                        $("#loading-image").hide();
                        $("input[type=submit]").removeAttr("disabled");
                    }
               });
                return false;  // for demo
            }
            

        });

      

    });

$("#edit_comment").click(function(){
        $("#reviewList").hide();
        $("#shareComment").hide();
        $("#reviewPost").show();
});
$(".cancle_comment").click(function(){
        $("#reviewList").show();
        $("#shareComment").show();
        $("#reviewPost").hide();
});
</script>