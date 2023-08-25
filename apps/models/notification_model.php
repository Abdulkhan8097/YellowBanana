<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->table 	= "notifications";
		$this->ptable 	= "users_professional";
	}
	
	// common function to add notification for all modules (like for update,) 
	
	function insertNotifications($from_user_id,$to_user_id,$link,$text,$type){
		// Type ==> 1-Updates, 2-Services, 3-Groups, 4-Events, 5-Storyclips, 6- Knowledge base 
		// From user id is the logged in user 
		// to user id is for whom commented or like 
		
		
		$data          = array(
			'from_user_id'	=> $from_user_id ,
			'to_user_id'    => $to_user_id,	
			'link'       	=> $link,		
			'display_text'  => $text,
			'status'     	=> 0,
			'view_status'   => 1,
			'type' 			=> $type
		);		
		$this->db->insert($this->table, $data);
	}
	
	function findUserId($id, $tableName){
		$sql 	= "SELECT 
						T.user_id						
					FROM 
						$tableName AS T
					WHERE 
						id = $id					
				  ";
			  
		$query 	= $this->db->query($sql);
		$result = $query->result();	
		return $result[0]->user_id;					
	}
	
	
	
	/* get title for every module, we need to pass field name and table name */

	function getTitle($field,$tablename,$id,$value){
		$sql = "SELECT $field AS title FROM $tablename WHERE $id = $value";
		$query 	= $this->db->query($sql);
		$result = $query->result();	
		return $result[0]->title;	
	}
}

?>