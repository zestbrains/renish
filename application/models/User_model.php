<?php
class User_model extends Common_model
{
     public $_table = TBL_USERS;
     public $_fields = "*";
     public $_where = array();
     protected $_primary_key = 'iUserId';
     public $_except_fields = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
    }

    /*     * ***********************************************************************
     * *                    Check User Login
     * *********************************************************************** */

    function checkLogin($postData)
    {
      

        $this->db->from(TBL_USERS);
        $this->db->where('vEmail', $postData['email']);
        $this->db->where('vPassword', md5($postData['password']));
        $this->db->where('eStatus',ACTIVE_STATUS); 
        $this->db->where('eDelete','0'); 
        //$this->db->where('eUserRole','user'); 
        //$this->db->where_in('eUserRole', unserialize(ADMIN_USER_TYPE));
 
        // Query
        $query = $this->db->get();
        // Let's check if there are any results
        if ($query->num_rows()==1)
        {
           
            // If there is a user, then create session data

            $row = $query->row();

            // USER NOT EXISTS IN DATABASE
            if ($row != '')
            {
               
                $userdata = array(
                    'USERLOGIN' => TRUE,
                    'ACTIVATION_PENDING' => FALSE,
                    'USERID' => $row->iUserId,
                    'USEREMAIL' => $row->vEmail,
                    'USERNAME' => $row->vName,
                    'ZIPCODE' => $row->vPinCode,
                    'USER_TYPE' =>$row->eUserRole, 
                    'USERWALLET' =>$row->iWalletMoney, 
                    'USERIMAGE' =>DOMAIN_URL.$row->vProfileImage
                );
 
                                         

                // STORE SESSION
                $this->session->set_userdata($userdata);

                
                return 1;
            }
        } else
        {
            return 0;
        }
    }
    
    /*------- check Username ------- */
    
   
    /*     * ***********************************************************************
     * *					Check Cookie For Loggedin User
     * *********************************************************************** */
    
    
    
    
     function chk_cookie($postData)
    {

        $cookie = md5('loggedin');
        $test = get_cookie($cookie);

        if ($cookie_value = get_cookie($cookie))
        {
            $this->db->from(TBL_USERS);
            $this->db->where('email', $postData['email']);
            $this->db->where('password', $postData['password']);
            $this->db->where('active','1'); 
            $this->db->where('deleted','0'); 
            $this->db->where_in('user_type', unserialize(ADMIN_USER_TYPE));
            $query = $this->db->get();

            // Let's check if there are any results

            if ($query->num_rows == 1)
            {
                // If there is a user, then create session data

                $row = $query->row();
              
                    $userdata = array(
                       'ADMINLOGIN' => TRUE,
                        'ADMINID' => $row->id,
                        'ADMINEMAIL' => $row->email,
                        'ADMINBALANCE' => $row->image     
                    );

                    // STORE SESSION
                    $this->session->set_userdata($userdata);
                    return true;
               
            }
            return false;
        }
    }

    

    function checkAdminEmailAvailable($vEmail, $iAdminID = '')
    {
       
        if (isset($iAdminID) && $iAdminID != '')
            $ucheck = array('vEmail' => $vEmail, 'iUserID  <>' => $iAdminID);
        else
            $check = array('vEmail' => $vEmail);

        $result = $this->db->get_where(TBL_USERS, (isset($ucheck) && $ucheck != '') ? $ucheck : $check);

        if ($result->num_rows() >= 1)
            return 0;
        else
            return 1;
    }

    function checkSubscribeEmail($vEmail)
    {
        $result = $this->db->get_where('tbl_subscriber',array('vEmail' => $vEmail));
        if ($result->num_rows() >= 1)
            return 0;
        else
            return 1;
    }

    function insertSubscriber($array=array()){
        $this->db->insert('tbl_subscriber',$array);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return '';
    }
    /*     * ***********************************************
     *
     *   GET SETTING DATA BY ID 
     *   SETTING ID MUST BE ALWAYS : 1
     *
     * ********************************************** */

    function getSettingDetailByID()
    {

        $query = $this->db->get_where(TBL_SETTING, array('iSettingId ' => '1'));

        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return '';
    }


    function checkOldPassword($iUserId,$vPassword)
    {
       
        //$user_session_data = $this->session->userdata('ADMIN');
        $this->db->from(TBL_USERS);
        $this->db->where('iUserId', $iUserId);
        $this->db->where('vPassword',md5($vPassword));
        $this->db->where('eStatus',ACTIVE_STATUS); 
        $this->db->where('eDelete','0'); 
        $this->db->where('eUserRole','user'); 
        $this->db->where_in('eUserRole', unserialize(ADMIN_USER_TYPE));

        $query = $this->db->get();

        if ($query->num_rows() >= 1){
            return 1;
        }else{
            return 0;
        }
            

        
    }

    function changePassword($postData)
    {

        $postArray = $this->general_model->getDatabseFields($postData, TBL_USER);
        $query = $this->db->update(TBL_USER, $postArray, array('vEmail ' => $postData['vEmail']));

        if ($this->db->affected_rows() >= 0)
            return true;
        else
            return $this->db->_error_message();
    }
    
     public function getOrdersData($iUserId) {
              
		 $result= $this->db->query('SELECT  p.*,d.vCoupenPrice,d.iPercentage,d.iRefund,g.vGarageName,g.vCoverImage,b.vBannerSize,b.iBannerId,g.vAmountForCoupon'
                         . '  FROM '.TBL_PAYMENT.' as p '
                         . 'LEFT JOIN '.TBL_GARAGE.' as g ON g.iGarageId=p.iGarageId '                        
                         . 'LEFT JOIN '.TBL_DISCOUNTS.' as d ON g.vCouponDiscount=d.iDiscountId '
                         . ' LEFT JOIN '.TBL_BANNER_PURCHASE.' as b ON p.iBannerId=b.iBannerId'
                         . ' WHERE p.eStatus="'.ACTIVE_STATUS.'" AND p.iUserId='.$iUserId.' AND p.eDelete="0" ',FALSE);

    
//echo $this->db->last_query(); exit;
          return $result->result_array();
                
     }
     public function getTotalPaidAmount($iUserId){
              $result= $this->db->query('SELECT SUM(payment_gross) as total FROM '.TBL_PAYMENT.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND payment_status="'.PAYMENT_COMEPLTED_STATUS.'" AND iUserId='.$iUserId.'  ',FALSE);
              return $result->row()->total;  
     }
     public function getTotalRefundAmount($iUserId){
              $result= $this->db->query('SELECT SUM(iRefundAmount) as total FROM '.TBL_GARAGE_COMMENTS.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND iUserId='.$iUserId.'  ',FALSE);
              return $result->row()->total;  
     }
     public function getGarageDataByUserID($iUserId){
              $result= $this->db->query('SELECT iGarageId FROM '.TBL_GARAGE.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND iUserId='.$iUserId.'  ',FALSE);
              return $result->row_array();
     }
     public function getSellingData($iGarageId){
         
          $result= $this->db->query('SELECT  p.txn_id,d.iPercentage,g.vAmountForCoupon,p.payment_date,d.iExpirationDays,u.vName,u.vProfileImage'
                         . '  FROM '.TBL_PAYMENT.' as p '
                         . 'LEFT JOIN '.TBL_GARAGE.' as g ON g.iGarageId=p.iGarageId '
                         . 'LEFT JOIN '.TBL_USERS.' as u ON u.iUserId=p.iUserId '
                         . 'LEFT JOIN '.TBL_DISCOUNTS.' as d ON g.vCouponDiscount=d.iDiscountId '
                         . ' WHERE p.eStatus="'.ACTIVE_STATUS.'" AND p.iGarageId='.$iGarageId.' AND p.payment_status="'.PAYMENT_COMEPLTED_STATUS.'" AND p.eDelete="0"',FALSE);

          return $result->result_array();
     }
      public function getTotalSellCount($iGarageId){
              $result= $this->db->query('SELECT COUNT(payment_id) as total FROM '.TBL_PAYMENT.' WHERE eStatus="'.ACTIVE_STATUS.'" AND eDelete="0" AND payment_status="'.PAYMENT_COMEPLTED_STATUS.'" AND iGarageId='.$iGarageId.'  ',FALSE);
              return $result->row()->total;  
     }
     
    function checkVarificationCode($postData)
    {
            return $this->db->get_where(TBL_USERS, array("eDelete" =>'0',"iUserId" =>$postData['iUserId'],"vActivationToken"=>$postData['vActivationToken']))->row_array();
            
      
    }
    function GetUserDataByVarificationCode($vActivationToken)
    {
            return $this->db->get_where(TBL_USERS, array("eDelete" =>'0',"vActivationToken"=>$vActivationToken))->row_array();
            
      
    }
     
     

}

?>
