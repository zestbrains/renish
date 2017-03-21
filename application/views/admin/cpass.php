<script type="text/javascript" src="<?php echo base_url() . ADM_JS; ?>jquery.crypt.js"></script>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs font-green-sharp"></i>
							<span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
							<span class="caption-helper">Change Your Password</span>
						</div>
						<div class="clearfix"></div>
						<?php echo $bradcrumb; ?>
					</div>
						<div class="clearfix"></div>
						<div class="portlet-body form">
							<form class="form-horizontal" name="form_cpass" id="form_cpass" method="post" action="<?php echo base_url() . ADM_URL . 'cpass' ?>" >
								<input type="hidden" name="action" value="submit_cpass" />
								<input type="hidden" name="passvalue" id="passvalue" value="<?php echo $passvalue; ?>">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Old Password<?php echo MEND_SIGN; ?></label>
										<div class="col-md-4">
											<div class="input-icon right">
												<i class="fa fa-eye see-password"></i>
												<input type="password" name="opassword" id="opassword" class="form-control" placeholder="Old Password" data-error-container="#error_opassword">
											</div>
											<span id="error_opassword"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="npassword">New Password<?php echo MEND_SIGN; ?></label>
										<div class="col-md-4">
											<div class="input-icon right">
												<i class="fa fa-eye see-password"></i>
												<input type="password" name="npassword" id="npassword" class="form-control" placeholder="New Password" data-error-container="#error_npassword">
											</div>
											<span id="error_npassword"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="cpassword">Confirm Password<?php echo MEND_SIGN; ?></label>
										<div class="col-md-4">
											<div class="input-icon right">
												<i class="fa fa-eye see-password"></i>
												<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" data-error-container="#error_cpassword">
											</div>
											<span id="error_cpassword"></span>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?php echo base_url() . ADM_URL; ?>" class="btn default">Cancel</a>
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

<script type="">
$(document).ready(function(){
	$.validator.addMethod("OldPswCheck", function(value, element) {
			 var oldpswtxt = $().crypt({method:"md5",source:value});
			 var oldpswval = $("#passvalue").val();
			 return (oldpswval==oldpswtxt);
		}, "");
	$.validator.addMethod("NewPswCheck", function(value, element) {
			var newpswtxt = $("#npassword").crypt({method:"md5",source:value});
			var oldpswval = $("#passvalue").val();
			return (oldpswval!=newpswtxt);
		}, "");

	$(".see-password").mousedown(function(){
        $(this).next('input').attr('type','text');
    }).mouseup(function(){
        $(this).next('input').attr('type','password');
    }).mouseout(function(){
        $(this).next('input').attr('type','password');
    });
});
$(document).on('submit','#form_cpass', function(e){
		$("#form_cpass").validate({
		rules: {
			opassword: {
				required: true,
				OldPswCheck:true
			},
			npassword: {
				required: true,
				minlength: 6,
				NewPswCheck:true,
				passcheck:true

			},
			cpassword: {
				required: true,
				equalTo: "#npassword",
				passcheck:true
			}
		},
		messages: {
			opassword: {
				required: "&nbsp;Old password is required",
				OldPswCheck:"&nbsp;Old password is not correct"
			},
			npassword: {
				required: "&nbsp;New password is required",
				minlength:"&nbsp;At least 6 characters.",
				NewPswCheck:"&nbsp;This password is used currently please provide different",
				passcheck: "Password must contain atleast 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"

			},
			cpassword: {
				required: "&nbsp;Confirm password is required",
				equalTo: "&nbsp;Password should be same",
				passcheck: "Password must contain atleast 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"

			}
		},
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
	if($("#form_cpass").valid()){
		return true;
	}else{
		return false;
	}
});
</script>
