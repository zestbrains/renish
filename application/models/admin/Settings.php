<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Model {

	public function __construct() {
		parent::__construct();

	}

	public function submitSettings($post = array(), $files = array()) {
		$status = 0;
		$this->load->library('upload');
		$this->load->library('image_lib');
		foreach ($files as $k => $v) {

			$_FILES['userfile']['name'] = strtolower($v['name']);
			$_FILES['userfile']['type'] = $v['type'];
			$_FILES['userfile']['tmp_name'] = $v['tmp_name'];
			$_FILES['userfile']['error'] = $v['error'];
			$_FILES['userfile']['size'] = $v['size'];

			$this->upload->initialize($this->set_upload_options());
			if ($this->upload->do_upload()) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];
				$q = $this->db->query("UPDATE mst_sitesettings SET vValue = '" . $filename . "' WHERE iFieldId = ? LIMIT 1", array($k));
				if ($this->db->affected_rows() > 0) {
					$status = 1;
					$ini_path = $upload_data["full_path"];
					$dest_path = $upload_data["full_path"];

					$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - (180 / 70);
					$master_dim = ($dim > 0) ? "height" : "width";

					$image_config["image_library"] = "gd2";
					$image_config["source_image"] = $ini_path;
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['new_image'] = $dest_path;
					$image_config['quality'] = "100%";
					$image_config['width'] = 180;
					$image_config['height'] = 70;
					$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
					$image_config['master_dim'] = ($dim > 0) ? "height" : "width";

					$this->image_lib->initialize($image_config);
					$this->image_lib->resize();

					// Now change the input file to the one that just got resized
					// See also $this->image_lib->clear()

					$image_config['maintain_ratio'] = FALSE;
					$image_config['x_axis'] = '0';
					$image_config['y_axis'] = '0';

					$this->image_lib->clear();
					$this->image_lib->initialize($image_config);
					$this->image_lib->crop();

				}

			} else {
				$error = $this->upload->display_errors();
			}

		}
		foreach ($post as $k => $v) {
			if ((int) $k) {
				if ($v != "") {
					$q = $this->db->query("UPDATE mst_sitesettings SET vValue = '" . trim($v) . "' WHERE iFieldId= ? LIMIT 1", array($k));
					if ($this->db->affected_rows() === 1) {
						$status = 1;
					}
				}
			}
		}
		return $status;
	}

	public function getFields() {
		$qry = $this->db->query("SELECT * FROM mst_sitesettings WHERE eEditable = ?", array('y'));
		return $qry->result();

	}

	private function set_upload_options() {
		//upload an image options
		$config = array();
		$config['upload_path'] = FCPATH . SITE_IMG;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '204800';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		return $config;
	}
	public function changePass($opassword = NULL, $npassword = NULL, $cpassword = NULL) {
		$msg = "";
		$this->form_validation->set_rules('opassword', 'Old Password', 'required');
		$this->form_validation->set_rules('npassword', 'New Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			$qry = $this->db->query("SELECT iUserId FROM tbl_user WHERE iUserId = ? AND vPassword = ?", array($this->session->userdata('ADMINID'), md5($opassword)));

			if ($qry->num_rows() == 1) {

				if ($npassword == $cpassword) {

					$qry = $this->db->query("UPDATE tbl_user SET vPassword = '" . md5($npassword) . "' WHERE iUserId = ? LIMIT 1", array($this->session->userdata('ADMINID')));
					if ($this->db->affected_rows() === 1) {
						$msg = $this->data['language']['succ_pass_changed'];
					}
					return true;
				} else {
					$msg = $this->data['language']['err_pswd_not_match'];
				}

			} else {
				$msg = $this->data['language']['err_wrong_old_pwd'];
			}
		}
		return $msg;
	}

	public function passValue() {
		$qry = $this->db->query("SELECT vPassword FROM tbl_user WHERE iUserId = ? LIMIT 1", array($this->session->userdata('ADMINID')));
		$r = $qry->row();
		$passvalue = $r->vPassword;
		return $passvalue;

	}

}