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
  <form class="form-horizontal" name="frmCity" id="frmCity" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_city"/>
    <input type="hidden" name="iCityId" id="iCityId" value="<?php echo $city['iCityId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="iCountryId"><?php echo MEND_SIGN; ?>Select Country: </label>
      <div class="col-md-4">
         <select name="iCountryId" id="iCountryId" class="form-control">
             <?php foreach ($countries as $country) {$selected = ($city['iCountryId'] != '' ? ($country['iCountryId'] == $city['iCountryId']) ? 'selected="selected"' : '' : '');?>
                <option value="<?php echo $country['iCountryId']; ?>" <?php echo $selected; ?>><?php echo $country['vCountry']; ?></option>
             <?php }?>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label" for="iStateId"><?php echo MEND_SIGN; ?>Select State: </label>
      <div class="col-md-4">
         <select name="iStateId" id="iStateId" class="form-control">
         </select>
      </div>
   </div>

    <div class="form-group">
      <label class="col-md-3 control-label" for="vCity"><?php echo MEND_SIGN; ?>Name: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $city['vCity']; ?>" name="vCity" id="vCity">
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
<script type="text/javascript">
$(function(){
  getStates();

  $("#iCountryId").change(function (){
    getStates();
  });
  function getStates(){
    options='<option value="">Please Select State</option>';

    if($("#iCountryId").val() != "")
    {
      var iCountryId = $("#iCountryId option:selected").val();
      $.post(SITE_URL+'admin/state/getState/',{id:iCountryId}, function(data) {
      var obj=JSON.parse(data);
      state='<?php echo $city['iStateId']; ?>';
      for(i=0;i<obj.length;i++){
            options += '<option value="'+obj[i].iStateId+'" '+(state==obj[i].iStateId?"selected":"")+'>'+obj[i].vState+'</option>';
         }
      $('#iStateId').html(options);
      });
    }else{
      $('#iStateId').html(options);
    }
  }

});
</script>