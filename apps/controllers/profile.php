<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();
		//frontendLoginCheck();
		$this->uploadFolder 	= SITE_ROOT_PATH."/upload/TempSessionImage/";
		$this->userPath			= SITE_ROOT_PATH."/assets/upload/users/";
		$this->FriendMessage	= array(0=>"Friend Request has been sent successfully.",1=>"You have already send friend request today.");
		$this->load->model("groups_model","groups");
		set_title('Profile | ' . SITE_NAME);
        $metatag = array("content" => "", "keywords" => "", "description" => "");
        set_metas($metatag);
	}
	
	public function index()
	{
		$this->load->model("events_model","events");
		set_title('Profile | ' . SITE_NAME);
		frontendLoginCheck();
		$data = array();
		
		$sessionData 		= $this->session->userdata('sessionData');
                //echo "<pre>"; print_r($this->session);die;
		$userId	= ($this->input->get("id"))?$this->input->get("id"):$sessionData["userId"];
		
		$this->load->model("users_model","users");
		$this->load->model("category_model","category");
		//$this->load->model("Friend_model","friends");
		$this->load->model("country_model","country");
			
		$userArray			= $this->users->getDataById($userId);
		$friendsArray       = $this->users->getFriendsById($userId);
		//print_r($userArray);exit;
		if(!$userArray)
			redirect("profile/index");
		 
		$data["userId"]			= $userArray[0]->id;
		$data["loginUserId"]	= $sessionData["userId"];
		$data["userPicture"]	= $userArray[0]->profile_picture;
		$data["userName"]		= ucfirst($userArray[0]->fname)."&nbsp;".ucfirst($userArray[0]->lname);
		//$data["organization"]   = $userArray[0]->organization;
		$data["gender"]	   		= $userArray[0]->gender;
                $data["department"]     = $this->users->departmentName($userArray[0]->department_id);
                $data["email"]    =$userArray[0]->email;
		//$data["profStatus"]		= $this->category->getCatnameById($userArray[0]->professional_status);
		$data["bio"]	   		= $userArray[0]->bio;
		$data["country"]        = $this->country->countryName($userArray[0]->country_id); 
		$data["region"]        = $this->country->regionName($userArray[0]->region_id); 
		$rightGroupData = $this->groups->trendingGroups();	
		$data["rightGroupData"] = $rightGroupData;
		$data["friendsArray"]   = $friendsArray;
		$data["totalFriends"] 	= $this->users->countTotalFriends($userId);
		$data["state"]        = $this->country->stateName($userArray[0]->state_id);
		//  displaying total connections
	//	$data['countconnection'] = $this->friends->countConnections($userId);
	//	$data['background']      = $userArray[0]->background;
	//	$data['friendlist']      = $this->friends->listFriendConnections($userId);
		
		
		//$this->template->set('title', 'Home');
	
		// display groups 
		
		$data['listGroupData'] = $this->groups->groupsShortData();
		
		//print_r($data);exit;
		$this->template->load('template', 'contents' , 'profile/profileTpl',$data);
	}

	public function basic(){
		frontendLoginCheck();
		
		$data = array();
		$sessionData = $this->session->userdata('sessionData');
		
		//Set paramert when user click on link
		$this->session->set_userdata('visitProfilePage', 1);
		
		$this->load->model("country_model","country");
		$this->load->model("category_model","category");
		$this->load->model("users_model","users");
		//Empty temp_image field for uploading temporary image file.
		//$this->users->updateUser(array("temp_image"=>""),$sessionData["userId"]);
		
		if($this->input->get("save"))
			$save =1;
		else
			$save =0;
		
		$data["certificationsDataArray"]= $this->users->getUserCertificationsData();
		$data["countryArray"] 		= $this->country->getAllCountry();
                 $data["companyArray"] 		= $this->users->getAllCompanies();
		$data["departmentArray"] 	= $this->category->getCatByParentId(DEPARTMENT_CATEGORY); //$this->users->getAllDepartments();
		//$data["pstatusArray"] 	= $this->category->getCatByParentId(PROFESSIONAL_STATUS_CATEGORY);//Professional status category
		$profileArray		 	= $this->users->getDataById($sessionData["userId"]);
		$data["userArray"] 		= $profileArray[0];
		$countryId			= $profileArray[0]->country_id;
		$companyIdArray			= explode(",",$profileArray[0]->company_id);
		$certificationsArray		= explode(",",$profileArray[0]->certifications);		
		$data["saveMessage"]		= $save;
		$data["userId"]			= $sessionData["userId"];
		$data["userPath"]		= $this->userPath.$data["userId"]."/".$data["userArray"]->profile_picture;
		if($countryId == 0 || $countryId == ""){
			$countryId = 1; //Set default country id.
		}
		$data["countryId"] 		= $countryId;
                 $data["companyIdArray"] 	= $companyIdArray;
   	 	$data["certificationsArray"] 	= $certificationsArray;
		$data["stateArray"]		= $this->country->getStatesByCountry($countryId);
		//echo "<pre>";print_r($data);exit;
		$rightGroupData = $this->groups->trendingGroups();	
		$data["rightGroupData"] = $rightGroupData;

			

		//$this->template->set('title', 'Home');
		$this->template->load('template', 'contents' , 'profile/basicprofileTpl', $data);
	}
	public function saveBasicProfile(){
		$sessionData 	= $this->session->userdata('sessionData');
		$userId			= $sessionData["userId"];
		$this->load->model("users_model","users");
		
                $jo_c_employer = "";
		$jo_title      = "";
		$jo_responsibilities1 = "";
		$jo_responsibilities2 = "";
		$jo_responsibilities3 = "";
		$jo_loc_choices1 = "";
		$jo_loc_choices2 = "";
		$jo_loc_choices3 = "";
		
		$jo_salary = "";
		
                $travel_percentage = "";
		if($this->input->post("willing_travel") == 1) {
			$travel_percentage =$this->input->post("travel_percentage");
		}	 
            $text_message_receive = 0;
            if($this->input->post("mobile_tmessage") == "on") {
              	$text_message_receive = 1;
            }

            if($this->input->post("checkjob") == "on") {
			$jo_c_employer 		 = $this->input->post("jo_current_employer");
			$jo_title 			 = $this->input->post("jo_title");
	        $jo_responsibilities1 = $this->input->post("jo_responsibilities1");
			$jo_responsibilities2 = $this->input->post("jo_responsibilities2");
			$jo_responsibilities3 = $this->input->post("jo_responsibilities3");	
			$jo_loc_choices1 	 = $this->input->post("jo_loc_choices1");
			$jo_loc_choices2 	 = $this->input->post("jo_loc_choices2");
			$jo_loc_choices3 	 = $this->input->post("jo_loc_choices3");
			
			$jo_salary 			 = $this->input->post("jo_salary");
			
		} 

		$zipCode = $this->input->post("zip");
		if($this->input->post("country") != 1){ // 1= US
				$zipCode = "";
		}
		
		if($this->input->server('REQUEST_METHOD') == "POST"){
		 $companyIdData = (is_array($this->input->post("company")) && count($this->input->post("company") > 0)) ? implode(",",$this->input->post("company")) : '';
		 $certificationsData = (is_array($this->input->post("certifications")) && count($this->input->post("certifications") > 0)) ? implode(",",$this->input->post("certifications")) : '';
		
		$updateArray = array(
					"fname"					=> $this->input->post("firstname"),
					"lname"					=> $this->input->post("lastname"),
					"cert"					=> $this->input->post("cert"),
					"department_id"			=> $this->input->post("txtDepartment"),
					"country_id"			=> $this->input->post("country"),
					"state_id"				=> $this->input->post("state"),
					"city"					=> $this->input->post("city"),
					//"street_address"		=> $this->input->post("street_address"),
					"zipcode"				=> $zipCode,
					"other"					=> $this->input->post("other"),
					//"organization"			=> $this->input->post("organization"),
					//"professional_status"	=> $this->input->post("professional_status"),
					"bio"					=> $this->input->post("bio"),
					"background"			=> "",
					//"member_age"			=> $this->input->post("member_age"),
					// "physical_location"			=> $this->input->post("physical_location"),	
					//"office_phone"			=> $this->input->post("office_phone"),
					"mobile_phone"			=> $this->input->post("mobile_phone"),
                                        "receive_text_messages" => $text_message_receive,
                                         // "extension"				=> $this->input->post("extension"),          
                                       // "dob"					=> $this->input->post("dob"),
					//"doh"					=> $this->input->post("doh"),
					//"consultant_company"	=> $this->input->post("consultant_company"),
					//"primary_org_unit"		=> $this->input->post("primary_org_unit"),
					"company_id"		=> $companyIdData,
                                        "type_opportunity"		=> $this->input->post("type_opportunity"),
						
					
                                        "current_employer" 		=> $jo_c_employer,
					"employer_title"		=> $jo_title,
					"responsibilities1"		=> $jo_responsibilities1,
					"responsibilities2"		=> $jo_responsibilities2,
					"responsibilities3"		=> $jo_responsibilities3,
					"loc_choices1"			=> $jo_loc_choices1,
					"loc_choices2"			=> $jo_loc_choices2,
					"loc_choices3"			=> $jo_loc_choices3,
					
					"employer_salary"		=> $jo_salary,
					"certifications"		=> $certificationsData,
	                                "willing_travel"		=> $this->input->post("willing_travel"),
					"travel_percentage"		=> $travel_percentage,
					"willing_relocate"		=> $this->input->post("willing_relocate")
		);
		if(empty($this->input->post('country'))){
			$updateArray['country_id']=1;
		}
		else{
			$updateArray['country_id'] = $this->input->post('country');
		}

		if(empty($this->input->post('state'))){
			$updateArray['state_id']=1;
		}
		else{
			$updateArray['state_id'] = $this->input->post('state');
		}
			
		/* Image Uploading */
		
			
		if(isset($_FILES) && isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] ==0){ 		
			$userPath 			= $this->userPath.$userId;
				
			if(!is_dir($userPath))
			@mkdir($userPath);
				
			//$imageName 			= $userId."_".$_FILES["file_upload"]["name"];
			$imageName 			= uniqid(rand(), true)."_".date("YmdHis").".".getFileExtension($_FILES["file_upload"]["name"]);
			$userTargetPath 	= $userPath."/".$imageName;
			move_uploaded_file($_FILES["file_upload"]["tmp_name"],$userTargetPath);
				
			$userThumbPath 		= $userPath."/thumb_".$imageName;
			$userThumbPath1		= $userPath."/thumb120_".$imageName;
			makeThumbnails($userTargetPath,$userThumbPath,USER_THUMB_WIDTH,USER_THUMB_HEIGHT);
			makeThumbnails($userTargetPath,$userThumbPath1,120,120);
				
			$updateArray["profile_picture"]	= $imageName;
		}

		// if(isset($_FILES) && isset($_FILES["upload_resume"]) && $_FILES["upload_resume"]["error"] ==0)
		// {
		// 	$userPath 			= $this->userPath.$userId;
		// 	$extension = getFileExtension($_FILES["upload_resume"]["name"]);
		// 	if(!is_dir($userPath))
		// 	@mkdir($userPath);
			
		// 	if($extension == "doc" || $extension == "docx" || $extension == "pdf")	 {
		// 	$resume 			= $userId."_".date("His").".".getFileExtension($_FILES["upload_resume"]["name"]);
		// 	$userTargetPath 	= $userPath."/".$resume;
		// 	move_uploaded_file($_FILES["upload_resume"]["tmp_name"],$userTargetPath);
		// 	$updateArray["resume_file"]	= $resume;
		// 	}
		// }
	
			$this->users->updateUser($updateArray,$userId);
			// sending profile change email 
			
			$this->load->library("sendemail");
			$passArray["fullname"]	= ucfirst($this->input->post("firstname"))." ".ucfirst($this->input->post("lastname"));
			$passArray["email"]		= $sessionData["email"];
			$this->sendemail->profileChangeEmail($passArray);
			
			redirect("profile/basic?save=1");
		}else{
			redirect("profile/index");
		}
	}
	
	public function professional(){
		frontendLoginCheck();
		
		$data = array();
		$this->load->model("users_model","users");
		$sessionData = $this->session->userdata('sessionData');
		
		if($this->input->get("save"))
			$save =1;
		else
			$save =0;
		
		$professionArray			= $this->users->getProfessionDataByUserId($sessionData["userId"]);
		if($professionArray){
			$data["p_id"]			= $professionArray[0]->id;
			$data["employer"]		= $professionArray[0]->employer;
			$data["position"]		= $professionArray[0]->position;
			$data["occupation"]		= $professionArray[0]->occupation;
			$data["description"]	= $professionArray[0]->description;
			$data["city"]			= $professionArray[0]->city;
			$data["start_date"]		= $professionArray[0]->start_date;
			$data["end_date"]		= $professionArray[0]->end_date;
		}else {
			$data["p_id"]			= 0;
			$data["employer"]		= $data["position"] = $data["occupation"] = $data["description"] = $data["city"] = $data["start_date"] = $data["end_date"] = "";
		}
		$data["saveMessage"]		= $save;
		$rightGroupData = $this->groups->trendingGroups();	
		$data["rightGroupData"] = $rightGroupData;
		
		//$this->template->set('title', 'Home');
		$this->template->load('template', 'contents' , 'profile/professionalTpl', $data);
	}
	public function saveProfessional(){
		$sessionData 	= $this->session->userdata('sessionData');
		$userId			= $sessionData["userId"];
		$this->load->model("users_model","users");
		
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$pArray = array(
					"employer"		=> $this->input->post("employer"),
					"position"		=> $this->input->post("position"),
					"occupation"	=> $this->input->post("occupation"),
					"description"	=> $this->input->post("description"),
					"city"			=> $this->input->post("city"),
					"start_date"	=> $this->input->post("start_date"),
					"end_date"		=> $this->input->post("end_date")
			);
			$p_id = $this->input->post("hiddenProfessionalId");
			if($p_id >0){
				//Update Query
				$this->users->updateProfessionalUser($pArray,$userId,$p_id);
			}else{
				$pArray["user_id"]		= $userId;
				$pArray["created_date"]	= date("Y-m-d h:i:s");
				//Insert Query
				$this->users->insertProfessionalUser($pArray,$userId,$p_id);
			}
			redirect("profile/professional?save=1");
		}else{
			redirect("profile/professional");
		}

	}
	/* AJAX call for get states for Country*/
	public function ajaxGetProfilePageState(){
		$this->load->model("country_model","country");
		$countryId = $this->input->post("countryId");
		$page	   = $this->input->post("page");
		$sArray    = $this->country->getStatesByCountry($countryId);
		$passData  = "";
		if($page == "register"){
			$passData  = "<span class='mint'>&nbsp;&nbsp;&nbsp;&nbsp;</span> <label class='labelwidth'> State:</label><select name='state' id='state'><option value=''>Select</option>";
		}else{
			$passData  = "<label class='labelwidth'>&nbsp;&nbsp;&nbsp;&nbsp;State:</label><select name='state' id='state'><option value=''>Select</option>";
		}
		if(count($sArray)>0){
			foreach($sArray AS $sObj){
				$passData.="<option value='".$sObj->id."'>".$sObj->name."</option>";
			}
		}
		$passData .= "</select>";
		echo $passData;
	}
	
	public function ajaxGetState(){
		if($this->input->get("space")) {
			$label = "<label class='labelwidth200'>";
		} else {
			$label = "<label class='labelwidth'>";
		}
		$this->load->model("country_model","country");
		$countryId = $this->input->post("countryId");
		$sArray    = $this->country->getStatesByCountry($countryId);
		$passData  = "";
		if(count($sArray) > 0) { 
			$passData  = "<span class='mint'>&nbsp;&nbsp;</span>".$label;
			$passData .= "&nbsp;&nbsp;State:</label><select name='state' id='state'><option value=''>Select</option>";
			if(count($sArray)>0){
				foreach($sArray AS $sObj){
					$passData.="<option value='".$sObj->id."'>".$sObj->name."</option>";
				}
			}
			$passData .= "</select>"; 	
		} 
		echo $passData;
	}
	
	/* with Compulsary state */
	
	public function ajaxGetCState(){
		$this->load->model("country_model","country");
		$countryId = $this->input->post("countryId");
		$sArray    = $this->country->getStatesByCountry($countryId);
		$passData  = "";
		if(count($sArray) > 0) { 
		
		$passData ="<span class='mint'>* </span><label class='labelwidth'>&nbsp;State:</label><select name='cstate' id='cstate'><option value=''>Select</option>";
		if(count($sArray)>0){
			foreach($sArray AS $sObj){
				$passData .= "<option value='".$sObj->id."'>".$sObj->name."</option>";
			}
		}
		$passData .= "</select>";	
		} 
		echo $passData;
	}

	
	function deleteUserImage(){
		//	loginCheck();// Check user is login or not(login_helper.php)
		$this->load->model("users_model","users");
		$sessionData 	= $this->session->userdata('sessionData');
		$userId			= $sessionData["userId"];
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
	
	function myaccount(){
		set_title('Setting | ' . SITE_NAME);
		$rightGroupData = $this->groups->trendingGroups();	
		$data["rightGroupData"] = $rightGroupData;
		$this->template->load('template', 'contents' , 'profile/myaccountTpl', $data);	
	}
	
	function changepwd(){		
		
		$this->load->view('profile/changePasswordTpl',array("friends"=>"","eventId"=>""));
	}
	
	function checkOldPassword(){
		$sessionData = $this->session->userdata('sessionData');
		$userId = $sessionData['userId'];
		$value= "false";
		$oldPwd		= $this->input->post("txtOld");
		if($oldPwd != ""){									
			//$select_sql = $this->db->get_where('users',array("password" => md5($oldPwd) ));
			
			$select_sql = $this->db->get_where('users',array("id" => $userId));			
			if($select_sql->num_rows()> 0)				
			{
				$result   	= $select_sql->result();
				$CI = & get_instance();
				$CI->load->library('Encryptdecrypt'); // load encript decript api
				$Encryptdecrypt = new Encryptdecrypt();
				$dbPassword = $Encryptdecrypt->decrypt($result[0]->password);

				if($dbPassword ==$oldPwd)
				{
					$value = "true"	;		
				}
			}
		}

		echo $value;
	}
	
	function changeExistingPassword(){			
		$sessionData = $this->session->userdata('sessionData');
		$userId = $sessionData['userId'];

		$this->load->model("users_model","users");
		$oldPwd		= $this->input->post("txtOld");
		
		//$select_sql = $this->db->get_where('users',array("password" => md5($oldPwd) ));		
		$select_sql = $this->db->get_where('users',array("id" => $userId));

		$value=0;

		if($select_sql->num_rows()> 0)				
		{
			$result   	= $select_sql->result();
				$CI = & get_instance();
				 $CI->load->library('Encryptdecrypt'); // load encript decript api
				 $Encryptdecrypt = new Encryptdecrypt();
				 $dbPassword = $Encryptdecrypt->decrypt($result[0]->password);

				 if($dbPassword ==$oldPwd)
				 {
					 $value=1;			
				 }
			
		}
		
		if($value == 1) {			
			$newPwd		= $this->input->post("txtNew");				
			$data = $this->users->updateUserPassword($newPwd);	
		}else {
			echo 0;
		}
		
		if($data == 1)  {
			$this->load->library("sendemail");
			$passArray["fullname"]	= $sessionData["userName"];
			$passArray["email"]		= $sessionData["email"];
			$passArray["password"]  = $newPwd;
			$this->sendemail->passwordChangeEmail($passArray);	
			echo $data;
		}		
		
	}
	
	function sendContactEnquiry(){
		$this->load->model("users_model","users");
		$this->users->sendEnquiry();
	}
}