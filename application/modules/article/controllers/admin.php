<?php if(!defined('BASEPATH')) exit('Direct script access is not allowed');
class Admin extends Admin_Controller{
    function __construct() {
        parent::__construct();
        $this->lang->load('article',  $this->mdl_mcb_data->setting('language'));
    }
    function index(){
        $this->template->title($this->lang->line('article'));
        $this->template->set_breadcrumb($this->lang->line('article'));
        $this->load->model(array('article/mdl_article','category/mdl_category'));
        $this->load->library('pagination');
		$config['base_url'] = site_url('admin/content/index/');
		$config['per_page'] = 10;
		$config['uri_segment'] = 4;
		$page['limit'] = $config['per_page'];
		$page['start'] = $this->uri->segment($config['uri_segment']);
		$contents= $this->mdl_article->getArticleList($page);     
		$config['total_rows'] = $contents['total'];		
		
		$this->pagination->initialize($config); 
		
		$data = array(
        		'articles'=>$contents['articles'] ,
				'pagination'=>$this->pagination->create_links()
        );
        $this->template->build('admin/index',$data);
    }
    function edit($article_id =0){
		$this->add($article_id);
    }
	function add($article_id = 0){
        $this->template->title($this->lang->line('article'));
        $this->template->set_breadcrumb($this->lang->line('article'));
        $this->template->set_breadcrumb($this->lang->line('add'));
		$this->load->model(array('article/mdl_article','category/mdl_category','utilities/mdl_html'));        
		$this->form_validation->set_rules('article_name','Article','required');
		$this->form_validation->set_rules('category_id','Category','required');
		$this->form_validation->set_rules('article_alias','Article alias','required');
		
		if($this->form_validation->run()==FALSE){
			$this->template->append_metadata('<script src="'.base_url().'assets/admin/js/tiny_mce/tiny_mce.js"></script>');
	        
			$article_details = $this->mdl_article->getArticleDetails($article_id);
			$categoryOptions = $this->mdl_category->getCategoryOptions();
	        array_unshift($categoryOptions, $this->mdl_html->option( '-1', 'Un Categorised'));
			array_unshift($categoryOptions, $this->mdl_html->option( '', 'Select Category'));
	        $category_select = $this->mdl_html->genericlist( $categoryOptions, "category_id",array('class'=>'category validate[required]'),'value','text',set_value('category_id',$article_details->category_id));
	        
	        $statusOptions = array();
	        array_unshift($statusOptions, $this->mdl_html->option( '0', 'Inactive'));
			array_unshift($statusOptions, $this->mdl_html->option( '1', 'Active'));
	        $status_select = $this->mdl_html->genericlist( $statusOptions, "article_status",array('class'=>'category validate[required]'),'value','text',set_value('article_status',$article_details->article_status));
			
			$data = array(
				'article_details'=>$article_details,
				'category_select'=>$category_select,
				'status_select'=>$status_select
			);
			
			$this->template->build('admin/add',$data);
		}else{
			$article_id = $this->input->post('article_id');
			$category_id = $this->input->post('category_id');
			$article_name = $this->input->post('article_name');
			$article_alias = $this->input->post('article_alias');
			$article_long_desc = $this->input->post('article_long_desc');
			$article_status = $this->input->post('article_status');
			
			$data = array(
					'article_name'=>$article_name,
					'article_long_desc'=>$article_long_desc,
					'article_status'=>$article_status,
					'category_id'=>$category_id,
					'article_alias'=>$article_alias,
					'show_fb_comment'=>1
			);
			$this->load->library('upload');
				$config['upload_path'] = './uploads/articles/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '102400';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['encrypt_name'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$this->upload->initialize($config);

				if( ! $this->upload->do_upload('file_image')){
					$error = array('error' => $this->upload->display_errors());			
				}else{
					@unlink(FCPATH.'uploads/articles/'.$this->input->post('article_image'));
					@unlink(FCPATH.'uploads/articles/thumbs/'.$this->input->post('article_image'));
					@unlink(FCPATH.'uploads/articles/mediumthumbs/'.$this->input->post('article_image'));
					$upload_data = $this->upload->data();
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image']	= FCPATH.'uploads/articles/'.$upload_data['file_name'];
					$config['new_image']	= FCPATH.'uploads/articles/thumbs/'.$upload_data['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 78;
					$config['height']	= 78;
					$config['master_dim'] = 'width';
					
					$this->load->library('image_lib', $config); 
					
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config['new_image']	= FCPATH.'uploads/articles/mediumthumbs/'.$upload_data['file_name'];
					$config['width']	 = 277;
					$config['height']	= 220;
					
					$this->image_lib->initialize($config); 
					
					$this->image_lib->resize();
					
					$upload_data = $this->upload->data();
					$data['article_image']	= $upload_data['file_name'];
				}
			if(trim($article_alias)==""){
				$article_alias = str_replace(" ", "-", strtolower($article_alias));			
				$data['article_alias'] = $article_alias;
			}
			if($article_id>0){
				$data['article_modified_by'] = $this->session->userdata('user_id');
				$data['article_modified_ts'] = date('Y-m-d H:i:s');
			}else{
				$data['article_created_by'] = $this->session->userdata('user_id');
				$data['article_created_ts'] = date('Y-m-d H:i:s');
			}
			if($this->mdl_article->save($data,$article_id)){
				$this->session->set_flashdata('success_save','Article saved successfully.');
			}else{
				$this->session->set_flashdata('success_save','Article could not be saved successfully.');
			}
			redirect('admin/article');
		}
	}
	function delete(){
		$article_id = $this->input->post('article_id');
		$this->load->model(array('article/mdl_article'));
		if($this->mdl_article->delete(array('article_id'=>$article_id))){
			$this->session->set_flashdata('success_save','This article has been deleted successfully.');
		}else{
			$this->session->set_flashdata('success_save','This article could not be deleted.');
		}
		redirect('admin/article');
		
	}
}