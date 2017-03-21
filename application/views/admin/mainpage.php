<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<noscript>
<meta http-equiv="refresh" content="0; url=<?php echo base_url() . 'noscript'; ?>" />
</noscript>
<meta charset="utf-8"/>
<title><?php echo $headTitle; ?> | <?php echo SITENAME; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<base href="<?php echo base_url(); ?>">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_PLUGINS . 'font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_PLUGINS . 'simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_PLUGINS . 'bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_PLUGINS . 'uniform/css/uniform.default.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_PLUGINS . 'switch/bootstrap-switch.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(ADM_PLUGINS . 'select2/select2.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . ADM_PLUGINS; ?>datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link href="<?php echo base_url(ADM_CSS . 'bootstrap-datetimepicker.min.css'); ?>" type="text/css" rel="stylesheet" />
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo base_url(ADM_CSS . 'components-rounded.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_CSS . 'plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_CSS . 'layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(ADM_CSS . 'themes/light.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url(ADM_CSS . 'custom.css'); ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(ADM_PLUGINS . 'bootstrap-toastr/toastr.min.css'); ?>"/>

<!-- END THEME STYLES -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(ADM_IMG . "favicon.png"); ?>">
 <script>
		//NProgress.start();
		var ADMIN_URL = '<?php echo base_url() . ADM_URL; ?>';
		var SITE_URL = '<?php echo base_url(); ?>';
		var SITE_IMG = '<?php echo base_url() . SITE_IMG; ?>';
 </script>
<script src="<?php echo base_url(ADM_PLUGINS . 'jquery.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(ADM_PLUGINS . 'datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . ADM_PLUGINS; ?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(ADM_PLUGINS . 'switch/bootstrap-switch.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(ADM_PLUGINS . 'bootbox-master/bootbox.js'); ?>"></script>
<script src="<?php echo base_url() . ADM_JS; ?>custom.js?<?php echo filemtime(FCPATH . ADM_JS . 'custom.js'); ?>"></script>
<script src="<?php echo base_url() . ADM_JS; ?>listing.js"></script>
<script src="<?php echo base_url(ADM_JS . 'bootstrap-datetimepicker.min.js'); ?>" type="text/javascript"></script>
</head>
<!-- END HEAD -->
<body class="<?php echo $module == 'login' ? 'login' : 'page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo'; ?>">
<?php if ($header_panel) {$this->load->view('admin/header');}?>
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<?php if ($left_panel) {$this->load->view('admin/left', $left);}?>
<?php $this->load->view('admin/' . $module);?>
</div>
<!-- END CONTAINER -->
<?php if ($footer_panel) {$this->load->view('admin/footer');}?>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url() . ADM_PLUGINS; ?>respond.min.js"></script>
<script src="<?php echo base_url() . ADM_PLUGINS; ?>excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo base_url() . ADM_PLUGINS; ?>jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url() . ADM_PLUGINS; ?>jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() . ADM_PLUGINS; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() . ADM_PLUGINS; ?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>


<!-- END CORE PLUGINS -->
<script src="<?php echo base_url() . ADM_PLUGINS; ?>ckeditor/ckeditor.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() . ADM_JS; ?>metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url() . ADM_JS; ?>layout.js" type="text/javascript"></script>
<script src="<?php echo base_url() . ADM_JS; ?>ui-toastr.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script src="<?php echo base_url() . ADM_PLUGINS; ?>jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(ADM_PLUGINS); ?>/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() . ADM_PLUGINS; ?>select2/select2.min.js"></script>
<script src="<?php echo base_url() . ADM_PLUGINS; ?>bootstrap-toastr/toastr.min.js"></script>
<script src="<?php echo base_url() . ADM_JS; ?>custom_validation.js"></script>


<script src="<?php echo base_url() . ADM_JS; ?>demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   UIToastr.init();
});
function IsNumeric(evt)
        {
          var theEvent = evt || window.event;
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
          if (key.length == 0) return;
          var regex = /^[0-9]+$/;
          if (!regex.test(key))
          {
              theEvent.returnValue = false;
              if (theEvent.preventDefault) theEvent.preventDefault();
          }
        }
</script>
<!-- END JAVASCRIPTS -->
<?php if (isset($msgType) && !empty($msgType)) {
	echo $msgType;
	$this->session->unset_userdata('msgType');}?>
</body>
<!-- END BODY -->
</html>