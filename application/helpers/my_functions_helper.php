<?php
/**
These are the general functions regular use in the projects
 **/
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter my Helpers
 *
 * @package		
 * @subpackage	my Helpers
 * @category	Helpers
 * @author		
 */

// ------------------------------------------------------------------------
if (!function_exists('front_breadcrumb')) {
	function front_breadcrumb($aBradcrumb = array()) {
		$content = "";
		ob_start();
		if (count($aBradcrumb) > 0) {
			?>
			<ul class="breadcrumbs list-inline">
				<?php
$i = 1;
			foreach ($aBradcrumb as $key => $link) {?>

						<li>
							<a href="<?php echo $link != '' ? $link : 'javascript:void(0)'; ?>"><?php echo ucfirst($key); ?></a>
						</li>
						<?php if ($i != count($aBradcrumb)) {?><li>/</li> <?php }?>

					<?php $i++;}
			?>
			</ul>
		<?php }
		$content = ob_get_clean();
		return $content;
	}
}
if (!function_exists('disMessage')) {
	/**
	 * Random Element - Takes an array as input and returns a random element
	 *
	 * @param	array
	 * @return	mixed	depends on what the array contains
	 */
	function disMessage($msgArray = array(), $script = true) {
		$CI = &get_instance();
		$message = '';
		$content = '';
		$type = isset($msgArray["type"]) ? $msgArray["type"] : NULL;
		$var = isset($msgArray["var"]) ? $msgArray["var"] : NULL;
		$CI->session->unset_userdata('msgType');
		if (!is_null($var)) {
			if (defined($var)) {
				$message = constant($var);
			} else {
				$message = $var;
			}

		}

		if ($script) {
			$content = '<script type="text/javascript" language="javascript">$(document).ready(function(){Custom.myNotification("' . ucwords($type) . '","' . $message . '");})</script>';
		} else {
			$content = $message;
		}

		return $content;
	}

}

if (!function_exists('priceDisplay')) {
	function priceDisplay($price = "", $sign = false) {
		return ($sign == true ? CURRENCY_SIGN : "") . ($price + 0);
	}
}
if (!function_exists('sendVerificationCode1')) {
	function sendVerificationCode1($to,$code='',$link='') {  
		$CI = &get_instance();
		$CI->load->model('admin/Admin');
                $CI->admin->siteSettings();
		$email_data = generateEmailTemplate('verification', array("{{ACCESS_LINK}}", "{{CODE}}"), array($link, $code));  

		$check = sendEmailAddress($to, $email_data['subject'], $email_data['message'], $email_data['fromemail'], $email_data['fromname']);
		if ($check) {
			return true;
		}else{
			return false;
		}
	}
}

