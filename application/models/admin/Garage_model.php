<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Garage_model extends MY_Model {

	public $_table = 'tbl_garage';
	public $_fields = "*";
	public $_where = array();
	public $_whereField = "";
	public $_whereFieldVal = "";
	public $_except_fields = array();

	public function __construct() {
		parent::__construct();
	}

	//garage management starts
	function getGarage($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('eDelete !=' => '1');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['vGarageName'] = $search;
		}
		$this->db->select('iGarageId,vGarageName,vGarageType,vZipCode,IF(eStatus="Active","checked","") as status')
			->from('tbl_garage')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vGarageName', $search)
				->or_like('vZipCode', $search)
				->or_like('vGarageType', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selGarage = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iGarageId')
			->get()->result_array();

		$this->db->select('COUNT(iGarageId) AS total')
			->from('tbl_garage')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vGarageName', $search)
				->or_like('vZipCode', $search)
				->or_like('vGarageType', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selGarage as $i => $garage) {
			$params['id'] = $garage['iGarageId'];
			if($garage['vGarageType'] == '1')
				$garage['vGarageType'] = 'Body Repair Shop';
			else if($garage['vGarageType'] == '2')
				$garage['vGarageType'] = 'Auto Repair Shop';
			else if($garage['vGarageType'] == '3')
				$garage['vGarageType'] = 'Both';
			else
				$garage['vGarageType'] = 'NA';

			$params['checked'] = $garage['status'];
			$params['table'] = 'tbl_garage';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params);
			$result['data'][] = array('checkbox' => $checkbox, 'iGarageId' => ($offset + $i + 1),'vGarageName'=>$garage['vGarageName'],'vGarageType'=>$garage['vGarageType'],'vZipCode'=>$garage['vZipCode'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function submit_garage($post = array(),$files=array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iGarageId = isset($post['iGarageId']) ? (int) $post['iGarageId'] : 0;
		$dataArray = array('vGarageName'=>$post['vGarageName'],'vGarageType'=>$post['vGarageType'],'iCountryId'=>$post['iCountryId'],'iStateId'=>$post['iStateId'],'iCityId'=>$post['iCityId'],'vAddress'=>$post['vAddress'],'vZipCode'=>$post['vZipCode'],'vMobile'=>$post['vMobile'],'vOffice_mobile'=>$post['vOffice_mobile'],'tDescription'=>$post['tDescription'],'iTotalMechanic'=>$post['iTotalMechanic'],'vCouponDiscount'=>$post['vCouponDiscount'],'vAmountForCoupon'=>$post['vAmountForCoupon']);

		if ($iGarageId > 0) {
			$this->db->update('tbl_garage', $dataArray, array('iGarageId' => $iGarageId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['dCreatedDate'] = get_date();
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('tbl_garage', $dataArray);
			$iGarageId = $this->db->insert_id();
			if ($iGarageId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		if ($iGarageId > 0) {
			if (!empty($files) && $files['vCoverImage']['name'] != '') {
				$query = $this->db->query("SELECT vCoverImage FROM tbl_garage WHERE iGarageId = ? LIMIT 1", array($iGarageId));
				if ($query->num_rows() === 1) {
					$result = $query->row_array();
					$file = FCPATH . $result['vCoverImage'];
					if ($result['vCoverImage'] != '') {
						unlink_file($file);
					}
				}
				$this->load->library('upload');
				$this->load->library('image_lib');
				$file_config = array();
				$path = FCPATH . GARAGE_UPLOAD_URL . $iGarageId;
				if (!file_exists($path)) {
					@mkdir($path);
				}
				$file_config['upload_path'] = $path;
				$file_config['allowed_types'] = 'jpeg|jpg|png';
				$file_config['overwrite'] = TRUE;
				$file_config['max_size'] = '204800';
				$file_config['file_name'] = md5(time() . rand());
				$this->upload->initialize($file_config);
				if ($this->upload->do_upload('vCoverImage')) {
					$upload_data = $this->upload->data();
					$dataArray['vCoverImage'] = GARAGE_UPLOAD_URL. $iGarageId . '/' . $upload_data['file_name'];
					$this->db->update('tbl_garage', $dataArray, array('iGarageId' => $iGarageId));
				} else {
					$content['status'] = 412;
					$content['message'] = $this->upload->display_errors();
				}
			}
		}
		return $content;
	}
	//garage management ends
}
