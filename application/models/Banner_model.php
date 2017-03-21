<?php
class Banner_model extends Common_model
{
        public $_table = TBL_BANNER_PURCHASE;
        public $_fields = "*";
        public $_where = array();
        protected $_primary_key = 'iBannerId';
        public $_except_fields = array();

       
         public function getBannersLists() {
		return $this->db->order_by('iAmount', 'DESC')->get_where(TBL_BANNER_PURCHASE, array('eStatus' =>ACTIVE_STATUS, 'eDelete' => '0'))->result_array();
	}
        public function getBannersListByID($iBannerId) {
		return $this->db->get_where(TBL_BANNER_PURCHASE, array('eStatus' =>ACTIVE_STATUS, 'eDelete' => '0','iBannerId' => $iBannerId))->row_array();
	}
         public function CheckPaymentDataByTransactionID($transID) {
              $result= $this->db->query('SELECT payment_id FROM '.TBL_PAYMENT.' WHERE eStatus="'.ACTIVE_STATUS.'" AND vPaymentFor="'.PAYMENT_FOR_BANNER.'" AND eDelete="0" AND txn_id="'.$transID.'"  ',FALSE);
              return $result->row_array();
            
        }
        public function CheckPaymentDataByID($payment_id) {
              $result= $this->db->query('SELECT * '
                      . 'FROM '.TBL_PAYMENT.' as p'
                      . ' LEFT JOIN '.TBL_BANNER_PURCHASE.' as b ON p.iBannerId=b.iBannerId'
                      . '  WHERE p.eStatus="'.ACTIVE_STATUS.'" AND p.eDelete="0" AND p.payment_id='.$payment_id.'  ',FALSE);
              return $result->row_array();
            
        }
      
      
     
       
        
        
}