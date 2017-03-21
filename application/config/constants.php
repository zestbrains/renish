<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



define('_PATH', substr(dirname(__FILE__), 0, -19));
define('_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(_PATH))));

define('SITE_PATH', _PATH . "/");
define('SITE_URL', _URL . "/");

define('DOMAIN_URL', 'http://' . $_SERVER['HTTP_HOST'].'/renish');
//user defined constant
//Front End

define('ASSETS_URL',DOMAIN_URL.'/assets/files');
define('IMAGES_URL',DOMAIN_URL.'/assets/images');

define('USER_DP_URL','/assets/profile_pic/');
define('USER_UPLOAD_URL','assets/profile_pic/');

define('GARAGE_UPLOAD_URL','assets/garage/');
//end
define('SITE_UPD', 'themes/uploads/');
define('SITE_CSS', 'themes/front/css/');
define('SITE_JS', 'themes/front/js/');
define('SITE_IMG', 'themes/front/images/');
define('SITE_VIDEO', 'themes/front/video/');

define("ADMIN_USER_TYPE", serialize(array('super_admin','admin','user')));
define('ACTIVE_STATUS', 'Active');
define('INACTIVE_STATUS', 'InActive');
define('PROFILE_DP', 'dummy.png');
define('BANNER_IMAGE_URL',DOMAIN_URL.'/assets/garage/1/6a6ed65ecd196863265b7b1d39f059a7.jpg');

define('ADM_URL', 'admin/');
define('ADM_CSS', 'themes/admin/css/');
define('ADM_JS', 'themes/admin/scripts/');
define('ADM_FONTS', 'themes/admin/fonts/');
define('ADM_IMG', 'themes/admin/img/');
define('ADM_PLUGINS', 'themes/admin/plugins/');

define('MEND_SIGN', '<span class="text-danger">*</span>');
define('PAGING_LIMIT', 10);
define('CUSTOM_SEPARATOR', '{{##}}');

/*--important constant ---- */
define('AUTO_SHOP', 'auto');
define('BODY_SHOP', 'body');
define('LIMIT', 8);
define('OFFSET', 8);
define('PAYMENT_COMEPLTED_STATUS', 'Completed');
define('PAYMENT_TYPE_WALLET', 'wallet');
define('PAYMENT_TYPE_PAYPAL', 'paypal');
define('PAYMENT_FOR_COUPON', 'coupon');
define('PAYMENT_FOR_BANNER', 'banner');
define('SPECIAL_SHOP_LEVEL_LIMIT_DISCOUNT', 10);

/*-- default countryID --- */
define('DEFAULT_COUNTRY',254);

/*------ Registration Heading constant ---- */
 //shop heading
define('SHOP_HEADING', 'Register Your Shop Here');
define('SHOP_SEMI_HEADING', 'Win business by giving discount and earning great reviews.');
 //Vehicle heading
define('VEHICLE_HEADING', 'Register Here');
define('VEHICLE_SEMI_HEADING', 'Get discount and give reviews.');

//user type
define('SHOP_OWNER', 'shop_owner');
define('VEHICLE_OWNER', 'user');

//days for comment edit
define('COMMENT_EDIT_DAY', 15);




/*----database tables ----- */
define('TBL_USERS', 'tbl_user');
define('TBL_COUNTRY', 'mst_country');
define('TBL_STATE', 'mst_state');
define('TBL_CITY', 'mst_city');
define('TBL_DISCOUNTS', 'tbl_discount');
define('TBL_GARAGE', 'tbl_garage');
define('TBL_GARAGE_IMAGE', 'tbl_garage_image');
define('TBL_GARAGE_COMMENTS', 'tbl_garage_comment');
define('TBL_PAYMENT', 'payments');
define('TBL_BANNER_PURCHASE', 'tbl_banner_purchase');