if (!function_exists('sendVerificationCode')) {
	function sendVerificationCode($to,$code='',$link='') {  
		$subject = "Account Verification";
		$message = "
		<html>
		   <head>
		      <title>Untitled Document</title>
		      <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
		   </head>
		   <body style='font-family:Geneva, Arial, Helvetica, sans-serif; '>
		      <table width='70%' align='center' style='background-color:#F4F4F4; padding:20px; border-bottom:1px solid #ccc;'>
		         <tr style='border:1px solid #CCC; '>
		            <td height='95' valign='top'><a href='http://sureforless.com' target='_blank'><img alt='sureforless' src='http://sureforless.com/assets/files/uploads/coin_logo.png' width='355' height='107' style='margin:0 auto;display:block;height:100px;width:100px'></a></td>
		         </tr>
		         <tr>
		            <td>
		               <h2 align='center'><b style='color: #b5893c;border-bottom: 1px #b5893c;border-bottom-style: dotted; '>Account Confirmation </b></h2>
		            </td>
		         </tr>
		      </table>
		      <table width='70%' align='center' style='background-color:#F4F4F4; padding:20px; '>
		         <tr>
		            <td align='left' valign='top'>Dear User,</td>
		         </tr>
		         <tr>
		            <td align='left' valign='top'><p>Please access your account at SUREFORLESS to explore more </p><a href='".$link."' style=' color: #fff; text-decoration: none;display:block;    background-color: #b5893c;width: 200px;text-align: center;padding: 10px;' target='_blank'><strong>Confirm Your Account</strong></a> 
		            <p>with verification code :<font style='color: #b5893c;font-size: 16px;'><strong>". $code ."</strong></font></p></td>
		         </tr>
		      </table>
		      <table width='70%' align='center' style='background-color:#F4F4F4; padding:20px;border-bottom:5px solid #B28324; border-top:1px solid #E0E0E0; '>
		         <tr>
		            <td>
		               <p style='color:#333333; font-size:13px; '>Thank you for choosing to purchasing repair discount with <a href='http://sureforless.com/' style='color:#333;'>www.sureforless.com</a>. For questions regarding your order, please call us at <b style='color:#333; '>(972)787-5006</b>. Please print and take this confirmation with you during you visit to the repair shop. </p>
		            </td>
		         </tr>
		      </table>
		   </body>
		</html>";

		$CI = &get_instance();
		$CI->load->model('admin/Admin');
        $CI->Admin->siteSettings();
        // echo "a";exit;
        if(sendEmailAddress($to, $subject, $message,'noreply@sureforless.com')){
        	return true;
        }else{
        	return false;
        }		
	}
}

if (!function_exists('sendEmailAddress')) {
	function sendEmailAddress($to, $subject, $message, $fromEmail = ADMIN_EMAIL, $fromName = SITENAME) {
		$list = is_array($to) ? $to : (array) $to;
		$CI = &get_instance();
		$CI->load->library('email');
		$CI->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'localhost',
			'smtp_user' => 'noreply@sureforless.com',
			'smtp_pass' => 'UWc-lUVoBvf7',
			'smtp_port' => 2525,
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype' => "html",
		));
		$CI->email->from($fromEmail, $fromName);
		$CI->email->to($list);
		$CI->email->reply_to($fromEmail, $fromName);
		$CI->email->subject($subject);
		$CI->email->message($message); 

		if ($CI->email->send()) {
			return true;
		} else {
			//echo show_error($CI->email->print_debugger());
			return false;
		}

	}
}

