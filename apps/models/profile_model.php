<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends CI_Model {

    function __construct() {      
        parent::__construct();
        $this->load->database();
    }


    public function get_user_details($user_id) {
        $this->db->where("id", $user_id);

        $query = $this->db->get('users');
        return $query->row_array();
    }
     public function update_password($data, $id) {
        $this->db->where('id', $id);
        $query = $this->db->update('users', $data);
        $this->db->last_query();
        return true;
    }

}

?>