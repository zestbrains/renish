<?php
/*
|--------------------------------------------------------------------------
| User manipulations like listing,add,edit,delete,view
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
		$this->load->model('admin/User_model', 'user');
	}

	function index() {
		$type = $this->input->post('type');
		$id = (int) $this->input->post('id');

		if ($type == "form") {
			$content = array();
			$content['status'] = 200;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->data['user'] = $this->user->getSingleRecordById($this->input->post('id'), 'tbl_user', 'iUserId');
			if (count($this->data['user']) === 0) {
				$this->data['user'] = get_column('tbl_user');
			}
			$this->data['user']['vProfileImage'] = checkImage(1, $this->data['user']['vProfileImage']);
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " User";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Users List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_user', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_user') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$postData['iUserId'] = $this->input->post('iUserId');

			$this->form_validation->set_rules('vName', 'Name', 'trim|required');
			$this->form_validation->set_rules('eUserRole', 'Role', 'required');
			$this->form_validation->set_rules('vCity', 'City', 'trim|required');
			$this->form_validation->set_rules('vPinCode', 'Pincode', 'trim|required|numeric');
			if ($postData['iUserId'] <= 0) {
				$this->form_validation->set_rules('vEmail', 'Email address', 'trim|required|valid_email|callback_unique_email');
				$this->form_validation->set_rules('vPassword', 'Password', 'trim|required');
			}
			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$content = $this->user->submit_user($this->input->post(), $_FILES);
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'check_email') {
			echo $this->user->checkEmail();
			die();
		} else if ($type == 'view') {
			$content = array();
			$content['status'] = 200;
			$this->data['headTitle'] = "User Details";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "User List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$this->data['user'] = $this->user->getSingleRecordById($this->input->post('id'), 'tbl_user', 'iUserId');
			$this->data['user']['vProfileImage'] = checkImage(2, $this->data['user']['vProfileImage']);
			$content['html'] = $this->load->view('admin/view_user', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'change_status') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$post = $this->input->post();
			$post['value'] = ($post['value'] == 'y') ? 'Active' : 'InActive';
			$check = $this->user->changeStatus($post);
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;

		} else if ($this->data['action'] == "delete" || $this->data['action'] == "delete_all") {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			if ($this->data['action'] == "delete") {
				$check = $this->user->deleteSingle($this->input->post('id'), 'tbl_user', 'iUserId');
			} else {
				$check = $this->user->deleteMultiple($this->input->post('ids'), 'tbl_user', 'iUserId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage Web-Users";
			$this->data['module'] = "list_webusers";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Web-Users" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}

	}

	public function lists($eUserRole = 'user') {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->user->getUsersAll($filters, $eUserRole);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

	public function adminUser() {
		if ($this->session->userdata('ADMINUSERTYPE') != 'super_admin') {
			$msgType = disMessage(array("type" => "Error", "var" => $this->data['language']['err_not_auth']));
			$this->session->set_userdata("msgType", $msgType);
			redirect(base_url(ADM_URL));
		} else {
			$this->data['headTitle'] = "Manage Admin-Users";
			$this->data['module'] = "list_admin_users";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Admin-Users" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}
}
