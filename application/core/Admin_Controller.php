<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Admin_Controller extends CI_Controller {
	public static $is_loaded;
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->library(array('session','template'));
		$this->load->model(array('mcb_data/mdl_mcb_data'));
		$this->mdl_mcb_data->set_application_title();
		//$config['title_separator'] = '-';
		$application_title = $this->mdl_mcb_data->setting('application_title');
		$this->template->set_breadcrumb('Admin',site_url().'admin');		
		$this->template->title($application_title);
		$this->template->set_theme('admin');
		$this->template->set_layout('admin');
		$this->template->prepend_metadata('<script src="'.base_url().'assets/admin/js/jquery-1.7.2.min.js"></script>');
		/*$this->template->prepend_metadata('<script src="'.base_url().'assets/admin/js/jquery-ui-1.8.21.custom.min.js"></script>');*/
		/*$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/jquery.chosen.min.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/jquery.uniform.min.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/jquery-ui-1.8.21.custom.min.js"></script>');*/
		/*$this->template->append_metadata('<script src="'.base_url().'assets/js/jquery.uploadify-3.1.min.js"></script>');
		$this->template->append_metadata('<script src="'.base_url().'assets/js/charisma.js"></script>');*/
		
		/**
		*loading css
		*/
		$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/styles.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/reset.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/fullcalendar.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/font.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/ui_custom.css" />');
		//$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/fancybox.css" />');
		$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/bootstrap.css" />');
		//$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/elfinder.css" />');
		//$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/plugins.css" />');
                
        if ($this->session->userdata('user_id') && $this->session->userdata('is_admin')==true) {
        }else{
			redirect('admin/login');
		}

		if (!isset(self::$is_loaded)) {
                    self::$is_loaded = TRUE;
                    $this->load->database();
                    $this->load->library(array('form_validation'));
                    $this->load->model(array('mcb_data/mdl_mcb_data','mcb_data/mdl_mcb_userdata'));
                    $this->mdl_mcb_data->set_session_data();
                    $this->load->language('application', $this->mdl_mcb_data->setting('default_language'));
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
	}
}

?>