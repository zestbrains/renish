<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-users font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
      <span class="caption-helper">manage records...</span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="portlet-body">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-8">
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">Name :</label>
                  <div class="col-md-9"><?php echo $user['vName']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">Role :</label>
                  <div class="col-md-9"><?php echo $user['eUserRole']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">Email address :</label>
                  <div class="col-md-9"><?php echo $user['vEmail']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">City :</label>
                  <div class="col-md-9"><?php echo $user['vCity']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">Address :</label>
                  <div class="col-md-9"><?php echo $user['vAddress']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">PinCode :</label>
                  <div class="col-md-9"><?php echo $user['vPinCode']; ?></div>
               </div>
               <div class="form-group clearfix">
                  <label class="control-label col-md-3">Profile :</label>
                  <div class="col-md-9"><img src="<?php echo $user['vProfileImage']; ?>"></div>
               </div>
               <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <a href="javascript:back_portlet()" class="btn default">Close</a>
                    </div>
                  </div>
               </div>
            </div>
         </div>
         <!--end row-->
      </div>
   </div>
</div>