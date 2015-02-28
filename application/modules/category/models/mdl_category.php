<?php defined('BASEPATH') or die('Direct access script is not allowed');

/**
 * Description of mdl_category
 *
 * @author GHANSHYAM
 */
class Mdl_Category extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->table_name = 'ci_categories';
        $this->primary_key = 'ci_categories.category_id';
    }
    function getCategoryList($page,$category_parent_id=0){
        $this->db->select('SQL_CALC_FOUND_ROWS c.category_id,c.category_parent_id,c.category_name,c.category_image,c.category_details,c.category_short_details,c.category_created_ts',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->where('c.category_parent_id',$category_parent_id);
        $this->db->limit($page['limit'], $page['start']);
        $result = $this->db->get();        
        $category['list'] = $result->result();
        
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $category['total'] = $result_total->row()->total;
        
        return $category;
    }
	function getCategoryDetails($category_id=0){
        $this->db->select('c.category_id,c.category_parent_id,c.category_name,c.category_image,c.category_details,c.category_short_details,c.category_created_ts',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->where('c.category_id',$category_id);
        $result = $this->db->get();        
        
        if($result->num_rows()>0){
			$category = $result->row();			
		}else{
			$category = new stdClass();
			$category->category_id = 0;
			$category->category_name = '';
			$category->category_details = '';
		}
		
		//echo $this->db->last_query();
        
        return $category;
    }
    function getCategoryOptions($category_id = 0){
    			$params=array(
					  "select"=>"category_id AS value, category_name AS text",
					  "where"=>array("category_parent_id"=>$category_id)
		);
		return $this->get($params);
    }
}

?>
