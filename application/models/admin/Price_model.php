<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Price_model extends MY_Model {

	public $_table = 'tbl_discount';
	public $_fields = "*";
	public $_where = array();
	public $_whereField = "";
	public $_whereFieldVal = "";
	public $_except_fields = array();

	public function __construct() {
		parent::__construct();
	}

	//discount management starts
	function getDiscount($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('eDelete !=' => '1');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['iPercentage'] = $search;
		}
		$this->db->select('iDiscountId,iPercentage,vCoupenPrice,iRefund,IF(eStatus="Active","checked","") as status')
			->from('tbl_discount')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('iPercentage', $search)
				->or_like('vCoupenPrice', $search)
				->or_like('iRefund', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selDiscount = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iDiscountId')
			->get()->result_array();

		$this->db->select('COUNT(iDiscountId) AS total')
			->from('tbl_discount')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('iPercentage', $search)
				->or_like('vCoupenPrice', $search)
				->or_like('iRefund', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selDiscount as $i => $discount) {
			$params['id'] = $discount['iDiscountId'];
			$params['checked'] = $discount['status'];
			$params['table'] = 'tbl_discount';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			if($discount['iPercentage']==0){
				$action ='';
			}else{
				$action = $this->generate_actions($params, true, false);
			}
			$result['data'][] = array('checkbox' => $checkbox, 'iDiscountId' => ($offset + $i + 1), 'iPercentage' => $discount['iPercentage'], 'vCoupenPrice' => $discount['vCoupenPrice'], 'iRefund' => $discount['iRefund'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function submit_discount($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iDiscountId = isset($post['iDiscountId']) ? (int) $post['iDiscountId'] : 0;
		$dataArray = array('iPercentage' => $post['iPercentage'], 'vCoupenPrice' => $post['vCoupenPrice'], 'iRefund' => $post['iRefund'],'dExpiryDate'=>$post['dExpiryDate']);

		if ($iDiscountId > 0) {
			$this->db->update('tbl_discount', $dataArray, array('iDiscountId' => $iDiscountId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['dCreatedDate'] = get_date();
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('tbl_discount', $dataArray);
			$iDiscountId = $this->db->insert_id();
			if ($iDiscountId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
	//discount management ends

	//banner management start
	function getBanner($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('eDelete !=' => '1');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['iAmount'] = $search;
		}
		$this->db->select('iBannerId,iAmount,vBannerSize,IF(eStatus="Active","checked","") as status')
			->from('tbl_banner_purchase')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('iAmount', $search)
				->or_like('vBannerSize', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selBanner = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iBannerId')
			->get()->result_array();

		$this->db->select('COUNT(iBannerId) AS total')
			->from('tbl_banner_purchase')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('iAmount', $search)
				->or_like('vBannerSize', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selBanner as $i => $banner) {
			$params['id'] = $banner['iBannerId'];
			$params['checked'] = $banner['status'];
			$params['table'] = 'tbl_banner_purchase';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params, true, false);
			$result['data'][] = array('checkbox' => $checkbox, 'iBannerId' => ($offset + $i + 1), 'iAmount' => $banner['iAmount'], 'vBannerSize' => $banner['vBannerSize'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function submit_banner($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iBannerId = isset($post['iBannerId']) ? (int) $post['iBannerId'] : 0;
		$dataArray = array('iAmount' => $post['iAmount'], 'vBannerSize' => $post['vBannerSize']);

		if ($iBannerId > 0) {
			$this->db->update('tbl_banner_purchase', $dataArray, array('iBannerId' => $iBannerId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['dCreatedDate'] = get_date();
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('tbl_banner_purchase', $dataArray);
			$iBannerId = $this->db->insert_id();
			if ($iBannerId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
	//banner management ends
}
