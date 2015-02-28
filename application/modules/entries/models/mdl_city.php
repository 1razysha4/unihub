<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_City extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table_name = 'ci_city';
		$this->primary_key = 'city_id';
		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";
		$this->order_by = 'universitcity_name';
	}
	public function getCityOptions(){
		$params=array(
					  "select"=>"city_id as value, city_name as text"
		);
		return $this->get($params);
	}
}

?>