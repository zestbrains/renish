<?php
class Blog extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
    }

     function index()
    {
      
        $this->viewData['title'] = 'Blog';  
        $this->viewData['module'] = "front/blog";
       
        $this->viewData['is_datatable'] =false;  
        $this->load->view('template', $this->viewData);
    }
  
    
 
}

