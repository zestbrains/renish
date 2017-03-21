<?php
class Banner extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
        $this->load->model('banner_model', 'Banner');
         $this->load->library('paypal_lib');
    }

   function view()
    {
       $BannersLists=$this->Banner->getBannersLists();
       if(!empty($BannersLists)){       
            $this->viewData['BannersLists'] =$BannersLists;  
            $this->viewData['title'] = lang("HOME_PAGE");  
            $this->viewData['module'] = "front/banner/view";
            $this->viewData['is_datatable'] =false;  
            $this->load->view('template', $this->viewData);
       }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
       }    
    }
    function buy(){        
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){  
             $postData=$this->input->post();
             if(isset($postData['banner_size']) && $postData['banner_size']!='' && isset($postData['quantity']) && $postData['quantity']!='' && isset($postData['vDaddress']) && $postData['vDaddress']!=''){
                $explode=explode('|',$postData['banner_size']);
                $banner_id=$explode[0];
                $quantity=$postData['quantity'];

                $BannersLists=$this->Banner->getBannersListByID($banner_id);
                $totalPrice=$BannersLists['iAmount'];
                $user_id=$_SESSION['USERID'];
                $itemName=$BannersLists['vBannerSize'].' size banner';
                
                $logo =DOMAIN_URL.'/files/uploads/logo.png';
                $returnURL = DOMAIN_URL.'/'.'banner/success'; //payment success url
                $cancelURL = DOMAIN_URL.'/'.'banner/cancel'; //payment cancel url
                $notifyURL = DOMAIN_URL.'/'.'banner/ipn'; //ipn url
                $custom=$user_id.'|'.$postData['vDaddress'];
                
                $this->paypal_lib->add_field('return', $returnURL);
                $this->paypal_lib->add_field('cancel_return', $cancelURL);
                $this->paypal_lib->add_field('notify_url', $notifyURL);
                $this->paypal_lib->add_field('item_name', $itemName);
                $this->paypal_lib->add_field('quantity', $quantity);      
                $this->paypal_lib->add_field('custom', $custom);
                $this->paypal_lib->add_field('item_number',  $BannersLists['iBannerId']);
                $this->paypal_lib->add_field('amount',  $totalPrice);        
                $this->paypal_lib->image($logo);

                $this->paypal_lib->paypal_auto_form();
                
                
               
             }else{
                $this->viewData['module'] = "errors/front/404";
                $this->load->view('template', $this->viewData);
             }         
        }else{
             $this->session->set_userdata('last_page', 'banner/view');
             redirect('../user/login');
        } 
       
    }
    function success(){
            $paypalInfo = $this->input->post();   
            
            if(isset($paypalInfo['txn_id']) && $paypalInfo['txn_id']!=''){
                $this->Banner->_table=TBL_PAYMENT;
                $paymentData=$this->Banner->CheckPaymentDataByTransactionID($paypalInfo["txn_id"]);
                if(empty($paymentData)){
                      $explode=explode('|',$paypalInfo["custom"]); 
                      $user_id=$explode[0];
                      $delivery_address=$explode[1]; 

                      $data['userWalletamount'] ='0.00'; 
                      $data['txn_id'] = $paypalInfo["txn_id"];
                      $data['currency_code'] = $paypalInfo["mc_currency"];
                      $data['payment_status'] = $paypalInfo["payment_status"];
                      $data['iUserId'] =$user_id;
                      $data['vDaddress']=$delivery_address;
                      $data['iQuantity']=$paypalInfo["quantity"];
                      $data['vPaymentFor'] =PAYMENT_FOR_BANNER;
                      $data['iGarageId'] = '0';
                      $data['iBannerId'] = $paypalInfo["item_number"];
                      $data['payment_gross'] = $paypalInfo["payment_gross"];
                      $data['payment_date'] = date("Y-m-d", strtotime($paypalInfo['payment_date']));
                      $data['payer_email'] = $paypalInfo["payer_email"];
                      $data['vPaymentType'] =PAYMENT_TYPE_PAYPAL;
                      $data['eStatus'] =ACTIVE_STATUS;
                      $data['eDelete'] ='0';
                      $this->Banner->_table=TBL_PAYMENT;
                      $payment_id= $this->Banner->insertRow($data);


                }else{
                    $payment_id=$paymentData['payment_id'];
                }
                if($payment_id>0){
                     redirect('../banner/order_detail/'.$payment_id.''); 
                }else{
                    $this->viewData['module'] = "errors/front/404";
                    $this->load->view('template', $this->viewData);
                }
            }else{
                $this->viewData['module'] = "errors/front/404";
                $this->load->view('template', $this->viewData);
            }   
            
        
    }
    function order_detail($payment_id){
         if($payment_id!=''){
             $PaymentData = $this->Banner->CheckPaymentDataByID($payment_id);
             if(!empty($PaymentData) && isset($_SESSION['USERID']) && $_SESSION['USERID']==$PaymentData['iUserId']){   
              
                   $this->viewData['summaryData'] =$PaymentData;                
                   $this->viewData['is_datatable'] =false;  
                   $this->viewData['title'] = 'Banner Purchase Summary';  
                   $this->viewData['module'] = "front/banner/summary";
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
   
   
    
}

