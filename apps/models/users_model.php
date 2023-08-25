<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->table 	= "users";
		$this->ptable 	= "users_professional";
                $this->companytable = "company";
		$this->userPath =  SITE_ROOT_PATH."/assets/upload/users/";
                $this->load->library("sendemail");
                date_default_timezone_set(TIME_ZONE_FOR_DB);
	}
	
	
	function getDataById($id,$field="*"){
		$result		= array();
		if($id>0){
			$sql 		= "SELECT ".$field." FROM $this->table WHERE id=$id AND status=1";
			$query 		= $this->db->query($sql);
			$result   	= $query->result();
		}
		return $result;
	}
	
	function getProfessionDataByUserId($id,$field="*"){
		$result		= array();
		if($id>0){
			$sql 		= "SELECT ".$field." FROM $this->ptable WHERE user_id=$id AND status=1";
			$query 		= $this->db->query($sql);
			$result   	= $query->result();
		}
		return $result;
	}
	
	public function insertData(){		
		$firstname     = $this->input->post("firstname");
		$lastname      = $this->input->post("lastname");
	
		$emailId       = $this->input->post("email");

		 $CI = & get_instance();
         $CI->load->library('Encryptdecrypt'); // load encript decript api
         $Encryptdecrypt = new Encryptdecrypt();
		$password      = $Encryptdecrypt->crypt($this->input->post("regPassword"));
		$zip           = $this->input->post("zip");
		$accountType   = $this->input->post("usertype");
		$department_id     = $this->input->post("txtDepartment");
//		$activationKey = $this->generateKey();
		$current_date  = date('Y-m-d H:i:s');
		$country_id	   = $this->input->post("country");
		$state_id	   = $this->input->post("state");
		
		$tablename     = $this->table;
		
		if($country_id == 0 )
			$country_id =1;
		
		$data          = array(
			'fname'        => $firstname,
			'lname'        => $lastname,	
					
			'email'        => $emailId,
			'password'     => $password,
			'zipcode'      => $zip,
			'type_account' => $accountType,
			'status'	   => 1,
	/*		'activation_key'    => $activationKey,*/
			'created_date'  => $current_date,
			'department_id'     => $department_id,
			'country_id'   => $country_id,
			'state_id'	   => $state_id,
		);
		
		$this->db->insert($tablename, $data);
		$user_insert_id=$this->db->insert_id();


		$this->load->model("notification_model","notification");
		$from_user_id  = $to_user_id = $user_insert_id;
		$type = 1;
		$text = "Welcome to".SITE_NAME;
		$link="#";
		$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
		
		/* Code to check request sent to user already in mail_sent table  */
		$this->load->model("mail_model","mail");	
		$return = $this->mail->checkRegisteredEmail($emailId );
		
		if($return != " ") {
			$to_id 			= $user_insert_id;
			$from_user_id 	= $return[0]->from_user_id;
			$subject 		= $return[0]->subject;
			$added_on 		= $return[0]->added_on;
			$mail_body 		= $return[0]->mail_body;
			$status 		= $return[0]->status;
			$this->mail->insertExistingInvitationToInbox($to_id,$from_user_id,$subject,$added_on,$mail_body,$status,$emailId);
		}
		
		/* Code to check request sent to user already in mail_sent table over */
		
		
		/* Code for default Friends  */
		$frndsList = explode(",",DEFAULT_FRIEND_LIST);
		
		$this->load->model("connection_model","connection");		
		$this->connection->makeDefaultFriend($user_insert_id,$frndsList);
		
		/* Code for default Friends Over */  
		
				
		/* sending welcome mail */
		
		
		// make code for sending  email  	 
		/*$query   = $this->db->get_where('email_templates',array('template_name' => 'WELCOME_MAIL'));
		$row     = $query->row(); 
				
		$subject = str_replace("##sitename##",SITE_NAME,$row->template_subject);
		$content = str_replace("{sitename}",SITE_NAME,$row->template_content);
		$content = str_replace("{Username}",ucfirst($firstname)." ".ucfirst($lastname),$content);		
		$content = str_replace("{sitelink}",SITE_URL,$content);
		$content = str_replace("{email}",$emailId,$content);
		$content = str_replace("{password}",$this->input->post("regPassword"),$content);		
		$content = str_replace("{leftimage}",base_url().'assets/images/left.png',$content);
		$content = str_replace("{rightimage}",base_url().'assets/images/right.png',$content);
			
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From:'.SITE_NAME.' <'.REGISTER_FROM_EMAIL.'>'. "\r\n";
				
		mail($emailId,$subject,$content,$headers);	*/	
			
		//$from    = REGISTER_FROM_EMAIL;
		//$to      = $emailId;
		
		/*$query   = $this->db->get_where('tbl_email_templates',array('template_name' => 'Register confirmation'));
		$row     = $query->row(); 
		
		$confirmlink = base_url()."index.php/confirmation/checkToken/".$activationKey;
		$removelink  = base_url()."index.php/removeconfirmation/".$activationKey;
		
		$subject = str_replace("[sitename]","Fusion Media",$row->template_subject);
		$content = str_replace("[sitename]","Fusion Media",$row->template_content);
		$content = str_replace("[confirmlink]",$confirmlink,$content);
		$content = str_replace("[removelink]",$removelink,$content);

		$this->sendEmail($from, $to, $subject, $content);
			*/		
	}
	function updateUser($updateArray,$userId){
		$this->db->where('id', $userId);
		$this->db->update($this->table, $updateArray);

	}
	
	function updateProfessionalUser($updateArray,$userId,$pid){
		$this->db->where('id', $pid);
		$this->db->update($this->ptable, $updateArray);
	}
	
	function insertProfessionalUser($insertArray,$userId,$pid){
		$this->db->insert($this->ptable, $insertArray);
	}
	
	public function generateKey(){
		$length = 10;
		$characters = '09824675134APOIUYTREWMNBVCXZLKJASDFGQ';
   		$string = '';
    	for ($p = 0; $p < $length; $p++) {
        	$string .= $characters[mt_rand(0, strlen($characters))];
    	}
 
    	return $string;
	}
	
