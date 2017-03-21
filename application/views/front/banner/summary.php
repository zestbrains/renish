<div class="spacer-small"></div>
<!-- PAGEBODY -->
<div class="container" style="margin-top: 100px !important;">
   <div class="row ">
      <div class="col-lg-8  col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading profile-small-title">
               <h3>ORDER DETAIL</h3>
            </div>
            <div class="panel-body">        
                     <div class="col-lg-12 order-amounts">
                       <h3>Total payment made : <lable class="depend"><b><?php echo $summaryData['payment_gross'] ? $summaryData['payment_gross'] : '0' ; ?>$</b></lable>                     
                    </div>                
            </div>
         </div>
      </div>
      <div class="col-lg-8  col-md-offset-2">
         <div class="panel panel-default order-summary">
            <div class="panel-body">
               <h3>Summary:</h3>
               <div class="col-lg-6">
                  <label for="inputdefault" class="profile-field-label">Item Name:</label>
                  <h6 class="depend"><b><?php echo $summaryData['vBannerSize'] ? $summaryData['vBannerSize'] : '-' ; ?> size of banner</b></h6>
                  <label for="inputdefault" class="profile-field-label">Quantity:</label>
                  <h6 class="depend"><b><?php echo $summaryData['iQuantity'] ? $summaryData['iQuantity'] : 0 ; ?></b></h6>
                  <label for="inputdefault" class="profile-field-label">Payment Date:</label>
                  <h6 class="depend"><b><?php echo $summaryData['payment_date'] ? date('d M Y', strtotime($summaryData['payment_date'])) : '-' ; ?></b></h6>
                 <label for="inputdefault" class="profile-field-label">Delivery Address:</label>
                 <h6 class="depend"><b><?php echo $summaryData['vDaddress'] ? $summaryData['vDaddress'] : '-' ; ?></b></h6>
                 
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
                  <img src="<?php echo BANNER_IMAGE_URL; ?>"/>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-8  col-md-offset-2 align-right order-button">
           
      </div>
      <div class="col-lg-8  col-md-offset-2 align-left order-button">
          <p><b>Disclaimer:</b><br> 
              Please check mail for confirmation ,even you have any queries or questions than don't feel hesitation to ask here.<a href="#">Contact Us</a>
           <p>
      </div>
   </div>
</div>