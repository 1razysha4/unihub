<?php defined('BASEPATH') or die('Direct access is not allowed');
class Search extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		
	}
	function posts($university_id = 0){
		$this->form_validation->set_rules('country_id','Country Name','required');
		$this->form_validation->set_rules('city_id','City Name','required');
		$this->form_validation->set_rules('university_id','University Name','required');
		if($this->form_validation->run()== FALSE){
			$countryOptions = $this->router->search_data['countries'];
			$stateOptions = $this->router->search_data['states'];
			$universityOptions = $this->router->search_data['universities'];
			
			$this->load->model(array('utilities/mdl_html'));
	        array_unshift($countryOptions, $this->mdl_html->option( '', 'Select Country'));
	        $country_select=$this->mdl_html->genericlist( $countryOptions, "country_id",array('onchange'=>'getCityByCountry(this.value)','class'=>'validate[required] uni-select'),'value','text',$this->uri->segment('2'));
	        
	        array_unshift($stateOptions, $this->mdl_html->option( '', 'Select City/State'));
	        $state_select=$this->mdl_html->genericlist( $stateOptions, "state_id",array('onchange'=>'getUniversityByState(this.value)','class'=>'validate[required] uni-select'),'value','text',$this->uri->segment('2'));
	        
	        array_unshift($universityOptions, $this->mdl_html->option( '', 'Select University'));
	        $university_select=$this->mdl_html->genericlist( $universityOptions, "university_id",array('class'=>'validate[required] uni-select'),'value','text',$university_id);
	        
			$data = array(
					'country_select'=>$country_select,
					'state_select'=>$state_select,
					'university_select'=>$university_select
			);
	        $this->template->build('search/posts',$data);
		}else{
			$university_id = $this->input->post('university_id');
			redirect('search/post/'.$university_id);
		}
	}
}
?>