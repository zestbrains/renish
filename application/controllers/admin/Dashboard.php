<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->data['counts'] = $this->Admin->siteCount();
		$this->data['headTitle'] = "Admin Panel";
		$this->data['module'] = "dashboard";
		$this->load->view('admin/mainpage', $this->data);
	}

}
