<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
        $this->lang->load('googleads',  $this->mdl_mcb_data->setting('language'));
	}
	function index(){
		$this->load->model(array('googleads/mdl_googleads'));
		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/googleads/index');
		$config['uri_segment'] = 4;
		$config['per_page'] = 20; 
		$page['start'] = $this->uri->segment( $config['uri_segment'] ) ;
		$page['limit'] = $config['per_page'] ;
		$list = $this->mdl_googleads->getGoogleAdList($page);
		$googleads =$list['googleads'];
		
		$config['total_rows'] = $list['total'];
		
		$this->pagination->initialize($config); 
		
		$this->template->set_breadcrumb('Google Ads');
		$this->template->title('Google Ads');
		$navigation = $this->pagination->create_links();
		$data = array(
					  'googleads'=>$googleads,
					  'navigation'=>$navigation
					  );
		$this->template->build('googleads/index',$data);
	}
	function add($google_ad_id = 0){
		$this->form_validation->set_rules('google_ad_title','Google Ad Title','required');
		if($this->form_validation->run()==FALSE){
			$this->template->set_breadcrumb('Google Ads',site_url('admin/googleads'));
			$this->template->title('Google Ads');
			$this->template->set_breadcrumb('Add Google Ad');
			$this->template->title('Add Google Ad');
			$this->load->model(array('googleads/mdl_googleads','pages/mdl_pages', 'utilities/mdl_html'));
			$google_ad = $this->mdl_googleads->getGoogleAdDetails($google_ad_id);
			
			$statusOptions = array();
	        array_unshift($statusOptions, $this->mdl_html->option( '0', 'No'));
			array_unshift($statusOptions, $this->mdl_html->option( '1', 'Yes'));
	        $status_select = $this->mdl_html->genericlist( $statusOptions, "google_ad_active",array('class'=>'show_fb_comment validate[required]'),'value','text',set_value('google_ad_active',$google_ad->google_ad_active));

	        $pageOptions = $this->mdl_pages->getPageSlugOptions();
	        array_unshift($pageOptions, $this->mdl_html->option( 'postads', 'Classified Page'));
	        array_unshift($pageOptions, $this->mdl_html->option( 'articles', 'Article Page'));
	        array_unshift($pageOptions, $this->mdl_html->option( '', 'Select Page'));
	        $page_select = $this->mdl_html->genericlist( $pageOptions, "page",array('class'=>'page validate[required]'),'value','text',set_value('google_ad_active',$google_ad->page));
	        
	        $data = array(
						'google_ad'=>$google_ad,
						'status_select'=>$status_select,
	        			'page_select'=>$page_select
					);
			$this->template->build('googleads/add',$data);
		}else{
			$this->load->model(array('googleads/mdl_googleads'));			
			$google_ad_id = $this->input->post('google_ad_id');
			$google_ad_title = $this->input->post('google_ad_title');
			$google_ad_active = $this->input->post('google_ad_active');
			$google_ad_html = $_REQUEST['google_ad_html'];
			$page = $this->input->post('page');
			$data = array(
				'google_ad_title'=>$google_ad_title,
				'google_ad_active'=>$google_ad_active,
				'google_ad_html'=>$google_ad_html,
				'page'=>$page
			);			
			
			if((int)$google_ad_id==0){
				$data['google_ad_created_by'] = $this->session->userdata('user_id');
				$data['google_ad_created_ts'] = date('Y-m-d H:i:s');
			}else{
				$data['google_ad_modified_by'] = $this->session->userdata('user_id');
				$data['google_ad_modified_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_googleads->save($data,$google_ad_id)){
				$this->session->set_flashdata('success_save','Google ads saved successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','Google ads could not be saved.');
			}
			redirect('admin/googleads');
		}
	}
	function edit($google_ad_id = 0){
		$this->add($google_ad_id);
	}
	function delete(){
		$this->form_validation->set_rules('state_id');
		if($this->form_validation->run()==FALSE){
			
		}else{
			$this->load->model(array('state/mdl_state'));
			$state_id = $this->input->post('state_id');
			if($this->mdl_state->delete(array('state_id'=>$state_id))){
				$this->session->set_flashdata('success_save','State delete successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','State could not be deleted.');
			}
			redirect('admin/googleads');
		}
	}
}
?>