<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Menus{

	var $CI;

	/**
	 * Authentication Constructor
	 *
	 * The constructor runs the session routines automatically
	 * whenever the class is instantiated.
	 */
	function CI_Menus($params = array())
	{
		log_message('debug', "Authencation Class Initialized");
		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
		$this->CI->load->model('menus/mdl_menus');
	}
	function printMenu($menus,$level,$i)
	{
		if($level ==0)
		{
			$menus = $this->CI->mdl_menus->getMenuByParentId(0);
		}
		foreach($menus as $menu)
		{
			$total = $this->CI->mdl_menus->childNumber($menu->menu_id);
			$seg = uri_string();
			$active='';
			if($seg==$menu->menu_alias){
				$active = " active";
			}
			$count = count($this->CI->mdl_menus->getMenuByParentId($menu->menu_id));
			if($count==0){
				$subclass = 'class="'.$active.'"';
			}else{
				$subclass = 'class="openable"'.trim($active);
			}
			echo '<li '.$subclass.'';
			if($menu->parent_id==0)
			{
				echo 'class="menuid'.$menu->menu_id.$active.'"';
			}
			else{
				echo 'class="menuid'.$menu->menu_id.$active.'"';
			}
			echo '>';
			
			if($menu->menu_alias!='')
			{
				echo '<a href="'.site_url().''.$menu->menu_alias.'">';
			}
			else
			{
				echo '<a href="#">';
			}
			echo '<span class="'.$menu->menu_icon.'"></span>';
			echo '<span class="text">';
			echo $menu->menu_name;
			echo '</span>';
			echo '</a>';
			if($total>0)
			{
				echo '<ul>';
				$childs = $this->CI->mdl_menus->getMenuByParentId($menu->id);
				$this->printMenu($childs,($level+1),($i+1));
				echo '</ul>';
			}
			echo '</li>';
		}
	}

}
// END Authencation Class

/* End of file authencation.php */
/* Location: ./system/libraries/authencation.php */