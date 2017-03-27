<?php
error_reporting(0);
class User extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
         $this->load->model('order_model', 'Order');
        $postData=array();
    }
   function login()
    { 
        if(isset($_SESSION['last_page']) && $_SESSION['last_page']!=''){ 
            $this->viewData['last_page'] = $_SESSION['last_page'];
        }else{
            $this->viewData['last_page'] = "home";
        }
        unset($_SESSION['last_page']);       
        $this->viewData['title'] = "Login";  
        $this->viewData['module'] = "front/login";
        $this->viewData['is_datatable'] =false;  
        $this->load->view('template', $this->viewData);
    }
    function register($IsPageType=NULL)
    {
        //echo $IsPageType; exit;  
    
      if($_SESSION['USERID']=='' || $_SESSION['USER_TYPE']==VEHICLE_OWNER || ($_SESSION['USER_TYPE']==SHOP_OWNER && $_SESSION['ACTIVATION_PENDING']==TRUE)){             
            if($IsPageType=='vehicle'){
                $this->viewData['last_page']='home';
                $this->viewData['heading']=VEHICLE_HEADING;
                $this->viewData['semi_heading']=VEHICLE_SEMI_HEADING;
                $this->viewData['user_type']=VEHICLE_OWNER;                
                $this->viewData['is_invitation']=true;
                
            }elseif($IsPageType=='shop'){
                $this->viewData['last_page']='shop/create';
                $this->viewData['heading']=SHOP_HEADING;
                $this->viewData['semi_heading']=SHOP_SEMI_HEADING;
                $this->viewData['user_type']=SHOP_OWNER;                
                $this->viewData['is_invitation']=false;
            }
          // $this->viewData['is_activation_pending']=$_SESSION['ACTIVATION_PENDING'] ? $_SESSION['ACTIVATION_PENDING'] : FALSE;
            $this->viewData['title'] = "Create Account";  
            $this->viewData['is_datatable'] =false;  
            $this->viewData['module'] = "front/register";
            $this->load->view('template', $this->viewData);
      }else{
           redirect('../home');
      }
    }
    public function CheckLogin(){
        $this->viewData['title'] = $this->lang->line("LOGIN");
        $postData=  $this->input->post();   
        if($this->input->post("email")!=''  && $this->input->post("password")!='') {   
           
            $res = $this->User->checkLogin($postData);
            if ($res == 1) {                                       
                echo $this->lang->line("succ_login");
            } else {                       
                echo $this->lang->line("err_login");  
            }
         
        }else{
            echo $this->lang->line("err_login");
        }
        exit;
        
    }
      public function Registration(){
          
            $this->viewData['title'] ='User Registration';    
            $this->form_validation->set_rules($this->user_registration_data_rules());
            if ($this->form_validation->run() == TRUE && $this->input->post("vPassword")==$this->input->post("vPassword_confirm")) {
                    echo $this->lang->line("mendatory_fields");
            }else{        
             $checkEmail=$this->User->checkAdminEmailAvailable($this->input->post("vEmail")); 
             
              if($checkEmail==0){
                $userData=$this->User->getUserDataByEmail($this->input->post("vEmail")); 
                if(!empty($userData)){
                   $checkEmail=1; 
                }
              }
                    if($checkEmail==1){
                            $postData=  $this->input->post();  
                           
                              
                            $postData['vName']=$postData['vFirstName'].' '.$postData['vLastName'];
                            $postData['eDelete']='0';
                            $postData['vPassword']=md5($postData['vPassword']);
                            $postData['dCreatedDate']=date('Y-m-d h:i:s');
                            $postData['dModifyDate']=date('Y-m-d h:i:s');
                            $postData['vProfileImage']=USER_DP_URL.PROFILE_DP;
                            
                            unset($postData['vFirstName']);
                            unset($postData['vPassword_confirm']);
                            unset($postData['vLastName']);
                            
                            if($postData['eUserRole']==SHOP_OWNER){
                                $postData['eStatus']=INACTIVE_STATUS;
                                //$postData['eStatus']=ACTIVE_STATUS;
                                $postData['vActivationToken']=$this->FourDegitCode();                                
                            }else{
                                $postData['eStatus']=ACTIVE_STATUS;                                
                            }                           
                             
                            $res = $this->User->insertRow($postData,'iUserId',$userData['iUserId']);                               
                          
                           if ($res>0) { 
                               $userdata = array(
                                          'USERID' => $res,
                                          'USEREMAIL' => $postData['vEmail'],
                                          'USERNAME' =>$postData['vName'],
                                          'ZIPCODE' =>$postData['vPinCode'],
                                          'USER_TYPE' =>$postData['eUserRole'],                                                                        
                                           'USERWALLET' =>0,
                                          'USERIMAGE' =>DOMAIN_URL.USER_DP_URL.PROFILE_DP
                                );
                               
                                if($postData['eUserRole']==SHOP_OWNER){
                                      $redirect_mail_url= DOMAIN_URL.'/'.'user/redirect_to_varify?vActivationToken='.$postData['vActivationToken'];                
                                      sendVerificationCode($postData['vEmail'],$postData['vActivationToken'],DOMAIN_URL.'/'.'user/redirect_to_varify/'.$redirect_mail_url);
                                      
                                      $userdata['USERLOGIN']=FALSE;
                                      $userdata['ACTIVATION_PENDING']=TRUE;
                                      
                                }else{
                                      $userdata['USERLOGIN']=TRUE;
                                      $userdata['ACTIVATION_PENDING']=FALSE;                                      
                                } 
                               $this->session->set_userdata($userdata);
                               $data=array('success'=>1,'message'=>'Registration successfully.','vActivationToken'=>$postData['vActivationToken'],'redirect_mail_url'=>DOMAIN_URL.'/'.'user/redirect_to_varify/'.$redirect_mail_url);
                               
                           } else {  
                               $data=array('success'=>0,'message'=>$this->lang->line("err_login"));
                           }
                    }else{
                         $data=array('success'=>0,'message'=>$this->lang->line("err_email_already_exists"));
                    }
            }
        echo json_encode($data);
        exit;
        
    }
     protected function FourDegitCode() {
        $alphabet = '1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
     }
     function resend_activation_code(){
         $postData=  $this->input->post();
         sendVerificationCode($postData['email'],$postData['activation_code'],$postData['redirect_mail_url']);
         echo 1; exit;
     }
     function redirect_to_varify(){
        
         if($_REQUEST['vActivationToken']!=''){
             $postData=$this->User->GetUserDataByVarificationCode($_REQUEST['vActivationToken']); 
                     $userdata = array(
                                    'USERID' => $postData['iUserId'],
                                    'USEREMAIL' => $postData['vEmail'],
                                    'USERNAME' =>$postData['vName'],
                                    'USER_TYPE' =>$postData['eUserRole'],                                                                        
                                    'USERWALLET' =>0,
                                    'USERIMAGE' =>DOMAIN_URL.USER_DP_URL.PROFILE_DP,
                                    'USERLOGIN'=>FALSE,
                                    'ACTIVATION_PENDING'=>TRUE  
                               );
                   
                    redirect('user/register/shop');
         }else{
           
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        
         }
     }
    function CheckVarificationCode(){
            $postData=  $this->input->post();
            $this->form_validation->set_rules($this->CheckVarificationCode_rules());
            if ($this->form_validation->run() == TRUE) {
                    echo $this->lang->line("mendatory_fields");
            }else{
                    $postData['iUserId']=$_SESSION['USERID'];                   
                    $checkVarificationCode=$this->User->checkVarificationCode($postData); 
                    if(!empty($checkVarificationCode)){                        
                        $UpdatedID= $this->User->insertRow(array('eStatus'=>ACTIVE_STATUS,'vActivationToken'=>''),'iUserId',$postData['iUserId']);
                        if ($UpdatedID>0) {                              
                               $userdata = array(
                                          'USERLOGIN' => TRUE,  
                                          'ACTIVATION_PENDING' => FALSE,
                                          'USERID' => $checkVarificationCode['iUserId'],
                                          'USEREMAIL' => $checkVarificationCode['vEmail'],
                                          'USERNAME' =>$checkVarificationCode['vName'],
                                          'USER_TYPE' =>$checkVarificationCode['eUserRole'],                                                                        
                                           'USERWALLET' =>0,
                                          'USERIMAGE' =>DOMAIN_URL.USER_DP_URL.PROFILE_DP
                                );
                               $this->session->set_userdata($userdata);
                               echo 1;
                           } else {                       
                               echo $this->lang->line("err_login");  
                        }
                    }else{
                        echo 'Invalid activation code!!';
                    }
            }
            exit;
    }

    function Subscribtion(){
      if (isset($_POST['action']) && $_POST['action'] == 'check_email') {
        $postData['vEmail'] = $this->input->post('SubEmail');
        $checkEmail=$this->User->checkSubscribeEmail($postData['vEmail']); 
        if($checkEmail==1){
            echo 'true';
        }else{
            echo 'false';
        }
      }
      else if(isset($_POST['action']) && $_POST['action'] == 'submit_email') {
          $this->form_validation->set_rules('SubEmail', 'Email', 'trim|valid_email');
          if ($this->form_validation->run() == FALSE) {
              echo 'Enter Valid E-mail address';
          } else {
            $postData['vEmail'] = $this->input->post('SubEmail');
            $checkEmail=$this->User->checkSubscribeEmail($postData['vEmail']); 
            if($checkEmail==1){
                $postData['dCreatedDate']=date('Y-m-d h:i:s');
                $res = $this->User->insertSubscriber($postData);
                if($res > 0){
                  $this->session->set_userdata('sub','Successfully Subscribe');
                  echo 'success';
                }
                else
                  echo 'Something went wrong';
            } else {                       
                echo 'Email already subscribe';  
            }
          }
      } 
      exit;
    }
     function edit_profile()
    {
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){
            $this->User->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iUserId'=>$_SESSION['USERID']);
            $UserData = $this->User->getRecordsByID();                
          // pre($UserData);
            $this->viewData['UserData'] =$UserData;  
            $this->viewData['title'] = 'Edit Profile'; 
            $this->viewData['is_datatable'] =false;  
            $this->viewData['module'] = "front/edit_profile";
            $this->load->view('template', $this->viewData);
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }
    }
    function save_New_password(){
         $postData=$this->input->post();
         if(isset($_SESSION['USERID']) && $_SESSION['USERID']!='' && isset($postData) && $postData['vOldPassword']!='' && $postData['vPassword']!=''){
             $res = $this->User->checkOldPassword($_SESSION['USERID'],$postData['vOldPassword']);
             if($res==1){
                  $UpdatedID= $this->User->insertRow(array('vPassword'=>md5($postData['vPassword'])),'iUserId',$_SESSION['USERID']); 
                  if($UpdatedID>0){
                      echo 'New Password Successfully Updated!!';
                  }else{
                      echo 'Somethings went wrong,Please try again later!!';
                  }
             }else{
                 echo 'Old password is wrong,please correct it.';
             }
         }else{
            echo 'Somethings went wrong,Please try again later!!';
        }
        exit;
    }
    function save_profile_data(){
        $postData=array();
        $postData=$this->input->post();        
        $this->viewData['title'] ='Edit Profile';  
        $this->form_validation->set_rules($this->user_profile_data_rules());
        if ($this->form_validation->run() != FALSE ) {
            echo $this->lang->line("mendatory_fields");
        }else{           
            
            //unset email because its not editable
            if(isset($postData['vEmail'])){
              unset($postData['vEmail']);
            }
            $postData['vName']=$postData['vFirstName'].' '.$postData['vLastName'];   
            unset($postData['vFirstName']);
            unset($postData['vLastName']);
            
            //unset userid because its only user for update 
            if(isset($postData['iUserId'])){
              $id=$postData['iUserId'];
              unset($postData['iUserId']);
            }
            $postData['dModifyDate']=date('Y-m-d h:i:s'); 
            $UpdatedID= $this->User->insertRow($postData,'iUserId',$id); 
           
            if($UpdatedID==$id && $UpdatedID>0){
                $userdata = array(
                     'USERNAME' =>$postData['vName']
                 );
                
               $file_upload = $this->saveFile('vProfileImage', USER_UPLOAD_URL . $UpdatedID . '/');                                          
                if ($file_upload['file_name'] != "") {
                            $postArray = array();
                            $postArray['vProfileImage'] = USER_DP_URL . $UpdatedID . '/' . $file_upload['file_name'];                                                
                            $this->User->insertRow($postArray,'iUserId',$UpdatedID);  
                            $userdata['USERIMAGE']=DOMAIN_URL.'/'.$postArray['vProfileImage'];


                } 
                
               // STORE SESSION
                $this->session->set_userdata($userdata);
                echo 'Successfully Updated!!';   
            }
            
        }  
        
       exit;
    }
    public function order_history(){
        
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){
            $this->User->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iUserId'=>$_SESSION['USERID']);
            $UserData = $this->User->getRecordsByID();                
          
            $OrderHistoryData = $this->User->getOrdersData($_SESSION['USERID']); 
            
            $totalOrder=$this->User->getTotalPaidAmount($_SESSION['USERID']);
            $totalRefund=$this->User->getTotalRefundAmount($_SESSION['USERID']);
           // pre($OrderHistoryData);
            
            $this->viewData['UserData'] =$UserData; 
            $this->viewData['totalOrder'] =$totalOrder; 
            $this->viewData['totalRefund'] =$totalRefund; 
            $this->viewData['OrderHistoryData'] =$OrderHistoryData;  
            $this->viewData['is_datatable'] =true;  
            $this->viewData['title'] = 'Order history';  
            $this->viewData['module'] = "front/order_history";
            $this->load->view('template', $this->viewData);
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }       
    }
    public function sell_history(){        
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){
             $garageData=$this->User->getGarageDataByUserID($_SESSION['USERID']);            
            if(!empty($garageData)){
                $SellingHistoryData= $this->User->getSellingData($garageData['iGarageId']);
                $totalSell=$this->User->getTotalSellCount($garageData['iGarageId']);

                $this->viewData['SellingData'] =$SellingHistoryData; 
                $this->viewData['totalSell'] =$totalSell; 
            }else{
                $this->viewData['SellingData'] =array(); 
                $this->viewData['totalSell'] =0;  
            }    
                $this->viewData['is_datatable'] =true;  
                $this->viewData['title'] = 'Selling history';  
                $this->viewData['module'] = "front/sell_history";
                $this->load->view('template', $this->viewData);
        }
        else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }  
    }    
    public function save_comment(){
       $postData=$this->input->post();
       if(isset($postData) && !empty($postData)){
            $this->User->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iGarageId'=>$postData['iGarageId'],'iUserId'=>$postData['iUserId'],'txn_id'=>$postData['txn_id']);
            //$this->User->_table=TBL_GARAGE_COMMENTS;
           // $commentsData = $this->User->getRecordsByID();
           
                $refund_wallet_money=$postData['refund'];
                unset($postData['refund']);
                
                $postData['eDelete']='0';
                $postData['eIsLike']='0';
                $postData['eIsFavourite']='0';
                $postData['iRefundAmount']=$refund_wallet_money;
                $postData['eStatus']=ACTIVE_STATUS;
                
                if($postData['iCommentId']==''){                    
                  $postData['dCreatedDate']=date("Y-m-d h:i:s");
                }
                
                $this->User->_table=TBL_GARAGE_COMMENTS;
                $commentID = $this->User->insertRow($postData,'iCommentId',$postData['iCommentId']);                
                if($commentID>0){
                    $this->Order->AddUserWallet($postData['iUserId'],$refund_wallet_money);
                    echo 1;
                }else{
                    echo 04;
                }
            
       }else{
            echo 3430; 
       }
       exit;
    }
    public function change_psw(){      
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){
             $this->User->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iUserId'=>$_SESSION['USERID']);
             $UserData = $this->User->getRecordsByID();                
          // pre($UserData);
            $this->viewData['UserData'] =$UserData;  
            
            $this->viewData['title'] = 'Change password'; 
            $this->viewData['is_datatable'] =false;  
            $this->viewData['module'] = "front/change_password";
            $this->load->view('template', $this->viewData);
        }else{
            $this->viewData['module'] = "errors/front/404";
            $this->load->view('template', $this->viewData);
        }
    }

    public function logout(){
          $this->session->unset_userdata("USER");
          $this->session->sess_destroy();
          delete_cookie(md5('loggedin'));
          redirect('home', 'refresh');
    }
   protected function user_registration_data_rules() {
		$rules = array(
			array(
				'field' => 'vFirstName',
				'label' =>'name',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vLastName',
				'label' =>'name',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vPinCode',
				'label' => 'Zipcode',
				'rules' => 'trim|required|xss_clean',
			),
			array(
				'field' => 'vEmail',
				'label' => 'email',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vPassword',
				'label' => 'vPassword',
				'rules' => 'trim|required|xss_clean',
			),
                       array(
				'field' => 'vPassword_confirm',
				'label' => 'vPassword_confirm',
				'rules' => 'trim|required|xss_clean',
			)
		);
		return $rules;
   }
   protected function user_profile_data_rules() {
		$rules = array(
			array(
				'field' => 'vFirstName',
				'label' =>'name',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vLastName',
				'label' =>'name',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vPinCode',
				'label' => 'vPinCode',
				'rules' => 'trim|required|xss_clean',
			),
			array(
				'field' => 'vEmail',
				'label' => 'vEmail',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'iUserId',
				'label' => 'iUserId',
				'rules' => 'trim|required|xss_clean',
			)
		);
		return $rules;
   }
   protected function CheckVarificationCode_rules() {
		$rules = array(
			array(
				'field' => 'vActivationToken',
				'label' =>'vActivationToken',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'iUserId',
				'label' =>'iUserId',
				'rules' => 'trim|required|xss_clean',
			)
		);
		return $rules;
   }
}

