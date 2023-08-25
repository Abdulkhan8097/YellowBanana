<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country_model extends CI_Model{	

	function __construct()	{	
		// Call the Model constructor		parent::__construct();		
		$this->table 		= "country";		
		$this->stateTable 	= "state";		
		$this->regionTable 	= "region";
$this->stateTable   = "state";	
	}
	
	function getAllCountry(){		
		$sql 		= "SELECT * FROM $this->table WHERE status=1 ORDER BY name ASC";		
		$query 		= $this->db->query($sql);		
		$result   	= $query->result();		
		return $result;	
	}
	
	function getStatesByCountry($cId){		
		$result = array();		if($cId > 0){			
		$sql 		= "SELECT * FROM $this->stateTable WHERE country_id = $cId AND status=1 ORDER BY name ASC";			
		$query 		= $this->db->query($sql);			
		$result   	= $query->result();			
		}		
		return $result;	
	}	
	
	function getLocation($cId,$sId,$display=0){		
		$result  = array();
		$result1 = array();				
		$sql 		= "SELECT `name` FROM $this->table WHERE id = $cId AND status=1";		
		$query 		= $this->db->query($sql);		
		$result   	= $query->result();						
			if($result) {			
				$cname      = $result[0]->name;		
			} else {			
				$cname      = " - ";		
			}				
			$sql1 		= "SELECT `name` FROM $this->stateTable WHERE id = $sId AND status=1";		
			$query1 	= $this->db->query($sql1);		
			$result1   	= $query1->result();						
			if($display == 1) {			
				if(isset($result1[0]->name)) { 				
					$sname = $result1[0]->name;			
				} else {				
					$sname = " - ";			
				}		
			} else {			
				if(isset($result1[0]->name)) { 				
					$sname = " ,".$result1[0]->name;			
				} else {				
					$sname = "";			
				}		
			}					
			return array("country" => $cname, "state"	=> $sname);			
		}	
		/* Functoin for retrive all Region */	
		function getAllRegion(){		
			$sql 		= "SELECT * FROM $this->regionTable WHERE status=1 ORDER BY name ASC";		
			$query 		= $this->db->query($sql);		
			$result   	= $query->result();		
			return $result;	
		}			
		
		function countryName($id){		
			if($id>0){			
				$sql 		= "SELECT name AS country FROM $this->table WHERE id = $id";			
				$query 		= $this->db->query($sql);			
				$result   	= $query->result();			
				return $result[0]->country;		
			}else{			
				return "";		
			}	
		}		
		
		function regionName($id){		
			if($id>0){			
				$sql 		= "SELECT name AS region FROM $this->regionTable WHERE id = $id";			
				$query 		= $this->db->query($sql);			
				$result   	= $query->result();			
				return $result[0]->region;		
			}else{			
				return "";		
			}	
		}
function stateName($id){
		if($id>0){
			$sql 		= "SELECT name AS state FROM $this->stateTable WHERE id = $id";
			$query 		= $this->db->query($sql);
			$result   	= $query->result();
			return $result[0]->state;
		}else{
			return "";
		}
	}
	}
?>