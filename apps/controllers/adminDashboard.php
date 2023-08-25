<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AdminDashboard extends CI_Controller {

       public  $adminSession; // variable for store admin session details

       function __construct()
       {
       	parent::__construct();
		//Load database and other helpers so it can be used within every method
       	$this->load->database();
       	$this->adminSession = $this->session->userdata('adminSession');
       	if($this->adminSession['isAdminLoggedIn'] != True)
       		redirect('admin');
       	$this->load->model("users_model","users");
       	$this->load->model("outlets_model","outlets");
       	$this->load->model("porders_model","porder");
       	$this->load->library('Encryptdecrypt');   
       	$this->load->library('pagination');
       	$this->load->library('paginationnew');
       	date_default_timezone_set("Asia/Kolkata");
       }

       public function index()	
       {
       	$data = array();

       	$userType =  $this->adminSession['usertype'];
       	$userid =  $this->adminSession['user_id'];

       	if($userType=='area_manager')
       	{
            //Get All outlets assinged to area manager
       		$outlets = array();
                     $data["porderData"]  = $this->porder->getLatestPOs($userid,$userType);
                     $data["vendor_count"]= $this->users->getVendorList('','','','','1');
                     $data['outlet_count']= $this->outlets->getOutletCount($userType,$userid);
                     $data['outlets']     = $this->outlets->getoutletsbymanager($userid,0,10);
                     $data['po_count']    = $this->outlets->getPOCount($userType,$userid);

            // echo "<pre>";
            // print_r($data);die;

       		$this->template->load('admintemplate', 'contents' , 'admin/dashboard_areamanager', $data);
       	}
       	// else if($userType=='general_manager')
              else if($userType=='project_general_manager' || $userType=='operational_general_manager')
       	{
                     $data['outlet_count']= $this->outlets->getOutletCount($userType,$userid);
                     $data['outlets']     = $this->outlets->getoutletsbymanager($userid,0,10);
                     $data['po_count']    = $this->outlets->getPOCount($userType,$userid);
                     $data["porderData"]  = $this->porder->getLatestPOs($userid,$userType);

       		$this->template->load('admintemplate', 'contents' , 'admin/dashboard_generalmanager', $data);
       	}
       	else if($userType=='accountant')
       	{
       		$flag = 'count';
       		$data["countporderData"] = $this->porder->getAccPOData($flag,array(), 0, 10);
       		$flag = 'data';
        	// $data["porderData"] = $this->porder->getAccPOData($flag,array(), 0, 10);
       		$data["porderData"] = $this->porder->getLatestPOs($userid,$userType);
        	// echo "<pre>";
        	// print_r($data['porderData']);die;
       		$this->template->load('admintemplate', 'contents' , 'admin/dashboard_accountant', $data);
       	}
              else 
              {
                   $data['general_manager'] = $this->outlets->getGeneralManagerCount();
                   $data['operational_general_manager'] = $this->outlets->getOperationalGeneralManagerCount();
                   $data['project_general_manager'] = $this->outlets->getProjectGeneralManagerCount();
                   $data['area_manager'] = $this->outlets->getAreaManagerCount();
                   $data['accountant'] = $this->outlets->getAccountantCount();
                   $data['outlet_count'] = $this->outlets->getOutletCount($userType,$userid);
                   $data['po_count'] = $this->outlets->getPOCount($userType,$userid);
                   $data['vendor_count'] = $this->outlets->getVendorCount($userType,$userid);

                   $total_po_amount = $this->outlets->getTotalPOAmount();
                   $data['total_po_amt'] = $total_po_amount[0]['total_amt'];

                   $total_paid_amount = $this->outlets->getTotalPaidAmount();
                   $data['total_paid_amt'] = $total_paid_amount[0]['total_amt'];

                   $data["porderData"] = $this->porder->getLatestPOs($userid,$userType);
                  	// $data["porderData"] = $this->porder->getData(array(), 0, 10);
                   $this->template->load('admintemplate', 'contents' , 'admin/dashboard', $data);
            }   		
     }  


	//////////////////area manager start /////////////////////////

     public function add_areaManager()
     {
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $userType =  $this->adminSession['usertype'];
            $userid =  $this->adminSession['user_id'];


            $data['general_manager'] = $this->users->getGeneralManagersListt();
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_areaManagerTpl', $data);
     }
     else
     {
            redirect('/admin');
     }
}

