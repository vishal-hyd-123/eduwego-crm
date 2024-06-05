<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model
{

	public function login($mobile,$password) {
		$this->db->where("employee_mobile",$mobile);
		$this->db->where("emp_password",md5($password));
		$this->db->where("employee_status", '1');
		$query=$this->db->get('staff');
		
		if($query->num_rows()>0){
			$row=$query->row();
			$data = array(
				'institute_id'			=> $row->institute_id,
				'employee_id'			=> $row->employee_id,
				'name' 					=> $row->employee_name,
  		     	'mobile'                => $row->employee_mobile,
  		     	'address'               => $row->employee_address,
				'logged_in' 			=> TRUE,
				'is_staff_in'			=> TRUE,
				'is_institute_in'		=> FALSE,
				'is_student_in'			=> FALSE,
				'is_admin_in'			=> FALSE,
				'is_super_in'			=> FALSE
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


}//end controller

?>