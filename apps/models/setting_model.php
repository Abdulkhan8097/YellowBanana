<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->table 	= "site_menu_names";	
	}
	


	
	
	public  function  getSetting(){ 
		$sql = "SELECT * FROM  setting WHERE 1 "	;
                
		
		$query 		= $this->db->query($sql);
		$result   	= $query->result_array();

		return $result;						
		
	}

	public function settingview()
	{
            $arrSetting = array();
		$query = $this->db->get('setting');
		$result   	= $query->result_array();
                foreach($result as $settingdetail)
                {
                    $arrSetting[$settingdetail['setting_key']] = $settingdetail['setting_value'];
                }
		return $arrSetting;
	}

	public function categoryData()
	{
		$query = $this->db->where('parent_id','0')->get('category');
		$result   	= $query->result_array();
		return $result;
	}
	
}
?>