//	public function sendEmail($from, $to, $subject, $message){
//		$this->load->library('email');
//   		$this->email->from($from,'jayana gohil');
//   		$this->email->to($to);
//   		$this->email->subject($subject);
//   		$this->email->message($message);
//   		$this->email->send();
//	}
	
	/* Function to chceck login and set appropriate sesssion for valid user */
	function loginCheck($username,$password){
		//$sql 		= "SELECT * FROM $this->table where `email`= '".$username."' AND `password` = '".md5($password)."' and status=1";
		$sql 	= "SELECT * FROM $this->table where email='".$username."'";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();


		if(count($result)>0){
			
			 $CI = & get_instance();
			 $CI->load->library('Encryptdecrypt'); // load encript decript api
			 $Encryptdecrypt = new Encryptdecrypt();

			 $dbPassword = $Encryptdecrypt->decrypt($result[0]->password);
		
			 if($password != $dbPassword)
			{
				 return 0;
			 }

			//Weather Code
			$zipcode 		= $result[0]->zipcode;
		//	$weatherMsg		= getWeatherInfo($zipcode);
			$weatherMsg		= '';
			
			$userData = array(
					'userId'  	=> $result[0]->id,
					'userPicture' => $result[0]->profile_picture,
					'userName'  => $result[0]->fname." ".$result[0]->lname,
					'email'     => $result[0]->email,
					'weatherMsg'=> $weatherMsg
			);
			$this->session->set_userdata('sessionData', $userData);
			return 1;
		}else{
			return 0;
		}
	}	

	function getUserIdByEmail($email){
		$sql = "SELECT `id` FROM $this->table WHERE email = '$email'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->id;
	}	
		
	// new  added for connection module
	function getAllMembers($type="",$limit=''){
		$sessionData = $this->session->userdata('sessionData');
		if($sessionData) {
			$c_user_id   = $sessionData['userId'];
			$str = " AND U.id != $c_user_id";
		} else {
			$str = "";
		}
$str1 ='';
		if($type!=""){
		$str1 = " AND (U.type_account = 'AT Employee' OR U.type_account = 'Employee' OR U.type_account = 'Admin'  OR U.type_account = 'AT Admin' OR U.type_account = 'AT SME')";			
		}
		$sql 		= "SELECT
							U.id AS user_id,
							
							U.fname,
							U.lname,
							U.profile_picture,
							U.created_date,
							
							(SELECT `name` FROM country AS C where C.id = U.country_id) AS country_name,
							(SELECT `name` FROM state AS S where S.id = U.state_id) AS state_name														
						FROM
							users U
						WHERE
							U.status = 1".$str.$str1." 
						ORDER BY U.fname ASC
						";
                if($limit)
                {
                    $sql .= " LIMIT ".$limit;
                }
                //echo $sql;die;
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}
// new  added for connection module
	function getUserFullName($id){
		$sql = "SELECT `fname`,`lname` FROM $this->table WHERE id = $id";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->fname." ".$result[0]->lname;
	}

