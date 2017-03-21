<?php

class Front_Controller_without_login extends CI_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
                if(isset($_SESSION['USERLOGIN'])!=''){
                    $this->viewData['is_login'] = 'Yes';
                }else{
                    $this->viewData['is_login'] = 'No';
                 }
		
		$this->viewData['header_panel'] = true;
		$this->viewData['footer_panel'] = true;
		$this->viewData['error_type'] = "";
		$this->viewData['error_message'] = "";
		$this->viewData['action'] = $this->input->post('action');
		$this->viewData['method'] = $this->router->fetch_method();
		$this->viewData['class'] = $this->router->fetch_class();
		$this->viewData['msgType'] = $this->session->userdata('msgType');
		$this->lang->load('message_lang', 'english');
		$this->viewData['language'] = $this->lang->language;
               
		

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
        function saveFile($tag_name = 'userfile', $path = SITE_UPD, $config = array()) {
     
		$content = array('file_name' => "", 'errors' => "");
		if (isset($_FILES[$tag_name]['name']) && $_FILES[$tag_name]['name'] != "") {
                   
			$this->load->library('upload');
			$this->load->library('image_lib');
			$path = FCPATH . $path;
			if (!file_exists($path)) {
				@mkdir($path);
			} 
			$file_config = array();
			$file_config['upload_path'] = $path;
			$file_config['allowed_types'] = 'jpg|png|jpeg';
			$file_config['overwrite'] = TRUE;
			$file_config['max_size'] = '2048';
			$file_config['file_name'] = md5(time() . rand());
			$file_config = array_replace($file_config, $config);

			$this->upload->initialize($file_config);

			if ($this->upload->do_upload($tag_name)) {
				$upload_data = $this->upload->data();
				$content['file_name'] = $upload_data['file_name'];

			} else {
				$content['errors'] = strip_tags($this->upload->display_errors());
			}
		}
		return $content;

}
}
