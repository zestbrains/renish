<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-car font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="clearfix"></div>
<div class="portlet-body form">
  <form class="form-horizontal" name="frmGarage" id="frmGarage" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_garage"/>
    <input type="hidden" name="iGarageId" id="iGarageId" value="<?php echo $garage['iGarageId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="vGarageName"><?php echo MEND_SIGN; ?>Name: </label>
      <div class="col-md-4">
          <input type="text" class="form-control" value="<?php echo $garage['vGarageName']; ?>" name="vGarageName" id="vGarageName">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-3 control-label" for="vGarageType"><?php echo MEND_SIGN; ?>Type: </label>
      <div class="col-md-6 a">
        <label class="radio-inline"><input type="radio" name="vGarageType" id="vGarageType" value="1"
        <?php echo ($garage['vGarageType'] == '1') ? 'checked' : '' ?>>Body Repair Shop</label>
        <label class="radio-inline"><input type="radio" name="vGarageType" id="vGarageType" value="2"
          <?php echo ($garage['vGarageType'] == '2') ? 'checked' : '' ?> >Auto Repair Shop</label>
        <label class="radio-inline"><input type="radio" name="vGarageType" id="vGarageType" value="3"
          <?php echo ($garage['vGarageType'] == '3') ? 'checked' : '' ?> >Both</label>
      </div>
    </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="iCountryId"><?php echo MEND_SIGN; ?>Select Country: </label>
      <div class="col-md-4">
         <select name="iCountryId" id="iCountryId" class="form-control">
             <?php foreach ($countries as $country) {$selected = ($garage['iCountryId'] != '' ? ($country['iCountryId'] == $garage['iCountryId']) ? 'selected="selected"' : '' : '');?>
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
      <label class="col-md-3 control-label" for="iCityId"><?php echo MEND_SIGN; ?>Select City: </label>
      <div class="col-md-4">
         <select name="iCityId" id="iCityId" class="form-control">
         </select>
      </div>
   </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vAddress">Address: </label>
      <div class="col-md-4">
         <textarea class="form-control" name="vAddress" id="vAddress"><?php echo $garage['vAddress']; ?></textarea>
      </div>
   </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vZipCode"><?php echo MEND_SIGN; ?>Zip-code: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $garage['vZipCode']; ?>" name="vZipCode" id="vZipCode" maxlength="10">
      </div>
   </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vMobile"><?php echo MEND_SIGN; ?>Mobile No: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $garage['vMobile']; ?>" name="vMobile" id="vMobile" maxlength="15">
      </div>
   </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="vOffice_mobile">Office No: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $garage['vOffice_mobile']; ?>" name="vOffice_mobile" id="vOffice_mobile" maxlength="15">
      </div>
   </div>

   <div class="form-group">
      <label class="col-md-3 control-label" for="tDescription">About Garage: </label>
      <div class="col-md-7">
         <textarea class="form-control" name="tDescription" id="tDescription" rows="7"><?php echo $garage['tDescription']; ?></textarea>
      </div>
   </div>

   <div class="form-group">
       <label class="col-md-3 control-label" for="vCoverImage">Cover Image: </label>
       <div class="col-md-4">
          <img src="<?php echo $garage['vCoverImage']; ?>" id="img" title="Image" alt="" height="150" width="300" >
          <div class="margin-top-10"></div>
          <input type="file" class="form-control" value="" name="vCoverImage" id="vCoverImage">
       </div>
    </div>

    <div class="form-group">
      <label class="col-md-3 control-label" for="iTotalMechanic"><?php echo MEND_SIGN; ?>Total Mechanics: </label>
      <div class="col-md-4">
         <select name="iTotalMechanic" id="iTotalMechanic" class="form-control">
             <?php for ($i=1;$i<=10;$i++) {$selected = ($garage['iTotalMechanic'] != '' ? ($i == $garage['iTotalMechanic']) ? 'selected="selected"' : '' : '');?>
                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
             <?php }?>
             <option value="10+" <?php echo ($garage['iTotalMechanic'] != '' ? ("10+" == $garage['iTotalMechanic']) ? 'selected="selected"' : '' : ''); ?>>10+</option>
             <option value="20+" <?php echo ($garage['iTotalMechanic'] != '' ? ("20+" == $garage['iTotalMechanic']) ? 'selected="selected"' : '' : ''); ?>>20+</option>
             <option value="50+" <?php echo ($garage['iTotalMechanic'] != '' ? ("50+" == $garage['iTotalMechanic']) ? 'selected="selected"' : '' : ''); ?>>50+</option>
         </select>
      </div>
   </div>

    <div class="form-group">
      <label class="col-md-3 control-label" for="vCouponDiscount"><?php echo MEND_SIGN; ?>Coupon Discount: </label>
      <div class="col-md-4">
         <select name="vCouponDiscount" id="vCouponDiscount" class="form-control">
             <?php foreach ($discounts as $discount) {$selected = ($garage['vCouponDiscount'] != '' ? ($discount['iPercentage'] == $garage['vCouponDiscount']) ? 'selected="selected"' : '' : '');?>
                <option value="<?php echo $discount['iPercentage']; ?>" <?php echo $selected; ?>><?php echo $discount['iPercentage'].'%'; ?></option>
             <?php }?>
         </select>
      </div>
   </div>

   <div class="form-group <?php echo ($garage['vCouponDiscount'] == '0') ?'':'hidden';?>" id="coupon_warning">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-9" style="color:red;">
          (Note : If you provide 0% discount than customer will not able to post review!! )         
      </div>
   </div>
   
   <div class="form-group">
      <label class="col-md-3 control-label" for="vAmountForCoupon"><?php echo MEND_SIGN; ?>Coupon Amount: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $garage['vAmountForCoupon']; ?>" name="vAmountForCoupon" id="vAmountForCoupon">
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

  $("#vCouponDiscount").change(function (){
    if($(this).val()=='0')
      $("#coupon_warning").removeClass('hidden');
    else
      $("#coupon_warning").addClass('hidden');
  });

  $("#iCountryId").change(function (){
    getStates();
  });
  $("#iStateId").change(function (){
    getCities();
  });

  function getStates(){
    options='<option value="">Please Select State</option>';

    if($("#iCountryId").val() != "")
    {
      var iCountryId = $("#iCountryId option:selected").val();
      $.post(SITE_URL+'admin/state/getState/',{id:iCountryId}, function(data) {
      var obj=JSON.parse(data);
      state='<?php echo $garage['iStateId']; ?>';
      for(i=0;i<obj.length;i++){
            options += '<option value="'+obj[i].iStateId+'" '+(state==obj[i].iStateId?"selected":"")+'>'+obj[i].vState+'</option>';
         }
      $('#iStateId').html(options);
      getCities();
      });
    }else{
      $('#iStateId').html(options);
    }
  }

  function getCities(){
    city_options='<option value="">Please Select City</option>';

    if($("#iStateId").val() != "")
    {
      var iStateId = $("#iStateId option:selected").val();
      $.post(SITE_URL+'admin/city/getCity/',{id:iStateId}, function(data) {
      var obj=JSON.parse(data);
      city='<?php echo $garage['iCityId']; ?>';
      for(i=0;i<obj.length;i++){
          city_options += '<option value="'+obj[i].iCityId+'" '+(city==obj[i].iCityId?"selected":"")+'>'+obj[i].vCity+'</option>';
      }
      $('#iCityId').html(city_options);
      });
    }else{
      $('#iCityId').html(city_options);
    }
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
  $("#vCoverImage").change(function(){
      readURL(this);
  });

});
</script>