<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Public_Controller extends CI_Controller {
	public static $is_loaded;
	function __construct() {
		parent::__construct();
		$this->config->set_item('sess_cookie_name', 'ci_session_front');
		//$this->load->config('config_front');
		$this->load->helper('url');
		$this->load->helper('icon');
		$this->load->library(array('session','template'));
		$application_title = 'College Waves';
		if( !$this->session->userdata('language')){
			$this->session->set_userdata(array('language'=>'english'));
		}
		$this->template->title($application_title);				
		$this->template->prepend_metadata('<script src="'.base_url().'assets/admin/js/jquery-1.7.2.min.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.widget.min.js"></script>');					
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.position.min.js"></script>');					
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.core.min.js"></script>');							
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.autocomplete.min.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/dropkick.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/app.javascript.js"></script>');
		
		$this->template->append_metadata('<link rel="stylesheet" type="text/css" media="all" href="'.base_url().'assets/public/css/style.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/reset.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.theme.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.autocomplete.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" id="media-screen-css" type="text/css" href="'.base_url().'assets/public/css/media-screen.css" />');
			
		
		$this->template->set_theme('public');
		$this->template->set_layout('default');
		$this->template->set_partial('header','blocks/header');
		$this->template->set_partial('left','blocks/left');
		$this->template->set_partial('right','blocks/right');
		$this->template->set_partial('googleads','blocks/googleads');
		$this->template->set_partial('footer','blocks/footer');
        $this->load->helper('url');
		if (!isset(self::$is_loaded)) {
			self::$is_loaded = TRUE;
			$this->load->database();
			$this->load->library(array('form_validation'));
			$this->load->model(array('mcb_data/mdl_mcb_data','mcb_data/mdl_mcb_userdata'));
			$this->mdl_mcb_data->set_session_data();
			$this->load->language('default','english');                    
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
	}
}

?>