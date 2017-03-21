<?php
/*
|--------------------------------------------------------------------------
| Genreral settings functionality
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/Settings');

	}
	public function index() {
		if ($this->data['action'] == 'submit_settings') {
			$_FILES = isset($_FILES) && !empty($_FILES) ? $_FILES : array();
			$status = $this->Settings->submitSettings($this->input->post(), $_FILES);
			if ($status == 1) {
				$msgType = disMessage(array("type" => "Success", "var" => $this->data['language']['succ_rec_updated']));
				$this->session->set_userdata("msgType", $msgType);
				redirect(base_url() . ADM_URL . "setting");
			}
		}
		$this->data['headTitle'] = "Site Settings";
		$this->data['module'] = "setting";
		$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "general settings" => "", $this->data['headTitle'] => ""));

		$this->data['getFields'] = $this->Settings->getFields();
		$this->load->view('admin/mainpage', $this->data);
	}
}
