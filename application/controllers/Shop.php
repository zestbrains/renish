<?php
error_reporting(0);
class Shop extends Front_Controller_without_login {

    public $viewData = array();
    function __construct() {
        parent::__construct();
        $this->load->model('garage_model', 'Garage');
        $this->load->model('setting_model', 'Setting');

        $this->load->model('user_model', 'User');
    }

   function create()
    {
      
        if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=''){
            
            $this->User->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iUserId'=>$_SESSION['USERID']);
            $UserData = $this->User->getRecordsByID();    

            $this->Garage->_where = array("eDelete" =>'0',"eStatus" =>ACTIVE_STATUS,'iUserId'=>$_SESSION['USERID']);
            $GarageData = $this->Garage->getRecordsByID();  
           // pre($GarageData);
            if(!empty($GarageData)){
                $this->viewData['GarageImages']= $this->Garage->garage_images($GarageData['iGarageId']);  
                              

                $this->viewData['states'] = $this->Setting->get_States($GarageData['iCountryId']);

                $this->viewData['cities'] = $this->Setting->get_Cities($GarageData['iStateId']);
            }
            $this->viewData['discouts'] = $this->Setting->get_Discount();

            // pre($this->viewData);
            $this->viewData['countries'] = $this->Setting->get_Country();
            $this->viewData['UserData'] =$UserData;
            $this->viewData['GarageData'] =$GarageData;
            $this->viewData['title'] ='My Shop';  
            $this->viewData['module'] = "front/shop/create";
            $this->load->view('template', $this->viewData);
        }else{
            echo 1; exit;
        }
    }
    function save_garage_data()
    {
       // pre($_POST);
            $iGarageId='';
            $this->viewData['title'] ='Garage Creation';    
            $this->form_validation->set_rules($this->garage_data_rules());
            if ($this->form_validation->run() == TRUE ) {
                 echo $this->lang->line("mendatory_fields");
            }else{ 
                $postData=  $this->input->post();
                $modifiedsData=$this->working_hours_json($postData);
                $postData=array();
                $postData=$modifiedsData['postData'];
                $postData['tWorkingHour']=$modifiedsData['working_hours'];
                $postData['iUserId']=$_SESSION['USERID'];
                $postData['iCountryId']=DEFAULT_COUNTRY;
                $postData['iCityId']="19452";
                $postData['vAddress']=$postData['vAddress'].' '.$postData['vAddress_second'];
                unset($postData['vAddress_second']);
               // pre($postData);
                if($postData['iGarageId']!=''){
                    $iGarageId=$postData['iGarageId'];
                    unset($postData['iGarageId']);
                }
                $is_cover_image=$postData['is_cover_image'];
                 unset($postData['is_cover_image']);
                
                
               
                //pre($postData);
                $UpdatedID= $this->Garage->insertRow($postData,'iGarageId',$iGarageId);
                $postData=array();
              //  echo $is_cover_image;
                    if($_FILES['vCoverImage']['name']!='' || $is_cover_image==1){                   

                        $file_upload = $this->saveFile('vCoverImage', GARAGE_UPLOAD_URL . $UpdatedID . '/');                                          
                        if ($file_upload['file_name'] != "") {
                                    $postArray = array();
                                    $postArray['vCoverImage'] = GARAGE_UPLOAD_URL . $UpdatedID . '/' . $file_upload['file_name'];                                                
                                    $this->Garage->insertRow($postArray,'iGarageId',$UpdatedID);                                                        


                        } 
                    }
                   
                    
                    if(isset($_FILES['file']) && $_FILES['file']!=''){
                        $aImageType = array('image/jpeg','image/jpg','image/png');                      
                        foreach($_FILES['file']['name'] as $key => $files)
                        {

                            $_FILES['image']['name'] = $_FILES['file']['name'][$key];
                            $_FILES['image']['type'] = $_FILES['file']['type'][$key];
                            $_FILES['image']['tmp_name'] = $_FILES['file']['tmp_name'][$key];
                            $_FILES['image']['error'] = $_FILES['file']['error'][$key];
                            $_FILES['image']['size'] = $_FILES['file']['size'][$key];

                            if($_FILES['image']['size'] <= 2048000 && $_FILES['image']['name']!="" && in_array($_FILES['image']['type'],$aImageType))
                            {
                                $file_uploads = parent::saveFile('image', GARAGE_UPLOAD_URL . $UpdatedID . '/');

                                if ($file_uploads['file_name'] != "") {
                                            $postArray = array();
                                            $postArray['vImage'] = GARAGE_UPLOAD_URL . $UpdatedID . '/' . $file_uploads['file_name'];
                                            $postArray['iGarageId'] = $UpdatedID; 
                                            $postArray['vType'] = 'i';   
                                            $this->Garage->_table=TBL_GARAGE_IMAGE;    
                                            $this->Garage->insertRow($postArray);                                    

                                } 
                            }

                        }
                    }
                    
                  echo 'successfully!!';  
                    
                    
               
            }
            exit;
    }
     function delete_garage_images()
    {
         
        if(isset($_POST['iImageId']) && $_POST['iImageId']!=''){
            $this->Garage->_table =TBL_GARAGE_IMAGE;
            $imagesID= $this->Garage->insertRow(array('eDelete'=>'1'),'iImageId',$_POST['iImageId']);
            //echo $this->db->last_query();
            if($imagesID>0){
                echo 'succssfully';
            }else{
                echo 'Please try again later!';
            }
        }else{
            echo 'Invalid Image data';
        }
        exit;         
                 
        
    }
    
    
    protected function working_hours_json($postData){
        $dayMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        for($i=0;$i<count($dayMap);$i++){
            $day=$dayMap[$i];
            $start_time=$day.'_start_time';
            $end_time=$day.'_end_time';
            if($postData[$start_time]!='' && $postData[$end_time]!=''){
                 $data=array('day'=>$day,'start'=>$postData[$start_time],'end'=>$postData[$end_time],'is_working'=>1);
            }else{
                $data=array('day'=>$day,'start'=>'0:00','end'=>'0:00','is_working'=>0);
            }
            unset($postData[$start_time]);
            unset($postData[$end_time]);
            $result[]=$data;
        }
        return array('postData'=>$postData,'working_hours'=>json_encode($result));
        //echo count($dayMap);
       // $data[]=array('day'=>'Sunday','start'=>$postData['mon_start_time'],'start'=>$postData['mon_start_time'],'start'=>1);
    }
    public function lists($type=NULL){
            $offset='';
            $search='';
            $discount='';
            if($type==AUTO_SHOP){
                $typeID=1;
            }elseif(($type==BODY_SHOP)){
                $typeID=2;
            }
           
            $this->Garage->_where = array();
            //for load more and filter in listing page
            if(isset($_POST) && !empty($_POST) && isset($_POST['page'])!=''){
                $postData=  $this->input->post();
                
                if($postData['dataByType']=='loadmore'){
                    if($postData['page']==1){
                        $offset=OFFSET;
                    }else{
                        $offset=OFFSET + (($postData['page'] - 1) * LIMIT);
                    } 
                }
                $GarageData = $this->Garage->getAllData($typeID,LIMIT,$offset,$postData['search'],$postData['discount']);                
                $GarageData=$this->calculate_avg_ratting($GarageData); 
               
                $this->viewData['GarageData'] =$GarageData;                
                $this->viewData['list_html']=$this->load->view('front/shop/garage_data',$this->viewData, TRUE); 
                if(!empty($this->viewData['list_html'])){
                    echo $this->viewData['list_html'];
                }else{
                    echo '';
                }                
                exit;
            }
            //get data using zipcode
            elseif(isset($_POST) && !empty($_POST) && isset($_POST['page'])==''){
                 $postData=  $this->input->post();
                 $search=$postData['search'];
                 
                 $GarageData = $this->Garage->getAllData($typeID,LIMIT,$offset,$search,$discount);
                 $GarageData=$this->calculate_avg_ratting($GarageData);
                 $this->viewData['GarageData'] =$GarageData;
                 $this->viewData['list_html']=$this->load->view('front/shop/garage_data',$this->viewData, TRUE);
                 if(empty($GarageData)){
                     $this->viewData['list_html']='';
                 }
            }
            //its display default data while load page
            else{               
                $GarageData = $this->Garage->getAllData($typeID,LIMIT,$offset,$search,$discount);                 
                $GarageData=$this->calculate_avg_ratting($GarageData);
                $this->viewData['GarageData'] =$GarageData;
                $this->viewData['list_html']=$this->load->view('front/shop/garage_data',$this->viewData, TRUE);
            }
           
            
            
            $this->viewData['discouts'] = $this->Setting->get_Discount();
            $this->viewData['module'] = "front/shop/lists";
            $this->viewData['page_type'] =$type;
            $this->viewData['search'] =$search;
            $this->viewData['title'] ='Shops List';  
            $this->load->view('template', $this->viewData);
       
        
    }
    public function detail($garageID){
        if($garageID!=''){ 
           $GarageData = $this->Garage->getGarageDataByID($garageID);
          // pre($GarageData);
           if(!empty($GarageData)){
                $this->viewData['GarageImages']= $this->Garage->garage_images($GarageData['iGarageId']);  
                $this->viewData['GarageComments']= $this->Garage->garage_comments($GarageData['iGarageId'],LIMIT,''); 
                $GarageRatting=$this->calculate_avg_ratting('',$GarageData['iGarageId']); 
                $this->viewData['comment_listing']=$this->load->view('front/shop/comments_data',$this->viewData, TRUE);
                $this->viewData['comment_count']=count($this->viewData['GarageComments']);
               // pre($GarageRatting);
               
                $this->viewData['GarageData'] =$GarageData;
                $this->viewData['GarageRatting']=$GarageRatting;
                $this->viewData['iGarageId'] =$garageID;
                $this->viewData['is_loadmore'] =$is_loadmore;
                $this->viewData['module'] = "front/shop/detailview"; 
                $this->viewData['title'] ='Shop Detail';  
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
    public function more_comments(){
        if(isset($_POST) && !empty($_POST) && isset($_POST['page'])!=''){
            $postData=  $this->input->post();
            if($postData['page']==1){
                 $offset=OFFSET;
             }else{
                 $offset=OFFSET + (($postData['page'] - 1) * LIMIT);
             } 
             $this->viewData['GarageComments']= $this->Garage->garage_comments($postData['iGarageId'],LIMIT,$offset);  
             if(!empty($this->viewData['GarageComments'])){
                echo $this->load->view('front/shop/comments_data',$this->viewData, TRUE);
             }else{
                 echo '';
             }   
             exit;
        }else{
            echo '';
        }
        exit;
    }
    protected function calculate_avg_ratting($GarageData='',$iGarageId=''){
      if($GarageData!=''){
        for($i=0;$i<count($GarageData);$i++){
                $GarageRatting=$this->Garage->cal_ratting($GarageData[$i]['iGarageId']); 
                if(!empty($GarageRatting)){
                    $j=1;
                    for($k=0;$k<5;$k++){
                        if($GarageRatting[$k]['votes_count']){
                            $star[]=$GarageRatting[$k]['votes_count'];
                        }else{
                            $star[]=0;
                        }
                        $j++;
                    }                   
                    $total_votes=$star[0]+$star[1]+$star[2]+$star[3]+$star[4];    
                    $GarageData[$i]['AvgRating']= floor(($star[0] + ($star[1] * 2) + ($star[2] * 3) + ($star[3] * 4) + ($star[4] * 5)) / $total_votes); 
                }else{
                    $GarageData[$i]['AvgRating']=0; 
                }    
        } 
         return $GarageData;
      }else{
          $GarageRatting=$this->Garage->cal_ratting($iGarageId);
          if(!empty($GarageRatting)){
                    $j=1;
                    for($k=0;$k<5;$k++){
                        if($GarageRatting[$k]['votes_count']){
                            $star[]=$GarageRatting[$k]['votes_count'];
                        }else{
                            $star[]=0;
                        }
                        $j++;
                    }                   
                    $total_votes=$star[0]+$star[1]+$star[2]+$star[3]+$star[4];    
                    $AvgRating= floor(($star[0] + ($star[1] * 2) + ($star[2] * 3) + ($star[3] * 4) + ($star[4] * 5)) / $total_votes); 
                    return array('star'=>$star,'avg_ratting'=>$AvgRating);
            }else{
                 return array('star'=>0,'avg_ratting'=>0);
            }  
        
      }  
       
    }
   protected function garage_data_rules() {
		$rules = array(
			array(
				'field' => 'vGarageType',
				'label' =>'vGarageType',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vGarageName',
				'label' => 'vGarageName',
				'rules' => 'trim|required|xss_clean',
			),
			array(
				'field' => 'vAddress',
				'label' => 'vAddress',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vZipCode',
				'label' => 'vZipCode',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'vCityName',
				'label' => 'vCityName',
				'rules' => 'trim|required|xss_clean',
			),
                       array(
				'field' => 'iStateId',
				'label' =>'iStateId',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'iCountryId',
				'label' => 'iCountryId',
				'rules' => 'trim|required|xss_clean',
			),
			array(
				'field' => 'vMobile',
				'label' => 'vMobile',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'tDescription',
				'label' => 'tDescription',
				'rules' => 'trim|required|xss_clean',
			),
                        array(
				'field' => 'iTotalMechanic',
				'label' => 'iTotalMechanic',
				'rules' => 'trim|required|xss_clean',
			)
		);
		return $rules;
   }
  
   
}

