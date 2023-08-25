<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');    
class AdminOutlets extends CI_Controller {

    public  $adminSession; // variable for store admin session details
    
    function __construct()
    {
      parent::__construct();
		//Load database and other helpers so it can be used within every method
      $this->load->database();
      $this->adminSession = $this->session->userdata('adminSession');
      
      $this->load->model("outlets_model","outlets");
      $this->load->model("users_model","users");
      if($this->adminSession['isAdminLoggedIn'] != true)
          redirect('admin');

      $this->load->library('paginationnew');
      set_title('Outlets | ' . SITE_NAME);
      $metatag = array("content" => "", "keywords" => "", "description" => "");
      set_metas($metatag);
  }

  public function index()	
  {
      
    $data = array();
		//$this->template->set('title', 'Home');
    $this->load->helper("text");
    $this->load->library('table');

    $adminSession = $this->session->userdata('adminSession');
    $usertype = $adminSession['usertype'];

    if($usertype == 'area_manager')
    {
        // $parent_id = $adminSession['user_id'];
        $parent_id = '';
    }
    else
    {
        $parent_id = '';
    }


    $filters = array();
    $filters['search'] = $data['search'] = $this->input->get('search');

    $page = $this->input->get('page');
    $page = $page ? $page :1;
    $limit = 5;

    $outlet_count = $this->outlets->getData($parent_id,$filters,'','','1'); 
    $totalRecord = $outlet_count;

    $startLimit = ($page-1) * $limit;
    $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
    $data['startLimit'] = $startLimit;

    $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
    $data['pagination'] = $pagination;

    $data['outletData'] = $this->outlets->getData($parent_id,$filters,$startLimit,$limit); 
    
    $data['filtres']= $filters;

    
		/*$searchArray["name"]	= ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";
		$searchArray["status"]		= ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;

        $page = $this->input->get('page');
        $page = $page ? $page : 1;
        $Limit =  PER_PAGE_RECORD;
        $totalRecord = $this->outlets->countGetData($searchArray);

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $this->paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['pagination'] = $pagination;
        $data["outletData"] = $this->outlets->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;*/
        //print_r($data["outletData"]);
        
        $this->template->load('admintemplate', 'contents' , 'admin/outlets/list_outletsTpl', $data);
    }

    public function myoutlets()	{
      $data = array();
      $userId = $this->adminSession['user_id'];
      
      $searchArray["name"]        = ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";
      $searchArray["status"]      = ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;
      $searchArray["manager_id"]  = $userId;


      $page = $this->input->get('page');
      $page = $page ? $page : 1;
      $Limit =  PER_PAGE_RECORD;
      $totalRecord = $this->outlets->countGetData($searchArray);

      $startLimit = ($page - 1) * $Limit;
      $data['startLimit'] = $startLimit;

      $pagination = $this->paginationnew->getPaginate($totalRecord, $page, $Limit);
      $data['pagination'] = $pagination;
      $data["outletData"] = $this->outlets->getData($searchArray, $startLimit, $Limit);
      $data["searchArray"] = $searchArray;
            //print_r($data["outletData"]);

      $this->template->load('admintemplate', 'contents' , 'admin/outlets/list_areamanager_outletsTpl', $data);
  }

