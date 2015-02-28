<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userboard extends User_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('template');
		$this->usergroup_id = 3;
		$this->content_type = 0;
		$this->content_heading = 'Your Ads';
		$this->content_title = 'Ads';
	}
	function index(){
		$this->template->title($this->lang->line('dashboard'));
	        $this->template->set_breadcrumb($this->lang->line('content'));
	        $this->load->model(array('content/mdl_content','category/mdl_category','users/mdl_users'));
	        $contents= $this->mdl_content->getContentListByUser($this->content_type,$this->session->userdata('user_id'));
	        $user = $this->mdl_users->getUserDetails($this->session->userdata('user_id'));
	        $this->load->library('pagination');

		$config['base_url'] = site_url('dashboard');
		$config['uri_segment'] = 2;
		$config['total_rows'] = $contents['total'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config); 
		
		$data = array(
        		'contents'=>$contents['contents'] ,
				'pagination'=>$this->pagination->create_links(),
				'content_heading'=>$this->content_heading,
				'content_title'=>$this->content_title,
				'user'=>$user
        );
	
		$this->template->build('users/dashboard',$data);
	}
	function events(){
		$this->content_type=1;
		$this->content_heading = 'Your Events';
		$this->content_title = 'Event Title';
		$this->index();
	}
	function classified(){
		$this->content_type=2;
		$this->content_heading = 'Your Classified Ads'; 
		$this->content_title = 'Classified Title'; 
		$this->index();
	}
	function threads(){
		$this->content_type=3;
		$this->content_heading = 'Your Threads';
		$this->content_title = 'Thread Title';
		$this->index();
	}
}