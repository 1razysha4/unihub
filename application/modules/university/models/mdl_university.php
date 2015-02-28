<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_University extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'ci_universities';

		$this->primary_key = 'ci_universities.university_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->order_by = 'university_name';
	}
	function getUniversityList(){
		$search = $this->input->get('search');
		if($search){
			$this->db->like('u.university_name',$search);
		}
		$this->db->select('u.university_name,u.university_id,s.state_name,c.country_name',false);
        $this->db->from($this->table_name.' AS u');
        $this->db->join($this->mdl_state->table_name.' AS s', 's.state_id=u.state_id','left');
		$this->db->join($this->mdl_country->table_name.' AS c', 'c.country_id=s.country_id','left');
        $this->db->limit(20,$this->uri->segment(4));
        $this->db->order_by('s.state_name ASC,university_name ASC');
        
        $result = $this->db->get();        
        $contents['universities'] = $result->result();
        $this->db->select('COUNT(u.university_id) AS  total');
        $this->db->from($this->table_name.' AS u');
        $this->db->join($this->mdl_state->table_name.' AS s', 's.state_id=u.state_id','left');
        $result = $this->db->get();      
        
        $total = $result->row()->total;
        $contents['total'] = $total;
        return $contents;
	}
	function getUniversityDetails($university_id){
		$this->db->select('u.university_name,u.university_id,u.university_slug,university_address,u.state_id,u.university_image,is_top',false);
        $this->db->from($this->table_name.' AS u');
        $this->db->where('university_id',$university_id);
		$result = $this->db->get();      
        
		if($result->num_rows()>0){
        	$details = $result->row();
		}else{
			$details = new stdClass();
			$details->university_name = '';
			$details->university_id = '';
			$details->university_slug = '';
			$details->university_address = '';
			$details->state_id = '';
			$details->university_image = '';
			$details->is_top = '';
		}
        return $details;
	}
	public function getUniversityOptions(){
		$params=array(
					  "select"=>"university_slug as value, university_name as text"
		);
		return $this->get($params);
	}
	function getUniversities(){
		$searchtxt=$this->input->get('term');
		$pdesc=$this->input->get('pdesc');
		$state_id=$this->input->get('state_id');
		if(!empty($pdesc)){
			//$this->db->or_like('pp.part_desc', $pdesc);
		}
		if((int)$state_id>0){
			$this->db->where('u.state_id', $state_id);
		}
		$this->db->select('u.university_slug AS id,u.university_name AS label',false);
		$this->db->from($this->mdl_university->table_name.' AS u');
		$this->db->order_by('u.university_name ASC');
		$this->db->like('u.university_name', $searchtxt);
		
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}
	function getSliderContent($limit = 20){
		$this->db->select('u.university_name,u.university_id,u.university_slug,u.university_image,is_top',false);
        $this->db->from($this->table_name.' AS u');
        $this->db->order_by('is_top DESC,u.university_name ASC');
        $this->db->limit($limit);
		$result = $this->db->get(); 
		
		return $result->result();
	}
}

?>