<?php
class Setting extends Front_Controller_without_login {

   public $viewData = array();
    function __construct() {
        parent::__construct();
        $this->load->model('setting_model', 'Setting');
    }

   public function getState() {
		$states = $this->Setting->get_States($this->input->post('id'));
		$states = json_decode(json_encode($states), True);
		echo json_encode($states);
		exit;
  }
  public function getCity() {
		$cities = $this->Setting->get_Cities($this->input->post('id'));
		$cities = json_decode(json_encode($cities), True);
		echo json_encode($cities);
		exit;
  }
 
    
 
}

