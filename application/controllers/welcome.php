<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Public_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function  __construct(){
		parent::__construct();
		$this->load->model(array('users/mdl_users','content/mdl_content','article/mdl_article','category/mdl_category','university/mdl_university'));
	}

	public function index()
	{

		
		$contents = $this->mdl_content->getLatestContentList(10);
		$popular_contents = $this->mdl_content->getPopularContentList(10);		
		$states = $this->mdl_content->getUniversityDetailsByStates();
		$articles = $this->mdl_article->getLatestArticles();
		$countries = $this->mdl_content->getAllCountries();

		
		/* $this->load->library(array('template'));
		$this->template->set_layout('home');
		$this->load->helper('datetime');
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.cycle.all.min.js"></script>');					
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.jcarousel.js"></script>');					
		$this->load->model(array('users/mdl_users','content/mdl_content','article/mdl_article','category/mdl_category','university/mdl_university'));
		$contents = $this->mdl_content->getLatestContentList(10);
		$popular_contents = $this->mdl_content->getPopularContentList(10);
		$slider_contents = $this->mdl_university->getSliderContent();
		$states = $this->mdl_content->getUniversityDetailsByStates();
		$articles = $this->mdl_article->getLatestArticles();
		$data = array(
					'contents'=>$contents,
					'states'=>$states,
					'popular_contents'=>$popular_contents,
					'slider_contents'=>$slider_contents,
					'articles'=>$articles
				);
		$this->load->helper('ci_slug_helper');
		if($google_ads = get_page_googleads('home')){
			$this->router->details->show_google_ad = 1;
			$this->router->details->google_ad_html = $google_ads->google_ad_html;				
		}
		$this->template->build('home/home',$data); */

		$data = array(
			'title' => 'Home',
			'contents'=>$contents,
			'states'=>$states,
			'popular_contents'=>$popular_contents,
			'articles'=>$articles,
			'countries' => $countries
			);

		$this->load->view('home/home',$data);
	}

	public function getStates(){
		if($this->input->is_ajax_request()){
			$country_id = $this->input->post('country_id',true);
			$res = $this->mdl_content->getStatesByCountryId($country_id);
			if(is_array($res)){
				echo json_encode($res);exit;
			}
		}
	}


	public function getUniversity(){
		if($this->input->is_ajax_request()){
			$state_id = $this->input->post('state_id',true);
			$res = $this->mdl_content->getUniverityByStateId($state_id);
			if(is_array($res)){
				echo json_encode($res);exit;
			}
		}
	}

	public function getUniversityData(){
           try{ 
		if($this->input->is_ajax_request()){
			$uid = $this->input->post('university_id',true);
			$slug = $this->mdl_content->getUniversitySlugById($uid);
                        if(is_array($slug)){
				echo $slug[0]['university_slug'];
                                exit();
			}
		}
           }catch(Exception $ex){
                 print_r($ex);
                 exit;
           }  
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */