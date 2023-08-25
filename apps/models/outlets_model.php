<?php 
 if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Outlets_model extends CI_Model {

    function __construct() {
        // Call the Model constructor		parent::__construct();
        $this->table = "company";
    }

   public function getData($user_id='',$filters=array(), $offset='', $limit='',$count='') 
   {
        // echo  "dsds".$user_id;die;    
        $sql = "SELECT *,C.id as company_id,C.status as company_status, U.fname, L.loc_name FROM $this->table AS C ";
        $sql .= " LEFT JOIN users U ON (U.id=C.manager_id)";
        $sql .= " LEFT JOIN locations L ON (L.loc_id=C.location_id)";

        $sql .= " WHERE 1 ";


        if($user_id)
        {
            $sql .=" AND C.manager_id = '$user_id'";
        }

        if(!empty($filters))
        {
            if($filters['search'] && $filters['search'] != '')
            {
                $sql .= " AND (C.name LIKE '%".$filters['search']."%'  OR C.city_name LIKE '%".$filters['search']."%' OR L.loc_name LIKE '%".$filters['search']."%' OR U.fname LIKE '%".$filters['search']."%' OR C.address LIKE '%".$filters['search']."%') ";
            }
        }    


        /*if (isset($searchArray["name"]) && $searchArray["name"] != "")
            $sql .= " AND C.name LIKE '%" . $searchArray['name'] . "%' ";

        if (isset($searchArray["status"]) && $searchArray["status"] >= 0)
            $sql .= " AND C.status = '" . $searchArray['status'] . "' ";

        if (isset($searchArray["manager_id"]) && $searchArray["manager_id"] >= 0)
            $sql .= " AND C.manager_id = '" . $searchArray['manager_id'] . "' ";*/
        
        if($count)
        {
            $query = $this->db->query($sql);
            $result = $query->num_rows();
        }
        else
        {
            if($limit)
            {
                $sql .= " ORDER BY C.created_date DESC LIMIT $offset,$limit";
            }
            $query = $this->db->query($sql);
            $result = $query->result();        
        }
        return $result;
    }

    public function countGetData($searchArray = "") {

        $sql = "SELECT COUNT(*) AS COUNT FROM $this->table AS C WHERE 1 ";

        if (isset($searchArray["name"]) && $searchArray["name"] != "")
            $sql .= " AND C.name LIKE '%" . $searchArray['name'] . "%'  ";

        if (isset($searchArray["status"]) && $searchArray["status"] >= 0)
            $sql .= " AND C.status = '" . $searchArray['status'] . "' ";

         if (isset($searchArray["manager_id"]) && $searchArray["manager_id"] >= 0)
            $sql .= " AND C.manager_id = '" . $searchArray['manager_id'] . "' ";

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

        // $sql .= " AND C.status = 1";

        $sql .= " ORDER BY C.created_date DESC LIMIT $offset,$limit";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getOutlets(){

        $sql = "SELECT * FROM $this->table AS C ";
        $sql .= " WHERE 1 ";       
        $sql .= " AND C.status = 1";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getAreaManagerOutlets($parent_id)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('manager_id',$parent_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    public function getOutletsDetails($id){

        $sql = "SELECT *,
        C.state_id as company_state_id,
        C.id as company_id,
        C.name as brand_name,
        U.fname as first_name,
        U.lname as last_name,
        S.name as state_name,
        C.status as category_status

        FROM $this->table AS C ";
        $sql .= " LEFT JOIN users U ON (U.id=C.manager_id)";
        $sql .= " LEFT JOIN locations L ON (L.loc_id=C.location_id)";
        $sql .= " LEFT JOIN state S ON (S.id=C.state_id)";

        $sql .= " WHERE 1 ";
        $sql .= " AND C.id =".$id;

        $sql .= " AND C.status = 1";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getAreaManagerCount()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usertype','area_manager');
        $this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getGeneralManagerCount()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usertype','general_manager');
        $this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getOperationalGeneralManagerCount()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usertype','operational_general_manager');
        // $this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getProjectGeneralManagerCount()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usertype','project_general_manager');
        // $this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getAccountantCount()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usertype','accountant');
        $this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getOutletCount($userType,$userid)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('status','1');
        // if($userType == 'area_manager')
        // {
            // $this->db->where('manager_id',$userid);    
        // }

        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    public function getPOCount($userType,$userid)
    {
        $this->db->select('*');
        $this->db->from('orders');
        
        if($userType == 'area_manager')
        {
            $this->db->where('createdby_id',$userid);    
        }

        $query = $this->db->get();
        return $result = $query->num_rows();
    }

    //to get total po amount to display on dashboard
    public function getTotalPOAmount()
    {
        $this->db->select('SUM(amount) AS total_amt');
        $this->db->from('orders');
        // $this->db->order_by('amount','DESC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getTotalPaidAmount()
    {
        $this->db->select('SUM(paid_amount) AS total_amt');
        $this->db->from('orders');
        // $this->db->order_by('amount','DESC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getVendorCount($userType,$userid)
    {
        $this->db->select('*');
        $this->db->from('vendors');
        
        if($userType == 'area_manager')
        {
            $this->db->where('parent_id',$userid);    
        }

        $query = $this->db->get();
        return $result = $query->num_rows();
    }


}

?>