<?php
class Order_model extends Common_model
{
        public $_table = TBL_GARAGE;
        public $_fields = "*";
        public $_where = array();
        protected $_primary_key = 'iGarageId';
        public $_except_fields = array();

       
        public function CheckGarageDataByID($iGarageId = 0) {
              
            $result= $this->db->query('SELECT  g.iGarageId,g.vCoverImage,g.vAmountForCoupon,d.iExpirationDays,g.vGarageName,g.vGarageType,d.vCoupenPrice,d.iRefund,d.iPercentage'
                     . '  FROM '.TBL_GARAGE.' as g '                 
                     . 'LEFT JOIN '.TBL_DISCOUNTS.' as d ON g.vCouponDiscount=d.iDiscountId '
                     . ' WHERE g.eStatus="'.ACTIVE_STATUS.'" AND g.eDelete="0" AND g.iGarageId='.$iGarageId.'  ',FALSE);
             return $result->row_array();
                
        }
        public function getUserDataByID($iUserId) {
              $result= $this->db->query('SELECT iWalletMoney FROM '.TBL_USERS.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND iUserId='.$iUserId.'  ',FALSE);
              return $result->row_array();
            
        }
        public function SubstractUserWallet($iUserId,$amount){
            $this->db->query('UPDATE '.TBL_USERS.' SET iWalletMoney=iWalletMoney-'.$amount.' WHERE  iUserId='.$iUserId.'  ',FALSE);
            return true;
        }
         public function AddUserWallet($iUserId,$amount){           
            $this->db->query('UPDATE '.TBL_USERS.' SET iWalletMoney=iWalletMoney+'.$amount.' WHERE  iUserId='.$iUserId.'  ',FALSE);
            return true;
        }
        public function CheckPaymentDataByID($payment_id) {
              $result= $this->db->query('SELECT * FROM '.TBL_PAYMENT.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND payment_id='.$payment_id.'  ',FALSE);
              return $result->row_array();
            
        }
        public function CheckPaymentDataByTransactionID($transID) {
              $result= $this->db->query('SELECT payment_id FROM '.TBL_PAYMENT.' WHERE eStatus="'.ACTIVE_STATUS.'" AND vPaymentFor="'.PAYMENT_FOR_COUPON.'" AND eDelete="0" AND txn_id="'.$transID.'"  ',FALSE);
              return $result->row_array();
            
        }
         public function get_user_comment($GarageID,$iUserId,$TransactionID) {
          
            $result= $this->db->query('SELECT gc.iCommentId,gc.vCommentTitle,gc.iRefundAmount,gc.dCreatedDate,gc.vComment,gc.fRating,u.vName,u.vProfileImage FROM '.TBL_GARAGE_COMMENTS.' as gc LEFT JOIN '.TBL_USERS.' as u ON gc.iUserId=u.iUserId   WHERE gc.eStatus="'.ACTIVE_STATUS.'" AND gc.eDelete="0" AND gc.iGarageId ='.$GarageID.' AND gc.iUserId='.$iUserId.' AND gc.txn_id="'.$TransactionID.'"',FALSE);
            return $result->row_array();
                
        }
      
     
       
        
        
}