// function to retrieves friends
	function getFriendsById($uId){
		$sql 		= "SELECT							
							U.id,
														U.fname,
							U.lname,
							U.profile_picture,
							U.created_date,
							
							(SELECT `name` FROM country AS C where C.id = U.country_id) AS country_name,
							(SELECT `name` FROM state AS S where S.id = U.state_id) AS state_name							
						FROM
							users U						
						WHERE
							U.status = 1 AND U.id in(SELECT friend_id FROM friends WHERE user_id = $uId)
						ORDER BY U.created_date DESC LIMIT 4
						";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}	
	
	// count total no of friends 
	function countTotalFriends($uId){
		$sql = "SELECT count(friend_id) AS total FROM friends WHERE user_id = $uId";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result[0]->total;
	}	
	
	function sendEmailForgetPassword($email){
		$id = $this->getUserIdByEmail($email);
		$username  = $this->getUserFullName($id);
		
		$new_pwd = $this->generateKey();
		
		// update password 
		
		$this->db->where('email', $email);

		$Encryptdecrypt = new Encryptdecrypt();
		$new_pwd      = $Encryptdecrypt->crypt($new_pwd);

		$this->db->update($this->table, array("password"=>$new_pwd));
		
		// email content 
		
		$query   = $this->db->get_where('email_templates',array('template_name' => 'FORGOT_PASSWORD'));
		$row     = $query->row(); 
			
		$subject = $row->template_subject;
				
		$content = str_replace("{sitename}",SITE_NAME,$row->template_content);		
		$content = str_replace("{siteloginlink}",SITE_URL,$content);		
		$content = str_replace("{Username}",ucfirst($username),$content);
		$content = str_replace("{siteregisterlink}",SITE_REGISTER_URL,$content);
		$content = str_replace("{sitelink}",SITE_URL,$content);
		$content = str_replace("{password}",$new_pwd,$content);		
		$content = str_replace("{leftimage}",base_url().'assets/images/left.png',$content);
		$content = str_replace("{rightimage}",base_url().'assets/images/right.png',$content);
		
		// Always set content-type when sending HTML email

                 $mailcontent = array("To"=>$email,"Subject"=>$subject,"Body"=>$content);
               $mailstatus =   $this->sendemail->sendEmail($mailcontent);

//		$headers = "MIME-Version: 1.0" . "\r\n";
//		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//		$headers .= 'From: '.SITE_NAME.' <'.FORGOT_FROM_EMAIL.'>'. "\r\n";
		if($mailstatus) { return true; } else { return false; }
	}
	
	function updateUserPassword($newPwd){
		$sessionData = $this->session->userdata('sessionData');
		$userId   = $sessionData['userId'];
		
		$Encryptdecrypt = new Encryptdecrypt();
		$newPwd      = $Encryptdecrypt->crypt($newPwd);


		$this->db->where('id', $userId);	    
		if($this->db->update($this->table, array("password"=>$newPwd))) { return 1; } else { return 0; }
		
	}
	
	function sendEnquiry(){
		$name    = $this->input->post("userName"); 
		$email   = $this->input->post("userEmail");
		$phone   = $this->input->post("userPhone");
		$message = $this->input->post("userMsg");
		
		$query   = $this->db->get_where('email_templates',array('template_name' => 'CONTACT_ENQUIRY'));
		$row     = $query->row(); 
		
		$emailId = FROM_EMAIL;	 
		
		$subject = str_replace("##sitename##",SITE_NAME,$row->template_subject);
		$content = str_replace("{sitename}",SITE_NAME,$row->template_content);
		$content = str_replace("{contactName}",ucfirst($name),$content);		
		$content = str_replace("{contactEmail}",$email,$content);
		$content = str_replace("{contactPhone}",$phone,$content);
		$content = str_replace("{contactMessage}",ucfirst($message),$content);		
		$content = str_replace("{leftimage}",base_url().'assets/images/left.png',$content);
		$content = str_replace("{rightimage}",base_url().'assets/images/right.png',$content);
			
		// Always set content-type when sending HTML email

                if($emailId)
                {
                 $mailcontent = array("To"=>$emailId,'bcc'=>'subedar.genie@gmail.com',"Subject"=>$subject,"Body"=>$content);
                 $this->sendemail->sendEmail($mailcontent);
                }

//		$headers = "MIME-Version: 1.0" . "\r\n";
//		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//		$headers .= 'From:'.SITE_NAME.' <'.REGISTER_FROM_EMAIL.'>'. "\r\n";
//		//$headers .= 'Cc: vineshvgohil@gmail.com\r\n';
//
//		mail($emailId,$subject,$content,$headers);
		$this->session->set_flashdata('sendmsg', ' Contact Enquiry sent successfully! We will contact you soon.');
		redirect("dashboard/contactus");
	}

        function getAllCompanies(){
		$sql 		= "SELECT * FROM $this->companytable WHERE status=1 ORDER BY name ASC";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}

	/* functions for admin panel */

	
	function getData($searchArray = "",$offset,$limit){
		
		$sql = "SELECT
						U.id,
						U.email,
						U.fname,
						U.lname,
						U.profile_picture,
						C.name as type_account,
						U.created_date,
						U.status,
						Ct.name AS contry_name,
						S.name AS state_name
						
				FROM
						$this->table AS U
				LEFT JOIN country Ct ON (Ct.id = U.country_id)
				LEFT JOIN state S ON(S.id = U.state_id)
				LEFT JOIN category C ON(C.id = U.type_account)
				 	
				 WHERE 1
		";

		if(isset($searchArray["firstName"]) && $searchArray["firstName"] != "")
			$sql .= " AND U.fname LIKE '%".$searchArray['firstName']."%' " ;
		
		if(isset($searchArray["lastName"]) && $searchArray["lastName"] != "")
			$sql .= " OR U.lname LIKE '%".$searchArray['lastName']."%' " ;
		
		if(isset($searchArray["email"]) && $searchArray["email"] != "")
			$sql .= " OR U.email LIKE '%".$searchArray['email']."%'  " ;
		
		
		
		if(isset($searchArray["status"]) && $searchArray["status"] >= 0)
			$sql .= " AND U.status = '".$searchArray['status']."' ";
		
		
	//	print_r($searchArray);
		//$sql .= " 	1=1";

		 $sql		.= " ORDER BY U.created_date DESC LIMIT $offset,$limit";

		$query 		= $this->db->query($sql);

		$result   	= $query->result();

		return $result;

	}

	
	function countGetData($searchArray = ""){

		$sql 		= "SELECT 
							COUNT(*) AS COUNT
						FROM
							$this->table AS U WHERE 1 ";

		if(isset($searchArray["firstName"]) && $searchArray["firstName"] != "")
			$sql .= " AND U.fname LIKE '%".$searchArray['firstName']."%'  " ;
		
		if(isset($searchArray["lastName"]) && $searchArray["lastName"] != "")
			$sql .= " OR U.lname LIKE '%".$searchArray['lastName']."%'  " ;
		
		if(isset($searchArray["email"]) && $searchArray["email"] != "")
			$sql .= " OR U.email LIKE '%".$searchArray['email']."%' " ;
		
		if(isset($searchArray["status"]) && $searchArray["status"] >= 0)
			$sql .= " AND U.status = '".$searchArray['status']."' ";
		
			
		

		$query 		= $this->db->query($sql);
		$result   	= $query->result();

		if(count($result)>0)
			return $result[0]->COUNT;
		else
			return 0;
	}
	

	function userDetail($id){
		$sql 		= "SELECT 		
							U.fname,
							U.lname,
							U.country_id,
							U.state_id,
							U.professional_status,
							(SELECT `name` FROM country AS C where C.id = U.country_id) AS country,
							(SELECT `name` FROM state AS S where S.id = U.state_id) AS state,
                                                        (SELECT `name` FROM category AS C where C.id = U.department_id) AS department,  
                                                        (SELECT `name` FROM company AS CO where CO.id = U.company_id) AS company,
							U.city,
                                                        U.company_id,
                                                        U.department_id,
							U.zipcode,
							U.other,
							U.email,
							U.profile_picture,						
							U.bio,
							U.dob,
							U.background,
                                                       U.created_date,
							U.last_login,
							U.mobile_phone,							
							U.consultant_company,
							U.physical_location,
							U.street_address,
							U.organization,
							U.mobile_phone,
							U.office_phone,
							U.primary_org_unit,
							U.extension,                                          
							C.name as type_account,
							U.type_account as type_account_id,
							U.status 
					   FROM 
							$this->table AS U
                                                        LEFT JOIN category C ON(C.id = U.type_account)
					   WHERE U.id = $id";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		return $result;
	}
	
	public function insertNewUserData(){	
	
	
		$firstname     = $this->input->post("user_fname");
		$lastname      = $this->input->post("user_lname");

		$Encryptdecrypt = new Encryptdecrypt();
		$newPwd      = $Encryptdecrypt->crypt($this->input->post("user_password"));

		$password      = $newPwd;
		$emailId       = $this->input->post("email");
	
		$country_id	   = $this->input->post("txtCountry");
		$state_id	   = $this->input->post("state");
		if(empty($country_id))
		{
			$country_id=1;
		}
		else{
			$country_id = $this->input->post('txtCountry');
		}

		if(empty($state_id))
		{
			$state_id=1;
		}
		else{
			$state_id = $this->input->post('state');
		}

		$city		   = $this->input->post("city");
		//$street		   = $this->input->post("street_address");
		$zip           = $this->input->post("zipcode");
		//$organization  = $this->input->post("organization");
		//$pro_status    = $this->input->post("professional_status");
		$accountType   = $this->input->post("usertype");
		$bio           = $this->input->post("bio");
		$status        = $this->input->post("user_status");
		$current_date  = date('Y-m-d H:i:s');
		$company_id        = $this->input->post("txtCompany");
		$department_id       = $this->input->post("txtDepartment");
		//$physical_location       = $this->input->post("physical_location");
		//$consultant_company       = $this->input->post("consultant_company");
		//$primary_org_unit       = $this->input->post("primary_org_unit");
		//$dob       = $this->input->post("dob");
		//$doh       = $this->input->post("doh");
		//$office_phone       = $this->input->post("office_phone");
		$mobile_phone       = $this->input->post("mobile_phone");
		$extension       = $this->input->post("extension");
		
		$tablename     = $this->table;
		
		if($country_id == 0 )
			$country_id =1;
		
		$data          = array(			
			'fname'        => $firstname,
			'lname'        => $lastname,	
			'password'     => $password,
			'email'        => $emailId,
					
			'country_id'   => $country_id,
			'state_id'	   => $state_id,
			'city'		   => $city,
			//'street_address' =>$street,	
			'zipcode'      => $zip,
			//'organization' => $organization,
			//'professional_status' => $pro_status,
			'type_account' => $accountType,
			'bio'		=> $bio,
			'status'	   => 1,	
			'created_date'  => $current_date,
                        'company_id'=> $company_id,
			'department_id'=> $department_id,
			//'physical_location'=> $physical_location,
			//'consultant_company'=> $consultant_company,
			//'primary_org_unit'=> $primary_org_unit,
			//'dob'=> $dob,
			//'doh'=> $doh,
			//'office_phone'=> $office_phone,
			'mobile_phone'=> $mobile_phone,
			'extension'=> $extension						
		);
		
		$this->db->insert($tablename, $data);
		$user_insert_id=$this->db->insert_id();
		
				
		if(isset($_FILES) && isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] ==0){ 		
			$userPath 			= $this->userPath.$user_insert_id;
				
			if(!is_dir($userPath))
			@mkdir($userPath);
				
			$imageName 			= $user_insert_id."_".str_replace(' ','',$_FILES["file_upload"]["name"]);
			$userTargetPath 	= $userPath."/".$imageName;
			move_uploaded_file($_FILES["file_upload"]["tmp_name"],$userTargetPath);
				
			$userThumbPath 		= $userPath."/thumb_".$imageName;
			$userThumbPath1		= $userPath."/thumb120_".$imageName;
			makeThumbnails($userTargetPath,$userThumbPath,USER_THUMB_WIDTH,USER_THUMB_HEIGHT);
			makeThumbnails($userTargetPath,$userThumbPath1,120,120);
				
			//$updateArray["profile_picture"]	= $imageName;
		}	
		$this->db->where('id', $user_insert_id);	    
		$this->db->update($this->table, array('profile_picture' => $imageName));
				
		
		/* Code to check request sent to user already in mail_sent table  */
		$this->load->model("mail_model","mail");	
		$return = $this->mail->checkRegisteredEmail($emailId );
		
		if($return != " ") {
			$to_id 			= $user_insert_id;
			$from_user_id 	= $return[0]->from_user_id;
			$subject 		= $return[0]->subject;
			$added_on 		= $return[0]->added_on;
			$mail_body 		= $return[0]->mail_body;
			$status 		= $return[0]->status;
			$this->mail->insertExistingInvitationToInbox($to_id,$from_user_id,$subject,$added_on,$mail_body,$status,$emailId);
		}
		
		/* Code to check request sent to user already in mail_sent table over */
		
		/* Code for default Friends  */
		$frndsList = explode(",",DEFAULT_FRIEND_LIST);
		
		$this->load->model("connection_model","connection");		
		$this->connection->makeDefaultFriend($user_insert_id,$frndsList);

		
		/* Code for default Friends Over */
		
		/* sending welcome mail */
		
		// make code for sending  email  
	 
		$query   = $this->db->get_where('email_templates',array('template_name' => 'WELCOME_MAIL'));
		$row     = $query->row(); 
				
		$subject = str_replace("##sitename##",SITE_NAME,$row->template_subject);
		$content = str_replace("{sitename}",SITE_NAME,$row->template_content);
		$content = str_replace("{Username}",ucfirst($firstname)." ".ucfirst($lastname),$content);		
		$content = str_replace("{sitelink}",SITE_URL,$content);
		$content = str_replace("{email}",$emailId,$content);
		$content = str_replace("{password}",$this->input->post("regPassword"),$content);		
		$content = str_replace("{leftimage}",base_url().'assets/images/left.png',$content);
		$content = str_replace("{rightimage}",base_url().'assets/images/right.png',$content);
			
		// Always set content-type when sending HTML email

                if($emailId)
                        {
                         $mailcontent = array("To"=>$emailId,"Subject"=>$subject,"Body"=>$content);
                         $this->sendemail->sendEmail($mailcontent);
                        }
//		$headers = "MIME-Version: 1.0" . "\r\n";
//		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//		$headers .= 'From:'.SITE_NAME.' <'.REGISTER_FROM_EMAIL.'>'. "\r\n";
//
//		mail($emailId,$subject,$content,$headers);
	}
		
	/* functions for admin panel over */

        // function to check user profile is complete or not 
	
	function checkUserProfile($userId){
		$sql 		= "SELECT `bio`,`profile_picture` FROM 	$this->table WHERE id = {$userId}";
		
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		$userPData = $result[0];

		//if($userPData->professional_status == 0 || $userPData->bio == ""  ) { 
if($userPData->bio == ""  ) { 
			$value=1; 
		} else { 
			$value=0; 
		}
		
		return $value;
	} 

       function getAllDepartments(){
		$sql 		= "SELECT * FROM `category` WHERE status=1 AND parent_id = 437 ORDER BY name ASC";		
		$query 		= $this->db->query($sql);		
		$result   	= $query->result();		
		return $result;	
	}
	
	function departmentName($id){	
			if($id>0){			
				$sql 		= "SELECT name AS department FROM `category` WHERE id = $id";			
				$query 		= $this->db->query($sql);			
				$result   	= $query->result();			
				return $result[0]->department;		
			}else{			
				return "";		
			}	
	}
	public function getUserCertificationsData()
	{
		$certificatinMasterArray = array("1" => "SWADLP","2" => "CREST","3" => "CISSP","4" => "SSCP","5" => "CAP","6" => "CSSLP","7" => "CCFP","8" => "CCSP","9" => "HCISPP","10" => "CHSE","11" => "CHPSE","12" => "CASP","13" => "Security+","14" => "OSCP","15" => "OSWP","16" => "OSCE","17" => "OSEE","18" => "OSWE","19" => "CISA","20" => "CISM","21" => "CRISC","22" => "GISF","23" => "GSEC","24" => "GISP","25" => "GCFE","26" => "GPPA","27" => "GCIA","28" => "GCIH","29" => "GCUX","30" => "GCWN","31" => "GCED","32" => "GPEN","33" => "GWAPT","34" => "GSLC","35" => "GCPM","36" => "GSSP-NET","37" => "GSSP-JAVA","38" => "GSNA","39" => "GCFA","40" => "GLEG","41" => "GAWN","42" => "GXPN","43" => "GREM","44" => "GSE","45" => "CyberSAFE","46" => "CFR","47" => "CPTE","48" => "CPTC","49" => "ISSO","50" => "PEH","51" => "ISSM","52" => "ISSA","53" => "ISRM","54" => "CEH","55" => "ECSA","56" => "LPT","57" => "CHFI","58" => "ECIH","59" => "ENSA","60" => "CCISO","61" => "EDRP","62" => "ECVP","63" => "ECES","64" => "ECCSP","65" => "EITCA/IS","66" => "CCNA Security","67" => "CCNP Security","68" => "CCIE Security",'69' => "CCNA CyberOps","70" => "CIPP","71" => "CIPM","72" => "CIPT","73" => "eJPT","74" => "eCPPT Gold","75" => "eWPT","76" => "eCRE","77" => "eMAPT","78" => "eNDP");
		return $certificatinMasterArray;
	}

       public  function countUsers(){

        $sql 		= "SELECT count(id) AS totalusers FROM `users` ";
        $query 		= $this->db->query($sql);
        $result   	= $query->result();
        return $result[0]->totalusers;

	}

        public  function countgroups(){

        $sql 		= "SELECT count(id) AS totalgroups FROM `groups` ";
        $query 		= $this->db->query($sql);
        $result   	= $query->result();
        return $result[0]->totalgroups;

	}

        public  function countevents(){

        $sql 		= "SELECT count(id) AS totalevents FROM `events` ";
        $query 		= $this->db->query($sql);
        $result   	= $query->result();
        return $result[0]->totalevents;

	}

        public  function countknowledgebase(){

        $sql 		= "SELECT count(id) AS totalknowledgebase FROM `knowledgebase` ";
        $query 		= $this->db->query($sql);
        $result   	= $query->result();
        return $result[0]->totalknowledgebase;

	}

