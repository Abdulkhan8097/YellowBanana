<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Porders_model extends CI_Model {

    function __construct() {
        // Call the Model constructor		parent::__construct();
        $this->table = "orders";
    }

    public function getData($userid,$usertype,$filters=array(),$offset='',$limit='',$count='') 
    {

        $sql = "SELECT O.*,O.created_date as order_date,C.name as companyname,v.vendor_name as vendorname FROM $this->table AS O ";
        $sql .= " LEFT JOIN company C ON (C.id=O.company_id)";
        $sql .= " LEFT JOIN vendors v ON (v.vendor_id=O.party_name)";
        $sql .= " WHERE 1 ";


        if($usertype == 'area_manager')
        {
            $sql .= " AND createdby_id = '$userid'";
        }
        else if($usertype == 'general_manager')
        {
            $sql .= " AND createdby_id IN (SELECT id FROM users WHERE parent_id = '$userid')";
        }

        if(!empty($filters))
        {
            if($filters['search'] && $filters['search'] != '')
            {
                // $sql .= " AND (O.party_name LIKE '%".$filters['search']."%')";
                $sql .= " AND (v.vendor_name LIKE '%".$filters['search']."%' OR C.name LIKE '%".$filters['search']."%')";
            }

            // if($filters['order_status'] && $filters['order_status'] != '')
            // {
            //     $sql .= " AND ('O.order_status','".$filters['order_status']."')";
            // }

        }

        /*if (isset($searchArray["party_name"]) && $searchArray["party_name"] != "")
            $sql .= " AND O.party_name LIKE '%" . $searchArray['party_name'] . "%' ";

        if (isset($searchArray["order_status"]) && $searchArray["order_status"] >= 0)
            $sql .= " AND O.order_status = '" . $searchArray['order_status'] . "' ";

        if (isset($searchArray["createdby_id"]) && $searchArray["createdby_id"] >= 0)
            $sql .= " AND O.createdby_id = '" . $searchArray['createdby_id'] . "' ";*/


        if($limit)
        {
            $sql .= " ORDER BY O.order_id DESC LIMIT $offset,$limit";
        }    


        $query = $this->db->query($sql);

        if($count)
        {
            $result = $query->num_rows();       
        }    
        else
        {
            $result = $query->result();
        }

        return $result;
    }

    public function getLatestPOs($userid,$usertype)
    {
        $sql = "SELECT *,O.created_date as order_date,C.name as companyname,v.vendor_name as vendorname FROM $this->table AS O ";
        $sql .= " LEFT JOIN company C ON (C.id=O.company_id)";
        $sql .= " LEFT JOIN vendors v ON (v.vendor_id=O.party_name)";
        $sql .= " WHERE 1 ";


        if($usertype == 'area_manager')
        {
            $sql .= " AND O.createdby_id = '$userid'";
        }
        else if($usertype == 'general_manager')
        {
            $sql .= " AND O.createdby_id IN (SELECT id FROM users WHERE parent_id = '$userid')";
        }
        else if($usertype == 'accountant')
        {
            $sql .= " AND O.director_status = 'approved'";
        }

        $sql .= " ORDER by O.order_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getAccPOData($flag,$searchArray=array(), $offset='', $limit='') 
    {    

        $sql = "SELECT *,O.created_date as order_date,C.name as companyname,v.vendor_name as vendorname FROM $this->table AS O ";            
        $sql .= " LEFT JOIN company C ON (C.id=O.company_id)";
        $sql .= " LEFT JOIN vendors v ON (v.vendor_id=O.party_name)";
        $sql .= " WHERE 1 ";
        $sql .= " AND O.director_status = 'approved'";

        if (isset($searchArray["party_name"]) && $searchArray["party_name"] != "")
            $sql .= " AND O.party_name LIKE '%" . $searchArray['party_name'] . "%' ";

        if (isset($searchArray["order_status"]) && $searchArray["order_status"] >= 0)
            $sql .= " AND O.order_status = '" . $searchArray['order_status'] . "' ";

        if (isset($searchArray["createdby_id"]) && $searchArray["createdby_id"] >= 0)
            $sql .= " AND O.createdby_id = '" . $searchArray['createdby_id'] . "' ";

        $sql .= " ORDER BY O.created_date DESC LIMIT $offset,$limit";

        $query = $this->db->query($sql);
        if($flag == 'count')
        {
            $result = $query->num_rows();
        }
        else
        {
            $result = $query->result();
        }
        return $result;
    }

    public function countGetData($searchArray = "") 
    {

        $sql = "SELECT COUNT(*) AS COUNT FROM $this->table AS O WHERE 1 ";

        if (isset($searchArray["party_name"]) && $searchArray["party_name"] != "")
            $sql .= " AND O.party_name LIKE '%" . $searchArray['party_name'] . "%'  ";

        if (isset($searchArray["order_status"]) && $searchArray["order_status"] >= 0)
            $sql .= " AND O.order_status = '" . $searchArray['order_status'] . "' ";

         if (isset($searchArray["createdby_id"]) && $searchArray["createdby_id"] >= 0)
            $sql .= " AND O.createdby_id = '" . $searchArray['createdby_id'] . "' ";

        $query = $this->db->query($sql);
        $result = $query->result();

        if (count($result) > 0)
            return $result[0]->COUNT;
        else
            return 0;
    }


    public function getoutletsbymanager($managerid='',$offset='', $limit='') {

        $sql = "SELECT *, U.fname, L.loc_name FROM $this->table AS C ";
        $sql .= " LEFT JOIN users U ON (U.id=C.manager_id)";
        $sql .= " LEFT JOIN locations L ON (L.loc_id=C.location_id)";

        $sql .= " WHERE 1 ";
        $sql .= " AND C.manager_id =".$managerid;

            $sql .= " AND C.status = 1";

        $sql .= " ORDER BY C.created_date DESC LIMIT $offset,$limit";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getTaxslab(){

        $sql = "SELECT * FROM taxes T ";
        $sql .= " WHERE 1 ";
        $sql .= " AND T.tax_status = 1";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getPordersDetails($order_id)
    {
        $this->db->select('orders.*,orders.created_date as order_date,C.name as brand_name,tax.taxname,vendor.vendor_name as vendorname,C.id as brand_id,country.name as country_name,state.name as state_name,vendor.vendor_name,vendor.email,vendor.mobile_no,vendor.company,vendor.address,vendor.city,vendor.pincode,vendor.gst_no,group_concat(mo.discription) as description,group_concat(mo.discription) as discription,group_concat(mo.hsn) as hsn,group_concat(mo.quantity) as quantity,group_concat(mo.unit_price) as unit_price,mo.gross_total,group_concat(mo.total) as total,group_concat(mo.id) as mo_id');
        $this->db->from('orders as orders');
        $this->db->join('vendors as vendor','vendor.vendor_id = orders.party_name','LEFT');
        $this->db->join('company as C','C.id = orders.company_id','LEFT');
        $this->db->join('country','vendor.country = country.id','LEFT');
        $this->db->join('state','vendor.state = state.id','LEFT');
        $this->db->join('taxes as tax','tax.id = orders.tax_id');
        $this->db->join('multiple_order as mo','mo.order_id = orders.order_id','LEFT');
        $this->db->where('orders.order_id',$order_id);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;

        /*$sql = "SELECT *,O.created_date as order_date,
        C.name as brand_name,
        C.id as brand_id,
        V.vendor_name as vendorname,
        group_concat(mo.discription) as description,
        group_concat(mo.hsn) as hsn,
        group_concat(mo.quantity) as quantity,
        group_concat(mo.unit_price) as unit_price,
        group_concat(mo.total) as total,
        group_concat(mo.id) as mo_id,
        mo.gross_total as gross_total,
        T.taxname
    
        FROM $this->table AS O ";
        $sql .= " LEFT JOIN company C ON (C.id=O.company_id)";
        $sql .= " LEFT JOIN taxes T ON (T.id=O.tax_id)";
        $sql .= " LEFT JOIN vendors V ON (V.vendor_id=O.party_name)";
        $sql .= " LEFT JOIN multiple_order mo ON (O.order_id=mo.order_id)";

        $sql .= " WHERE 1 ";
        $sql .= " AND O.order_id =".$order_id;

        //$sql .= " AND O.status = 1";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;*/
    }
    public function getPordersdropdown($order_id){
        $this->db->select('orders.*,c.*');
        $this->db->from('orders as orders');
         $this->db->join('company as C','C.id = orders.company_id','LEFT');
        $this->db->where('orders.order_id',$order_id);
        $query = $this->db->get();

        $result = $query->row_array();
        return $result;
    }
    public function getVendordropdown($order_id){
        $this->db->select('orders.*,c.*');
        $this->db->from('orders as orders');
         $this->db->join('vendors as C','C.vendor_id  = orders.party_name','LEFT');
        $this->db->where('orders.order_id',$order_id);
        $query = $this->db->get();

        $result = $query->row_array();
        return $result;
    }

    public function update_gm_status($po_id,$data)
    {
        $this->db->where('order_id',$po_id);
        $this->db->update('orders',$data);
    }

    public function update_admin_status($po_id,$data)
    {
        $this->db->where('order_id',$po_id);
        $this->db->update('orders',$data);
    }

    public function countGetApprovedPO($searchArray = "")
    {
        // $sql = "SELECT COUNT(*) AS COUNT FROM $this->table AS O WHERE 1 ";

        // if (isset($searchArray["party_name"]) && $searchArray["party_name"] != "")
        //     $sql .= " AND O.party_name LIKE '%" . $searchArray['party_name'] . "%'  ";

        // if (isset($searchArray["order_status"]) && $searchArray["order_status"] >= 0)
        //     $sql .= " AND O.order_status = '" . $searchArray['order_status'] . "' ";

        // if (isset($searchArray["createdby_id"]) && $searchArray["createdby_id"] >= 0)
        //     $sql .= " AND O.createdby_id = '" . $searchArray['createdby_id'] . "' ";


        // $query = $this->db->query($sql);
        // $result = $query->result();

        // if (count($result) > 0)
        //     return $result[0]->COUNT;
        // else
        //     return 0;   
        $this->db->select('*');
        $this->db->from('orders');


        $this->db->where('order_status','approved');
        $query = $this->db->get();
        return $result = $query->num_rows();

    }

    public function getOrderVendorData($po_id)
    {
        $this->db->Select('orders.party_name,vendors.vendor_name,orders.paid_amount,orders.Amount');
        $this->db->from('orders');
        $this->db->join('vendors','vendors.vendor_id = orders.party_name');    
        $this->db->where('orders.order_id',$po_id);
        $query = $this->db->get();
        return $result = $query->row_array();
    }

    public function getGetApprovedPO($filters=array(), $startLimit='', $Limit='',$count='')
    {     
        $query  = "SELECT *,O.created_date as order_date,C.name as companyname,V.vendor_name as vendorname FROM orders As O " ;
        $query .= "LEFT JOIN company C ON C.id = O.company_id ";
        $query .= "LEFT JOIN vendors V ON V.vendor_id = O.party_name ";
        // $query .= "LEFT JOIN payment_transactions P ON P.order_id = O.order_id ";

        $query .= "WHERE O.order_status = 'approved' ";

        if(!empty($filters))
        {
            if($filters['search'] && $filters['search'] != '')
            {
                // $sql .= " AND (O.party_name LIKE '%".$filters['search']."%')";
                $query .= " AND (V.vendor_name LIKE '%".$filters['search']."%' OR C.name LIKE '%".$filters['search']."%')";
            }           
        }

        $query .= "ORDER By director_status_date DESC";

        if($Limit)
        {
            $query .= " LIMIT $startLimit, $Limit";
        }


        $sql = $this->db->query($query);

        if($count)
        {
            $result = $sql->num_rows();
        }
        else
        {
            $result = $sql->result();
        }

        return $result;
    }

    public function addtransaction($data)
    {
        $this->db->insert('payment_transactions',$data);

    }

    public function update_accountant_status($po_id,$data)
    {
        $this->db->where('order_id',$po_id);
        $this->db->update('orders',$data);
    }

    public function getPaymentHistory($po_id)
    {
        $this->db->select('*,vendors.vendor_name,users.fname,users.lname,users.usertype');
        $this->db->from('payment_transactions');
        $this->db->join('users','users.id = payment_transactions.payby_user_id');
        $this->db->join('vendors','vendors.vendor_id = payment_transactions.vendor_id');
        $this->db->where('payment_transactions.order_id',$po_id);
        $this->db->order_by('payment_transactions.transaction_date','DESC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getOrderHistory($po_id)
    {
        $this->db->select('*,users.fname,users.lname,users.usertype');
        $this->db->from('order_status_history');
        $this->db->join('users','users.id = order_status_history.changed_by_id');
        $this->db->where('order_status_history.order_id',$po_id);
        $this->db->order_by('order_status_history.Changed_date','DESC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getVendorList($parent_id)
    {
        // $res = $this->db->select('*')->from('vendors')->where('parent_id',$parent_id)->where('status','1')->order_by('vendor_name','ASC')->get()->result_array();
        $res = $this->db->select('*')->from('vendors')->where('status','1')->order_by('vendor_name','ASC')->get()->result_array();
        // echo $this->db->last_query();die;
        return $res;
    }

    public function getOutlets($parent_id)
    {
        $adminSession = $this->session->userdata('adminSession');

        // $res = $this->db->select('*')->from('company')->where('manager_id',$parent_id)->where('status','1')->order_by('name','ASC')->get()->result_array();
        
        $this->db->select('*');
        $this->db->from('company');
        if ($adminSession['usertype']!='area_manager')
        {
        $this->db->where('manager_id',$parent_id);
        }
        $this->db->where('status','1');
        $this->db->order_by('name','ASC');
        $res = $this->db->get()->result_array();
        return $res;
    }



}

?>