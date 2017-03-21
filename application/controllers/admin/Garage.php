<?php
/*
|--------------------------------------------------------------------------
|  garege manipulations like
|	listing,
|	edit,
|	delete,
|	view and
|   activate/deactivate
|--------------------------------------------------------------------------
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Garage extends Admin_Controller {
	public $data = array();
	function __construct() {
		parent::__construct();
		$this->load->model('admin/Garage_model', 'garage');
	}
	function index() {
		$type = $this->input->post('type');
		$id = (int) $this->input->post('id');

		if ($type == "form") {
			$content = array();
			$content['status'] = 200;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->data['discounts'] = $this->Admin->get_Discount();
			$this->data['countries'] = $this->Admin->get_Country();
			$this->data['garage'] = $this->garage->getSingleRecordById($this->input->post('id'), 'tbl_garage', 'iGarageId');
			if (count($this->data['garage']) === 0) {
				$this->data['garage'] = get_column('tbl_garage');
			}
			$this->data['garage']['vCoverImage'] = checkImage(3, $this->data['garage']['vCoverImage']);
			$this->data['headTitle'] = ($id > 0 ? 'Edit' : 'Add New') . " Garage";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Garage List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$content['html'] = $this->load->view('admin/form_garage', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == 'submit_garage') {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			$this->form_validation->set_rules('vGarageName', 'Garage Name', 'trim|required');
			$this->form_validation->set_rules('vGarageType', 'Garege Type', 'trim|required');
			$this->form_validation->set_rules('iCountryId', 'Country Name', 'trim|required');
			$this->form_validation->set_rules('iStateId', 'State Name', 'trim|required');
			$this->form_validation->set_rules('iCityId', 'City Name', 'trim|required');
			$this->form_validation->set_rules('vZipCode', 'Zipcode', 'trim|required|max_length[10]');
			$this->form_validation->set_rules('vMobile', 'Mobile No', 'trim|required|numeric|min_length[10]|max_length[15]');
			$this->form_validation->set_rules('vOffice_mobile', 'Office Mobile', 'trim|numeric|min_length[10]|max_length[15]');
			$this->form_validation->set_rules('iTotalMechanic', 'Total Mechanic', 'trim|required');
			$this->form_validation->set_rules('vCouponDiscount', 'Coupon Discount', 'trim|required');
			$this->form_validation->set_rules('vAmountForCoupon', 'Coupon Amount', 'trim|required|numeric');

			if ($this->form_validation->run() == FALSE) {
				$content['message'] = validation_errors();
			} else {
				$check = $this->garage->submit_garage($this->input->post(),$_FILES);
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
			$check = $this->garage->changeStatus($post);
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;

		} else if ($type == 'view') {
			$content = array();
			$content['status'] = 200;
			$this->data['headTitle'] = "Garage Details";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Garage List" => "javascript:back_portlet();", $this->data['headTitle'] => ""));
			$this->data['garage'] = $this->garage->getSingleRecordById($this->input->post('id'), 'tbl_garage', 'iGarageId');
			$this->data['garage']['vCoverImage'] = checkImage(4, $this->data['garage']['vCoverImage']);
			$content['html'] = $this->load->view('admin/view_garage', $this->data, true);
			echo json_encode($content);
			exit;
		} else if ($this->data['action'] == "delete" || $this->data['action'] == "delete_all") {
			$content = array();
			$content['status'] = 404;
			$content['message'] = $this->data['language']['err_something_went_wrong'];
			if ($this->data['action'] == "delete") {
				$check = $this->garage->deleteSingle($this->input->post('id'), 'tbl_garage', 'iGarageId');
			} else {
				$check = $this->garage->deleteMultiple($this->input->post('ids'), 'tbl_garage', 'iGarageId');
			}
			if ($check['status'] == 200) {
				$content = $check;
			}
			echo json_encode($content);
			exit;
		} else {
			$this->data['headTitle'] = "Manage Garage";
			$this->data['module'] = "list_garage";
			$this->data['bradcrumb'] = breadcrumb(array("home" => base_url() . ADM_URL, "Manage Garage" => "", $this->data['headTitle'] => ""));
			$this->load->view('admin/mainpage', $this->data);
		}
	}

	public function lists() {
		if ($this->input->is_ajax_request()) {
			$filters = $this->getDTFilters($this->input->get());
			$result = $this->garage->getGarage($filters);
			echo json_encode($result);
		} else {
			base_url(ADM_URL);
		}
	}

}
