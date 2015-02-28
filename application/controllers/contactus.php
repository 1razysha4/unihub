<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('template');
        $this->load->model('contact_model');
       
    }

    public function index(){
        $data['title'] = "Contact Us";
        $this->load->view('contactus/index',$data);

    }
    
    public function save(){
        if(isset($_POST)){
           $result = $this->contact_model->savedata($_POST);
           print_r($result);
           die();
        }
    }
  
    

}
