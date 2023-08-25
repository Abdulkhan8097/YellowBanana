<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class AdminMar extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();
		$adminSession = $this->session->userdata('adminSession');
		$this->load->model("market_model","market");
		$this->load->model("category_model","category");
		if($adminSession['isAdminLoggedIn'] != true)
		redirect('admin');

                 $this->load->library('paginationnew');
                set_title('Business | ' . SITE_NAME);
                $metatag = array("content" => "", "keywords" => "", "description" => "");
                set_metas($metatag);
	}

	public function index()	{
		$data = array();
				
		//$this->template->set('title', 'Home');
		$this->load->helper("text");
				
		// Load Pagination
		$this->load->library('pagination');
		$this->load->library('table');
		
		$searchArray["title"]	= ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";						
		$searchArray["status"]		= ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;


                 $page = $this->input->get('page');
                    $page = $page ? $page : 1;
                    $Limit = PER_PAGE_RECORD;
                    $totalRecord = $this->market->countMarGetData($searchArray);

                    $startLimit = ($page - 1) * $Limit;
                    $data['startLimit'] = $startLimit;

                    $pagination = $this->paginationnew->getPaginate($totalRecord, $page, $Limit);
                    $data['pagination'] = $pagination;
                    $data["usersData"] = $this->market->getMarData($searchArray, $startLimit, $Limit);
                    $data["searchArray"] = $searchArray;
                 



		// Config setup
		
				
		$config['base_url'] 		= site_url("adminMar/index");
		$config['total_rows'] 		= $this->market->countMarGetData($searchArray);
		$config['per_page'] 		= PER_PAGE_RECORD;//KNOWLEDGEBASE_PER_PAGE;
		$config['num_links'] 		= 10;
		$config["uri_segment"] 		= 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] 	= '<div id="pagination">';
		$config['full_tag_close'] 	= '</div>';
			
		// Initialize
		$this->pagination->initialize($config);
		
		$offset						= ($this->uri->segment(3) > 0)?($this->uri->segment(3) - 1) * $config['per_page']:0;
		$data["lastpage"]			= ceil($config['total_rows']/$config['per_page']);
		$data["page"]				= ($this->uri->segment(3) > 0)?$this->uri->segment(3):1;
		
		//$data["records"] = $this->db->get("knowledgebase",$config['per_page'],$this->uri->segment(3));
		
		//Get data for category and knowledgebase
		//	$pCategoryArray 	= $this->category->getCatByParentId(PEOPLE_LOOKING_SERVICES_CATEGORY);//People Looking For Services category					
		//	$bCategoryArray 	= $this->category->getCatByParentId(BUSINESS_SERVICES_CATEGORY);//People Looking For Services category
		//	$data["categoryArray"] = array_merge($pCategoryArray,$bCategoryArray);
		$data["usersData"] 			= $this->market->getMarData($searchArray,$offset,$config['per_page']);
		$data["searchArray"]= $searchArray;

		//echo "<pre>";print_r($data);exit;
		
		$this->template->load('admintemplate', 'contents' , 'admin/market/marListTpl', $data);
	}
	
	public function viewMar(){
		
		$sId = $this->input->get("id");
		$result = $this->market->adminMarDetail($sId);		
		
		$data["serviceDetail"] = $result["result"];
		$data["categotyUData"] = $result["user_category"];
		$data["industryData"]  = $result["ind_result"];
		$data["regionData"]  = $result["reg_result"];
		
		$data["comments"]      = $this->market->getMarketAdminComments($sId);
		$this->template->load('admintemplate', 'contents' , 'admin/market/viewMarTpl', $data);
	}
	public function changeStatus(){
		$id 	= $this->input->post("id");
		$status = $this->input->post("status");
		if($status == 1){
			//make Inactive
			$sql = 'UPDATE market_place_users SET status = 0 WHERE id = '.$id;
		}else{
			//Make Active
			$sql = 'UPDATE market_place_users SET status = 1 WHERE id = '.$id;
		}
		$this->market->updateQuery($sql);
	}

function DeleteMar(){
		$id = $this->input->get("id");
	
		if($id > 0){
			$this->market->DeleteMar($id);			
		}
	}
	

}

