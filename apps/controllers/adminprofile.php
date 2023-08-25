<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminprofile extends CI_Controller {

    public $topMenuData;

    function __construct() {
        parent::__construct();

        $this->load->model('profile_model', 'Profile');
        $this->load->model("users_model","users");
        $this->load->helper('url');       
       //check session if exist then ok else redirect it
        $adminSession = $this->session->userdata('adminSession');
        
         $this->load->model("setting_model", "setting");
        if ($adminSession['isAdminLoggedIn'] != true)
            redirect('admin');

    }

    public function index() {

        //set SEO
        set_title('Profile | ' . SITE_NAME);
        $metatag = array("content" => SITE_NAME, "keywords" => SITE_NAME, "description" => SITE_NAME);
        set_metas($metatag);

    }

      public function my_profile() {
            $data = array();
            $adminSession = $this->session->userdata('adminSession');
            $userid = $adminSession['user_id'];
            $data['profile_data'] = $this->Profile->get_user_details($userid);

            $data['state'] = $this->users->getStates();
	    $data['location'] = $this->users->getLocations();

           //print_r($data['profile_data']);exit;
            $this->template->load('admintemplate', 'contents', 'admin/admin_profile', $data);
           
        }

        public function update_profile(){

            $adminSession = $this->session->userdata('adminSession');
            $userid = $adminSession['user_id'];

            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');                     
            $mobile = $this->input->post('mobile');
            $location = $this->input->post('location');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');

           $uploaded_file ='';
            if(!empty($_FILES['photograph']['name']))
                {

                $config['upload_path'] = FCPATH.'assets/upload/users';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $this->load->library('upload',$config);

                if(!$this->upload->do_upload('photograph'))
                {                   
                    $arrResponse['response'] = 'failure';
                    $arrResponse['message'] = $this->upload->display_errors();
                    // $this->load->view('profile/submit_cv', $error);
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $uploaded_file = $upload_data['file_name'];
                }
            }

             $data = array(
                            'fname' => $first_name,
                            'lname' => $last_name,
                            'mobile'=> $mobile,
                            'region_id' => $location,
                            'state_id' => $state,
                            'city' => $city != ""? $city : "",
                            'zipcode' => $postal_code != ""? $postal_code : "",
                            'created_date' =>date('Y-m-d H:i:s'),
                    );

             if($uploaded_file)
             {
                $data['profile_picture'] = $uploaded_file;
             }


              $this->db->where('id',$userid)->update('users',$data);
             //$this->Profile->update_profile($data, $id);
              $this->session->set_flashdata('success', 'Your data updated Successfully..');
            redirect('adminprofile/my_profile');


        }
         public function update_password() {
            $adminSession = $this->session->userdata('adminSession');
            $userid = $adminSession['user_id'];
            $user_data = $this->Profile->get_user_details($userid);
            $CI = & get_instance();
            $CI->load->library('Encryptdecrypt'); // load encript decript api
            $Encryptdecrypt = new Encryptdecrypt();
            $dbPassord = $Encryptdecrypt->decrypt($user_data['password']);
            $old_pwd = $this->input->post('old_password');
            $new_pwd = $this->input->post('new_password');
            $chk_pwd = $this->input->post('cnf_new_password');

            $err = '';
            if ($old_pwd != $dbPassord) {
                $err = "Old password does not match.";
            } else if ($new_pwd != $chk_pwd) {
                $err = "New and confirm password not matching.";
            }
            //echo $err;exit;
            if ($err) {
                $this->session->set_flashdata('errmessage', $err);
                
            } else {
                $dbnewPassord = $Encryptdecrypt->crypt($new_pwd);
                $data = array(
                    "password" => $dbnewPassord
                );
                // print_r($data);exit;
                $this->Profile->update_password($data, $userid);
                $this->session->set_flashdata('message', 'Password updated successfully.');
                
        }
        redirect("adminprofile/change_password");
    }
    public function updatetransactionpassword() {
            $userid = $this->sessiondata['user_id'];
            $user_data = $this->Profile->get_user_details($userid);
            $CI = & get_instance();
            $CI->load->library('Encryptdecrypt'); // load encript decript api
            $Encryptdecrypt = new Encryptdecrypt();
            $dbPassord = $Encryptdecrypt->decrypt($user_data['transaction_password']);  
            $old_pwd = $this->input->post('old_password');
            $new_pwd = $this->input->post('new_password');
            $chk_pwd = $this->input->post('cnf_new_password');

            $err = '';
           if ($old_pwd != $dbPassord) {
                $err = "Old password does not match.";
            }
            if ($new_pwd != $chk_pwd) {
                $err = "New and confirm password not matching.";
            }
            //echo $err;exit;
            if ($err) {
                $this->session->set_flashdata('errmessage', $err);
                
            } else {
                $dbnewPassord = $Encryptdecrypt->crypt($new_pwd);
                $data = array(
                    "transaction_password" => $dbnewPassord
                );
                // print_r($data);exit;
                $this->Profile->update_password($data, $userid);
                $this->session->set_flashdata('success', 'Password updated successfully.');
                
        }
        redirect("adminprofile/changeTransactionpassword");
    }
    

    public function change_password(){
        $data = array();
          $this->template->load('admintemplate', 'contents', 'admin/change_password', $data);
    }
    
}

