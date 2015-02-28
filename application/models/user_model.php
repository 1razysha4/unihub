<?php

class User_Model extends CI_Model {

    function validate($email, $pass) {
        $sql = "select * from tbl_users where email='$email' and password ='$pass' and status = 1";

        $query = $this->db->query($sql);
        $res = $query->result_array();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    function add() {
        $data = array(
            'email' => $this->input->post('email', true),
            'password' => sha1($this->input->post('password', true)),
            'original_password' => $this->input->post('password', true),
            'email' => $this->input->post('emailaddress', true),
            'status' => 0
        );

        $this->db->insert('tbl_users', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @param type $current_password
     * @param type $new_password
     * @param type $confirm_password
     */
    public function changePassword($user, $new_password,$current_password) {
        //update the database
        $this->db->set('password', sha1($new_password));
        $this->db->set('original_password', $new_password);
        $this->db->where('id', $user);
        $result = $this->db->update('tbl_users');
        if($result){
            return true;
        }else{
            return false;
        }
    }

}
