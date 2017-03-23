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
                           <h3>ORDER HISTORY:</h3>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-12">
                              <div class="panel panel-default order-history">
                                 <div class="panel-body">
                                    <div class="col-lg-6 order-amounts">
                                       <h3>Order Amount:</h3>
                                       <h4> $<?php echo $totalOrder ? $totalOrder : '0.00' ; ?></h4>
                                    </div>
                                   
                                    <div class="col-lg-6 order-amounts">
                                       <h3>Total Refund:</h3>
                                       <h4>$<?php echo $totalRefund ? $totalRefund.'.00' : '0.00' ; ?></h4>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                      <table id="example" class="table table-striped table-bordered order_history_table" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th><label class="depend"><b>Repair Shop Name</b></label></th>
                              <th><label class="depend"><b>For</b></label></th>
                              <th><label class="depend"><b>Coupon</b></label></th>
                              <th><label class="depend"><b>Status</b></label></th>
                              <th><label class="depend"><b>Paid Price</b></label></th>
                              <th><label class="depend"><b>Wallet Price</b></label></th>
                              <th><label class="depend"><b>Order No.</b></label></th>
                              <th><label class="depend"><b>Order Total</b></label></th>
                              <th><label class="depend"><b></b></label></th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($OrderHistoryData)>0){
                             for($i=0;$i<count($OrderHistoryData);$i++){   
                                 
                                    if($OrderHistoryData[$i]['payment_status']==PAYMENT_COMEPLTED_STATUS){
                                        $pay_status_color='green';
                                    }else{
                                        $pay_status_color='red';
                                    }
                                    if($OrderHistoryData[$i]['payment_date']!='0000-00-00'){                                        
                                       $payment_date=date('d M Y', strtotime($OrderHistoryData[$i]['payment_date']));
                                     }else{
                                        $payment_date='';
                                     }
                                    $totalOrderCost=$OrderHistoryData[$i]['payment_gross']+$OrderHistoryData[$i]['userWalletamount'];
                            ?>
                             
                                <tr>                                  
                                  <?php if($OrderHistoryData[$i]['vPaymentFor']==PAYMENT_FOR_COUPON){ ?>
                                        <td> <a href="<?php echo DOMAIN_URL; ?>/shop/detail/<?php echo $OrderHistoryData[$i]['iGarageId']; ?>"><img src="<?php echo DOMAIN_URL.'/'.$OrderHistoryData[$i]['vCoverImage']; ?>" style="width:50px !important; height: 50px !important;"><span class="banner-img-name"><?php echo $OrderHistoryData[$i]['vGarageName'] ? $OrderHistoryData[$i]['vGarageName'] : '-' ; ?></span></a></td>
                                        <td style="color:#881616;"><?php echo $OrderHistoryData[$i]['vPaymentFor'] ? $OrderHistoryData[$i]['vPaymentFor'] : '-' ; ?></td> 
                                  <?php }else { ?> 
                                     <td> <a href="javascript:;"><img src="<?php echo BANNER_IMAGE_URL; ?>" style="width:50px !important; height: 50px !important;"><span class="banner-img-name"><?php echo $OrderHistoryData[$i]['vBannerSize'] ? $OrderHistoryData[$i]['vBannerSize'] : '-' ; ?> Banner</span></a></td>
                                         <td><?php echo $OrderHistoryData[$i]['vPaymentFor'] ? $OrderHistoryData[$i]['vPaymentFor'] : '-' ; ?></td> 
                                  <?php } ?>
                                     
                                  
                                  <td> <?php echo $OrderHistoryData[$i]['iPercentage'] ? $OrderHistoryData[$i]['iPercentage'] : '0' ; ?>% Discount <br><span>on upto <?php echo $OrderHistoryData[$i]['vAmountForCoupon'] ? $OrderHistoryData[$i]['vAmountForCoupon'] : '0' ; ?>$</td>
                                  <td style="color:<?php echo $pay_status_color; ?>"><?php echo $OrderHistoryData[$i]['payment_status'] ? $OrderHistoryData[$i]['payment_status'] : '-' ; ?></td>
                                  <td><?php echo $OrderHistoryData[$i]['payment_gross'] ? $OrderHistoryData[$i]['payment_gross'] : '-' ; ?></td>
                                  <td><?php echo $OrderHistoryData[$i]['userWalletamount'] ? $OrderHistoryData[$i]['userWalletamount'] : '-' ; ?></td>
                                  <td><code style="font-family: verdana; color: #ff0000;"><?php echo $OrderHistoryData[$i]['txn_id'] ? $OrderHistoryData[$i]['txn_id'] : '-' ; ?></code><br><label><?php echo $payment_date ? $payment_date : '-' ; ?></label></td>
                                  <td><?php echo number_format((float)$totalOrderCost, 2, '.', ''); ?></td>
                                  
                                  <?php if($OrderHistoryData[$i]['vPaymentFor']==PAYMENT_FOR_COUPON){ ?>
                                        <td><a href="<?php echo DOMAIN_URL; ?>/order/details/<?php echo $OrderHistoryData[$i]['payment_id']; ?>" class="view_btn">View</a></td>
                                  <?php }else { ?>   
                                          <td><a href="<?php echo DOMAIN_URL; ?>/banner/order_detail/<?php echo $OrderHistoryData[$i]['payment_id']; ?>"  class="view_btn">View</a></td>
                                   <?php } ?> 
                                    
                                </tr>
                            
                             <?php } }else{ ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">You still not purchased any coupon.</td>
                                
                                </tr>
                                
                            <?php } ?>    
                           
                           
                        </tbody>
                     </table>
                  </div>
                  </form>
               </div>
            </div>
         </div>
 <div class="spacer-small"></div>
 
       