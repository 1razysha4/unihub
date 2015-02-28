<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_MCB_Data extends MY_Model {

	public $settings;

	public function get($key) {

		$this->db->select('ci_value');

		$this->db->where('ci_key', $key);

		$query = $this->db->get('ci_data');

		if ($query->row()) {

			return $query->row()->ci_value;

		}

		else {

			return NULL;

		}

	}

	public function save($key, $value, $only_if_null = FALSE) {

		if (!is_null($this->get($key)) and !$only_if_null) {

			$this->db->where('ci_key', $key);

			$db_array = array(
				'ci_value'	=>	$value
			);

			$this->db->update('ci_data', $db_array);

		}

		else {

			if ($only_if_null) {

				if (!is_null($this->get($key))) {

					return;

				}

			}

			$db_array = array(
				'ci_key'	=>	$key,
				'ci_value'	=>	$value
			);

			$this->db->insert('ci_data', $db_array);

		}

	}

	public function delete($key) {

		$this->db->where('ci_key', $key);

		$this->db->delete('ci_data');

	}

	public function set_session_data() {

		$ci_data = $this->db->get('ci_data')->result();

		foreach ($ci_data as $data) {

			@$this->settings->{$data->ci_key} = $data->ci_value;

		}

	}

	public function set_application_title() {

		@$this->settings->application_title = $this->get('application_title');

	}

	public function setting($key) {

		return (isset($this->settings->$key)) ? $this->settings->$key : NULL;

	}

	public function set_setting($key, $value) {

		$this->settings->$key = $value;

	}
	public function getStatusOptions($statuskey){
		$val=$this->get($statuskey);
		$options=explode("|",$val);
		$option=array();
		foreach ($options as $item){
			$items=explode(":",$item);
			$option[]=(object)array("value"=>$items[0],"text"=>$items[1]);
		}
		return $option;
	}

	public function getStatusDetails($statusid, $statuskey){
		$val=$this->get($statuskey);
		$options=explode("|",$val);
		$option="";
		foreach ($options as $item){
			$items=explode(":",$item);
			if($items[0]==$statusid){
				$option=$items[1];
				break;
			}
		}
		return $option;
	}

}

?>