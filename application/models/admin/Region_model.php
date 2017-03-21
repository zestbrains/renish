<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Region_model extends MY_Model {

	public $_table = 'mst_country';
	public $_fields = "*";
	public $_where = array();
	public $_whereField = "";
	public $_whereFieldVal = "";
	public $_except_fields = array();

	public function __construct() {
		parent::__construct();
	}

	//country management starts
	function getCountry($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('eDelete' => '0');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['vCountry'] = $search;
		}
		$this->db->select('iCountryId,vCountry,IF(eStatus="Active","checked","") as status')->from('mst_country')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selRegion = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iCountryId')
			->get()->result_array();

		$this->db->select('COUNT(iCountryId) AS total')
			->from('mst_country')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selRegion as $i => $region) {
			$params['id'] = $region['iCountryId'];
			$params['checked'] = $region['status'];
			$params['table'] = 'mst_country';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params, true, false);
			$result['data'][] = array('checkbox' => $checkbox, 'iCountryId' => ($offset + $i + 1), 'vCountry' => $region['vCountry'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function checkCountry() {
		$iCountryId = (int) $this->input->post('iCountryId');
		$vName = $this->input->post('vCountry');

		if ((int) $iCountryId) {
			$check = $this->db->get_where('mst_country', array('vCountry' => $vName, 'iCountryId !=' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}

		} else {
			$check = $this->db->get_where('mst_country', array('vCountry' => $vName, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}
		}
	}

	function submit_country($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iCountryId = isset($post['iCountryId']) ? (int) $post['iCountryId'] : 0;
		$dataArray = array('vCountry' => $post['vCountry']);

		if ($iCountryId > 0) {
			$this->db->update('mst_country', $dataArray, array('iCountryId' => $iCountryId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('mst_country', $dataArray);
			$iCountryId = $this->db->insert_id();
			if ($iCountryId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
	//country management ends

	//state management starts
	function getState($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('s.eDelete !=' => '1');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['s.vState'] = $search;
			$likeArr['c.vCountry'] = $search;
		}
		$this->db->select('s.iStateId,s.vState,c.vCountry,IF(s.eStatus="Active","checked","") as status')->from('mst_state as s')->join('mst_country as c', 'c.iCountryId = s.iCountryId', 'inner')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('s.vState', $search)
				->or_like('c.vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selState = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('s.iStateId')
			->get()->result_array();

		$this->db->select('COUNT(s.iStateId) AS total')
			->from('mst_state as s')
			->join('mst_country as c', 'c.iCountryId = s.iCountryId', 'inner')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('s.vState', $search)
				->or_like('c.vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selState as $i => $state) {
			$params['id'] = $state['iStateId'];
			$params['checked'] = $state['status'];
			$params['table'] = 'mst_state';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params, true, false);
			$result['data'][] = array('checkbox' => $checkbox, 'iStateId' => ($offset + $i + 1), 'vState' => $state['vState'], 'vCountry' => $state['vCountry'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function checkState() {
		$iStateId = (int) $this->input->post('iStateId');
		$vName = $this->input->post('vState');
		$iCountryId = (int) $this->input->post('iCountryId');

		if ((int) $iStateId) {
			$check = $this->db->get_where('mst_state', array('vState' => $vName, 'iCountryId' => $iCountryId, 'iStateId !=' => $iStateId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}

		} else {
			$check = $this->db->get_where('mst_state', array('vState' => $vName, 'iCountryId' => $iCountryId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}
		}
	}

	function submit_state($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iStateId = isset($post['iStateId']) ? (int) $post['iStateId'] : 0;
		$dataArray = array('vState' => $post['vState'], 'iCountryId' => $post['iCountryId']);

		if ($iStateId > 0) {
			$this->db->update('mst_state', $dataArray, array('iStateId' => $iStateId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('mst_state', $dataArray);
			$iStateId = $this->db->insert_id();
			if ($iStateId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
	//state management ends

	//city management starts
	function getCity($filters = array()) {
		$result = array();
		extract($filters);
		$whrArr = array('ct.eDelete !=' => '1');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['ct.vCity'] = $search;
			$likeArr['s.vState'] = $search;
			$likeArr['c.vCountry'] = $search;
		}
		$this->db->select('ct.iCityId,ct.vCity,s.vState,c.vCountry,IF(ct.eStatus="Active","checked","") as status')->from('mst_city as ct')
			->join('mst_state as s', 's.iStateId = ct.iStateId', 'inner')
			->join('mst_country as c', 'c.iCountryId = ct.iCountryId', 'inner')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('ct.vCity', $search)
				->or_like('s.vState', $search)
				->or_like('c.vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selCity = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('ct.iCityId')
			->get()->result_array();

		$this->db->select('COUNT(ct.iCityId) AS total')
			->from('mst_city as ct')
			->join('mst_state as s', 's.iStateId = ct.iStateId', 'inner')
			->join('mst_country as c', 'c.iCountryId = ct.iCountryId', 'inner')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('ct.vCity', $search)
				->or_like('s.vState', $search)
				->or_like('c.vCountry', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selCity as $i => $city) {
			$params['id'] = $city['iCityId'];
			$params['checked'] = $city['status'];
			$params['table'] = 'mst_city';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params, true, false);
			$result['data'][] = array('checkbox' => $checkbox, 'iCityId' => ($offset + $i + 1), 'vCity' => $city['vCity'], 'vState' => $city['vState'], 'vCountry' => $city['vCountry'], 'status' => $switch, 'action' => $action);
		}
		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function checkCity() {
		$iCityId = (int) $this->input->post('iCityId');
		$vName = $this->input->post('vCity');
		$iCountryId = (int) $this->input->post('iCountryId');
		$iStateId = (int) $this->input->post('iStateId');

		if ((int) $iCityId) {
			$check = $this->db->get_where('mst_city', array('vCity' => $vName, 'iCountryId' => $iCountryId, 'iStateId' => $iStateId, 'iCityId !=' => $iCityId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}

		} else {
			$check = $this->db->get_where('mst_city', array('vCity' => $vName, 'iCountryId' => $iCountryId, 'iStateId' => $iStateId, 'eDelete !=' => '1'))->num_rows();
			if ($check > 0) {
				return 'false';
			} else {
				return 'true';
			}
		}
	}

	function submit_city($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iCityId = isset($post['iCityId']) ? (int) $post['iCityId'] : 0;
		$dataArray = array('vCity' => $post['vCity'], 'iCountryId' => $post['iCountryId'], 'iStateId' => $post['iStateId']);

		if ($iCityId > 0) {
			$this->db->update('mst_city', $dataArray, array('iCityId' => $iCityId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['eStatus'] = 'Active';
			$this->db->insert('mst_city', $dataArray);
			$iCityId = $this->db->insert_id();
			if ($iCityId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		return $content;
	}
	//city management ends
}
