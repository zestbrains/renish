<?php
class Garage_model extends Common_model
{
     public $_table = TBL_GARAGE;
     public $_fields = "*";
     public $_where = array();
     protected $_primary_key = 'iGarageId';
     public $_except_fields = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
    }
    
    public function garage_images($iGarageId) {
		return $this->db->order_by('iImageId', 'ASC')->get_where(TBL_GARAGE_IMAGE, array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,"vType"=>'i','iGarageId'=>$iGarageId))->result_array();
                
    }
    public function getAllData($type,$limit='',$offset='',$search='',$discount='') {
                if($offset!=''){
                    $offset='OFFSET '.$offset.'';
                }
                if($search!=''){
                    $search_where=' and (vGarageName LIKE "%' . trim($search) . '%" OR vZipCode LIKE "%' . trim($search) . '%")';   
                }else{
                    $search_where='';
                }
                if($discount!=''){
                    $discount_where=' and vCouponDiscount='.$discount.'';   
                }else{
                    $discount_where='';
                }
		 $result= $this->db->query('SELECT  g.iGarageId,g.vCoverImage,g.vGarageName,d.iPercentage,g.vAmountForCoupon,u.vProfileImage,ct.vCity,s.vState,co.vCountry'
                         . '  FROM '.TBL_GARAGE.' as g '
                         . 'LEFT JOIN '.TBL_USERS.' as u ON g.iUserId=u.iUserId '
                         . 'LEFT JOIN '.TBL_CITY.' as ct ON g.iCityId=ct.iCityId '
                         . 'LEFT JOIN '.TBL_STATE.' as s ON g.iStateId=s.iStateId '
                         . 'LEFT JOIN '.TBL_COUNTRY.' as co ON g.iCountryId=co.iCountryId '                         
                         . 'LEFT JOIN '.TBL_DISCOUNTS.' as d ON g.vCouponDiscount=d.iDiscountId '
                         . ' WHERE g.eStatus="Active" AND g.eDelete="0"  '.$discount_where.' '.$search_where.' LIMIT '.$limit.' '.$offset.' ',FALSE);
//AND (g.vGarageType='.$type.' OR g.vGarageType="3")
    
//echo $this->db->last_query(); exit;
          return $result->result_array();
                
     }
     public function getGarageDataByID($garageID) {
               
		 $result= $this->db->query('SELECT  g.*,d.iPercentage,d.vCoupenPrice,g.vAmountForCoupon,u.vProfileImage,ct.vCity,ct.fLat as lattitude,ct.fLng as longitude,s.vState,co.vCountry'
                         . '  FROM '.TBL_GARAGE.' as g '
                         . 'LEFT JOIN '.TBL_USERS.' as u ON g.iUserId=u.iUserId '
                         . 'LEFT JOIN '.TBL_CITY.' as ct ON g.iCityId=ct.iCityId '
                         . 'LEFT JOIN '.TBL_STATE.' as s ON g.iStateId=s.iStateId '
                         . 'LEFT JOIN '.TBL_COUNTRY.' as co ON g.iCountryId=co.iCountryId '                         
                         . 'LEFT JOIN '.TBL_DISCOUNTS.' as d ON g.vCouponDiscount=d.iDiscountId '
                         . ' WHERE g.eStatus="Active" AND g.eDelete="0" AND iGarageId='.$garageID.' ',FALSE);

    
//echo $this->db->last_query(); exit;
          return $result->row_array();
                
     }
     public function cal_ratting($GarageID)
     {
         $result=$this->db->query('SELECT AVG(fRating) AS avg_raging, COUNT(fRating) as votes_count'
                 . ' FROM '.TBL_GARAGE_COMMENTS.' WHERE iGarageId ='.$GarageID.' AND eDelete="0" AND eStatus="Active" GROUP BY fRating');
           return $result->result_array();
     }
     public function garage_comments($GarageID,$limit='',$offset='') {
        if($offset!=''){
            $offset='OFFSET '.$offset.'';
        }
        $result= $this->db->query('SELECT gc.iCommentId,gc.vCommentTitle,gc.dCreatedDate,gc.vComment,gc.fRating,u.vName,u.vProfileImage FROM '.TBL_GARAGE_COMMENTS.' as gc LEFT JOIN '.TBL_USERS.' as u ON gc.iUserId=u.iUserId   WHERE gc.eStatus="Active" AND gc.eDelete="0" AND gc.iGarageId ='.$GarageID.'  LIMIT '.$limit.' '.$offset.' ',FALSE);

          //echo $this->db->last_query(); exit;
        return $result->result_array();
                
     }

   
}

?>