public function list_areaManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $userType =  $this->adminSession['usertype'];
            $userid =  $this->adminSession['user_id'];

            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;

			// $am_count = $this->users->getVendorList($parent_id,$filters,'','','1');	
            $am_count = $this->users->getAreaManagers($userid,$userType,$filters,'','','1');	
            $totalRecord = $am_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['area_managers'] = $this->users->getAreaManagers($userid,$userType,$filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// $total_rows = $this->db->where('usertype','area_manager')->get('users')->num_rows();
			// $data['area_managers'] = $this->users->getAreaManagers();	
			// $limit = 10;
			// $this->load->library('pagination');

			// $config['base_url'] = site_url('/currentopenings/getalljobslist');
			// $config['total_rows'] = $total_rows;
			// $config['per_page'] = $limit;

			// $this->pagination->initialize($config);
			// print_r($area_managers);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_areaManagerTpl',$data);
     }
     else
     {
            redirect('/admin');
     }
}
	//////////////////area manager end /////////////////////////


	//////////////////general manager start /////////////////////////
public function add_generalManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_generalManagerTpl', $data);
			// $this->load->view('admin/add_areaManagerTpl');
     }
     else
     {
            redirect('/admin');
     }
}

public function list_generalManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {

            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;	

            $accountant_count = $this->users->getGeneralManagersList($filters,'','','1');	
            $totalRecord = $accountant_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['area_managers'] = $this->users->getGeneralManagersList($filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// $data['area_managers'] = $this->users->getGeneralManagersList();	
			// print_r($area_managers);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_generalManagerTpl',$data);
     }
     else
     {
            redirect('/admin');
     }
}
	//////////////////general manager end /////////////////////////

	//////////////////Operational general manager start /////////////////////////

public function add_operationalgeneralManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_operationalgeneralManagerTpl', $data);
			// $this->load->view('admin/add_areaManagerTpl');
     }
     else
     {
            redirect('/admin');
     }
}

public function list_operationalgeneralManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {

            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;	

            $accountant_count = $this->users->getOperationalGeneralManagersList($filters,'','','1');	
            $totalRecord = $accountant_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['area_managers'] = $this->users->getOperationalGeneralManagersList($filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// $data['area_managers'] = $this->users->getGeneralManagersList();	
			// print_r($area_managers);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_operationalgeneralManagerTpl',$data);
     }
     else
     {
            redirect('/admin');
     }
}

public function list_projectgeneralManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {

            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;	

            $accountant_count = $this->users->getProjectGeneralManagersList($filters,'','','1');	
            $totalRecord = $accountant_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['area_managers'] = $this->users->getProjectGeneralManagersList($filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// $data['area_managers'] = $this->users->getGeneralManagersList();	
			// print_r($area_managers);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_projectgeneralManagerTpl',$data);
     }
     else
     {
            redirect('/admin');
     }
}	

public function add_projectgeneralManager()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_projectgeneralManagerTpl', $data);
			// $this->load->view('admin/add_areaManagerTpl');
     }
     else
     {
            redirect('/admin');
     }
}

	//////////////////accountatnt start//////////////////////////

public function add_Accountant()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_AccountantTpl', $data);
			// $this->load->view('admin/add_areaManagerTpl');
     }
     else
     {
            redirect('/admin');
     }
}

