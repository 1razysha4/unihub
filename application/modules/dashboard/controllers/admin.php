<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {
	public function index()
	{		
		$data = array();
		$this->load->helper('url');
		$data['message'] = 'Hello World!';
		$this->template->title('Dashboard');
		$this->template->set_breadcrumb('Dashboard');
		$this->template->set_theme('admin');
		
		$this->template->set_layout('admin')->build('dashboard', $data);
	}
	function getonlineusers(){
		$data = array();
		$this->load->view('dashboard/onlineusers',$data);
	}
}
