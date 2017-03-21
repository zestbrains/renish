<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-language font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="clearfix"></div>
<div class="portlet-body form">
  <form class="form-horizontal" name="frmContent" id="frmContent" method="post" action="javascript:void(0)" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit_content"/>
    <input type="hidden" name="iContentId" id="iContentId" value="<?php echo $content['iContentId']; ?>" />

    <div class="form-group">
      <label class="col-md-3 control-label" for="vTitle"><?php echo MEND_SIGN; ?>Title: </label>
      <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $content['vTitle']; ?>" name="vTitle" id="vTitle">
      </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="vContent">Content<?php echo MEND_SIGN; ?></label>
        <div class="col-md-9">
          <textarea name="vContent" id="vContent" class="form-control" rows="6" data-error-container="#editor2_error"><?php echo $content['vContent']; ?></textarea>
          <div id="editor2_error"></div>
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
  CKEDITOR.replace("vContent",{ filebrowserUploadUrl: '<?php echo base_url("admin/content/upload_ck_file"); ?>'});
</script>