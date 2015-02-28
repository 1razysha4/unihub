<?php defined('BASEPATH') or die('Direct access script is not allowed');
/**
 * @property Mdl_Menus $mdl_menus
 */
class Admin extends Admin_Controller
{
	function __construct()
	{
            parent::__construct(TRUE);
            $this->lang->load('menus', $this->session->userdata('language'));


	}
	function index()
	{
            	$data = array();
		$this->load->helper('url');
		$this->load->model(array('menus/mdl_menus'));
		$menus = $this->mdl_menus->getMenusList();
		$data['menus'] = $menus['list'];
		$this->template->set_breadcrumb($this->lang->line('menus'));
		$this->template->title($this->lang->line('menus'));
		$this->template->set_theme('admin');
		$this->template->set_layout('admin')->build('menus/index', $data);
	}
        function create($menu_id = 0){
            $data = array();
            $this->template->title($this->lang->line('menu'));
            $this->template->set_breadcrumb($this->lang->line('menus'),site_url('admin/menus'));
            $this->template->set_breadcrumb($this->lang->line('menu'));
            $this->template->build('admin/create',$data);
        }
}

?>