// --------------------------------------------------------------------
if (!function_exists('breadcrumb')) {
	function breadcrumb($aBradcrumb = array()) {
		$content = "";
		ob_start();
		if (count($aBradcrumb) > 0) {
			?>
			<ul class="page-breadcrumb breadcrumb">
				<?php
$i = 1;
			foreach ($aBradcrumb as $key => $link) {?>

						<li>
							<a href="<?php echo $link != '' ? $link : 'javascript:void(0)'; ?>"><?php echo ucfirst($key); ?></a>
							<?php if ($i != count($aBradcrumb)) {?><i class="fa fa-circle"></i> <?php }?>
						</li>

					<?php $i++;}
			?>
			</ul>
		<?php }
		$content = ob_get_clean();
		return $content;
	}
}
if (!function_exists('deleteFile')) {
	function deleteFile($path = "", $empty = false) {
		$CI = &get_instance();
		if ($path != "") {
			$CI->load->helper("file");
			delete_files($path, $empty);
			if ($empty) {
				@rmdir($path);
			}

		}
	}
}
if (!function_exists('generateEmailTemplate')) {
	function generateEmailTemplate($sys_flag, $key = array(), $val = array()) {
	
		$content = array();
		$content['fromemail'] = ADMIN_EMAIL;
		$content['fromname'] = SITENAME;
		$content['message'] = "";
		$content['subject'] = "";
		
		$CI = &get_instance();
		$q = $CI->db->query("SELECT et.vTemplate,et.vSubject,et.vFromEmail,et.vFromName FROM mst_email_templates as et WHERE et.vSysFlag = ? AND et.eIsactive = ?", array($sys_flag, 'y'));

		if ($q->num_rows() === 1) {
			$r = $q->row_array();
			$footertext = str_replace('{{YEAR}}', date('Y'), FOOTER_TEXT);
			$sitelogo = base_url() . ADM_IMG . SITE_LOGO;
			$key = array_merge(array('{{SITENAME}}', '{{SITE_URL}}', '{{FOOTER_TEXT}}', '{{SITE_LOGO}}'), $key);
			$val = array_merge(array(SITENAME, base_url(), $footertext, $sitelogo), $val);

			$message = trim(stripslashes($r["vTemplate"]));
			$subject = trim(stripslashes($r["vSubject"]));
			$subject = str_replace('{{SITENAME}}', SITENAME, $subject);
			$message = str_replace($key, $val, $message);
			$content['message'] = $message;
			$content['subject'] = $subject;
			$content['fromemail'] = $r["vFromEmail"] != "" ? $r["vFromEmail"] : ADMIN_EMAIL;
			$content['fromname'] = $r["vFromName"] != "" ? $r["vFromName"] : SITENAME;
		}
		return $content;
	}
}
if (!function_exists('dateDisplay')) {
	function dateDisplay($date = "", $timestamp = false, $format = "l d M Y", $utc = "") {
		if ($date != "") {
			if (!$timestamp) {
				$date = strtotime($date);
			}
			if ($utc != "") {
				return date($format, ($date)) . $utc;
			} else {
				return date($format, ($date));
			}

		}

	}
}
if (!function_exists('displayImage')) {
	function displayImage($path = "", $imagename = "", $default = "noimage.jpg") {
		if (file_exists($path . $imagename)) {
			return base_url() . $path . $imagename;
		} else {
			return base_url() . $default;
		}
	}
}
if (!function_exists('get_date')) {
	function get_date() {
		return gmdate('Y-m-d H:i:s +0000');
	}
}
if (!function_exists('proper_link')) {
	function proper_link($link) {
		return rtrim($link, '/');
	}
}
if (!function_exists('load_css')) {
	function load_css($styles = array()) {
		$content = '';
		foreach ($styles as $css) {
			if (is_array($css)) {
				foreach ($css as $stl) {
					$content .= '<link href="' . base_url($stl) . '" type="text/css" rel="stylesheet" />';
				}
			} else {
				$content .= '<link href="' . $css . '" type="text/css" rel="stylesheet" />';
			}

		}
		return $content;
	}
}
if (!function_exists('load_js')) {
	function load_js($scripts = array()) {
		$content = '';
		foreach ($scripts as $js) {
			if (is_array($js)) {
				foreach ($js as $scr) {
					$content .= '<script src="' . base_url($scr) . '" type="text/javascript"></script>';
				}
			} else {
				$content .= '<script src="' . $js . '" type="text/javascript"></script>';
			}

		}
		return $content;
	}
}
function checkImage($id = 0, $filepath = "", $zc = 0, $ql = 100) {

	$CI = &get_instance();
	$src = base_url() . SITE_IMG . "no_image_available.jpg";
	$params = array();

	$q = $CI->db->query("SELECT * FROM mst_imagethumb WHERE iThumbId = ?", array($id));

	if ($q->num_rows() > 0) {
		$r = $q->row_array();
		$filepath = $filepath;
		if (!is_file(FCPATH . $filepath)) {
			if (!is_file(FCPATH . $r['vFolder'] . '/' . $r['vDefaultImage'])) {
				$filepath = "no_image_available.jpg";
			} else {
				$filepath = $r['vFolder'] . '/' . $r['vDefaultImage'];
			}

		}
		$src = $filepath;
		$src = base_url() . "image-thumb.php?w=" . $r['iWidth'] . "&h=" . $r['iHeight'] . "&zc=" . $zc . "&q=" . $ql . "&src=" . base_url() . $src;
	}
	return $src;
}
 
