<?php
class Setting_model extends Common_model
{
        public $_table = TBL_USERS;
        public $_fields = "*";
        public $_where = array();
        protected $_primary_key = 'iUserId';
        public $_except_fields = array();

        public function get_Country() {
		return $this->db->order_by('vCountry', 'ASC')->get_where(TBL_COUNTRY, array('eStatus' => 'Active', 'eDelete' => '0'))->result_array();
	}
	public function get_States($iCountryId = 0) {
		return $this->db->order_by('vState', 'ASC')->get_where(TBL_STATE, array('eStatus' => 'Active', 'eDelete' => '0', 'iCountryId' => $iCountryId))->result_array();
	}
        public function get_Cities($iStateId = 0) {
		return $this->db->order_by('vCity', 'ASC')->get_where(TBL_CITY, array('eStatus' => 'Active', 'eDelete' => '0', 'iStateId' => $iStateId))->result_array();
	}
        public function get_Discount() {
		return $this->db->order_by('iPercentage', 'DESC')->get_where(TBL_DISCOUNTS, array('eStatus' => 'Active', 'eDelete' => '0'))->result_array();
	}
        
        
}