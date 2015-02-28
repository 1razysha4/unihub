<?php if(!defined('BASEPATH')) exit('Direct script access is not allowed');
class Admin extends Admin_Controller{
    function __construct() {
        parent::__construct();
        $this->lang->load('university',  $this->mdl_mcb_data->setting('language'));
    }
    function index(){
        $this->template->title($this->lang->line('university'));
        $this->template->set_breadcrumb($this->lang->line('content'));
        $this->load->model(array('university/mdl_university','state/mdl_state','country/mdl_country'));
        $contents= $this->mdl_university->getUniversityList();
        $this->load->library('pagination');

		$config['base_url'] = site_url('admin/university/index/');
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
        		'universities'=>$contents['universities'] ,
				'pagination'=>$this->pagination->create_links()
        );
        $this->template->build('admin/index',$data);
    }
    function add(){
    	$this->create();
    }
	function edit($university_id = 0){
		$this->create($university_id );
	}
	function create($university_id = 0){
		$this->load->model(array('state/mdl_state','university/mdl_university','utilities/mdl_html'));
        $this->form_validation->set_rules('university_name',$this->lang->line('university_name'),'required');
		$this->form_validation->set_rules('state_id',$this->lang->line('state_name'),'required');
		$this->form_validation->set_rules('university_slug',$this->lang->line('university_slug'),'required');
		if($this->form_validation->run()==FAlSE){
			$this->template->title($this->lang->line('univsersity'));
	        $this->template->set_breadcrumb($this->lang->line('university'));
	        $university= $this->mdl_university->getUniversityDetails($university_id);
	        
	        $stateOptions=$this->mdl_state->getStateOptions();
			array_unshift($stateOptions, $this->mdl_html->option( '', 'Select State'));
			$state_select=$this->mdl_html->genericlist( $stateOptions, "state_id",array('class'=>'validate[required] text-input'),'value','text',$university->state_id);
	        
	
			$data = array(
	        		'university'=>$university,
					'state_select'=>$state_select
	        );
        $this->template->build('admin/create',$data);
		}else{
			$university_id = $this->input->post('university_id');
			$university_name = $this->input->post('university_name');
			$university_slug = $this->input->post('university_slug');
			$university_address = $this->input->post('university_address');
			$state_id = $this->input->post('state_id');
			$university_slug = str_replace(" ", "-", strtolower($university_slug));
			$university_slug = str_replace("'", "", strtolower($university_slug));
			$university_slug = str_replace('"', "", strtolower($university_slug));
			$data =array(
						'university_name'=>$university_name,
						'university_slug'=>$university_slug,
						'university_address'=>$university_address,
						'state_id'=>$state_id
			);
			if($this->input->post('is_top')=='on'){
				$data['is_top'] = 1; 
			}else{
				$data['is_top'] = 0;
			}			
			$this->load->library('upload');
				$config['upload_path'] = './uploads/university/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '102400';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['encrypt_name'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$this->upload->initialize($config);

				if( ! $this->upload->do_upload('university_image')){
					$error = array('error' => $this->upload->display_errors());			
				}else{
					@unlink(FCPATH.'uploads/university/'.$this->input->post('university_image_old'));
					@unlink(FCPATH.'uploads/university/thumbs/'.$this->input->post('university_image_old'));
					@unlink(FCPATH.'uploads/university/mediumthumbs/'.$this->input->post('university_image_old'));
					
					$upload_data = $this->upload->data();
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image']	= FCPATH.'uploads/university/'.$upload_data['file_name'];
					$config['new_image']	= FCPATH.'uploads/university/thumbs/'.$upload_data['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 78;
					$config['height']	= 78;
					$config['master_dim'] = 'width';
					
					$this->load->library('image_lib', $config); 
					
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config['new_image']	= FCPATH.'uploads/university/mediumthumbs/'.$upload_data['file_name'];
					$config['width']	 = 277;
					$config['height']	= 220;
					
					$this->image_lib->initialize($config); 
					
					$this->image_lib->resize();
					
					$upload_data = $this->upload->data();
					$data['university_image']	= $upload_data['file_name'];
				}
				
			if($this->mdl_university->save($data,$university_id)){
				if(($uid = (int)$this->db->insert_id())>0){
					$university_id = $uid;
				}
				$this->session->set_flashdata('success_save','Saved successfuly');
    		}else{    		
    			$this->session->set_flashdata('custom_warning','Could not be Saved successfuly');
    		}
    		redirect('admin/university/edit/'.$university_id);
		}
	}
    function delete(){
		$university_id = $this->input->post('university_id');
		$this->load->model(array('university/mdl_university'));
		if($this->mdl_university->delete(array('university_id'=>$university_id))){
			$this->session->set_flashdata('success_save','This university has been deleted successfully.');
		}else{
			$this->session->set_flashdata('success_save','This university could not be deleted.');
		}
		redirect('admin/university');		
	}
}