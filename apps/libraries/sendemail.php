<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sendemail {
	function __construct()
	{
		// Call the Model constructor
		$this->Object = &get_instance();
		
	}


	public function sendEmail($emailArray){


         $CI =& get_instance();        

         $config = Array(
                //'protocol' => 'ssl',
                'smtp_host' => SMTP_EMAIL_HOST,
                'smtp_port' => SMTP_EMAIL_PORT,
                'smtp_user' => SMTP_EMAIL,
                'smtp_pass' => SMTP_EMAIL_PASSWORD,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
             );
        

	/*			 $config = Array(
             //   'protocol' => 'ssl',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'Ashlingteam@gmail.com',
                'smtp_pass' => 'Newstart2.0',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',                
             );
*/

        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->set_newline("\r\n");

		$fromemail = FROM_EMAIL;
		$address = isset($emailArray["To"]) ? $emailArray["To"] :FROM_EMAIL;
		$subject = isset($emailArray["Subject"]) ? $emailArray["Subject"] : '';
		$body = isset($emailArray["Body"]) ? $emailArray["Body"] : '';
		//echo $address;die;
        
        $CI->email->from($fromemail,SITE_NAME);
        $CI->email->to($address);

		$CI->email->subject($subject);
		$CI->email->message($body);

        if(isset($emailArray["cc"]))
           {
            $CI->email->cc($emailArray["cc"]);
           }

		   if(isset($emailArray["bcc"]))
           {
            $CI->email->bcc($emailArray["bcc"]);
           }

		
			 
		
  //      $CI->email->message($emailArray["Body"]);

        if (isset($emailArray["attachments"])) {

			if(is_array($emailArray["attachments"]))
			{
				foreach($emailArray["attachments"] as $filePath)
				{
                                  if(file_exists($filePath))
                                  {
                                     $CI->email->attach($filePath);
                                  }
				}
			}
        }
	
        $mailstatus = 2;

        if ($CI->email->send()) {
           $CI->email->clear(TRUE);
            $mailstatus = 1;
        }

       
        return $mailstatus;

                   
       }

	/*public function sendEmail($emailArray){


             $this->Object->load->library('PHPMailer');
                        
             $mail = new PHPMailer(true);
			//$mail->IsSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.office365.com';                 // Specify main and backup server
			$mail->Port = 587;                                    // Set the SMTP port
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'admin@ashlingteam.com';                // SMTP username
			$mail->Password = 'Kaileygirl3';                  // SMTP password
			$mail->SMTPSecure = '';                            // Enable encryption, 'ssl' also accepted

			$mail->From = 'admin@ashlingteam.com';
			$mail->FromName = SITE_NAME;
			$emailArray["From"] =  isset($emailArray["From"]) ? $emailArray["From"] : $mail->From;
			$mail->IsHTML(true);

                        $mail->SetFrom($emailArray["From"],SITE_NAME);
                        $mail->Subject = $emailArray["Subject"];
                         $mail->Body  = $emailArray["Body"];
                        $mail->AddAddress($emailArray["To"], SITE_NAME);


                        $mail->AddReplyTo($emailArray["From"], SITE_NAME);

                        if (isset($emailArray["cc"])) {
                            $mail->AddBCC($emailArray["cc"]);
                        }
                        if (isset($emailArray["bcc"])) {
                            $mail->AddBCC($emailArray["cc"]);
                        }
                       // $mail->AddBCC('subedar.genie@gmail.com');
                        if (isset($emailArray["attachments"])) {
                            $mail->AddAttachment($emailArray["attachments"]);
                        }
                        $mailstatus = $mail->Send();
				
                 /*       if(!$mail->Send()) {
                               echo 'Message could not be sent.';
                               echo 'Mailer Error: ' . $mail->ErrorInfo;
                               exit;
                            } * /
                          
                        return $mailstatus;


       }

	   */

	public function getEmailTemplates($type){
		
		$sql 		= "SELECT * FROM  email_templates WHERE template_name='".$type."'";
		$query 		= $this->Object->db->query($sql);
		$result   	= $query->result();
		return $result;
	}
	
	/* Registration Email */
	public function registerEmail($emailArray){
		
		$mailArray	= array();
		
		$data = $this->getEmailTemplates("WELCOME_MAIL");
		
		$mailArray["From"]		= REGISTER_FROM_EMAIL;
                $mailArray["To"]		= $emailArray["email"];
                $mailArray["Subject"]	= $data[0]->template_subject;
                $mailArray["Body"]		= $data[0]->template_content;
		
		$mailArray["Subject"]   = str_replace("##sitename##",SITE_NAME,$mailArray["Subject"]);
		
		$mailArray["Body"]      = str_replace("{sitename}",SITE_NAME,$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{Username}",ucfirst($emailArray["name"]),$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{sitelink}",SITE_URL,$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{email}",$emailArray["email"],$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{password}",$emailArray["password"],$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{leftimage}",base_url().'assets/images/logo.png',$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{rightimage}",base_url().'assets/images/right.png',$mailArray["Body"]);				
		
		$this->sendEmail($mailArray);				
	}
	/* Registration Email Over */
 
	/* Thank you mail */
	
	public function thanksEmail($emailArray){
		
		$mailArray	= array();
		
		$data = $this->getEmailTemplates("THANKING_MAIL");
		
		$mailArray["From"]		= REGISTER_FROM_EMAIL;
                $mailArray["To"]		= $emailArray["email"];
                $mailArray["Subject"]	= $data[0]->template_subject;
                $mailArray["Body"]		= $data[0]->template_content;
		
		$mailArray["Subject"]   = str_replace("##sitename##",SITE_NAME,$mailArray["Subject"]);
		
		$mailArray["Body"]      = str_replace("{sitename}",SITE_NAME,$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{Username}",$emailArray["fullname"],$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{sitelink}",SITE_URL,$mailArray["Body"]);			
		$mailArray["Body"]      = str_replace("{leftimage}",base_url().'assets/images/logo.png',$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{rightimage}",base_url().'assets/images/right.png',$mailArray["Body"]);				
		
		$this->sendEmail($mailArray);				
	}
	
	/* Thank you mail over */
	
	/* Profile change Email */
	public function profileChangeEmail($emailArray){
		$mailArray	= array();
		
		$data = $this->getEmailTemplates("CHANGE_PROFILE");
		
		$mailArray["From"]		= REGISTER_FROM_EMAIL;
                $mailArray["To"]		= $emailArray["email"];
                $mailArray["Subject"]	= $data[0]->template_subject;
                $mailArray["Body"]		= $data[0]->template_content;
		
		$mailArray["Subject"]   = str_replace("##sitename##",SITE_NAME,$mailArray["Subject"]);
		
		$mailArray["Body"]      = str_replace("{sitename}",SITE_NAME,$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{Username}",$emailArray["fullname"],$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{sitelink}",SITE_URL,$mailArray["Body"]);			
		$mailArray["Body"]      = str_replace("{leftimage}",base_url().'assets/images/logo.png',$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{rightimage}",base_url().'assets/images/right.png',$mailArray["Body"]);				
		
		$this->sendEmail($mailArray);				
	}
	
	/* Profile change Email Over */
	
	/* Password Changed Email */
	public function passwordChangeEmail($emailArray){
		
		$mailArray	= array();
		
		$data = $this->getEmailTemplates("CHANGE_PASSWORD");
		
		$mailArray["From"]		= REGISTER_FROM_EMAIL;
                $mailArray["To"]		= $emailArray["email"];
                $mailArray["Subject"]	= $data[0]->template_subject;
                $mailArray["Body"]		= $data[0]->template_content;
		
		$mailArray["Subject"]   = str_replace("##sitename##",SITE_NAME,$mailArray["Subject"]);
		
		$mailArray["Body"]      = str_replace("{sitename}",SITE_NAME,$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{Username}",$emailArray["fullname"],$mailArray["Body"]);
		//$mailArray["Body"]      = str_replace("{password}",$emailArray["password"],$mailArray["Body"]);
		$mailArray["Body"]      = str_replace("{sitelink}",SITE_URL,$mailArray["Body"]);			
		$mailArray["Body"]      = str_replace("{leftimage}",base_url().'assets/images/logo.png',$mailArray["Body"]);		
		$mailArray["Body"]      = str_replace("{rightimage}",base_url().'assets/images/right.png',$mailArray["Body"]);				
		
		$this->sendEmail($mailArray);				
	}	
	/* Password Changed Email Over */


        public function testemail(){

		$mailArray	= array();

			//	$mailArray["From"]		= REGISTER_FROM_EMAIL;
                $mailArray["To"]		= 'admin@ashlingteam.com';
                $mailArray["cc"]		= 'subedar.yadav@geniesoftsystem.com';
                $mailArray["Subject"]   = 'email from ashling for user';
                $mailArray["Body"]		= 'Hello <br>Welcome to shlingteam site nnnnnnnnnnn  bbbbbbb ';
		
		$this->sendEmail($mailArray);
	}
}