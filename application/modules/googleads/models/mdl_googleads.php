<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_GoogleAds extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table_name = 'ci_googleads';
		$this->primary_key = 'google_ad_id';
		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";
		$this->order_by = 'google_ad_title';
	}
	function getGoogleAdList($page = array('limit'=>10,'start'=>0)){
		$this->db->select('SQL_CALC_FOUND_ROWS g.google_ad_id,g.google_ad_title,g.google_ad_active,g.page',false);
		$this->db->from($this->table_name.' AS g');
		$this->db->limit((int)$page['limit'],(int)$page['start']);
		$result = $this->db->get();
		//echo nl2br($this->db->last_query());
		
		$list['googleads'] = $result->result();
		
		$query = $this->db->query('SELECT FOUND_ROWS() total');
		$total_found = $query->row()->total;
		
		$list['total'] = $total_found;
		return $list;
	}
	function getGoogleAdDetails($google_ad_id){
		$this->db->select('g.google_ad_id,g.google_ad_title,g.google_ad_html,g.google_ad_active,page');
		$this->db->from($this->table_name.' AS g');
		$this->db->where('google_ad_id',$google_ad_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			$details =  $result->row();
		}else{
			$details = new stdClass();
			$details->google_ad_id = 0;
			$details->google_ad_title = '';
			$details->google_ad_html = '';
			$details->google_ad_active = 0;
			$details->page = '';
		}
		return $details;
	}
}

?>