<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Associate extends CI_Controller
{

	public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('common_helper'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('user_agent');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->model('Associate_model');
    }

    public function associate_login()
    {
    	$data['site_title'] = "EDUWEGO | Associate Login"; 
    	$this->load->view('associate/login',$data);
    }

    public function associateLogin(){
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'Email Id', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'errormessage' => json_encode($errors)));die;
            }

            else{
                
                if($this->Associate_model->login($email,$password))
                {
                  $agent_id = $_SESSION['agent_id'];
                  $where1 = array('agent_id'=>$agent_id);
                  $data['institutes'] = $this->Associate_model->getAllDataArray('agents_institutes',$where1);
                  $this->load->view('associate/institute_options',$data);
                } else{
                    $this->session->set_flashdata('login_error','Login Failed !');
                    $this->associate_login();
                }
                
                
            }
        }
        
    }

    public function instituteSelected()
    {
        $inst_id = $_POST['institute'];
        $agent_id = $_SESSION['agent_id'];
        if($inst_id != "")
        {
           $this->session->set_userdata('institute_id',$inst_id);
           redirect(base_url()."associate/dashboard");   
        }else{
            $where1 = array('agent_id'=>$agent_id);
            $data['institutes'] = $this->Associate_model->getAllDataArray('agents_institutes',$where1);
            $this->session->set_flashdata('error','No institute selected !');
            $this->load->view('associate/institute_options',$data);
        }
        
    }


public function dashboard()
{
    if($_SESSION['is_agent_in'] == true)
    {
        $agent_id = $_SESSION['agent_id'];
        $institute_id = $_SESSION['institute_id'];
        $where = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'student_status'=>'1','approval'=>'1');
        $data['students'] = $this->Associate_model->getAllDataArray('students',$where);

        $where1 = array('payment_type'=>'2','paid_to_id'=>$agent_id,'institute_id'=>$institute_id);
        $data['payments'] = $this->Associate_model->getAllDataArray('payments',$where1);

        $where2 = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'approval'=>'0');
        $data['requests'] = $this->Associate_model->getAllData('students',$where2);
        $where3 = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'student_status'=>'1');
        $data['approved'] = $this->Associate_model->getAllData('students',$where3);

        $data['site_title'] = "ZEQON | Associate Dashboard";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/agent-sidebar');
        $this->load->view('associate/dashboard');
        $this->load->view('dashboard-includes/footer');
    }
}

public function getStreamsByCourse()
{
  if($_SESSION['is_agent_in'] == true)
  {}else{
    redirect(base_url().'associate');
  }
  $institute_id = $_SESSION['institute_id'];
  $course_id = $_POST['course_id'];
  $streams = $this->db->query("SELECT * FROM streams WHERE institute_id = '".$institute_id."' AND course = '".$course_id."' AND stream_status = 1 ")->result();

  $html = "";
  if(!empty($streams))
  {
    foreach($streams as $key=>$s)
    {
      $html .= '<option value="'.$s->stream_name.'">'.$s->stream_name.'</option>'; 
    }
  } else{
    $html .= '<option value="">No Stream Found</option>';
  }

  echo $html;
}


    public function myProfile()
    {

        if($_SESSION['is_agent_in'] == true)

        {

            $agent_id = $_SESSION['agent_id'];

            $institute_id = $_SESSION['institute_id'];

          $where = array('agent_id'=>$agent_id,'institute_id'=>$institute_id);

          $where1 = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'student_status'=>'1');

          $where2 = array('agent_id'=>$agent_id,'institute_id'=>$institute_id,'sub_agent_status'=>'1');

          $data['profile'] = $this->Associate_model->getAllDataArray("agents",$where);

          $data['no_of_students'] = $this->Associate_model->getStudentsNumbers('students',$where1);

          $data['sub_associates'] = $this->Associate_model->getSubAssociates('sub_agents',$where2);

          $data['received_amounts'] = $this->Associate_model->receivedAmountByAgent($agent_id);



          $where  = array('institute_id' => $institute_id , 'course_status' => '1');

          $courses = $this->Associate_model->getAllDataArray(TBL_COURSES,$where);



          $tbody_html = "";

          

            $sl = 1;

            foreach($courses as $course)

            {

                $total = 0;

                $due = 0;

                $expected = 0;

                $course_id = $course->course_id;

                $number_students = $this->Associate_model->getNumberStudents($course_id,$institute_id,$agent_id);

                $tbody_html .= '

                  <tr>

                    <td>'.$sl++.'</td>

                    <td class="text-capitalize">'.$course->course_name.'</td>

                    <td class="text-capitalize students_number">'.$number_students.'</td>

                  </tr>

                ';

            }



            $data['course_wise_students'] = $tbody_html;

            $data['site_title'] = "ZEQON | My Profile";  

            $this->load->view('dashboard-includes/header', $data);

            $this->load->view('dashboard-includes/agent-sidebar');

            $this->load->view('associate/profile');

            $this->load->view('dashboard-includes/footer');

        }

    }



