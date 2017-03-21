<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends MY_Model {

	public $_table = 'tbl_user';
	public $_fields = "*";
	public $_where = array();
	public $_whereField = "";
	public $_whereFieldVal = "";
	public $_except_fields = array();

	public function __construct() {
		parent::__construct();
	}

	//User management starts
	function getUsersAll($filters = array(), $eUserRole) {
		$result = array();
		extract($filters);
		$whrArr = array('eUserRole' => $eUserRole, 'eDelete' => '0');
		$likeArr = array();
		if (!empty($search)) {
			$likeArr['vName'] = $search;
		}

		$this->db->select('iUserId,vName,vEmail ,vPinCode,IF(eStatus="Active","checked","") as status')
			->from('tbl_user')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vName', $search)
				->or_like('vEmail', $search)
				->or_like('vPinCode', $search)
				->or_like($likeArr)
				->group_end();
		}
		$selUsers = $this->db->limit($limit, $offset)
			->order_by($sort, $order)
			->group_by('iUserId')
			->get()->result_array();

		$this->db->select('COUNT(iUserId) AS total')
			->from('tbl_user')
			->where($whrArr);
		if (!empty($likeArr)) {
			$this->db->group_start()
				->like('vName', $search)
				->or_like('vEmail', $search)
				->or_like('vPinCode', $search)
				->or_like($likeArr)
				->group_end();
		}
		$totalRec = $this->db->get()->row_array();

		$params = array('url' => base_url(ADM_URL . strtolower($this->data['class'])));
		$result['data'] = array();
		foreach ($selUsers as $i => $user) {
			$params['id'] = $user['iUserId'];
			$params['checked'] = $user['status'];
			$params['table'] = 'tbl_user';

			$checkbox = $this->generate_checkbox($params);
			$switch = $this->generate_switch($params);
			$action = $this->generate_actions($params);
			$result['data'][] = array('checkbox' => $checkbox, 'iUserId' => ($offset + $i + 1), 'vName' => $user['vName'], 'vEmail' => $user['vEmail'], 'vPinCode' => $user['vPinCode'], 'status' => $switch, 'action' => $action);
		}

		$result["recordsTotal"] = (int) $totalRec['total'];
		$result["recordsFiltered"] = (int) $totalRec['total'];

		return $result;
	}

	function submit_user($post = array(), $files = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iUserId = isset($post['iUserId']) ? (int) $post['iUserId'] : 0;
		$dataArray = array('eUserRole' => $post['eUserRole'], 'vName' => $post['vName'], 'vCity' => $post['vCity'], 'vPinCode' => $post['vPinCode'], 'vAddress' => $post['vAddress'], 'dModifyDate' => get_date());

		if ($iUserId > 0) {
			$this->db->update('tbl_user', $dataArray, array('iUserId' => $iUserId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];
		} else {
			$dataArray['dCreatedDate'] = get_date();
			$dataArray['vEmail'] = $post['vEmail'];
			$dataArray['vPassword'] = md5($post['vPassword']);
			$this->db->insert('tbl_user', $dataArray);
			$iUserId = $this->db->insert_id();
			if ($iUserId > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_rec_added'];
			}
		}
		if ($iUserId > 0) {
			if (!empty($files) && $files['vProfileImage']['name'] != '') {
				$query = $this->db->query("SELECT vProfileImage FROM tbl_user WHERE iUserId = ? LIMIT 1", array($iUserId));
				if ($query->num_rows() === 1) {
					$result = $query->row_array();
					$file = FCPATH . $result['vProfileImage'];
					if ($result['vProfileImage'] != '') {
						unlink_file($file);
					}
				}
				$this->load->library('upload');
				$this->load->library('image_lib');
				$file_config = array();
				$path = FCPATH . USER_DP_URL . $iUserId;
				if (!file_exists($path)) {
					@mkdir($path);
				}
				$file_config['upload_path'] = $path;
				$file_config['allowed_types'] = 'jpeg|jpg|png';
				$file_config['overwrite'] = TRUE;
				$file_config['max_size'] = '204800';
				$file_config['file_name'] = md5(time() . rand());
				$this->upload->initialize($file_config);
				if ($this->upload->do_upload('vProfileImage')) {
					$upload_data = $this->upload->data();
					$dataArray['vProfileImage'] = USER_DP_URL . $iUserId. '/' . $upload_data['file_name'];
					$this->db->update('tbl_user', $dataArray, array('iUserId' => $iUserId));
				} else {
					$content['status'] = 412;
					$content['message'] = $this->upload->display_errors();
				}
			}
		}
		return $content;
	}

	function checkEmail() {
		$vEmail = $this->input->post('vEmail');
		$check = $this->db->get_where('tbl_user', array('vEmail' => $vEmail, 'eDelete !=' => '1'))->num_rows();
		if ($check > 0) {
			return 'false';
		} else {
			return 'true';
		}
	}
	//User management end
}