public function list_accountant()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;	

            $accountant_count = $this->users->getAccountantList($filters,'','','1');	
            $totalRecord = $accountant_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['area_managers'] = $this->users->getAccountantList($filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// $data['area_managers'] = $this->users->getAccountantList();	
			// print_r($data['pagination']);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_AccountantTpl',$data);
     }
     else
     {
            redirect('/admin');
     }
}
	//////////////////accountatnt end//////////////////////////



	///////////////////Vendor Start/////////////////////////

public function add_Vendor()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $userid =  $this->adminSession['user_id'];
            $data['area_manager'] = $this->users->getAreaManagersList($userid);
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            $this->template->load('admintemplate', 'contents' , 'admin/add_VendorTpl', $data);
			// $this->load->view('admin/add_areaManagerTpl');
     }
     else
     {
            redirect('/admin');
     }
}

public function save_vendor()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $parent_id = $this->input->post('parent_id');
            $fullname = $this->input->post('fullname');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');
            $pan = $this->input->post('pan');
            $gst = $this->input->post('gst');
            $status = $this->input->post('status');

            if($fullname !='') 
            {
                  $data = array(
                        'parent_id' => $parent_id,
                        'vendor_name' => $fullname,
                        'mobile_no'=> $mobile != "" ? $mobile : '',
                        'email' => $email != "" ? $email : '',
                        'company' => $company != "" ? $company : '',
                        'address' => $address != "" ? $address : '',
                        'state' => $state != "" ? $state : '',
                        'city' => $city != ""? $city : "",
                        'pincode' => $postal_code != ""? $postal_code : "",
                        'pan' => $pan != "" ? $pan : '',
                        'gst_no' => $gst != "" ? $gst : '',
                        'created_at' =>date('Y-m-d H:i:s'),
                        'status' => $status != "" ? $status : '1'
                 );


                  $result=$this->users->addVendor($data);

                  $this->session->set_flashdata('message', 'Vendor Added successfully.');
                  redirect("adminDashboard/list_vendor");	

           }
           else
           {
                  $this->session->set_flashdata('err_message', 'Field should not be blank.');
                  redirect("adminDashboard/add_Vendor");
           }
    }
    else
    {
     redirect('/admin');
}
}

// public function add_vendor_dynamic()
// {
//       $adminSession = $this->session->userdata('adminSession');
//       if(isset($adminSession))
//       {

//              $parent_id = $this->input->post('parent_id');
//             $vendor_name = $this->input->post('vendor_name');
//             $mobile = $this->input->post('mobile');
//             $email = "";
//             $company =  "";
//             $address =  $this->input->post('address');;
//             $state =  "";
//             $city =  "";
//             $postal_code =  "";
//             $pan =  $this->input->post('pan');
//             $gst =  $this->input->post('gst');

//             if($vendor_name !='') 
//             {
//                   $data = array(
//                         'parent_id' => $parent_id,
//                         'vendor_name' => $vendor_name,
//                         'mobile_no'=> $mobile != "" ? $mobile : '',
//                         'email' => $email != "" ? $email : '',
//                         'company' => $company != "" ? $company : '',
//                         'address' => $address != "" ? $address : '',
//                         'state' => $state != "" ? $state : '',
//                         'city' => $city != ""? $city : "",
//                         'pincode' => $postal_code != ""? $postal_code : "",
//                         'pan' => $pan != "" ? $pan : '',
//                         'gst_no' => $gst != "" ? $gst : '',
//                         'created_at' =>date('Y-m-d H:i:s'),
//                         'status' => '1'
//                  );
//                   echo $result=$this->users->addVendor($data);
//                 // print_r($result);
//            }
//            else
//            {
//                   echo "false";
//            }	
//     }
//     else
//     {
//      redirect('/admin');
// }	
// }
public function add_vendor_dynamic()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {

            $parent_id = $this->input->post('parent_id');
            $vendor_name = $this->input->post('vendor_name');
            $mobile = $this->input->post('mobile');
            $email = "";
            $company =  "";
            $address =  $this->input->post('address');;
            $state =  "";
            $city =  "";
            $postal_code =  "";
            $pan =  $this->input->post('pan');
            $gst =  $this->input->post('gst');

            if($vendor_name !='') 
            {
                  $data = array(
                        'parent_id' => $parent_id,
                        'vendor_name' => $vendor_name,
                        'mobile_no'=> $mobile != "" ? $mobile : '',
                        'email' => $email != "" ? $email : '',
                        'company' => $company != "" ? $company : '',
                        'address' => $address != "" ? $address : '',
                        'state' => $state != "" ? $state : '',
                        'city' => $city != ""? $city : "",
                        'pincode' => $postal_code != ""? $postal_code : "",
                        'pan' => $pan != "" ? $pan : '',
                        'gst_no' => $gst != "" ? $gst : '',
                        'created_at' =>date('Y-m-d H:i:s'),
                        'status' => '1'
                 );
                  echo $result=$this->users->addVendor($data);
                // print_r($result);
           }
           else
           {
                  echo "false";
           }      
    }
    else
    {
     redirect('/admin');
}     
}

