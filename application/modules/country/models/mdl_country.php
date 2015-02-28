<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Country extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table_name = 'ci_countries';
		$this->primary_key = 'country_id';
		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";
		$this->order_by = 'country_name';
	}
	public function getUniversityOptions(){
		$params=array(
					  "select"=>"country_id as value, country_name as text"
		);
		return $this->get($params);
	}
	function getCountryList(){
		$this->db->select('country_id,country_name,country_code');
		$this->db->from($this->table_name);
		$result = $this->db->get();		
		//echo nl2br($this->db->last_query());
		
		$list['countries'] = $result->result();
		
		$query = $this->db->query('SELECT FOUND_ROWS() total');
		$total_found = $query->row()->total;
		
		$list['total'] = $total_found;
		return $list;
	}
	function getCountryOptions(){
		$this->db->select('country_id AS value,country_name AS text');
		$this->db->from($this->table_name);
		$result = $this->db->get();
		return $result->result();
	}
	function getCountryDetails($country_id){
		$this->db->select('country_id,country_name,country_code');
		$this->db->from($this->table_name);
		$this->db->where('country_id',$country_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			$details =  $result->row();
		}else{
			$details = new stdClass();
			$details->country_id = 0;
			$details->country_name = '';
		}
		return $details;
	}
}

?>