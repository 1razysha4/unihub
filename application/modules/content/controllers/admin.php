<?php if(!defined('BASEPATH')) exit('Direct script access is not allowed');
class Admin extends Admin_Controller{
    function __construct() {
        parent::__construct();
        $this->lang->load('content',  $this->mdl_mcb_data->setting('language'));
    }
    function index(){
        $this->template->title($this->lang->line('content'));
        $this->template->set_breadcrumb($this->lang->line('content'));
        $this->load->model(array('content/mdl_content','category/mdl_category'));
        $contents= $this->mdl_content->getContentList();
        $this->load->library('pagination');

		$config['base_url'] = site_url('admin/content/index/');
		$config['total_rows'] = $contents['total'];
		$config['per_page'] = 10;
		$config['uri_segment'] = 4;
		
		/*$config['full_tag_open'] = '<p>'; 
		$config['full_tag_close'] = '</p>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<div>';
		$config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<div>';
		$config['prev_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		$config['num_tag_open'] = '<div>';
		$config['num_tag_close'] = '</div>';*/
		
		$this->pagination->initialize($config); 
		
		$data = array(
        		'contents'=>$contents['contents'] ,
				'pagination'=>$this->pagination->create_links()
        );
        $this->template->build('admin/index',$data);
    }
    function changestatus(){
    	$this->session->set_flashdata('success_save','Post approved successfully.');
    	$content_id = $this->input->post('content_id');
    	$this->load->model(array('content/mdl_content'));
    	$data = array(
    		'content_status'=>1,
    		'content_approved_ts'=>date('Y-m-d H:i:s'),
    		'content_approved_by'=>$this->session->userdata('user_id')
    	);
    	if($this->mdl_content->save($data,$content_id)){    		
    	}else{    		
    	}
    	redirect('admin/content');
    }
	function view($content_id){
		$this->load->model(array('content/mdl_content','category/mdl_category','university/mdl_university','users/mdl_users'));
		$content_details = $this->mdl_content->getContentDetailsById($content_id);
		$data = array(
			'content_details'=>$content_details
		);
		if($content_details->content_type=2){
			$this->template->build('admin/view_classified',$data);
		}else{
			$this->template->build('admin/view_event',$data);
		}
	}
	function delete(){
		$content_id = $this->input->post('content_id');
		$this->load->model(array('content/mdl_content'));
		if($this->mdl_content->delete(array('content_id'=>$content_id))){
			$this->session->set_flashdata('success_save','This post has been deleted successfully.');
		}else{
			$this->session->set_flashdata('success_save','This post could not be deleted.');
		}
		redirect('admin/content');
		
	}
}