public function load_edit_vendor($id)
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $userid =  $this->adminSession['user_id'];
            $data['userdata'] = $this->users->getVendorDetails($id);
            $data['area_manager'] = $this->users->getAreaManagersList($userid);

            $data['state'] = $this->users->getStates();

            $this->template->load('admintemplate', 'contents' , 'admin/edit_VendorTpl', $data);

     }
     else
     {
            redirect('/admin');
     }
}

public function edit_vendor()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $fullname = $this->input->post('fullname');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');
            $pan = $this->input->post('pan');
            $gst = $this->input->post('gst');
            $status = $this->input->post('status');


			// print_r($_POST);
			// die;

            if($fullname !='' && $email != '' && $mobile !='') 
            {
                  $data = array(
                        'vendor_name' => $fullname,
                        'email' => $email,
                        'mobile_no'=> $mobile,
                        'company' => $company,
                        'address' => $address,
                        'state' => $state,
                        'city' => $city != ""? $city : "",
                        'pincode' => $postal_code != ""? $postal_code : "",
                        'pan' => $pan != ""? $pan : "",
                        'gst_no' => $gst != ""? $gst : "",
                        'created_at' =>date('Y-m-d H:i:s'),
                        'status' => $status
                 );
                  $vendor_id = $this->input->post('vendor_id');

                // $result=$this->users->updateuser($profile_id,$data);
                  $this->db->where('vendor_id',$vendor_id)->update('vendors',$data);

                  $this->session->set_flashdata('message', 'Venor updated successfully.');
                  redirect("adminDashboard/load_edit_vendor/".$vendor_id);

                // $this->template->load('admintemplate', 'contents' , 'admin/list_areaManagerTpl',$data);
           }
           else
           {
                  $this->session->set_flashdata('err_message', 'Field should not be blank.');
	        	// redirect("adminDashboard/edit_areaManager");
                  redirect("adminDashboard/load_edit_profile/".$profile_id);
           }
    }
}

public function list_vendor()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $adminSession = $this->session->userdata('adminSession');
            $usertype = $adminSession['usertype'];

       		// if($usertype == 'area_manager')
       		// {
       		// 	$parent_id = $adminSession['user_id'];
       		// }
       		// else
       		// {
       		// 	$parent_id = '';
       		// }
            $parent_id=''; 

            $filters = array();
            $filters['search'] = $data['search'] = $this->input->get('search');

            $page = $this->input->get('page');
            $page = $page ? $page :1;
            $limit = 50;

            $vendor_count = $this->users->getVendorList($parent_id,$filters,'','','1');	
            $totalRecord = $vendor_count;

            $startLimit = ($page-1) * $limit;
            $sqlLimit = ' LIMIT '.$startLimit.",".$limit;
            $data['startLimit'] = $startLimit;

            $pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
            $data['pagination'] = $pagination;

            $data['vendors'] = $this->users->getVendorList($parent_id,$filters,$startLimit,$limit);	

            $data['filtres']= $filters;

			// print_r($data);
			// die;

            $this->template->load('admintemplate', 'contents' , 'admin/list_VendorsTpl',$data);
     }
     else
     {
            redirect('/admin');
     }	
}

