<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Content extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
		$this->load->model('admin/Content_model', 'content');
	}

	function index() {
		$type = $this->input->post('type');
		$id = (int) $this->input->post('id');

		if ($type == "form") {
			$content = array();
			$content['status'] = 200;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->data['content'] = $this->content->getSingleRecordById($this->input->post('id'), 'mst_content', 'iContentId');
			if (count($this->data['content']) === 0) {
				$this->data['content'] = get_column('mst_content');
			}
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " Content";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Content List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_content', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_content') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('vTitle', 'Title', 'trim|required');
			$this->form_validation->set_rules('vContent', 'Content', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->content->submit_content($this->input->post());
				if ($check['status'] == 200) {
					$content = $check;
				}
			}
			echo json_encode($content);
			exit;
		} else if ($type == 'view') {
			$content = array();
			$content['status'] = 200;
			$this->data['headTitle'] = "Content Details";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Content List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$this->data['service'] = $this->service->getSingleRecordById($this->input->post('id'), 'mst_content', 'iContentId');
			$content['html'] = $this->load->view('admin/view_content', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'change_status') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$post = $this->input->post();
			$post['value'] = ($post['value'] == 'y') ? 'Active' : 'InActive';
			$check = $this->content->changeStatus($post);
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
				$check = $this->content->deleteSingle($this->input->post('id'), 'mst_content', 'iContentId');
			} else {
				$check = $this->content->deleteMultiple($this->input->post('ids'), 'mst_content', 'iContentId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}

			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage Content";
			$this->data['module'] = "list_content";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Content" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}

	}

	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->content->getContent($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

}
