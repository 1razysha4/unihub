<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_State extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table_name = 'ci_states';
		$this->primary_key = 'state_id';
		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";
		$this->order_by = 'state_name';
	}
	public function getStateOptions(){
		$params=array(
					  "select"=>"state_id as value, state_name as text",
					  "order_by"=>"state_name ASC"
		);
		return $this->get($params);
	}
	function getStateList($page = array('limit'=>10,'start'=>0)){
		$this->db->select('SQL_CALC_FOUND_ROWS s.state_id,s.state_name,s.country_id,c.country_name,show_front',false);
		$this->db->from($this->table_name.' AS s');
		$this->db->join($this->mdl_country->table_name.' AS c','c.country_id=s.country_id','left');
		$this->db->limit((int)$page['limit'],(int)$page['start']);
		$result = $this->db->get();
		//echo nl2br($this->db->last_query());
		
		$list['states'] = $result->result();
		
		$query = $this->db->query('SELECT FOUND_ROWS() total');
		$total_found = $query->row()->total;
		
		$list['total'] = $total_found;
		return $list;
	}
	function getStateDetails($state_id){
		$this->db->select('state_id,state_name,country_id,show_front');
		$this->db->from($this->table_name);
		$this->db->where('state_id',$state_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			$details =  $result->row();
		}else{
			$details = new stdClass();
			$details->state_id = 0;
			$details->state_name = '';
			$details->country_id = 0;
			$details->show_front = 0;
		}
		return $details;
	}
}

?>