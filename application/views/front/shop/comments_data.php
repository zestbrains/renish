<?php
    if(!empty($GarageComments)){ 
        for($j=0;$j<count($GarageComments);$j++){
?>  
            <div class="row customer-review">
               <div class="col-sm-1">
                   <img src="<?php echo DOMAIN_URL.$GarageComments[$j]['vProfileImage']; ?>" class="img-rounded customer-review-image" alt="User Profile Pic">
               </div>
               <div class="col-sm-11">
                  <div class="review-block-name"><a href="#"><?php echo $GarageComments[$j]['vName']!='' ? $GarageComments[$j]['vName'] : '-'; ?></a>
                  </div>
                  <div class="review-block-date"><?php echo ($GarageComments[$j]['dCreatedDate'] !='' ? date('d M Y', strtotime($GarageComments[$j]['dCreatedDate'])) : ''); ?></div>
                  <div class="review-block-rate">
                     <span class="star-reviews-customer">
                     <?php
                        $star='';
                        for($k=1;$k<=5;$k++){
                            if($k<=$GarageComments[$j]['fRating']){
                                $star.='<i class="fa fa-star"></i>';
                            }else{
                                $star.='<i class="fa fa-star-o"></i>';
                            }                                                
                        }
                        echo $star;
                        ?>
                     </span>
                     <?php echo $GarageComments[$j]['fRating']!='' ? $GarageComments[$j]['fRating'] : 0; ?>/5
                  </div>
                  <div class="review-block-title"><?php echo $GarageComments[$j]['vCommentTitle']!='' ? $GarageComments[$j]['vCommentTitle'] : '-'; ?></div>
                  <div class="review-block-description"><?php echo $GarageComments[$j]['vComment']!='' ? $GarageComments[$j]['vComment'] : '-'; ?></div>
               </div>
            </div>
<?php  } } //else{ ?>
<!--                      <div class="row customer-review depend"><b>No Comment</b></div>-->
<?php //} ?>  