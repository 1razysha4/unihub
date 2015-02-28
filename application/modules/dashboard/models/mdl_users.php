<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_users extends MY_Model{
	
	function __construct(){
		parent::__construct();
		$this->table_name = 'ci_users';
		$this->primary_key = 'ci_users.user_id';
		$this->order_by = 'last_name, first_name';
	}
}
	
?>