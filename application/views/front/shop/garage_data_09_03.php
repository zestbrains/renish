 <?php for($i=0;$i<count($GarageData);$i++){ ?>  
            <li class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
               <div class="listing-item">
                   <?php if(isset($GarageData[$i]['iPercentage']) && $GarageData[$i]['iPercentage']>=SPECIAL_SHOP_LEVEL_LIMIT_DISCOUNT){ ?>
                     <a href="#fav" class="fav"><span><img src="<?php echo ASSETS_URL; ?>/uploads/favicon.png"/></span></a>
                   <?php } ?>  
                  <a href="<?php echo DOMAIN_URL; ?>/shop/detail/<?php echo $GarageData[$i]['iGarageId']; ?>">
                     <div class="box-shadow ">   <img src="<?php echo $GarageData[$i]['vCoverImage'] ? DOMAIN_URL.'/'.$GarageData[$i]['vCoverImage'] :''; ?>" width="100%" height="100" class="garage-image"></div>
                  </a>
                  <div class="col-lg-2 listing-image-block">
                     <a href="#"><img src="<?php echo $GarageData[$i]['vProfileImage'] ? DOMAIN_URL.$GarageData[$i]['vProfileImage'] :''; ?>" width="100%" height="100" class="user-image"></a>
                  </div>
                  <div class="col-lg-10 listing-image-block">
                     <div class="review-block-rate-2">
                        <span class="star-reviews-customer">
                         <?php
                         $star='';
                         for($k=1;$k<=5;$k++){
                             if($k<=$GarageData[$i]['AvgRating']){
                                 $star.='<i class="fa fa-star"></i>';
                             }else{
                                 $star.='<i class="fa fa-star-o"></i>';
                             }                                                
                         }
                         echo $star;
                         ?>


                        </span>
                     </div>
                     <a href="#">
                        <h2 class="garage-name"><?php echo $GarageData[$i]['vGarageName'] ? $GarageData[$i]['vGarageName'] :''; ?></h2>
                     </a>
                     <h3><?php echo $GarageData[$i]['vCity'] ? $GarageData[$i]['vCity'] :''; ?>,<?php echo $GarageData[$i]['vState'] ? $GarageData[$i]['vState'] :''; ?>,<?php echo $GarageData[$i]['vCountry'] ? $GarageData[$i]['vCountry'] :''; ?></h3>
                     <span><?php echo ($GarageData[$i]['iPercentage']!='' && $GarageData[$i]['iPercentage']!=0) ? $GarageData[$i]['iPercentage'].' %'.' discount upto '.$GarageData[$i]['vAmountForCoupon'].'$' :'No discount'; ?></span>
                  </div>
               </div>
            </li>
<?php } ?>   