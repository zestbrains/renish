<?php
class Support extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
    }
	
    function index()
    {
        $this->viewData['title'] = lang("HOME_PAGE_TITLE");  
        $this->viewData['module'] = "front/support_list";
        $this->viewData['is_datatable'] =true;  
        $this->load->view('template', $this->viewData);
    }
	function detail()
    {
        $this->viewData['title'] = lang("HOME_PAGE_TITLE");  
       	$this->viewData['module'] = "front/support_detail";
        $this->viewData['is_datatable'] =true;  
        $this->load->view('template', $this->viewData);
    }
	function add()
    {
        $this->viewData['title'] = lang("HOME_PAGE_TITLE");  
       	$this->viewData['module'] = "front/support";
        $this->viewData['is_datatable'] =false;  
        $this->load->view('template', $this->viewData);
    }    
}

