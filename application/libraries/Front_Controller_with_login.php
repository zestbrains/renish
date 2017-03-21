<?php
class Front_Controller_with_login extends CI_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();

		$this->viewData['is_login'] = 'Yes';
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
                $this->chk_admin_session();
               
		

	}
        function chk_admin_session() {

		$sessionDetails = $this->session->userdata;
		$session_login = isset($sessionDetails['USERID']) ? (int) $sessionDetails['USERID'] : 0;
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

	 protected function date_after_days($days){  
            $days='+'.$days.' days';
            $newDate= date('Y-m-d', strtotime($days));
            return date('d M Y', strtotime($newDate));
      
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
