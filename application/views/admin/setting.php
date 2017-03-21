<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs font-green-sharp"></i>
							<span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle;?></span>
							<span class="caption-helper">Manage site settings...</span>
						</div>
						<div class="clearfix"></div>
						<?php echo $bradcrumb;?>
					</div>
					<div class="clearfix"></div>
					<div class="portlet-body form">
						<form class="form-horizontal" name="form_settings" id="form_settings" method="post" action="<?php echo base_url().ADM_URL.'setting'?>" >
							<input type="hidden" name="action" value="submit_settings" />
							<div class="form-body">
								<?php foreach($getFields as $k=>$setrow)
								{
									$required='';
									$mend_sign='';
									$setrow = (array)$setrow;
												
									if($setrow["vType"]=="file" && $setrow["vValue"]=="")
									{
										$required = "required ";
										$mend_sign = MEND_SIGN;
									}									
									if($setrow["eRequired"]=='y'){$required = "required ";$mend_sign = MEND_SIGN;}

									switch($setrow["vType"])
									{
										case 'textbox':
										case 'password':{?>
											<div class="form-group">
												<label class="col-md-3 control-label" for="<?php echo $setrow["iFieldId"];?>"><?php echo $setrow["vLabel"];?><?php echo $mend_sign;?></label>
												<div class="col-md-4">
													<input type="<?php echo $setrow["vType"];?>" name="<?php echo $setrow["iFieldId"];?>" id="<?php echo $setrow["iFieldId"];?>" class="form-control <?php echo $required; echo $setrow["vClass"];?>" value="<?php echo $setrow["vValue"];?>" name="<?php echo $setrow["iFieldId"];?>" id="<?php echo $setrow["iFieldId"];?>">
												</div>
											</div>										
										<?php 
										break;}
										case 'file':{?>
											<div class="form-group">
												<label class="col-md-3 control-label" for="<?php echo $setrow["iFieldId"];?>"><?php echo $setrow["vLabel"];?><?php echo $mend_sign;?></label>
												<div class="col-md-4">
													<input type="<?php echo $setrow["vType"];?>" name="<?php echo $setrow["iFieldId"];?>" id="<?php echo $setrow["iFieldId"];?>" class="form-control <?php echo $required; echo $setrow["vClass"];?>" name="<?php echo $setrow["iFieldId"];?>" id="<?php echo $setrow["iFieldId"];?>">
													<div class="clearfix margin-top-10"></div>
													<img src="<?php echo base_url().SITE_IMG.$setrow["vValue"];?>" />
												</div>
												

											</div>											
										<?php break;}
										case 'textarea':{?>
											<div class="form-group">
												<label class="col-md-3 control-label" for="<?php echo $setrow["iFieldId"];?>"><?php echo $setrow["vLabel"];?><?php echo $mend_sign;?></label>
												<div class="col-md-4">
													<textarea name="<?php echo $setrow["iFieldId"];?>" id="<?php echo $setrow["iFieldId"];?>" class="form-control col-md-6 col-xs-12 <?php echo $required; echo $setrow["vClass"];?>"><?php echo $setrow["vValue"];?></textarea>													
												</div>
											</div>	
											
										<?php break;}
										case 'radio':{$options = explode(',',$setrow["vOptions"]);?>
											<div class="form-group">
												<label class="col-md-3 control-label"><?php echo $setrow["vLabel"];?><?php echo $mend_sign;?></label>
												<div class="col-md-4">
												<?php foreach($options as $key=>$value){?> 
													<label class="radio-inline"><input type="radio" <?php echo $value == $setrow["vValue"]?'checked':'' ?> data-error-container="#privacy_error_<?php echo $setrow["iFieldId"];?>" value="<?php echo $value ;?>" name="<?php echo $setrow["iFieldId"];?>"><?php echo $value; ?> </label>
												<?php }?>												
												<span id="privacy_error_<?php echo $setrow["iFieldId"];?>"></span>
												</div>
											</div>
										<?php break;}
									}

								}?>
								
							</div>
							<!-- Form body over -->
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Submit</button>
										<a href="<?php echo base_url().ADM_URL;?>" class="btn default">Cancel</a>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	jQuery.validator.addMethod("extension", function(value, element, param) {
			param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g";
			return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
		}, $.validator.format("Only jpg|jpeg|png allowed."));

	$.validator.addClassRules('email_class', {
        email:true
    });
	$.validator.addClassRules('img_class', {
       extension:true
    });
});
$(document).on('submit','#form_settings', function(e){
		$("#form_settings").validate({
			ignore:[],
			errorClass: 'help-block',
			errorElement: 'span',
            highlight: function (element) {
			   $(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			errorPlacement: function (error, element) { 
				if (element.attr("data-error-container")) { 
					error.appendTo(element.attr("data-error-container"));
				} else {
					error.insertAfter(element);
				}
            }
		});
		if($("#form_settings").valid()){
			return true;
		}else{
			return false;
		}
	});
</script>

