<?php

class Contact_Model extends CI_Model {

    /**
     * 
     * @param type $data
     * @return boolean
     */
    function save($data) {
        $insertdata = array('name' => $data['name'],
                      'email' => $data['email'],
                      'contact_phone' => $data['phone'],
                      'contact_subject' => $data['subject'],
                      'contact_message' => $data['message'],
                      'created_on' => NOW(),
        );
        $result = $this->db->insert('tbl_contactrequest', $insertdata);
        $id =  $this->db->insert_id();
        if($id){
            return true;
        }else{
            return false;
        }

    }

}
