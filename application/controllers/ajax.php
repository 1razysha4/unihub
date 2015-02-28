<?php defined('BASEPATH') or die('Direct access is not allowed');
class Ajax extends Public_Controller{
	function __construct(){
		parent::__construct();		
	}
	function getcommentlist(){
		$this->load->helper('datetime');
		$this->load->model(array('comments/mdl_comments','users/mdl_users'));
		 $this->load->library('ajaxpagination');
		$content_id = $this->input->get('content_id');
		$config['base_url'] = base_url();
		$config['per_page'] = 7;
		
		$config['full_tag_open'] ='<ul class="paginate">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$page['limit'] = $config['per_page'];
		$page['start'] = $this->input->get('currentpage');
		$list = $this->mdl_comments->commentsByContentId($content_id,$page);		
		$config['total_rows'] = $list['total'];
		$this->ajaxpagination->cur_page=$this->input->get('currentpage');
		$this->ajaxpagination->initialize($config);
		$navigation = $this->ajaxpagination->create_links();

		$data = array(
			'comments'=>$list['comments'],
			'navigation'=>$navigation,
			'total'=>$list['total']
		);
		$this->load->view('posts/getcommentlist',$data);
	}
	function comment(){
		 if(!$this->session->userdata('user_id')) {
	     	echo $this->load->view('users/check_login_session');
	     	return false;
		 }
		$this->form_validation->set_error_delimiters('', ''); 
		$this->form_validation->set_rules('comment_resource_id','Content','required');
		$this->form_validation->set_rules('comments','Comments','required');		
		if($this->form_validation->run()==FALSE){
			$data = array('type'=>'warning','message'=>validation_errors());			
			echo $this->load->view('home/ajax_messages',$data);
		}else{
			$data = array(
			'comment_text'=>$this->input->post('comments'),
			'user_id'=>$this->session->userdata('user_id'),
			'comment_dt'=>date('Y-m-d H:i:s'),
			'comment_resource_id'=>$this->input->post('comment_resource_id'),
			'comment_resource_type'=>$this->input->post('comment_resource_type')
			);

			$this->load->model(array('comments/mdl_comments'));
			if($this->mdl_comments->save($data)){
				$data = array('type'=>'success','message'=>'Your comment has been posted.');
			}else{
				$data = array('type'=>'warning','message'=>'Your comment could not be posted.');
			}
			echo $this->load->view('home/ajax_messages',$data);
		}
	}
	function hitpage(){
		$this->form_validation->set_rules('content_type','Content','required');
		if($this->form_validation->run()==FALSE){
			
		}else{
			$content_type = $this->input->post('content_type');
			if($content_type=="content"){
				$content_id = $this->input->post('content_id');
				$sql = 'UPDATE ci_contents SET content_page_views=(content_page_views+1) WHERE content_id='.$content_id.' LIMIT 1';
				$this->db->query($sql);
			}
			if($content_type=="article"){
				$article_id = $this->input->post('article_id');
				$sql = 'UPDATE ci_articles SET article_page_views=(article_page_views+1) WHERE article_id='.$article_id.' LIMIT 1';
				$this->db->query($sql);
			}
		}
	}
}