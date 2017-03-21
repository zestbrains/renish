<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends Front_Controller_without_login 
{
     function  __construct(){
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('order_model', 'Order');
     }
     
     function success($garageID=NULL){
          $paypalInfo = $this->input->post();         
       
        //when request come from paypal  
        if(isset($paypalInfo['txn_id']) && $paypalInfo['txn_id']!=''){              
                
                $this->Order->_table=TBL_PAYMENT;
                $paymentData=$this->Order->CheckPaymentDataByTransactionID($paypalInfo["txn_id"]);
                if(empty($paymentData)){
                    
                    $explode=explode(',',$paypalInfo["custom"]);                
                    $userWalletamount= number_format((float)$explode[1], 2, '.', '');

                    $data['userWalletamount'] =$userWalletamount; 
                    $data['txn_id'] = $paypalInfo["txn_id"];
                    $data['currency_code'] = $paypalInfo["mc_currency"];
                    $data['payment_status'] = $paypalInfo["payment_status"];
                    $data['iUserId'] = $explode[0];
                    $data['vPaymentFor'] =PAYMENT_FOR_COUPON;
                    $data['vDaddress'] ='';                    
                    $data['iGarageId'] = $paypalInfo["item_number"];
                    $data['payment_gross'] = $paypalInfo["payment_gross"];
                    $data['payment_date'] = date("Y-m-d", strtotime($paypalInfo['payment_date']));
                    $data['payer_email'] = $paypalInfo["payer_email"];
                    $data['vPaymentType'] =PAYMENT_TYPE_PAYPAL;
                    $data['iQuantity']='1';
                    $data['iBannerId'] ='0';
                    $data['eStatus'] = ACTIVE_STATUS;
                    $data['eDelete'] ='0';
                    
                    
                    $this->Order->_table=TBL_PAYMENT;
                    $payment_id= $this->Order->insertRow($data);
                    
                    $this->Order->_table=TBL_USERS;
                    $this->Order->SubstractUserWallet($data['iUserId'],$data['userWalletamount']);  
                    
                }else{
                    $payment_id=$paymentData['payment_id'];
                }
                
                 
                
                 
        // when request come direct from summary,where money cut from user wallet        
        }else if($garageID!=''){     
                if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){ 
                        $transactionID='rps-'.time().rand();                 

                        $this->Order->_table=TBL_PAYMENT;
                        $paymentData=$this->Order->CheckPaymentDataByTransactionID($transactionID);
                        if(empty($paymentData)){

                            $userData=$this->Order->getUserDataByID($_SESSION['USERID']);
                            $productData = $this->Order->CheckGarageDataByID($garageID);


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
                            }
                            $userWalletamount= number_format((float)$userWalletamount, 2, '.', '');


                            $data['userWalletamount'] =$userWalletamount; 
                            $data['txn_id'] =$transactionID;
                            $data['currency_code'] = 'USD';
                            $data['payment_status'] =PAYMENT_COMEPLTED_STATUS;
                            $data['iUserId'] = $_SESSION['USERID'];
                            $data['vPaymentFor'] =PAYMENT_FOR_COUPON;
                            $data['iGarageId'] = $garageID;
                            $data['vDaddress'] =''; 
                            $data['payment_gross'] =$FInalAmount;
                            $data['payment_date'] = date("Y-m-d");
                            $data['vPaymentType'] =PAYMENT_TYPE_WALLET;
                            $data['payer_email'] = '-';
                            $data['iQuantity']='1';
                            $data['iBannerId'] ='0';
                            $data['eStatus'] = ACTIVE_STATUS;
                            $data['eDelete'] ='0'; 

                            $this->Order->_table=TBL_PAYMENT;
                            $payment_id= $this->Order->insertRow($data);

                            $this->Order->_table=TBL_USERS;
                            $this->Order->SubstractUserWallet($data['iUserId'],$data['userWalletamount']);    

                    }else{
                        $payment_id=$paymentData['payment_id'];
                    }
                  
                   
                }else{
                    $this->session->set_userdata('last_page', 'order/summary/'.$garageID.'');
                    redirect('../user/login'); 
                }                
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }        
                    
      
        //pass the transaction data to view
        if($payment_id){  
             redirect('../order/details/'.$payment_id.''); 
        }
        else{
             $this->viewData['module'] = "front/orders/cancle";        
             $this->load->view('template', $this->viewData);
        }
       
        
     }
     
   
     protected function date_after_days($days){  
      $days='+'.$days.' days';
      $newDate= date('Y-m-d', strtotime($days));
      return date('d M Y', strtotime($newDate));
      
    }
     
     function cancel(){
         $this->viewData['module'] = "front/orders/cancle"; 
         $this->load->view('template', $this->viewData);
     }
     
     function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();

        $data['iUserId'] = $paypalInfo['custom'];
        $data['userWalletamount'] = $paypalInfo['userWalletamount'];
        $data['iGarageId']    = $paypalInfo["item_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']    = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->Order->_table=TBL_PAYMENT;
            $UpdatedID= $this->Order->insertRow($data,'payment_id','');
        }
    }
}