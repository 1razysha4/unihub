<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('pages', $this->session->userdata('language'));
	}
	public function index()
	{		
		$data = array();
		$this->load->helper('url');
		$this->load->model('pages/mdl_pages');
		$pages = $this->mdl_pages->getPageList();
		$data['pages'] = $pages;
		$this->template->set_breadcrumb($this->lang->line('page'),'');			  		
		$this->template->title($this->lang->line('pages'));		
		$this->template->set_layout('admin')->build('admin/pages', $data);
	}
	function create($page_id=0){
		$data = array();
		$this->load->library('form_validation');
		$this->load->model(array('pages/mdl_pages','utilities/mdl_html'));
		$this->form_validation->set_rules('page_name','Page title is required','required');
		$this->form_validation->set_rules('page_slug','Page Slug is required','ltrim|rtrim|required');
		
		if($this->form_validation->run()==FALSE){
			$page_details = $this->mdl_pages->getPageDetails($page_id);
			$data['page_details'] = $page_details;
			$statusOptions = array();
	        array_unshift($statusOptions, $this->mdl_html->option( '0', 'No'));
			array_unshift($statusOptions, $this->mdl_html->option( '1', 'Yes'));
	        $status_select = $this->mdl_html->genericlist( $statusOptions, "show_fb_comment",array('class'=>'show_fb_comment validate[required]'),'value','text',set_value('show_fb_comment',$page_details[0]->show_fb_comment));
			$data['status_select'] = $status_select;
			
			$google_ad_select = $this->mdl_html->genericlist( $statusOptions, "show_google_ad",array('class'=>'show_google_ad validate[required]'),'value','text',set_value('show_google_ad',$page_details[0]->show_google_ad));
			$data['google_ad_select'] = $google_ad_select;
			
			$this->template->title($this->lang->line('page'));
			$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/jquery.iphone.toggle.css" />');
		
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/tiny_mce/tiny_mce.js"></script>');
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/jquery.iphone.toggle.js"></script>');
			$this->template->build('admin/create_page',$data);
		}else{
			if($this->input->post('page_active')=='on'){
				$data['page_active'] = 1; 
			}else{
				$data['page_active'] = 0;
			}
			$data['page_name'] = $this->input->post('page_name');
			$data['page_order'] = $this->input->post('page_order');
			$data['show_google_ad'] = $this->input->post('show_google_ad');
			$data['google_ad_html'] = $_REQUEST['google_ad_html'];
			//$data['page_slug'] = str_replace(' ','_',str_replace('-','_',$this->input->post('page_slug')));
			$data['page_slug'] = strtolower(str_replace(" ",'-',$this->input->post('page_slug')));
			$data['page_description'] = $this->input->post('page_description');
			$data['page_type'] = $this->input->post('page_type');
			$data['show_fb_comment'] = $this->input->post('show_fb_comment');
			if($page_id>0){
				$data['page_modified_by'] = $this->session->userdata('user_id');
				$data['page_modified_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_pages->save($data,$page_id)){
				$this->session->set_flashdata('success_save',$this->lang->line('this_item_has_been_saved'));
			}else{
				$this->session->set_flashdata('success_save',$this->lang->line('this_item_could_not_be_saved'));
			}
			redirect('admin/pages');
		}
	}
	function edit($page_id){
		$this->create($page_id);
	}
	function delete($page_id){
		$this->load->model('mdl_pages');
		if($this->mdl_pages->delete(array('page_id'=>$page_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('failure_delete','unable to delete');
		}
		redirect('admin/pages');
		
	}
}