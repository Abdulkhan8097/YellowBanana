<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->table 	= "users";		
	}
	
	
	function checkAdminLogin($username,$password){	
		
			$txtreturn = false;
			//$sql 		= "SELECT id, fname,lname,email,site_admin FROM $this->table WHERE email='{$username}' AND `password` = '{$password}' AND status=1";
			$sql 		= "SELECT * FROM $this->table WHERE email='{$username}'  AND status=1";
			$query 		= $this->db->query($sql);
			$result   	= $query->result();
			
			if(count($result)) {

				$CI = & get_instance();
			 $CI->load->library('Encryptdecrypt'); // load encript decript api
			 $Encryptdecrypt = new Encryptdecrypt();
			 $dbPassword = $Encryptdecrypt->decrypt($result[0]->password);
			if($password == $dbPassword)
				{
					$adminSession = array(						
						'user_id' => $result[0]->id,
						'email'   => $result[0]->email,
						'fname'   => $result[0]->fname,
						'lname'   => $result[0]->lname,
						'profile_picture'   => $result[0]->profile_picture,
						'usertype'   => $result[0]->usertype,
						'isAdminLoggedIn' 	=> TRUE
					); 

					$this->session->set_userdata('adminSession',$adminSession);

					$txtreturn = true;
				}
			}

			return $txtreturn;
		}

	
	
}

?>