public function ban_vendor()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $vendor_id = $this->input->post('vendor_id');
            $status = $this->input->post('status');

            $res = $this->db->where('vendor_id',$vendor_id)->update('vendors',array('status'=>$status));
			// echo $this->db->last_query();
            if($res)
            {
                  echo '1';
           }
           else
           {
                  echo '0';
           }

      		// redirect('/adminDashboard/list_vendor');
    }
    else
    {
     redirect('/admin');
}

}

	///////////////////Vendor End/////////////////////////



	//////////////////Common Start////////////////////
public function save_member()
{

      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            echo "string";
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $mobile = $this->input->post('mobile');
            $location = $this->input->post('location');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');
            $usertype = $this->input->post('usertype');

            if($usertype == 'area_manager')
            {
                  $parent_id = $this->input->post('parentid');
           }
           else
           {
                  $parent_id = '1';
           }

           $status = $this->input->post('status');

           if($first_name !='' && $last_name !='' && $email != '' && $password !='' && $mobile !='') 
           {
                  echo "string";
                  if($usertype == 'area_manager' && $location == "")
                  {

                  }
                  else
                  {
                        if(!empty($_FILES['photograph']['name'])) 
                        {	

                              $config['upload_path'] = 'assets/upload/users';
                              $config['allowed_types'] = 'jpg|png|jpeg';
                              $this->load->library('upload',$config);

                              if(!$this->upload->do_upload('photograph')) 
                              {
                                    $error = array('error' => $this->upload->display_errors()); 
                                    $this->session->set_flashdata('err_message', $error);
                                    redirect("adminDashboard/add_areaManager");
		                    // $arrResponse['response'] = 'failure';
		                    // $arrResponse['message'] = $this->upload->display_errors();                 
                             }
                             else 
                             {
                                    $upload_data = $this->upload->data();
                                    $uploaded_file = $upload_data['file_name'];
                             }
                      }
                      else
                      {
                       $uploaded_file = "";	
                }    	

                $Encryptdecrypt = new Encryptdecrypt();
                $encpassword = $Encryptdecrypt->crypt($password);

                $data = array(
                       'parent_id' => $parent_id,
                       'fname' => $first_name,
                       'lname' => $last_name,
                       'usertype' => $usertype,
                       'email' => $email,
                       'password' => $encpassword,
                       'mobile'=> $mobile,
                       'region_id' => $location,
                       'profile_picture' => $uploaded_file,
                       'state_id' => $state,
                       'city' => $city != ""? $city : "",
                       'zipcode' => $postal_code != ""? $postal_code : "",
                       'created_date' =>date('Y-m-d H:i:s'),
                       'status' => $status
                );


                $result=$this->users->adduser($data);

                $this->session->set_flashdata('message', 'User Added successfully.');
                if($usertype == 'area_manager')
                {
                       redirect("adminDashboard/list_areaManager");
                }
	            	// else if($usertype == 'general_manager')
	            	// {
	            	// 	redirect("adminDashboard/list_generalManager");	
	            	// }
                else if($usertype == 'operational_general_manager')
                {
                       redirect("adminDashboard/list_operationalgeneralManager");	
                }
                else if($usertype == 'project_general_manager')
                {
                       redirect("adminDashboard/list_projectgeneralManager");	
                }
                else if($usertype == 'accountant')
                {
                       redirect("adminDashboard/list_accountant");	
                }

         }
                // $this->template->load('admintemplate', 'contents' , 'admin/list_areaManagerTpl',$data);
  }
  else
  {
    $this->session->set_flashdata('err_message', 'Field should not be blank.');
    redirect("adminDashboard/add_areaManager");
}
}	
}

