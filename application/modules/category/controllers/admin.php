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
    function create($category_id=0){
		$data = array();
		$this->load->library('form_validation');
		$this->load->model(array('category/mdl_category'));
		$this->form_validation->set_rules('category_name','Category title is required','required');
		if($this->form_validation->run()==FALSE){
			$category = $this->mdl_category->getCategoryDetails($category_id);
			$data['category'] = $category;
			$this->template->title($this->lang->line('category'));
			$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/admin/css/jquery.iphone.toggle.css" />');
		
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/tiny_mce/tiny_mce.js"></script>');
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/jquery.iphone.toggle.js"></script>');
			$this->template->build('admin/create',$data);
		}else{
			if($this->input->post('category_active')=='on'){
				//$data['category_active'] = 1; 
			}else{
				//$data['category_active'] = 0;
			}
			$data['category_name'] = $this->input->post('category_name');
			$data['category_details'] = $this->input->post('category_details');
			if($category_id>0){
				$data['category_modified_by'] = $this->session->userdata('user_id');
				$data['category_modified_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_category->save($data,$category_id)){
				$this->session->set_flashdata('success_save',$this->lang->line('this_item_has_been_saved'));
			}else{
				$this->session->set_flashdata('success_save',$this->lang->line('this_item_could_not_be_saved'));
			}
			redirect('admin/category');
		}
    }
    function edit($category_id = 0){
        $this->create($category_id);
    }
}

?>
