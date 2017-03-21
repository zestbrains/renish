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
  <form class="form-horizontal" name="frmBanner" id="frmBanner" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_banner"/>
    <input type="hidden" name="iBannerId" id="iBannerId" value="<?php echo $banner['iBannerId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="iAmount"><?php echo MEND_SIGN; ?>Amount: </label>
      <div class="col-md-4">
          <input type="text" class="form-control" value="<?php echo $banner['iAmount']; ?>" name="iAmount" id="iAmount" maxlength="6">
      </div>
    </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vBannerSize">Banne Size: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $banner['vBannerSize']; ?>" name="vBannerSize" id="vBannerSize">
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