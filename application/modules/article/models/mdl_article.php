<?php defined('BASEPATH') or die('Direct access script is not allowed');

/**
 * Description of mdl_category
 *
 * @author GHANSHYAM
 */
class Mdl_Article extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->table_name = 'ci_articles';
        $this->primary_key = 'ci_articles.article_id';
    }
    function getArticleList($page){
        $this->db->select('SQL_CALC_FOUND_ROWS a.*,ct.category_name',false);
        $this->db->from($this->table_name.' AS a');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=a.category_id','left');
        $this->db->limit($page['limit'], $page['start']);
        $result = $this->db->get();        
        $contents['articles'] = $result->result();
        
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $contents['total'] = $result_total->row()->total;
        
        return $contents;
    }
    function getArticleDetails($article_id = 0){
    	$this->db->select('*',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->where('article_id',$article_id);
        
        $result = $this->db->get();        
       	if($result->num_rows()>0){ 
        	$details = $result->row();
       	}else{
       		$details = new stdClass();
       		$details->article_id = 0;
       		$details->article_name = '';
       		$details->article_alias = '';
       		$details->article_date = '';
       		$details->article_short_desc = '';
       		$details->article_long_desc = '';
       		$details->article_image = '';
       		$details->article_status = 1;
       		$details->featured = 0;
			$details->category_id = -1;
			$details->show_fb_comment = 0;
       	}
        return $details;
    }
	function getArticleDetailsBySlug($article_alias){
		$this->db->select('a.article_id,a.article_name,a.article_long_desc,ct.category_name,a.article_image,a.article_alias,a.article_page_views,a.article_created_ts,u.username,a.show_fb_comment',false);
        $this->db->from($this->table_name.' AS a');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=a.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=a.article_created_by','left');
        $this->db->where('a.article_status',1);
        $this->db->where('article_alias',$article_alias);
        
        $result = $this->db->get();        
        $details = $result->row();
        return $details;
    }	
    function getLatestArticles($limit = 10){
    	$this->db->select('a.article_id,a.article_name,a.article_long_desc,ct.category_name,a.article_image,a.article_alias,a.article_created_ts,u.username',false);
        $this->db->from($this->table_name.' AS a');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=a.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=a.article_created_by','left');
        $this->db->where('a.article_status',1);
        $this->db->limit($limit);
        $this->db->order_by('a.article_created_ts DESC');
        
        $result = $this->db->get();        
        return $result->result();
    }
}

?>
