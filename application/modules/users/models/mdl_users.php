<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_users extends MY_Model{
	
	function __construct(){
		parent::__construct();
		$this->table_name = 'ci_users';
		$this->primary_key = 'ci_users.user_id';
		$this->order_by = 'last_name, first_name';
	}
	function getUserlist(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('username ASC');
		$result = $this->db->get();
		return $result->result();
	}
	function getUserDetails($user_id){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('user_id',$user_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}else {
			$user_details = new stdClass();
			$user_details->user_id = 0;
			$user_details->username = '';
			$user_details->first_name = '';
			$user_details->last_name = '';
			$user_details->user_image = '';
			$user_details->email = '';
			$user_details->active = '';
			$user_details->usergroup_id = 0;
			$user_details->language = 0;
			$user_details->language_code = '';
			$user_details->is_admin = 0;
			$user_details->gender = 0;
			$user_details->age = '';
			$user_details->occupation = '';
			$user_details->address1 = '';
			$user_details->address2 = '';
			$user_details->address3 = '';
			$user_details->user_image = '';
			
			return $user_details;
		}
	}
	function getUserByName($user_name){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('username',$user_name);
		$result = $this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}else {
			$user_details = new stdClass();
			$user_details->user_id = 0;
			$user_details->username = '';
			$user_details->first_name = '';
			$user_details->last_name = '';
			$user_details->user_image = '';
			$user_details->email = '';
			$user_details->active = '';
			$user_details->usergroup_id = 0;
			$user_details->language = 0;
			$user_details->language_code = '';
			$user_details->is_admin = 0;
			$user_details->gender = 0;
			$user_details->age = '';
			$user_details->occupation = '';
			$user_details->address1 = '';
			$user_details->address2 = '';
			$user_details->address3 = '';
			
			return $user_details;
		}
	}
}
?>