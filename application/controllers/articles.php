<?php defined('BASEPATH') or die('Direct access is not allowed');
class Articles extends Public_Controller{
	function __construct(){
		parent::__construct();		
	}
	function _remap($article_slug){
		$this->template->set_layout('login');
		$this->load->model(array('article/mdl_article','category/mdl_category','users/mdl_users'));
		$article = $this->mdl_article->getArticleDetailsBySlug($article_slug);
		if(count($article)>0){
			$this->load->helper('datetime');
			$data = array(
					'article'=>$article
			);
			$description=strip_tags($article->article_long_desc);
			$length_of_description = strlen($description);
			if($length_of_description>=200){
				$whitespaceposition = strpos($description," ",200);
				$description_br = ($whitespaceposition?substr($description,0,$whitespaceposition):$description);
			}
			else{
				$description_br= $description;
			}
			$this->template->prepend_metadata('<meta property="og:url" content="'.site_url($this->uri->uri_string()).'" /> 
					<meta property="og:title" content="'.$article->article_name.'" />
					<meta property="og:description" content="'.$description_br.'" /> 
					<meta property="og:image" content="'.base_url('uploads/contents/'.$article->article_image).'" />');
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.flexslider-min.js"></script>');			
			
			$this->load->helper('ci_slug_helper');
			if($google_ads = get_page_googleads('articles')){
				$this->router->details->show_google_ad = 1;
				$this->router->details->google_ad_html = $google_ads->google_ad_html;				
			}
			$this->template->build('article/view',$data);
		}else{
			$this->index();
		}
	}
	function index(){
		$data = array();
		$this->template->build('article/view',$data);
	}
}