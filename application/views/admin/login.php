
<link href="<?php echo base_url() . ADM_CSS; ?>login3.css" rel="stylesheet" type="text/css"/>
<div class="logo">
	<a href="<?php echo base_url(); ?>">
	<img src="<?php echo base_url() . ADM_IMG . SITE_LOGO; ?>" alt="" style="width: 28%;"/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?php
if ($method == 'reset') {?>
		<form name="form_reset" id="form_reset" action="<?php echo base_url() . ADM_URL . 'login/reset/' . $token; ?>" method="post">
		<input type="hidden" name="action" value="submit_reset">
		<input type="hidden" name="vToken" value="<?php echo $token; ?>">
			<h3><?php echo $headTitle; ?></h3>
			<p>
				 Enter new password and confirm password to reset.
			</p>
			<div class="form-group">
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" placeholder="New Password" name="npassword" id="npassword"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" placeholder="Confirm Password" name="cpassword" id="cpassword"/>
				</div>
			</div>
			<div class="form-actions">
				<a  href="<?php echo base_url() . ADM_URL; ?>login" class="btn">
				<i class="m-icon-swapleft"></i> Login </a>
				<button type="submit" class="btn green-haze pull-right">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
		</form>
		<script type="text/javascript">
			$(document).on("submit","#form_reset",function()
			{
				$("#form_reset").validate({
						ignore:[],
						errorClass: 'help-block',
						errorElement: 'span',
			            highlight: function (element) {
						   $(element).closest('.form-group').addClass('has-error');
						},
						unhighlight: function (element) {
							$(element).closest('.form-group').removeClass('has-error');
						},
						rules: {

						npassword: {required: true},
						cpassword: {required: true,equalTo:"#npassword"}

					},
					messages: {
						npassword: {
							required: "&nbsp;Password is required"

						},
						cpassword: {
							required: "&nbsp;Confirm password is required",
							equalTo:"&nbsp;Confirm password must match"

						}
					},
						errorPlacement: function (error, element) {
							if (element.attr("data-error-container")) {
								error.appendTo(element.attr("data-error-container"));
							} else {
								error.insertAfter(element);
							}
			            }
					});
					if($("#form_reset").valid()){
						return true;
					}else{
						return false;
					}
			});
		</script>
	<?php } else {?>

		<form class="login-form" name="form_login" id="form_login" method="post" action="javascript:">
			<input type="hidden" name="action" value="submit_login">
				<h3 class="form-title">Login to your account</h3>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Email</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input class="form-control placeholder-no-fix required" type="text" autocomplete="off" placeholder="Email" name="vEmail" email="true" value="<?php echo $email; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input class="form-control placeholder-no-fix required" type="password" autocomplete="off" placeholder="Password" name="vPassword" value="<?php echo $password; ?>"/>
					</div>
				</div>
				<div class="form-actions">
					<label class="checkbox">
					<input type="checkbox" name="isremember" value="1" <?php echo $isremember; ?>/> Remember me </label>
					<button type="submit" class="btn green-haze pull-right">
					Login <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>

				<div class="forget-password">
					<h4>Forgot your password ?</h4>
					<p>
						No worries, click <a href="javascript:;" id="forget-password">
						here </a>
						to reset your password.
					</p>
				</div>

			</form>
			<!-- END LOGIN FORM -->
			<script src="<?php echo base_url() . ADM_JS; ?>login.js" type="text/javascript"></script>
			<script>
				jQuery(document).ready(function(){
				  Login.init();
				});
			</script>
			<!-- BEGIN FORGOT PASSWORD FORM -->
			<form class="forget-form" name="form_forgot" id="form_forgot" action="javascript:" method="post">
			<input type="hidden" name="action" value="submit_forgot">
				<h3>Forget Password ?</h3>
				<p>
					 Enter your e-mail address below to reset your password.
				</p>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa fa-envelope"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="vEmail" id="femail"/>
					</div>
				</div>
				<div class="form-actions">
					<button type="button" id="back-btn" class="btn">
					<i class="m-icon-swapleft"></i> Back </button>
					<button type="submit" class="btn green-haze pull-right">
					Submit <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
			</form>
			<!-- END FORGOT PASSWORD FORM -->

	<?php }?>


</div>

<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 <?php echo str_replace('{{YEAR}}', date('Y'), FOOTER_TEXT); ?>
</div>
