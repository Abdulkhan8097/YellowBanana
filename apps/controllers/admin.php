<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//Load database and other helpers so it can be used within every method
		$this->load->database();
		$this->load->library('session');
		//$this->load->library('encrypt');
        $this->load->model('admin_model','admin');
	}
	
	public function index()
	{
        $adminSession = $this->session->userdata('adminSession');
        if(!empty($adminSession['isAdminLoggedIn']))
		redirect('adminDashboard');

    	$errorMsg = "";		
		if($this->input->post()){										
			$username 	= $this->input->post("username");				
			$password 	= $this->input->post("password");
		
					
			if($username != '' && $password != ''){				
				$return = $this->admin->checkAdminLogin($username,$password);
				if($return){
					redirect('adminDashboard');
				} else {
                    $this->session->set_flashdata('errmessage','Invalid Email / Password');
						
				}						
			}else{																
				$this->session->set_flashdata('errmessage','Invalid Email / Password');
			}
		}
		$this->template->load('admintemplate', 'contents' , 'admin/loginTpl',array("errorMsg"=>$errorMsg));
	}

	public function logout()
	{	
		$this->session->unset_userdata('adminSession');
		redirect('admin');
	}	
	
}
