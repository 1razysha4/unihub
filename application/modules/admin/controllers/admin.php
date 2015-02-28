<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('session','template'));
		$this->load->database();
        $this->load->helper();
        $this->load->model(array('mcb_data/mdl_mcb_data'));
        $this->load->helper(array('url', 'form'));
    }
    public function index(){
	if (!$this->session->userdata('user_id') && $this->session->userdata('is_admin')==false) {
            redirect('admin/login');
        }else{
        	//echo modules::run('dashboard/admin');
            redirect('admin/dashboard');
        }
    }
    public function login()
    {
    	$this->lang->load('users/users', $this->session->userdata('language'));
		

		$application_title = $this->mdl_mcb_data->set_application_title();
        
		$this->template->title($this->mdl_mcb_data->settings->application_title, 'Admin Login');
        $this->template->set_theme('admin');
		
        $this->load->model('users/mdl_auth');
        if ($this->mdl_auth->validate_login()) {
			if ($user = $this->mdl_auth->auth('ci_users', 'username', 'password', $this->input->post('username'), $this->input->post('password'))) {
                $object_vars = array('user_id','username');
                // set the session variables
                $this->mdl_auth->set_session($user, $object_vars, array('is_admin'=>TRUE,'language'=>$user->language));
                // update the last login field for this user
                $this->mdl_auth->update_timestamp('ci_users', 'user_id', $user->user_id, 'last_visit', date('Y-m-d H:i:s'));
                redirect('admin/dashboard');
            }
        }
        $this->load->view('admin/login');
    }
    function logout() {
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('admin/login');
    }
}

