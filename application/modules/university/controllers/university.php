<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class University extends MX_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('university/university_model');
		$this->load->library('template');
	}

	function index(){
		$slug = $this->uri->segment(2);
		$data = $this->university_model->getId($slug);
		if(is_array($data))
		$id = $data[0]['university_id'];

		$universitydata = $this->university_model->getUniversityData($id);
		$university 	= $this->university_model->getUniversityImage($slug);
		$category 		= $this->university_model->getCategories();

		$data = array(
			'recordData' 	=> $universitydata,
			'university'	=> $university,
			'title'			=> $university[0]['university_name']."- University",
			'categories'	=> $category
 		);

		$this->load->view('university/page',$data);
	}

	function articles($slug=''){
		$slug = $this->uri->segment(3);
		$recordData = $this->university_model->getContentBySlug($slug);
		
		$data  = array(
			'recordData' 	=> $recordData, 
			'title'			=> $recordData[0]['content_name'],
		);
		$this->load->view('university/articles', $data);
	}
}