public function load_edit_profile($id)
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $data['userdata'] = $this->users->getUserDetails($id);
			// print_r($data['userdata'][0]['usertype']);
			// die;

            $Encryptdecrypt = new Encryptdecrypt();

            $data['userdata'][0]['password'] = $Encryptdecrypt->decrypt($data['userdata'][0]['password']);
            $data['state'] = $this->users->getStates();
            $data['location'] = $this->users->getLocations();

            if($data['userdata'][0]['usertype']=='area_manager')
            {
                  // $data['general_manager'] = $this->users->getGeneralManagersList();
                  $data['general_manager'] = $this->users->getGeneralManagersListt();
                  $this->template->load('admintemplate', 'contents' , 'admin/edit_areaManagerTpl', $data);
           }
           // else if($data['userdata'][0]['usertype']=='general_manager')
           // {
           //        $this->template->load('admintemplate', 'contents' , 'admin/edit_generalManagerTpl', $data);
           // }
           else if($data['userdata'][0]['usertype']=='operational_general_manager')
           {
                  $this->template->load('admintemplate', 'contents' , 'admin/edit_operationalgeneralManagerTpl', $data);
           }
           else if($data['userdata'][0]['usertype']=='project_general_manager')
           {
                  $this->template->load('admintemplate', 'contents' , 'admin/edit_projectgeneralManagerTpl', $data);
           }
           else if($data['userdata'][0]['usertype']=='accountant')
           {
                  $this->template->load('admintemplate', 'contents' , 'admin/edit_AccountantTpl', $data);
           }




    }
    else
    {
     redirect('/admin');
}
}

public function edit_profile()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $mobile = $this->input->post('mobile');
            $location = $this->input->post('location');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');
            $usertype = $this->input->post('usertype');
            $status = $this->input->post('status');
            $uploaded_file='';

            if($usertype == 'area_manager')
            {
                  $parent_id = $this->input->post('parentid');
           }
           else
           {
                  $parent_id = '1';
           }

			// print_r($_POST);
			// die;

           if($first_name !='' && $last_name !='' && $email != '' && $password !='' && $mobile !='') 
           {
                  if(!empty($_FILES['photograph']['name'])) 
                  {
                        $config['upload_path'] = 'assets/upload/users';
                        $config['allowed_types'] = 'jpg|png|jpeg';
                        $this->load->library('upload',$config);

                        if(!$this->upload->do_upload('photograph')) 
                        {
                              $error = array('error' => $this->upload->display_errors()); 
	                	// print_r($error);die;
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
                else
                {
                 $uploaded_file = $this->input->post('old_profile_img');
          }    	

                // echo $uploaded_file;die;/	

          $Encryptdecrypt = new Encryptdecrypt();
          $encpassword = $Encryptdecrypt->crypt($password);

          $data = array(
                 'parent_id' => $parent_id,
                 'fname' => $first_name,
                 'lname' => $last_name,
                 'usertype' => $usertype,
                 'email' => $email,
                 'password' => $encpassword,
                 'mobile'=> $mobile,
                 'region_id' => $location,
                 'profile_picture' => $uploaded_file,
                 'state_id' => $state,
                 'city' => $city != ""? $city : "",
                 'zipcode' => $postal_code != ""? $postal_code : "",
                 'created_date' =>date('Y-m-d H:i:s'),
                 'status' => $status
          );
          $profile_id = $this->input->post('profile_id');

                // $result=$this->users->updateuser($profile_id,$data);
          $this->db->where('id',$profile_id)->update('users',$data);

          $this->session->set_flashdata('message', 'Profile updated successfully.');
          redirect("adminDashboard/load_edit_profile/".$profile_id);

                // $this->template->load('admintemplate', 'contents' , 'admin/list_areaManagerTpl',$data);
   }
   else
   {
    $this->session->set_flashdata('err_message', 'Field should not be blank.');
	        	// redirect("adminDashboard/edit_areaManager");
    redirect("adminDashboard/load_edit_profile/".$profile_id);
}
}	
}

