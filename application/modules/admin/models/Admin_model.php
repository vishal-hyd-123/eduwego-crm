<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{     
    
    public function superLogin($email,$password) {
        $this->db->where("super_admin_email",$email);
        $this->db->where("super_admin_password",md5($password));
        $query=$this->db->get('super_admin');
        if($query->num_rows()>0){
            $row=$query->row();
                $data = array(                    
                    'logged_in'             => TRUE,
                    'super_admin_id'        => $row->super_admin_id,
                    'is_super_in'           => TRUE,
                    'is_staff_in'           => FALSE,
                    'is_admin_in'           => FALSE,
                    'is_student_in'         => FALSE,
                    'is_institute_in'       => FALSE
                );
            $this->session->set_userdata($data);
            return true;
        } else {
            return array();
        }
    }

    public function login($email,$password) {
        $this->db->where("email",$email);
        $this->db->where("password",$password);
        $query=$this->db->get('admin');
        if($query->num_rows()>0){
            $row=$query->row();
                $data = array(                    
                    'logged_in'             => TRUE,
                    'admin_id'              => $row->id,
                    'institute_id'          => $row->institute_id,
                    'name'                  => $row->name,
                    'is_admin_in'           => TRUE,
                    'is_super_in'           => FALSE,
                    'is_staff_in'           => FALSE,
                    'is_student_in'         => FALSE,
                    'is_institute_in'       => FALSE
                );
            $this->session->set_userdata($data);
            return true;
        }else {
            return array();
        }
    }

    public function get_all_announcment(){
        $institute_id = $_SESSION['institute_id'];
        $where = array('announcment_status' => 1);
        $this->db->where($where);
        $this->db->order_by("announcment_title", "ASC");
        $data = $this->db->get(TBL_ANNOUNCEMENT);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function changePasswordSuper($id,$old_password){
        $this->db->where("super_admin_id",$id);        
        $this->db->where("super_admin_password",md5($old_password));        
        $query=$this->db->get('super_admin');
        if($query->num_rows()>0){
            return true;            
        }else{
            return false;
        }
    }

    public function changePasswordAdmin($id,$old_password) {
        $this->db->where("id",$id);        
        $this->db->where("password",md5($old_password));        
        $query=$this->db->get('admin');
        if($query->num_rows()>0){
            return true;            
        } else {
            return false;
        }
    }

    public function insertData($table,$data){
        $insert=$this->db->insert($table,$data);
        if ($insert) {
            return true;
        }else{
            return array();
        }
    }

    public function updateData($tbl,$where,$data)
    {
        $this->db->where($where);
        if($this->db->update($tbl,$data))
        {
            return true;
        } else{
            return false;
        }
    }

    public function updateAllData($table, $where=array(), $data=array()){
        $this->db->where($where);
        $this->db->update($table,$data);
        if($this->db->affected_rows()>0) {
            return true;
        } else {
            return array();
        }
    }
    public function updateSingleData($table, $where=array(), $data="", $value=""){
        $this->db->where($where);
        $this->db->set($data,$value,FALSE);
        $this->db->update($table);
        if($this->db->affected_rows()>0) {
            return true;
        } else {
            return array();
        }
    }


    public function deleteData($table, $row_name, $row_id){
        $this->db->where($row_name, $row_id);
        $this->db->delete($table);
        if($this->db->affected_rows()>0) {
            return true;
        } else {
            return array();
        }
    }

    public function getAllData($table, $id, $data, $orderBy=""){
        $this->db->where($id, $data);
        $this->db->order_by($orderBy, "ASC");
        $data = $this->db->get($table);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function getAllDataGroupBy($table, $id, $data, $orderBy="",$group_by){
        $this->db->where($id, $data);
        $this->db->order_by($orderBy, "ASC");
        $this->db->group_by($group_by);
        $data = $this->db->get($table);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function getAllDataString($table, $query1=""){
        $query = $this->db->query("$query1");
        // $data = $this->db->get($table);
        // echo $query1;die;
        // echo $this->db->last_query();die;
        if($query->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function getAllDataArray($table,$data, $orderBy=""){
        $this->db->where($data);
        $this->db->order_by($orderBy, "ASC");
        $data = $this->db->get($table);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function getAllActiveInstitute(){
        $where = array(
            'institute_status'      => 1
        );
        $insert=$this->getAllDataArray(TBL_INSTITUTE, $where, 'institute_name');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }

    public function fecthStudentsList($srch_by,$srch_number)
    {
        $this->db->select('student_id');
        $this->db->select('full_name');
        $this->db->like($srch_by,$srch_number);
        $q = $this->db->get('students');
        return $q->result();
    }

    public function getStudentById($stu_id)
    {
       $this->db->where('student_id',$stu_id);
       $q = $this->db->get('students');
       return $q->result_array(); 
    }

    public function insert_admin($data)
    {
        $q = $this->db->insert('admin',$data);
        if($q == true)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function update_admin($admin_id,$data)
    {
        $this->db->where('id',$admin_id);
        $q = $this->db->update('admin',$data);
        if($q == true)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function fetchAdmins()
    {
        $this->db->where('status','1');
        $q = $this->db->get('admin');
        return $q->result();
    }

    public function getPaymentData($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->get('fees');
        return $q->result_array();
    }

    public function upload_image($path, $image_name, $input_name){
        $config['upload_path'] = 'uploads/'.$path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        // echo '<pre>'; print_r($config['file_name']); echo '</pre>';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload($input_name)) {
            return true ;
        } else {
            return array();
        }
    }

    public function checkAdminAvail($email)
    {
        $this->db->where('email',$email);
        $q = $this->db->get('admin');
        if($q->num_rows() > 0)
        {
            return false;
        }
        else{
            return true;
        }
    }

    public function getAdminById($admin_id)
    {
        $this->db->where('id',$admin_id);
        $q = $this->db->get('admin');
        return $q->result();
    }

    public function deleteAdmin($admin_id)
    {
        $this->db->where('id',$admin_id);
        $q = $this->db->delete('admin');
        if($q == true)
        {
            return true;
        }
        else{
            return false;
        }
        
    }

    public function updatePackage($student_id,$package)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('students',array('package'=>$package));
        if($q == true)
        {
            $this->db->where('student_id',$student_id);
            $update = $this->db->update('fees',array('package'=>$package));
            if($update == true)
            {
                return true;
            }
        }

    }

    public function updateYearlyFees($yr_id,$student_id,$data)
    {
        $this->db->where('yr_id',$yr_id);
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('fees',$data);
        if($q == true)
        {
            return true;
        }
    }

    public function get($tbl,$single=false,$order_by="")
    {
        if($order_by != "")
        {
           $this->db->order_by($orderBy, "DESC");
        } else{
            $this->db->order_by($orderBy, "ASC");
        }
        
        $data = $this->db->get($tbl);
        if($single == false)
        {
            return $data->result();
        } else if($single == true){
            return $data->row();
        }
        
    }

    public function getById($tbl,$where)
    {
        $this->db->where($where);
        $result = $this->db->get($tbl);
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
    }

    public function get_all($table,$single=false,$orderBy=""){
        if($orderBy != "")
        {
            $this->db->order_by($orderBy, "DESC");
        }
        
        $data = $this->db->get($table);
        if($data->num_rows()>0) {
            if($single == false)
            {
                return $data->result();
            } else{
                return $data->row();
            }
            
        } 
    }


}//end controller

?>