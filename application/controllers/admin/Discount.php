<?php
/*
|--------------------------------------------------------------------------
|  Discount manipulations like
|	listing,
|	add,
|	edit,
|	delete,
|	view and
|   activate/deactivate
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
		$this->load->model('admin/Price_model', 'price');
	}
	function index() {
		$type = $this->input->post('type');
		$id = (int) $this->input->post('id');

		if ($type == "form") {
			$content = array();
			$content['status'] = 200;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->data['discount'] = $this->price->getSingleRecordById($this->input->post('id'), 'tbl_discount', 'iDiscountId');
			if (count($this->data['discount']) === 0) {
				$this->data['discount'] = get_column('tbl_discount');
			}
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " Discount";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Discount List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_discount', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_discount') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('iPercentage', 'Percentage', 'trim|required|numeric|greater_than[0]|less_than[100]');
			$this->form_validation->set_rules('vCoupenPrice', 'Coupen Price', 'trim|required|numeric');
			$this->form_validation->set_rules('iRefund', 'Refund', 'trim|required|numeric');
			$this->form_validation->set_rules('dExpiryDate', 'Expiry Date', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->price->submit_discount($this->input->post());
				if ($check['status'] == 200) {
					$content = $check;
				}
			}
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'change_status') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$post = $this->input->post();
			$post['value'] = ($post['value'] == 'y') ? 'Active' : 'InActive';
			$check = $this->price->changeStatus($post);
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
				$check = $this->price->deleteSingle($this->input->post('id'), 'tbl_discount', 'iDiscountId');
			} else {
				$check = $this->price->deleteMultiple($this->input->post('ids'), 'tbl_discount', 'iDiscountId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage Discount";
			$this->data['module'] = "list_discount";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Discount" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}

	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->price->getDiscount($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

}
