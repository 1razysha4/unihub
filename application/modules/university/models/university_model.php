<?php
class university_model extends CI_Model{

	function getId($slug){
		$sql = "select university_id from ci_universities where university_slug = '$slug'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res)
			return $res;
		else
			return false;

	}

	function getUniversityData($id){
		$sql = "select * from ci_contents where university_id = $id";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res)
			return $res;
		else
			return false;
	}

	function getUniversityImage($slug){
		$sql = "select * from ci_universities where university_slug = '$slug'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res)
			return $res;
		else
			return false;
	}

	function getCategories(){
		$sql = "select * from ci_categories";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res)
			return $res;
		else
			return false;
	}

	function getContentBySlug($slug){
		$slug = str_replace('%20', ' ', $slug);
		$sql = "select * from ci_contents where content_alias = '$slug'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res)
			return $res;
		else
			return false;
	}

}