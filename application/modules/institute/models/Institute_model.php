<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_model extends CI_Model{ 	

	public function login($email,$password) {
        $date = date("Y-m-d");
		$this->db->where("institute_email",$email);
        $this->db->where("institute_expiry_date>",$date);
		$this->db->where("institute_password",md5($password));
		$this->db->where("institute_status", '1');
		$query=$this->db->get(TBL_INSTITUTE);
		if($query->num_rows()>0){
			$row=$query->row();
			$this->db->where('admin_id',$row->institute_id);
            $login_time = date('H:i:s');
			$data = array(
				'institute_id'          => $row->institute_id,
                'name'                  => $row->institute_name,
                'admin'                 => $row->admin_name,
                'email'                 => $row->institute_email,
                'mobile'                => $row->institute_mobile,
                'landline'              => $row->landline_no,
                'state'                 => $row->state,
                'city'                  => $row->city,
                'institute_address'     => $row->institute_address,
                'payment_link'          => $row->payment_api_key,
                'admission_link'        => base_url().'online-admission/'.$row->subdomain,
                'enquiry_link'          => base_url().'student-enquiry/'.$row->subdomain,
                'admission_fee'         => $row->admission_fee,
                'facebook_link'         => $row->facebook_link,
                'youtube_link'          => $row->youtube_link,
                'google_business_link'  => $row->google_business_link,
                'brochure_link'         => $row->brochure_link,
                'refund_link'           => $row->refund_link,
                'twitter_link'          => $row->twitter_link,
                'instagram_link'        => $row->instagram_link,
                'institute_logo'        => $row->institute_logo,
                'institute_sig'         => $row->institute_sig,
                'institute_expiry_date' => $row->institute_expiry_date,
                'msg_api_username'      => $row->msg_api_username,
                'msg_api_password'      => $row->msg_api_password,
                'my_ivr_link'           => $row->my_ivr_link,
                'institute_allowed_student' => $row->institute_allowed_student,
                'leads_allowed'         => $row->leads_allowed,
                'login_time'            => $login_time,
                'logged_in'             => TRUE,
                'is_institute_in'       => TRUE,
                'is_staff_in'           => FALSE,
				);
			$this->session->set_userdata($data);
			return true;
		} else {
			return false;
		}
    }

    public function staff_login($email,$password) {
        $this->db->where("employee_email",$email);
        $this->db->where("emp_password",md5($password));
        $query=$this->db->get('staff');
        
        if($query->num_rows()>0){
            $row=$query->row();
            $institute_id = $row->institute_id;
            $institute = $this->db->query("SELECT institute_logo FROM institute WHERE institute_id = '".$institute_id."' ")->row();
            $data = array(
                'institute_id'          => $institute_id,
                'emp_email'             => $row->employee_email,
                'emp_code'              => $row->emp_code,
                'employee_id'           => $row->employee_id,
                'emp_name'              => $row->employee_name,
                'emp_mobile'            => $row->employee_mobile,
                'date_of_joining'       => $row->date_of_joining,
                'emp_designation'       => $row->employee_designation,
                'emp_department'        => $row->department,
                'institute_logo'        => $institute->institute_logo,
                'emp_photo'             => $row->emp_photo,
                'emp_address'           => $row->employee_address,
                'logged_in'             => TRUE,
                'is_staff_in'           => TRUE,
                'is_institute_in'       => FALSE
                );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
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
    
        public function ivrInboundCallDetails()
    {
        $where = array(
                        'status' => 1
                         );

        $data=$this->getAllDataArray('ivr_cdr', $where, 'id');
        if ($data) {
            return $data;
        }else{
            return array();
        }
    }

    public function insertStudentData($table,$data,$fees){
        $this->db->insert($table,$data);   
        $insert_id = $this->db->insert_id();
        $institute_name = $_SESSION['name'];
        $institute_id = $_SESSION['institute_id'];
        if($insert_id != "")
        {
            $code = "";
            for($i=0;$i<3;$i++)
            {
              $code .= $institute_name[$i];
            }
            $name_code = strtoupper($code);
            $yoa = $data['yoa'];
            $student_code = $name_code."".$yoa."000".$insert_id;
            $code_data = array('student_code'=>$student_code);
            $this->db->where(array('institute_id' => $institute_id,'student_id'=>$insert_id));
            $this->db->update('students',$code_data);
            
            for($i=1;$i<=$data['course_dur'];$i++)
            {
                
                $fee_rows_insert = array(
                    'student_name' =>$data['full_name'],
                    'package' => $data['package'],
                    'student_id' => $insert_id,
                    'yr_id' => $i,
                    'course_dur' => $data['course_dur'],
                    'institute_id' => $data['institute_id'],
                    'course_id' => $data['course_id'],
                    'yearly_fee' => $fees[$i]['fees'],
                    'year'=>$fees[$i]['year'],
                    'year_end'=>$fees[$i]['year']+1,
                    'agent_id' => $data['agent_name'],
                    'due' => $fees[$i]['fees']
                );
                
                $this->db->insert('fees',$fee_rows_insert); 
            }
            return true;
           
        }
        
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

    public function checkAgentMobile($institute_id,$mobile)
    {
        $this->db->where(array('institute_id'=>$institute_id,'agent_mobile'=>$mobile));
        $q = $this->db->get('agents');
        if($q->num_rows() > 0)
        {
            return false;
        }
        else{
            return true;
        }
    }

    public function checkMobileOfStaff($institute_id,$mobile)
    {
       $this->db->where(array('institute_id'=>$institute_id,'employee_mobile'=>$mobile));
        $q = $this->db->get('staff');
        if($q->num_rows() > 0)
        {
            return false;
        }
        else{
            return true;
        } 
    }

    public function getStudentById($stu_id)
    {
       $this->db->where('student_id',$stu_id);
       $q = $this->db->get('students');
       return $q->result_array(); 
    }

    public function yearlyPaymentHistory($student_id,$yr_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('yr_id',$yr_id);
        $q = $this->db->get('payment_history');
        return $q->result();
    }

    public function getPaymentData($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->get('fees');
        return $q->result();
    }
    public function getPaymentHistory($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->get('payment_history');
        return $q->result();
    }

    public function insert_payment_data($student_id,$yr_id,$payment_data,$insert_history)
    {

        $this->db->where('student_id',$student_id);
        $this->db->where('yr_id',$yr_id);
        $q = $this->db->update('fees',$payment_data);
        if($q == true)
        {
            if($this->db->insert('payment_history',$insert_history))
            {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function addPackageDetails($student_id,$student_name,$package_data,$fees)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('students',$package_data);
        if($q == true)
        {
            for($i=1;$i<=$package_data['course_dur'];$i++)
            {
                
                $fee_rows_insert = array(
                    'student_name'=>$student_name,
                    'package' => $package_data['package'],
                    'student_id' => $student_id,
                    'yr_id' => $i,
                    'course_dur' => $package_data['course_dur'],
                    'yearly_fee' => $fees[$i]
                );
                $this->db->insert('fees',$fee_rows_insert); 
            }
           
            return true;
        }
        else{
            return false;
        }
    }

    public function particularPaymentHistory($payment_id)
    {
        $this->db->where('payment_id',$payment_id);
        $q = $this->db->get('payment_history');
        return $q->result(); 
    }

    public function fetchFeesData($student_id,$yr_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('yr_id',$yr_id);
        $q = $this->db->get('fees');
        return $q->result();
    }

    public function fetchInstituteData($institute_id)
    {
        $this->db->where("institute_id",$institute_id);
        $q = $this->db->get('institute');
        return $q->result();
    }

    public function changePasswordinst($id,$old_password){
        $this->db->where("institute_id",$id);        
        $this->db->where("institute_password",md5($old_password));        
        $query=$this->db->get('institute');
        if($query->num_rows()>0){
            return true;            
        } else {
            return false;
        }
    }

    public function changePasswordstaff($inst_id,$staff_id,$old_password){
        $this->db->where("institute_id",$inst_id);
        $this->db->where("employee_id",$staff_id);         
        $this->db->where("emp_password",md5($old_password));        
        $query=$this->db->get('staff');
        if($query->num_rows()>0){
            return true;            
        } else {
            return false;
        }
    }

    public function changePasswordAgent($inst_id,$agent_id,$old_password){
        $this->db->where("institute_id",$inst_id);
        $this->db->where("agent_id",$agent_id);         
        $this->db->where("password",md5($old_password));        
        $query=$this->db->get('staff');
        if($query->num_rows()>0){
            return true;            
        } else {
            return false;
        }
    }

    public function deleteData($table, $row_name, $row_id){
		$this->db->where($row_name, $row_id);
		$this->db->delete($table);
		if($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    public function deleteStudent($student_id)
    {
        $this->db->where('student_id',$student_id);
        if($this->db->delete('students'))
        {
            $this->db->where('student_id',$student_id);
            $this->db->delete('fees');
            return true;
        } else{
            return false;
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

    public function getStudentData($student_id)
    {
        $this->db->where('student_id',$student_id);
        $data = $this->db->get('students');
        if($data->num_rows()>0)
        {
            return $data->result();
        }
        else{
            return false;
        }
        
    }

    public function fetchStudentData($student_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->select('full_name');
        $this->db->select('course');
        $this->db->select('stream');
        $this->db->select('course_dur');
        $this->db->select('package');
        $this->db->select('address');
        $this->db->select('sub_institute_id');
        $data = $this->db->get('students');
        if($data->num_rows()>0)
        {
            return $data->result();
        }
        else{
            return false;
        }
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

    public function getAllDataArray($table,$data, $orderBy=""){
		$this->db->where($data);
		$this->db->order_by($orderBy, "ASC");
		$data = $this->db->get($table);
		if($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
    }

    public function getInboxMessages($institute_id){
        $this->db->where('institute_id',$institute_id);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('inbox');
        if($data->num_rows()>0){
            return $data->result();
        }else {
            return array();
        }
    }

    public function getUnseenMessages($institute_id)
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->where('seen_status','0');
        $data = $this->db->get('inbox');
        if($data->num_rows()>0) {
            return $data->result();
        } 
    }

    public function getAllDataString($table, $query1=""){
        $query = $this->db->query("$query1");
        // $data = $this->db->get($table);
        // echo $query1;
        // echo $this->db->last_query();die;
        if($query->num_rows()>0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getAllActiveEnq(){
        $where = array(
            'institute_id'  => $_SESSION['institute_id']
        );
        $this->db->where($where);
        $this->db->order_by('id','desc');
        $q = $this->db->get('leads');
        if($q) {
            return $q->result();
        }
    }

    public function getRecentEnq()
    {
        $where = array(
            'institute_id'  => $_SESSION['institute_id']
        );
        $this->db->where($where);
        $this->db->from('leads');
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSubInstitutes(){
        $where = array(
                        'sub_institute_status'        => 1,
                        'main_institute_id'  => $_SESSION['institute_id']
                         );
        $result=$this->getAllDataArray('sub_institutes', $where, 'sub_inst_id');
        if ($result) {
            return $result;
        }else{
            return array();
        }
    }

    public function getAllOnlineEnq(){
        $where = array(
                        'online_enquiry_status'        => 1,
                        'institute_id'  => $_SESSION['institute_id']
                         );
        $insert=$this->getAllDataArray(TBL_ONLINE_ENQUIRY, $where, 'name');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }


    public function get_all_years(){
        $institute_id = $_SESSION['institute_id'];
        $where = array(
                        'student_status' => 1,
                        'institute_id' => $institute_id,
                        'yoa!=' => NULL
                         );
        $this->db->where($where);
        $this->db->order_by("yoa", "ASC");
        $this->db->group_by("yoa");
        $data = $this->db->get(TBL_STUDENT);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }


    public function get_all_streams(){
        $institute_id = $_SESSION['institute_id'];
        $where = array(
                        'stream_status' => 1,
                        'institute_id' => $institute_id
                         );
        $this->db->where($where);
        $this->db->order_by("stream_name", "ASC");
        $data = $this->db->get(TBL_STREAM);
        if($data->num_rows()>0) {
            return $data->result();
        } else {
            return array();
        }
    }


    public function get_all_announcment(){
        $institute_id = $_SESSION['institute_id'];
        $where = array(
                        'announcment_status' => 1,
                        'announcment_institute_id' => $institute_id,
                        'created_by' =>"institute"
                         );
        $this->db->where($where);
        $this->db->order_by("announcment_title", "ASC");
        $data = $this->db->get(TBL_ANNOUNCEMENT);
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

    public function getAllStudent()
    {
        $this->db->where('student_status','1');
        $this->db->where('institute_id',$_SESSION['institute_id']);
        $this->db->where('student_code !=',null);
        $insert=$this->getDataByDesc(TBL_STUDENT, $where,'student_id');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }

    public function getAllActiveStudent(){
        $curr_yr = date('Y');
        $this->db->where('student_status','1');
        $this->db->where('institute_id',$_SESSION['institute_id']);
        $this->db->where('student_code !=',null);
        $this->db->where('yoa',$curr_yr);
        $insert=$this->getDataByDesc(TBL_STUDENT, $where,'student_id');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }

    public function getAllActiveCourses(){
        $where = array(
                        'course_status'     => 1,
                        'institute_id'      => $_SESSION['institute_id']
                         );
        $insert=$this->getAllDataArray(TBL_COURSES, $where, 'course_name');
        if ($insert) {
            return $insert;
        }else{
            return array();
        }
    }


    public function getAllActiveAgents(){
        $institute_id = $_SESSION['institute_id'];
        $this->db->select('agents.*');
        $this->db->from('agents_institutes');
        $this->db->join('agents','agents_institutes.agent_id = agents.agent_id');
        $this->db->where('agents_institutes.institute_id',$institute_id);
        $result = $this->db->get()->result();
        if ($result) {
            return $result;
        }else{
            return array();
        }
    }


    public function getAllActiveStaff(){
    	$where = array(
    					'employee_status!='	=> 9,
    					'institute_id'		=> $_SESSION['institute_id']
    					 );
	 	$insert=$this->getAllDataArray(TBL_STAFF,$where, 'employee_name');
     	if ($insert) {
     		return $insert;
     	}else{
     		return array();
     	}
    }


    public function getAllActiveStreams(){
    	$where = array(
    					'stream_status'		=> 1,
    					'institute_id'		=> $_SESSION['institute_id']
    					 );
	 	$insert=$this->getAllDataArray(TBL_STREAM,$where, 'stream_name');
     	if ($insert) {
     		return $insert;
     	}else{
     		return array();
     	}
    }


    public function getAllActiveVendors(){
    	$where = array(
    					'vendor_status'		=> 1,
    					'institute_id'		=> $_SESSION['institute_id']
    					 );
	 	$insert=$this->getAllDataArray(TBL_VENDOR,$where, 'vendor_name');
     	if ($insert) {
     		return $insert;
     	}else{
     		return false;
     	}
    }



    public function getAllActiveSubAgents(){
    	$where = array(
    					'sub_agent_status'		=> 1,
    					'institute_id'		=> $_SESSION['institute_id']
    					 );
	 	$insert=$this->getAllDataArray(TBL_SUB_AGENTS,$where, 'sub_agent_name');
     	if ($insert) {
     		return $insert;
     	}else{
     		return array();
     	}
    }



    public function get_agent_by_id($agent_id){
        $where = array(
                        'agent_id'      => $agent_id,
                        'agent_status' => "1"
                        );
        $insert=$this->getAllDataArray(TBL_AGENTS,$where);
        if ($insert) {
            return $insert;
        }else{
            return false;
        }
    }

    public function updateAllData($table, $where=array(), $data=array()){
		$this->db->where($where);
		$this->db->update($table,$data);
		if($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

    public function editStudentData($student_id,$data){
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('students',$data);
        if($q == true)
        {
            $this->db->where('student_id',$student_id);
            $fees_table = array(
                'student_name'=>$data['full_name'],
                'course_id'=>$data['course_id']
            );
            $query = $this->db->update('fees',$fees_table);
            if($query == true)
            {
                return true;
            }
            else{
                return false;
            }
        }
        
    }

    public function updateSingleData($table, $where=array(), $data="", $value=""){
		$this->db->where($where);
		$this->db->set($data,$value,FALSE);
		$this->db->update($table);
		if($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

    public function getExpectedAmount($course_id,$institute_id,$year)
    {
        $this->db->select("yearly_fee");
        $this->db->where('institute_id',$institute_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('year',$year);
        $q = $this->db->get('fees');
        return $q->result();
    }

    public function getPaidAmount($course_id,$institute_id,$year)
    {
        $this->db->select("total_fee");
        $this->db->where('institute_id',$institute_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('year',$year);
        $q = $this->db->get('payment_history');
        return $q->result();
    }

    public function getNumberStudents($course_id,$institute_id,$agent_id="")
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('agent_name',$agent_id);
        $q = $this->db->get('students');
        return $q->num_rows();
    }

    public function getStudentsNumber($course_id,$institute_id,$yoa)
    {
        $this->db->where(array('institute_id'=>$institute_id,'course_id'=>$course_id,'student_status'=>'1','yoa'=>$yoa));
        $q = $this->db->get('students');
        return $q->num_rows();
    }

    public function get_year_wise_amount($institute_id,$year)
    {
        $this->db->select("paid_amount");
        $this->db->select("date");
        $this->db->where('institute_id',$institute_id);
        $q = $this->db->get('payment_history');
        $result = $q->result();
        return $result;
       
    }

    public function DateWiseAmount($date,$institute)
    {
        $this->db->where('institute_id',$institute);
        $this->db->like('date', $date);
        $q = $this->db->get('payment_history');
        return $q->result();
    }

    // public function DateWiseAmount($fromDate,$toDate,$institute)
    // {
    //     if($fromDate != "" && $toDate != "")
    //     {
    //         $this->db->where('institute_id',$institute);
    //         $this->db->where('date >=', $fromDate);
    //         $this->db->where('date <=', $toDate);
    //         $this->db->select('paid_amount');
    //         $this->db->select('date');
    //         $q = $this->db->get('payment_history');
    //         return $q->result();

    //     }
    //     else if($fromDate != "" || $toDate != ""){
    //         $date = ($fromDate != "") ? $fromDate : $toDate;
    //         $this->db->where('institute_id',$institute);
    //         $this->db->where('date',$date);
    //         $this->db->select('paid_amount');
    //         $this->db->select('date');
    //         $q = $this->db->get('payment_history');
    //         return $q->result();
    //     }
    // }

    public function getAllStudents($institute_id)
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->select('full_name');
        $this->db->select('student_id');
        $q = $this->db->get('students');
        return $q->result();
    }

    public function getStudentPaidAmount($student_id,$institute_id)
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->where('student_id',$student_id);
        $this->db->select('paid_amount');
        $q = $this->db->get('fees');
        return $q->result();
    }

    // public function getStreamName($student_id,$institute_id);
    // {
    //     $this->db->where('institute_id',$institute_id);
    //     $this->db->where('student_id',$student_id);
    //     $this->db->select('stream');
    //     $q = $this->db->get('students');
    //     return $q->result();
    // }

    public function getExpenditureReport($institute_id)
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->select('amount');
        $this->db->select('created_at');
        $q = $this->db->get('payments');
        return $q->result();
    }

    public function getStudentNumber($sub_inst_id,$institute_id)
    {
        $this->db->where('institute_id',$institute_id);
        $this->db->where('sub_institute_id',$sub_inst_id);
        $this->db->where('student_status','1');
        $q = $this->db->get('students');
        return $q->num_rows();
    }

    public function fecthStudentsList($institute_id,$srch_by,$srch_number)
    {
        $this->db->select('student_id');
        $this->db->select('full_name');
        $this->db->where('institute_id',$institute_id);
        if($srch_by == "mobile")
        {
            $this->db->like('mobile',$srch_number);
        } else if($srch_by == "reg"){
            $this->db->like('student_code',$srch_number);
        }
        $q = $this->db->get('students');
        return $q->result();
    }

    public function deleteInstitute($main_institute_id,$sub_inst_id)
    {
        $this->db->where('sub_inst_id',$sub_inst_id);
        $this->db->where('main_institute_id',$main_institute_id);
        $q = $this->db->update('sub_institutes',array('sub_institute_status'=>'0'));
        if($q == true)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function insertLeads($data)
    {
        $this->db->insert('leads',$data);
        return true;
    }

    public function getAllLeads($institute_id,$leads)
    {
        $this->db->where(array('institute_id'=>$institute_id));
        $this->db->limit($leads);
        $this->db->order_by('id','DESC');
        $q = $this->db->get('leads');
        return $q->result();
    }
    
     public function getAllImportLeads($institute_id)
    {
        $this->db->where(array('institute_id'=>$institute_id));
        $this->db->order_by('id','DESC');
        $q = $this->db->get('import_leads');
        return $q->result();
    }

    public function updateContactStatus($lead_id)
    {
        $this->db->where('id',$lead_id);
        $q = $this->db->update('leads',array('contact_status'=>'1'));
        if($q == true)
        {
            return true;
        }
        
    }

    public function check_student($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->get('documents');
        if($q->num_rows() > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function saveDocuments($insert_data)
    {
        $q = $this->db->insert('documents',$insert_data);
        if($q == true)
        {
            return true;
        }
    }

    public function updateDocuments($student_id,$insert_data)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('documents',$insert_data);
        if($q == true)
        {
            return true;
        }
    }

    public function getDocumentsDetails($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->get('documents');
        if($q->num_rows() == 1)
        {
            return $q->result();
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

    public function update_front_id($agent_id,$id_front)
    {
        $this->db->where('agent_id',$agent_id);
        $q = $this->db->update('agents',array('id_front'=>$id_front));
        if($q == true)
        {
            return true;
        }
    }

    public function update_back_id($agent_id,$id_back)
    {
        $this->db->where('agent_id',$agent_id);
        $q = $this->db->update('agents',array('id_back'=>$id_back));
        if($q == true)
        {
            return true;
        }
    }

    public function updateStudentApproval($student_id)
    {
        $this->db->where('student_id',$student_id);
        $q = $this->db->update('students',array('student_status'=>'1'));
        if($q == true)
        {
            return true;
        }
    }

    public function getAgentName($agent_id)
    {
        $this->db->where('agent_id',$agent_id);
        $this->db->select('agent_name');
        $q = $this->db->get('agents');
        return $q->result();
    }

//insert excel to database
    public function excel_database($data) 
    {
        $res = $this->db->insert_batch('students',$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }

//delete lead
    public function delete_lead($lead_id)
    {
        $this->db->where(array('id'=>$lead_id));
        $q = $this->db->delete('leads');
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

    public function getDataByDesc($table,$where="", $orderBy="")
    {
        if($where != "")
        {
            $this->db->where($where);
        }
        if($orderBy != "")
        {
           $this->db->order_by($orderBy, "DESC"); 
        }
        $data = $this->db->get($table);
        if($data->num_rows() > 0) {
            return $data->result();
        } else {
            return array();
        }
    }

    public function checkAgentEmail($institute_id,$email)
    {
        $this->db->where(array('institute_id'=>$institute_id,'agent_email'=>$email));
        $q = $this->db->get('agents');
        if($q->num_rows() > 0)
        {
            return false;
        }
        else{
            return true;
        }
    }

    public function checkEmailOfStaff($institute_id,$email)
    {
       $this->db->where(array('institute_id'=>$institute_id,'employee_email'=>$email));
        $q = $this->db->get('staff');
        if($q->num_rows() > 0)
        {
            return false;
        }
        else{
            return true;
        } 
    }

    public function getLeadsByDays($time_frame=null,$selected_date=null)
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        $this->db->select('created_at,student_name,father_name,mobile,course,stream,contacted_medium');
        if($time_frame != "")
        {
            if($time_frame == "1")
            {
                $this->db->where('DATE(created_at)',$curr_date);
                $this->db->where('institute_id',$institute_id);
            } 

            else if($time_frame == "7")
            {
                $date_past_seven = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('created_at >=',$date_past_seven);
                $this->db->where('created_at <=',$curr_date);
                $this->db->where('institute_id',$institute_id);
            }

            else if($time_frame == "30")
            {
                $date_past_thirty = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('created_at >=' ,$date_past_thirty);
                $this->db->where('created_at <=',$curr_date);
                $this->db->where('institute_id',$institute_id);
            } 
            
            else if($time_frame == "all")
            {
                $this->db->where('institute_id',$institute_id);
            } 
        }else if($selected_date != '')
        {
            //$selected_date = date('Y-m-d',strtotime($selected_date));
            $this->db->where('DATE(created_at)',$selected_date);
            $this->db->where('institute_id',$institute_id);
        }
        
        $this->db->order_by('id','desc');
        $q = $this->db->get('leads')->result_array();
        // echo $this->db->last_query();exit;
        return $q;

    }

    public function studentPayments($year="",$course="",$stream="",$agent="")
    {
       $institute_id = $_SESSION['institute_id'];
       $this->db->select('*');
       $this->db->from('students');

       $this->db->where('institute_id',$institute_id);
       $this->db->where('student_status','1');
       $this->db->where('student_code !=',null);
       if(!empty($year))
       {
         $this->db->where('yoa',$year);
       } 
       if(!empty($course))
       {
         $this->db->where('course_id',$course);
       }
       if(!empty($agent))
       {
         $this->db->where('agent_name',$agent);
       }

       $this->db->order_by('student_id','desc');

       $q = $this->db->get();
       return $q->result();

    }

    public function get_students_by_filter($year,$course,$stream,$agent)
    {
       $institute_id = $_SESSION['institute_id'];
       $this->db->select('students.student_code,students.full_name,students.mobile,students.stream,students.course,students.yoa,agents.agent_name,students.package,');
       $this->db->from('students');
       $this->db->join('agents','students.agent_name = agents.agent_id');
       $this->db->where('students.institute_id',$institute_id);
       $this->db->where('students.student_status','1');
       $this->db->where('students.student_code !=',null);
       if(!empty($year))
       {
         $this->db->where('students.yoa',$year);
       } 
       if(!empty($course))
       {
         $this->db->where('students.course_id',$course);
       }
       if(!empty($agent))
       {
         $this->db->where('students.agent_name',$agent);
       }

       $q = $this->db->get();
       return $q->result_array(); 
    }

    public function leads_analytics($yr="",$time="",$date="",$staff="")
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        if($yr != "")
        {
           $this->db->where('YEAR(created_at)',$yr); 
        }
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(created_at) >=',$seven_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(created_at) >=',$thirty_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }
        }
        if($date != "")
        {
           $this->db->where('DATE(created_at)',$date); 
        }
        if($staff != "")
        {
           $this->db->where('assign_to',$staff);
        }
        
        $this->db->where('institute_id',$institute_id); 

        $result = $this->db->get('leads');
        return $result->result();
    }

    public function admission_analytics($yr="",$time="",$date="",$course="",$stream="")
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        if($yr != "")
        {
           $this->db->where('YEAR(created_at)',$yr); 
        }
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(created_at) >=',$seven_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(created_at) >=',$thirty_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }
        }
        if($date != "")
        {
           $this->db->where('DATE(created_at)',$date); 
        }
        if($course != "")
        {
           $this->db->like('course', '%'.$course.'%');
        }
        if($stream != "")
        {
           $this->db->like('stream', '%'.$stream.'%');
        }
        
        $this->db->where('institute_id',$institute_id);
        // $this->db->where('student_code !=','');  

        $result = $this->db->get('students');
        return $result->num_rows();
    }

    public function fees_analytics($yr="",$time="",$course="",$stream="")
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        $this->db->select('total_fee');
        if($yr != "")
        {
           $this->db->where('YEAR(date)',$yr); 
        }
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(date)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(date) >=',$seven_back_date);
                $this->db->where('DATE(date) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(date) >=',$thirty_back_date);
                $this->db->where('DATE(date) <=',$curr_date);
            }
        }
    
        if($course != "")
        {
           $this->db->where('course_name',$course); 
        }

        if($stream != "")
        {
           $this->db->where('stream',$stream); 
        }
        
        $this->db->where('institute_id',$institute_id);  

        $results = $this->db->get('payment_history')->result();
        $total = 0;
        if(!empty($results))
        {
            foreach($results as $fee)
            {
               $total += $fee->total_fee; 
            }
             
        }
        return $total;
    }

    public function online_applications($yr="",$time="",$course_id="",$stream_id="")
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        if($yr != "")
        {
           $this->db->where('YEAR(online_enquiry_created_at)',$yr); 
        }
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(online_enquiry_created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(online_enquiry_created_at) >=',$seven_back_date);
                $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(online_enquiry_created_at) >=',$thirty_back_date);
                $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
            }
        }
    
        if($course_id != "")
        {
           $this->db->where('course_id',$course_id); 
        }

        if($stream_id != "")
        {
           $this->db->where('stream_id',$stream_id); 
        }
        
        $this->db->where('institute_id',$institute_id);  

        $result = $this->db->get('online_enquiry');
        return $result->num_rows();
    }

    public function applications_list($time="",$stream="",$status="")
    {
       $institute_id = $_SESSION['institute_id'];
       $this->db->select('*');
       $this->db->from('online_enquiry');

       $this->db->where('institute_id',$institute_id);
       $curr_date = date('Y-m-d');
       if($time == '1')
       {
         $this->db->where('DATE(online_enquiry_created_at)',$curr_date);
       }else if($time == '7')
       {
         $date_before_seven_days = date('Y-m-d', strtotime('-7 days'));
         $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
         $this->db->where('DATE(online_enquiry_created_at) >=',$date_before_seven_days);
       }else if($time == '30')
       {
         $date_before_thirty_days = date('Y-m-d', strtotime('-30 days'));
         $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
         $this->db->where('DATE(online_enquiry_created_at) >=',$date_before_thirty_days);
       }
       if(!empty($stream))
       {
         $this->db->like('course_applied_for',$stream);
       }if($status == '1')
       {
         $this->db->where('online_enquiry_status','1');
       }elseif($status == '2'){
         $this->db->where('online_enquiry_status','2');
       }

       $this->db->order_by('online_enquiry_created_at','desc');

       $q = $this->db->get();
       //echo $this->db->last_query();exit;
       return $q->result();

    }

    public function get_students($yr,$time)
    {
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        $this->db->select('gender');
        $this->db->where('institute_id',$institute_id);
        if(!empty($yr))
        {
            $this->db->where('yoa',$yr);
        }
         
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(created_at) >=',$seven_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(created_at) >=',$thirty_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }
        }
        $this->db->where('student_code !=',null);
        $q = $this->db->get('students')->result();
        return $q;
    }

    public function get_online_applications($yr,$time)
    {
      
        $institute_id = $_SESSION['institute_id'];
        $curr_date = date('Y-m-d');
        $this->db->select('online_enquiry_id,online_enquiry_status');
        $this->db->where('institute_id',$institute_id);
  
        if(!empty($yr))
        {
            $this->db->where('year_of_passing',$yr);
        }
         
        if($time != "")
        {
            
            if($time == "1")
            {
              $this->db->where('DATE(online_enquiry_created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(online_enquiry_created_at) >=',$seven_back_date);
                $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(online_enquiry_created_at) >=',$thirty_back_date);
                $this->db->where('DATE(online_enquiry_created_at) <=',$curr_date);
            }
        }
       
        $q = $this->db->get('online_enquiry')->result();
        // echo $this->db->last_query();
        return $q;
    }

     public function course_wise_students($searchType,$id,$yr="",$time="")
    {
        $institute_id = $_SESSION['institute_id'];
        if($searchType == 'course')
        {
            $this->db->where(array('course_id'=>$id,'institute_id'=>$institute_id));
        }else if($searchType == 'stream'){
           $this->db->where(array('stream'=>$id,'institute_id'=>$institute_id)); 
        }
        
        $curr_date = date('Y-m-d');
        if(!empty($yr))
        {
            $this->db->where('yoa',$yr);
        }
         
        if($time != "")
        {
            if($time == "1")
            {
              $this->db->where('DATE(created_at)',$curr_date); 
            }

            if($time == '7')
            {
                $seven_back_date = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('DATE(created_at) >=',$seven_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }

            if($time == '30')
            {
                $thirty_back_date = date('Y-m-d', strtotime('-30 days'));
                $this->db->where('DATE(created_at) >=',$thirty_back_date);
                $this->db->where('DATE(created_at) <=',$curr_date);
            }
        }
        $this->db->where('student_code !=',null);
        $q = $this->db->get('students')->result();
        return count($q);
    }
    
}//end controller
?>