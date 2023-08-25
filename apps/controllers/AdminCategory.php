<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminCategory extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();
		$adminSession = $this->session->userdata('adminSession');
		//$this->load->model("groups_model","groups");
		$this->load->model("category_model","category");
		if($adminSession['isAdminLoggedIn'] != true)
			redirect('admin');
                $this->load->library('paginationnew');
	}

	public function index()	{
		$data = array();
		//$groupType = $this->groups->getGroupTypes();
		$data["parentCategory"] = $this->category->getParentCategory();
		//$this->template->set('title', 'Home');
		$this->load->helper("text");
				
		// Load Pagination
		$this->load->library('pagination');
		$this->load->library('table');
		
		$searchArray["name"] = ($this->input->get("name") != "")?$this->input->get("name"):"";
		//$searchArray["pcategory"]	= ($this->input->post("pcategory") > 0)?$this->input->post("pcategory"):-1;		
		$searchArray["status"] = ($this->input->get("status") != "")?$this->input->get("status"):-1;
		$searchArray["pcategory"] = ($this->input->get("pcategory") != "")?$this->input->get("pcategory"):-1;
		//print_r($searchArray);exit;

        $page = $this->input->get('page');
		$page = $page ? $page :1;
		$Limit = PER_PAGE_RECORD;
		$totalRecord = $this->category->countGetData($searchArray);

		$startLimit = ($page-1) * $Limit;
                $data['startLimit'] = $startLimit;

		$pagination = $this->paginationnew->getPaginate($totalRecord,$page,$Limit);
		$data['pagination'] = $pagination;
        $data["usersData"] 			= $this->category->getData($searchArray,$startLimit,$Limit);
		$data["searchArray"]	= $searchArray;
		//print_r($searchArray);
		//echo $this->db->last_query();exit;
		//$data["groupTypes"]	 	= $groupType; 
		
		$this->template->load('admintemplate', 'contents' , 'admin/category/categoryListTpl', $data);
	}
	
	/*public function viewGroup(){
		$groupId = $this->input->get("id");
		$data["memberData"] = $this->groups->getmemberData($groupId);
		$data["groupDetail"] = $this->groups->groupDetail($groupId);
		//print_r($data);
		$this->template->load('admintemplate', 'contents' , 'admin/groups/viewGroupTpl', $data);
	}*/
	
	public function add(){
		//$data = array();
		//$this->load->model("country_model","country");
		//$data["countryArray"] 	= $this->country->getAllCountry();
		$data["parentCategory"] = $this->category->getParentCategory();
		//$this->template->set('title', 'Home');
		$this->template->load('admintemplate', 'contents' , 'admin/category/categoryAddTpl',$data);
	}
	
	public function postNewCategory(){
		
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$this->category->addCategory();
		}
	}
	
	public function editCategory()	{
		$data = array();
		$cid = $this->input->get("id");
		
		if($cid > 0) {			
			$this->load->model("country_model","country");
			$data["groupDetailArray"] = $this->category->getCategoryDetail($cid);
			$data["parentCategory"] = $this->category->getParentCategory();			
			$this->template->load('admintemplate', 'contents' , 'admin/category/categoryEditTpl', $data);
		} else {
			redirect("AdminCategory");
		}	
	}
	
	public function updateCategory(){
		$gid = $this->input->get("id");	
		if($this->input->server('REQUEST_METHOD') == "POST" && $gid > 0){			
			$this->category->updateCategory($gid);
		}else{
			redirect("AdminCategory");
		}
	}

       function deleteCategory(){
		$id = $this->input->get("id");
		
		$this->load->model("category_model","category");

		if($id > 0){
			$this->category->deleteGroup($id);			
		}
	}  
}

