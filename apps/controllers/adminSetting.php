<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed')

;class AdminSetting extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set(TIME_ZONE_FOR_DB);
        //Load database and other helpers so it can be used within every method
        $this->load->database();
        $adminSession = $this->session->userdata('adminSession');
      $this->load->model("setting_model", "setting");
        if ($adminSession['isAdminLoggedIn'] != true)
            redirect('admin');

        $this->load->library('paginationnew');
    }

    public function index() {
        $viewData =  $this->setting->settingview();
           $this->template->load('admintemplate', 'contents', 'admin/settings/settingEditTpl', array('viewData'=>$viewData));
    }

   

    public function Uploadsettingview()
    { 
        $this->load->helper(array('form', 'url'));
    $arrSetting = $this->input->post();
    
    $this->session->unset_userdata($this->input->post('submit'));
   
      if(isset($_FILES) && isset($_FILES["SITE_LOGO"]) && $_FILES["SITE_LOGO"]["error"] ==0){       
            $userPath           = SITE_ROOT_PATH."/assets/images";
                
            if(!is_dir($userPath))
            @mkdir($userPath);
                
            $imageName          = 'logo.png';
            $userTargetPath     = $userPath."/".$imageName;
            move_uploaded_file($_FILES["SITE_LOGO"]["tmp_name"],$userTargetPath);                
            $arrSetting["SITE_LOGO"] = $imageName;
            }
             if(isset($_FILES) && isset($_FILES["ADMIN_SITE_LOGO"]) && $_FILES["ADMIN_SITE_LOGO"]["error"] ==0){       
            $userPath           = SITE_ROOT_PATH."/assets/images";
                
            if(!is_dir($userPath))
            @mkdir($userPath);
                
            $imageName          = 'admin_logo.png';
            $userTargetPath     = $userPath."/".$imageName;
            move_uploaded_file($_FILES["ADMIN_SITE_LOGO"]["tmp_name"],$userTargetPath);
            $arrSetting["ADMIN_SITE_LOGO"] = $imageName;
            }
            

             foreach($arrSetting as $setting_key => $settingValue)
              {
                      $this->db->where('setting_key',$setting_key);
                      $update =  $this->db->update('setting',array('setting_value'=>$settingValue));

              }
              
          $viewData =  $this->setting->settingview();

            $allconatant ="<?php\n";

        foreach($viewData as $setting_key => $settingValue)
          {   

                   $allconatant .= "define('".$setting_key."', '".$settingValue."');\n";
          }

         $allconatant .= "\$config['mysetting']=array();\n";
         $allconatant .= "?>";
       /** write all variable in constant file*/
           $dbDirectory = APPPATH."config";
            $handle = fopen($dbDirectory.'/settingconstant.php','w+');
             fwrite($handle,$allconatant);
             fclose($handle);
             
          if($dbDirectory){
            $msg = 'Setting Updated.';
            $this->session->set_flashdata('message', $msg);
            redirect("adminSetting");
          }else{
                $msg = 'Opps! Some error in updating.';
            $this->session->set_flashdata('message', $msg);
            redirect("adminSetting");
          }
    }

    function deleteUserImage(){
        //  loginCheck();// Check user is login or not(login_helper.php)
        
        $viewData =  $this->setting->settingview();
        $saveImage      = $viewData[1]->SITE_LOGO;
        $path           = $this->userPath.$saveImage;
        $path1          = $this->userPath."thumb_".$saveImage;
        $path2          = $this->userPath."thumb_".$saveImage;
        if($saveImage != "" && file_exists($path)){
            unlink($path);
        }
        $this->db->where('setting_key','SITE_LOGO');
                   $this->db->update('setting',array('setting_value'=>''));
    }

    /* public function viewGroup(){		$groupId = $this->input->get("id");		$data["groupDetail"] = $this->groups->groupDetail($groupId);				$this->template->load('admintemplate', 'contents' , 'admin/groups/viewGroupTpl', $data);	}		public function add()	{		$data = array();				$this->load->model("country_model","country");				$data["countryArray"] 	= $this->country->getAllCountry();		$data["groupTypeArray"] = $this->groups->getGroupTypes();		//$this->template->set('title', 'Home');		$this->template->load('admintemplate', 'contents' , 'admin/groups/groupAddTpl', $data);	}		public function postNewGroup(){		if($this->input->server('REQUEST_METHOD') == "POST"){			$this->groups->addGroup();		}	}		public function editGroup()	{		$data = array();		$gid = $this->input->get("id");				if($gid > 0) {						$this->load->model("country_model","country");					$data["countryArray"] 	  = $this->country->getAllCountry();			$data["stateArray"] 	  = $this->country->getStatesByCountry($data["groupDetailArray"]['detail'][0]->country_id);									$data["groupTypeArray"]   = $this->groups->getGroupTypes();			$data["groupDetailArray"] = $this->groups->getGroupDetail($gid);						$this->template->load('admintemplate', 'contents' , 'admin/groups/groupEditTpl', $data);		} else {			redirect("adminGroups");		}		}		public function updateGroup(){		$gid = $this->input->get("id");			if($this->input->server('REQUEST_METHOD') == "POST" && $gid > 0){						$this->groups->updateGroup($gid);		}else{			redirect("adminGroups");		}	} */
}
