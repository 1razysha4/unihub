<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Menus extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'ci_menus';

		$this->primary_key = 'ci_menus.menu_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->order_by = 'menu_ordering';
	}

	public function getMenuByParentId($parent_id)
	{
		$this->db->select('*');
                $this->db->from($this->table_name);
                $this->db->where('menu_status',1);
                $this->db->where('menu_type',1);
                $this->db->order_by('menu_ordering'); 
                $query = $this->db->get();
		$menus = $query->result();
		return $menus;
	}
        function getMenusList(){
            $this->db->select();
            $this->db->from($this->table_name.' AS m');
            $this->db->where('m.menu_type', 0);
            $result = $this->db->get();
            $list = $result->result();
            $menus['list'] = $list;
            $menus['total'] = 10;
            return $menus;
        }
	public function childNumber($id){
		$params=array(
					 "select"=>"count(*) as cnt",
					 "where"=>array("parent_id"=>$id),
					 'limit'=>1
		);
		$cntarr=$this->get($params);
		return $cntarr[0]->cnt;
	}
        function getMenuDetails($menu_id = 0){
            $this->db->select('*');
            $this->db->from($this->table_name);
            $this->where('menu_type',1);
            $result = $this->db->get();
            if($result->num_rows()>0){
                return $result->row();
            }else{
                $details = new stdClass();
                return $details;
            }
        }
}

?>