public function agentFeesDetails($student_id)
{

    if($_SESSION['is_agent_in'] == true)

    {

        $where = array('student_id'=>$student_id);

        $data['payments'] = $this->Associate_model->getAllDataArray('payment_history',$where);

        $data['fees'] = $this->Associate_model->getAllData('fees',$where);



        $data['site_title'] = "ZEQON | Student Fees Details";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/agent-sidebar');

        $this->load->view('associate/student_fees');

        $this->load->view('dashboard-includes/footer');

    }

}

public function payments_view()
{
    if($_SESSION['is_agent_in'] == true)
    {
        $agent_id = $_SESSION['agent_id'];
        $institute_id = $_SESSION['institute_id'];
        $where = array('payment_type'=>'2','paid_to_id'=>$agent_id,'institute_id'=>$institute_id);
        $data['payments'] = $this->Associate_model->getAllPayments('payments',$where);
        $data['site_title'] = "ZEQON | Payment Details";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/agent-sidebar');
        $this->load->view('associate/payments');
        $this->load->view('dashboard-includes/footer');
    }
}

public function pending_students()
{
    if($_SESSION['is_agent_in'] == true)
    {
        $agent_id = $_SESSION['agent_id'];
        $institute_id = $_SESSION['institute_id'];
        $where = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'approval'=>'0');
        $data['students'] = $this->Associate_model->getAllDataArray('students',$where,'student_id');

        $data['site_title'] = "ZEQON | Pending Students";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/agent-sidebar');
        $this->load->view('associate/pending_students');
        $this->load->view('dashboard-includes/footer');
    }
}



    public function change_password(){

      if($_SESSION['is_agent_in'] == true)

      {

        $data['site_title'] = "ZEQON | Change Password";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/agent-sidebar');

        $this->load->view('associate/change_password');

        $this->load->view('dashboard-includes/footer');

      } 

    }



    public function changes_pass()

    {

        if($_SESSION['is_agent_in'] == true)

        {

            $old_password   = $this->input->post("currentPassword");

            $password       = $this->input->post("newPassword");

            $old_passwordDB = $this->input->post("verifyPassword");



            $this->form_validation->set_rules('currentPassword', 'old password', 'trim|required');

            $this->form_validation->set_rules('newPassword', 'new password', 'trim|required|min_length[5]');

            $this->form_validation->set_rules('verifyPassword', 'confirm password', 'required');



            if ($this->form_validation->run() == FALSE){

                $errors = $this->form_validation->error_array();

                echo json_encode(array('status'=>false, 'errormessage' => 'Something went wrong !'));die;

            }



            if($password == $old_passwordDB)

            {

               if($_SESSION['is_agent_in'] == true){

                    $institute_id   = $_SESSION['institute_id'];

                    $agent_id = $_SESSION['agent_id'];

                    $status=$this->Associate_model->changePasswordAgent($institute_id,$agent_id,$old_password);

                    if($status) {

                        $userData = array(

                            "password" => md5($password),

                        );

                        $this->Associate_model->updateAllData('agents',array('agent_id'=>$agent_id),$userData);

                        echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;

                    }else {

                        echo json_encode(array('status'=>false, 'errormessage'=>'Wrong password Entered.'));die;

                    }

                } 

            }

            else{

                echo json_encode(array('status'=>false, 'errormessage'=>'New password and verify password value must be same!'));die;

            }

        }

    }

    public function agent_forgot_password()
    {
        $email = $_POST['email'];
        $where = array('agent_email' => $email);   
        $assignments=$this->Associate_model->getAllDataArray('agents',$where);
        // echo '<pre>'; print_r($assignments); echo '</pre>';
        if(count($assignments)){ 
            $agent_name = $assignments[0]->agent_name;               
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $new_pass =  substr(str_shuffle($permitted_chars), 0, 8);
                          
              $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => '{
                "bounce_address":"password@bounce.eduwego.in",
                "from": { "address": "noreply@eduwego.in"},
                "to": [{"email_address": {"address": "'.$email.'","name": "EDUWEGO+"}}],
                "subject":"NEW PASSWORD FOR LOGIN",
                "htmlbody":"<h3>Dear '.$agent_name.', we have recieved your request to change your password.<br>Your new login password is - '.$new_pass.'</a></h3>",
                }
                  ]
                }',
                        CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "authorization: Zoho-enczapikey PHtE6r0NRL/i2mMu+hEC5Ke6EcDyNY8m/u9neggVtt0WAvYCG01drdB5xDLm+R94VvUWRqXIyd5ttuuVsuiBIWjuYWZMDmqyqK3sx/VYSPOZsbq6x00ctF0ff0bdVILmc9Vq1SDVut/YNA==",
                        "cache-control: no-cache",
                        "content-type: application/json",
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo json_encode(array('status'=>false, 'message'=>'Email send failed.Please Try again.'));die;
                } else {
                    $userData = array(
                        "password" => md5($new_pass)
                    );
                     $update = $this->Associate_model->updateAllData('agents',$where,$userData);
                     if($update)
                     {
                        echo json_encode(array('status'=>true, 'message'=>'Email with new password is sent to your registered Mail ID'));die;
                     }
                }
                     
        }else{
                echo json_encode(array('status'=>false, 'message'=>'User with this email not found..'));die;
        }
    }

    public function add_student(){
        if($_SESSION['is_agent_in'] == true)
        {
        if(isset($_POST) && !empty($_POST)){
            $institute_id = $_SESSION['institute_id'];
            $full_name              = $_POST['name'];
            $s_w_d_of               = $_POST['father_name'];
            $mother_name            = $_POST['mother_name'];
            $occupation             = $_POST['occupation'];
            $qualification          = $_POST['qualification'];
            $dob                    = $_POST['dob'];
            $gender                 = $_POST['gender'];
            $course                 = $_POST['course'];
            $course_id              = $_POST['course_id'];
            $stream                 = $_POST['stream'];
            $agent_name             = $_POST['agent_name'];
            $mobile                 = $_POST['number'];
            $email                  = $_POST['email'];
            $yoa                    = $_POST['admissionyer'];
            $address                = $_POST['address'];
            $city                   = $_POST['city'];
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");

        if(isset($_FILES['image']) && $_FILES['image']!="" && !empty($_FILES['image']['name'])){
            $file_orignal_name = $_FILES['image']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_STUDENT_PHOTO;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'image';
            $result = $this->Associate_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if ($result) {
                $student_photo = $path.$image_name;
                $student_photo_status = TRUE;
            }else{
                $student_photo_status = FALSE;
            }
        }

        if(!$student_photo_status){

            $insert_data  = array(

                                'full_name'                 => $full_name,
                                's_w_d_of'                  => $s_w_d_of ,
                                'mother_name'               =>$mother_name,
                                'occupation'                =>$occupation,
                                'qualification'             => $qualification, 
                                'dob'                       => $dob ,
                                'gender'                    => $gender,
                                'course'                    => $course,
                                'course_id'                 => $course_id,
                                'stream'                    => $stream,
                                'mobile'                    => $mobile,
                                'email'                     => $email,
                                'yoa'                       => $yoa,
                                'address'                   => $address,
                                'student_status'            => '0',
                                'agent_name'                => $agent_name,
                                'approval'                  => '0',
                                'student_status'            => '1',
                                'institute_id'              => $_SESSION['institute_id'],
                                'updated_at'                => $updated_at,
                                'password'                  => md5('123456'),
                                'city'                      => $city
                                );
          }else{
          
            $insert_data  = array(

                                'full_name'                 => $full_name,
                                's_w_d_of'                  => $s_w_d_of ,
                                'mother_name'               => $mother_name,
                                'occupation'                => $occupation,
                                'qualification'             => $qualification, 
                                'dob'                       => $dob ,
                                'gender'                    => $gender,
                                'course'                    => $course ,
                                'course_id'                 => $course_id ,
                                'stream'                    => $stream , 
                                'mobile'                    => $mobile,
                                'email'                     => $email,
                                'yoa'                       => $yoa,
                                'address'                   => $address,
                                'student_status'            => '0',
                                'agent_name'                => $agent_name,
                                'approval'                  => '0',
                                'student_status'            => '1',
                                'institute_id'              => $_SESSION['institute_id'],
                                'student_photo'             => $student_photo,
                                'updated_at'                => $updated_at,
                                'password'                  => md5('123456'),
                                'city'                      => $city
                                );
        }

            if($_POST['student_id']=="" && $_POST['student_id']== NULL){
              
                $institute_id = $_SESSION['institute_id'];
                $where  = array('institute_id' => $institute_id );
                $checkLimit=$this->Associate_model->getAllDataArray(TBL_INSTITUTE,$where);
                
                if($checkLimit[0]->institute_allowed_student<=$checkLimit[0]->institute_student_admited){

                    echo json_encode(array('status'=>false, 'errormessage'=>'Limit Reached.'));die;

                }
                
                $check_mobile =$this->Associate_model->checkMobile($institute_id,$mobile);
                if($check_mobile == true)
                {
                  $insert_id =$this->Associate_model->insertStudentData(TBL_STUDENT,$insert_data);

                  if($insert_id != ""){
                    // Save data for notification
                    $agent_name = $_SESSION['name'];
                    $course_name = $course;
                    $notice_msg = 'New Student added by '.$agent_name.' for '.$course_name;
                    $url = base_url().'institute/viewStudent?id='.base64_encode($insert_id);
                    $notice_data = array(
                      'institute_id'=>$institute_id,
                      'msg'=>$notice_msg,
                      'url'=>$url,
                      'type'=>'Student Added',
                      'created_at'=>date('Y-m-d H:i:s')
                    );

                    $this->Associate_model->insertData('notifications',$notice_data);
                    
                    echo json_encode(array('status'=>true, 'message'=>'Insertion Success.'));die;

                  }else{
                        echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                    }
                }
                else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Student with same Mobile number allready exists.Please try with another number'));die;
                }
                    
            }else{
                $student_id = $_POST['student_id'];
                $status=$this->Associate_model->editStudentData($student_id,$insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
        }
    }

    public function deleteRequest($id)
    {
        $student_id = base64_decode($id);
        if($_SESSION['is_agent_in'] == true)
        {
            $agent_id = $_SESSION['agent_id'];
            $where = array('student_id'=>$student_id,'agent_name'=>$agent_id);
            if($this->Associate_model->delete('students',$where))
            {
                echo json_encode(array('status'=>true, 'message'=>'Request deleted successfully !'));die;
            }else{
                echo json_encode(array('status'=>false, 'errormessage'=>'Failed to delete request !'));die;
            }
        }
    }

    public function print_provisional_letter($student_id){

        $institute_id = $_SESSION['institute_id'];

        $institute = $this->Associate_model->fetchInstituteData($institute_id);

        $sub_institute_id = $student[0]->sub_institute_id;

        $sub_institute = $this->Associate_model->getSubInstitute($sub_institute_id);



        $where = array('student_id' => $student_id);   

        $student_details = $this->Associate_model->getAllDataArray(TBL_STUDENT,$where);

        $current_year = date('Y');

        $academic_year = $current_year."-".($current_year+1);

        $title = $student_details[0]->full_name.' Admission Letter';

        $current_date = date('d-m-Y');

        $bona_letter_html = '<!DOCTYPE html>

                  <html>

                  <head>

                  <title>Receipt</title>

                  <style>

                    .main_div{

                      width:100%;

                      height:1550px;

                      

                    }

                    .clg_header{

                      height:300px;

                      

                    }

                    .clg_header .logo_box{

                      width:15%;

                      height:100px;

                    }

                    .clg_header .name_box{

                      width:80%;

                      

                    }

                    .clg_header .name_box h3{

                      padding:0;

                      margin:0;

                    }



                    .logo_box .logo{

                      width:100px;

                      height:100px;

                      border-radius:50%;

                      margin:30px auto;

                    }



                    .receipt_details{

                      height:auto;

                      padding:5px;

                    }

                    .receipt_details table tr td{

                      margin-left:20%;

                    }

                    .fee_details{

                      height:auto;

                      border-bottom:3px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr td{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr th{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .name_box p{

                      padding:0;

                      margin:0;

                    }

                  </style>

                  </head>

                  <body>

                    <div class="main_div">

                      <div class="clg_header">

                        

                      </div>

                      <div class="receipt_details" style="padding:8px">

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="width:80%;padding-left:12px">

                              <p>REF:</p>

                            </td>

                            <td>

                              <p>Date : '.$current_date.'</p>

                            </td>

                          </tr>

                        </table>

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="padding-left:12px">

                              To

                              <br />

                              Mr/Mrs '.$student_details[0]->full_name.'

                              <br />

                              '.$student_details[0]->city.'

                            </td>

                            <td></td>

                          </tr>

                        </table>

                        <center>PROVISIONAL ADMISSION LETTER</center>

                        

                        <p style="margin-left:12px">This is to inform you that you have been selected for this course <b>'.$student_details[0]->stream.' '.$student_details[0]->course.'</b> for the academic year <b>'.$academic_year.'</b> . However the confirmation of the admission is subject to the following conditions: </p>



                        <div style="padding-left:45px">

                          <p>

                            1. Any fee/payment made towards admission is non-refundable under any circumstances . 

                          </p>

                          <p>

                            2. Your admission will be confirmed only after approval from the board/University . 

                          </p>

                          <p>

                            3. You must report to the college on opening day , failing which your seat may be allotted to the next candidate in waiting.

                          </p>

                          <p>

                            4. Board/Govt./University fee will have to paid separately as and when it is required or revised.

                          </p>

                          <p>

                            5. In case of any dispute legal jurisdiction shall be at '.$institute[0]->state.' . 

                          </p>

                          <p>

                            6. Clinical charges, elctricity charges, water charges should be collected separately .

                          </p>

                          <p>

                            7. For all the outstation students staying in hostel is compulsary till the completion of course.

                          </p>

                        </div>

                        <table style="width:100%;margin-top:100px">

                          <tr>

                            <td style="text-align:right">PRINCIPAL<td>

                          </tr>

                        </table>

                      </div>

                      

                    </div>

                    

                  </body>

                  </html>';



            $this->pdf->loadHtml($bona_letter_html);

            $this->pdf->set_paper('A4', 'portrait');

            $this->pdf->render();

            $this->pdf->stream("$title.pdf", array("Attachment"=>0));



        }



    public function print_bonafied_letter($student_id){

        $institute_id = $_SESSION['institute_id'];

        $institute = $this->Associate_model->fetchInstituteData($institute_id);

        $sub_institute_id = $student[0]->sub_institute_id;

        $sub_institute = $this->Associate_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   

        $student_details = $this->Associate_model->getAllDataArray(TBL_STUDENT,$where);

        $current_year = date('Y');

        $academic_year = $current_year."-".($current_year+1);

        $title = $student_details[0]->full_name.' Bonafied Letter';

        $current_date = date('d-m-Y');

        $bona_letter_html = '<!DOCTYPE html>

                  <html>

                  <head>

                  <title>'.$title.'</title>

                  <style>

                    .main_div{

                      width:100%;

                      height:1550px;

                      

                    }

                    .clg_header{

                      height:300px;

                      

                    }

                    .clg_header .logo_box{

                      width:15%;

                      height:100px;

                    }

                    .clg_header .name_box{

                      width:80%;

                      

                    }

                    .clg_header .name_box h3{

                      padding:0;

                      margin:0;

                    }



                    .logo_box .logo{

                      width:100px;

                      height:100px;

                      border-radius:50%;

                      margin:30px auto;

                    }



                    .receipt_details{

                      height:auto;

                      padding:5px;

                    }

                    .receipt_details table tr td{

                      margin-left:20%;

                    }

                    .fee_details{

                      height:auto;

                      border-bottom:3px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr td{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr th{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .name_box p{

                      padding:0;

                      margin:0;

                    }

                  </style>

                  </head>

                  <body>

                    <div class="main_div">

                      <div class="clg_header">

                        

                      </div>

                      <div class="receipt_details" style="padding:8px">

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="width:80%;padding-left:12px">

                              <p>REF:</p>

                            </td>

                            <td>

                              <p>Date : '.$current_date.'</p>

                            </td>

                          </tr>

                        </table>

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="padding-left:12px">

                              

                            </td>

                            <td></td>

                          </tr>

                        </table>

                        <center>BONAFIDE CERTIFICATE</center>

                        

                        <p style="margin-left:20px;margin-top:50px">This is to certify that <b>Mr/Mrs '.$student_details[0]->full_name.'</b> is a bonafide student of our institute studying <b>'.$student_details[0]->stream.' '.$student_details[0]->course.'</b> during the academic year <b>'.$academic_year.'</b> . He/She is a regular student of our institute and admitted under merit.  </p>



                        <p style="margin-left:20px;">

                          This certificate is issued for the specific request of the said student for Caste/Scholarship validity purpose.

                        </p>



                      </div>



                      <table style="width:100%;margin-top:65px">

                          <tr>

                            <td><td>

                            <td style="text-align:right">PRINCIPAL<td>

                          </tr>

                      </table>

                      

                    </div>

                    

                  </body>

                  </html>';



            $this->pdf->loadHtml($bona_letter_html);

            $this->pdf->set_paper('A4', 'portrait');

            $this->pdf->render();

            $this->pdf->stream("$title.pdf", array("Attachment"=>0));



        }



        public function print_fees_structure(){

          $student_id = $_GET['student_id'];

          $course_dur = $_GET['course_dur'];

          $hostel_fee = json_decode($_GET['hostel_fee']);

          $univ_fee = json_decode($_GET['univ_fee']);

          $clinical_fee = json_decode($_GET['clinical_fee']);

          $sports_fee = json_decode($_GET['sports_fee']);

          $misc_fee = json_decode($_GET['misc_fee']);

          

          $institute_id = $_SESSION['institute_id'];

          $institute = $this->Associate_model->fetchInstituteData($institute_id);

          $tution_fees = $this->Associate_model->getTutionFees($student_id);



          $sub_institute_id = $student[0]->sub_institute_id;

          $sub_institute = $this->Associate_model->getSubInstitute($sub_institute_id);



          $where = array('student_id' => $student_id);   

          $student_details = $this->Associate_model->getAllDataArray(TBL_STUDENT,$where);

          $yoa = $student_details[0]->yoa;

          $academic_year = $yoa."-".($yoa+1);

          $title = $student_details[0]->full_name.' Admission Letter';

          $current_date = date('d-m-Y');



          $yrs_td = "";

          for($i=1;$i<=$course_dur;$i++)

          {

            $yrs_td .= "<th>Year - ".$i."</th>";

          }



          $tution_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $tution_fee_td .= "<td>".$tution_fees[$i]->yearly_fee."</td>";

          }



          $hostel_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $hostel_fee_td .= "<td>".$hostel_fee[$i]."</td>";

          }



          $univ_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $univ_fee_td .= "<td>".$univ_fee[$i]."</td>";

          }



          $clinical_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $clinical_fee_td .= "<td>".$clinical_fee[$i]."</td>";

          }

          

          $sports_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $sports_fee_td .= "<td>".$sports_fee[$i]."</td>";

          }



          $misc_fee_td = "";

          for($i=0;$i<$course_dur;$i++)

          {

            $misc_fee_td .= "<td>".$misc_fee[$i]."</td>";

          }

          $bona_letter_html = '<!DOCTYPE html>

                  <html>

                  <head>

                  <title>Receipt</title>

                  <style>

                    .main_div{

                      width:100%;

                      height:1550px;

                      

                    }

                    .clg_header{

                      height:300px;

                      

                    }

                    .clg_header .logo_box{

                      width:15%;

                      height:100px;

                    }

                    .clg_header .name_box{

                      width:80%;

                      

                    }

                    .clg_header .name_box h3{

                      padding:0;

                      margin:0;

                    }



                    .logo_box .logo{

                      width:100px;

                      height:100px;

                      border-radius:50%;

                      margin:30px auto;

                    }



                    .receipt_details{

                      height:auto;

                      padding:5px;

                    }

                    .receipt_details table tr td{

                      margin-left:20%;

                    }

                    .fee_details{

                      height:auto;

                      padding:5px;

                    }

                    .fee_details table tr td{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr th{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .name_box p{

                      padding:0;

                      margin:0;

                    }

                  </style>

                  </head>

                  <body>

                    <div class="main_div">

                      <div class="clg_header">

                        

                      </div>

                      <div class="receipt_details" style="padding:8px">

                        <table style="width:100%;margin-bottom:30px">

                          <tr>

                            <td style="width:80%;padding-left:12px">

                              <P>REF:</P>

                            </td>

                            <td>

                              <p>Date : '.$current_date.'</p>

                            </td>

                          </tr>

                        </table>

                        <?php echo "Hello"; ?>

                        <center>FEES STRUCTURE</center>

                        <p style="margin-left:12px">This is to certify that <b>Mr./Mrs.'.$student_details[0]->full_name.' S/D/W of '.$student_details[0]->s_w_d_of.'</b> is admitted under merit into 1st year '.$student_details[0]->stream.' '.$student_details[0]->course.' Course in <b>'.$_SESSION["name"].'</b> in the academic year '.$academic_year.' . Following  will be the estimated fee of hostel and academic year fee structure during her /his  stays at  the college.  </p>



                        <div class="fee_details" style="padding-left:45px">

                          <table style="width:100%">

                            <tr>

                              <th>Particulars</th>

                              '.$yrs_td.'

                            </tr>

                            <tr>

                              <td>Tution Fees</td>

                              '.$tution_fee_td.'

                            </tr>

                            <tr>

                              <td>Hostel Fees</td>

                              '.$hostel_fee_td.'

                            </tr>

                            <tr>

                              <td>University Fees</td>

                              '.$univ_fee_td.'

                            </tr>

                            <tr>

                              <td>clinical Fees</td>

                              '.$clinical_fee_td.'

                            </tr>

                            <tr>

                              <td>Sports & Cultural Fees</td>

                              '.$sports_fee_td.'

                            </tr>

                            <tr>

                              <td>Misclleneous Fees</td>

                              '.$misc_fee_td.'

                            </tr>

                          </table>

                        </div>



                        <table style="width:100%;margin-top:100px">

                          <tr>

                            <td style="text-align:right">PRINCIPAL<td>

                          </tr>

                        </table>

                      </div>

                      

                    </div>

                    

                  </body>

                  </html>';



            $this->pdf->loadHtml($bona_letter_html);

            $this->pdf->set_paper('A4', 'portrait');

            $this->pdf->render();

            $this->pdf->stream("$title.pdf", array("Attachment"=>0));



        }



    public function print_hostel_certificate($student_id){

        $institute_id = $_SESSION['institute_id'];

        $institute = $this->Associate_model->fetchInstituteData($institute_id);

        $sub_institute_id = $student[0]->sub_institute_id;

        $sub_institute = $this->Associate_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   

        $student_details = $this->Associate_model->getAllDataArray(TBL_STUDENT,$where);

        $current_year = date('Y');

        $academic_year = $current_year."-".($current_year+1);

        $title = $student_details[0]->full_name.' Bonafied Letter';

        $current_date = date('d-m-Y');

        $bona_letter_html = '<!DOCTYPE html>

                  <html>

                  <head>

                  <title>'.$title.'</title>

                  <style>

                    .main_div{

                      width:100%;

                      height:1550px;

                      

                    }

                    .clg_header{

                      height:300px;

                      

                    }

                    .clg_header .logo_box{

                      width:15%;

                      height:100px;

                    }

                    .clg_header .name_box{

                      width:80%;

                      

                    }

                    .clg_header .name_box h3{

                      padding:0;

                      margin:0;

                    }



                    .logo_box .logo{

                      width:100px;

                      height:100px;

                      border-radius:50%;

                      margin:30px auto;

                    }



                    .receipt_details{

                      height:auto;

                      padding:5px;

                    }

                    .receipt_details table tr td{

                      margin-left:20%;

                    }

                    .fee_details{

                      height:auto;

                      border-bottom:3px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr td{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .fee_details table tr th{

                      border:1px solid #ccc;

                      padding:5px;

                    }

                    .name_box p{

                      padding:0;

                      margin:0;

                    }

                  </style>

                  </head>

                  <body>

                    <div class="main_div">

                      <div class="clg_header">

                        

                      </div>

                      <div class="receipt_details" style="padding:8px">

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="width:80%;padding-left:12px">

                              <p>REF:</p>

                            </td>

                            <td>

                              <p>Date : '.$current_date.'</p>

                            </td>

                          </tr>

                        </table>

                        <table style="width:100%;margin-bottom:12px">

                          <tr>

                            <td style="padding-left:12px">

                              

                            </td>

                            <td></td>

                          </tr>

                        </table>

                        <center>HOSTEL CERTIFICATE</center>

                        

                        <p style="margin-left:20px;margin-top:50px">This is to certify that <b>Mr/Mrs '.$student_details[0]->full_name.'</b> is a bonafide student of our institute studying <b>'.$student_details[0]->stream.' '.$student_details[0]->course.'</b> during the academic year <b>'.$academic_year.'</b> . He/She is a regular student of our institute and admitted under merit.  </p>



                        <p style="margin-left:20px;">

                          He is staying in the hostel Mentioned Below.

                        </p>



                        <center><p style="font-weight:bold">

                          '.$institute[0]->institute_address.'

                        </p></center>



                      </div>



                      <table style="width:100%;margin-top:65px">

                          <tr>

                            <td><td>

                            <td style="text-align:right">PRINCIPAL<td>

                          </tr>

                      </table>

                      

                    </div>

                    

                  </body>

                  </html>';



            $this->pdf->loadHtml($bona_letter_html);

            $this->pdf->set_paper('A4', 'portrait');

            $this->pdf->render();

            $this->pdf->stream("$title.pdf", array("Attachment"=>0));



        }



}//end controller

?>