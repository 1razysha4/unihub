<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<?php
if($this->uri->segment(1)=='about-us'){
		$this->load->view('blocks/right_info');
}else{
	if($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='profile'){	
		$this->load->view('blocks/dashboard');
	}
}
?>