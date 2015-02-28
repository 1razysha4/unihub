<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Classified extends Public_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('template');
	}
	function index($university_id = 0){
		$this->form_validation->set_rules('university_id','University','required');
		if($this->form_validation->run()==FALSE){
			$this->load->model(array('universities/mdl_university','utilities/mdl_html'));
			$universityOptions = $this->mdl_university->getUniversityOptions();
	        array_unshift($universityOptions, $this->mdl_html->option( '0', 'Select University'));
	        $university_select=$this->mdl_html->genericlist( $universityOptions, "university_id",array(),'value','text',$this->uri->segment('2'));
	  		$classified_posts = array();
	        if($university_id>0){
	  			$this->load->model(array('content/mdl_content'));
				$this->load->library('pagination');
				
				$config['base_url'] = base_url();
				$config['per_page'] = $this->mdl_mcb_data->get('per_page');
				$config['next_link'] = '&raquo;';
				$config['prev_link'] = '&laquo;';
				$page['limit'] = $config['per_page'];
				$page['start'] = $this->input->post('currentpage');
	  			$list = $this->mdl_content->getPostsByUniversity($page,$university_id,2);				
				$config['total_rows'] = $list['total'];
				$this->pagination->initialize($config);
				$navigation = $this->pagination->create_links();
	  		}
			$data = array(
				'university_select'=>$university_select
			);
			$this->template->build('classified/index',$data);
		}else{
			$university_id = $this->input->post('university_id');
			if($university_id>0){
				redirect('classified/'.$university_id);
			}else{
				redirect('classified');
			}
		}
	}
}