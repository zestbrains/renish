<?php
/*
|--------------------------------------------------------------------------
| Login,forgot/reset password and logout functionality
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Admin_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		if ($this->data['action'] == 'submit_login') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('vEmail', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('vPassword', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				//$content['message'] = $this->form_validation->error_array();
				$content['message'] = validation_errors();
			} else {
				$postData['vEmail'] = $this->input->post('vEmail', TRUE);
				$postData['vPassword'] = $this->input->post('vPassword', TRUE);
				$postData['isremember'] = $this->input->post('isremember') == 1 ? 1 : 0;
				$check = $this->Admin->checkAdminLogin($postData);
				if ($check['status'] == 200) {
					$content = $check;
				} else {
					$content['message'] = $check['message'];
				}
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_forgot') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];

			$this->form_validation->set_rules('vEmail', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE) {
				//$content['message'] = $this->form_validation->error_array();
				$content['message'] = validation_errors();
			} else {
				$postData['vEmail'] = $this->input->post('vEmail', TRUE);
				$check = $this->Admin->forgotPassword($postData);
				if ($check['status'] == 200) {
					$content = $check;
				} else {
					$content['message'] = $check['message'];
				}
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['email'] = $this->input->cookie('handy_user_email', true);
			$this->data['password'] = $this->input->cookie('handy_user_password', true) != "" ? base64_decode($this->input->cookie('handy_user_password', true)) : "";
			$this->data['isremember'] = $this->input->cookie('handy_user_isremember', true) == 1 ? 'checked' : '';
		}
		$this->data['headTitle'] = "Login";
		$this->data['module'] = "login";
		$this->data['header_panel'] = false;
		$this->data['footer_panel'] = false;
		$this->data['left_panel'] = false;
		$this->load->view('admin/mainpage', $this->data);
	}

	public function reset($token = "") {
		if ($this->data['action'] == 'submit_reset') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];

			$this->form_validation->set_rules('npassword', 'New Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->data['mstType'] = $this->form_validation->error_array();
			} else {
				$postData['vToken'] = $this->input->post('vToken');
				$check = $this->Admin->resetPass($this->input->post());
				if ($check['status'] == 200) {
					$msgType = disMessage(array("type" => "Success", "var" => $check['message']));
					$this->session->set_userdata("msgType", $msgType);
					redirect(base_url() . ADM_URL . "login");
				} else {
					$this->data['msgType'] = disMessage(array("type" => "Error", "var" => $check['message']));
				}
			}

		} else {
			$token = isset($token) ? $token : "";
			$check = $this->Admin->checkResetToken($token);
			if ($check['status'] != 200) {
				$msgType = disMessage(array("type" => "Error", "var" => $this->data['language']['err_invalid_token']));
				$this->session->set_userdata("msgType", $msgType);
				redirect(base_url() . ADM_URL . "login");
			}
		}
		$this->data['token'] = $token;
		$this->data['headTitle'] = "Reset Password";
		$this->data['module'] = "login";
		$this->data['header_panel'] = false;
		$this->data['footer_panel'] = false;
		$this->data['left_panel'] = false;
		$this->load->view('admin/mainpage', $this->data);
	}

	public function logout() {
		$this->session->unset_userdata('ADMINID');
		$this->session->unset_userdata('ADMINUSERTYPE');
		redirect(base_url() . 'admin/login');
	}

}
