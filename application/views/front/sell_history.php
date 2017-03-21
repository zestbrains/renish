<style>

.table-bordered>tbody>tr>td, 
.table-bordered>tfoot>tr>td, 
.table-bordered>thead>tr>td 
 {
     border:  none !important;
}
.table-bordered {
    border:  none !important;
}
.table-bordered>thead {
    border: 1px solid #ddd !important;
}
 </style> 
<div class="spacer-small"></div>
         <!-- PAGEBODY -->
         <div class="container" style="margin-top: 100px !important;">
            <div class="row ">
               <div class="container" >
                   
                  <div class="col-lg-12 profile-container">
                     <div class="panel panel-default ">
                        <div class="panel-heading profile-small-title">
                           <h3>Sell HISTORY:</h3>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-12">
                              <div class="panel panel-default order-history">
                                 <div class="panel-body">
                                    <div class="col-lg-12 order-amounts">
                                       <h3>Total Sell:</h3>
                                       <h4><?php echo $totalSell ? $totalSell: 0 ; ?></h4>
                                    </div>
                                   
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                      <table id="example" class="table table-striped table-bordered order_history_table" style="" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                               <th><label class="depend"><b>User</b></label></th>
                               <th><label class="depend"><b>Discount</b></label></th>
                              <th><label class="depend"><b>Coupon No</b></label></th>
                              <th><label class="depend"><b>Status</b></label></th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php
                            $today=date('Y-m-d');
                            if(count($SellingData)>0){
                             for($i=0;$i<count($SellingData);$i++){   
                                 
                                $days='+'.$SellingData[$i]['iExpirationDays'].' days';   
                                $date = strtotime($SellingData[$i]['payment_date']);
                                $date = strtotime($days, $date);                               
                                $expirationDate=date('Y-m-d', $date);
                               
                                if($expirationDate<$today){
                                      $color='red';
                                     $couponStatus='<b style="color:'.$color.'">Expired</b>';
                                  
                                }else{
                                     $color='green';
                                      $expirationDate=date('d M Y', $date);
                                     $couponStatus='Expire on <b style="color:'.$color.'">'.$expirationDate.'</b>';
                                   
                                }
                                
                                
                            ?>
                             
                                <tr>                                 
                                  <td> <a href="#"><img src="<?php echo DOMAIN_URL.$SellingData[$i]['vProfileImage']; ?>" style="width:50px !important; height: 50px !important;">&nbsp;<?php echo $SellingData[$i]['vName'] ? $SellingData[$i]['vName'] : '-' ; ?></a></td>
                                  <td> <?php echo $SellingData[$i]['iPercentage'] ? $SellingData[$i]['iPercentage'] : '0' ; ?>% Discount <br><span>on upto <?php echo $SellingData[$i]['vAmountForCoupon'] ? $SellingData[$i]['vAmountForCoupon'] : '0' ; ?>$</td>
                                  <td><code style="font-family: verdana; color: #ff0000;"><?php echo $SellingData[$i]['txn_id'] ? $SellingData[$i]['txn_id'] : '-' ; ?></code></td>
                                  <td><?php echo $couponStatus; ?></td>
                                </tr>
                            
                             <?php } }else{ ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">You still not purchased any coupon.</td>
                                
                                </tr>
                                
                            <?php } ?>    
                           
                           
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
 <div class="spacer-small"></div>
 
       