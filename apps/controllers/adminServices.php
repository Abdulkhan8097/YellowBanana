<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminServices extends CI_Controller {
	function __construct()

	{

		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();

		$adminSession = $this->session->userdata('adminSession');
		$this->load->model("market_model","market");
		$this->load->model("category_model","category");

                 $this->load->library('paginationnew');

		if($adminSession['isAdminLoggedIn'] != true)

		redirect('admin');

	}


	public function index()	{

		$data = array();
				

		//$this->template->set('title', 'Home');
		$this->load->helper("text");
				
		// Load Pagination
		
		$this->load->library('table');
		
		$searchArray["title"]	= ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";				
		//$searchArray["category"]		= ($this->input->post("filters_market_category") != "")?$this->input->post("filters_market_category"):-1;
		//$searchArray["type"]		= ($this->input->post("filters_market_type") != "")?$this->input->post("filters_market_type"):-1;
		$searchArray["status"]		= ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;
				
		// Config setup

                 $page = $this->input->get('page');
		$page = $page ? $page : 1;
		$Limit = PER_PAGE_RECORD;
		$totalRecord = $this->market->countGetData($searchArray);

		$startLimit = ($page-1) * $Limit;
                $data['startLimit'] = $startLimit;

		$pagination = $this->paginationnew->getPaginate($totalRecord,$page,$Limit);
		$data['pagination'] = $pagination;

                $data["usersData"] = $this->market->getData($searchArray,$startLimit,$Limit);
                //print_r($data["usersData"]);die;
		$data["searchArray"]= $searchArray;


		
		$this->template->load('admintemplate', 'contents' , 'admin/market/serviceListTpl', $data);

	}
	
	public function viewService(){
		
		$sId = $this->input->get("id");
		$result = $this->market->adminServiceDetail($sId);		
		
		$data["serviceDetail"] = $result["result"];
		$data["categotyUData"] = $result["user_category"];
		$data["comments"]      = $this->market->getMarketAdminComments($sId);
		$this->template->load('admintemplate', 'contents' , 'admin/market/viewServiceTpl', $data);
	}
	
	
	
	

	public function ajaxGetState(){
		$this->load->model("country_model","country");
		$countryId = $this->input->post("countryId");
		$sArray    = $this->country->getStatesByCountry($countryId);
		$passData  = "";
		if(count($sArray) > 0) { 
		$passData  = "<select name='state' id='state'><option value=''>Select</option>";
		if(count($sArray)>0){
			foreach($sArray AS $sObj){
				$passData.="<option value='".$sObj->id."'>".$sObj->name."</option>";
			}
		}
		$passData .= "</select>"; 	
		} 
		echo $passData;
	}
	
	
	
	
	


	function DeleteServices(){
		$id = $this->input->get("id");
	
		if($id > 0){
			$this->market->DeleteServices($id);			
		}
	}

}


