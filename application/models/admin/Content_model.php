<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Content_model extends MY_Model {

	public $_table = 'mst_content';
	public $_fields = "*";
	public $_where = array();
	public $_whereField = "";
	public $_whereFieldVal = "";
	public $_except_fields = array();

	public function __construct() {
		parent::__construct();
	}

	function getContent($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('eStatus !=' => 'Delete');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['vTitle'] = $search;
		}

		$this->db->select('iContentId, vSysFlag,vTitle,IF(eStatus="Active","checked","") as status')
			->from('mst_content')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vSysFlag', $search)
				->or_like('vTitle', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selContent = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iContentId')
			->get()->result_array();

		$this->db->select('COUNT(iContentId) AS total')
			->from('mst_content')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vSysFlag', $search)
				->or_like('vTitle', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selContent as $i => $content) {
			$params['id'] = $content['iContentId'];
			$params['checked'] = $content['status'];
			$params['table'] = 'mst_content';
			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params);
			$result['data'][] = array('checkbox' => $checkbox, 'iContentId' => ($offset + $i + 1), 'vSysFlag' => $content['vSysFlag'], 'vTitle' => $content['vTitle'], 'status' => $switch, 'action' => $action);
		}

		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function submit_content($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iContentId = isset($post['iContentId']) ? (int) $post['iContentId'] : 0;
		$dataArray = array('vTitle' => $post['vTitle'], 'vContent' => $post['vContent']);

		if ($iContentId > 0) {
			$this->db->update('mst_content', $dataArray, array('iContentId' => $iContentId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('mst_content', $dataArray);
			$iContentId = $this->db->insert_id();
			if ($iContentId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
}
