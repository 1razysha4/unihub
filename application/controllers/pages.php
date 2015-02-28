<?php defined('BASEPATH') or exit('Direct access is not allowed');

class Pages extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('pages/mdl_pages'));
	}

	function page($page_id){
		$this->template->set_layout('page');				
		$this->load->model(array('pages/mdl_pages'));

		$title = $this->uri->segment(1);


		$page = $this->mdl_pages->getPageInfo($page_id);
		$this->router->details->show_google_ad = $page->show_google_ad;
		$this->router->details->google_ad_html = $page->google_ad_html;

		$this->template->set_partial('googleads','blocks/googleads');			
		$this->template->title($page->page_name);


		$data = array(	
			'page'		=> $page,
			'title'		=> $title,
		);
		

		$this->load->view('pages/page',$data);
	}
}
