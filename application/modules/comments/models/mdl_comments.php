<?php defined('BASEPATH') or die('Direct access is not allowed');
class Mdl_Comments extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'ci_comments';
		$this->primary_key = 'ci_comments.comment_id';		
		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";
		$this->order_by = 'comment_id';
	}
	function commentsByContentId($content_id,$page){
		$this->db->select('SQL_CALC_FOUND_ROWS c.comment_id,u.username,u.user_image,u.name,c.comment_text,c.comment_dt,u.username',false);
		$this->db->from($this->table_name.' AS c');
		$this->db->join($this->mdl_users->table_name.' AS u','u.user_id=c.user_id','left');
		$this->db->where('c.comment_resource_id',$content_id);
		$this->db->where('c.comment_resource_type','content');
		$this->db->where('c.comment_status',1);
		$this->db->order_by('c.comment_dt DESC, c.comment_id DESC');
		$this->db->limit((int)$page['limit'],(int)$page['start']);
				
		$result = $this->db->get();
		//echo $this->db->last_query();
		$comments =  $result->result();
		
		$list['comments'] = $comments;
		
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $list['total'] = $result_total->row()->total;
        
		return $list;
	}
}
?>