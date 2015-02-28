<?php defined('BASEPATH') or die('Direct access script is not allowed');

/**
 * Description of mdl_category
 *
 * @author GHANSHYAM
 */
class Mdl_Content extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->table_name = 'ci_contents';
        $this->primary_key = 'ci_contents.content_id';
    }


    function getAllCountries(){
        $sql = "select * from ci_countries";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if($res)
            return $res;
        else
            return false;
    }

    public function getStatesByCountryId($id){
        $sql = "select state_id,state_name from ci_states where country_id = $id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if($res)
            return $res;
        else
            return false;
    }

    public function getUniverityByStateId($state_id){
        $sql = "select university_id,university_name from ci_universities where state_id = $state_id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if($res)
            return $res;
        else
            return false;
    }

    public function getUniversitySlugById($id){
        $sql = "select university_slug from ci_universities where university_id = $id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if($res)
            return $res;
        else
            return false;
    }

    public function getContentDetailsByUniversityId($id){
        $sql = "select * from ci_contents where university_id = $id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if($res)
            return $res;
        else
            return false;
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


    function getPostsByUniversity($page,$university_id,$post_type='',$category_id = 0){
    	if($post_type==1){
    		$this->db->where('content_type',1);        
    	}else if($post_type==2){
    		$this->db->where('content_type',2);   		
    	}else if($post_type==3){
    		$this->db->where('content_type',3);   		
    	}else{
    		$this->db->where('content_type',2);
    	}
    	if((int)$category_id>0){
    		$this->db->where('ct.category_id',$category_id);   		    		
    	}
        $this->db->select('SQL_CALC_FOUND_ROWS c.content_id,c.content_name,c.content_date,c.content_type,ct.category_name,c.content_long_desc,u.username AS posted_by,c.content_created_ts,c.content_image,c.content_page_views,c.content_created_by,COALESCE(cm.total_comments,0) AS total_comments',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=c.content_created_by','left');
        $this->db->join('(
						SELECT comment_resource_id,COUNT(comment_resource_id) AS total_comments,comment_resource_type
						FROM ci_comments
						GROUP BY comment_resource_id
						) AS cm', 'cm.comment_resource_id=c.content_id AND comment_resource_type="content"','left');
        $this->db->where('c.university_id',$university_id);
        $this->db->where('content_status',1);
        $this->db->order_by('content_created_ts DESC');
        $this->db->limit($page['limit'], $page['start']);
        $result = $this->db->get();        
        
        $content['list'] = $result->result();
        //echo $this->db->last_query();die();
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $content['total'] = $result_total->row()->total;
        
        return $content;
    }


    function getContentDetails($content_id = 0,$content_status=1){
    	$this->db->select('*',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=c.content_created_by','left');
        $this->db->join('ci_universities AS un', 'un.university_id=c.university_id','left');        
        $this->db->where('content_id',$content_id);
       // $this->db->where('content_status',$content_status);
        
        $result = $this->db->get();        
        
        $details = $result->row();
        return $details;
    }
	function getContentDetailsById($content_id = 0){
    	$this->db->select('*',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_university->table_name.' AS u', 'u.university_id=c.university_id','left');        
        $this->db->join($this->mdl_users->table_name.' AS a', 'a.user_id=c.content_created_by','left');
        $this->db->where('content_id',$content_id);
        
        $result = $this->db->get();        
        
        $details = $result->row();
        return $details;
    }
    function getContentDetailsByUser($content_id = 0,$content_status=1,$user_id = 0){
    	$this->db->select('*',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=c.content_created_by','left');
        $this->db->where('content_id',$content_id);
        //$this->db->where('content_status',$content_status);
        $this->db->where('content_created_by',$user_id);
        
        $result = $this->db->get();        
        
        $details = $result->row();
        return $details;
    }
    function getContentList(){
    	$this->db->select('c.content_id,c.content_name,c.content_date,c.content_type,c.content_date,ct.category_name,u.university_name,c.content_status',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join('ci_universities AS u', 'u.university_id=c.university_id','left');
        $this->db->limit(20,$this->uri->segment(4));
        $this->db->order_by('content_status ASC, c.content_date DESC');
        
        $result = $this->db->get();        
        $contents['contents'] = $result->result();
        
        $this->db->select('COUNT(c.content_id) AS  total');
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join('ci_universities AS u', 'u.university_id=c.university_id','left');
        $this->db->order_by('content_status ASC, c.content_date DESC');
        $result = $this->db->get();      
        
        $total = $result->row()->total;
        $contents['total'] = $total;
        return $contents;
    }
	function getContentListByUser($content_type,$user_id){
		if($content_type>0){
			$this->db->where('c.content_type',$content_type);
		}
    	$this->db->select('c.content_id,c.content_name,c.content_date,c.content_type,c.content_date,ct.category_name,u.university_name,u.university_slug,c.content_status,c.content_page_views',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join('ci_universities AS u', 'u.university_id=c.university_id','left');
        $this->db->where('content_created_by',$user_id);
        $this->db->limit(10,$this->uri->segment(2));
        $this->db->order_by('content_status ASC, c.content_created_ts DESC');
        
        $result = $this->db->get();        
        $contents['contents'] = $result->result();
        
		if($content_type>0){
			$this->db->where('c.content_type',$content_type);
		}
        $this->db->select('COUNT(c.content_id) AS  total');
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join('ci_universities AS u', 'u.university_id=c.university_id','left');
        $this->db->where('content_created_by',$user_id);        
        $this->db->order_by('content_status ASC, c.content_created_ts DESC');
        $result = $this->db->get();      
        
        $total = $result->row()->total;
        $contents['total'] = $total;
        return $contents;
    }
    function getOtherContentListByUser($user_id,$content_id=0,$limit=3){
    	$this->db->select('c.content_id,c.content_name,c.content_type',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->where('content_created_by',$user_id);
        $this->db->where('content_id !=',$content_id);
        $this->db->where('content_status',1);
        $this->db->limit($limit);
        $this->db->order_by('content_status ASC, c.content_created_ts DESC');
        
        $result = $this->db->get();        
        return $result->result();
    }
	function getLatestContentList($limit=5){
    	$this->db->select('c.content_id,c.content_name,c.content_long_desc,c.content_type,ct.category_name,u.university_slug,c.content_image,c.content_long_desc,c.content_created_ts,a.username',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_university->table_name.' AS u', 'u.university_id=c.university_id','left');
        $this->db->join($this->mdl_users->table_name.' AS a', 'a.user_id=c.content_created_by','left');
        $this->db->where('content_status',1);
        $this->db->limit($limit);
        $this->db->order_by('c.content_created_ts DESC');
        
        $result = $this->db->get();        
        return $result->result();
    }
	function getPopularContentList($limit=5){
    	$this->db->select('c.content_id,c.content_name,c.content_long_desc,c.content_type,ct.category_name,u.university_slug,c.content_image,c.content_long_desc,c.content_created_ts,a.username',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_university->table_name.' AS u', 'u.university_id=c.university_id','left');
        $this->db->join($this->mdl_users->table_name.' AS a', 'a.user_id=c.content_created_by','left');
        $this->db->where('c.content_status',1);
        $this->db->where('c.content_page_views >',0);
        $this->db->limit($limit);
        $this->db->order_by('c.content_page_views DESC,c.content_created_ts DESC');
        
        $result = $this->db->get();        
        return $result->result();
    }
	function getSliderContent($limit=10){
    	$this->db->select('c.content_id,c.content_name,u.university_slug,c.content_image',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_university->table_name.' AS u', 'u.university_id=c.university_id','left');       
        //$this->db->where('content_image !=""');
        $this->db->where('content_status',1);
        $this->db->where('content_type !=',3);
        $this->db->limit($limit);
        $this->db->order_by('content_status ASC, c.content_created_ts DESC');
        
        $result = $this->db->get();        
        return $result->result();
    }
    function getCategoryDetailsByStates(){
    	$sql = 'SELECT s.state_name,ct.category_name,COUNT(c.content_id) AS total_posts,c.category_id,s.state_id,s.state_slug
				FROM ci_states AS s
				LEFT JOIN ci_universities AS u ON u.state_id=s.state_id
				LEFT OUTER JOIN ci_contents AS c ON c.university_id=u.university_id AND c.content_type=2
				LEFT JOIN ci_categories AS ct ON ct.category_id=c.category_id
				WHERE s.show_front=1
				GROUP BY s.state_id,ct.category_id
				ORDER BY s.state_name ASC'
    	;
    	$result = $this->db->query($sql);
    	return $result->result();
    }
    function getUniversityDetailsByStates(){
    	$sql = 'SELECT s.state_name,u.university_name,u.university_id,u.university_slug,COUNT(c.content_id) AS total_posts,c.category_id,s.state_id,s.state_slug
				FROM ci_states AS s
				LEFT JOIN ci_universities AS u ON u.state_id=s.state_id AND u.is_top=1
				LEFT OUTER JOIN ci_contents AS c ON c.university_id=u.university_id AND c.content_type=2
				WHERE s.show_front=1				
				GROUP BY s.state_id,c.university_id
				ORDER BY s.state_name ASC, u.university_name ASC'
    	;
		$sql = 'SELECT s.state_name,GROUP_CONCAT(u.university_name,"@",u.university_slug,"@",COALESCE(c.total_posts,0)) AS universities,s.state_id,s.state_slug
				FROM ci_states AS s
				LEFT JOIN ci_universities AS u ON u.state_id=s.state_id
				LEFT JOIN (
					SELECT cc.university_id, COUNT(cc.content_id) AS total_posts
					FROM ci_contents AS cc 
					INNER JOIN ci_users AS a ON a.user_id=cc.content_created_by
					GROUP BY cc.university_id
				) AS c ON c.university_id=u.university_id
				WHERE s.show_front=1		
				GROUP BY s.state_id
				ORDER BY s.state_name ASC, u.university_name ASC				
		';
		//echo nl2br($sql);die();
    	$result = $this->db->query($sql);
    	return $result->result();
    }
    function getPostsByStateCategoryId($page,$state_slug,$category_id){
    	if((int)$category_id>0){
    		$this->db->where('c.category_id',$category_id);   		    		
    	}
        $this->db->select('SQL_CALC_FOUND_ROWS c.content_id,c.content_name,c.content_date,c.content_type,ct.category_name,c.content_long_desc,u.username AS posted_by,c.content_created_ts,c.content_image,un.university_slug',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=c.content_created_by');
        $this->db->join($this->mdl_university->table_name.' AS un', 'un.university_id=c.university_id','left');
        $this->db->join($this->mdl_state->table_name.' AS s','s.state_id=un.state_id','left');
        $this->db->where('s.state_slug',$state_slug);
        //$this->db->where('content_status',2);
        $this->db->where('content_type',2);   		
    	$this->db->order_by('content_created_ts DESC');
        $this->db->limit($page['limit'], $page['start']);
        $result = $this->db->get();        
        
        $content['list'] = $result->result();
        //echo $this->db->last_query();die();
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $content['total'] = $result_total->row()->total;
        
        return $content;    	
    }
    function getPostsByStateUniversity($page,$state_slug,$university_slug){
        $this->db->select('SQL_CALC_FOUND_ROWS c.content_id,c.content_name,c.content_date,c.content_type,ct.category_name,c.content_long_desc,u.username AS posted_by,c.content_created_ts,c.content_image,un.university_slug',false);
        $this->db->from($this->table_name.' AS c');
        $this->db->join($this->mdl_category->table_name.' AS ct', 'ct.category_id=c.category_id','left');
        $this->db->join($this->mdl_users->table_name.' AS u', 'u.user_id=c.content_created_by');
        $this->db->join($this->mdl_university->table_name.' AS un', 'un.university_id=c.university_id','left');
        $this->db->join($this->mdl_state->table_name.' AS s','s.state_id=un.state_id','left');
        $this->db->where('s.state_slug',$state_slug);
        $this->db->where('un.university_slug',$university_slug);   		    		        
        //$this->db->where('content_status',2);
        $this->db->where('content_type',2);   		
    	$this->db->order_by('content_created_ts DESC');
        $this->db->limit($page['limit'], $page['start']);
        $result = $this->db->get();        
        
        $content['list'] = $result->result();
        //echo $this->db->last_query();die();
        $result_total = $this->db->query('SELECT FOUND_ROWS() AS total');
        $content['total'] = $result_total->row()->total;
        
        return $content;    	
    }
}

?>
