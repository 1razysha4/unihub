<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

function is_valid_page($slug) {
	$db = &DB();
	 $db->where('page_slug',$slug);
	$result = $db->get('ci_pages');
	if($result->num_rows()){
		return $result->row();
	}
}
function get_page_googleads($slug) {
	$db = &DB();
	 $db->select('google_ad_title,google_ad_html',$slug);
	 $db->where('page',$slug);
	 $db->where('google_ad_active',1);
	$result = $db->get('ci_googleads');
	if($result->num_rows()){
		return $result->row();
	}
}
function is_valid_university($slug) {
	$db = &DB();
	$db->select('university_id,university_name,university_slug,s.state_id,c.country_id');
	$db->where('university_slug',$slug);
	$db->join('ci_states AS s','s.state_id=u.state_id','left');
	$db->join('ci_countries AS c','c.country_id=s.country_id','left');
	$result = $db->get('ci_universities AS u');
	//echo $db->last_query();die();
	
	if($result->num_rows()){
		return $result->row();
	}
}
function is_valid_user($slug) {
	$db = &DB();
	 $db->where('username',$slug);
	 $db->where('username !=','admin');
	$result = $db->get('ci_users');
	if($result->num_rows()){
		return $result->row();
	}
}
function get_countries($slug){
	$db = &DB();
	$data = array();
	$db->select('country_id AS value,country_name AS text');
	$result = $db->get('ci_countries');
	
	if($result->num_rows()){
		$countries =  $result->result();
		$data['countries'] = $countries;
	}else{
		$data['countries'] = array();
		}
	$db->select('s.state_id AS value,s.state_name AS text');
	$db->from('ci_states AS s');
	$db->where("s.country_id IN(
							SELECT s.country_id 
							FROM ci_universities AS u
							LEFT JOIN ci_states AS s ON s.state_id=u.state_id
							WHERE u.university_slug='$slug'
							)");	
							
	//$db->where('university_slug',$slug);	
	$result = $db->get();
	
	if($result->num_rows()){
		$states =  $result->result();
		$data['states'] = $states;
	}else{
		$data['states'] = array();
	}
	$db->select('university_slug AS value,university_name AS text');
	$db->where("state_id IN(SELECT state_id FROM ci_universities WHERE university_slug='$slug')");	
	$result = $db->get('ci_universities');
	
	if($result->num_rows()){
		$universities =  $result->result();
		$data['universities'] = $universities;
	}else{
		$data['universities'] = array();
	}
	
	return  $data;
}
?>
