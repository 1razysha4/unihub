<?php defined('BASEPATH') or die('Direct access script is not allowed');

/**
 * Description of admin
 *
 * @author GHANSHYAM
 * @property Mdl_Category $mdl_category Description
 */
class admin extends Admin_Controller{
    function __construct() {
        parent::__construct();
        $this->lang->load('category',  $this->session->userdata('language'));
    }
    function index(){
        $data = array();
        $this->load->model(array('category/mdl_category'));
        $this->load->library('pagination');

        $config['base_url'] = site_url('admin/category/index/');
        $config['per_page'] = $this->mdl_mcb_data->get('per_page');
        $config['uri_segment'] = 4;
        
        $page['start'] = $this->uri->segment(4);
        $page['limit'] = $config['per_page'];
        $category = $this->mdl_category->getCategoryList($page);
        $data['categories'] = $category['list'];
        $category['total'] = $category['total'];
        $config['total_rows'] = $category['total'];
        $config['full_tag_open'] = '<ul class="pages">';
        $config['full_tag_closed'] = '</ul>';
        $config['cur_tag_open'] = '<li><a href="#" class="active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
                
        $this->template->set_breadcrumb($this->lang->line('category'),  site_url().'admin/category');
        $this->template->build('admin/index', $data);
    }
    function add(){
        
    }
    function edit(){
        
    }
}

?>
