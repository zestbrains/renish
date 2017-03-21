<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-money font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="clearfix"></div>
<div class="portlet-body form">
  <form class="form-horizontal" name="frmDiscount" id="frmDiscount" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_discount"/>
    <input type="hidden" name="iDiscountId" id="iDiscountId" value="<?php echo $discount['iDiscountId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="iPercentage"><?php echo MEND_SIGN; ?>Percentage: </label>
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" value="<?php echo $discount['iPercentage']; ?>" name="iPercentage" id="iPercentage" data-error-container="#percentage_error" maxlength="3">
          <span class="input-group-addon">%</span>
        </div>
        <span id="percentage_error" class="has-error"></span>
      </div>
    </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vCoupenPrice"><?php echo MEND_SIGN; ?>Coupen Price: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $discount['vCoupenPrice']; ?>" name="vCoupenPrice" id="vCoupenPrice">
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label" for="iRefund"><?php echo MEND_SIGN; ?>Refund: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $discount['iRefund']; ?>" name="iRefund" id="iRefund">
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label" for="dExpiryDate"><?php echo MEND_SIGN; ?>Start Date: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $discount['dExpiryDate']; ?>" readonly name="dExpiryDate" id="dExpiryDate">
      </div>
    </div>
    <!-- Form body over -->
    <div class="form-actions">
      <div class="row">
        <div class="col-md-offset-3 col-md-9">
          <button type="submit" class="btn green">Submit</button>
          <a href="javascript:back_portlet()" class="btn default">Cancel</a>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
$(document).ready(function(){

  $('#dExpiryDate').datetimepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      todayBtn: true,
      minView : 2,
  });
});
</script>