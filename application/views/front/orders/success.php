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
                        <div class="col-lg-12 order-amounts">
                          <h3>Total amount made : <lable class="depend"><b><?php echo $summaryData['paid_amount'] ? $summaryData['paid_amount'] : '0' ; ?>$</b></lable>
                        </div>
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
               <div class="col-lg-6">
                  <img src="<?php echo DOMAIN_URL.'/'.$summaryData['vCoverImage']; ?>"/>
               </div>
            </div>
         </div>
      </div>
        <div class="col-lg-8  col-md-offset-2 align-right order-button">
            <button class="btn btn-primary">View order page</button>
        </div>
            <div class="col-lg-8  col-md-offset-2 align-left order-button">
                 <p><b>Disclaimer:</b><br> 
                    Discount will expire <lable class="depend"><b><?php echo $summaryData['iExpirationDays'] ? $summaryData['iExpirationDays'] : '0' ; ?> days</b></lable> after the day of purchase.  Please visit the shop and also write your review before expiration to get the credit towards your next purchase.  Please note the credit will not be given for review given after discount expiration date.
                 <p>
           </div>
                      
          </div>
    </div>