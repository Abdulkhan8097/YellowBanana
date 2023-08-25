
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State_model extends CI_Model {

    function __construct() {      
        parent::__construct();
        $this->load->database();
        $this->statetablename = 'State';
    }
  
    /*
    *Function | Get All Companies
    */
    public function getAllState($cid=NUll){        
        $query = "SELECT * FROM $this->statetablename ORDER BY name ASC";
        if($cid!=''){
            $query = "SELECT * FROM $this->statetablename WHERE id='".$cid."' ORDER BY name ASC";    
        }
        $result = $this->db->query($query)->result_array();
        return $result;
    }
       
      
}

?>