<?php
class Order extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('order_model', 'Order');
        $this->load->model('garage_model', 'Garage');
    }

   public function summary($garageID) {
        if($garageID!=''){             
            if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){                
                $summaryData = $this->Order->CheckGarageDataByID($garageID);
                if(!empty($summaryData)){
                  
                    
                        $summaryData['userData']=$this->Order->getUserDataByID($_SESSION['USERID']);
                        $summaryData['expiration_date']=$this->date_after_days($summaryData['iExpirationDays'],date('Y-m-d'));
                        //pre($summaryData);
                        $this->viewData['summaryData']=$summaryData;
                         $this->viewData['is_datatable'] =false;
  			$this->viewData['title'] ="Order Summary";
                        $this->viewData['module'] = "front/orders/summary"; 
                        $this->load->view('template', $this->viewData);
                        
                   
                }else{
		   $this->viewData['title'] ="404";	
                   $this->viewData['module'] = "errors/front/404";
                   $this->load->view('template', $this->viewData); 
                }
            }else{
                $this->session->set_userdata('last_page', 'order/summary/'.$garageID.'');
                redirect('../user/login');
            }
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }    
  } 
 
   function buy($garageID){
        //Set variables for paypal form
        if($garageID!=''){     
             if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){   
                $productData = $this->Order->CheckGarageDataByID($garageID);
                if(!empty($productData)){
                    $returnURL = DOMAIN_URL.'/'.'paypal/success'; //payment success url
                    $cancelURL = DOMAIN_URL.'/'.'paypal/cancel'; //payment cancel url
                    $notifyURL = DOMAIN_URL.'/'.'paypal/ipn'; //ipn url
                    //get particular product data

                    $userID = $_SESSION['USERID']; //current user id
                    
                    $userData=$this->Order->getUserDataByID($userID);
                    if($userData['iWalletMoney']>0){
                        $FInalAmount=$productData['vCoupenPrice']-$userData['iWalletMoney'];
                        if($FInalAmount<=0){
                            $userWalletamount=$productData['vCoupenPrice'];
                            $FInalAmount=0;
                        }else{
                            $userWalletamount=$productData['vCoupenPrice']-$FInalAmount;
                        }

                    }else{
                        $FInalAmount=$productData['vCoupenPrice'];
                        $userWalletamount=0;
                    }
                    
                    $logo =DOMAIN_URL.'/files/uploads/logo.png';
                    $custom=$userID.','.$userWalletamount;

                    $this->paypal_lib->add_field('return', $returnURL);
                    $this->paypal_lib->add_field('cancel_return', $cancelURL);
                    $this->paypal_lib->add_field('notify_url', $notifyURL);
                    $this->paypal_lib->add_field('item_name', $productData['vGarageName']);
                    $this->paypal_lib->add_field('custom', $custom);
                    $this->paypal_lib->add_field('item_number',  $productData['iGarageId']);
                    $this->paypal_lib->add_field('amount',  $FInalAmount);        
                    $this->paypal_lib->image($logo);
                    
                    $this->paypal_lib->paypal_auto_form();
                }else{
                    $this->viewData['module'] = "errors/front/404";
                    $this->load->view('template', $this->viewData); 
                }    
            }else{
                $this->session->set_userdata('last_page', 'order/summary/'.$garageID.'');
                redirect('../user/login'); 
            }
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }        
    }
    public function details($payment_id){
        if($payment_id!=''){  
            $PaymentData = $this->Order->CheckPaymentDataByID($payment_id);
            if(!empty($PaymentData) && isset($_SESSION['USERID']) && $_SESSION['USERID']==$PaymentData['iUserId']){   
               
                $userData=$this->Order->getUserDataByID($PaymentData['iUserId']);
                $productData = $this->Order->CheckGarageDataByID($PaymentData['iGarageId']);
                $productData['payment_status'] =$PaymentData['payment_status'];            
                $productData['paid_amount'] =$PaymentData['payment_gross'];  


                $productData['userData']=$userData;
                $productData['expiration_date']=$this->date_after_days($productData['iExpirationDays'],$PaymentData['payment_date']);                              
                $commentsData = $this->Order->get_user_comment($PaymentData['iGarageId'],$PaymentData['iUserId'],$PaymentData['txn_id']);
               
               // pre($productData);
                $this->viewData['summaryData'] = $productData; 
                $this->viewData['PaymentData'] = $PaymentData; 
                $this->viewData['CommentData'] = $commentsData;                 
                $this->viewData['is_datatable'] =false;  
                $this->viewData['title'] = 'Order Detail';  
                $this->viewData['module'] = "front/order_history_detail";
                $this->load->view('template', $this->viewData);
                
            }else{
                $this->viewData['module'] = "errors/front/404";
                $this->load->view('template', $this->viewData);
            }
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }  
        
    }
   
    protected function date_after_days($days,$paymentDate=NULL){  
           if($paymentDate=='0000-00-00'){
           $paymentDate=date('Y-m-d');
       } 
        $days='+'.$days.' days';   
        $date = strtotime($paymentDate);
        $date = strtotime($days, $date);
        return date('d M Y', $date);
   }
 
    
 
}

