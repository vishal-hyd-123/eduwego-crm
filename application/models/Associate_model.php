<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Associate_model extends CI_Model
{

	public function login($email,$password) {
        $this->db->where("agent_email",$email);
        $this->db->where("password",md5($password));
        $this->db->where("agent_status", '1');
        $query=$this->db->get('agents');
        if($query->num_rows()>0){
            $row=$query->row();
            $data = array(
                'agent_id'              => $row->agent_id,
                'name'                  => $row->agent_name,
                'agent_email'           => $row->agent_email,
                'mobile'                => $row->agent_mobile,
                'location'              => $row->agent_location,
                'address'               => $row->agent_address,
                'photo'                 => $row->agent_photo,
                'logged_in'             => TRUE,
                'is_agent_in'           => TRUE,
                'is_institute_in'       => FALSE,
                'is_student_in'         => FALSE,
                'is_admin_in'           => FALSE,
                'is_super_in'           => FALSE,
                'is_staff_in'           => FALSE
                );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    public function getAllDataArray($table,$where,$order_by="")
    {
        $this->db->where($where);
        if($order_by != "")
        {
            $this->db->order_by($order_by,'desc');
        }
        $query = $this->db->get($table);
        return $query->result();
    }



    public function getAllData($table,$where)

    {

    	$this->db->where($where);

    	$query = $this->db->get($table);

    	return $query->result();

    }



    public function getAllPayments($table,$where)

    {

        $this->db->where($where);

        $this->db->order_by('payment_id','DESC');

        $query = $this->db->get($table);

        return $query->result(); 

    }



    public function updateAllData($table, $where=array(), $data=array()){

        $this->db->where($where);

        $this->db->update($table,$data);

        if($this->db->affected_rows()>0){

            return true;

        }else {

            return array();

        }

    }



    public function checkEmail($table,$data, $orderBy=""){

        $this->db->where($data);

        $this->db->order_by($orderBy, "ASC");

        $data = $this->db->get($table);

        if($data->num_rows()>0) {

            return $data->result();

        } else {

            return array();

        }

    }



    public function get_all_courses(){
        $institute_id = $_SESSION['institute_id'];
        $where = array(
                        'course_status' => 1,
                        'institute_id' => $institute_id
                         );
        $this->db->where($where);
        $this->db->order_by("course_name", "ASC");
        $data = $this->db->get(TBL_COURSES);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function getAllActiveStreams(){
        $where = array(
            'stream_status'     => 1,
            'institute_id'      => $_SESSION['institute_id']
        );
        $insert=$this->getAllDataArray(TBL_STREAM,$where, 'stream_name');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }

    public function getAllActiveInstitute()

    {

        $this->db->select('institute_id');

        $this->db->select('institute_name');

        $this->db->where('institute_status','1');

        $query = $this->db->get('institute');

        return $query->result();

    }



    public function checkMobile($institute_id,$mobile)

    {

        $this->db->where(array('institute_id'=>$institute_id,'mobile'=>$mobile));

        $q = $this->db->get('students');

        if($q->num_rows() > 0)

        {

            return false;

        }

        else{

            return true;

        }

    }



    public function checkAssocMobile($table,$where)

    {

        $this->db->where($where);

        $q = $this->db->get($table);

        if($q->num_rows() > 0)

        {

            return true;

        }

        

    }



    public function insertStudentData($table,$data){
        $q = $this->db->insert($table,$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }



    public function upload_image($path, $image_name, $input_name){

        $config['upload_path'] = 'uploads/'.$path;

        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $config['file_name'] = $image_name;

        // echo '<pre>'; print_r($config['file_name']); echo '</pre>';

        $this->load->library('upload');

        $this->upload->initialize($config);

        if ($this->upload->do_upload($input_name)){

            return true ;

        }else {

            return array();

        }

    }



    public function fetchInstituteData($institute_id)

    {

        $this->db->where("institute_id",$institute_id);

        $q = $this->db->get('institute');

        return $q->result();

    }



    public function getSubInstitute($sub_institute_id)

    {

        $this->db->where('sub_inst_id',$sub_institute_id);

        $data = $this->db->get('sub_institutes');

        if($data->num_rows()>0)

        {

            return $data->result();

        }

        else{

            return false;

        }

    }



    public function getTutionFees($student_id)

    {

        $this->db->where('student_id',$student_id);

        $this->db->select('yearly_fee');

        $q = $this->db->get('fees');

        if($q->num_rows() > 0)

        {

            return $q->result();

        }

    }



    public function changePasswordAgent($inst_id,$agent_id,$old_password){

        $this->db->where("institute_id",$inst_id);

        $this->db->where("agent_id",$agent_id);         

        $this->db->where("password",md5($old_password));        

        $query=$this->db->get('agents');

        if($query->num_rows()>0){

            return true;            

        } else {

            return false;

        }

    }



    public function getStudentsNumbers($table,$where1)

    {

        $this->db->where($where1);

        $q = $this->db->get($table);

        if($q->num_rows() > 0)

        {

            return $q->num_rows();

        }

    }



    public function getSubAssociates($table,$where2)

    {

        $this->db->where($where2);

        $q = $this->db->get($table);

        if($q->num_rows() > 0)

        {

            return $q->num_rows();

        }

    }



    public function receivedAmountByAgent($agent_id)

    {

        $this->db->where('paid_to_id',$agent_id);

        $this->db->select('amount');

        $q = $this->db->get('payments');

        if($q->num_rows() > 0)

        {

            return $q->result();

        }

    }



    public function getNumberStudents($course_id,$institute_id,$agent_id="")

    {

        $this->db->where('institute_id',$institute_id);

        $this->db->where('course_id',$course_id);

        $this->db->where('agent_name',$agent_id);

        $q = $this->db->get('students');

        return $q->num_rows();

    }

    public function delete($tbl,$where)
    {
        $this->db->where($where);
        if($this->db->delete($tbl))
        {
            return true;
        } else{
            return false;
        }
    }

    public function insertData($table,$data)
    {
        $q = $this->db->insert($table,$data);   
        if($q == true)
        {
            return true;
        }
        else{
           return false; 
        }
        
    }

}//end controller



?>