<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Router.php";

class MY_Router extends MX_Router {
	public function _validate_request($segments) {
		if (count($segments) == 0) return $segments;
		if(count($segments)>0){
			require_once BASEPATH.'database/DB'.EXT;
			require_once APPPATH.'helpers/ci_slug_helper'.EXT;				
			if($country = get_countries($segments[0])){
					$this->search_data = $country;
			}
		}
		if (count($segments) == 1) {
			if($row = is_valid_page($segments[0])){
				$this->pages = $row;
				$segments = array('pages','page',$row->page_id);
				
				return $segments;	
			}							
		}
		if (count($segments) >= 2) {
			require_once BASEPATH.'database/DB'.EXT;
			require_once APPPATH.'helpers/ci_slug_helper'.EXT;			
			if($row = is_valid_page($segments[1])){
				$this->pages = $row;
				$segments = array('pages','page',$row->page_id);
				
				return $segments;	
			}
			if($country = get_countries($segments[0])){
					$this->search_data = $country;
			}
			if($row = is_valid_university($segments[0])){
				$this->university = $row;
				$segments = array('posts',$segments[2],$row->university_id);				
				return $segments;	
			}
		}
		/* locate module controller */
		if ($located = $this->locate($segments)) return $located;
		
		/* use a default 404_override controller */
		if (isset($this->routes['404_override']) AND $this->routes['404_override']) {
			$segments = explode('/', $this->routes['404_override']);
			if ($located = $this->locate($segments)) return $located;
		}
			
		return parent::_validate_request($segments);
	}
	
	public function _set_request($segments){
		return parent::_set_request($segments);
	}
}