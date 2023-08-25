<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();		
		$this->load->model("menulist_model","menu");                
		
		 $this->tempPath	= SITE_ROOT_PATH."/assets/upload/update";
		
		// Load Pagination
		$this->load->library('pagination');
		$this->load->library('table');
		$this->load->helper('captcha');
                

	set_title('Welcome | ' . SITE_NAME);
        $metatag = array("content" => "", "keywords" => "", "description" => "");
        set_metas($metatag);
		
	}

	public function index()
	{
		set_title('Welcome | ' . SITE_NAME);
                $metatag = array("content" => "", "keywords" => "", "description" => "");
                set_metas($metatag);			
				
		 $templateName = "dashboardnewTpl";
                if(frontendLoginCheck(1))
                {
                    $templateName = "dashboardTpl";
                }

		
		$viewData = array();
		

		$this->template->load('template', 'contents' , 'dashboard/'.$templateName,$viewData);
	}
	
	public function start_page(){

           
            $latestTwoGroups = $this->groups->latestTwoGroups();
	    $latestTwoEvents = $this->events->latestTwoEvents();
	    $sessionMenuData = $this->menu->getMenuData();
                $dataview = array(
                    //"rightGroupData"=>$rightGroupData,
                     "latestTwoGroups"=>$latestTwoGroups,
                    "latestTwoEvents"=>$latestTwoEvents,
                  //  "eventsImages"=>$eventImages,
                   // "catData"=>$catData,
                   // "searchCategory"=>$searchCategory,
                   // "ProfileDisplay"=>$ProfileDisplay
                    );
		$this->template->load('template', 'contents' , 'dashboard/start_page',$dataview);
	}
	public function test(){
			echo 'testing ';
			/*
			//new testing code
			$toemail = "atulyadav.genie@gmail.com";
            $msg= "How are you mate?";
			$this->load->library('sendemailnew');  			
        	$this->sendemailnew->sayHello(); //test library 
        	$this->sendemailnew->sendMailTest($toemail,$msg); //send mail check by library     	       	
        	//$this->sendMailTest($toemail,$msg);  //send mail check direct by function
        	*/
        	//old code
        	$this->load->library('sendemail');  
        	$this->sendemail->sayHello();
	}
	
	public function sendMailTest($toemail,$msg){

            $this->load->library('email');

            $config['protocol']    = 'smtp'; //smtp or mail   try by one by one

            $config['smtp_host']    = 'ssl://smtp.gmail.com';

            $config['smtp_port']    = '465';

            $config['smtp_timeout'] = '7';

            $config['smtp_user']    = 'atulyadav.genie@gmail.com';

            $config['smtp_pass']    = 'genie@123';

            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";

            $config['mailtype'] = 'html'; // or html or word

            $config['validation'] = TRUE; // bool whether to validate email or not      

            $this->email->initialize($config);


            $this->email->from('atulyadav.genie@gmail.com', 'Ashling Team Demo');
            $this->email->to($toemail); 


            $this->email->subject('Testing Send Mail | Ashling Team Demo');

            $this->email->message($msg);  

            $this->email->send();

            echo $this->email->print_debugger();

      }

	

	public function register(){
		$rightGroupData = $this->groups->trendingGroups();
		if($this->input->post()){
			// for sending email 
			$this->load->library("sendemail");
			//Check Captcha code again
			$sessionCData = $this->session->userdata('captchaData');
			$captchaWord   = $sessionCData['word'];
			$captcha = $this->input->post("captcha");
			if (strcasecmp($captchaWord, $captcha) == 0) {
				$this->load->model("users_model","register");
				
				$this->register->insertData();
				
				$passArray["name"]		= $this->input->post("firstname");
				$passArray["fullname"]	= ucfirst($this->input->post("firstname"))." ".ucfirst($this->input->post("lastname"));
				$passArray["email"]		= $this->input->post("email");
				$passArray["password"]	= $this->input->post("regPassword");
				

				$this->sendemail->registerEmail($passArray);
				$this->sendemail->thanksEmail($passArray);
				//print_r($passArray);exit;


			$this->register->loginCheck($passArray["email"],$passArray["password"]);						
				redirect("profile/basic");
			}
						
			//redirect('dashboard/confirmation');
		}
		$this->load->model("country_model","country");
		$data["countryArray"] 	= $this->country->getAllCountry();
		$this->load->model("users_model","users");
		//$data["departmentArray"] 	= $this->users->getAllDepartments();

                $data['resonforjoinArr']	= $this->category->getCatByParentId(REASON_FOR_JOINING_CATEGORY);//Update category

		$values = array(                
                'img_path' => './assets/captcha/',
				'img_url' =>  base_url() .'assets/captcha/',
				'img_width' => 150,
				'img_height' => 50,
				'font_size' => 16,
				'font_path'  => base_url() . 'system/fonts/texb.ttf',
				'expiration' => 7200
               );
        $captchCode = create_captcha($values);
      // echo '<Pre>';print_r($captchCode);die;
		$this->session->set_userdata('captchaData', $captchCode);
        $data['image'] = $captchCode['image'];		

        //print_r($data);
		$this->template->load('template', 'contents' , 'registerTpl', $data);

	}
	public function captchaRefresh(){
                $values = array(
                'word' => '',
                'word_length' => 8,
                'img_path' => './assets/captcha/',
                'img_url' =>  base_url() .'assets/captcha/',
                'font_path'  => base_url() . 'system/fonts/texb.ttf',
                'img_width' => '150',
                'img_height' => 50,
                'expiration' => 3600
               );
		$captchCode = create_captcha($values);
		$this->session->set_userdata('captchaData', $captchCode);
		//echo '<Pre>';print_r($captchCode);
		
		
        echo $captchCode['image'];
       }
	   
	   public function checkCaptchaCode(){
			$sessionCData = $this->session->userdata('captchaData');
			$captchaWord   = $sessionCData['word'];

			$captcha = $this->input->post("captcha");
			if (strcasecmp($captchaWord, $captcha) == 0) {				
				echo "true";
			} else {
				echo "false";
			}
	   }
	
	public function confirmation(){
		$data = array();
		$this->template->load('template', 'contents' , 'confirmationTpl', $data);
	}
	public function login(){
		if($this->input->post()){
			$this->load->model("users_model","user");
			$username 	= $this->input->post("username");
			$password 	= $this->input->post("password");
			$status 	= $this->user->loginCheck($username,$password);
			if($status == 0){
				$this->session->set_flashdata('loginError', 'Username/Password is wrong');
			}
		}
		//echo "Hello";exit;
		redirect(base_url());
		//redirect("dashboard/index?start=1");
		//redirect("dashboard/start_page");
		//redirect("dashboard");
		//redirect('dashboard',refresh);
	}
	

	public function forgotpwd(){
		$data = array();		
		$this->load->view('forgotpwdTpl');
	}
	
	/* Insert updates*/
	public function ajaxInsertUpdates(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$this->session->set_userdata('DashboardPage', 0);
			$this->updates->insert();
		}
	}
	
	/* Show messages */
	public function ajaxShowUpdates(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$txtForce 		= $this->input->post("txtForce");
			$txtCategory	= $this->input->post("txtCategory");
			if($txtForce ==1)
				$this->session->set_userdata('DashboardPage', 0);
			
			$data["updateData"] = $this->updates->getAllUpdates($txtCategory);
			if(count($data["updateData"])>0){
				$this->load->view("dashboard/showUpdates",$data);
			}else{
				echo "";
			}
		}
	}
	
	/* Add Comment for updates 	 */
	function ajaxAddComment(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$comment	=	$this->input->post("txtComment");
			$updateId	=	$this->input->post("updateId");
			// for inserting notifications 			
			$this->load->model("notification_model","notification");			
			
			$sessionData   = $this->session->userdata('sessionData');
			$from_user_id  = $sessionData['userId'];
			$from_username = $sessionData['userName']; 
			
			$to_user_id = $this->notification->findUserId($updateId,"user_updates"); // here we have to give id and table name to find out user id 
						
			$link = site_url("dashboard/updateDetail?id=".$updateId);			
			if($from_user_id == $to_user_id) {
				$text = "You commented on your own update";
			} else {
				$text = ucwords($from_username)." has commented on your update";
			}
			$type = 1;
			
			$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
			
			// for inserting notifications over
			$this->updates->addComment($updateId,$comment);
		}
	}
	
	
	/* Show comment for updates*/
	function ajaxShowComment(){
		$updateId	= $this->input->post("updateId");
		if($updateId > 0){
			$this->load->model("updates_model","updates");
			$data["commentData"] = $this->updates->getUpdateComments($updateId);
			/*foreach ($storyData->result() as $row){
			 echo "<pre>";print_r($row);
			}*/
			$this->load->view("dashboard/showComment",$data);
		}
	}
	
	/* Delete Dashboard clip comment*/
	public function deleteUpdatesComment(){
		$commentId = $this->input->get("commentId");
		$updateId = $this->input->get("updateId");
		$this->load->model("updates_model","updates");
		if($commentId >0 && $updateId>0){
			$this->updates->deleteComment($commentId,$updateId);
		}
	}
	
	/* Delete Updates */
	public function deleteUpdates(){
		$id = $this->input->get("id");
		$this->load->model("updates_model","updates");
		if($id >0){
			$this->updates->deleteUpdates($id);
		}
	}
	
	public function aboutus(){
		set_title('About Us | ' . SITE_NAME);
		$rightGroupData = $this->groups->trendingGroups();
		$this->template->load('template', 'contents' , 'aboutusTpl',array("rightGroupData"=>$rightGroupData));
	}
	
	public function contactus(){
		set_title('Contact Us | ' . SITE_NAME);
		$rightGroupData = $this->groups->trendingGroups();
		$this->template->load('template', 'contents' , 'contactusTpl',array("rightGroupData"=>$rightGroupData));
	}	
	
	public function rightlogin(){
		$this->load->view('dashboard/loginTpl');
	}
	
	public function ajaxAddLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId = $this->input->post("updateId");
			$this->updates->addUpdateLike($updateId);
			// for inserting notifications 			
			$this->load->model("notification_model","notification");			
			
			$sessionData   = $this->session->userdata('sessionData');
			$from_user_id  = $sessionData['userId'];
			$from_username = $sessionData['userName']; 
			
			$to_user_id = $this->notification->findUserId($updateId,"user_updates"); // here we have to give id and table name to find out user id 			
			
			$link = site_url("dashboard/updateDetail?id=".$updateId);			
			if($from_user_id == $to_user_id) {
				$text = "You liked your own update";
			} else {
				$text = ucwords($from_username)." has liked your updates";
			}
			$type = 1;
			
			$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
			
			// for inserting notifications over
		}		
	}
	
	public function ajaxAddCommentLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId = $this->input->post("updateId");
			$commentId = $this->input->post("commentId");
			$this->updates->addUpdateCommentLike($updateId,$commentId);
			
			// for inserting notifications 			
			$this->load->model("notification_model","notification");			
			
			$sessionData   = $this->session->userdata('sessionData');
			$from_user_id  = $sessionData['userId'];
			$from_username = $sessionData['userName']; 
			
			$to_user_id = $this->notification->findUserId($updateId,"user_updates"); // here we have to give id and table name to find out user id 			
			$title = $this->notification->getTitle("message","user_updates","id",$updateId);	
			
			$link = site_url("dashboard/updateDetail?id=".$updateId);			
			if($from_user_id == $to_user_id) {
				$text = "You liked your own comment on ".substr($title,0,20)."...";
			} else {
				$text = ucwords($from_username)." has liked your comment on ".substr($title,0,20)."...";
			}
			$type = 1;
			
			$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
			
			// for inserting notifications over
		}
	}
	
	public function ajaxRemoveLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId = $this->input->post("updateId");
			$this->updates->removeUpdateLike($updateId);
		}
		
	}
	
	public function ajaxRemoveCommentLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId = $this->input->post("updateId");
			$commentId = $this->input->post("commentId");
			$this->updates->removeUpdateCommentLike($updateId,$commentId);
		}
		
	}
	
	public function ajaxRemoveCommentReplyLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId = $this->input->post("updateId");
			$commentId = $this->input->post("commentId");
			$replyId = $this->input->post("replyId");
			$this->updates->removeUpdateCommentReplyLike($updateId,$commentId,$replyId);
		}
		
	}
	
	public function ajaxAddCommentReply(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId  = $this->input->post("updateId");
			$commentId = $this->input->post("commentId");
			$reply	   = $this->input->post("reply");
			$this->updates->addUpdateCommentReply($updateId,$commentId,$reply);
			
			// for inserting notifications 			
			$this->load->model("notification_model","notification");			
			
			$sessionData   = $this->session->userdata('sessionData');
			$from_user_id  = $sessionData['userId'];
			$from_username = $sessionData['userName']; 
			
			$to_user_id = $this->notification->findUserId($updateId,"user_updates"); // here we have to give id and table name to find out user id 			
						
			$link = site_url("dashboard/updateDetail?id=".$updateId);			
			if($from_user_id == $to_user_id) {
				$text = "You replied on your own comment";
			} else {
				$text = ucwords($from_username)." has replied on your comment";
			}
			$type = 1;
			
			$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
			
			// for inserting notifications over
		}
	}
	
	function ajaxViewCommentReply(){
		$updateId	= $this->input->post("updateId");
		$commentId	= $this->input->post("commentId");
		
		if($updateId > 0 && $commentId > 0){
			$this->load->model("updates_model","updates");
			$data["commentReplyData"] = $this->updates->getUpdateCommentsReply($updateId,$commentId);
			$this->load->view("dashboard/showReply",$data);
		}
	}

	function ajaxAddCommentReplyLike(){
		$this->load->model("updates_model","updates");
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$updateId 	= $this->input->post("updateId");
			$commentId 	= $this->input->post("commentId");
			$replyId 	= $this->input->post("replyId");
			$this->updates->addUpdateCommentReplyLike($updateId,$commentId,$replyId);
				// for inserting notifications 			
			$this->load->model("notification_model","notification");			
			
			$sessionData   = $this->session->userdata('sessionData');
			$from_user_id  = $sessionData['userId'];
			$from_username = $sessionData['userName']; 
			
			$to_user_id = $this->notification->findUserId($updateId,"user_updates"); // here we have to give id and table name to find out user id 			
						
			$link = site_url("dashboard/updateDetail?id=".$updateId);			
			if($from_user_id == $to_user_id) {
				$text = "You liked your reply on comment";
			} else {
				$text = ucwords($from_username)." has liked your reply on comment";
			}
			$type = 1;
			
			$this->notification->insertNotifications($from_user_id,$to_user_id,$link,$text,$type);
			
			// for inserting notifications 
		}
	}

	function uploadDocument(){
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		
                $fileSizeMB = number_format($_FILES["file"]["size"] / 1048576, 2);

		if($ext != "pdf" AND $ext != "txt" AND $ext != "doc" AND $ext != "docx"){
			echo "error_ext";
		} else if($fileSizeMB > MAX_UPDATE_DOCUMENT_SIZE) {
			echo "error_size";
		} else if(isset($_FILES) && isset($_FILES["file"]) && $_FILES["file"]["error"] ==0){ 				
			$userPath 			= $this->tempPath;
			
			if(!is_dir($userPath))
			@mkdir($userPath);
			
			$docName 			= $_FILES["file"]["name"];			
			$userTargetPath 	= $userPath."/".$docName;
			move_uploaded_file($_FILES["file"]["tmp_name"],$userTargetPath);
			
			echo $docName; 
		} else {
			echo "error";
		}
	}
	
	function uploadImage(){
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

                $fileSizeMB = number_format($_FILES["file"]["size"] / 1048576, 2);
		
		if($ext != "jpg" AND $ext != "jpeg" AND $ext != "png"){
			echo "error_ext";
		} elseif($fileSizeMB > MAX_UPDATE_IMAGE_SIZE) {
			echo "error_size";
		} elseif(isset($_FILES) && isset($_FILES["file"]) && $_FILES["file"]["error"] ==0){ 				
			$userPath 			= $this->tempPath;
			
			if(!is_dir($userPath))
			@mkdir($userPath);
				
			//$imageName 			= uniqid(rand(), true)."_".$_FILES["file"]["name"];	
			$imageName 			= uniqid(rand(), true)."_".date("YmdHis").".".getFileExtension($_FILES["file"]["name"]);
			$userTargetPath 	= $userPath."/".$imageName;
			
			move_uploaded_file($_FILES["file"]["tmp_name"],$userTargetPath);
				
			$userThumbPath 		= $userPath."/thumb_".$imageName;
			$userThumbPath1		= $userPath."/thumb90_".$imageName;
			$userThumbPath2		= $userPath."/big_".$imageName;
			makeThumbnails($userTargetPath,$userThumbPath,UPDATE_THUMB_WIDTH,UPDATE_THUMB_HEIGHT);
			makeThumbnails($userTargetPath,$userThumbPath1,70,70);	
			makeThumbnails($userTargetPath,$userThumbPath2,700,500);				
			unlink($userTargetPath);	
			echo $imageName;
		} else {
			echo "error";
		}
	}
	
	
	function deleteImage(){
		$name = $this->input->post("path");		
		unlink($this->tempPath."/".$name);	
		unlink($this->tempPath."/thumb_".$name);		
		unlink($this->tempPath."/thumb90_".$name);		
	}
	
	function checkEmailExist($uemail = ""){		
			if($uemail == "") {
				$email = $this->input->post("email");		
			} else{
				$email = $uemail;
			}
			
			if($email != ""){									
				$select_sql = $this->db->get_where('users',array("email" => $email ));
				if($select_sql->num_rows()> 0)				
					echo "false";			
				else				
					echo "true";		
				}
			else{			
					echo "false";	
				}	
	}
	
	function checkForgetPassword(){
		$emailId = $this->input->post("txtEmail");
		$select_sql = $this->db->get_where('users',array("email" => $emailId ));
		if($select_sql->num_rows()> 0) {
			$this->load->model("users_model","users");
			$reply = $this->users->sendEmailForgetPassword($emailId);
			if($reply) { echo "yes"; } else { echo "no"; }
		} else {
			echo "EmailNo";
		}
		
	}
	
	function updateDetail(){
		$id = $this->input->get('id');
		$this->load->model("updates_model","updates");
		$data = $this->updates->getUpdateAllDetail($id);
		if($data) {
		$this->template->load('template', 'contents' , 'dashboard/updateDetail',array("updateObj"=>$data[0]));		
		} else {
		redirect("dashboard");
		}
	}
	
	function searchSite(){
		if($this->input->get("tab") != ""){
			$searchTab = $this->input->get("tab");
		} else {
			$searchTab = "people";
		}
		
		if($this->input->post("search") != "") {
			$criteria = rtrim(ltrim($this->input->post("search")));
		} else {
			$criteria = rtrim(ltrim($this->input->get("cr")));
		}
				
		$data['searchTab'] = $searchTab;
		$data['searchCri'] = $criteria;
		
		$this->load->model("search_model","search");
				
		if($searchTab == "groups"){
			$imagePath = "assets/upload/groups/";
			$link = site_url("groups/groupDetail?id=");
		}else if($searchTab == "events"){
			$imagePath = "assets/upload/events/";
			$link = site_url("events/eventDetail?id=");
		}else if($searchTab == "storyclip"){
			$imagePath = "assets/upload/storyclip/thumb120_";			
			$sessionData   = $this->session->userdata('sessionData');
			$login_user_id  = $sessionData['userId'];			
			$data['loggedUserId'] = $login_user_id;			
			
		}else if($searchTab == "knowledgebase"){
			$imagePath = "assets/upload/knowledgebase/";
			$link = site_url("knowledgebase/detail?id=");
		}else if($searchTab == "people"){
			$imagePath = "assets/upload/users/";
			$link = site_url("profile?id=");
		}else if($searchTab == "business"){
			$imagePath = "assets/upload/marketplace/";
			$link = site_url("market/serviceDetail?id=");
		}else if($searchTab == "updates"){
			$imagePath = "assets/upload/users/";
			$link = site_url("dashboard/updateDetail?id=");
		}
		
		// Config setup
				
		$config['base_url'] 		= site_url("dashboard/searchSite?tab=".$searchTab."&cr=".$criteria);
		$config['total_rows'] 		= $this->search->countGetData($searchTab,$criteria);
		$config['per_page'] 		= PER_PAGE_RECORD;
		$config['num_links'] 		= 10;
		$config["uri_segment"] 		= 3;
		$config['use_page_numbers'] = TRUE;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '>>';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<<';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$config['page_query_string'] = TRUE;
		$config['allow_get_array']	= TRUE;

		// Initialize
		$this->pagination->initialize($config);
		
		$offset						= ($this->input->get("per_page") > 0)?($this->input->get("per_page") - 1) * $config['per_page']:0;
		$data["lastpage"]			= ceil($config['total_rows']/$config['per_page']);
		$data["page"]				= ($this->input->get("per_page") > 0)?$this->input->get("per_page"):1;
		
		$data['imagePath'] = $imagePath;
		$data['link']      = $link; 
		$data['userProfileLink'] = site_url("profile?id=");
		
		//$data["knowData"] 			= $this->knowledge->getData($searchArray,$offset,$config['per_page'],"  K.status=1 AND ");		
		$data['searchData'] = $this->search->getSearchDetail($searchTab,$criteria,$offset,$config['per_page']);
		$this->template->load('template', 'contents' , 'searchResultTpl',$data);		
	}
}