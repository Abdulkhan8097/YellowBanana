<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class AdminUsers extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		//Load database and other helpers so it can be used within every method

		$this->load->database();
		$adminSession = $this->session->userdata('adminSession');
		$this->load->model("users_model","users");
                $this->load->library('paginationnew');
		if($adminSession['isAdminLoggedIn'] != true)
			redirect('admin');
	}

	public function index()	{
		$data = array();
	
		//$this->template->set('title', 'Home');
		$this->load->helper("text");
				
		// Load Pagination
		//$this->load->library('pagination');
		$this->load->library('table');
		
		$searchArray["firstName"]	= ($this->input->post("first_name") != "")?$this->input->post("first_name"):"";
		$searchArray["status"]		= ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;
		if($searchArray["firstName"] == "" && $this->input->get("firstName") != ""){ 
			$searchArray["firstName"] = $this->input->get("firstName");                        
		}
                if($searchArray["firstName"]){
                        $searchArray["lastName"] = $searchArray["firstName"];
                        $searchArray["email"] = $searchArray["firstName"];
                        $searchArray["organization"] = $searchArray["firstName"];
		}

		if($searchArray["status"] == -1 && $this->input->get("status") != ""){
			$searchArray["status"] = $this->input->get("status");
		}

                $page = $this->input->get('page');
		$page = $page ? $page :1;
		$Limit = PER_PAGE_RECORD;
		$totalRecord = $this->users->countGetData($searchArray);

		$startLimit = ($page-1) * $Limit;
                $data['startLimit'] = $startLimit;

		$pagination = $this->paginationnew->getPaginate($totalRecord,$page,$Limit);
		$data['pagination'] = $pagination;



		//Get data for category and knowledgebase
		$data["usersData"] 			= $this->users->getData($searchArray,$startLimit,$Limit);
		$data["searchArray"]= $searchArray;

		//echo "<pre>";print_r($searchArray);exit;
	
		$this->template->load('admintemplate', 'contents' , 'admin/users/usersListTpl', $data);
	}
	
	public function viewUser(){
		
		$userId = $this->input->get("id");
		$data["userDetail"] = $this->users->userDetail($userId);	
		$data["userId"] = $userId;	
		$data["userPath"]		= SITE_ROOT_PATH."/assets/upload/users/".$userId."/".$data["userDetail"][0]->profile_picture;
		$this->template->load('admintemplate', 'contents' , 'admin/users/viewUserTpl', $data);
	}
	
	public function editUser(){
		$this->load->model("country_model","country");	
		$this->load->model("category_model","category");		
		
		$userId     = $this->input->get("id");
		$userData   = $this->users->userDetail($userId);
		$data["userDetail"] = $userData[0];	
		$countryId  = $data["userDetail"]->country_id;
		$data["countryArray"]       = $this->country->getAllCountry();
		$data["stateArray"]         = $this->country->getStatesByCountry($countryId);
                $data["departmentArray"]    = $this->users->getAllDepartments();
                $data["companyArray"]       = $this->users->getAllCompanies();
		$data["pstatusArray"]       = $this->category->getCatByParentId(PROFESSIONAL_STATUS_CATEGORY);//Professional status category
                $data['resonforjoinArr']	= $this->category->getCatByParentId(REASON_FOR_JOINING_CATEGORY);//Update category
		
		$data["userId"] = $userId;
		$data["userPath"]		= SITE_ROOT_PATH."/assets/upload/users/".$userId."/".$data["userDetail"]->profile_picture;

		//print_r($data);exit;
		$this->template->load('admintemplate', 'contents' , 'admin/users/userEditTpl', $data);
	}
	
	public function add(){
		$data = array();
		$this->load->model("category_model","category");		
		$this->load->model("country_model","country");		
		
		$data["pstatusArray"] 	= $this->category->getCatByParentId(PROFESSIONAL_STATUS_CATEGORY);//Professional status category
		$data["countryArray"] 	= $this->country->getAllCountry();
               // $data["departmentArray"]		= $this->users->getAllDepartments();
		$data["companyArray"]		= $this->users->getAllCompanies();
                $data['resonforjoinArr']	= $this->category->getCatByParentId(REASON_FOR_JOINING_CATEGORY);//Update category
		
		//$data["catData"] 			= $this->category->getCatByParentId(KNOWLEDGEBASE_CATEGORY);//Knowledgebase category		
		//$this->template->set('title', 'Home');
		$this->template->load('admintemplate', 'contents' , 'admin/users/userAddTpl', $data);
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
	
	public function registerNewUser(){
		$this->load->library("sendemail");

		$this->load->model("users_model","register");
		$this->register->insertNewUserData();
				
		$passArray["name"]		= $this->input->post("user_fname");
		$passArray["fullname"]	= ucfirst($this->input->post("user_fname"))." ".ucfirst($this->input->post("user_lname"));
		$passArray["email"]		= $this->input->post("user_emailid");
		$passArray["password"]	= $this->input->post("user_password");
			
		$this->sendemail->registerEmail($passArray);
		$this->sendemail->thanksEmail($passArray);			
					
		redirect("adminUsers/index");
	}
	
	public function updateUser(){		
		$userId = $this->input->get("id");		
				
		if($this->input->server('REQUEST_METHOD') == "POST"){
		
			$updateArray = array(
					"fname"				=> $this->input->post("user_fname"),
					"lname"				=> $this->input->post("user_lname"),					
					"country_id"			=> $this->input->post("txtCountry"),
					"company_id"			=> $this->input->post("txtCompany"),
					"department_id"			=> $this->input->post("txtDepartment") ? $this->input->post("txtDepartment") :0,
					"physical_location"		=> $this->input->post("physical_location"),
					"consultant_company"		=> $this->input->post("consultant_company"),				
					"mobile_phone"			=> $this->input->post("mobile_phone"),
					"extension"			=> $this->input->post("extension"),
                                        "state_id"				=> $this->input->post("state"),
					
					"city"					=> $this->input->post("city"),
				//	"street_address"		=> $this->input->post("street_address"),
					"zipcode"				=> $this->input->post("zipcode"),					
				//	"organization"			=> $this->input->post("organization"),
					"type_account"			=> $this->input->post("usertype"),
					"professional_status"           => $this->input->post("professional_status") ? $this->input->post("professional_status") :0,
					"bio"					=> $this->input->post("bio"),
					"status"                => $this->input->post("user_status")					
		);

			if(empty($this->input->post('txtCountry'))){
				$updateArray['country_id']=1;
			}
			else{
				$updateArray['country_id'] = $this->input->post('txtCountry');
			}

			if(empty($this->input->post('state'))){
				$updateArray['state_id']=1;
			}
			else{
				$updateArray['state_id'] = $this->input->post('state');
			}
		}
		/* Image Uploading */
		//	echo "<pre>";print_r($_FILES);exit;
			
		if(isset($_FILES) && isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] ==0){ 		
			$userPath 			= SITE_ROOT_PATH."/assets/upload/users/".$userId;
				
			if(!is_dir($userPath))
			@mkdir($userPath);
				
			$imageName 			= uniqid(rand(), true)."_".str_replace(' ', '',$_FILES["file_upload"]["name"]);
			$userTargetPath 	= $userPath."/".$imageName;
			move_uploaded_file($_FILES["file_upload"]["tmp_name"],$userTargetPath);
				
			$userThumbPath 		= $userPath."/thumb_".$imageName;
			$userThumbPath1		= $userPath."/thumb120_".$imageName;
			makeThumbnails($userTargetPath,$userThumbPath,USER_THUMB_WIDTH,USER_THUMB_HEIGHT);
			makeThumbnails($userTargetPath,$userThumbPath1,120,120);
				
			$updateArray["profile_picture"]	= $imageName;
			}
						
			$this->users->updateUser($updateArray,$userId);
						
			// sending profile change email 
			
		    $this->load->library("sendemail");
			$passArray["fullname"]	= ucfirst($this->input->post("user_fname"))." ".ucfirst($this->input->post("user_lname"));
			$passArray["email"]		= $this->input->post("email");
			$this->sendemail->profileChangeEmail($passArray);									
			
			redirect("adminUsers/index"); 
	}
	
	
	function deleteUserImage(){
		//	loginCheck();// Check user is login or not(login_helper.php)
		$userId = $this->input->post('userId');
		$this->load->model("users_model","users");
		$userArray		= $this->users->getDataById($userId);
		$saveImage		= $userArray[0]->profile_picture;
		$path			= $this->userPath."$userId/".$saveImage;
		$path1			= $this->userPath."thumb_".$userId."/".$saveImage;
		$path2			= $this->userPath."thumb_".$userId."/".$saveImage;
		if($saveImage != "" && file_exists($path)){
			unlink($path);
		}
		$this->users->updateUser(array("temp_image"=>"","profile_picture"=>""),$userId);
	}

        function deleteUser(){
		//	loginCheck();// Check user is login or not(login_helper.php)
		$userId = $this->input->get('id');
		if($userId)
                {
                    $this->db->delete('users', array('id'=>$userId));
                }
		redirect("adminUsers/index");
	}
}

