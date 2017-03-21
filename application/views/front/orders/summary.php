<div class="spacer-small"></div>
<!-- PAGEBODY -->
<div class="container" style="margin-top: 100px !important;">
   <div class="row ">
      <div class="col-lg-8  col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading profile-small-title">
               <h3>ORDER</h3>
            </div>
            <div class="panel-body">
                <?php if($summaryData['userData']['iWalletMoney']>0){ ?>
                    <div class="col-lg-4 order-amounts">
                       <h3>Order Amount:</h3>
                       <h4 class="depend"><b><?php echo $summaryData['vCoupenPrice'] ? $summaryData['vCoupenPrice'] : '0' ; ?>$</b></h4>
                    </div>
                    <div class="col-lg-4 order-amounts">
                       <h3>Wallet Amount:</h3>
                       <h4 class="depend"><b><?php echo $summaryData['userData']['iWalletMoney'] ? $summaryData['userData']['iWalletMoney'] : '0' ; ?>$</b></h4>
                    </div>
                     <?php                    
                         $FInalAmount=$summaryData['vCoupenPrice']-$summaryData['userData']['iWalletMoney'];
                         if($FInalAmount<=0){
                            $FInalAmount=0;
                         }
                         
                     ?>
                    <div class="col-lg-4 order-amounts">
                       <h3>Actual Amount:</h3>
                       <h4 class="depend"><b><?php echo $FInalAmount ? $FInalAmount : '0'; ?>$</b></h4>
                    </div>
                <?php }else{ ?>
                       <div class="col-lg-12 order-amounts">
                       <h3>Total payment to be made : <lable class="depend"><b><?php echo $summaryData['vCoupenPrice'] ? $summaryData['vCoupenPrice'] : '0' ; ?>$</b></lable>
                       <?php  $FInalAmount=$summaryData['vCoupenPrice']; ?>
                    </div> 
                <?php } ?>
            </div>
         </div>
      </div>
      <div class="col-lg-8  col-md-offset-2">
         <div class="panel panel-default order-summary">
            <div class="panel-body">
               <h3>ORER SUMMARY:</h3>
               <div class="col-lg-6">
                  <label for="inputdefault" class="profile-field-label">Repair Shop Name:</label>
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
         </div>
      </div>
      <div class="col-lg-8  col-md-offset-2 align-right order-button">
            <?php if($FInalAmount!=0){ ?>
                <a href="<?php echo DOMAIN_URL.'/order/buy/'.$summaryData['iGarageId']; ?>" class="btn btn-primary">Pay Now</a>
            <?php } else { ?>
                <a href="<?php echo DOMAIN_URL.'/paypal//success/'.$summaryData['iGarageId']; ?>" class="btn btn-primary">Pay Now</a>
            <?php } ?> 
      </div>
      <div class="col-lg-8  col-md-offset-2 align-left order-button">
          <p><b>Disclaimer:</b><br> 
              Discount will expire <lable class="depend"><b><?php echo $summaryData['iExpirationDays'] ? $summaryData['iExpirationDays'] : '0' ; ?> days</b></lable> after the day of purchase.  Please visit the shop and also write your review before expiration to get the credit towards your next purchase.  Please note the credit will not be given for review given after discount expiration date.
           <p>
      </div>
   </div>
</div>