///////////////////////////////////////////////////////////////////

	//code added by me
	public function getStates()
    {
        $this->db->select('*');
        $this->db->from('state');
        $this->db->where('status','1');
        $this->db->where('country_id','101');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function getLocations()
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where('loc_status','1');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function adduser($data)
    {
    	$query =  $this->db->insert('users', $data);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addVendor($data)
    {
    	$query =  $this->db->insert('vendors', $data);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function getAreaManagersList($userid)
    {		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('usertype','area_manager');
		if($userid != '1')
		{
			$this->db->where('parent_id',$userid);
		}
		$this->db->where('status','1');
		$query = $this->db->get();
		return $result = $query->result_array();
		
    }

    public function getGeneralManagersList($filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	// $this->db->where('usertype','general_manager');
    	$this->db->where('usertype','operational_general_manager');
    	$this->db->or_where('usertype','project_general_manager');
    	
    	if(isset($filters) && !empty($filters))
    	{
    		if($filters['search'] && $filters['search'] != '')
	    	{
	    		$this->db->where('email LIKE "%'.$filters['search'].'%"  OR mobile LIKE "%'.$filters['search'].'%" OR fname LIKE "%'.$filters['search'].'%" OR lname LIKE "%'.$filters['search'].'%"');
	    	}
    	}

    	if($countOnly)
    	{
    		$query = $this->db->get();
    		return $result = $query->num_rows();	
    	}
    	else
    	{
    		$this->db->limit($limit,$offset);
    		$this->db->order_by('created_date','DESC');
    		$query = $this->db->get();
    		return $result = $query->result_array();
    	}
    }

    public function getOperationalGeneralManagersList($filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('usertype','operational_general_manager');
    	if(isset($filters) && !empty($filters))
    	{
    		if($filters['search'] && $filters['search'] != '')
	    	{
	    		$this->db->where('(email LIKE "%'.$filters['search'].'%"  OR mobile LIKE "%'.$filters['search'].'%" OR fname LIKE "%'.$filters['search'].'%" OR lname LIKE "%'.$filters['search'].'%")');
	    	}
    	}
    	if($countOnly)
    	{
    		$query = $this->db->get();
    		return $result = $query->num_rows();	
    	}
    	else
    	{
    		$this->db->limit($limit,$offset);
    		$this->db->order_by('created_date','DESC');
    		$query = $this->db->get();
    		return $result = $query->result_array();
    	}

    }

    public function getProjectGeneralManagersList($filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('usertype','project_general_manager');
    	if(isset($filters) && !empty($filters))
    	{
    		if($filters['search'] && $filters['search'] != '')
	    	{
	    		$this->db->where('(email LIKE "%'.$filters['search'].'%"  OR mobile LIKE "%'.$filters['search'].'%" OR fname LIKE "%'.$filters['search'].'%" OR lname LIKE "%'.$filters['search'].'%")');
	    	}
    	}
    	if($countOnly)
    	{
    		$query = $this->db->get();
    		return $result = $query->num_rows();	
    	}
    	else
    	{
    		$this->db->limit($limit,$offset);
    		$this->db->order_by('created_date','DESC');
    		$query = $this->db->get();
    		return $result = $query->result_array();
    	}

    }

    public function getGeneralManagersListt()
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	// $this->db->where('usertype','general_manager');
    	$this->db->where('usertype','operational_general_manager');
    	$this->db->or_where('usertype','project_general_manager');
    	
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get();
		return $result = $query->result_array();
    	
    }

    public function getAccountantList($filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('usertype','accountant');

    	if(isset($filters) && !empty($filters))
    	{
    		if($filters['search'] && $filters['search'] != '')
	    	{
	    		$this->db->where('email LIKE "%'.$filters['search'].'%"  OR mobile LIKE "%'.$filters['search'].'%" OR fname LIKE "%'.$filters['search'].'%" OR lname LIKE "%'.$filters['search'].'%"');
	    	}
    	}

    	if($countOnly)
    	{
    		$query = $this->db->get();
    		return $result = $query->num_rows();	
    	}
    	else
    	{
    		$this->db->limit($limit,$offset);
    		$this->db->order_by('created_date','DESC');
    		$query = $this->db->get();
    		return $result = $query->result_array();
    	}
    }

    public function getVendorList($parent_id='',$filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
    	$this->db->from('vendors');    	
    	if($parent_id)
    	{
    		$this->db->where('parent_id',$parent_id);
    	}
    	if(!empty($filters))
    	{
	    	if($filters['search'] && $filters['search'] != '')
	    	{
	    		$this->db->where('vendor_name LIKE "%'.$filters['search'].'%"  OR email LIKE "%'.$filters['search'].'%" OR mobile_no LIKE "%'.$filters['search'].'%" OR company LIKE "%'.$filters['search'].'%"');
	    	}
    	}
    	if($countOnly)
    	{
    		$query = $this->db->get();
    		return $result = $query->num_rows();	
    	}
    	else
    	{
    		$this->db->limit($limit,$offset);
    		$this->db->order_by('created_at','DESC');
    		$query = $this->db->get();
    		return $result = $query->result_array();
    	}
    }

    public function getAllvendors()
    {
    	$this->db->select('*');
    	$this->db->from('vendors');    	
    	// $this->db->where('status','1');
    	$query = $this->db->get();
    	return $result = $query->result_array();
    }

    public function getUserDetails($id)
    {
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('id',$id);
    	$query = $this->db->get();
    	return $result = $query->result_array();	
    }

    public function getUsertype($profile_id)
    {
    	$this->db->select('usertype');
    	$this->db->from('users');
    	$this->db->where('id',$profile_id);
    	$query = $this->db->get();
    	return $result = $query->row_array();
    }

    public function getProfileImg($profile_id)
    {
    	$this->db->select('profile_picture');
    	$this->db->from('users');
    	$this->db->where('id',$profile_id);
    	$query = $this->db->get();
    	return $result = $query->row_array();
    }

    public function removeProfilePic($profile_id)
    {
    	$data = array( 
    			'profile_picture' =>""
    		);
    	$this->db->where('id',$profile_id)->update('users',$data);
    }



    public function delete_profile($profile_id)
    {
    	$this->db->where('id', $profile_id);
      	$this->db->delete('users'); 
      	if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getVendorDetails($id)
    {
    	$this->db->select('*');
    	$this->db->from('vendors');
    	$this->db->where('vendor_id',$id);
    	$query = $this->db->get();
    	return $result = $query->row_array();
    }

    public function getAreaManagerCount($userid)
    {
    	$this->db->select('*');
		$this->db->from('users');
		$this->db->where('usertype','area_manager');
		$this->db->where('parent_id',$userid);
		$query = $this->db->get();
		return $result = $query->num_rows();
    }

    public function getAreaManagers($parent_id='',$usertype='',$filters=array(),$offset="",$limit="",$countOnly='')
    {
    	$this->db->select('*');
		$this->db->from('users');
		$this->db->where('usertype','area_manager');

		if($usertype == 'general_manager')
		{
			$this->db->where('parent_id',$parent_id);
		}

		if(isset($filters) && !empty($filters))
		{
			$this->db->where("( fname LIKE '%".$filters['search']."%' OR lname LIKE '%".$filters['search']."%' OR email LIKE '%".$filters['search']."%' OR mobile LIKE '%".$filters['search']."%')" );
		}

		if($limit)
		{
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('id','DESC');
		$query = $this->db->get();

		if($countOnly)
		{
			return $result = $query->num_rows();
		}
		else
		{
			return $result = $query->result_array();
		}
    }
}

?>