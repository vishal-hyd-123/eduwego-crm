<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{   

	public function login($email,$password) {
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
                    'is_admin_in'          	=> FALSE,
                    'is_student_in'         => FALSE,
                    'is_institute_in'       => FALSE
                );
            $this->session->set_userdata($data);
            return true;
        } else {
            return array();
        }
    }

}//end modal

?>