public function remove_profile_image($profile_id)
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $getProfileImg = $this->users->getProfileImg($profile_id);
            $usertype = $this->users->getUsertype($profile_id);
            $usertype = $usertype['usertype'];

            $profile_picture = base_url()."assets/upload/users".$getProfileImg['profile_picture'];
            unlink($profile_picture);

            $data = array( 
                  'profile_picture' => ""
           );
            $this->db->where('id',$profile_id)->update('users',$data);

			// $res = $this->users->removeProfilePic($profile_id);
			// die;

            $this->session->set_flashdata('message', 'Profile image removed successfully.');
            redirect("adminDashboard/load_edit_profile/".$profile_id);

     }		
}

public function delete_profile($profile_id)
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $usertype = $this->users->getUsertype($profile_id);
            $usertype = $usertype['usertype'];
			// die;

            $res = $this->users->delete_profile($profile_id);
            if($res)
            {
                  $this->session->set_flashdata('message', 'User deleted successfully.');
                  if($usertype == 'area_manager')
                  {
                        redirect("adminDashboard/list_areaManager");
                 }
                 else if($usertype == 'general_manager')
                 {
                        redirect("adminDashboard/list_generalManager");
                 }
                 else if($usertype == 'accountant')
                 {
                        redirect("adminDashboard/list_accountant");
                 }
          }
          else
          {
           $this->session->set_flashdata('err_message', 'Something went wrong. Try again later');
           if($usertype == 'area_manager')
           {
                 redirect("adminDashboard/list_areaManager");
          }
          else if($usertype == 'general_manager')
          {
                 redirect("adminDashboard/list_generalManager");
          }
          else if($usertype == 'accountant')
          {
                 redirect("adminDashboard/list_accountant");
          }
   }
}	
}

public function ban_user()
{
      $adminSession = $this->session->userdata('adminSession');
      if(isset($adminSession))
      {
            $userid = $this->input->post('userid');
            $status = $this->input->post('status');

            $res = $this->db->where('id',$userid)->update('users',array('status'=>$status));
			// echo $this->db->last_query();
            if($res)
            {
                  echo '1';
           }
           else
           {
                  echo '0';
           }

      		// redirect('/adminDashboard/list_vendor');
    }
    else
    {
     redirect('/admin');
}

}
public function checkEmailExist()
{
      $email = $this->input->post('email');
      $id = $this->input->post('id');

      if ($email!='')
      {
            if (!empty($id) && isset($id))
            {
                  $num_rows=$this->db->select('email')->where('email',$email)->where('id!=',$id)->get('users')->num_rows();
                  if ($num_rows>0)
                  {
                        echo 'true';
                 }else{
                        echo 'false';
                 }
          }
          else
          {
           $num_rows=$this->db->select('email')->where('email',$email)->get('users')->num_rows();
           if ($num_rows>0)
           {
                 echo 'false';
          }else{
                 echo 'true';
          }
   }
}
}
public function checkMobileNo()
{
      $mobile = $this->input->post('mobile');
      $id = $this->input->post('id');

      if ($mobile!='')
      {
            if (!empty($id) && isset($id))
            {
                  $num_rows=$this->db->select('mobile')->where('mobile',$mobile)->where('id!=',$id)->get('users')->num_rows();
                  if ($num_rows>0)
                  {
                        echo 'true';
                 }else{
                        echo 'false';
                 }
          }
          else
          {
           $num_rows=$this->db->select('mobile')->where('mobile',$mobile)->get('users')->num_rows();
           if ($num_rows>0)
           {
                 echo 'false';
          }else{
                 echo 'true';
          }
   }
}
}

	//////////////////Common End////////////////////
}
