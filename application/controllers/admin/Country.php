<?php
/*
|--------------------------------------------------------------------------
| Country manipulations like
|	listing,
|	add,
|	edit,
|	delete,
|	view and
|   activate/deactivate
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Country extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
		$this->load->model('admin/Region_model', 'region');
	}
	function index() {
		$type = $this->input->post('type');
		$id = (int) $this->input->post('id');

		if ($type == "form") {
			$content = array();
			$content['status'] = 200;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->data['country'] = $this->region->getSingleRecordById($this->input->post('id'), 'mst_country', 'iCountryId');
			if (count($this->data['country']) === 0) {
				$this->data['country'] = get_column('mst_country');
			}
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " Country";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Country List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_country', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_country') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('vCountry', 'Country Name', 'trim|required|callback_unique_country');
			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->region->submit_region($this->input->post());
				if ($check['status'] == 200) {
					$content = $check;
				}
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'check_country') {
			echo $this->region->checkCountry();
			die();
		} else if ($this->data['action'] == 'change_status') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$post = $this->input->post();
			$post['value'] = ($post['value'] == 'y') ? 'Active' : 'InActive';
			$check = $this->region->changeStatus($post);
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
				$check = $this->region->deleteSingle($this->input->post('id'), 'mst_country', 'iCountryId');
			} else {
				$check = $this->region->deleteMultiple($this->input->post('ids'), 'mst_country', 'iCountryId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage Country";
			$this->data['module'] = "list_country";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Country" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}
	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->region->getCountry($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

}
