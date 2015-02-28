<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->load->model(array('state/mdl_state','country/mdl_country'));
		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/state/index');
		$config['uri_segment'] = 4;
		$config['per_page'] = 20; 
		$page['start'] = $this->uri->segment( $config['uri_segment'] ) ;
		$page['limit'] = $config['per_page'] ;
		$list = $this->mdl_state->getStateList($page);
		$states =$list['states'];
		
		$config['total_rows'] = $list['total'];
		
		$this->pagination->initialize($config); 
		
		$this->template->set_breadcrumb('State');
		$this->template->title('State');
		$navigation = $this->pagination->create_links();
		$data = array(
					  'states'=>$states,
					  'navigation'=>$navigation
					  );
		$this->template->build('state/index',$data);
	}
	function add($state_id = 0){
		$this->form_validation->set_rules('state_name','State Name','required');
		if($this->form_validation->run()==FALSE){
			$this->template->set_breadcrumb('Add State');
			$this->template->title('Add State');
			$this->load->model(array('state/mdl_state','country/mdl_country', 'utilities/mdl_html'));
			$state = $this->mdl_state->getStateDetails($state_id);
			
			//select options for country
			$countryOptions = $this->mdl_country->getCountryOptions();
			array_unshift($countryOptions, $this->mdl_html->option( '', 'Select Country'));		
			$country_select = $this->mdl_html->genericlist($countryOptions,'country_id',array('class'=>''),'value','text',$state->country_id);
			//select options for country
			$showOptions = array();
			array_unshift($showOptions, $this->mdl_html->option( '1', 'Yes'));
			array_unshift($showOptions, $this->mdl_html->option( '0', 'No'));	
			$show_select = $this->mdl_html->genericlist($showOptions,'show_front',array('class'=>''),'value','text',$state->show_front);
			
			$data = array(
						'state'=>$state,
						'country_select'=>$country_select,
						'show_select'=>$show_select
					);
			$this->template->build('state/add',$data);
		}else{
			$this->load->model(array('state/mdl_state'));			
			$state_id = $this->input->post('state_id');
			$state_name = $this->input->post('state_name');
			$country_id = $this->input->post('country_id');
			$show_front = $this->input->post('show_front');
			$data = array(
				'state_name'=>$state_name,
				'country_id'=>$country_id,
				'show_front'=>$show_front
			);			
			
			if((int)$state_id==0){
				$data['state_slug'] = strtolower( str_replace(' ','_',str_replace('-','_',$this->input->post('state_name'))));
				$data['state_created_by'] = $this->session->userdata('user_id');
				$data['state_created_ts'] = date('Y-m-d H:i:s');
			}else{
				$data['state_modified_by'] = $this->session->userdata('user_id');
				$data['state_modified_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_state->save($data,$state_id)){
				$this->session->set_flashdata('success_save','State saved successfully.');
			}else{
				$this->session->set_flashdata('custom_warning','State could not be saved.');
			}
			redirect('admin/state');
		}
	}
	function edit($state_id = 0){
		$this->add($state_id);
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
			redirect('admin/state');
		}
	}
}
?>