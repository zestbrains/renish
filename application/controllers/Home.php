<?php
class Home extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
    }
	
   function index()
    {
        $this->viewData['title'] = lang("HOME_PAGE_TITLE");  
        $this->viewData['module'] = "front/home";
        $this->viewData['is_datatable'] =false;  
        $this->load->view('template', $this->viewData);
    }
    function body_shop(){
        $this->viewData['title'] = lang("HOME_PAGE_TITLE");
        $this->viewData['is_datatable'] =false;  
        $this->viewData['module'] = "front/body_shop";
        $this->load->view('template', $this->viewData);
    }
    function about_us(){
        $this->viewData['title'] = 'About Us';
        $this->viewData['is_datatable'] =false;  
        $this->viewData['module'] = "front/about_us";
        $this->load->view('template', $this->viewData);
    }
    
}

