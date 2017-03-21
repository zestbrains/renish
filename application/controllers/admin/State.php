<?php
/*
|--------------------------------------------------------------------------
| State manipulations like
|	listing,
|	add,
|	edit,
|	delete,
|	view and
|   activate/deactivate
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class State extends Admin_Controller {
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
			$this->data['state'] = $this->region->getSingleRecordById($this->input->post('id'), 'mst_state', 'iStateId');
			if (count($this->data['state']) === 0) {
				$this->data['state'] = get_column('mst_state');
			}
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " State";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "State List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_state', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_state') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('iCountryId', 'Country Name', 'trim|required');
			$this->form_validation->set_rules('vState', 'State', 'trim|required|callback_unique_state');
			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->region->submit_state($this->input->post());
				if ($check['status'] == 200) {
					$content = $check;
				}
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'check_state') {
			echo $this->region->checkState();
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
				$check = $this->region->deleteSingle($this->input->post('id'), 'mst_state', 'iStateId');
			} else {
				$check = $this->region->deleteMultiple($this->input->post('ids'), 'mst_state', 'iStateId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage State";
			$this->data['module'] = "list_state";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage State" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}
	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->region->getState($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

	public function getState() {
		$states = $this->Admin->get_States($this->input->post('id'));
		$states = json_decode(json_encode($states), True);
		echo json_encode($states);
		exit;
	}

}
