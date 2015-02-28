<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_Pages extends MY_Model{
	
	function __construct(){
		parent::__construct();
		$this->table_name = 'ci_pages';
		$this->primary_key = 'ci_pages.page_id';
		$this->order_by = 'page_id';
	}
	function getPageList(){
		$this->db->select('page_id,page_name,page_active,page_type');
		$this->db->from($this->table_name);
		$result = $this->db->get();
		return $result->result();
	}
	function getPageDetails($page_id){
		$this->db->select('page_id,page_name,page_description,page_active,page_slug,page_type,page_order,show_fb_comment,show_google_ad,google_ad_html');
		$this->db->from($this->table_name);
		$this->db->where('page_id',$page_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details[0] = new stdClass();
			$details[0]->page_id = 0;
			$details[0]->page_name = '';
			$details[0]->page_description = '';
			$details[0]->page_active = 1;
			$details[0]->page_slug = '';
			$details[0]->page_type = '';
			$details[0]->page_order = 0;
			$details[0]->show_fb_comment = 0;
			$details[0]->show_google_ad = 0;
			$details[0]->google_ad_html = '';
			
			return $details;
		}
	}
	function getPageInfo($page_id){
		$this->db->select('page_id,page_name,page_description,page_active,page_slug,page_type,show_fb_comment,show_google_ad,google_ad_html');
		$this->db->from($this->table_name);
		$this->db->where('page_id',$page_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}else{
			$details = array();
			$details->page_id = 0;
			$details->page_name = '';
			$details->page_description = '';
			$details->page_active = 1;
			$details->page_slug = '';
			$details->show_fb_comment = 0;
			$details->show_google_ad = 0;
			$details->google_ad_html= '';
			return $details;
		}
	}
	function getPageOptions(){
		$params = array(
						'select'=>'page_id AS value,page_name AS text'
						);
		return $this->get($params);
	}
	function getPageSlugOptions(){
		$params = array(
						'select'=>'page_slug AS value,page_name AS text'
						);
		return $this->get($params);
	}
	function getPages($page_type){
		$this->db->select('page_id,page_name,page_active,page_slug');
		$this->db->where('page_active',1);
		$this->db->where('page_type',$page_type);
		$this->db->from($this->table_name);
		$this->db->order_by('page_order ASC');
		$result = $this->db->get();
		return $result->result();
	}
}
	
?>