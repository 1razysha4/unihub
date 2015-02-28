<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class User_Controller extends Public_Controller {
	public static $is_loaded;
	function __construct() {
            parent::__construct();
            $this->load->helper('url');
            if(!$this->session->userdata('user_id')) {
                if($this->input->is_ajax_request()==1){
                    //echo $this->load->view('users/check_login_session');
                    //die();
                }
                $this->load->library('encrypt');
                redirect('login?return='.$this->encrypt->encode($this->uri->uri_string()));
            }
			$this->template->set_partial('googleads','blocks/googleads');
            if (!isset(self::$is_loaded)) {
                self::$is_loaded = TRUE;
                $this->load->database();
                $this->load->library(array('form_validation'));
                $this->load->model(array('mcb_data/mdl_mcb_data','mcb_data/mdl_mcb_userdata'));
                $this->mdl_mcb_data->set_session_data();
                $this->load->language('default','english');                    
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            }
	}
}

?>