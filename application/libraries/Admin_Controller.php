<?php

class Admin_Controller extends CI_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();

		$this->load->model('admin/Admin');
		$this->Admin->siteSettings();
		$this->data['header_panel'] = true;
		$this->data['footer_panel'] = true;
		$this->data['left_panel'] = true;
		$this->data['error_type'] = "";
		$this->data['error_message'] = "";
		$this->data['action'] = $this->input->post('action');
		$this->data['method'] = $this->router->fetch_method();
		$this->data['class'] = $this->router->fetch_class();
		$this->data['msgType'] = $this->session->userdata('msgType');
		$this->lang->load('message_lang', 'english');
		$this->data['language'] = $this->lang->language;
		$this->chk_admin_session();

	}
	function chk_admin_session() {

		$sessionDetails = $this->session->userdata;
		$session_login = isset($sessionDetails['ADMINID']) ? (int) $sessionDetails['ADMINID'] : 0;
		if ($session_login <= 0) {
			// Allow some methods?
			$allowed = array(
				'login', 'reset',
			);
			if (!in_array($this->uri->segment(2), $allowed)) {
				redirect(base_url() . ADM_URL . "login");
			}
		} else if ($session_login && $session_login == TRUE) {
			$notallowed = array('', 'login');
			if (in_array($this->uri->segment(2), $notallowed)) {
				redirect(base_url() . ADM_URL . "dashboard");
			}
			$this->data['left']['menus'] = $this->Admin->getSections();
			$this->data['counts'] = $this->Admin->siteCount();
		}
	}

	//Listing Filteration
	function getDTFilters($post = array()) {
		$filters = array(
			'offset' => isset($post['start']) ? intval($post['start']) : 0,
			'limit' => isset($post['length']) ? intval($post['length']) : 25,
			'sort' => isset($post['columns'][$post["order"][0]['column']]['data']) ? $post['columns'][$post["order"][0]['column']]['data'] : 'dCreatedDate',
			'order' => isset($post["order"][0]['dir']) ? $post["order"][0]['dir'] : 'DESC',
			'search' => isset($post["search"]['value']) ? $post["search"]['value'] : '',
			'sEcho' => isset($post['sEcho']) ? $post['sEcho'] : 1,
		);
		return $filters;
	}

	public function upload_ck_file() {
		if (isset($_FILES['upload'])) {
			// ------ Process your file upload code -------
			$filen = $_FILES['upload']['tmp_name'];
			$path_parts = pathinfo($_FILES["file"]["name"]);
			$extension = $path_parts['extension'];
			$filename = md5(time() . rand()) . '.' . $extension;
			$con_images = SITE_UPD . 'ckeditor/' . $filename;
			move_uploaded_file($filen, FCPATH . $con_images);
			$url = base_url($con_images);
			/*$url = $con_images;*/

			$funcNum = $_GET['CKEditorFuncNum'];
			// Optional: instance name (might be used to load a specific configuration file or anything else).
			$CKEditor = $_GET['CKEditor'];
			// Optional: might be used to provide localized messages.
			$langCode = $_GET['langCode'];

			// Usually you will only assign something here if the file could not be uploaded.
			$message = '';
			echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
		}
	}

	//Unique Email validation
	public function unique_email() {
		$check = $this->db->get_where('tbl_user', array('vEmail' => $this->input->post('vEmail'), 'eStatus !=' => 'Delete'))->num_rows();
		if ($check > 0) {
			$this->form_validation->set_message("unique_email", "%s already exists");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//Unique Country validation
	public function unique_country() {
		$iCountryId = (int) $this->input->post('iCountryId');
		$vName = $this->input->post('vCountry');

		if ((int) $iCountryId) {
			$check = $this->db->get_where('mst_country', array('vCountry' => $vName, 'iCountryId !=' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_country", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$check = $this->db->get_where('mst_country', array('vCountry' => $vName, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_country", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	//Unique State validation
	public function unique_state() {
		$iStateId = (int) $this->input->post('iStateId');
		$vName = $this->input->post('vState');
		$iCountryId = $this->input->post('iCountryId');

		if ((int) $iStateId) {
			$check = $this->db->get_where('mst_state', array('vState' => $vName, 'iStateId !=' => $iStateId, 'iCountryId' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_state", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$check = $this->db->get_where('mst_state', array('vState' => $vName, 'iCountryId' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_state", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	//Unique City validation
	public function unique_city() {
		$iCityId = (int) $this->input->post('iCityId');
		$vName = $this->input->post('vCity');
		$iCountryId = $this->input->post('iCountryId');
		$iStateId = (int) $this->input->post('iStateId');

		if ((int) $iCityId) {
			$check = $this->db->get_where('mst_city', array('vCity' => $vName, 'iCityId !=' => $iCityId, 'iStateId' => $iStateId, 'iCountryId' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_city", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$check = $this->db->get_where('mst_city', array('vCity' => $vName, 'iStateId' => $iStateId, 'iCountryId' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				$this->form_validation->set_message("unique_city", "%s already exists");
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
}
