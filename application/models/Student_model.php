<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Student_model extends CI_Model

{

	public function login($mobile,$password) {

		$this->db->where("mobile",$mobile);

		$this->db->where("password",md5($password));

		$this->db->where("student_status", '1');

		$query=$this->db->get('students');

		

		if($query->num_rows()>0){

			$row=$query->row();
            $institute_id = $row->institute_id;
            $institute = $this->db->query("SELECT institute_logo,institute_name FROM institute WHERE institute_id = '".$institute_id."' ")->row();
			$data = array(

				'institute_id'			=> $row->institute_id,

                'institute_logo'        => $institute->institute_logo,
                'institute_name'        => $institute->institute_name,
				'student_id'			=> $row->student_id,

				'name' 					=> $row->full_name,

				'email'  				=> $row->email,

  		  'mobile'                => $row->mobile,

  		  'father'                => $row->s_w_d_of,

  		  'mother'                => $row->mother_name,

  		  'occupation'            => $row->occupation,

  		  'dob'                	=> $row->dob,

  		  'gender'                => $row->gender,

  		  'photo'               	=> $row->student_photo,

  		  'address'               => $row->address,

  		  'city'               	=> $row->city,

				'logged_in' 			=> TRUE,

				'is_student_in'		=> TRUE,

        'is_institute_in'   => FALSE,

        'is_admin_in'   => FALSE,

        'is_staff_in'   => FALSE,

        'is_super_in'   => FALSE

			);

			$this->session->set_userdata($data);

			return true;

		} else {

			return false;

		}

    }



    public function getAllDataArray($where,$table)

    {

    	$this->db->where($where);

    	$query = $this->db->get($table);

    	return $query->result();

    }



    public function getAllNotices($where,$table,$order)

    {

    	$this->db->where($where);

    	$this->db->order_by('announcment_id',$order);

    	$query = $this->db->get($table);

    	return $query->result();

    }



    public function insertStudentMessage($data)

    {

      $q = $this->db->insert('inbox',$data);

      if($q == true)

      {

        return true;

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

     public function updateAllData($table, $where=array(), $data=array()){

        $this->db->where($where);

        $this->db->update($table,$data);

        if($this->db->affected_rows()>0) {

            return true;

        } else {

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



    public function changePassword($inst_id,$student_id,$old_password){

        $this->db->where("institute_id",$inst_id);

        $this->db->where("student_id",$student_id);         

        $this->db->where("password",md5($old_password));        

        $query=$this->db->get('students');

        if($query->num_rows()>0){

            return true;            

        }else {

            return false;

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