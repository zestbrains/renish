<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function checkAdminLogin($PostData = array()) {
		$content = array();
		$content['status'] = 404;
		$query = $this->db->get_where('tbl_user', array("vEmail" => $PostData['vEmail'], 'vPassword' => md5($PostData['vPassword']), 'eUserRole!=' => 'user', 'eDelete!=' => '1'));

		if ($query->num_rows() === 1) {
			$r = $query->row();
			if ($r->eStatus == 'Active') {
				$userdata = array(
					'ADMINID' => $r->iUserId,
					'ADMINUSERTYPE' => $r->eUserRole,
				);
				$this->session->set_userdata($userdata);
				if ($PostData['isremember'] == 1) {
					$this->input->set_cookie(array('name' => 'user_email',
						'value' => $PostData['vEmail'],
						'expire' => 2592000,
						'path' => '/'));
					$this->input->set_cookie(array('name' => 'user_password',
						'value' => base64_encode($PostData['vPassword']),
						'expire' => 2592000,
						'path' => '/',
					));
					$this->input->set_cookie(array('name' => 'user_isremember',
						'value' => 1,
						'expire' => 2592000,
						'path' => '/'));
				} else {
					$this->input->set_cookie(array('name' => 'user_email',
						'value' => "",
						'expire' => 0,
						'path' => '/',
						'secure' => TRUE));
					$this->input->set_cookie(array('name' => 'user_password',
						'value' => "",
						'expire' => 0,
						'path' => '/',
						'secure' => TRUE));
					$this->input->set_cookie(array('name' => 'user_isremember',
						'value' => 0,
						'expire' => 0,
						'path' => '/',
						'secure' => TRUE));
				}
				$content['status'] = 200;
				$content['message'] = 'success';
			} else {
				$content['message'] = $this->data['language']['err_inactive'];
			}

		} else {
			$content['message'] = $this->data['language']['err_login'];
		}
		return $content;
	}

	public function changeStatus($post = array()) {

		$content = array();
		$table = isset($post['table']) ? $post['table'] : "";
		$content['status'] = 404;
		if ($this->db->table_exists($table)) {
			switch ($table) {
			case 'tbl_user':
				$this->db->update($table, array('eStatus' => $post['value']), array('iUserId' => $post['id']));
				break;
			case 'mst_country':
				$this->db->update($table, array('eStatus' => $post['value']), array('iCountryId' => $post['id']));
				break;
			case 'mst_state':
				$this->db->update($table, array('eStatus' => $post['value']), array('iStateId' => $post['id']));
				break;
			case 'mst_city':
				$this->db->update($table, array('eStatus' => $post['value']), array('iCityId' => $post['id']));
				break;
			case 'tbl_discount':
				$this->db->update($table, array('eStatus' => $post['value']), array('iDiscountId' => $post['id']));
				break;
			case 'tbl_banner_purchase':
				$this->db->update($table, array('eStatus' => $post['value']), array('iBannerId' => $post['id']));
				break;
			default:
				# code...
				break;
			}
			if ($this->db->affected_rows() > 0) {
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_status_changed'];
			}
		}
		return $content;
	}

	public function generate_checkbox($params = array()) {
		if (!isset($params['selected'])) {
			$params['selected'] = '';
		}
		if (!isset($params['disabled'])) {
			$params['disabled'] = '';
		}
		$checkbox = '<input type="checkbox" class="small-chk" ' . $params['disabled'] . ' value="' . $params['id'] . '" ' . $params['selected'] . '>';
		return $checkbox;
	}

	public function generate_switch($params = array()) {
		$switch = '<div class="switch-small"><input type="checkbox" data-id="' . $params['id'] . '" data-table="' . $params['table'] . '" data-getaction="' . (!empty($params['getaction']) ? $params['getaction'] : '') . '" data-url="' . $params['url'] . '" ' . $params['checked'] . ' class="make-switch ' . (!empty($params['class']) ? $params['class'] : 'status-switch') . '" data-on-label="<i class=\'fa fa-check\'></i>" data-off-label="<i class=\'fa fa-times\' ></i>" ></div>';
		return $switch;
	}

	public function generate_actions($params = array(), $isEdit = true, $isView = true, $isDelete = true) {
		$operation = '';

		if ($isView) {
			$operation .= '<button title="View" data-url="' . $params['url'] . '" data-type="view" data-id="' . $params['id'] . '" class="btn btn-success btn-xs btnView">View</button>';
		}
		if ($isEdit) {
			$operation .= '<button title="Edit" data-type="form" data-url="' . $params['url'] . '" data-id="' . $params['id'] . '" class="btn btn-warning btn-xs btnEdit">Edit</button>';
		}
		if ($isDelete) {
			$operation .= '<button title="Delete" data-url="' . $params['url'] . '" data-id="' . $params['id'] . '" class="btn btn-danger btn-xs btnDelete">Delete</button>';
		}
		return $operation;
	}

	public function getSingleRecordById($id = 0, $table = '', $key = '') {
		$query = $this->db->select('*')->from($table)->where($key, $id)->get();
		if ($query->num_rows() === 1) {
			return $query->row_array();
		} else {
			return array();
		}
	}

	public function deleteSingle($value = 0, $table = '', $key = '') {
		$content = array();
		$content['status'] = 400;
		$this->db->update($table, array('eDelete' => '1'), array($key => $value));
		if ($this->db->affected_rows() > 0) {
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_deleted'];
		}
		return $content;
	}

	public function deleteMultiple($ids, $table = '', $key = '') {
		$content = array();
		$content['status'] = 400;
		$condition = $this->db->where("FIND_IN_SET($key,'$ids') !=", 0);
		$this->db->update($table, array('eDelete' => '1'));
		if ($this->db->affected_rows() > 0) {
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_deleted'];
		}
		return $content;
	}
}
