<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class AdminPorders extends CI_Controller {

    public  $adminSession; // variable for store admin session details
    function __construct()
    {
    	parent::__construct();
		//Load database and other helpers so it can be used within every method
    	$this->load->database();
    	$this->adminSession = $this->session->userdata('adminSession');

    	$this->load->model("outlets_model","outlets");
    	$this->load->model("porders_model","porder");
    	$this->load->model("users_model","users");
    	if($this->adminSession['isAdminLoggedIn'] != true)
    		redirect('admin');

    	$this->load->library('paginationnew');
    	set_title('PO Order | ' . SITE_NAME);
    	$metatag = array("content" => "", "keywords" => "", "description" => "");
    	set_metas($metatag);
    	date_default_timezone_set("Asia/Kolkata");
    }

    public function index()	
    {
    	$data = array();

    	$userId = $this->adminSession['user_id'];
    	$data['usertype']= $usertype = $this->adminSession['usertype'];

    	$filters = array();
    	$filters['search'] = $data['search'] = $this->input->get('search');
    	$filters['order_status'] = $data['order_status'] = $this->input->get('order_status');

    	$page = $this->input->get('page');
    	$page = $page ? $page :1;
    	$limit = 50;

    	$order_count = $this->porder->getData($userId,$usertype,$filters,'','','1'); 
    	$totalRecord = $order_count;

    	$startLimit = ($page-1) * $limit;
    	$sqlLimit = ' LIMIT '.$startLimit.",".$limit;
    	$data['startLimit'] = $startLimit;

    	$pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
    	$data['pagination'] = $pagination;

    	$data['outletData'] = $this->porder->getData($userId,$usertype,$filters,$startLimit,$limit); 

    	$data['filtres']= $filters;

        /*
        $searchArray["name"]	= ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";
        $searchArray["status"]		= ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;

        // if area manager then show his order
        if($usertype =='area_manager')
        {
           $searchArray["createdby_id"] = $userId ;
        }

        $page = $this->input->get('page');
        $page = $page ? $page : 1;
        $Limit =  PER_PAGE_RECORD;
        $totalRecord = $this->porder->countGetData($searchArray);

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $this->paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['pagination'] = $pagination;
        $data["outletData"] = $this->porder->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;
        $data['usertype'] = $usertype;
        */    
        // print_r($data["outletData"]);die;
        $this->template->load('admintemplate', 'contents' , 'admin/porders/list_ordersTpl', $data);
    }

    public function neworder()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$parent_id = $adminSession['user_id'];

    		$data = array();
    		$data['location'] = $this->users->getLocations();
    		$data['state'] = $this->users->getStates();
    		$data['arrTaxslab'] = $this->porder->getTaxslab();
    		$data['outlets'] = $this->porder->getOutlets($parent_id);    
    		$data['party'] = $this->porder->getVendorList($parent_id);
        // $data['party'] = '';
    		$data['parent_id'] = $parent_id;
    		$data['arrpriority'] = array('high'=>'High','medium'=>'Medium','low'=>'Low');

        // echo "<pre>";
        // print_r($data);die;
    		$this->template->load('admintemplate', 'contents' , 'admin/porders/new_oderTpl', $data);
    	}
    	else
    	{
    		redirect('/admin');
    	}    
    }

    public function save_poorder()
    {
        // $data = $this->input->post();
        // echo"<pre>"; print_r($data); echo "</pre>";            
        // die;
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$userId = $this->adminSession['user_id'];
    		$outlet = $this->input->post('outlet');
    		$party_name = $this->input->post('party_name');
    		$tasklist = $this->input->post('task');
            // $amount = $this->input->post('amount');
    		$amount = $this->input->post('grand_total');
    		$description = $this->input->post('description');
    		$taxslab = $this->input->post('taxslab');
    		$priority = $this->input->post('priority');

    		$uploaded_file ='';
    		if(!empty($_FILES['photograph']['name']))
    		{

    			$config['upload_path'] = FCPATH.'assets/upload/poorder';
    			$config['allowed_types'] = '*';
    			$this->load->library('upload',$config);

    			if(!$this->upload->do_upload('photograph'))
    			{
    				$error = $this->upload->display_errors();
    				$this->session->set_flashdata('message', $error);
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
    			$uploaded_file = '';
    		}

    		$data = array(
    			'amount'        => $amount,
    			'company_id'    => $outlet,
    			'created_date'  =>date('Y-m-d h:i:s'),
    			'createdby_id'  => $userId,
    			'document_name' => $uploaded_file,
    			'order_priority'=> $priority,
    			'order_status'  => 'pending',
    			'party_name'    => $party_name,
    			'task_details'  => $tasklist,
    			'task_status'   => 'pending',
    			'tax_id'        => $taxslab,
                // 'description'=> $description,
    			);

            // echo "<pre>";
            // print_r($_POST);die;

    		$this->db->insert('orders',$data);
    		$insert_id = $this->db->insert_id();

    		$discription= $this->input->post('description');
    		$hsn        = $this->input->post('hsn');
    		$qty        = $this->input->post('qty');
    		$total      = $this->input->post('total');
    		$unit_price = $this->input->post('unit_price');
    		$gross_total = $this->input->post('gross_total');

    		$count = count($this->input->post('description'));

    		for ($i=0; $i < $count; $i++)
    		{
    			$data = array(
    				'discription'=> $discription[$i],
    				'hsn'        => $hsn[$i],
    				'order_id'   => $insert_id,
    				'quantity'   => $qty[$i],
    				'total'      => $total[$i],
    				'gross_total'=> $gross_total,
    				'unit_price' => $unit_price[$i],
    				);

    			$this->db->insert('multiple_order', $data);
    		}

    		$data1 = array(
    			'order_id' =>$insert_id,
    			'changed_by_id' => $userId,
    			'order_status' => 'pending',
    			'order_comment' => '',
                // 'order_comment' => $description,
    			'changed_date' => date('Y-m-d H:i:s')
    			);

    		$this->db->insert('order_status_history',$data1);
    		$this->session->set_flashdata('message', 'New PO Created Successfully.');
    		redirect('porders');
    	}
    	else
    	{
    		redirect('/admin');
    	}              		
    }

    public function view()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$parent_id = $adminSession['user_id'];

    		$order_id = $this->input->get("id");
    		$data['result'] = $this->porder->getPordersDetails($order_id);

            // print_r($data)	;
            // die;
    		$this->template->load('admintemplate', 'contents' , 'admin/porders/view_pordersTpl', $data);
    	}
    	else
    	{
    		redirect('/admin');
    	}    
    }
    
    public function pdf()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$parent_id = $adminSession['user_id'];

    		$order_id = $this->input->get("id");
          

    		$data['result'] = $this->porder->getPordersDetails($order_id);
    	

            // $this->template->load('admintemplate', 'contents' , 'admin/porders/view_pordersTpl', $data);
    		$this->load->view('admin/porders/viewPdf', $data);
    	}
    	else
    	{
    		redirect('/admin');
    	}    
    }

    public function edit()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$parent_id = $adminSession['user_id'];
    		$order_id = $this->input->get("id");

    		$data['arrTaxslab'] = $this->porder->getTaxslab();
    		$data['party'] = $this->porder->getVendorList($parent_id);
            $data['vendors'] = $this->porder->getVendordropdown($order_id);
    		$data['parent_id'] = $parent_id;
    		$data['outlets'] = $this->outlets->getOutlets();
    		$data['arrpriority'] = array('high'=>'High','medium'=>'Medium','low'=>'Low');
    		$data['result'] = $this->porder->getPordersDetails($order_id);
            $data['edit'] = $this->porder->getPordersdropdown($order_id);
            

    		$this->template->load('admintemplate', 'contents' , 'admin/porders/edit_pordersTpl', $data);
    	}
    	else
    	{
    		redirect('/admin');
    	} 

    }

    public function update_poorder()
    {
        // $data = $this->input->post();
        // echo "<pre>";print_r($data);die;
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		$amount      = $this->input->post('amount');
    		$gross_total = $this->input->post('gross_total');
    		$old_doc_name= $this->input->post('document_name');
    		$order_id    = $this->input->post('id');
    		$outlet      = $this->input->post('outlet');
    		$party_name  = $this->input->post('party_name');
    		$priority    = $this->input->post('priority');
    		$tasklist    = $this->input->post('task');
    		$taxslab     = $this->input->post('taxslab');
    		$userId      = $this->adminSession['user_id'];

    		$description= $this->input->post('description');
    		$hsn        = $this->input->post('hsn');
    		$mo_id      = $this->input->post('mo_id');
    		$qty        = $this->input->post('qty');
    		$total      = $this->input->post('total');
    		$unit_price = $this->input->post('unit_price');

    		$uploaded_file ='';
    		if(!empty($_FILES['photograph']['name']))
    		{

    			$config['upload_path'] = FCPATH.'assets/upload/poorder';
    			$config['allowed_types'] = '*';
    			$this->load->library('upload',$config);

    			if(!$this->upload->do_upload('photograph'))
    			{
    				echo $error = $this->upload->display_errors();die;
    				$this->session->set_flashdata('message', $error);
    			}
    			else
    			{
    				$upload_data = $this->upload->data();
    				$uploaded_file = $upload_data['file_name'];
    			}
    		}
    		else 
    		{
    			$uploaded_file = $old_doc_name;
    		}

    		$updateArray = array(
    			'amount'        => $amount,
    			'company_id'    => $outlet,
    			'created_date'  =>date('Y-m-d H:i:s'),
                // 'description'   => $description,
    			'document_name' => $uploaded_file,
    			'order_priority'=> $priority,
    			'order_status'  => 'pending',
    			'party_name'    => $party_name,
    			'task_details'  => $tasklist,
    			'tax_id'        => $taxslab,
    			);


    		$this->db->where('order_id', $order_id);
    		$this->db->update('orders', $updateArray); 

    		$count = count($this->input->post('description'));

    		for ($i=0; $i < $count; $i++)
    		{
    			$multiple_order = array(
    				'discription'=> $description[$i],
    				'hsn'        => $hsn[$i],
                    // 'order_id'   => $id,
    				'quantity'   => $qty[$i],
    				'total'      => $total[$i],
    				'gross_total'=> $gross_total,
    				'unit_price' => $unit_price[$i],
    				);

    			$this->db->where('id', $mo_id[$i])->update('multiple_order', $multiple_order); 
    		}

    		$data1 = array(
    			'order_id' =>$order_id,
    			'changed_by_id' => $userId,
    			'order_status' => 'pending',
                // 'order_comment' => $description,
    			'changed_date' => date('Y-m-d H:i:s')
    			);

    		$this->db->insert('order_status_history',$data1);
    		$this->session->set_flashdata('message', 'Record Updated Successfully.');
    		redirect('porders');
    	}
    	else
    	{
    		redirect('/admin');
    	}  
    }

    public function delete()
    {
    	$id = $this->input->get("id");
    	$userId = $this->adminSession['user_id'];
    	$usertype = $this->adminSession['usertype'];
    	if($id > 0){
    		$this->db->where('order_id', $id);
    		if($usertype !='admin')
    		{
    			$this->db->where('createdby_id', $userId);
    		}
    		$this->db->delete('orders');
            //echo $this->db->last_query('orders');die;
    		$this->session->set_flashdata('errmessage', 'Record Deleted Successfully.');
    	}
    	else
    	{
    		$this->session->set_flashdata('errmessage', 'There is some issue.');
    	}

    	redirect('porders');
    }

    public function gm_comment()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		// if($adminSession['usertype'] == "general_manager")
            if($adminSession['usertype'] == "operational_general_manager" || $adminSession['usertype'] == "project_general_manager")
    		{                
                // print_r($adminSession);
    			$gm_id = $adminSession['user_id'];
    			$gm_status = $this->input->post('gm_status');
    			$gm_comment = $this->input->post('gm_comment');
    			$po_id = $this->input->post('po_id');
    			if($gm_status != "" && $gm_id != "" && $po_id != '')
    			{   
    				if($gm_status == 'approved')
    				{
    					$order_status = "inprocess";
    				}
    				else if($gm_status == 'cancel')
    				{
    					$order_status = "cancel";   
    				}


    				$data = array(
    					'gm_id' => $gm_id,
    					'gm_status' => $gm_status,
    					'gm_comment' => $gm_comment,
    					'order_status' => $order_status,
    					'gm_status_date' => date('Y-m-d H:i:s')
    					);

    				$res = $this->porder->update_gm_status($po_id,$data);

    				$data1 = array(
    					'order_id' =>$po_id,
    					'changed_by_id' => $gm_id,
    					'order_status' => $order_status,
    					'order_comment' => $gm_comment,
    					'changed_date' => date('Y-m-d H:i:s')
    					);

    				$this->db->insert('order_status_history',$data1);

    				$this->session->set_flashdata('message', 'Order status updated successfully.');
    				redirect("adminPorders");
    			}
    			else
    			{
    				$this->session->set_flashdata('errmessage', 'Fields should not be blank.');
    				redirect("adminPorders");
    			}
    		}
    		else
    		{
    			$this->session->set_flashdata('errmessage', 'Only general manager can approve or reject PO');
    			redirect("adminPorders");
    		}    
    	}
    	else
    	{
    		redirect('/admin');
    	} 
    }

    public function admin_comment()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{
    		if($adminSession['usertype'] == "admin")
    		{                
                // print_r($adminSession);
    			$admin_id = $adminSession['user_id'];
    			$admin_status = $this->input->post('admin_status');
    			$admin_comment = $this->input->post('admin_comment');
    			$po_id = $this->input->post('o_id');

                // print_r($_POST);
                // die;
    			if($admin_status != "" && $admin_id != "" && $po_id != '')
    			{   
    				if($admin_status == 'approved')
    				{
    					$order_status = "approved";
    				}
    				else if($admin_status == 'cancel')
    				{
    					$order_status = "cancel";   
    				}


    				$data = array(
    					'director_id' => $admin_id,
    					'director_status' => $admin_status,
    					'director_comment' => $admin_comment,
    					'order_status' => $order_status,
    					'director_status_date' => date('Y-m-d H:i:s')
    					);

    				$res = $this->porder->update_admin_status($po_id,$data);

    				$data1 = array(
    					'order_id' =>$po_id,
    					'changed_by_id' => $admin_id,
    					'order_status' => $order_status,
    					'order_comment' => $admin_comment,
    					'changed_date' => date('Y-m-d H:i:s')
    					);

    				$this->db->insert('order_status_history',$data1);

    				$this->session->set_flashdata('message', 'Order status updated successfully.');
    				redirect("adminPorders");
    			}
    			else
    			{
    				$this->session->set_flashdata('err_message', 'Fields should not be blank.');
    				redirect("adminPorders");
    			}
    		}
    		else
    		{
    			$this->session->set_flashdata('err_message', 'Only admin can approve or reject PO');
    			redirect("adminPorders");
    		}    
    	}
    	else
    	{
    		redirect('/admin');
    	} 
    }

    public function list_approved_po()
    {
    	$adminSession = $this->session->userdata('adminSession');
    	if(isset($adminSession))
    	{

    		$data = array();

    		$userId = $this->adminSession['user_id'];
    		$data['usertype']= $usertype = $this->adminSession['usertype'];

    		$filters = array();
    		$filters['search'] = $data['search'] = $this->input->get('search');

    		$page = $this->input->get('page');
    		$page = $page ? $page :1;
    		$limit = 50;

    		$order_count = $this->porder->getGetApprovedPO($filters,'','','1'); 
    		$totalRecord = $order_count;

    		$startLimit = ($page-1) * $limit;
    		$sqlLimit = ' LIMIT '.$startLimit.",".$limit;
    		$data['startLimit'] = $startLimit;

    		$pagination = $this->paginationnew->getPaginate($totalRecord,$page,$limit);
    		$data['pagination'] = $pagination;

    		$data['outletData'] = $this->porder->getGetApprovedPO($filters, $startLimit, $limit); 

        // echo "<pre>";
        // print_r($data['outletData']);die;

    		$data['filtres']= $filters;


        ////////////////
        /*$data = array();

        $userId = $this->adminSession['user_id'];
        $usertype = $this->adminSession['usertype'];
        
        $searchArray["name"]    = ($this->input->post("filter_title") != "")?$this->input->post("filter_title"):"";
        $searchArray["status"]      = ($this->input->post("filters_status") != "")?$this->input->post("filters_status"):-1;

        $page = $this->input->get('page');
        $page = $page ? $page : 1;
        $Limit =  PER_PAGE_RECORD;
        $totalRecord = $this->porder->countGetApprovedPO($searchArray);

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $this->paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['pagination'] = $pagination;
        $data["outletData"] = $this->porder->getGetApprovedPO($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;
        $data['usertype'] = $usertype;*/
            // print_r($data["outletData"]);die;
        
        $this->template->load('admintemplate', 'contents' , 'admin/porders/list_approved_ordersTpl', $data);
	    }
	    else
	    {
	    	redirect('/admin');
	    }  
	}

	public function makePaymentview($po_id)
	{   
	    // echo $po_id;.
		$adminSession = $this->session->userdata('adminSession');
		if(isset($adminSession))
		{                
			$userId = $this->adminSession['user_id'];
			$usertype = $this->adminSession['usertype'];
			if($usertype == 'accountant')
			{
				$data['po_id'] = $po_id;

				$orderData = $this->porder->getOrderVendorData($po_id);
                $data['pending_amount'] = $orderData['Amount'] - $orderData['paid_amount'];
	                // print_r($orderData);
	                // die;
				$data['total_amount'] = $orderData['Amount'];

                $data['vendor_id'] = $orderData['party_name'];
				$data['vendor_name'] = $orderData['vendor_name'];
				if($orderData['paid_amount'] != "")
				{
					$data['paid_amount'] = $orderData['paid_amount'];
				}
				else
				{
					$data['paid_amount'] = '0';
				}

				$data['payby_user_id'] = $userId;
				$this->template->load('admintemplate', 'contents' , 'admin/porders/paymentTpl', $data);
			}
			else
			{
				$this->session->set_flashdata('err_message', 'You are not authorized to view this page');
				redirect("adminPorders");
			}

		}    
		else
		{
			redirect('/admin');
		}  

	}

	public function make_payment()
	{
		$adminSession = $this->session->userdata('adminSession');
		if(isset($adminSession))
		{                
			$userId = $this->adminSession['user_id'];
			$usertype = $this->adminSession['usertype'];
			if($usertype == 'accountant')
			{
				$payby_user_id = $this->input->post('payby_user_id');
				$vendor_id = $this->input->post('vendor_id');
				$payment_method = $this->input->post('payment_method');
				$order_id = $this->input->post('order_id');
				$paid_amount = $this->input->post('paid_amount');
	                // $payment_type = 'dr';
				$description = $this->input->post('payment_desc');
				$total_amount = $this->input->post('amount');
				$transaction_date = date('Y-m-d H:i:s');
				$accountant_status = $this->input->post('accountant_status');

				if($accountant_status == 'approved')
				{
					$p_accnt_status = '2';
				}
				else if($accountant_status == 'pending')
				{
					$p_accnt_status = '0';
				}
				else if($accountant_status == 'cancel')
				{
					$p_accnt_status = '1';
				}

				$paid_amount = $paid_amount + $total_amount;

				if($payby_user_id != '' && $vendor_id != '' && $payment_method != '' && $order_id != '' && $total_amount != '')
				{
	                //debit from account
					$data = array(
						'payby_user_id' => $payby_user_id,
						'vendor_id' => $vendor_id,
						'payment_method' => $payment_method,
						'order_id' => $order_id,
						'payment_type' => 'dr',
						'description' => $description,
						'total_amount' => $total_amount,                            
						'transaction_date' => $transaction_date,
						'status' => $accountant_status
						);
					$this->porder->addtransaction($data);                   

					$data1 = array(
						'accountant_id' => $payby_user_id,
						'paid_amount' => $paid_amount,
						'accountant_status' =>$accountant_status,
						'accountant_comment' => $description,
						'accountant_status_date' =>$transaction_date,
						'status_date' => $transaction_date
						);  

					$this->porder->update_accountant_status($order_id,$data1);

					$data1 = array(
						'order_id' =>$order_id,
						'changed_by_id' => $payby_user_id,
						'order_status' => $accountant_status,
						'order_comment' => $description,
						'changed_date' => date('Y-m-d H:i:s')
						);

					$this->db->insert('order_status_history',$data1);


					$this->session->set_flashdata('message', 'Payment done successfully');
					redirect("adminPorders/makePaymentview/$order_id");
				}
				else
				{
					$this->session->set_flashdata('err_message', 'You are not authorized to view this page');
					redirect("adminPorders/makePaymentview/$order_id");
				}
			}
			else
			{
				$this->session->set_flashdata('err_message', 'You are not authorized to view this page');
				redirect("adminPorders");
			}

		}    
		else
		{
			redirect('/admin');
		}
	}

	public function pamentHistory($po_id)
	{
		$adminSession = $this->session->userdata('adminSession');
		if(isset($adminSession))
		{                
			$userId = $this->adminSession['user_id'];
			$usertype = $this->adminSession['usertype'];
			if($usertype == 'accountant' || $usertype == 'admin' || $usertype == 'operational_general_manager' || $usertype == 'project_general_manager' || $usertype == 'area_manager')
			{
	                // echo $po_id;
				$data['order_history'] = $this->porder->getPaymentHistory($po_id);

	                // print_r($order_history);die;
				$this->template->load('admintemplate', 'contents' , 'admin/porders/paymentHistroyTpl', $data);

			}
			else
			{
				$this->session->set_flashdata('err_message', 'You are not authorized to view this page');
				redirect("adminPorders");
			}

		}    
		else
		{
			redirect('/admin');
		}
	}

	public function orderHistory($po_id)
	{
		$adminSession = $this->session->userdata('adminSession');
		if(isset($adminSession))
		{                
			$userId = $this->adminSession['user_id'];
			$usertype = $this->adminSession['usertype'];
			if($usertype == 'admin')
			{
	                    // echo $po_id;
				$data['order_history'] = $this->porder->getOrderHistory($po_id);
	                    // echo "<pre/>";
	                    // print_r($data['order_history']);
	                    // die;
				$this->template->load('admintemplate', 'contents' , 'admin/porders/orderHistroyTpl', $data);


			}
			else
			{
				$this->session->set_flashdata('err_message', 'You are not authorized to view this page');
				redirect("adminPorders");
			}

		}    
		else
		{
			redirect('/admin');
		}
	}

	public function update_task_status()
	{
		$adminSession = $this->session->userdata('adminSession');
		if(isset($adminSession))
		{
			$po_id = $this->input->post('po_id');
			$task_status = $this->input->post('task_status');

			$d = array('task_status'=>$task_status);

			$res = $this->db->where('order_id',$po_id)->update('orders',$d);
			if($res)
			{
				echo '1';
			}
			else 
			{
				echo "0";
			}
		}    
		else
		{
			redirect('/admin');
		}
	}
}