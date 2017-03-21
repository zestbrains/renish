<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-users font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="clearfix"></div>
<div class="portlet-body form">
  <form class="form-horizontal" name="frmUser" id="frmUser" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_user"/>
    <input type="hidden" name="iUserId" value="<?php echo $user['iUserId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="vName"><?php echo MEND_SIGN; ?>Name: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $user['vName']; ?>" name="vName" id="vName">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="eUserRole"><?php echo MEND_SIGN; ?>Role: </label>
      <div class="col-md-4 a">
        <label class="radio-inline"><input type="radio" name="eUserRole" id="eUserRole" value="admin"
        <?php echo ($user['eUserRole'] == 'admin') ? 'checked' : '' ?> checked>Admin</label>
        <label class="radio-inline"><input type="radio" name="eUserRole" id="eUserRole" value="user"
          <?php echo ($user['eUserRole'] == 'user') ? 'checked' : '' ?> >User</label>
      </div>
    </div>
    <?php if ($user['iUserId'] <= 0) {?>
     <div class="form-group">
      <label class="col-md-3 control-label" for="vEmail"><?php echo MEND_SIGN; ?>Email: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $user['vEmail']; ?>" name="vEmail" id="vEmail" <?php echo $user['iUserId'] != '' ? 'disabled' : '' ?>>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="vPassword"><?php echo MEND_SIGN; ?>Password: </label>
      <div class="col-md-4">
        <input type="password" class="form-control" value="<?php echo $user['vPassword']; ?>" name="vPassword" id="vPassword">
      </div>
    </div>
    <?php }?>
   <div class="form-group">
      <label class="col-md-3 control-label" for="vCity"><?php echo MEND_SIGN; ?>City: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $user['vCity']; ?>" name="vCity" id="vCity">
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label" for="vPinCode"><?php echo MEND_SIGN; ?>PinCode: </label>
      <div class="col-md-4">
         <input type="text" class="form-control" value="<?php echo $user['vPinCode']; ?>" name="vPinCode" id="vPinCode">
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label" for="vAddress">Address: </label>
      <div class="col-md-4">
         <textarea name="vAddress" id="vAddress" class="form-control"><?php echo $user['vAddress']; ?></textarea>
      </div>
   </div>
   <div class="form-group">
       <label class="col-md-3 control-label" for="vProfileImage">Profile</label>
       <div class="col-md-4">
          <img src="<?php echo $user['vProfileImage']; ?>" id="img" title="Image" alt="" height="100" width="100" >
          <div class="margin-top-10"></div>
          <input type="file" class="form-control" value="" name="vProfileImage" id="vProfileImage">
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
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#img').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
$("#vProfileImage").change(function(){
    readURL(this);
});
</script>