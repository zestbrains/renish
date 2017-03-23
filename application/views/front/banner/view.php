<div class="spacer-small"></div>
      <div class="container" style="margin-top: 100px !important;">
            <div class="row ">
               <div class="container" >                   
                  <div class="col-lg-12 banner-view-pic-container">
                     <div class="panel panel-default ">
                        <div class="panel-heading profile-small-title">
                           <h3>Purchase Banner For your shop</h3>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-12">
                                         <img src="<?php echo BANNER_IMAGE_URL; ?>">
                                    
                           </div>
                        </div>
                     </div>
                    
                  </div>
                   <div class="col-lg-12 profile-container">
                     <div class="panel panel-default ">
                        
                        <div class="panel-body">
                            <form role="form" id="BannerPurchaseForm" method="post"  >
                                <div class="col-lg-12">
                                  <div class="panel panel-default order-history">
                                     <div class="panel-body">

                                            <div class="col-lg-4">
                                                   <div class="form-group">
                                                       <label for="inputdefault"  class="profile-field-label">Size:</label>                                            
                                                      <select name="banner_size" id="banner_size" class="form-control">                                                
                                                           <?php foreach ($BannersLists as $banner) {?>
                                                               <option value="<?php echo $banner['iBannerId']; ?>|<?php echo $banner['iAmount']; ?>" ><?php echo $banner['vBannerSize']; ?></option>
                                                            <?php }?>                                         
                                                     </select>
                                                   </div>
                                            </div>
                                             <div class="col-lg-4">
                                                   <div class="form-group">
                                                       <label for="inputdefault"  class="profile-field-label">Quantity:</label>                                            
                                                      <select name="quantity" id="quantity" class="form-control">                                                
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>

                                                     </select>
                                                   </div>
                                            </div>
                                             <div class="col-lg-4">
                                                   <div class="form-group">
                                                       <label for="inputdefault"  class="profile-field-label">Fair Amount:</label>                                            
                                                       <div class="banner-price-cal"><b id="bannerPrice"><?php echo $BannersLists[0]['iAmount'] ? $BannersLists[0]['iAmount']: ''; ?></b><span class="span-usd">$</span></div>
                                                   </div>
                                            </div>




                                     </div>
                                  </div>
                               </div>
                                <div class="col-lg-12">
                                  <div class="panel panel-default order-history">
                                     <div class="panel-body"> 
                                           <div class="col-lg-12">
                                                   <div class="form-group">
                                                       <div class="form-group">
                                                            <label for="inputdefault"  class="profile-field-label">Delivery Address:</label>
                                                            <textarea rows="3" name="vDaddress" id="vDaddress" class="form-control profile-field" placeholder="Address" style="height:auto !important;"></textarea>
                                                        </div>
                                                   </div>
                                            </div>
                                           <div class="col-lg-12">
                                                   <div class="form-group">
                                                       <label for="inputdefault"  class="profile-field-label"></label>
                                                       <input type="submit" value="Buy now"  class="btn btn-primary form-control banner-view-buy-btn">     
                                                   </div>
                                            </div>
                                                                             

                                     </div>
                                  </div>
                               </div>
                            </form>
                        </div>
                     </div>
                    
                  </div>
                  </form>
               </div>
            </div>
         </div>

<div class="spacer-small"></div>
<script>
$(document).ready(function(){
    $('#quantity').on('change',function(){
        
        var quantity=$(this).val();
        var bannerValue=$("#banner_size").val().split('|');
        var prize=bannerValue[1];
        
        var FinalPrice=quantity*prize;
        $('#bannerPrice').html(FinalPrice);
    });
    $('#banner_size').on('change',function(){
        var bannerValue=$(this).val().split('|');
        var prize=bannerValue[1];
        var quantity=$('#quantity').val();
        var FinalPrice=quantity*prize;
        $('#bannerPrice').html(FinalPrice);
    });
    $("#BannerPurchaseForm").validate({
            rules: {               
                vDaddress: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                }
            },
            messages: {
                vDaddress: {
                    required: "Delivery address is required",
                    minlength: "Delivery address should be at least {10} characters long", 
                    maxlength: "Delivery address should be at maximum {100} characters long" 
                }
            },
            submitHandler: function (form) { 
                var actionURL='<?php echo DOMAIN_URL.'/banner/buy'; ?>';
                $("#BannerPurchaseForm").attr("action",actionURL);
                $("#BannerPurchaseForm").trigger('submit');                
                return true;  // for demo
            }
        });
});
</script>