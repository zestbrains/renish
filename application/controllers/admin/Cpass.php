<?php
/*
|--------------------------------------------------------------------------
| Change password functionality
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpass extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/Settings');

	}
	public function index() {
		if ($this->data['action'] == 'submit_cpass') {
			$opassword = $this->input->post('opassword');
			$npassword = $this->input->post('npassword');
			$cpassword = $this->input->post('cpassword');
			$passvalue = $this->input->post('passvalue');

			$check = $this->Settings->changePass($opassword, $npassword, $cpassword);

			if ($check === TRUE) {
				$msgType = disMessage(array("type" => "Success", "var" => $this->data['language']['succ_pass_changed']));
				$this->session->set_userdata("msgType", $msgType);
				redirect(base_url() . ADM_URL . "cpass");
			} else if ($check === FALSE) {
				$this->data['passvalue'] = set_value('passvalue');
				$this->load->view('admin/mainpage', $this->data);
			} else {
				$this->data['msgType'] = disMessage(array("type" => "Error", "var" => $check));
				$this->data['passvalue'] = $passvalue;
				$this->load->view('admin/mainpage', $this->data);
			}
		}
		$this->data['headTitle'] = "Change Password";
		$this->data['module'] = "cpass";
		$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "general settings" => "", $this->data['headTitle'] => ""));
		$this->data['passvalue'] = $this->Settings->passValue();
		$this->load->view('admin/mainpage', $this->data);
	}
}
