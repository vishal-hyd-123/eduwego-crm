<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Student extends CI_Controller
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

        $this->load->model('student_model');

    }



    public function login_view()

    {

    	$data['site_title'] = "ZEQON | Student Login"; 

    	$this->load->view('student/login',$data);

    }



    public function student_login(){

            $mobile      = $this->input->post("mobile");

            $password   = $this->input->post("password");

            $this->form_validation->set_rules('mobile', 'mobile or contact', 'trim|required|exact_length[10]');

            $this->form_validation->set_rules('password', 'password', 'trim|required');



            if ($this->form_validation->run() == FALSE){

                $errors = $this->form_validation->error_array();

                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;

            }



            else{

                $status=$this->student_model->login($mobile,$password);

                if($status){

                    echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;

                }else{

                    echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Phone or Password.'));die;

                }

            }



    }



    public function logout(){

        $this->session->sess_destroy(); 

        $br = $this->config->base_url();

        redirect($br."student-login", "refresh");

      }



    public function myProfile()

    {

        is_student_in();

    	$data['site_title'] = "ZEQON | My Profile";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/profile');

        $this->load->view('dashboard-includes/footer');

    }



    public function fee_details()
    {
        is_student_in();

        $student_id = $_SESSION['student_id'];

        $where = array('student_id'=>$student_id);

         $data['fees'] = $this->db->query("SELECT * FROM fees WHERE student_id = '".$student_id."' ")->result();

        $data['site_title'] = "ZEQON | Fees Details";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/fee_details');

        $this->load->view('dashboard-includes/footer');

    }



    public function course_details()

    {

        is_student_in();

        $student_id = $_SESSION['student_id'];

        $where = array('student_id'=>$student_id);

        $data['course_details'] = $this->student_model->getAllDataArray($where,'students');

        $data['site_title'] = "ZEQON | Course Details";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/course_details');

        $this->load->view('dashboard-includes/footer');

    }



    public function fee_receipt()

    {

        is_student_in();

        $student_id = $_SESSION['student_id'];

        $where = array('student_id'=>$student_id);

        $data['histories'] = $this->student_model->getAllDataArray($where,'payment_history');

        $data['site_title'] = "ZEQON | Receipt Download";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/receipt_download');

        $this->load->view('dashboard-includes/footer');

    }



    public function notices()

    {

        is_student_in();

        $institute_id = $_SESSION['institute_id'];

        $where = array('announcment_institute_id'=>$institute_id,'announcment_status'=>'1');

        $data['notices'] = $this->student_model->getAllNotices($where,'announcment','DESC');

        $data['site_title'] = "ZEQON | Receipt Download";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/notices');

        $this->load->view('dashboard-includes/footer');

    }



    public function write_to_management()

    {

        $data['site_title'] = "ZEQON | Receipt Download";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/write_message');

        $this->load->view('dashboard-includes/footer');

    }



    public function student_forgot_password()

    {

        $email = $_POST['email'];

        $where = array('email' => $email);   

        $assignments = $this->student_model->checkEmail('students',$where);

        if(count($assignments))

        {

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

            $new_pass =  substr(str_shuffle($permitted_chars), 0, 8);

            $message = "<h3>Dear user, we have recieved your request to change your password.<br>Your new login password to EDUWEGO+ is ".$new_pass."</a></h3>";                     

                    $verifu = 0;

                     

                    // Send Email OTP

                    $this->load->library('email');

                    $this->email->from('support@eduwego.in', 'Support EDUWEGO');

                    $this->email->to($email);

                    $this->email->subject('EduweGo+ Change Password');

                    $this->email->message($message);

                    $res =  $this->email->send();

                    // echo '<pre>'; print_r($res); echo '</pre>';

                     # code...

                    // $send_password = $this->send_mail($email,$new_pass);

                    if($res){



                        $userData = array(

                            "password" => md5($new_pass)

                        );

                        $update = $this->student_model->updateAllData('students',$where,$userData);

                        if($update)

                        {

                           echo json_encode(array('status'=>true, 'message'=>'Email with new password is sent to your registered Mail ID'));die; 

                        }

                        

                    }

                    else{

                        echo json_encode(array('status'=>false, 'message'=>'Email send failed.Please try again.'));die;

                    }



        }

        else{

            echo json_encode(array('notfound'=>true, 'errormessage'=>'Email id not found.'));die;

        }

    }



    public function message_to_management()

    {

        $this->form_validation->set_rules('message','Message','required');

        if($this->form_validation->run())

        {

            $message = $this->input->post('message');

            $institute_id = $_SESSION['institute_id'];

            $student_id = $_SESSION['student_id'];

            $student_name = $_SESSION['name'];

            $student_email = $_SESSION['email'];

            $student_mobile = $_SESSION['mobile'];

            $date = date('Y-m-d');

            $insert_data = array(

                'message' => $message,

                'student_id' => $student_id,

                'student_name' => $student_name,

                'student_email' => $student_email,

                'student_mobile' => $student_mobile,

                'institute_id' => $institute_id,

                'date' => $date

            );

            $status = $this->student_model->insertStudentMessage($insert_data);



            if($status){

                echo json_encode(array('status'=>true, 'message'=>'Message sent successfully'));die;

            }else{

                echo json_encode(array('status'=>false, 'errormessage'=>'Message send failed !'));die;

            }

        }

        else{

            echo json_encode(array('status'=>false, 'errormessage'=>'Message field must not be empty.'));die;

        }

    }



    public function change_password(){

        $data['site_title'] = "ZEQON | Change Password";  

        $this->load->view('dashboard-includes/header', $data);

        $this->load->view('dashboard-includes/student-sidebar');

        $this->load->view('student/change_password');

        $this->load->view('dashboard-includes/footer');

    }



    public function changes_pass(){

    

        if(isset($_POST) && !empty($_POST)){            

            $old_password   = $this->input->post("currentPassword");

            $password       = $this->input->post("newPassword");

            $old_passwordDB = $this->input->post("verifyPassword");



            $this->form_validation->set_rules('currentPassword', 'old password', 'trim|required');

            $this->form_validation->set_rules('newPassword', 'new password', 'trim|required|min_length[5]');

            $this->form_validation->set_rules('verifyPassword', 'confirm password', 'required|matches[newPassword]');



            if ($this->form_validation->run() == FALSE){

                $errors = $this->form_validation->error_array();

                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;

            }



            if ($this->session->userdata('is_student_in')) {

                $student_id   = $_SESSION['student_id'];

                $institute_id   = $_SESSION['institute_id'];

                $status=$this->student_model->changePassword($institute_id,$student_id, $old_password);

                

                if($status){

                    $userData = array(

                        "password" => md5($password),

                    );

                     $this->student_model->updateAllData('students',array('institute_id'=>$institute_id,'student_id'=>$student_id),$userData);

                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;

                }else {

                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;

                }

            }

        }

    }

    public function general_fee_receipt()
    {
        is_student_in();
        $student_id = $_SESSION['student_id'];
        $where = array('student_id'=>$student_id);
        $data['histories'] = $this->db->query("SELECT * FROM general_receipts WHERE student_id = '".$student_id."' ORDER BY receipt_id DESC ")->result();
        
        $data['site_title'] = "ZEQON | General Receipt Download";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/student-sidebar');
        $this->load->view('student/general_receipts');
        $this->load->view('dashboard-includes/footer');
    }

    public function print_general_receipt($receipt_id)
    {
      $where = array('receipt_id'=>$receipt_id);
      $details = $this->student_model->getAllDataArray($where,'general_receipts');
      $institute_id = $details[0]->institute_id;
      $student_id = $details[0]->student_id;
      $where1 = array('institute_id'=>$institute_id);
      $institute = $this->student_model->getAllDataArray($where1,'institute');
      $institute_logo = base_url().'uploads/'.$_SESSION['institute_logo'];
      $institute_name = $institute[0]->institute_name;
      $institute_address = $institute[0]->institute_address;
      $institute_mobile = $institute[0]->institute_mobile;
      $institute_email = $institute[0]->institute_email;
      
      $particulars = unserialize($details[0]->particulars);
      $where2 = array('student_id'=>$student_id);
      $student = $this->student_model->getAllDataArray($where2,'students');
      
      $student_code = $student[0]->student_code;
      $full_name = $student[0]->full_name;
      $date = date('d-M-Y',strtotime($student[0]->created_at));
      $total_amt = $details[0]->total_amt;
      $payment_mode = $details[0]->payment_mode;
      $txn = $details[0]->txn;
      
      $part_tr = "";
      $sl = 1;
      if(!empty($particulars))
      {
        foreach($particulars as $part)
        {
          $part_tr .= '<tr>
            <td>'.$sl++.'</td>
            <td>'.$part['part_name'].'</td>
            <td>'.$part['part_amts'].'</td>
          </tr>';
        }
      }
     
      $receipt_html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>General Receipt</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:1550px;
                      border:5px solid #ccc; 
                    }
                    .clg_header{
                      height:150px;
                      border-bottom:3px solid #ccc;
                      
                    }
                    .clg_header .logo_box{
                      width:20%;
                      height:120px;
                    }
                    .clg_header .name_box{
                      width:80%;
                      
                    }
                    .clg_header .name_box h2{
                      padding:0;
                      margin-bottom:4px;
                    }
                    .clg_header .name_box p{
                      padding:0;
                      margin:0;
                    }
                    .logo_box .logo{
                      width:90px;
                      height:90px;
                      border-radius:50%;
                      margin:30px auto;
                    }

                    .receipt_details{
                      height:auto;
                      border-bottom:3px solid #ccc;
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
                  </style>
                  </head>
                  <body>
                    <div class="main_div">
                      <div class="clg_header">
                        <div class="logo_box" style="float:left">
                          <div class="logo">
                            <img src="'.$institute_logo.'" width="100%" />
                          </div>  
                        </div>
                        <div class="name_box" style="float:right">
                          <center>
                            <h2 style="margin-top:7px;font-weight:bold">'.$institute[0]->institute_name.'</h2>
                            <p>'.$sub_institute[0]->sub_institute_name.'</p>
                            <p>Address:'.$institute[0]->institute_address.'</p>
                            <p>Contact: '.$institute[0]->institute_mobile.', email: '.$institute[0]->institute_email.'</p>
                          </center>
                        </div>
                      </div>
                      <div class="fee_details">
                        <table style="width:100%">
                          <tr>
                            <td><p><b>Student Code</b> : '.$student_code.'</p></td>
                            <td><p><b>Student Name</b> : '.$full_name.'</p></td>
                          </tr>
                          <tr>
                            <td style=""><p><b>Payment Mode</b> : '.$payment_mode.'</p></td>
                            <td><p><b>TXN Number</b> : '.$txn.'</p></td>
                          </tr>
                        </table>
                        <table style="width:100%;">
                          <tr>
                            <th>Sl.</th>
                            <th style="font-weight:bold">Particulars</th>
                            <th>Amount(Rs)</th>
                          </tr>
                          '.$part_tr.'
                          <tr>
                            <th colspan="2" style="text-align:center">Grand Total</th>
                            <th>'.$total_amt.'</th>
                          </tr>
                          
                        </table>
                      </div>
                      <table style="width:100%;margin-top:50px">
                          <tr>
                            <td><b>Date:</b> '.$date.'</td>
                            <td style="text-align:center">Principal</td>
                          </tr>
                      </table>
                    </div>
                  </body>
                </html>';
      $this->pdf->loadHtml($receipt_html);
      $this->pdf->set_paper('A4', 'portrait');
      $this->pdf->render();
      $this->pdf->stream("general_receipt.pdf", array("Attachment"=>0));
    }

    public function job_offers()
    {
        $data['jobs'] = $this->student_model->get_all('job_posts',false,'job_id');
        $data['site_title'] = "ZEQON | Change Password";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/student-sidebar');
        $this->load->view('student/jobs');
        $this->load->view('dashboard-includes/footer');
    }

    public function get_job_details()
    {
        $job_id = $_GET['job_id'];
        $details = $this->db->query("SELECT * FROM job_posts WHERE job_id = '".$job_id."' ")->row();
        print_r(json_encode($details));
    }

    public function apply_job()
    {
        $job_id = $this->security->xss_clean($_POST['job_id']);
        $student_name = $this->security->xss_clean($_POST['student_name']);
        $qualification = $this->security->xss_clean($_POST['qualification']);
        $experience = $this->security->xss_clean($_POST['experience']);
        $skills = $this->security->xss_clean($_POST['skills']);
        $institute_id = $this->session->userdata('institute_id');
        $student_id = $this->session->userdata('student_id');
        $student_email = $this->session->userdata('email');
        $student_mobile = $this->session->userdata('mobile');
        $institute_name = $this->session->userdata('institute_name');
        $where = array('job_id'=>$job_id);
        $job_details = $this->student_model->getAllDataArray($where,'job_posts');
        $company_email = $job_details[0]->company_email;            
                      
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
        "to": [{"email_address": {"address": "'.$company_email.'","name": "EDUWEGO+"}}],
        "subject":"Application for job",
        "htmlbody":"<p>Dear HR Manager,<br/><br/>I am very much interested in applying for the  position you advertised on eduwego recently. My educational qualifications and internship experience match the required job specifications. I would appreciate it if I am given a chance to prove my value addition for this job role.<br/><br/>It would be a pleasure to discuss this exciting opportunity with you. Looking forward to making this work.<br/><br/>Yours sincerely,<br/><br/><b>Student Name : '.$student_name.'<br/>Qualification : '.$qualification.'<br/>Phone : '.$student_mobile.'<br/>Email : '.$student_email.'<br/>'.$institute_name.'</b></p>",
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
        } else{
            $data = array(
                'job_id'=>$job_id,
                'student_id'=>$student_id,
                'institute_id'=>$institute_id,
                'student_name'=>$student_name,
                'qualification'=>$qualification,
                'experience'=>$experience,
                'skills'=>$skills,
                'mail_send_status'=>'1'
            );
            $this->student_model->insertData('jobs_applied',$data);
            echo json_encode(array('status'=>true, 'message'=>'Email sent to company.'));die;
        }
    }


}//end controller

?>