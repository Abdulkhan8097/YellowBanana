<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Market_model extends CI_Model {

    function __construct() {
        // Call the Model constructor parent::__construct();
        $this->table = "company";
    }

}