if (!function_exists('max_image_size')) {
	function max_image_size($folder = '') {
		$CI = &get_instance();
		$content = array('width' => 100, 'height' => 100);
		$q = $CI->db->query('SELECT MAX(height) as height ,MAX(width) as width FROM mst_imagethumb WHERE folder = ?', array($folder));
		if ($q->num_rows() > 0) {
			$r = $q->row();
			$content['width'] = $r->width;
			$content['height'] = $r->height;
		}
		return $content;
	}
}
if (!function_exists('empty_dir')) {
	function empty_dir($dir = "") {
		$dir = rtrim($dir, '/') . '/';
		if (file_exists($dir)) {
			$files = array_diff(scandir($dir), array('.', '..'));
			foreach ($files as $value) {
				(is_dir($dir . $value) ? empty_dir($dir . $value) : (@unlink($dir . $value)));
			}
			@rmdir($dir);
		}

	}
}
if (!function_exists('unlink_file')) {
	function unlink_file($files = "") {
		if (is_array($files)) {
			foreach ($files as $file) {
				unlink_file($file);
			}
		} else {
			if (is_file($files)) {
				@unlink($files);
			}
		}
	}
}
if (!function_exists('getTableValue')) {
	function getTableValue($table = '', $column = '', $where = array()) {
		$CI = &get_instance();
		$CI->db->select($column);
		$qry = $CI->db->get_where($table, $where);
		if ($qry->num_rows() > 0) {
			$qry = $qry->row();
			return $qry->$column;
		} else {
			return '';
		}
	}
}
if (!function_exists('formattedArray')) {
	function formattedArray($arr = array(), $isExit = true) {
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
		if ($isExit) {
			exit;
		}
	}

}
if (!function_exists('checkUserType')) {
	function checkUserType($userId = 0) {
		$CI = &get_instance();
		$CI->db->select('eUserType');
		$qry = $CI->db->get_where('tbl_users', array('iUserId' => $userId))->row();
		return $qry->eUserType;
	}
}
if (!function_exists('generate_field')) {
	function generate_field($k, $fields, $icon = "") {
		$content = "";
		$required = '';
		$mend_sign = '';
		$disabled = '';
		if ($fields['iseditable'] == 'n') {
			$disabled = 'disabled';
		}

		if ($fields["type"] == "file" && $fields["value"] == "") {
			//$required = "required ";
			//$mend_sign = MEND_SIGN;
		}
		if ($fields["required"] == 'y') {
			$required = "required ";
			$mend_sign = MEND_SIGN;}
		ob_start();
		switch ($fields["type"]) {
		case 'text':
		case 'password':{
				if ($icon != "") {
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><small>(<?php echo $fields["sys_flag"]; ?>) </small><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $icon; ?>
								</span>
								<input <?php echo $disabled; ?> type="<?php echo $fields["type"]; ?>"  name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="form-control <?php echo $required;
					echo $fields["class"]; ?>" value="<?php echo $fields["value"]; ?>" name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" data-error-container="#error_<?php echo $fields['id']; ?>">
							</div>
							<span id="error_<?php echo $fields['id']; ?>"></span>
						</div>
					</div>
				<?php } else {
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><small>(<?php echo $fields["sys_flag"]; ?>) </small><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
						<div class="col-md-4">
							<input <?php echo $disabled; ?> type="<?php echo $fields["type"]; ?>" name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="form-control <?php echo $required;
					echo $fields["class"]; ?>" value="<?php echo $fields["value"]; ?>" name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>">
						</div>

					</div>
				<?php }?>

			<?php
break;}
		case 'file':{
				?>
			<div class="form-group">
				<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
				<div class="col-md-4">
					<input type="<?php echo $fields["type"]; ?>" name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="form-control <?php echo $required;
				echo $fields["class"]; ?>" name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>">
					<div class="clearfix margin-top-10"></div>
					<img src="<?php echo $fields['value']; ?>" alt="" width="100px"/>
				</div>


			</div>
		<?php break;}
		case 'textarea':{
				if ($icon != "") {
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $icon; ?>
								</span>
								<textarea <?php echo $disabled; ?> name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="form-control col-md-6 col-xs-12 <?php echo $required;
					echo $fields["class"]; ?>" data-error-container="#error_<?php echo $fields['id']; ?>"><?php echo ($fields["value"]); ?></textarea>

							</div>
							<span id="error_<?php echo $fields['id']; ?>"></span>
						</div>
					</div>
				<?php } else {
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
						<div class="col-md-4">
							<textarea <?php echo $disabled; ?> name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="form-control col-md-6 col-xs-12 <?php echo $required;
					echo $fields["class"]; ?>"><?php echo trim($fields["value"]); ?></textarea>
						</div>
					</div>
				<?php }?>

			<?php
break;}
		case 'editor':
			{
				?>
				<div class="form-group">
					<label class="col-md-3 control-label" for="<?php echo $fields["id"]; ?>"><?php echo $fields["label"]; ?><?php echo $mend_sign; ?></label>
					<div class="col-md-8">
						<textarea <?php echo $disabled; ?> name="<?php echo $fields["id"]; ?>" id="<?php echo $fields["id"]; ?>" class="ckeditor form-control col-md-6 col-xs-12 <?php echo $required;
				echo $fields["class"]; ?>"><?php echo trim($fields["value"]); ?></textarea>
					</div>
				</div>
				<script>CKEDITOR.replace( '<?php echo $fields["id"]; ?>' )</script>
			<?php }
		default:{}
		}
		$content = ob_get_clean();
		return $content;
	}
}
function check_maintenance($check = 'no') {
	$CI = &get_instance();
	if ($check == 'yes') {
		redirect(base_url() . 'under_maintenance');
	}

}
if (!function_exists('isToken')) {
	function isToken($token, $table, $field) {
		$CI = &get_instance();

		if (isset($token) && $token) {
			$exists = $CI->db->select($field)->get_where($table, array($field => $token))->num_rows();
			if ($exists > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
if (!function_exists('generateUniqueToken')) {
	function generateUniqueToken($number = 10, $table, $field) {

		$arr = array('a', 'b', 'c', 'd', 'e', 'f',
			'g', 'h', 'i', 'j', 'k', 'l',
			'm', 'n', 'o', 'p', 'r', 's',
			't', 'u', 'v', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F',
			'G', 'H', 'I', 'J', 'K', 'L',
			'M', 'N', 'O', 'P', 'R', 'S',
			'T', 'U', 'V', 'X', 'Y', 'Z',
			'1', '2', '3', '4', '5', '6',
			'7', '8', '9', '0');
		$token = "";
		for ($i = 0; $i < $number; $i++) {
			$index = rand(0, count($arr) - 1);
			$token .= $arr[$index];
		}

		if (isToken($token, $table, $field)) {
			return generateUniqueToken($number, $table, $field);
		} else {
			return $token;
		}
	}
}
function mb_truncate($str, $limit) {
	return mb_substr(strip_tags($str), 0, $limit, 'UTF-8') . (mb_strlen($str) > $limit ? '...' : '');
}
function age($dob = "") {
	$from = new DateTime($dob);
	$to = new DateTime('today');
	return $from->diff($to)->y;
}
function get_column($table) {
	$r = array();
	$CI = &get_instance();
	$q = $CI->db->query('SHOW COLUMNS FROM ' . $table)->result_array();
	foreach ($q as $key => $value) {
		$r[$value['Field']] = "";
	}
	return $r;
}
function get_latlng($address) {
	$address = str_replace(" ", "+", $address);
	$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . $address . "&sensor=false&key=" . GOOGLE_API_KEY);
	$json = json_decode($json);
	$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	return array('lat' => $lat, 'lng' => $long);
}
if (!function_exists('replaceEmptyString')) {
	function replaceEmptyString($str = '', $replaceStr = 'N/A') {
		return ($str != '' ? $str : $replaceStr);
	}
        if (!function_exists('pre')) {

	function pre($arg) {
		echo "<pre>";
		print_r($arg);
		echo "</pre>";
		die();
	}

}
}