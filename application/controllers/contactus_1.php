<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactus extends Public_Controller {

	function __construct(){
		parent::__construct();
		$this->title = 'Contact Us';
		$this->type=1;
	}

	function editor(){
		$this->title ='Write to Editor';
		$this->type=2;
		$this->index();
	}

	function advertise(){
		$this->title ='Advertise Here';
		$this->type=3;
		$this->index();
	}


	function index(){
        $this->form_validation->set_rules('email',$this->lang->line('email'),'trim|required|valid_email');
		$this->form_validation->set_rules('name',$this->lang->line('name'),'trim|required');
		$this->form_validation->set_rules('message',$this->lang->line('message'),'trim|required');

		if($this->form_validation->run($this)== FALSE){
			// $this->template->inject_partial('googleads','');
			// $this->template->append_metadata('<script src="'.base_url().'assets/public/js/jquery.validate.min.js"></script>');
			
			// $this->load->helper('ci_slug_helper');
			// if($google_ads = get_page_googleads('contact-us')){
			// 	$this->router->details->show_google_ad = 1;
			// 	$this->router->details->google_ad_html = $google_ads->google_ad_html;				
			// }
			// $this->template->set_partial('googleads_2','blocks/googleads');

			$data = array(
					'title'	=> 'Contact Us',
			);

			$this->load->view('contactus/index',$data);
		}else{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			$data = array(
						  'name'=>$name,
						  'email'=>$email,
						  'message'=>$message
						  );
			$data['user_id'] = $this->db->insert_id();
			$this->load->library('email');
			
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			
			$this->email->from( 'Collegewaves.com');
			$this->email->to(DOMAN_ADMIN_EMAIl); 
			$message = $this->load->view('email_templates/feedback',$data,true);
			$this->email->subject('Feedback');
			$this->email->message($message);	

			$this->email->send();
			$this->session->set_flashdata('success_save','Your message has been sent successfully.');
			redirect('');
		}			  
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
}