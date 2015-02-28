<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->load->model(array('country/mdl_country'));
		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/country/index');
		$config['uri_segment'] = 4;
		$config['per_page'] = 20; 
		$page['start'] = $this->uri->segment( $config['uri_segment'] ) ;
		$page['limit'] = $config['per_page'] ;
		$list = $this->mdl_country->getCountryList();
		$countries = $list['countries'];
		$config['total_rows'] = $list['total'];
		
		$this->pagination->initialize($config); 
		
		$navigation = $this->pagination->create_links();
		
		$this->template->set_breadcrumb('Country');
		$this->template->title('Country');
		
		$data = array(
					  'countries'=>$countries,
					  'navigation'=>$navigation
					  );
		$this->template->build('country/index',$data);
	}
	function add($country_id = 0){
		$this->form_validation->set_rules('country_name','Country Name','required');
		$this->load->model(array('country/mdl_country'));
			if($this->form_validation->run()==FALSE){
			$this->template->set_breadcrumb('Add Country');
			$this->template->title('Add Country');	
			$country = $this->mdl_country->getCountryDetails($country_id);
			$data = array(
						'country'=>$country
					);
			$this->template->build('country/add',$data);
		}else{
			$country_id = $this->input->post('country_id');
			$country_name = $this->input->post('country_name');
			$country_code = $this->input->post('country_code');
			
			$data = array(
				'country_name'=>$country_name,
				'country_code'=>$country_code
			);
			if((int)$country_id==0){
				$data['country_created_by'] = $this->session->userdata('user_id');
				$data['country_created_ts'] = date('Y-m-d H:i:s');
			}else{
				$data['country_modified_by'] = $this->session->userdata('user_id');
				$data['country_modified_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_country->save($data,$country_id)){
				$this->session->set_flashdata('success_save','Country saved successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','Country could not be deleted.');
			}
			redirect('admin/country');
		}
	}
	function edit($country_id = 0){
		$this->add($country_id);
	}
	function delete(){
		$this->form_validation->set_rules('country_id');
		if($this->form_validation->run()==FALSE){
			
		}else{
			$this->load->model(array('country/mdl_country'));
			$country_id = $this->input->post('country_id');
			if($this->mdl_country->delete(array('country_id'=>$country_id))){
				$this->session->set_flashdata('success_save','Country delete successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','Country could not be deleted.');
			}
			redirect('admin/country');
		}
	}
}
?>