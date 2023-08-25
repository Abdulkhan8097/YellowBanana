<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_model extends CI_Model{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getSubjectWithTopic(){
		$subjectData= array();
		$sql 		= "SELECT 
							S.id AS subject_id,S.name AS subject_name,T.id AS topic_id,T.name AS topic_name 
						FROM subjects S,topics T
						WHERE 
							S.id = T.subjects_id ORDER BY S.id
						";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		if(count($result)>0){
			foreach($result AS $data){
				$subjectData[$data->subject_id][] = array("name"=>$data->subject_name,"topic_id"=>$data->topic_id,"topic_name"=>$data->topic_name);
			}
		}
		return $subjectData;
	}
	public function getFreeSeriesQuestions(){
		$this->db->select('*');
		$this->db->from('free_test_series');
		$this->db->where('status', 1);
		$this->db->where('question !=', "");
		$this->db->limit(25);
		$this->db->order_by("id", "random");
		$query = $this->db->get();
		$result   	= $query->result();
		return $result;
	}
	public function getQuestionList($idArray){
		$this->db->select('*');
		$this->db->from('free_test_series');
		$this->db->where_in('id', $idArray);
		$query = $this->db->get();
		$result   	= $query->result();
		return $result;
	}
	
}
?>