<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('template');
		$this->post_type = 0;
		$this->filter_category_id = 0;
		$this->load->language('content',  'english');	   								
	}
	function index($university_id = 0){
		$this->template->set_layout('login');		
		if($this->uri->segment(3)=='classified'){
			$this->filter_category_id =$this->uri->segment(4);
		}
		$university_id = @$this->router->university->university_id;
		$university_slug = @$this->router->university->university_slug;
		$this->form_validation->set_rules('country_id','Country Name','required');
		$this->form_validation->set_rules('state_id','State Name','required');
		$this->form_validation->set_rules('university_id','University Name','required');
		if($this->form_validation->run()== FALSE){
			$this->load->helper('datetime');
			if($university_slug==''){
				$this->session->set_flashdata('custom_warning','Please select university');
				redirect('');
			}
		
			$this->load->model(array('category/mdl_category','content/mdl_content','users/mdl_users','utilities/mdl_html'));
			$categoryOptions = $this->mdl_category->getCategoryOptions();
	        array_unshift($categoryOptions, $this->mdl_html->option( '', 'Select Category'));
	        $category_select=$this->mdl_html->genericlist( $categoryOptions, "category_id",array('class'=>'category'),'value','text',$this->uri->segment(4));
			
	        $page['start'] =$this->uri->segment('4');
			$config['uri_segment'] = 4;
			
	        if($this->post_type==1){
	        	$type = 'events';
	        }elseif ($this->post_type==2){
	        	$type = 'classified';
	        	$page['start'] =$this->uri->segment('5');
	        	$config['uri_segment'] = 5;
	        }else {
	        	$type = 'index';
	        }
	        
	        $config['base_url'] = site_url($university_slug.'/posts/'.$type);			
	        if ($this->post_type==2){
				$config['base_url'] = site_url($university_slug.'/posts/'.$type.'/'.$this->filter_category_id);	        		        	
	        }
			$this->load->library('pagination');
			
			$page['limit'] = 10;
			$posts = $this->mdl_content->getPostsByUniversity($page,$university_id,$this->post_type,$this->filter_category_id);
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
			$config['total_rows'] = $posts['total'];
			$config['per_page'] = $page['limit']; 
			
			$this->pagination->initialize($config); 
			
			$navigation = $this->pagination->create_links();
	        $data = array(
	        		'category_select'=>$category_select,
					'posts'=>$posts['list'],
					'navigation'=>$navigation,
	        		
					'university_id'=>$university_id,
	        		'post_type'=>$this->post_type
			);
	        $this->template->build('posts/index',$data);
		}else{
			$university_id = $this->input->post('university_id');
			redirect($university_id.'/posts/index/');
		}
	}
	function events(){
		$this->post_type = 1;
		$this->index();
	}
	function classified(){
		$this->post_type = 2;
		$this->index();		
	}
	function thread(){
		$this->post_type = 3;
		$this->index();		
	}
	function addnew($post_type=''){
		$this->check_session();
		if(!isset($this->router->university->university_slug)){
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.core.min.js"></script>');
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.widget.min.js"></script>');
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.position.min.js"></script>');
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.autocomplete.min.js"></script>');
			
			$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.all.css" />');
			$this->template->append_metadata('<link id="bs-css" rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.autocomplete.css" />');
			
			$this->template->build('posts/preform');
		}else{
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.validate.min.js"></script>');		
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.datepicker.min.js"></script>');					
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.core.min.js"></script>');					
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.timepicker.js"></script>');					
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.theme.css" />');
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.datepicker.css" />');
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.timepicker.css" />');
		
			$this->form_validation->set_rules('type','Post Type','required');
				
			$type = $this->input->post('type');
			if($type == 2){
				$this->form_validation->set_rules('university','university','required');
				$this->form_validation->set_rules('category_id','Category ID','required');
				$this->form_validation->set_rules('classified_subject','Classified Subject','required');								
				$this->form_validation->set_rules('classified_description','Classified Description','required');
			}
			if($type == 1){
				$this->form_validation->set_rules('event_name','Event Name','required');
				$this->form_validation->set_rules('event_location','Event Location','required');
				$this->form_validation->set_rules('event_date','Event date','required');
				$this->form_validation->set_rules('event_time','Event Time','required');
				$this->form_validation->set_rules('event_details','Event Details','required');				
			}
			if($type == 3){
				$this->form_validation->set_rules('thread_name','Thread Name','required');
				$this->form_validation->set_rules('thread_description','Thread Description','required');
			}
			if($this->form_validation->run()==FALSE){
				$this->load->model(array('category/mdl_category','utilities/mdl_html'));
				$categoryOptions = $this->mdl_category->getCategoryOptions();
		        array_unshift($categoryOptions, $this->mdl_html->option( '', 'Select Category'));
		        $category_select=$this->mdl_html->genericlist( $categoryOptions, "category_id",array('class'=>'category validate[required]'),'value','text',set_value('category_id'));
				$data = array(
					'category_select'=>$category_select
				);
				$this->template->build('posts/addnew',$data);
			}else{
				$this->load->helper('string');
				$content_submit_id = random_string('sha1', 16);
				$type = $this->input->post('type');
				$this->load->model(array('content/mdl_content'));
				if($type == 1){
					$event_name = $this->input->post('event_name');
					$event_location = $this->input->post('event_location');
					$event_date = $this->input->post('event_date');
					$event_time = $this->input->post('event_time');
					$event_details = $this->input->post('event_details');
					$event_slug = strtolower(str_replace(" ",'-',$event_name));
					$data = array(
						'content_name'=>$event_name,
						'content_alias'=>$event_slug,
						'content_date'=>$event_date,
						'content_location'=>$event_location,
						'content_long_desc'=>$event_details,
						'content_time'=>$event_time
					);
				}
				if($type == 2){
					$category_id = $this->input->post('category_id');
					$classified_subject = $this->input->post('classified_subject');
					$classified_description = $this->input->post('classified_description');
					$classified_slug = strtolower(str_replace(" ",'-',$classified_subject));
					$data = array(
						'category_id'=>$category_id,
						'content_name'=>$classified_subject,
						'content_alias'=>$classified_slug,
						'content_date'=>date('Y-m-d'),
						'content_long_desc'=>$classified_description,
					);
				}
				if($type == 3){
					$thread_name = $this->input->post('thread_name');
					$thread_description = $this->input->post('thread_description');
					$thread_slug = strtolower(str_replace(" ",'-',$thread_name));
					$data = array(
						'content_name'=>$thread_name,
						'content_alias'=>$thread_slug,
						'content_date'=>date('Y-m-d'),
						'content_long_desc'=>$thread_description,
					);
				}
				$data['content_misc_category'] = $this->input->post('misc');
				$data['content_type'] = $type;
				$data['university_id'] = $this->input->post('university');
				$data['content_submit_id'] = $content_submit_id;
				$data['content_created_by'] = $this->session->userdata('user_id');
				$data['content_created_ts'] = date('Y-m-d H:i:s');
				
				$this->load->library('upload');
				$config['upload_path'] = './uploads/contents/';
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
					$upload_data = $this->upload->data();
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image']	= FCPATH.'uploads/contents/'.$upload_data['file_name'];
					$config['new_image']	= FCPATH.'uploads/contents/thumbs/'.$upload_data['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 78;
					$config['height']	= 78;
					$config['master_dim'] = 'width';
					
					$this->load->library('image_lib', $config); 
					
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config['new_image']	= FCPATH.'uploads/contents/mediumthumbs/'.$upload_data['file_name'];
					$config['width']	 = 277;
					$config['height']	= 220;
					
					$this->image_lib->initialize($config); 
					
					$this->image_lib->resize();
					
					$upload_data = $this->upload->data();
					$data['content_image']	= $upload_data['file_name'];
				}
				if($this->mdl_content->save($data)){
					if($type==1){
						$this->session->set_flashdata('success_save',$this->lang->line('event_saved_successfully'));
						redirect($this->router->university->university_slug.'/posts/events?submit_id='.$content_submit_id);						
					}
					if($type==2){
						$this->session->set_flashdata('success_save',$this->lang->line('classified_saved_successfully'));
						redirect($this->router->university->university_slug.'/posts/classified?submit_id='.$content_submit_id);						
					}
					if($type==3){
						$this->session->set_flashdata('success_save',$this->lang->line('thread_saved_successfully'));
						redirect($this->router->university->university_slug.'/posts/thread?submit_id='.$content_submit_id);						
					}
				}else {
					if($type==1){
						$this->session->set_flashdata('custom_warning',$this->lang->line('event_could_not_be_saved'));
						redirect($this->router->university->university_slug.'/posts/events');						
					}
					if($type==2){
						$this->session->set_flashdata('custom_warning',$this->lang->line('classified_could_not_be_saved'));
						redirect($this->router->university->university_slug.'/posts/classified');						
					}
					if($type==3){
						$this->session->set_flashdata('custom_warning',$this->lang->line('thread_could_not_be_saved'));
						redirect($this->router->university->university_slug.'/posts/thread');						
					}
				}	
			}	
		}		
	}		
	function getsubcategory(){
		$parent_id = $this->input->get('parent_id');
		$this->load->model(array('category/mdl_category','utilities/mdl_html'));
		$categoryOptions = $this->mdl_category->getCategoryOptions($parent_id);
        array_unshift($categoryOptions, $this->mdl_html->option( '0', 'Select Category'));
        $category_select=$this->mdl_html->genericlist( $categoryOptions, "sub_category_id",array(),'value','text',0);		
        echo $category_select;
	}
	function finaldetails(){
		$data = array();
		$this->template->build('posts/finaldetails',$data);
	}
	function getcitybycountry(){
		$this->load->model(array('utilities/mdl_html'));	        
		$country_id = $this->input->get('country_id');
		$this->db->select('state_id AS value,state_name AS text');
		$this->db->where('country_id',$country_id);
		$result = $this->db->get('ci_states');
		
		$stateOptions =  $result->result();
		array_unshift($stateOptions, $this->mdl_html->option( '', 'Select City/State'));
        $state_select=$this->mdl_html->genericlist( $stateOptions, "state_id",array('onchange'=>'getUniversityByState(this.value)','class'=>'validate[required] select'),'value','text',$this->uri->segment('2'));
        echo $state_select;    
	}
	function getuniversitybystate(){
		$this->load->model(array('utilities/mdl_html'));	        
		$state_id = $this->input->get('state_id');
		$this->db->select('university_slug AS value,university_name AS text');
		$this->db->where('state_id',$state_id);
		$result = $this->db->get('ci_universities');
		
		$universityOptions =  $result->result();
		array_unshift($universityOptions, $this->mdl_html->option( '', 'Select University'));
        $university_select=$this->mdl_html->genericlist( $universityOptions, "university_id",array('class'=>'validate[required] select','style'=>''),'value','text',0);
        echo $university_select;    
	}
	function check_session(){
            if(!$this->session->userdata('user_id')) {
                if($this->input->is_ajax_request()==1){
                    //echo $this->load->view('users/check_login_session');
                    //die();
                }
                //$this->load->library('encrypt');
                redirect('login?return='.base64_encode($this->uri->uri_string()));
            }
	}
	function view(){
		$content_id = $this->uri->segment(4);
		$this->load->helper('datetime');
		$this->form_validation->set_rules('content_id','Advisor','required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('message','Message','required');
		$this->form_validation->set_rules('post_created_by','Post posted by','required|is_natural_no_zero');
		//$this->form_validation->set_rules('captcha_code','captcha code','required|callback_captcha_check');
							
		if($this->form_validation->run($this)==FALSE){			
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.flexslider-min.js"></script>');		
			$this->load->model(array('users/mdl_users','category/mdl_category','content/mdl_content'));
			$content_details = $this->mdl_content->getContentDetails($content_id);
			$description=strip_tags($content_details->content_long_desc);
			$length_of_description = strlen($description);
			if($length_of_description>=200){
				$whitespaceposition = strpos($description," ",200);
				$description_br = ($whitespaceposition?substr($description,0,$whitespaceposition):$description);
			}
			else{
				$description_br= $description;
			}
			$this->template->prepend_metadata('<meta property="og:url" content="'.site_url($this->uri->uri_string()).'" /> 
					<meta property="og:title" content="'.$content_details->content_name.'" />
					<meta property="og:description" content="'.$description_br.'" /> 
					<meta property="og:image" content="'.base_url('uploads/contents/'.$content_details->content_image).'" />');
			$this->template->title($content_details->content_name);		
			
			if(count($content_details)==0){
				$this->session->set_flashdata('custom_warning','Error occurred while loading post.');
				redirect('');
			}
			if($content_details->content_type!=3){			
				$this->router->details->show_google_ad=1;
				$this->router->details->google_add_html = '<img src="'.base_url().'assets/public/img/googleadd.jpg" class="googleadd" />';
				$other_list = $this->mdl_content->getOtherContentListByUser($content_details->content_created_by,$content_id,3);
				$data = array('content_details'=>$content_details,'other_list'=>$other_list);
				$this->template->set_partial('right','blocks/contact_ads');
				if($google_ads = get_page_googleads('postads')){
					$this->router->details->show_google_ad = 1;
					$this->router->details->google_ad_html = $google_ads->google_ad_html;				
				}				
				$this->router->post_created_by = $content_details->content_created_by;
				$this->template->build('posts/view',$data);
			}else{
				$this->template->set_layout('login');
				$data = array('content_details'=>$content_details);
				$this->template->build('posts/viewthread',$data);
			}
		}else{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$contact_message = $this->input->post('message');
			$insert = array(
				'name'=>$name,
				'email'=>$email,
				'contact_request_created_by'=>$this->session->userdata('user_id'),
				'contact_request_created_ts'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('ci_contact_requests',$insert);
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$to_email = DOMAN_ADMIN_EMAIl;
			$this->load->model(array('users/mdl_users'));
			$contact_details = $this->mdl_users->getUserDetails($this->input->post('post_created_by'));
			if($contact_details->email){
				$to_email = $contact_details->email;
			}
			$this->email->initialize($config);

			$this->email->from($email, $name);
			$this->email->to($to_email); 
			
			$this->email->subject('Collegewaves.com');
			$this->email->message($contact_message);	
			
			$this->email->send();
			$message = $this->lang->line('message_sent_successfully');					
			$this->session->set_flashdata('success_save',$message);
			redirect($this->uri->uri_string().'?return='.$this->input->get('return'));
		}
	}
	function viewthread(){
		
	}
	function captcha_check($code){
		$this->load->helper('recaptchalib');
		$resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,
	                                $this->input->server('REMOTE_ADDR'),
	                                $this->input->post('recaptcha_challenge_field'),
	                                $this->input->post('recaptcha_response_field'));	
	  if (!$resp->is_valid) {
	  	$this->form_validation->set_message('captcha_check', 'The %s entered is invalid');
		return FALSE;
	  }else{
	  	return TRUE;
	  }
	}
	function edit(){
		$this->check_session();			
       		$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.validate.min.js"></script>');		
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.datepicker.min.js"></script>');					
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.core.min.js"></script>');					
			$this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.ui.timepicker.js"></script>');					
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.theme.css" />');
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.datepicker.css" />');
			$this->template->append_metadata('<link  rel="stylesheet" type="text/css" href="'.base_url().'assets/public/css/jquery.ui.timepicker.css" />');
		
			$this->form_validation->set_rules('type','Post Type','required');
				
			$type = $this->input->post('type');
			if($type == 2){
				$this->form_validation->set_rules('university','university','required');
				$this->form_validation->set_rules('category_id','Category ID','required');
				$this->form_validation->set_rules('classified_subject','Classified Subject','required');								
				$this->form_validation->set_rules('classified_description','Classified Description','required');
			}
			if($type==1){
				$this->form_validation->set_rules('event_name','Event Name','required');
				$this->form_validation->set_rules('event_location','Event Location','required');
				$this->form_validation->set_rules('event_date','Event date','required');
				$this->form_validation->set_rules('event_time','Event Time','required');
				$this->form_validation->set_rules('event_details','Event Details','required');				
			}
			if($type == 3){
				$this->form_validation->set_rules('thread_name','Thread Name','required');
				$this->form_validation->set_rules('thread_description','Thread Description','required');
			}
			if($this->form_validation->run()==FALSE){
				$content_id = $this->uri->segment(4);		
				$this->load->model(array('content/mdl_content','users/mdl_users','category/mdl_category','utilities/mdl_html'));
				$categoryOptions = $this->mdl_category->getCategoryOptions();
		        array_unshift($categoryOptions, $this->mdl_html->option( '', 'Select Category'));
		        $content_details = $this->mdl_content->getContentDetailsByUser($content_id,0,$this->session->userdata('user_id'));
				if(count($content_details)==0){
					$this->session->set_flashdata('custom_warning','Error occurred while loading post.');
					redirect('');
				}
		        $category_select=$this->mdl_html->genericlist( $categoryOptions, "category_id",array('class'=>'category'),'value','text',set_value('category_id',$content_details->category_id));
				$data = array(
					'category_select'=>$category_select,
					'content_details'=>$content_details
				);
				$this->template->build('posts/edit',$data);
			}else{
				$this->load->helper('string');
				$content_submit_id = random_string('sha1', 16);
				$type = $this->input->post('type');
				$this->load->model(array('content/mdl_content'));
				if($type == 1){
					$event_name = $this->input->post('event_name');
					$event_location = $this->input->post('event_location');
					$event_date = $this->input->post('event_date');
					$event_time = $this->input->post('event_time');
					$event_details = $this->input->post('event_details');
					$data = array(
						'content_name'=>$event_name,
						'content_alias'=>$event_name,
						'content_date'=>$event_date,
						'content_location'=>$event_location,
						'content_time'=>$event_time,
						'content_long_desc'=>$event_details
					);
				}
				if($type == 2){
					$category_id = $this->input->post('category_id');
					$classified_subject = $this->input->post('classified_subject');
					$classified_description = $this->input->post('classified_description');
					
					$data = array(
						'category_id'=>$category_id,
						'content_name'=>$classified_subject,
						'content_alias'=>$classified_subject,
						'content_long_desc'=>$classified_description,
					);
				}
				if($type == 3){
					$thread_name = $this->input->post('thread_name');
					$thread_description = $this->input->post('thread_description');
					
					$data = array(
						'content_name'=>$thread_name,
						'content_long_desc'=>$thread_description,
					);
				}
				$this->load->library('upload');
				$config['upload_path'] = './uploads/contents/';
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
					@unlink(FCPATH.'uploads/contents/'.$this->input->post('content_image_old'));
					@unlink(FCPATH.'uploads/contents/thumbs/'.$this->input->post('content_image_old'));
					$upload_data = $this->upload->data();
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image']	= FCPATH.'uploads/contents/'.$upload_data['file_name'];
					$config['new_image']	= FCPATH.'uploads/contents/thumbs/'.$upload_data['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 78;
					$config['height']	= 78;
					$config['master_dim'] = 'width';
					
					$this->load->library('image_lib', $config); 
					
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config['new_image']	= FCPATH.'uploads/contents/mediumthumbs/'.$upload_data['file_name'];
					$config['width']	 = 277;
					$config['height']	= 220;
					
					$this->image_lib->initialize($config); 
					
					$this->image_lib->resize();
					
					$upload_data = $this->upload->data();
					$data['content_image']	= $upload_data['file_name'];
				}
				$data['content_modified_by'] = $this->session->userdata('user_id');
				$data['content_modified_ts'] = date('Y-m-d H:i:s');
				$content_id = $this->input->post('content_id');
				if($this->mdl_content->save($data,$content_id)){
					if($type==1){
						$this->session->set_flashdata('success_save',$this->lang->line('event_saved_successfully'));
					}
					if($type==2){
						$this->session->set_flashdata('success_save',$this->lang->line('classified_saved_successfully'));
					}
				}else {
					if($type==1){
						$this->session->set_flashdata('custom_warning',$this->lang->line('event_could_not_be_saved'));
					}
					if($type==2){
						$this->session->set_flashdata('custom_warning',$this->lang->line('classified_could_not_be_saved'));
					}
				}	
				$return = ($this->input->post('return'))?'?return='.$this->input->post('return'):'';
				redirect($this->router->university->university_slug.'/posts/edit/'.$content_id.$return);	
			}	
	}
	function delete(){
		$content_id = $this->input->post('content_id');
		$this->load->model('content/mdl_content');
		if($this->mdl_content->delete(array('content_id'=>$content_id))){
			$this->session->set_flashdata('success_delete',$this->lang->line('post_deleted_successfully'));
		}else{
			$this->session->set_flashdata('success_delete',$this->lang->line('unable_to_deleted_post'));
		}
		redirect('dashboard');
	}
	function getjsonuniversity(){
		$this->load->model(array('university/mdl_university'));
		$university = $this->mdl_university->getUniversities();
		echo json_encode($university);
	}
	function getjsonuniversitybystate(){
		$this->load->model(array('university/mdl_university'));
		$university = $this->mdl_university->getUniversities();
		echo json_encode($university);
	}
	function state($state_slug,$university_slug){
		$this->template->set_layout('login');		
		$this->load->helper('datetime');
		$this->load->model(array('content/mdl_content','users/mdl_users','category/mdl_category','state/mdl_state','university/mdl_university','utilities/mdl_html'));
		$categoryOptions = $this->mdl_category->getCategoryOptions();
	    array_unshift($categoryOptions, $this->mdl_html->option( '', 'Select Category'));
	    $category_select=$this->mdl_html->genericlist( $categoryOptions, "category_id",array('class'=>'category'),'value','text',$this->uri->segment(4));
			
		$this->load->library('pagination');

		$page['start'] =$this->uri->segment('5');
		$page['limit'] = 10;
		$posts = $this->mdl_content->getPostsByStateUniversity($page,$state_slug,$university_slug);
	
		$config['total_rows'] = $posts['total'];
		$config['per_page'] = $page['limit']; 
		
		//print_r($posts['list']);die();
		$this->pagination->initialize($config); 
		
		$navigation = $this->pagination->create_links();
        $data = array(
        		'category_select'=>$category_select,
				'posts'=>$posts['list'],
				'navigation'=>$navigation,
        		'university_id'=>0,
        		'category_select'=>$category_select
        );
        $this->template->build('posts/state',$data);
	}
}