<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->table = "category";
	}
	function getCatByParentId($pId){
		$sql 		= "SELECT * FROM $this->table WHERE parent_id= $pId and status=1 ORDER BY name ASC";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}	

        function getCatnameById($pId){		
                if($pId >0){			
                   $sql    = "SELECT name FROM $this->table WHERE id= $pId and status=1 ORDER BY name  ASC";
                   $query  = $this->db->query($sql);
		   $result = $query->result();			
                   if(count($result)>0)				
                         return $result[0]->name;
                   else
			return "";		
                }else{			
                        return "";		
                  }		
       }

       function getRightButtonNames(){
		$sql 		= "SELECT id,name FROM $this->table WHERE parent_id= 99 and status=1 ORDER BY name ASC";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}

	function addCategory(){	
		//echo "Mukesh";exit;
		$adminSession = $this->session->userdata('adminSession');
		//$admin_id = $adminSession['user_id']; 	
		$title			= $this->input->post('txtName');
		$description	= $this->input->post('txtDescription');		
		$status         = $this->input->post('txtStatus');	
		if(!empty($this->input->post('pcategory')))
		{
			$pcategory = $this->input->post('pcategory');
		}
		else
		{
			$pcategory = 0;
		}
		$data= array(
			'name'=> $title,
			'desc'=> $description,
			'parent_id'=>1,
			'status'=>$status,
			'parent_id'=>$pcategory
		);
		//print_r($data);exit;
		
		$this->db->insert($this->table, $data);
		$this->session->set_flashdata('addmsg', array('message' => 'Category added successfully','class' => 'success'));
		redirect("AdminCategory/index");
	}

	function getData($searchArray = "",$offset,$limit){
		$sql = "SELECT C.id,C.name,C.status,
						C.desc FROM
						$this->table AS C WHERE";
		if($searchArray["name"] != "")
			$sql .= " C.name LIKE '%".$searchArray['name']."%' AND " ;
		if($searchArray["status"] >= 0)
			$sql .= " C.status = '".$searchArray['status']."'AND";
		if($searchArray != "" && $searchArray["pcategory"] >= 0) {
			$sql .= " C.parent_id = '".$searchArray['pcategory']."' AND";
		}
		$sql .= " 	1=1";			
		$sql .= " ORDER BY C.id DESC LIMIT $offset,$limit";
		$query 		= $this->db->query($sql);

		$result   	= $query->result();

		return $result;
	}

	function countGetData($searchArray = ""){
		$sql 		= "SELECT
							COUNT(*) AS COUNT
						FROM
							$this->table AS C WHERE";

		if($searchArray["name"] != "")
			$sql .= " C.name LIKE '%".$searchArray['name']."%' AND " ;
		if($searchArray != "" && $searchArray["status"] >= 0) {
			$sql .= " C.status = '".$searchArray['status']."' AND";
		}
		if($searchArray != "" && $searchArray["pcategory"] >= 0) {
			$sql .= " C.parent_id = '".$searchArray['pcategory']."' AND";
		}
		$sql .= " 	1=1";		
		
		$query 		= $this->db->query($sql);
		$result   	= $query->result();

		if(count($result)>0)

			return $result[0]->COUNT;

		else

			return 0;
	}

	function deleteGroup($id){
		if($id > 0) {
			// delete category
			$sql8 = "DELETE FROM $this->table WHERE id = $id";
			$this->db->query($sql8);	
			
			$this->session->set_flashdata('addmsg', array('message' => 'Category deleted successfully','class' => 'success'));						
		}
		redirect("AdminCategory");	
	}

	function getCategoryDetail($id){
		$sql 		= "SELECT
							C.id,
							C.name,
							C.status,
							C.parent_id,
					    	C.desc FROM
							$this->table AS C
						WHERE
						    C.id = $id";
		$query 		= $this->db->query($sql);
		$detail   	= $query->result();	
		$return['detail'] = $detail; 		
		return $return;
	}

	function updateCategory($gid){
		if($gid > 0){
			$title			= $this->input->post('txtName');
			$description	= $this->input->post('txtDescription');		
			$status         = $this->input->post('txtStatus');
			if(!empty($this->input->post('pcategory')))
			{
			   $pcategory = $this->input->post('pcategory');
			}
			else
			{
				$pcategory =0;
			}	
			$data          = array(
				'name'=>$title,			
				'desc'=>$description,			
				'status'=>$status,
				'parent_id'=>$pcategory
			);
			$this->db->where('id',$gid);
			$this->db->update($this->table, $data);
			$this->session->set_flashdata('addmsg', array('message' => 'Category updated successfully','class' => 'success'));
			redirect("AdminCategory");	
		} else {
			redirect("AdminCategory");	
		}
	}


	function getParentCategory(){
		$sql 		= "SELECT id,name FROM $this->table WHERE parent_id= 0 and status=1 ORDER BY name ASC";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}
	
}
?>