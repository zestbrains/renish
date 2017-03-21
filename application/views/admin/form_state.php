<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-flag font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="clearfix"></div>
<div class="portlet-body form">
  <form class="form-horizontal" name="frmState" id="frmState" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_state"/>
    <input type="hidden" name="iStateId" id="iStateId" value="<?php echo $state['iStateId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="iCountryId"><?php echo MEND_SIGN; ?>Select Country: </label>
      <div class="col-md-4">
         <select name="iCountryId" id="iCountryId" class="form-control">
             <?php foreach ($countries as $country) {$selected = ($state['iCountryId'] != '' ? ($country['iCountryId'] == $state['iCountryId']) ? 'selected="selected"' : '' : '');?>
                <option value="<?php echo $country['iCountryId']; ?>" <?php echo $selected; ?>><?php echo $country['vCountry']; ?></option>
             <?php }?>
         </select>
      </div>
   </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="vState"><?php echo MEND_SIGN; ?>Name: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $state['vState']; ?>" name="vState" id="vState">
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