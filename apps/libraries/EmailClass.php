<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailClass {
	function __construct()
	{
		// Call the Model constructor
		$this->Object = &get_instance();
	}
	public function sendEmail($emailArray){
		$this->Object->load->library('email');
		
		$this->Object->email->from($emailArray["From"]);
		$this->Object->email->to($emailArray["To"]);
//		$this->Object->email->cc('another@another-example.com');
//		$this->Object->email->bcc('them@their-example.com');
		
		$this->Object->email->subject($emailArray["Subject"]);
		$this->Object->email->message($emailArray["Body"]);

		@$this->Object->email->send();
	}
	public function getEmailTemplates($type){
		
		$sql 		= "SELECT * FROM  email_templates WHERE template_name='".$type."'";
		$query 		= $this->Object->db->query($sql);
		$result   	= $query->result();
		return $result;
	}
	
	/* Forgot Password */
    public function forgotPassword($emailArray){
    	$this->Object->load->model("users_model","users");
    	
    	$mailArray		 	= array();
 		$tempPassword 		= generateKey(4);

 		$data					= $this->getEmailTemplates("FORGOT_PASSWORD");
    	$mailArray["From"]		= FORGOT_FROM_EMAIL;
    	$mailArray["To"]		= $emailArray["email"];
    	$mailArray["Subject"]	= $data[0]->template_subject;
    	$mailArray["Body"]		= $data[0]->template_content;
	
    	$mailArray["Body"]		= str_replace("##USER##",ucfirst($emailArray["name"]), $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##LOGIN_ID##",$emailArray["email"], $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##PASSWORD##",$tempPassword, $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##SITE_NAME##",SITE_NAME, $mailArray["Body"]);
    	
    	$this->Object->users->updateUser(array("password"=>md5($tempPassword)),$emailArray["id"]);
    	$this->sendEmail($mailArray);
    	//echo "<pre>";print_r($mailArray);exit;
    }
    /* Registration Email */
    public function welecomeEmail($emailArray){
    	$mailArray		 	= array();
    	
    	$data					= $this->getEmailTemplates("WELCOME_MAIL");
    	$mailArray["From"]		= REGISTER_FROM_EMAIL;
    	$mailArray["To"]		= $emailArray["email"];
    	$mailArray["Subject"]	= $data[0]->template_subject;
    	$mailArray["Body"]		= $data[0]->template_content;
    	
    	//$link	= "<a href='".site_url()."'>".base_url()."</a>";
    	$link	= site_url();
    	
    	$mailArray["Subject"]	= str_replace("##sitename##",SITE_NAME, $mailArray["Subject"]);
    	$mailArray["Body"]		= str_replace("##Username##",ucfirst($emailArray["name"]), $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##sitename##",SITE_NAME, $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##Email##",$emailArray["email"], $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##Password##",$emailArray["password"], $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##Link##",$link, $mailArray["Body"]);
    	$this->sendEmail($mailArray);
    }
    /* Invite Friend Email */
    public function invitationEmail($emailArray){
    	$data		= $this->getEmailTemplates("INVITE_EMAIL");
    	$subject	= $data[0]->template_subject;
    	$body		= $data[0]->template_content;
    	$regLink	= site_url("register/index");
    	$emailList	= $emailArray["emailList"];
    	$message	= $emailArray["message"];
    	$regLink	= "<a href='".$regLink."'>".$regLink."</a>";
    	
    	
    	$subject	= str_replace("##sitename##",SITE_NAME, $subject);
    	$subject	= str_replace("##Username##",$emailArray["userName"], $subject);
    	
    	$body		= str_replace("##sitename##",SITE_NAME, $body);
    	$body		= str_replace("##InviteFriendLink##",$regLink, $body);
    	$body		= str_replace("##UserMessage##",$message, $body);
		
    	$emailArray	= explode(",",$emailList);
		if(count($emailArray)>0){
			foreach($emailArray AS $email){
				$mailArray		 	= array();
				$mailArray["From"]		= INVITE_FROM_EMAIL;
				$mailArray["To"]		= $email;
				$mailArray["Subject"]	= $subject;
				$mailArray["Body"]		= $body;
				$this->sendEmail($mailArray);
			}
		}
    }
    /* Add Friend Email */
    public function addFriendEmail($emailArray){
    	$mailArray		 	= array();
    	 
    	$data					= $this->getEmailTemplates("ADD_FRIEND");
    	$mailArray["From"]		= INVITE_FROM_EMAIL;
    	$mailArray["To"]		= $emailArray["email"];
    	$mailArray["Subject"]	= $data[0]->template_subject;
    	$mailArray["Body"]		= $data[0]->template_content;
    	 
    	$link	= "<a href='".site_url()."'>".site_url()."</a>";
    	
    	$mailArray["Subject"]	= str_replace("##sitename##",SITE_NAME, $mailArray["Subject"]);
    	$mailArray["Subject"]	= str_replace("##Username##",$emailArray["FromName"], $mailArray["Subject"]);
    	
    	$mailArray["Body"]		= str_replace("##ReqUsername##",$emailArray["ToName"], $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##sitename##",SITE_NAME, $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##Username##",$emailArray["FromName"], $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##InviteFriendLink##",$link, $mailArray["Body"]);
    	$this->sendEmail($mailArray);
    }
	
	/* Group Share EMail */
	public function shareGroupEmail($emailArray){
		$mailArray		 	= array();
    	
    	$data					= $this->getEmailTemplates("GROUP_SHARE");
    	$mailArray["From"]		= $emailArray['from'];
    	$mailArray["To"]		= $emailArray["emailto"];
    	$mailArray["Subject"]	= $data[0]->template_subject;
    	$mailArray["Body"]		= $data[0]->template_content;
    	
    	$link	= "<a href='".$emailArray["link"]."' target='_blank'>Click here</a>";
    	
    	$mailArray["Subject"]	= str_replace("##sitename##",SITE_NAME, $mailArray["Subject"]);
    	$mailArray["Subject"]	= str_replace("##Username##",$emailArray["FromName"], $mailArray["Subject"]);
    	
    	$mailArray["Body"]		= str_replace("##Username##",$emailArray["FromName"], $mailArray["Body"]);
		$mailArray["Body"]		= str_replace("##Message##",$emailArray["message"], $mailArray["Body"]);
		$mailArray["Body"]		= str_replace("##sitename##",SITE_NAME, $mailArray["Body"]);
    	$mailArray["Body"]		= str_replace("##Link##",$link, $mailArray["Body"]);
	
		$this->sendEmail($mailArray);
	}
	
}
