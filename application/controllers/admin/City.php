<?php
/*
|--------------------------------------------------------------------------
| City manipulations like
|	listing,
|	add,
|	edit,
|	delete,
|	view and
|   activate/deactivate
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class City extends Admin_Controller {
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
			$this->data['countries'] = $this->Admin->get_Country();
			$this->data['city'] = $this->region->getSingleRecordById($this->input->post('id'), 'mst_city', 'iCityId');
			if (count($this->data['city']) === 0) {
				$this->data['city'] = get_column('mst_city');
			}
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " City";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "City List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_city', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_city') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('iCountryId', 'Country Name', 'trim|required');
			$this->form_validation->set_rules('iStateId', 'State Name', 'trim|required');
			$this->form_validation->set_rules('vCity', 'City', 'trim|required|callback_unique_city');
			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->region->submit_city($this->input->post());
				if ($check['status'] == 200) {
					$content = $check;
				}
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'check_city') {
			echo $this->region->checkCity();
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
				$check = $this->region->deleteSingle($this->input->post('id'), 'mst_city', 'iCityId');
			} else {
				$check = $this->region->deleteMultiple($this->input->post('ids'), 'mst_city', 'iCityId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage City";
			$this->data['module'] = "list_city";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage City" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}
	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->region->getCity($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

	public function getCity() {
		$city = $this->Admin->get_City($this->input->post('id'));
		$city = json_decode(json_encode($city), True);
		echo json_encode($city);
		exit;
	}
}
