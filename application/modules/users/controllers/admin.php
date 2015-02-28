<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {
	function __construct(){
		parent::__construct();
		$this->_user_id = 0;
		$this->lang->load('users', $this->session->userdata('language'));
	}
	public function index()
	{
		$data = array();
		$this->load->helper('url');
		$this->load->model(array('users/mdl_users'));
		$users = $this->mdl_users->getUserlist();
		$data['message'] = 'Hello World!';
		$data['users'] = $users;
		$this->template->set_breadcrumb($this->lang->line('users'));
		$this->template->title('Users');
		$this->template->set_theme('admin');
		$this->template->set_layout('admin')->build('admin/users', $data);
	}
	function create(){
		$this->load->library(array('form_validation'));
		$this->load->model(array('users/mdl_users'));
		$this->form_validation->set_rules('username','<b>'.$this->lang->line('username').'</b>','required');
		if($this->_user_id==0){
			$this->form_validation->set_rules('password', '<b>Password</b>', 'trim|required|matches[cpassword]|md5');
		}else{
		}
		if($this->input->post('password')){
				$this->form_validation->set_rules('password', '<b>Password</b>', 'trim|required|matches[cpassword]|md5');
				$this->form_validation->set_rules('cpassword', '<b>Password Confirmation</b>', 'trim|required');			
			}
		$this->form_validation->set_rules('email', '<b>Email</b>', 'required|valid_email[ci_users.email]');
		
		if($this->form_validation->run()== FALSE){			
			$user_details = $this->mdl_users->getUserDetails($this->_user_id);
			$data = array(
				'user_details'=>$user_details
			);
			$this->template->set_breadcrumb($this->lang->line('users'),site_url().'admin/users');
			$this->template->set_breadcrumb($this->_user_id?'Edit':'Create');
			
			$this->template->title('User');
			$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/jquery.iphone.toggle.css" />');
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/plugins/forms/jquery.uniform.js"></script>');
			$this->template->build('admin/create',$data);
		}else{
			$user_id = $this->input->post('user_id');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$active = ($this->input->post('user_active')=='on')?1:0;
			
			$data = array(
					'username'=>$username,
					'email'=>$email,
					'active'=>$active
					);
			if($password){
				$data['password'] = $password;
			}	
			if($this->mdl_users->save($data,$user_id)){
				$this->session->set_flashdata('success_save',$this->lang->line('save_success'));
			}
			redirect('admin/users');
		}
	}
	public function edit($user_id = 0)
	{
		$this->_user_id = $user_id;
		$this->create();
	}
	function delete(){
		$this->form_validation->set_rules('User','user_id','required');
		if($this->form_validation->run($this)){
			$this->index();
		}else{
			$user_id = $this->input->post('user_id');
			$this->load->model(array('users/mdl_users'));
			if($this->mdl_users->delete(array('user_id'=>$user_id))){
				$this->session->set_flashdata('success_save','User deleted successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','User could not be deleted.');
			}
			redirect('admin/users');
		}
	}
}