  public function newoutlet(){

    $data = array();
    $data['location'] = $this->users->getLocations();
    $data['state'] = $this->users->getStates();
    $data['areaManager'] = $this->users->getAreaManagersList($userid=1);
    $this->template->load('admintemplate', 'contents' , 'admin/outlets/new_outletsTpl', $data);
}

public function save_outlet(){

    
    $brand_name = $this->input->post('brand_name');
    $address = $this->input->post('address');
    $manager = $this->input->post('manager');
    $location = $this->input->post('location');
    $state = $this->input->post('state');
    $city = $this->input->post('city');
    $postal_code = $this->input->post('postal_code');

    $uploaded_file ='';
    if(!empty($_FILES['photograph']['name']))
    {
        $config['upload_path'] = FCPATH.'assets/upload/outlets';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload',$config);

        if(!$this->upload->do_upload('photograph'))
        {
            
            $error = $this->upload->display_errors();
            $this->template->load('admintemplate', 'contents' , 'admin/outlets/new_outletsTpl', $error);
        }
        else
        {
            $upload_data = $this->upload->data();
          
            $uploaded_file = $upload_data['file_name'];
        }
    }
    else
    {
        $uploaded_file = '';
    }
    // if(isset($_FILES["photograph"]["name"]) && !empty($_FILES["photograph"]["name"]))
    //           {   
                
    //               $config['upload_path'] = FCPATH.'assets/upload/outlets';
                 
    //               $config['allowed_types'] = 'gif|jpg|jpeg|png';
    //               $config['max_size']      = 10000;
    //               $config['encrypt_name'] = TRUE;
    //               $data=$this->load->library('upload', $config);
                  
    //               if($this->upload->do_upload('photograph'))
    //                  {
    //                       $upload_data = $this->upload->data();
    //                       print_r($upload_data);die;
    //                       $uploaded_file = $upload_data['file_name'];
                          
    //                  }
    //           }

    $data = array(
        'name' => $brand_name,
        'manager_id' => $manager,
        'location_id' => $location,
        'address' => $address,
        'state_id' => $state,
        'city_name' => $city,
        'pincode' => $postal_code,
        'status' => 1,
        'logo_name' => $uploaded_file,
        'created_date' =>date('Y-m-d H:i:s')
    );


      

    $this->db->insert('company',$data);
    $this->session->set_flashdata('message', 'New Outlet Created Successfully.');
    redirect('admin_outlets');
}

public function view(){

  $sId = $this->input->get("id");        
  $data['outletsEdit'] = $this->outlets->getOutletsDetails($sId);      

  $this->template->load('admintemplate', 'contents' , 'admin/outlets/view_outletsTpl', $data);
}

public function edit(){

    $sId = $this->input->get("id");

    $userType =  $this->adminSession['usertype'];
    $userid =  $this->adminSession['user_id'];

    $data['location'] = $this->users->getLocations();
    $data['state'] = $this->users->getStates();

    $data['areaManager'] = $this->users->getAreaManagersList($userid);
    
    $data['editOutlets'] = $this->outlets->getOutletsDetails($sId);      

    $this->template->load('admintemplate', 'contents' , 'admin/outlets/edit_outletsTpl', $data);
}

public function update_outlet(){

    $name = $this->input->post("brand_name");
    $manager_id = $this->input->post("manager");                    
    $location_id = $this->input->post("location");
    $address = $this->input->post("address");
    $state_id = $this->input->post("state");
    $city_name = $this->input->post("city");
    $pincode = $this->input->post("postal_code");                
    $status = $this->input->post("status");                
    $id = $this->input->post("id");                

    $uploaded_file ='';
    if(!empty($_FILES['photograph']['name']))
    {
        $config['upload_path'] = FCPATH.'assets/upload/outlets';
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

    $updateArray = array(

        'name' => $name,
        'manager_id' => $manager_id,
        'location_id' => $location_id,
        'address' => $address,
        'state_id' => $state_id,
        'city_name' => $city_name,
        'pincode' => $pincode,
        'status' => $status,
        'created_date' =>date('Y-m-d H:i:s'),
    );

    if($uploaded_file)
    {
        $updateArray['logo_name'] = $uploaded_file;
    }

    $this->db->where('id', $id);
    $this->db->update('company', $updateArray); 
    $this->session->set_flashdata('message', 'Record Updated Successfully.');
    redirect('admin_outlets');
}


public function delete(){
  $id = $this->input->get("id");
  if($id > 0){
     $this->db->where('id', $id);
     $this->db->delete('company');
     $this->session->set_flashdata('errmessage', 'Record Deleted Successfully.');
     redirect('admin_outlets');
 }
}

public function changeOutletStatus()
{
    $adminSession = $this->session->userdata('adminSession');
    if(isset($adminSession))
    {
        $outletid = $this->input->post('outlet_id');
        $status = $this->input->post('status');

        $data = array('status'=>$status);

        $res = $this->db->where('id',$outletid)->update('company',$data);
            // echo $this->db->last_query();
        if($res)
        {
            echo '1';
        }
        else
        {
            echo '0';
        }
    }
    else
    {
        redirect('/admin');
    }

}

}