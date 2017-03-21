<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_Model {

	private $userID = '';

	public function __construct() {
		parent::__construct();

	}

	//Getting discount
	public function get_Discount() {
		return $this->db->order_by('iPercentage', 'DESC')->get_where('tbl_discount', array('eStatus' => 'Active', 'eDelete' => '0'))->result_array();
	}

	//Getting country
	public function get_Country() {
		return $this->db->order_by('vCountry', 'ASC')->get_where('mst_country', array('eStatus' => 'Active', 'eDelete' => '0'))->result_array();
	}

	//Getting states
	public function get_States($iCountryId = 0) {
		return $this->db->order_by('vState', 'ASC')->get_where('mst_state', array('eStatus' => 'Active', 'eDelete' => '0', 'iCountryId' => $iCountryId))->result_array();
	}

	//Getting city
	public function get_City($iStateId = 0) {
		return $this->db->order_by('vCity', 'ASC')->get_where('mst_city', array('eStatus' => 'Active', 'eDelete' => '0', 'iStateId' => $iStateId))->result_array();
	}

	public function isAdminLogin() {
		if ($this->session->userdata('ADMINID') > 0) {return true;} else {return false;}
	}

	public function getSections() {
		$data = array();
		$qry = $this->db->query("SELECT s.iSectionId,s.vSectionName,s.vImage,GROUP_CONCAT( r.vPageName ORDER BY r.iSequence ASC separator ',') as vPageName, GROUP_CONCAT( r.vTitle ORDER BY r.iSequence ASC separator ',') as vTitle FROM mst_adminsection as s LEFT JOIN (SELECT vPageName,vTitle,iSectionId,iSequence FROM mst_adminrole WHERE eIsactive = ? ORDER BY iSectionId,iSequence) as r ON (s.iSectionId = r.iSectionId) WHERE s.eIsactive = ? GROUP BY s.iSectionId ORDER BY s.iSequence ASC", array('y', 'y'));

		$data['sec_rows'] = $qry->num_rows();
		$data['sec_results'] = $qry->result();
		return $data;
	}

	public function siteCount() {
		$content = array();

		$this->db->where('eUserRole', 'admin')->where('eDelete!=', '1')->from('tbl_user');
		$content['admin'] = $this->db->count_all_results();

		$this->db->where('eUserRole', 'user')->where('eDelete!=', '1')->from('tbl_user');
		$content['user'] = $this->db->count_all_results();

		$this->db->where('eDelete!=', '1')->from('mst_country');
		$content['country'] = $this->db->count_all_results();

		$this->db->where('eDelete!=', '1')->from('mst_state');
		$content['state'] = $this->db->count_all_results();

		$this->db->where('eDelete!=', '1')->from('mst_city');
		$content['city'] = $this->db->count_all_results();

		return $content;
	}

	public function siteSettings() {
		$this->db->select(array('vConstant', 'vValue'));
		$qry = $this->db->get("mst_sitesettings");
		foreach ($qry->result_array() as $k => $v) {
			if (!defined($v["vConstant"])) {
				define($v["vConstant"], $v["vValue"]);
			}
		}
	}

	function forgotPassword($PostData = array()) {
		$content = array();
		$content['status'] = 404;
		$query = $this->db->query("SELECT iUserId,eStatus FROM tbl_user WHERE vEmail = ? AND eUserRole != ? AND eStatus != ? ", array($PostData['vEmail'], 'user', 'Delete'));
		if ($query->num_rows() === 1) {
			$result = $query->row_array();
			if ($result['eStatus'] == 'Active') {
				$to = $PostData['vEmail'];
				$token = md5($result['iUserId'] . time());
				$this->db->query("UPDATE tbl_user SET vActivationToken = '" . $token . "' WHERE iUserId = ?", array($result['iUserId']));
				if ($this->db->affected_rows() > 0) {
					$link = base_url() . "admin/login/reset/" . $token;
					$email_data = generateEmailTemplate('forgot_password', array("{{GREETINGS}}", "{{RESET_PASS_LINK}}"), array("User", $link));
					$check = sendEmailAddress($to, $email_data['subject'], $email_data['message'], $email_data['fromemail'], $email_data['fromname']);
					if ($check) {
						$content['status'] = 200;
						$msgType = disMessage(array("type" => "Success", "var" => $this->data['language']['succ_forgot_link_sent']));
						$this->session->set_userdata("msgType", $msgType);
					} else {
						$content['message'] = $this->data['language']['err_email_not_sent'];
					}
				}
			} else {
				$content['message'] = $this->data['language']['err_inactive'];
			}
		} else {
			$content['message'] = $this->data['language']['err_email_not_registered'];
		}
		return $content;
	}

	function checkResetToken($token = "") {
		$content = array();
		$content['status'] = 404;
		$query = $this->db->get_where('tbl_user', array('vActivationToken' => $token));
		if ($query->num_rows() > 0) {
			$content['status'] = 200;
		}
		return $content;
	}

	function resetPass($post = array()) {
		$content = array();
		$content['status'] = 404;

		$query = $this->db->query("SELECT iUserId,eStatus FROM tbl_user WHERE vActivationToken = ? ", array($post['vToken']));

		if ($query->num_rows() === 1) {
			$result = $query->row_array();
			if ($result['eStatus'] == 'Active') {
				$this->db->query("UPDATE tbl_user SET vPassword = '" . md5($post['npassword']) . "',vActivationToken = '" . md5(rand()) . "' WHERE iUserId = ?", array($result['iUserId']));
				$content['status'] = 200;
				$content['message'] = $this->data['language']['succ_pass_changed'];
			} else {
				$content['message'] = $this->data['language']['err_inactive'];
			}
		} else {
			$content['message'] = $this->data['language']['err_invalid_token'];
		}

		return $content;
	}

	public function submit_admin_profile($post = array()) {
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];

		$iUserId = isset($post['iUserId']) ? (int) $post['iUserId'] : 0;
		$dataArray = array('vName' => $post['vName'], 'vEmail' => $post['vEmail']);
		if ($iUserId > 0) {
			$this->db->update('tbl_user', $dataArray, array('iUserId' => $iUserId));
			$content['status'] = 200;
			$content['message'] = $this->data['language']['succ_rec_updated'];

		}
		if (isset($_FILES['vImage']['name']) && $_FILES['vImage']['name'] != "") {

			if ($_FILES['vImage']['type'] == 'image/png' || $_FILES['vImage']['type'] == 'image/jpg' || $_FILES['vImage']['type'] == 'image/jpeg') {
				$cont = $this->submit_userImage($iUserId);
				$this->db->update('tbl_users', array('vImage' => $cont['imgName']), array('iUserId' => $iUserId));
			}
		}
		return $content;
	}
}