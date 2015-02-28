<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Auth extends MY_Model {
	public function auth($table, $user_field, $pass_field, $user_value, $pass_value) {
		$this->db->where($user_field, $user_value);
		 $this->db->where('is_admin', 1);
		//$this->db->where($pass_field, $pass_value);
		$query = $this->db->get($table);
		if ($query->num_rows() == 1 && $query->row()->password==$pass_value ) {
			return $query->row();
		}
		else {
            $this->session->set_flashdata('custom_error', $this->lang->line('username_or_pw_incorrect'));
            redirect('admin/login');
		}
	}
	public function auth_front($table, $user_field, $pass_field, $user_value, $pass_value) {
		$this->db->where($user_field, $user_value);
		$this->db->where('active', 1);
		$query = $this->db->get($table);
		if ($query->num_rows() == 1 && $query->row()->password==$pass_value ) {
			return $query->row();
		}
		else {
            $this->session->set_flashdata('custom_warning', $this->lang->line('email_or_pw_incorrect'));
            redirect('login');
		}
	}
	public function set_session($user_object, $object_vars, $custom_vars = NULL) {

		$session_data = array();

		foreach ($object_vars as $object_var) {

			$session_data[$object_var] = $user_object->$object_var;

		}

		if ($custom_vars) {

			foreach ($custom_vars as $key=>$var) {

				$session_data[$key] = $var;

			}

		}

		$this->session->set_userdata($session_data);

	}

	public function update_timestamp($table, $key_field, $key_id, $value_field, $value_value) {

		$this->db->where($key_field, $key_id);

		$this->db->update($table, array($value_field => $value_value));

	}

	public function validate_login() {

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required|md5');

		return parent::validate();

	}
	public function validate_login_front() {

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required|md5');

		return parent::validate();

	}
}

?>