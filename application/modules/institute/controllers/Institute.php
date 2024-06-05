<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Institute extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('institute_model');
        $this->load->database();
        $this->load->helper(array('common_helper'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('user_agent');
        $this->load->library('email');
        $this->load->library('session');
        date_default_timezone_set("Asia/Calcutta");
    }

    public function session_check()
    {
      $session = $this->session->userdata($data);
      if($session['is_institute_in'] == true || $session['is_staff_in'] == true)
      {
        return true;
      }
      else{
        return false;
      }
    }

    public function dashboard(){
        is_institute_in();
        // echo date('m');
        $months = array();
        $data = array();
          for ($i = 0; $i < 5; $i++){
            $temp_var = array();
            $m =  date('m', strtotime("-$i month"));
            $start_date =  date('Y-m-01 00:00:00', strtotime("-$i month"));
            $end_date =  date('Y-m-t 00:00:00', strtotime("-$i month"));

            $where  = array('created_at>' => $start_date , 'created_at<' => $end_date);
            $checkLimite=$this->institute_model->getAllDataArray(TBL_ENQUIRY,$where);

            $where  = array('created_at>' => $start_date , 'created_at<' => $end_date);
            $checkLimits=$this->institute_model->getAllDataArray(TBL_STUDENT,$where);

            $temp_var['m'] = date('F', strtotime("-$i month"));
            $temp_var['m_numeric'] = date('m', strtotime("-$i month"));
            $temp_var['enquiry'] = count($checkLimite);
            $temp_var['students'] = count($checkLimits);
            array_push($months, $temp_var);
          }
        // echo '<pre>'; print_r($months); echo '</pre>';

          $today = date("y-m-d");

        $institute_id = $_SESSION['institute_id'];
          $query = "SELECT * FROM `announcment`  WHERE `announcment_start_date` <= '$today' AND `announcment_end_date` >= '$today' AND `announcment_status` = 1";
          $get_data=$this->institute_model->getAllDataString('announcment',$query);
          $announcments = "";
          for ($i=0; $i < count($get_data); $i++) {

            if ($i == 0) {
                $announcments = $get_data[$i]->announcment_discription;
             }else{              
              $announcments = $announcments."  ---***---  ".$get_data[$i]->announcment_discription;
             } 
          }
          // echo '<pre>'; print_r($announcments); echo '</pre>';die;
        $data['menu'] = "dashboard";
        $data['chart_data'] = $months;  
        $data['announcments'] = $announcments;  
        $data['site_title'] = "EDUWEGO | dashboard";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('dashboard');
        $this->load->view('dashboard-includes/footer');       
      
    }

    public function staff_login_view()
    {
      $data['site_title'] = "EDUWEGO | Employee Login"; 
      $this->load->view('staff_login',$data);
    }

    public function staffLogin(){
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'Email Id.', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }

            else{
                $status=$this->institute_model->staff_login($email,$password);
                if($status){
                    echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
                }else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Phone or Password.'));die;
                }
            }
        }
    }

    public function search()
    {
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'search'; 
        $data['site_title'] = "EDUWEGO | Search Student";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('student_search');
        $this->load->view('dashboard-includes/footer');
      } 
    }

    public function searchStudents()
    {
        $institute_id = $_SESSION['institute_id'];
        $srch_by = $this->input->post('srch_by');
        $srch_number = $this->input->post('srch_number');
        $students = $this->institute_model->fecthStudentsList($institute_id,$srch_by,$srch_number);
        if($students != null)
        {
            print_r(json_encode($students));
        }
        else{
            echo "No Data Found";
        }
    }

    public function print_voucher($payment_id){
        is_institute_in();
        $where  = array('payment_id' => $payment_id );
        $checkLimit=$this->institute_model->getAllDataArray(TBL_PAYMENTS,$where);
        // echo '<pre>'; print_r($_SESSION); echo '</pre>';
        $institute_name = $_SESSION['name'];
        $institute_address = $_SESSION['institute_address'];
        $payment_type     = $checkLimit[0]->payment_type;
        $paid_to_name     = $checkLimit[0]->paid_to_name;
        $paid_to_id       = $checkLimit[0]->paid_to_id;
        $purpose          = $checkLimit[0]->purpose;
        $payment_type     = $checkLimit[0]->payment_type;
        $amount           = $checkLimit[0]->amount;
        $amount_in_words  = $checkLimit[0]->amount_in_words;
        $payment_date     = $checkLimit[0]->payment_date;
        $payment_mode     = $checkLimit[0]->payment_mode;
        if ($payment_type == 1) {
          $agent_details = $this->get_vendor_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->vendor_name;
          
        }elseif ($payment_type == 2) {
          $agent_details = $this->institute_model->get_agent_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->agent_name;
        }elseif ($payment_type == 3) {
          $agent_details = $this->get_staff_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->employee_name;
        }
        $voucher_html = '<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="'.base_url('assets/dashboard/libs/jquery/dist/jquery.min.js').'"></script>
  <style type="text/css">
    .width1200{
      width: 800px;
      padding: 20px;
      background: #fff;
    }

    .mrt30{
      margin-top: 30px;
    }
    .m-t-12{
      margin-top:8px;
    }
    .margin_3{
      margin:3px;
    }
    .border{
      border: 1px solid #000;
    }

    .border th{
      border: 1px solid #000;
      padding: 10px 10px;
    }
    .border td{
      border: 1px solid #000;
      padding: 10px 10px;
    }
    .margin_t_b{
      margin-top:0px;
      margin-bottom:8px;
    }
  </style>
</head>
<body style="background: #f5f5f5">
  <center>
    <div class="width1200">
      <table width="100%">
        <tr>
          <td align="center"><h2 class="margin_t_b">'.$institute_name.'</h2></td>
        </tr>
      </table>
      <table width="100%">
        <tr>
          <td align="center"><h4 class="margin_t_b">'.$institute_address.'</h4></td>
        </tr>
      </table>
      <table width="100%">
        <tr>
          <td align="center"><h2 class="margin_t_b">Payment Voucher</h2></td>
        </tr>
      </table>

      <table width="100%" class="m-t-12">
        <tr>
          <td>
            <table width="100%" class="border">
              <tr>
                <th align="left" width="50%">Amount: '.$amount.'</th>
                <th align="left" width="50%">Date: '.$payment_date .'</th>
              </tr>
            </table>
            <table width="100%" class="border">
              <td align="center"><h3 class="margin_3">Mode of Payment</h3></td>
              <td align="center"><h3 class="margin_3">'.$payment_mode.'</h3></td>
            </table>

            <table width="100%" class="border">
              <tr>
                <td align="left">To: '.$reciver_name .'</td>
              </tr>
              <tr>
                <td align="left">Purpose: '.$purpose .'</td>
              </tr>
              <tr>
                <td align="left">The Sum of: '.$amount.'</td>
              </tr>
            </table>

            <table width="100%" class="border">
              <tr>
                <td align="left" valign="top" height="50px">Approved By: </td>
                <td align="left" valign="top" height="50px">Paid By: </td>
                <td align="left" valign="top" height="50px">Signature: </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </center>
  <script>
      function printPage(){
        $(".overlay").css("display", "none")
        $("body").css("overflow", "auto")
        window.print();
      }
    
      $(document).ready(function(){
        doPrintPage = setTimeout("printPage();", 2000);
      })
    </script>
</body>
</html>';
print_r($voucher_html);
}

    
    public function print_cheque($payment_id){
        is_institute_in();
        $where  = array('payment_id' => $payment_id );
        $checkLimit=$this->institute_model->getAllDataArray(TBL_PAYMENTS,$where);
        // echo '<pre>'; print_r($checkLimit); echo '</pre>';
        $payment_type     = $checkLimit[0]->payment_type;
        $paid_to_name     = $checkLimit[0]->paid_to_name;
        $paid_to_id     = $checkLimit[0]->paid_to_id;
        $purpose     = $checkLimit[0]->purpose;
        $payment_type     = $checkLimit[0]->payment_type;
        if ($payment_type == 1) {
          $agent_details = $this->get_vendor_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->vendor_name;
          
        }elseif ($payment_type == 2) {
          $agent_details = $this->institute_model->get_agent_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->agent_name;
        }elseif ($payment_type == 3) {
          $agent_details = $this->get_staff_by_id($paid_to_id);
          $reciver_name = $agent_details[0]->employee_name;
        }
        $amount           = $checkLimit[0]->amount;
        $amount_in_words  = $checkLimit[0]->amount_in_words;
        $payment_date     = str_split($checkLimit[0]->payment_date);
        if($payment_type==1){

               $where  = array('vendor_id' => $payment_id );
        $checkLimit=$this->institute_model->getAllDataArray(TBL_VENDOR,$where);
        }
       $cheque_html = '<!DOCTYPE html>
<html>  
<head>
<title></title>
<script src="'.base_url('assets/dashboard/libs/jquery/dist/jquery.min.js').'"></script>
<style type="text/css">
    
    @media print {
          footer {page-break-after: always;}
        }

        @page {
            size: auto;
            margin: 0;
        }
    .date_fh{
        display: inline-block;
        font-weight: 500;
        font-size: 16px;
        color: black;
    }

    .padding_top{
        margin-top: -15px;
    }

    .margin-top-5px{
        margin-top: 8px;
    }

    .toPat{
        font-weight: 500;
        font-size: 16px;
        padding-left: 40px;
        padding-bottom: 5px;
        color: black
    }

    .AmountInWords{
        padding-left: 80px;
        padding-bottom: 5px;
        color: black;
    }

    .amountInNumber{
        color: black;
        padding: 17px 0;
    }

    .margin-top30{
        margin-top: 35px;
    }
</style>
</head>
<body>
    <div class="padding_top">
        <table width="100%">
            <tr>
                <td width="70.5%"></td>
                <td width="29.5%">
                    <table width="100%">
                        <tr>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[0].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[1].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[3].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[4].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[6].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[7].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[8].'</td>
                            <td align="center" width="21px" class="date_fh">'.$payment_date[9].'</td>
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
        <table width="100%" class="margin-top30">
            <tr>
                <td class="toPat">'.$reciver_name.'</td>
            </tr>
        </table>

        <table width="100%" class="margin-top-5px">
            <tr>
                <td class="AmountInWords" valign="top" width="80%">'.$amount_in_words.'</td>
                <td align="left" width="20%">
                    <table width="100%">
                        <tr>
                            <td align="left" class="amountInNumber">'.$amount.'/-</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <script>
      function printPage(){
        $(".overlay").css("display", "none")
        $("body").css("overflow", "auto")
        window.print();
      }
    
      $(document).ready(function(){
        doPrintPage = setTimeout("printPage();", 2000);
      })
    </script>
</body>
</html>';

        print_r($cheque_html);
       
    }

    public function online_enqury_page_view($online_enquiry_id){            
        $where  = array('online_enquiry_id' => $online_enquiry_id );
        $checkLimit=$this->institute_model->getAllDataArray(TBL_ONLINE_ENQUIRY,$where);
        $institute_id = $checkLimit[0]->institute_id;
        $MyFile = file_get_contents(base_url()."institute/get_view/$institute_id/view");
        // echo $MyFile; die;
             // $new_str = str_replace('{_admisn_number_}',$checkLimit[0]->admmision_number,$MyFile) ;
             // $new_str = str_replace('{online_enquiry_id}',$checkLimit[0]->online_enquiry_id,$new_str) ;
             // $new_str = str_replace('{serial_number}',$checkLimit[0]->serial_number,$new_str) ;
             // $new_str = str_replace('{name}',$checkLimit[0]->name,$new_str) ;
             // $new_str = str_replace('{dob}',$checkLimit[0]->dob,$new_str) ;
             // $new_str = str_replace('{father_name}',$checkLimit[0]->father_name,$new_str) ;
             // $new_str = str_replace('{father_mo_number}',$checkLimit[0]->father_mo_number,$new_str) ;
             // $new_str = str_replace('{mothersname}',$checkLimit[0]->mothersname,$new_str) ;
             // $new_str = str_replace('{mother_mo_number}',$checkLimit[0]->mother_mo_number,$new_str) ;
             // $new_str = str_replace('{natianality}',$checkLimit[0]->natianality,$new_str) ;
             // $new_str = str_replace('{caste}',$checkLimit[0]->caste,$new_str) ;
             // $new_str = str_replace('{sex}',$checkLimit[0]->sex,$new_str) ;
             // $new_str = str_replace('{nationality_citizen}',$checkLimit[0]->nationality_citizen,$new_str) ;
             // $new_str = str_replace('{profileImage}',$checkLimit[0]->student_photo,$new_str) ;
             // $new_str = str_replace('{last_exam_pass}',$checkLimit[0]->last_exam_pass,$new_str) ;
             // $new_str = str_replace('{board_name}',$checkLimit[0]->board_name,$new_str) ;
             // $new_str = str_replace('{year_of_passing}',$checkLimit[0]->year_of_passing,$new_str) ;
             // $new_str = str_replace('{registration_no}',$checkLimit[0]->registration_no,$new_str) ;
             // $new_str = str_replace('{school_name_twelth}',$checkLimit[0]->school_name_twelth,$new_str) ;
             // $new_str = str_replace('{permanent_address}',$checkLimit[0]->permanent_address,$new_str) ;
             // $new_str = str_replace('{localaddress}',$checkLimit[0]->localaddress,$new_str) ;
             // $new_str = str_replace('{relation_with_student}',$checkLimit[0]->relation_with_student,$new_str) ;
             // $new_str = str_replace('{mob_number}',$checkLimit[0]->mob_number,$new_str) ;
             // $new_str = str_replace('{father_sign}',$checkLimit[0]->father_sign,$new_str) ;
             // $new_str = str_replace('{student_sign}',$checkLimit[0]->student_sign,$new_str) ;
             // $new_str = str_replace('{student_mobile_number}',$checkLimit[0]->student_mobile_number,$new_str) ;
             // $new_str = str_replace('{course_applied_for}',$checkLimit[0]->course_applied_for,$new_str) ;
             // $new_str = str_replace('{sub1}',$checkLimit[0]->sub1,$new_str) ;
             // $new_str = str_replace('{sub2}',$checkLimit[0]->sub2,$new_str) ;
             // $new_str = str_replace('{sub3}',$checkLimit[0]->sub3,$new_str) ;
             // $new_str = str_replace('{sub4}',$checkLimit[0]->sub4,$new_str) ;
             // $new_str = str_replace('{sub5}',$checkLimit[0]->sub5,$new_str) ;
             // $new_str = str_replace('{score1}',$checkLimit[0]->score1,$new_str) ;
             // $new_str = str_replace('{score2}',$checkLimit[0]->score2,$new_str) ;
             // $new_str = str_replace('{score3}',$checkLimit[0]->score3,$new_str) ;
             // $new_str = str_replace('{score4}',$checkLimit[0]->score4,$new_str) ;
             // $new_str = str_replace('{score5}',$checkLimit[0]->score5,$new_str) ;
             // $new_str = str_replace('{Tscore}',$checkLimit[0]->Tscore,$new_str) ;
             // $new_str = str_replace('{Pscore}',$checkLimit[0]->Pscore,$new_str) ;
             // echo '<pre>'; print_r($MyFile); echo '</pre>';
             // print_r($_SESSION); die;

           $stringarray =   array (
                        '{_admisn_number_}',
                        '{online_enquiry_id}',
                        '{serial_number}',
                        '{name}',
                        '{dob}',
                        '{father_name}',
                        '{father_mo_number}',
                        '{mothersname}',
                        '{mother_mo_number}',
                        '{natianality}',
                        '{caste}',
                        '{sex}',
                        '{nationality_citizen}',
                        '{profileImage}',
                        '{last_exam_pass}',
                        '{board_name}',
                        '{year_of_passing}',
                        '{registration_no}',
                        '{school_name_twelth}',
                        '{permanent_address}',
                        '{localaddress}',
                        '{relation_with_student}',
                        '{mob_number}',
                        '{father_sign}',
                        '{student_sign}',
                        '{student_mobile_number}',
                        '{course_applied_for}',
                        '{sub1}',
                        '{sub2}',
                        '{sub3}',
                        '{sub4}',
                        '{sub5}',
                        '{score1}',
                        '{score2}',
                        '{score3}',
                        '{score4}',
                        '{score5}',
                        '{Tscore}',
                        '{Pscore}',
                        '{admitted_by}',
                        '{admitted_by_number}',
                        '{varified_by}',
                        '{entered_by}'
                  );

            $replace_array = array(
                              $checkLimit[0]->admmision_number,
                              $checkLimit[0]->online_enquiry_id,
                              $checkLimit[0]->serial_number,
                              $checkLimit[0]->name,
                              $checkLimit[0]->dob,
                              $checkLimit[0]->father_name,
                              $checkLimit[0]->father_mo_number,
                              $checkLimit[0]->mothersname,
                              $checkLimit[0]->mother_mo_number,
                              $checkLimit[0]->natianality,
                              $checkLimit[0]->caste,
                              $checkLimit[0]->sex,
                              $checkLimit[0]->nationality_citizen,
                              $checkLimit[0]->student_photo,
                              $checkLimit[0]->last_exam_pass,
                              $checkLimit[0]->board_name,
                              $checkLimit[0]->year_of_passing,
                              $checkLimit[0]->registration_no,
                              $checkLimit[0]->school_name_twelth,
                              $checkLimit[0]->permanent_address,
                              $checkLimit[0]->localaddress,
                              $checkLimit[0]->relation_with_student,
                              $checkLimit[0]->mob_number,
                              $checkLimit[0]->father_sign,
                              $checkLimit[0]->student_sign,
                              $checkLimit[0]->student_mobile_number,
                              $checkLimit[0]->course_applied_for,
                              $checkLimit[0]->sub1,
                              $checkLimit[0]->sub2,
                              $checkLimit[0]->sub3,
                              $checkLimit[0]->sub4,
                              $checkLimit[0]->sub5,
                              $checkLimit[0]->score1,
                              $checkLimit[0]->score2,
                              $checkLimit[0]->score3,
                              $checkLimit[0]->score4,
                              $checkLimit[0]->score5,
                              $checkLimit[0]->Tscore,
                              $checkLimit[0]->Pscore,
                              $checkLimit[0]->admitted_by,
                              $checkLimit[0]->admitted_by_number,
                              $checkLimit[0]->varified_by,
                              $checkLimit[0]->entered_by
            );

             $new_str = str_replace($stringarray,$replace_array,$MyFile) ;
             echo $new_str;die;
            $this->pdf->loadHtml($new_str);
            $this->pdf->set_paper('A4', 'portrait');
            $this->pdf->render();
            $this->pdf->stream("$checkLimit[0]->name.pdf", array("Attachment"=>0));


            // echo $new_str;
    }


        public function edit_online_enquiry($online_enquiry_id){
            is_institute_in();
             $where  = array('online_enquiry_id' => $online_enquiry_id );
            $checkLimit=$this->institute_model->getAllDataArray(TBL_ONLINE_ENQUIRY,$where);
            // echo '<pre>'; print_r($checkLimit); echo '</pre>';
            $institute_id = $_SESSION['institute_id'];
             $MyFile = file_get_contents(base_url()."institute/get_view/$institute_id/edit");
           $stringarray =   array (
                        '{_admisn_number_}',
                        '{online_enquiry_id}',
                        '{serial_number}',
                        '{name}',
                        '{dob}',
                        '{father_name}',
                        '{father_mo_number}',
                        '{mothersname}',
                        '{mother_mo_number}',
                        '{natianality}',
                        '{caste}',
                        '{sex}',
                        '{nationality_citizen}',
                        '{student_photo}',
                        '{last_exam_pass}',
                        '{board_name}',
                        '{year_of_passing}',
                        '{registration_no}',
                        '{school_name_twelth}',
                        '{permanent_address}',
                        '{localaddress}',
                        '{relation_with_student}',
                        '{mob_number}',
                        '{father_sign}',
                        '{student_sign}',
                        '{student_mobile_number}',
                        '{course_applied_for}',
                        '{sub1}',
                        '{sub2}',
                        '{sub3}',
                        '{sub4}',
                        '{sub5}',
                        '{sub6}',
                        '{score1}',
                        '{score2}',
                        '{score3}',
                        '{score4}',
                        '{score5}',
                        '{score6}',
                        '{perc1}',
                        '{perc2}',
                        '{perc3}',
                        '{perc4}',
                        '{perc5}',
                        '{perc6}',
                        '{Tscore}',
                        '{Pscore}',
                        '{admitted_by}',
                        '{admitted_by_number}',
                        '{varified_by}',
                        '{entered_by}',
                        '{birth_place}',
                        '{extra_exam_total1}',
                        '{extra_exam_mark1}',
                        '{extra_exam_perc1}',
                        '{father_Profession}',
                        '{annual_income}',
                        '{twelfth_marks}',
                        '{tenth_marks}',
                        '{migration}',
                        '{admit_card}',
                        '{school_leaving}',
                        '{photograph}',
                        '{submission_date}',
                        '{submission_place}',
                        '{online_enquiry_id}'
                  );

            $replace_array = array(
                              $checkLimit[0]->admmision_number,
                              $checkLimit[0]->online_enquiry_id,
                              $checkLimit[0]->serial_number,
                              $checkLimit[0]->name,
                              $checkLimit[0]->dob,
                              $checkLimit[0]->father_name,
                              $checkLimit[0]->father_mo_number,
                              $checkLimit[0]->mothersname,
                              $checkLimit[0]->mother_mo_number,
                              $checkLimit[0]->natianality,
                              $checkLimit[0]->caste,
                              $checkLimit[0]->sex,
                              $checkLimit[0]->nationality_citizen,
                              $checkLimit[0]->student_photo,
                              $checkLimit[0]->last_exam_pass,
                              $checkLimit[0]->board_name,
                              $checkLimit[0]->year_of_passing,
                              $checkLimit[0]->registration_no,
                              $checkLimit[0]->school_name_twelth,
                              $checkLimit[0]->permanent_address,
                              $checkLimit[0]->localaddress,
                              $checkLimit[0]->relation_with_student,
                              $checkLimit[0]->mob_number,
                              $checkLimit[0]->father_sign,
                              $checkLimit[0]->student_sign,
                              $checkLimit[0]->student_mobile_number,
                              $checkLimit[0]->course_applied_for,
                              $checkLimit[0]->sub1,
                              $checkLimit[0]->sub2,
                              $checkLimit[0]->sub3,
                              $checkLimit[0]->sub4,
                              $checkLimit[0]->sub5,
                              $checkLimit[0]->sub6,
                              $checkLimit[0]->score1,
                              $checkLimit[0]->score2,
                              $checkLimit[0]->score3,
                              $checkLimit[0]->score4,
                              $checkLimit[0]->score5,
                              $checkLimit[0]->score6,
                              $checkLimit[0]->perc1,
                              $checkLimit[0]->perc2,
                              $checkLimit[0]->perc3,
                              $checkLimit[0]->perc4,
                              $checkLimit[0]->perc5,
                              $checkLimit[0]->perc6,
                              $checkLimit[0]->Tscore,
                              $checkLimit[0]->pscore,
                              $checkLimit[0]->admitted_by,
                              $checkLimit[0]->admitted_by_number,
                              $checkLimit[0]->varified_by,
                              $checkLimit[0]->entered_by,
                              $checkLimit[0]->birth_place,
                              $checkLimit[0]->extra_exam_total1,
                              $checkLimit[0]->extra_exam_mark1,
                              $checkLimit[0]->extra_exam_perc1,
                              $checkLimit[0]->father_Profession,
                              $checkLimit[0]->annual_income,
                              $checkLimit[0]->twelfth_marks,
                              $checkLimit[0]->tenth_marks,
                              $checkLimit[0]->migration,
                              $checkLimit[0]->admit_card,
                              $checkLimit[0]->school_leaving,
                              $checkLimit[0]->photograph,
                              $checkLimit[0]->submission_date,
                              $checkLimit[0]->submission_place,
                              $online_enquiry_id
              );

             $new_str = str_replace($stringarray,$replace_array,$MyFile) ;
             // echo '<pre>'; print_r($MyFile); echo '</pre>';
             // print_r($_SESSION); die;
            // $this->pdf->loadHtml($MyFile);
            // $this->pdf->set_paper('A4, 'portrait');
            // $this->pdf->render();
            // $this->pdf->stream("$title.pdf", array("Attachment"=>0));

            echo $new_str;
        }



        public function get_view($institute_id,$view){

            $where  = array('institute_id' => $institute_id );
            $checkLimit=$this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
        // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';die;
                if(!count($checkLimit)){
                    echo "Ivalid URL";
                }else{
                    $resiter_form_link = $checkLimit[0]->html_file_name_editable;
                    $this->load->view($resiter_form_link);
                }
        }



        public function print_loan_letter(){
            $student_id         = $_POST['student_id'];
            $year               = $_POST['year'];
            $Description        = $_POST['Description'];
            $amount             = $_POST['amount'];
            $amount_in_words    = $_POST['amount_in_words'];
            $Academic_Year      = $_POST['Academic_Year'];

            $institute_id = $_SESSION['institute_id'];
            $institute = $this->institute_model->fetchInstituteData($institute_id);
            $sub_institute_id = $student[0]->sub_institute_id;
            $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
            $where = array('student_id' => $student_id);   
            $student_details=$this->institute_model->getAllDataArray(TBL_STUDENT,$where);
            $address_array = explode( "," , $student_details[0]->address);
            ;
            $final_address =  "";
            for ($i=0; $i < count($address_array); $i++) { 

                $final_address =  $final_address." ".$address_array[$i]."<br>";
            }

            $current_date = date('d-m-Y');
           $title = $student_details[0]->full_name.' loan letter';
            $html = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>'.$title.'</title>
                    <style type="text/css">
                    
                    .main_div{
                      width:100%;
                      height:1000px;
                      
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
                        <div class="topLavelDiv">
                            <table width="100%">
                                <tr><td align="left" style="padding-left:20px">To,</td></tr>
                                <tr><td align="left" style="padding-left:20px">Bank Manager,</td></tr>
                            </table>
                            
                            <table width="100%">
                                <tr>
                                    <td style="text-align:center"><h3>SUB: <span>LOAN LETTER</span></h3></td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr><td class="p-t-60" align="left" style="padding-left:20px"><h4>Sir/Madam,</h4></td></tr>
                            </table>
                        </div>
                        <div class="secondLavelDive">
                            <table width="100%">
                                <tr>
                                    <td style="padding-right:12px">
                                      <p class="">This is to bring to your kind concern that <b>'. $student_details[0]->full_name.' S/D/W of '. $student_details[0]->s_w_d_of.' ,</b> student of <b>'.$_SESSION['name'].'</b> has to pay the <b>'.$Description.'</b> of <b>Rs. '.$amount.'-</b> (Rupees '.$amount_in_words.' Only) for the Academic year '.$Academic_Year.' .</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-t-30">
                                        <p class="SecondPa">Kindly sanction the loan as soon as possible.</p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="lastLavelDiv">
                            <table width="100%" style="padding-right:12px">
                    
                                <tr>
                                    <td class="p-t-30" align="right"><h4>PRINCIPAL</h4></td>
                                </tr>
                            </table>
                        </div>
                      </div>
                    </body>
                    </html>';


            $this->pdf->loadHtml($html);
            $this->pdf->set_paper('A4', 'portrait');
            $this->pdf->render();
            $this->pdf->stream("$title.pdf", array("Attachment"=>0));
        }

      public function print_bonafied_letter($student_id){
        $institute_id = $_SESSION['institute_id'];
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $city = $institute[0]->city;
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
        $fees_details = $this->institute_model->getAllDataArray('fees',$where);
        $tr_html = "";
        if(!empty($fees_details))
        {
          foreach($fees_details as $key=>$fee)
          {
            if($fee->yr_id == '1')
            {
              $yr = '1st';
            } else if($fee->yr_id == '2')
            {
              $yr = '2nd';
            } else if($fee->yr_id == '3')
            {
              $yr = '3rd';
            } else if($fee->yr_id == '4')
            {
              $yr = '4th';
            } else if($fee->yr_id == '5')
            {
              $yr = '5th';
            } 
            $tr_html .= '<tr>
              <th>'.$yr.' Year</th>
              <td>'.$fee->yearly_fee.'</td>
            </tr>';
          }
        } 
        $course_id = $student_details[0]->course_id;
        $course_detail = $this->db->query("SELECT course_discription FROM courses WHERE course_id = '".$course_id."' ")->row();
        $course_desc = $course_detail->course_discription;
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
                      height:1000px;
                      
                    }
                    .clg_header{
                      height:200px;
                      
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

                    .fees-table th{
                      border:1px solid #ccc;
                      font-weight:bold;
                      padding:4px;
                      text-align:center;
                    }
                    .fees-table td{
                      border:1px solid #ccc;
                      padding:4px;
                      text-align:center;
                    }
                    .name_box p{
                      padding:0;
                      margin:0;
                    }
                    .bank-table tr th{
                      text-align:left;
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
                        <center>BONAFIDE-CUM-EXPENDITURE CERTIFICATE</center>
                        
                        <p>This is to certify that Mr / Ms '.$student_details[0]->full_name.' S/o / D/o Mr. '.$student_details[0]->s_w_d_of.' is a bonafide student of '.$student_details[0]->stream.' 1st Year academic year of '.$academic_year.' in our institution. The course duration will be '.$student_details[0]->course_dur.' years (full Time). The above said course is affiliated to '.$course_desc.'. His/Her course duration will be '.$student_details[0]->course_dur.' Years (Full Time).</p>

                        <p>The expenditure statement for his/her studies is as follows:</p>

                        <table class="fees-table" style="width:100%;margin-top:10px">
                          <tr>
                            <th>Academic Year</th>
                            <th>Fees(Rs)</th>
                          </tr>'.$tr_html.'
                          <tr>
                            <th>Total Fees</th>
                            <td>'.$fees_details[0]->package.'</td>
                          </tr>
                          
                        </table>

                        <p>
                          Note: Uniform, Books, Stationary and Examination Fees Extra.
                        </p>

                        <table class="bank-table" style="width:100%;margin-top:10px">
                          <tr>
                            <td colspan="2"><u>The fees may be paid by Bank Transfer  /DD</u> </td>
                          </tr>
                          <tr>
                            <th>Benificiary Name</th>
                            <td>'.$institute[0]->beneficiary.'</td>
                          </tr>
                          <tr>
                            <th>Bank Name</th>
                            <td>'.$institute[0]->bank_name.'</td>
                          </tr>
                          <tr>
                            <th>Branch Name</th>
                            <td>'.$institute[0]->branch_name.'</td>
                          </tr>
                          <tr>
                            <th>Account No.</th>
                            <td>'.$institute[0]->account_no.'</td>
                          </tr>
                          <tr>
                            <th>IFSC Code</th>
                            <td>'.$institute[0]->ifsc_code.'</td>
                          </tr>
                        </table>
                        <p>
                          DD/Cheque should be in favour of '.$institute[0]->institute_name.', Payable at '.$city.' .
                        </p>
                      </div>

                      <table style="width:100%;margin-top:40px">
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

        public function fee_management()
        {
          $session = $this->session_check();
          if($session == true)
          {
            $data['menu'] = "fee_mgmt";
            $data['site_title'] = "EDUWEGO | student";  
            $this->load->view('dashboard-includes/header', $data);
            $this->load->view('dashboard-includes/left-sidebar');
            $this->load->view('fee-management');
            $this->load->view('dashboard-includes/footer');
          }
        }

      public function print_provisional_letter($student_id){
        $institute_id = $_SESSION['institute_id'];
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
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


      public function print_admission_letter($student_id){
        
        $institute_id = $_SESSION['institute_id'];
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $institute_name = $institute[0]->institute_name;
        $city = $institute[0]->city;
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
        $fees_details = $this->institute_model->getAllDataArray('fees',$where);
        $tr_html = "";
        if(!empty($fees_details))
        {
          foreach($fees_details as $key=>$fee)
          {
            if($fee->yr_id == '1')
            {
              $yr = '1st';
            } else if($fee->yr_id == '2')
            {
              $yr = '2nd';
            } else if($fee->yr_id == '3')
            {
              $yr = '3rd';
            } else if($fee->yr_id == '4')
            {
              $yr = '4th';
            } else if($fee->yr_id == '5')
            {
              $yr = '5th';
            } 
            $tr_html .= '<tr>
              <th>'.$yr.' Year</th>
              <td>'.$fee->yearly_fee.'</td>
            </tr>';
          }
        } 
        $current_year = date('Y');
        $academic_year = $current_year."-".($current_year+1);
        $title = $student_details[0]->full_name.' Admission Letter';
        $current_date = date('d-m-Y');
        $bona_letter_html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>Admission Letter -'.$institute_name.'</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:1000px;
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
                    
                    .fees-table th{
                      border:1px solid #ccc;
                      font-weight:bold;
                      padding:4px;
                      text-align:center;
                    }
                    .fees-table td{
                      border:1px solid #ccc;
                      padding:4px;
                      text-align:center;
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
                              <P>REF:</P>
                            </td>
                            <td>
                              <p>Date : '.$current_date.'</p>
                            </td>
                          </tr>
                        </table>
                        
                        <center>ADMISSION LETTER</center>
                        
                        <p style="text-align:justify">This is to certify that Mr / Ms '.$student_details[0]->full_name.' S /o / D/o '.$student_details[0]->s_w_d_of.' has been provisionally admitted to first year '.$student_details[0]->stream.' course at '.$institute_name.', during the academic year 2022-2023. The duration of course is '.$student_details[0]->course_dur.' years. </p>

                        <p>
                          His/Her admission is subjected to the condition that, the admission should be approved by the '.$institute[0]->affiliations.'. 
                        </p>
                          
                        <p>His/Her Fees Structure for the '.$student_details[0]->stream.' Course is as follows:</p>
                        <table class="fees-table" style="width:100%;margin-top:50px">
                          <tr>
                            <th>Academic Year</th>
                            <th>Fees(Rs)</th>
                          </tr>'.$tr_html.'
                          <tr>
                            <th>Total Fees</th>
                            <td>'.$fees_details[0]->package.'</td>
                          </tr>
                          <tr>
                            <td colspan="2" style="padding:12px">The approximate cost involved in the the '.$student_details[0]->stream.' programme is Rs '.$fees_details[0]->package.' Only
                            </td>
                          </tr>
                        </table>

                        <table style="width:100%;margin-top:70px;padding-left:100px">
                          <tr>
                            <td style="text-align:left">Place : '.$city.'</td>
                            <td style="text-align:right">PRINCIPAL/ADMISSION DIRECTOR<td>
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

      public function print_demand_letter($student_id){
        
        $institute_id = $_SESSION['institute_id'];
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $city = $institute[0]->city;
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
        $student_id = $student_details[0]->student_id; 
        $fees_details = $this->institute_model->getAllDataArray('fees',$where);
        $first_yr_fees = $fees_details[0]->yearly_fee;
        $first_yr_paid = $fees_details[0]->paid_amount;
        $first_yr_remain = $first_yr_fees-$first_yr_paid;
        $course_id = $student_details[0]->course_id;
        $course_detail = $this->db->query("SELECT course_discription FROM courses WHERE course_id = '".$course_id."' ")->row();
        $course_desc = $course_detail->course_discription;
        $first_yr = "";
        $tr_html = "";
        if(!empty($fees_details))
        {
          foreach($fees_details as $key=>$fee)
          {
            if($fee->yr_id == '1')
            {
              $yr = '1st';
              $first_yr = $fee->year."-".$fee->year_end;
            } else if($fee->yr_id == '2')
            {
              $yr = '2nd';
            } else if($fee->yr_id == '3')
            {
              $yr = '3rd';
            } else if($fee->yr_id == '4')
            {
              $yr = '4th';
            } else if($fee->yr_id == '5')
            {
              $yr = '5th';
            } 
            $tr_html .= '<tr>
              <th>'.$fee->year.'-'.$fee->year_end.'('.$yr.' Year)</th>
              <td>'.$fee->yearly_fee.'</td>
            </tr>';
          }
        } 
        $current_year = date('Y');
        $academic_year = $current_year."-".($current_year+1);
        $title = $student_details[0]->full_name.' Admission Letter';
        $current_date = date('d-m-Y');
        $bona_letter_html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>Demand Letter</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:1000px;
                      
                    }
                    .clg_header{
                      height:200px;
                      
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
                    
                    .fees-table th{
                      border:1px solid #ccc;
                      font-weight:bold;
                      padding:4px;
                      text-align:center;
                    }
                    .fees-table td{
                      border:1px solid #ccc;
                      padding:4px;
                      text-align:center;
                    }
                    .bank-table tr th{
                      text-align:left;
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
                              <P>REF:</P>
                            </td>
                            <td>
                              <p>Date : '.$current_date.'</p>
                            </td>
                          </tr>
                        </table>
                        
                        <center><h4>TO WHOMSOEVER IT MAY CONCERN</h4></center>
                        
                        <p style="margin-left:12px">This is to certify that Mr / Ms '.$student_details[0]->full_name.' S/o / D/o Mr. '.$student_details[0]->s_w_d_of.', a permanent resident of '.$student_details[0]->address.' is a bonafide student of '.$student_details[0]->stream.' 1st Year (academic year '.$first_yr.') in our institution. The course duration will be '.$student_details[0]->course_dur.' years (full Time). The above said course is affiliated to '.$course_desc.'. His/Her course duration will be '.$student_details[0]->course_dur.' Years (Full Time).</p>

                        <p>The expenditure statement for his/her studies is as follows:</p>
                        <table class="fees-table" style="width:100%;margin-top:50px">
                          <tr>
                            <th>Academic Year</th>
                            <th>Fees(Rs)</th>
                          </tr>'.$tr_html.'
                          <tr>
                            <th>Total Fees</th>
                            <td>'.$fees_details[0]->package.'</td>
                          </tr>
                        </table>

                        <p>I, the undersigned hereby affirm that the student is a full-time hosteller of our institution. :</p>

                        <p>Please arrange to pay the Balance amount of Rs. '.$first_yr_remain.'/-  being fees as per the break up given above, for the 1st Year '.$first_yr.' . Failure to pay fees before due date may render you ineligible for continuing the classes. Previous record of fees payment: '.$first_yr_paid.' </p>

                        <p>Note: The fees may be paid by Bank Transfer  /DD </p>

                        <table class="bank-table" style="width:100%;">
                          <tr>
                            <th>Benificiary Name</th>
                            <td>'.$institute[0]->beneficiary.'</td>
                          </tr>
                          <tr>
                            <th>Bank Name</th>
                            <td>'.$institute[0]->bank_name.'</td>
                          </tr>
                          <tr>
                            <th>Branch Name</th>
                            <td>'.$institute[0]->branch_name.'</td>
                          </tr>
                          <tr>
                            <th>Account No.</th>
                            <td>'.$institute[0]->account_no.'</td>
                          </tr>
                          <tr>
                            <th>IFSC Code</th>
                            <td>'.$institute[0]->ifsc_code.'</td>
                          </tr>
                        </table>

                        <p>DD/Cheque should be in favour of '.$institute[0]->institute_name.', Payable at '.$city.' .</p>

                        <table style="width:100%;margin-top:50px;padding-left:100px">
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

    public function print_placement_letter($student_id){
        
        $institute_id = $_SESSION['institute_id'];
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
        $fees_details = $this->institute_model->getAllDataArray('fees',$where);
        $course_id = $student_details[0]->course_id;
        $course_detail = $this->db->query("SELECT course_discription FROM courses WHERE course_id = '".$course_id."' ")->row();
        $course_desc = $course_detail->course_discription;
        $tr_html = "";
        if(!empty($fees_details))
        {
          foreach($fees_details as $key=>$fee)
          {
            if($fee->yr_id == '1')
            {
              $yr = '1st';
            } else if($fee->yr_id == '2')
            {
              $yr = '2nd';
            } else if($fee->yr_id == '3')
            {
              $yr = '3rd';
            } else if($fee->yr_id == '4')
            {
              $yr = '4th';
            } else if($fee->yr_id == '5')
            {
              $yr = '5th';
            } 
            $tr_html .= '<tr>
              <th>'.$yr.' Year</th>
              <td>'.$fee->yearly_fee.'</td>
            </tr>';
          }
        } 
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
                    
                    .fees-table th{
                      border:1px solid #ccc;
                      font-weight:bold;
                      padding:4px;
                      text-align:center;
                    }
                    .fees-table td{
                      border:1px solid #ccc;
                      padding:4px;
                      text-align:center;
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
                              <P>REF:</P>
                            </td>
                            <td>
                              <p>Date : '.$current_date.'</p>
                            </td>
                          </tr>
                        </table>
                        
                        <center><h4>TO WHOMSOEVER IT MAY CONCERN</h4></center>
                        
                        <p style="margin-left:12px">This is to certify that Mr / Ms '.$student_details[0]->full_name.' S/o / D/o Mr. '.$student_details[0]->s_w_d_of.', a permanent resident of '.$student_details[0]->address.' is a bonafide student of '.$student_details[0]->stream.' 1st Year (Batch 2021-22) in our institution. The course duration will be '.$student_details[0]->course_dur.' years (full Time). The above said course is affiliated to '.$course_desc.'. His/Her course duration will be '.$student_details[0]->course_dur.' Years (Full Time).</p>

                        <p>The expenditure statement for his/her studies is as follows:</p>
                        <table class="fees-table" style="width:100%;margin-top:50px">
                          <tr>
                            <th>Academic Year</th>
                            <th>Fees(Rs)</th>
                          </tr>'.$tr_html.'
                          <tr>
                            <th>Total Fees</th>
                            <td>'.$fees_details[0]->package.'</td>
                          </tr>
                        </table>

                        <table style="width:100%;margin-top:50px;padding-left:100px">
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

        public function print_bonafide_fees(){
          $student_id = $_GET['student_id'];
          $course_dur = $_GET['course_dur'];
          $hostel_fee = json_decode($_GET['hostel_fee']);
          $univ_fee = json_decode($_GET['univ_fee']);
          $clinical_fee = json_decode($_GET['clinical_fee']);
          $sports_fee = json_decode($_GET['sports_fee']);
          $misc_fee = json_decode($_GET['misc_fee']);

          $institute_id = $_SESSION['institute_id'];
          $institute = $this->institute_model->fetchInstituteData($institute_id);
          $tution_fees = $this->institute_model->getTutionFees($student_id);

          $sub_institute_id = $student[0]->sub_institute_id;
          $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

          $where = array('student_id' => $student_id);   
          $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
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
                      height:1000px;
                      
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
                        <center>BONAFIDE CERTIFICATE WITH FEES STRUCTURE</center>
                        <p style="margin-left:12px">This is to certify that <b>Mr./Mrs.'.$student_details[0]->full_name.' S/D/W of '.$student_details[0]->s_w_d_of.'</b> is a bonafide student of <b>'.$_SESSION["name"].'</b> studying in '.$student_details[0]->stream.' '.$student_details[0]->course.' during the academic year of '.$academic_year.' . This certificate is issued for the specific request of the said student for applying Scholarship.<br/> His/Her character and conduct is good. </p>

                        <div class="fee_details" style="">
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

                        <table style="width:100%;margin-top:40px">
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

        public function print_fees_structure(){
          $student_id = $_GET['student_id'];
          $course_dur = $_GET['course_dur'];
          $hostel_fee = json_decode($_GET['hostel_fee']);
          $univ_fee = json_decode($_GET['univ_fee']);
          $clinical_fee = json_decode($_GET['clinical_fee']);
          $sports_fee = json_decode($_GET['sports_fee']);
          $misc_fee = json_decode($_GET['misc_fee']);
          
          $institute_id = $_SESSION['institute_id'];
          $institute = $this->institute_model->fetchInstituteData($institute_id);
          $tution_fees = $this->institute_model->getTutionFees($student_id);

          $sub_institute_id = $student[0]->sub_institute_id;
          $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);

          $where = array('student_id' => $student_id);   
          $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
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
                      height:1000px;
                      
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

                        <div class="fee_details" style="">
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

                        <table style="width:100%;margin-top:40px">
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
        $institute = $this->institute_model->fetchInstituteData($institute_id);
        $sub_institute_id = $student[0]->sub_institute_id;
        $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
        $where = array('student_id' => $student_id);   
        $student_details = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
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
                      height:1000px;
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

       public function institute_forgot_password(){
            $email = $_POST['email'];
            $where = array('institute_email' => $email);   
            $assignments=$this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
            // echo '<pre>'; print_r($assignments); echo '</pre>';
            if(count($assignments)){                
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $new_pass =  substr(str_shuffle($permitted_chars), 0, 8);
                    $message = "<h3>Dear user, we have recieved your request to change your password.<br>Your new login password is ".$new_pass."</a></h3>";              
                    $url = "https://mail.zoho.com/api/accounts/6000000000293/messages";
                      $param = [  "fromAddress"=> $institute_email,
                                  "toAddress"=> $stu_email,
                                  "ccAddress"=> "",
                                  "bccAddress"=> "",
                                  "subject"=> $subject,
                                  "content"=> $message
                                ];
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
                        "subject":"NEW PASSWORD FOR EDUWEGO+ LOGIN",
                        "htmlbody":"<h3>Dear user, we have recieved your request to change your password.<br>Your new login password is - '.$new_pass.'</a></h3>",
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
                                "institute_password" => md5($new_pass)
                            );
                             $update = $this->institute_model->updateAllData(TBL_INSTITUTE,$where,$userData);
                             if($update)
                             {
                                echo json_encode(array('status'=>true, 'message'=>'Email with new password is sent to your registered Mail ID'));die;
                             }
                        }
                      
                     
            }else{
                    echo json_encode(array('status'=>false, 'message'=>'User with this email not found..'));die;
            }
        }

     public function staff_forgot_password(){
            $email = $_POST['email'];
            $where = array('employee_email' => $email);   
            $assignments=$this->institute_model->getAllDataArray('staff',$where);
            
            if(count($assignments)){                
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $new_pass =  substr(str_shuffle($permitted_chars), 0, 8);
                    $message = "<h3>Dear user, we have recieved your request to change your password.<br>Your new login password is ".$new_pass."</a></h3>";              
                      
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
                        "subject":"NEW PASSWORD FOR EDUWEGO+ LOGIN",
                        "htmlbody":"<h3>Dear user, we have recieved your request to change your password.<br>Your new login password is - '.$new_pass.'</a></h3>",
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
                                "emp_password" => md5($new_pass)
                            );
                             $update = $this->institute_model->updateAllData('staff',$where,$userData);
                             if($update)
                             {
                                echo json_encode(array('status'=>true, 'message'=>'Email with new password is sent to your registered Mail ID'));die;
                             }
                        }
                      
                     
            }else{
                    echo json_encode(array('status'=>false, 'message'=>'User with this email not found..'));die;
            }
      }
    
    public function sendIndivisualMess(){
       
       $message = $_POST['content'];
       $numbers = $_POST['sendSMS'];
       //$msg_api_username = $_SESSION['msg_api_username'];
       //$msg_api_password = $_SESSION['msg_api_password'];
  
            for ($i=0; $i < count($numbers) ; $i++) { 
                $mobile = "+91 ".$numbers[$i];

                //Your authentication key
                  //$authKey = "361699AJg8HtwbaH60b60e59P1";

                  //Multiple mobiles numbers separated by comma
                  $mobileNumber = $mobile;

                  //Sender ID,While using route4 sender id should be 6 characters long.
                  $senderId = "EDUWEG";

                  //Your message to send, Add URL encoding here.
                  $message = urlencode($message);

                  //Define route 
                  $route = "default";
                  //Prepare you post parameters
                  $postData = array(
                      'authkey' => $authKey,
                      'mobiles' => $mobileNumber,
                      'message' => $message,
                      'sender' => $senderId,
                      'route' => $route
                  );

                  //API URL
                  $url="http://api.msg91.com/api/sendhttp.php";

                  // init the resource
                  $ch = curl_init();
                  curl_setopt_array($ch, array(
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_POST => true,
                      CURLOPT_POSTFIELDS => $postData
                      //,CURLOPT_FOLLOWLOCATION => true
                  ));


                  //Ignore SSL certificate verification
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                  //get response
                  $output = curl_exec($ch);

                  //Print error if any
                  if(curl_errno($ch))
                  {
                      echo 'error:' . curl_error($ch);
                  }

                  curl_close($ch);

                echo $output;
                // if($output)
                // {
                //   echo json_encode(array('status'=>true, 'message'=>'Message Sent successfully'));die;
                // }
                // else{
                //   echo json_encode(array('status'=>false, 'errormessage'=>'Message Send Failed !'));die;
                // }
            }

            
             
            // return 1;
       
    }
    
    // public function sendIndivisualMess(){
       
    //    $message = $_POST['content'];
    //    $numbers = $_POST['sendSMS'];
    //    $msg_api_username = $_SESSION['msg_api_username'];
    //    $msg_api_password = $_SESSION['msg_api_password'];

    //         $message = urlencode($message);
    //         for ($i=0; $i < count($numbers) ; $i++) { 
    //             $mobile =$numbers[$i];
    //             $variable = 'http://198.24.149.4/API/pushsms.aspx?loginID='.$msg_api_username.'&password='.$msg_api_password.'&mobile='.$mobile.'&text='.$message.'&senderid=VIPRAA&route_id=2&Unicode=0';
    //             $request='loginID=appvipra&password=123456789&mobile='.$mobile.'&text='.$message.'&senderid=VIPRAA&route_id=2&Unicode=0';
    //             $ch = curl_init($variable);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    //             $resuponce=curl_exec($ch);
    //             // echo '<pre>'; print_r($resuponce); echo '</pre>';die;
    //             curl_close($ch);
    //         }

    //         echo json_encode(array('status'=>true, 'message'=>'Message Sent'));die;
             
    //         // return 1;
       
    // }
    
    // public function convertStudent(){
    //     $online_enq_id = $_POST['enquiry_id'];
    //     $mobile = $_POST['mobile'];
    //     $institute_id = $_SESSION['institute_id'];
        
    //     $check_mobile = $this->institute_model->checkMobile($institute_id,$mobile); 
    //     if($check_mobile)
    //     {
    //       $where  = array('online_enquiry_id' => $online_enq_id );
    //       $checkLimit=$this->institute_model->getAllDataArray(TBL_ONLINE_ENQUIRY,$where);
    //       echo '<pre>'; print_r($checkLimit); echo '</pre>';
    //       $student_date = array(
    //                       'full_name'        => $checkLimit[0]->name,
    //                       's_w_d_of'         => $checkLimit[0]->father_name,
    //                       'mother_name'      => $checkLimit[0]->mothersname,
    //                       'dob'              => $checkLimit[0]->dob,
    //                       'gender'           => $checkLimit[0]->sex,
    //                       'course'           => $checkLimit[0]->course_applied_for,
    //                       'yoa'              => date("Y"),
    //                       'mobile'           => $checkLimit[0]->student_mobile_number,
    //                       'email'            => $checkLimit[0]->name,
    //                       'address'          => $checkLimit[0]->permanent_address,
    //                       'student_photo'    => $checkLimit[0]->student_photo,
    //                       'student_status'   => 1,
    //                       'institute_id'     => $institute_id
    //                       );

    //       $status=$this->institute_model->insertData(TBL_STUDENT,$student_date);
    //       if ($status) {
    //       echo '<pre>'; print_r($this->db->insert_id()); echo '</pre>';
    //       $insert_array = array('online_enquiry_status' => 2 );
    //       $checkLimit = $this->institute_model->updateAllData(TBL_ONLINE_ENQUIRY,$where,$insert_array);
    //       redirect(base_url('institute/online_enquiries'));
    //       }
    //     }
    //     else{
    //       echo json_encode(array('status'=>false, 'errormessage'=>'Mobile number allready exists.Kindly chnage the number'));die;
    //     }

    // }


    public function delete_student(){
        is_institute_in();
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $student_id = $deleteArr[$i];
                $userData = array(
                        "student_status" => 9
                    );
                // $status = $this->institute_model->updateAllData(TBL_STUDENT,array('student_id'=>$student_id),$userData);
                $status = $this->institute_model->deleteStudent($student_id);
            }

            echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    public function delete_announcment(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $student_id = $deleteArr[$i];
                $userData = array(
                        "announcment_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_ANNOUNCEMENT,array('announcment_id'=>$student_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    public function delete_vendor(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $vendor_id = $deleteArr[$i];
                $userData = array(
                        "vendor_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_VENDOR,array('vendor_id'=>$vendor_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_online_enquiry(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $online_enquiry_id = $deleteArr[$i];
                $this->db->query("DELETE FROM online_enquiry WHERE online_enquiry_id = '".$online_enquiry_id."' ");
            }

            echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_enquiry(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $enquiry_id = $deleteArr[$i];
                $userData = array(
                        "enquiry_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_ENQUIRY,array('enquiry_id'=>$enquiry_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_course(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $course_id = $deleteArr[$i];
                $userData = array(
                        "course_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_COURSES,array('course_id'=>$course_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_agent(){
        is_institute_in();
        if(isset($_POST) && !empty($_POST)){
            $agent_id = $_POST['agent_id'];
            $institute_id = $_POST['institute_id'];
            if($agent_id != "")
            {
              $status = $this->institute_model->deleteData('agents','agent_id',$agent_id);
                $this->db->query("DELETE FROM agents_institutes WHERE agent_id = '".$agent_id."' AND institute_id = '".$institute_id."' ");
                echo json_encode(array('status'=>true, 'message'=>'Deletion Successful !'));die;
              }else{
                echo json_encode(array('status'=>false, 'message'=>'Deletion Failed !'));die;
              }
                
            
        }
    }

    
    public function delete_subagent(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $sub_agent_id = $deleteArr[$i];
                $userData = array(
                        "sub_agent_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_SUB_AGENTS,array('sub_agent_id'=>$sub_agent_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_stream(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $stream_id = $deleteArr[$i];
                $userData = array(
                        "stream_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_STREAM,array('stream_id'=>$stream_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    
    public function delete_staff(){
        is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $employee_id = $deleteArr[$i];
                $userData = array(
                        "employee_status" => 9
                    );
                $status = $this->institute_model->updateAllData(TBL_STAFF,array('employee_id'=>$employee_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }


    
    public function agent(){
      if($_SESSION['is_institute_in'] == true || $_SESSION['is_staff_in'] == true)
      {
        $data['menu'] = 'agent';
        $data ['submenu'] = 'agent_list';
        $data['site_title'] = "EDUWEGO | agent";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('agent');
        $this->load->view('dashboard-includes/footer');
      }
        
    }

    public function agent_profile($agent_id)
    {
      $institute_id = $_SESSION['institute_id'];
      $where = array('agent_id'=>$agent_id,'institute_id'=>$institute_id);
      $where1 = array('agent_name'=>$agent_id,'institute_id'=>$institute_id,'student_status'=>'1');
      $where2 = array('agent_id'=>$agent_id,'institute_id'=>$institute_id,'sub_agent_status'=>'1');
      $data['profile'] = $this->institute_model->getAllDataArray("agents",$where);
      $data['no_of_students'] = $this->institute_model->getStudentsNumbers('students',$where1);
      $data['sub_associates'] = $this->institute_model->getSubAssociates('sub_agents',$where2);
      $data['received_amounts'] = $this->institute_model->receivedAmountByAgent($agent_id);

      $where  = array('institute_id' => $institute_id , 'course_status' => '1');
      $courses = $this->institute_model->getAllDataArray(TBL_COURSES,$where);

      $tbody_html = "";
      
        $sl = 1;
        foreach($courses as $course)
        {
            $total = 0;
            $due = 0;
            $expected = 0;
            $course_id = $course->course_id;
            $number_students = $this->institute_model->getNumberStudents($course_id,$institute_id,$agent_id);
            $tbody_html .= '
              <tr>
                <td>'.$sl++.'</td>
                <td class="text-capitalize">'.$course->course_name.'</td>
                <td class="text-capitalize students_number">'.$number_students.'</td>
              </tr>
            ';    
        }

      $data['course_wise_students'] = $tbody_html;
      $data['site_title'] = "EDUWEGO | Agent Profile";  
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('agent_profile');
      $this->load->view('dashboard-includes/footer');
    }

    public function online_enqury_page($_id){
        is_institute_in();
        $data['site_title'] = "EDUWEGO | Online Enquiry Page";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('enquiry-new');
        $this->load->view('dashboard-includes/footer');

    }
    public function online_application_page(){
        is_institute_in();
        $data['site_title'] = "EDUWEGO | Online Enquiry Page";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('online-aaplication-page');
        $this->load->view('dashboard-includes/footer');

    }

    public function our_institutes()
    {
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | Our Institutes";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('institute_list');
        $this->load->view('dashboard-includes/footer');
      }
    }

     public function subagent(){
        $session = $this->session_check();
        if($session == true)
        {
          $data['menu'] = 'agent';
          $data['submenu'] = 'subagent';
          $data['site_title'] = "EDUWEGO | subagent";  
          $this->load->view('dashboard-includes/header', $data);
          $this->load->view('dashboard-includes/left-sidebar');
          $this->load->view('subagent');
          $this->load->view('dashboard-includes/footer');
        }
    }
    public function courses(){
        $session = $this->session_check();
        if($session == true)
        {
          $data['menu'] = "admission";
          $data['submenu'] = "courses";
          $data['site_title'] = "EDUWEGO | courses";  
          $this->load->view('dashboard-includes/header', $data);
          $this->load->view('dashboard-includes/left-sidebar');
          $this->load->view('courses');
          $this->load->view('dashboard-includes/footer');
        }

    }

    public function sendMail(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | Send Mail";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('send-mail');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function stream(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'stream';
        $data['site_title'] = "EDUWEGO | stream";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('stream');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function student(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = "students";
        $data['site_title'] = "EDUWEGO | student";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('student');
        $this->load->view('dashboard-includes/footer');
      }
    } 

    public function student_list_download()
    {
      $year = $_GET['year'];
      $course = $_GET['course'];
      $stream = $_GET['stream'];
      $agent = $_GET['agent'];
      $students = $this->institute_model->get_students_by_filter($year,$course,$stream,$agent);

       $filename = 'Students_'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       
       // file creation 
       $file = fopen('php://output', 'w');
     
       $header = array("Student Code","Student Name","Mobile","Stream","Course","YOA","Agent Name","Package");
       fputcsv($file, $header);
       foreach ($students as $key=>$line){ 
         fputcsv($file,$line); 
       }
       fclose($file); 
       exit;
    }

    public function cheque(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | cheque";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('cheque');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function new_cheque(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | cheque";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('new_cheque');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function announcement(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | Announcement";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('announcement');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function staff(){
        is_institute_in();
        $data['menu'] = 'staff';
        $data['submenu'] = 'addstaff';
        $data['site_title'] = "EDUWEGO | staff";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('staff');
        $this->load->view('dashboard-includes/footer');
    }

    // public function add_notice(){
    //     $session = $this->session_check();
    //     if($session == true)
    //     {
    //       $data['site_title'] = "ZEQON | Notices";  
    //       $this->load->view('dashboard-includes/header', $data);
    //       $this->load->view('dashboard-includes/left-sidebar');
    //       $this->load->view('announcement');
    //       $this->load->view('dashboard-includes/footer');
    //     }

    // }

  public function payments($payment_type){
    // echo '<pre>'; print_r($payment_type); echo '</pre>';
      $session = $this->session_check();
      if($session == true)
      {
        $data['payment_type'] = $payment_type; 
        $payments = array(); 
        $institute_id = $_SESSION['institute_id'];
        switch ($payment_type) {
            case '1':
                $paid_to = $this->institute_model->getAllActiveVendors();
                $paid_to_name_display = "Vendor";
                $query = "SELECT `payments`.*,`vendors`.vendor_name AS reciver_name  FROM `payments` LEFT JOIN `vendors` ON `vendors`.vendor_id = `payments`.paid_to_id WHERE `payments`.payment_type=1 AND `payments`.institute_id= $institute_id";
                $run = $this->db->query($query);
                $payments = $run->result();
                break;
            
            case '2':
                $paid_to = $this->institute_model->getAllActiveAgents();
                $paid_to_name_display = "Agent";
                $query = "SELECT `payments`.*,`agents`.agent_name AS reciver_name  FROM `payments` LEFT JOIN `agents` ON `agents`.agent_id = `payments`.paid_to_id WHERE `payments`.payment_type=2 AND `payments`.institute_id= $institute_id";
                $run = $this->db->query($query);
                $payments = $run->result();
                break;
            
            case '3':
                $paid_to = $this->institute_model->getAllActiveStaff();
                $paid_to_name_display = "Staff";
                $paid_to_name_display = "Staff";
               $query = "SELECT `payments`.*,`staff`.employee_name AS reciver_name  FROM `payments` LEFT JOIN `staff` ON `staff`.employee_id = `payments`.paid_to_id WHERE `payments`.payment_type=3 AND `payments`.institute_id= $institute_id";
                $run = $this->db->query($query);
                $payments = $run->result();
                break;
        }

        $data['menu']   = 'agent';
        $data['submenu']   = 'agentPayments';
        $data['payments']   = $payments;  
        $data['paid_to']   = $paid_to;  
        $data['payment_type']   = $payment_type;  
        $data['paid_to_name_display']   = $paid_to_name_display;  
        $data['site_title'] = "EDUWEGO | payments";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('payments');
        $this->load->view('dashboard-includes/footer');
      }
    }
    
    public function enquiry(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'admission';
        $data['submenu'] = 'enquiry';
        $data['site_title'] = "EDUWEGO | enquiry";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('enquiry');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function admission_letter(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | enquiry"; 
        $this->load->view('admission-letter.html');
      }
    }


    public function enquiryNew(){
        // $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
        // $where  = array('subdomain' => $subdomain_arr[0] );
        $subdomain = $this->uri->segment(2);
        $where  = array('subdomain' => $subdomain );
        $checkLimit = $this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
    
        if(!count($checkLimit)){
          echo "Invalid URL !";
          // if($subdomain_arr[0] == "apps"){
          //     redirect("login");
          // }else{
          //     echo "Ivalid URL";
          // }
        }else{
          $resiter_form_link = $checkLimit[0]->html_file_name;
          $data['institute'] = $checkLimit;
          $this->load->view($resiter_form_link,$data);
        }
    }

    public function signupForm(){
        //$subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
        $subdomain = $this->uri->segment(2);
        $where  = array('subdomain' => $subdomain );
        $checkLimit = $this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
        $institute_id = $checkLimit[0]->institute_id;

        $where1 = array('institute_id'=>$institute_id,'banner_type'=>'Enquiry');
        $data['enquiry_banner'] = $this->institute_model->getById('banner',$where1);
        //print_r($data['enquiry_banner']);exit;
          if(!count($checkLimit)){
            echo "Institute Not Found !";
            // if($subdomain_arr[0] == "apps"){
            //     redirect("login");
            // }else{
            //     echo "Ivalid URL";
            // }
            }else{
                $institute_id = $checkLimit[0]->institute_id;
                $where_course = array('institute_id' => $institute_id,'course_status'=>'1');
                $data['courses'] = $this->institute_model->getAllDataArray('courses',$where_course);
                $data['states'] = $this->db->query("SELECT name,id FROM states WHERE country_id = '101' ")->result();
                // $where_stream = array('institute_id' => $institute_id,'stream_status'=>'1');
                // $data['streams'] = $this->institute_model->getAllDataArray('streams',$where_stream);
                $data['institute'] = $checkLimit;
                  $this->load->view('signupForm',$data);
            }
    }

    public function getStreamsByCourse()
    {
      $this->session_check();
      if(isset($_POST['institute_id']))
      {
        $institute_id = $_POST['institute_id'];
      }else if(isset($_SESSION['institute_id'])){
        $institute_id = $_SESSION['institute_id'];
      }
      $course_id = $_POST['course_id'];
      
      $streams = $this->db->query("SELECT * FROM streams WHERE institute_id = '".$institute_id."' AND course = '".$course_id."' AND stream_status = 1 ")->result();

      $html = "";
      if(!empty($streams))
      {
        foreach($streams as $key=>$s)
        {
          $html .= '<option value="'.$s->stream_name.'" stream_id="'.$s->stream_id.'">'.$s->stream_name.'</option>'; 
        }
      } else{
        $html .= '<option value="">No Stream Found</option>';
      }

      echo $html;
    }

    public function studentSignup()
    {
      date_default_timezone_set("Asia/Kolkata");
      $this->form_validation->set_rules('student_name','Student Name','required');
      $this->form_validation->set_rules('father','Father Name','required');
      $this->form_validation->set_rules('mobile','Mobile','required|exact_length[10]');
      $this->form_validation->set_rules('course','Course','required');
      $this->form_validation->set_rules('stream','Stream','required');
      $this->form_validation->set_rules('state_name','State','required');
      $this->form_validation->set_rules('city','City','required');
      if($this->form_validation->run())
      {
        if($this->session->userdata('institute_id'))
        {
          $institute_id = $this->session->userdata('institute_id');
        }else if(isset($_POST['institute_id']))
        {
          $institute_id = $this->security->xss_clean($_POST['institute_id']);
        }

        $institute_details = $this->db->query("SELECT institute_name,institute_email,institute_mobile,institute_address,institute_website,state,institute_logo,payment_api_key,admission_fee,brochure_link,subdomain FROM institute WHERE institute_id = '".$institute_id."' ")->row();
        $payment_link = $institute_details->payment_api_key;
        $brochure_link = $institute_details->brochure_link;
        $admission_link = base_url().'online-admission/'.$institute_details->subdomain;
        $admission_fee = $institute_details->admission_fee;
        $institute_email = $institute_details->institute_email;
        $institute_name = $institute_details->institute_name;
        $institute_mobile = $institute_details->institute_mobile;
        $institute_address = $institute_details->institute_address;
        $institute_website = $institute_details->institute_website;
        $institute_state = $institute_details->state;
        $institute_logo = $institute_details->institute_logo;
        $student_email = $this->security->xss_clean($_POST['email']);
        $student_mobile = $this->security->xss_clean($_POST['mobile']);
        $student_name = $this->security->xss_clean($_POST['student_name']);
        $father_name = $this->security->xss_clean($_POST['father']);
        $stream = $this->security->xss_clean($_POST['stream']);
        $course_name = $this->security->xss_clean($_POST['course_name']);
        $course = $this->security->xss_clean($_POST['course']);
        $state_name = $this->security->xss_clean($_POST['state_name']);
        $city = $this->security->xss_clean($_POST['city']);
        $insert_data = array(
          'student_name' => $student_name,
          'father_name' =>$father_name,
          'email' => $student_email,
          'mobile' => $student_mobile,
          'course' => $course_name,
          'stream' => $stream,
          'state' => $state_name,
          'city' => $city,
          'institute_id' => $institute_id,
          'created_at' => date('Y-m-d H:i:s')
        );
        
        $status = $this->institute_model->insertLeads($insert_data);
        if($status){
            // Save data for notification
            $notice_msg = 'New enquiry from '.$student_name.' for '.$course_name;
            $url = base_url().'institute/leads_page';
            $notice_data = array(
              'institute_id'=>$institute_id,
              'msg'=>$notice_msg,
              'url'=>$url,
              'type'=>'Enquiry',
              'created_at'=>date('Y-m-d H:i:s')
            );
            $this->institute_model->insertData('notifications',$notice_data);

            //send mail to student          
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
              "from": { "address": "admission@eduwego.in"},
              "to": [{"email_address": {"address": '.$student_email.',"name": '.$student_name.'}}],
              "subject":"Enquiry for your admission in '.$institute_name.' is successfull.",
              "htmlbody":"<div>Dear '.$student_name.' <br/><br/> Thank you for signup on our website and showing interest in '.$institute_name.' for admission.<br/></br/><br/> Your application has been received and hence we need a few more details to proceed further. Please share the below mentioned documents & details through email '.$institute_email.' and WhatsApp on: '.$institute_mobile.'  and make the online payment of INR '.$admission_fee.'/-<br/><br/> Your admission fees through the link '.$payment_link.' given which will be adjusted in Fee Package of your '.$stream.' Course.<br/><br/>Our Student On boarding team will share the admission letter and confirmation of the admission once your profile is completed. Documents & details required.<ol><li>10th/12th Marksheet </li><li>10th/12th Admit card </li><li>Photo </li><li>Aadhaar </li><li>Your mobile number </li><li>Parents mobile number </li></ol>You can view or download the brochure Link : '.$brochure_link.' to View Brochure .Keeping in mind the limited seats available for the program, we encourage you to fill in your application to consider your candidature for the program. Online Appliation Link : '.$admission_link.' .<br/><br/>This is System Generated Email, Please do not reply to this mail, To continue the conversation click here '.$institute_email.' to reply.<br/><br/>Thanks & Regards Online Admissions Team<br/>'.$institute_name.'<br/>'.$institute_address.'<br/>'.$institute_state.'<br/><br/>DISCLAIMER:<br/>This communication is confidential and privileged and is directed to and for the use of the addresses only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized. If you are not the intended recipient, please notify the sender by return email and immediately destroy all copies of this message and any attachments and delete it from your computer system permanently. The recipient acknowledges that Zeqon Technologies Private Limited may be unable to exercise control or ensure or guarantee the integrity of the text of the email message and the text is not warranted as to completeness and accuracy. Before opening and accessing the attachment, if any, please check and scan for virus.</div>",
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
              echo json_encode(array('status'=>false, 'message'=>'Enquiry Submitted successfully !'));die;
          } else { 
            //Account details
            $apiKey = urlencode('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
            // Message details
            $mobile = "91".$student_mobile;
            $numbers = array($mobile);
            $sender = urlencode('EDUWEG');
            
            // $message = rawurlencode('Dear '.$student_name.' Thanks For Showing Interest in '.$stream.' in '.$institute_name.' Please call us on '.$institute_mobile.' for More Details regarding your admission. Thanks Eduwego');
            
             $post = array('campaignName' =>'signup-leads', 'destination'=> $mobile,'userName'=>$student_name,'templateParams'=>array($student_name,$stream,$institute_name,$institute_mobile,$institute_name),'apiKey' =>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
            $json = json_encode($post);
            $url = 'https://backend.aisensy.com/campaign/t1/api/v2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            // echo json_encode(array('status'=>true, 'message'=>'Sent Successfull'));
             
            // $numbers = implode(',', $numbers);
             
            // // Prepare data for POST request
            // $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
            // // Send the POST request with cURL
            // $ch = curl_init('https://api.textlocal.in/send/');
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            // curl_close($ch);

            if($this->session->userdata('institute_id'))
            {
              echo json_encode(array('status'=>true, 'message'=>'Lead added successfull !'));die;
            }else if(isset($_POST['institute_id']))
            {
              echo json_encode(array('status'=>true, 'message'=>'Enquiry Submitted successfully . Please check your email inbox/junk/spam folder for more details.'));die;
            }
            
          }

        }
          
      }
      else{
        $errors = validation_errors();
        echo json_encode(array('status'=>'valid-error', 'message'=>$errors));die;
      }
     
    }

    public function leads_page()
    {
      $session = $this->session_check();
      if($session == true)
      {
         
        $institute_id = $_SESSION['institute_id'];
        $max_leads = $this->db->query("SELECT leads_allowed FROM institute WHERE institute_id = '".$institute_id."' ")->row();
        $leads_number = $max_leads->leads_allowed;
        $where = array('institute_id'=>$institute_id);
        $data['staffs'] = $this->institute_model->getAllDataArray('staff',$where);
        $where_course = array('institute_id' => $institute_id,'course_status'=>'1');
        $data['courses'] = $this->institute_model->getAllDataArray('courses',$where_course);
        $data['states'] = $this->db->query("SELECT name,id FROM states WHERE country_id = '101' ")->result(); 
        if($_SESSION['is_institute_in'])
        {
          $data['leads'] = $this->institute_model->getAllLeads($institute_id,$leads_number);
        }else if($_SESSION['is_staff_in'])
        {
          $emp_id = $_SESSION['employee_id'];
          $data['leads'] = $this->db->query("SELECT * FROM leads WHERE assign_to = '".$emp_id."' ORDER BY id DESC  ")->result();
        }
        $data['importleads'] = $this->institute_model->getAllImportLeads($institute_id);
        $data['site_title'] = "EDUWEGO | Leads";
        $data['menu'] = 'leads';

        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('leads');
        $this->load->view('dashboard-includes/footer');
      }
    }


    public function leadAssign()
    {
      $emp_id = $_POST['emp_id'];
      $lead_id = $_POST['lead_id'];
      $where = array('id'=>$lead_id);
      $data = array('assign_to'=>$emp_id);
      if($this->institute_model->updateAllData('leads',$where,$data))
      {
        $msg = 'New lead assign to you. Check Now';
        $url = base_url().'institute/leads_page';
        $notice_data = array(
          'staff_id'=>$emp_id,
          'msg'=>$msg,
          'url'=>$url,
          'created_at'=>date('Y-m-d H:i:s')
        );
        $this->institute_model->insertData('notifications',$notice_data);

        echo json_encode(array('status'=>true, 'message'=>'Lead Assigned Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to assign lead !'));die;
      }

    }

    public function saveLeadSource()
    {
      $lead_id = $_POST['lead_id'];
      $lead_src = $_POST['lead_src'];
      $data = array(
        'lead_src'=>$lead_src,
      );
      $where =array('id'=>$lead_id);
      if($this->institute_model->updateAllData('leads',$where,$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Data updated Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Data updation failed !'));die;
      }

    }

    public function saveLeadType()
    {
      $lead_id = $_POST['lead_id'];
      $lead_type = $_POST['lead_type'];
      $data = array(
        'lead_type'=>$lead_type,
      );
      $where =array('id'=>$lead_id);
      if($this->institute_model->updateAllData('leads',$where,$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Data updated Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Data updation failed !'));die;
      }

    }

    public function cityByState()
    {
      $state_id = $_POST['state_id'];
      $cities = $this->db->query("SELECT name FROM cities WHERE state_id = '".$state_id."' ")->result();
      $html = "";
      if(!empty($cities))
      {
        foreach($cities as $city)
        {
          $html .= '<option value="'.$city->name.'">'.$city->name.'</option>';
        }
      }else{
        $html .= "No City Found !";
      }

      echo $html;
    }

    public function updateLeadStatus()
    {
      if(isset($_SESSION['institute_id']))
      {
        $status = $_GET['status'];
        $lead_id = base64_decode($_GET['leadId']);
        $institute_id = $_SESSION['institute_id'];
        $where = array('id'=>$lead_id,'institute_id'=>$institute_id);
        $data = array('contacted_medium'=>$status);
        if($this->institute_model->updateAllData('leads',$where,$data))
        {
          $this->session->set_flashdata('statusSuccess','Status Updated Successfully !');
        } else{
          $this->session->set_flashdata('statusError','Status Update Failed !');
        }

        redirect(base_url().'institute/leads_page','refresh');
      }
      
    }

    public function exportLeads()
    {
       $this->session_check();
       $time_frame = $_GET['time_frame'];
       $selected_date = $_GET['selected_date'];
       $leads = $this->institute_model->getLeadsByDays($time_frame,$selected_date);
       $filename = 'Leads_'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       
       // file creation 
       $file = fopen('php://output', 'w');
     
       $header = array("Date","Student Name","Father Name","Mobile","Course","Stream","Status"); 
       fputcsv($file, $header);
       foreach ($leads as $key=>$line){ 
         fputcsv($file,$line); 
       }
       fclose($file); 
       exit;
      
    }

    public function change_contacted_medium()
    {
      $medium = $_POST['medium'];
      $lead_id = $_POST['lead_id'];
      $where = array('id'=>$lead_id);
      $data = array('contacted_medium'=>$medium,'updated_at'=>date('Y-m-d H:i:s'));
      if($this->institute_model->updateAllData('leads',$where,$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Data Updated Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to Update !'));die;
      }
    }

    public function delete_leads()
    {
      $lead_id = $_POST['lead_id'];
      
      if($this->institute_model->delete_lead($lead_id))
      {
        echo json_encode(array('status'=>true, 'message'=>'Data Deleted Successfully !'));die;
      }
      else{
         echo json_encode(array('status'=>false, 'errormessage'=>'Failed to Delete !'));die;
      }
    }

    public function get_all_student_by_stream(){
        $stream         = $_POST['stream'];
        $institute_id   = $_SESSION['institute_id'];
        $subdomain_arr  = explode('.', $_SERVER['HTTP_HOST'], 2);
        $where          = array('stream' => $stream,'institute_id' =>$institute_id,"student_status!=" => 9 );
        $checkLimit     =$this->institute_model->getAllDataArray(TBL_STUDENT,$where);
            if(!count($checkLimit)){
                echo json_encode($checkLimit);
            }else{
                echo json_encode($checkLimit);
            }
    }

    
    public function get_all_student_by_course(){
        $course         = $_POST['course'];
        $institute_id   = $_SESSION['institute_id'];
        $subdomain_arr  = explode('.', $_SERVER['HTTP_HOST'], 2);
        $where          = array('course' => $course,'institute_id' =>$institute_id ,"student_status!=" => 9 );
        $checkLimit     =$this->institute_model->getAllDataArray(TBL_STUDENT,$where);
            if(!count($checkLimit)){
                echo json_encode($checkLimit);
            }else{
                echo json_encode($checkLimit);
            }
    }

    
    public function get_all_student_by_year(){
        $yoa            = $_POST['yoa'];
        $institute_id   = $_SESSION['institute_id'];
        $subdomain_arr  = explode('.', $_SERVER['HTTP_HOST'], 2);
        $where          = array('yoa' => $yoa,'institute_id' =>$institute_id ,"student_status!=" => 9 );
        $checkLimit     =$this->institute_model->getAllDataArray(TBL_STUDENT,$where);
            if(!count($checkLimit)){
                echo json_encode($checkLimit);
            }else{
                echo json_encode($checkLimit);
            }

    }

    
    public function get_all_staff(){
        $checkLimit     =$this->institute_model->getAllActiveStaff();
            if(!count($checkLimit)){
                echo json_encode($checkLimit);
            }else{
                echo json_encode($checkLimit);
            }

    }


    public function editonlineenquiry(){
        // $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
        // $where  = array('subdomain' => $subdomain_arr[0] );
        // $checkLimit=$this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);  
      // print_r($_POST);
        $institute_id       = $_SESSION['institute_id'];
        $online_enquiry_id  = $_POST['online_enquiry_id'];
        $admisn_number      = $_POST['admisn_number'];
        $serial_number      = $_POST['serial_number'];
        $name               = $_POST['name'];
        $dob                = $_POST['dob'];
        $father_name        = $_POST['father_name'];
        $father_mo_number   = $_POST['father_mo_number'];
        $mothersname        = $_POST['mothersname'];
        $mother_mo_number   = $_POST['mother_mo_number'];
        $natianality        = $_POST['natianality'];
        $caste              = $_POST['caste'];
        $sex                = $_POST['sex'];
        $nationality_citizen        = $_POST['nationality_citizen'];
        $course_applied_for         = $_POST['course_applied_for'];
        $last_exam_pass             = $_POST['last_exam_pass'];
        $board_name                 = $_POST['board_name'];
        $year_of_passing            = $_POST['year_of_passing'];
        $registration_no            = $_POST['registration_no'];
        $student_mobile_number      = $_POST['student_mobile_number'];
        $relation_with_student      = $_POST['relation_with_student'];
        $mob_number                 = $_POST['mob_number'];
        $school_name_twelth         = $_POST['school_name_twelth'];
        $permanent_address          = $_POST['permanent_address'];
        $localaddress               = $_POST['local_address'];
        $sub1               = $_POST['sub1'];
        $sub2               = $_POST['sub2'];
        $sub3               = $_POST['sub3'];
        $sub4               = $_POST['sub4'];
        $sub5               = $_POST['sub5'];
        $score1               = $_POST['score1'];
        $score2               = $_POST['score2'];
        $score3               = $_POST['score3'];
        $score4               = $_POST['score4'];
        $score5               = $_POST['score5'];
        $Tscore               = $_POST['Tscore'];
        $Pscore               = $_POST['Pscore'];
        $admitted_by          = $_POST['admitted_by'];
        $admitted_by_number   = $_POST['admitted_by_number'];
        $varified_by          = $_POST['varified_by'];
        $entered_by           = $_POST['entered_by'];

        // if(isset($_FILES['profileImage']) && $_FILES['profileImage']!="" && !empty($_FILES['profileImage']['name'])){
        //     $file_orignal_name = $_FILES['profileImage']['name'];
        //     $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        //     // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
        //     $path = UPLOAD_STUDENT_PHOTO;
        //     $image_name = time().uniqid().$file_orignal_name;
        //     $input_name = 'profileImage';
        //     $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        //     // echo '<pre>'; print_r($result); echo '</pre>';
        //     if ($result) {
        //         $student_photo = $path.$image_name;
        //     }else{
        //         echo json_encode(array('status'=>false, 'message'=>'Student Photo Upload Failed'));die;
        //     }
        // }


        // if(isset($_FILES['father_sign']) && $_FILES['father_sign']!="" && !empty($_FILES['father_sign']['name'])){
        //     $file_orignal_name = $_FILES['father_sign']['name'];
        //     $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        //     // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
        //     $path = UPLOAD_FATHER_SIGN;
        //     $image_name = time().uniqid().$file_orignal_name;
        //     $input_name = 'father_sign';
        //     $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        //     if ($result) {
        //         $father_sign = $path.$image_name;
        //     }else{
        //         echo json_encode(array('status'=>false, 'message'=>'Father Sign Upload Failed'));die;
        //     }
        // }


        // if(isset($_FILES['student_sign']) && $_FILES['student_sign']!="" && !empty($_FILES['student_sign']['name'])){
        //     $file_orignal_name = $_FILES['student_sign']['name'];
        //     $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        //     // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
        //     $path = UPLOAD_STUDENT_SIGN;
        //     $image_name = time().uniqid().$file_orignal_name;
        //     $input_name = 'student_sign';
        //     $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        //     if ($result) {
        //         $student_sign = $path.$image_name;
        //     }else{
        //         echo json_encode(array('status'=>false, 'message'=>'Student Sign Upload Failed'));die;
        //     }
        // }
        // print_r($_FILES);die;
        // $this_year = date("Y-01-01 00:00:00");
        // $query = "SELECT * FROM `online_enquiry` WHERE `online_enquiry_created_at`> '$this_year' AND `institute_id`= $institute_id";
        // $run = $this->db->query($query);
        // $result = $run->result();
        // $this_year_count = count($result);
        // $year = date("Y");
        // $admmision_number = 250+ $this_year_count +1;
        // $admmision_number = $year.'000'.$admmision_number;
        // $serial_number = 250+ $this_year_count +1;
        // $serial_number = $year.$serial_number;



        $insert_array = array(
                         'admmision_number'            =>$admisn_number,
                         'serial_number'               =>$serial_number,
                         'name'                        =>$name,
                         'dob'                         =>$dob,
                         'father_name'                 =>$father_name,
                         'father_mo_number'            =>$father_mo_number,
                         'mothersname'                 =>$mothersname,
                         'mother_mo_number'            =>$mother_mo_number,
                         'natianality'                 =>$natianality,
                         'caste'                       =>$caste,
                         'sex'                         =>$sex,
                         'nationality_citizen'         =>$nationality_citizen,
                         'course_applied_for'          =>$course_applied_for,
                         'last_exam_pass'              =>$last_exam_pass,
                         'board_name'                  =>$board_name,
                         'year_of_passing'             =>$year_of_passing,
                         'registration_no'             =>$registration_no,
                         'student_mobile_number'       =>$student_mobile_number,
                         'relation_with_student'       =>$relation_with_student,
                         'mob_number'                  =>$mob_number,
                         'school_name_twelth'          =>$school_name_twelth,
                         'permanent_address'           =>$permanent_address,
                         'localaddress'                =>$localaddress,
                         'institute_id'                =>$institute_id,
                         'sub1'                =>$sub1,
                         'sub2'                =>$sub2,
                         'sub3'                =>$sub3,
                         'sub4'                =>$sub4,
                         'sub5'                =>$sub5,
                         'score1'                =>$score1,
                         'score2'                =>$score2,
                         'score3'                =>$score3,
                         'score4'                =>$score4,
                         'score5'                =>$score5,
                         'Tscore'                =>$Tscore,
                         'Pscore'                =>$Pscore,
                         'admitted_by'           =>$admitted_by,
                         'admitted_by_number'    =>$admitted_by_number,
                         'varified_by'           =>$varified_by,
                         'entered_by'            =>$entered_by,
                         'online_enquiry_updated_at'   =>date("Y-m-d H:i:s")
                         ) ;
        $where = array('online_enquiry_id' => $online_enquiry_id );
         $checkLimit = $this->institute_model->updateAllData(TBL_ONLINE_ENQUIRY,$where,$insert_array);
        // $checkLimit = $this->institute_model->insertData(TBL_ONLINE_ENQUIRY,$insert_array);
        if (!$checkLimit) {
        }
            echo $this->db->error;
        $last_id = $this->db->insert_id();
        // echo '<pre>'; print_r($last_id); echo '</pre>';
       $data['institute_id']=$institute_id;
       $data['last_id']     =$last_id;
        $this->load->view('thank-you',$data);
    }

    public function admissionDetails()
    {
        $subdomain = $this->uri->segment(3);
        $where  = array('subdomain' => $subdomain);
        $checkLimit = $this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
        
        $institute_id       = $checkLimit[0]->institute_id;
        $institute_name     = $checkLimit[0]->institute_name;
        $institute_mobile   = $checkLimit[0]->institute_mobile;
        $payment_link       = $checkLimit[0]->payment_api_key;
        $admission_fee      = $checkLimit[0]->admission_fee;

        $name               = $_POST['name'];
        $dob                = date_create(strtotime($_POST['dob']));
        $dob                = date_format($dob,'Y-m-d');
        $birth_place        = $_POST['placeOfBirth'];
        $father_name        = $_POST['father_name'];
        $mother_name        = $_POST['mother_name'];
        $father_mo_number   = $_POST['father_mo_number'];
        $natianality        = $_POST['natianality'];
        $sex                = $_POST['sex'];
        $nationality_citizen  = $_POST['nationality_citizen'];
        $course_applied_for  = $_POST['course_applied_for'];
        $course_id          = $_POST['course_id'];
        $stream_id          = $_POST['stream_id'];
        $board_name         = isset($_POST['board_name']) ? $_POST['board_name'] : '';
        $last_exam_pass     = isset($_POST['last_exam_pass']) ? $_POST['last_exam_pass'] : '';
        $year_of_passing    = isset($_POST['year_of_passing']) ? $_POST['year_of_passing'] : '';
        $student_mobile_number = isset($_POST['student_mobile_number']) ? $_POST['student_mobile_number'] : '';
        $student_email = isset($_POST['student_email']) ? $_POST['student_email'] : '';
        $school_name_twelth  = isset($_POST['school_name_twelth']) ? $_POST['school_name_twelth'] : '';
        $permanent_address  = isset($_POST['permanent_address']) ? $_POST['permanent_address'] : '';
        $present_address    = isset($_POST['present_address']) ? $_POST['present_address'] : '';
        $sub1               = isset($_POST['sub1']) ? $_POST['sub1'] : '';
        $sub2               = isset($_POST['sub2']) ? $_POST['sub2'] : '';
        $sub3               = isset($_POST['sub3']) ? $_POST['sub3'] : '';
        $sub4               = isset($_POST['sub4']) ? $_POST['sub4'] : '';
        $sub5               = isset($_POST['sub5']) ? $_POST['sub5'] : '';
        $sub6               = isset($_POST['sub6']) ? $_POST['sub6'] : '';
        $score1             = isset($_POST['score1']) ? $_POST['score1'] : '';
        $score2             = isset($_POST['score2']) ? $_POST['score2'] : '';
        $score3             = isset($_POST['score3']) ? $_POST['score3'] : '';
        $score4             = isset($_POST['score4']) ? $_POST['score4'] : '';
        $score5             = isset($_POST['score5']) ? $_POST['score5'] : '';
        $score6             = isset($_POST['score6']) ? $_POST['score6'] : '';
        $perc1              = isset($_POST['perc1']) ? $_POST['perc1'] : '';
        $perc2              = isset($_POST['perc2']) ? $_POST['perc2'] : '';
        $perc3              = isset($_POST['perc3']) ? $_POST['perc3'] : '';
        $perc4              = isset($_POST['perc4']) ? $_POST['perc4'] : '';
        $perc5              = isset($_POST['perc5']) ? $_POST['perc5'] : '';
        $perc6              = isset($_POST['perc6']) ? $_POST['perc6'] : '';
        $Tscore             = isset($_POST['Tscore']) ? $_POST['Tscore'] : '';
        $Pscore             = isset($_POST['Pscore']) ? $_POST['Pscore'] : '';
        $father_Profession    = isset($_POST['father_Profession']) ? $_POST['father_Profession'] : '';
        $annual_income        = isset($_POST['income_all']) ? $_POST['income_all'] : '';
        $extra_exam_mark1     = isset($_POST['extra_exam_mark1']) ? $_POST['extra_exam_mark1'] : '';
        $extra_exam_perc1     = isset($_POST['extra_exam_perc1']) ? $_POST['extra_exam_perc1'] : '';
        $extra_exam_total1    = isset($_POST['extra_exam_total1']) ? $_POST['extra_exam_total1'] : '';
        $submission_date      = isset($_POST['submission_date']) ? $_POST['submission_date'] : '';
        $submission_place     = isset($_POST['submission_place']) ? $_POST['submission_place'] : '';

        $tenth_inst = isset($_POST['tenth_inst']) ? $_POST['tenth_inst'] : '';
        $tenth_stream = isset($_POST['tenth_stream']) ? $_POST['tenth_stream'] : '';
        $tenth_percent = isset($_POST['tenth_percent']) ? $_POST['tenth_percent'] : '';
        $tenth_pass_year = isset($_POST['tenth_pass_year']) ? $_POST['tenth_pass_year'] : '';

        $twelth_inst = isset($_POST['twelth_inst']) ? $_POST['twelth_inst'] : '';
        $twelth_stream = isset($_POST['twelth_stream']) ? $_POST['twelth_stream'] : '';
        $twelth_percent = isset($_POST['twelth_percent']) ? $_POST['twelth_percent'] : '';
        $twelth_pass_year = isset($_POST['twelth_pass_year']) ? $_POST['twelth_pass_year'] : '';
        $grad_inst = isset($_POST['grad_inst']) ? $_POST['grad_inst'] : '';
        $grad_stream = isset($_POST['grad_stream']) ? $_POST['grad_stream'] : '';
        $grad_percent = isset($_POST['grad_percent']) ? $_POST['grad_percent'] : '';
        $grad_pass_year = isset($_POST['grad_pass_year']) ? $_POST['grad_pass_year'] : '';

        $pref_location = isset($_POST['pref_location']) ? $_POST['pref_location'] : '';
        $pref_college1 = isset($_POST['pref_college1']) ? $_POST['pref_college1'] : '';
        $pref_college2 = isset($_POST['pref_college2']) ? $_POST['pref_college2'] : '';
        $pref_college3 = isset($_POST['pref_college3']) ? $_POST['pref_college3'] : '';

        $scholarship = isset($_POST['scholarship']) ? $_POST['scholarship'] : '';

        $assisted_by = isset($_POST['associate']) ? $_POST['associate'] : '';

        $entrance_exam = isset($_POST['entrance_exam']) ? $_POST['entrance_exam'] : '';

        if(isset($_POST['twelfth_marks']))
        {
          $twelfth_marks = "checked";
        }
        else{
          $twelfth_marks = "";
        }
        if(isset($_POST['tenth_marks']))
        {
          $tenth_marks = "checked";
        }
        else{
          $tenth_marks = "";
        }
        if(isset($_POST['migration']))
        {
          $migration = "checked";
        }
        else{
          $migration = "";
        }
        if(isset($_POST['admit_card']))
        {
          $admit_card = "checked";
        }
        else{
          $admit_card = "";
        }
        if(isset($_POST['school_leaving']))
        {
          $school_leaving = "checked";
        }
        else{
          $school_leaving = "";
        }
        if(isset($_POST['photograph']))
        {
          $photograph = "checked";
        }
        else{
          $photograph = "";
        }

        $enquiry_id = isset($_POST['enquiry_id']) ? $_POST['enquiry_id'] : "";
        
        if(isset($_FILES['profileImage']) && $_FILES['profileImage']!="" && !empty($_FILES['profileImage']['name'])){
          $file_orignal_name = $_FILES['profileImage']['name'];
          $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
          // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
          $path = UPLOAD_STUDENT_PHOTO;
          $image_name = time().uniqid().$file_orignal_name;
          $input_name = 'profileImage';
          $result = $this->institute_model->upload_image($path, $image_name, $input_name);
          // echo '<pre>'; print_r($result); echo '</pre>';
          if ($result) {
              $student_photo = $path.$image_name;
          }else{
              $this->session->set_flashdata('profile_photo_error','Student Photo Upload Failed');die;
             redirect(base_url().'online-admission/'.$subdomain,'refresh');
          }
      }

      if(isset($_FILES['father_sign']) && $_FILES['father_sign']!="" && !empty($_FILES['father_sign']['name'])){
          $file_orignal_name = $_FILES['father_sign']['name'];
          $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
          // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
          $path = UPLOAD_FATHER_SIGN;
          $image_name = time().uniqid().$file_orignal_name;
          $input_name = 'father_sign';
          $result = $this->institute_model->upload_image($path, $image_name, $input_name);
          if ($result) {
              $father_sign = $path.$image_name;
          }else{
              $this->session->set_flashdata('father_sign_error','Father Sign Upload Failed !');die;
              redirect(base_url().'online-admission/'.$subdomain,'refresh');
          }
      }else{
        $father_sign = "";
      }


      if(isset($_FILES['student_sign']) && $_FILES['student_sign']!="" && !empty($_FILES['student_sign']['name'])){
          $file_orignal_name = $_FILES['student_sign']['name'];
          $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
          // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
          $path = UPLOAD_STUDENT_SIGN;
          $image_name = time().uniqid().$file_orignal_name;
          $input_name = 'student_sign';
          $result = $this->institute_model->upload_image($path, $image_name, $input_name);
          if ($result) {
              $student_sign = $path.$image_name;
          }else{
              $this->session->set_flashdata('student_sign_error','Student Sign Upload Failed !');die;
              redirect(base_url().'online-admission/'.$subdomain,'refresh');
          }
      }else{
        $student_sign = "";
      }

      if(isset($_FILES['tenth_marksheet']) && $_FILES['tenth_marksheet']!="" && !empty($_FILES['tenth_marksheet']['name'])){
        $file_orignal_name = $_FILES['tenth_marksheet']['name'];
        $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        $path = 'institute/docs/';
        $image_name = time().uniqid().$file_orignal_name;
        $input_name = 'tenth_marksheet';
        $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        if ($result) {
            $tenth_marksheet = $path.$image_name;
        }else{
            $this->session->set_flashdata('tenth_marksheet_error','Tenth Marksheet Upload Failed !');die;
            redirect(base_url().'online-admission/'.$subdomain,'refresh');
        }
    }else{
      $tenth_marksheet = "";
    }

    if(isset($_FILES['twelth_marksheet']) && $_FILES['twelth_marksheet']!="" && !empty($_FILES['twelth_marksheet']['name'])){
        $file_orignal_name = $_FILES['twelth_marksheet']['name'];
        $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        $path = 'institute/docs/';
        $image_name = time().uniqid().$file_orignal_name;
        $input_name = 'twelth_marksheet';
        $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        if ($result) {
            $twelth_marksheet = $path.$image_name;
        }else{
            $this->session->set_flashdata('twelth_marksheet_error','Twelth Marksheet Upload Failed !');die;
            redirect(base_url().'online-admission/'.$subdomain,'refresh');
        }
    }else{
      $twelth_marksheet = "";
    }

    if(isset($_FILES['grad_marksheet']) && $_FILES['grad_marksheet']!="" && !empty($_FILES['grad_marksheet']['name'])){
        $file_orignal_name = $_FILES['grad_marksheet']['name'];
        $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
        $path = 'institute/docs/';
        $image_name = time().uniqid().$file_orignal_name;
        $input_name = 'grad_marksheet';
        $result = $this->institute_model->upload_image($path, $image_name, $input_name);
        if ($result) {
            $grad_marksheet = $path.$image_name;
        }else{
            $this->session->set_flashdata('grad_marksheet_error','Graduation Marksheet Upload Failed !');die;
            redirect(base_url().'online-admission/'.$subdomain,'refresh');
        }
    }else{
      $grad_marksheet = "";
    }
        
        // print_r($_FILES);die;
        $this_year = date("Y-01-01 00:00:00");
        $query = "SELECT * FROM `online_enquiry` WHERE `online_enquiry_created_at`> '$this_year' AND `institute_id`= $institute_id";
        $run = $this->db->query($query);
        $result = $run->result();
        $this_year_count = count($result);
        $year = date("Y");
        $admmision_number = 250+ $this_year_count +1;
        $admmision_number = $year.'000'.$admmision_number;
        $serial_number = 250+ $this_year_count +1;
        $serial_number = $year.$serial_number;

        $insert_array = array(
                         'admmision_number'            =>$admmision_number,
                         'serial_number'               =>$serial_number,
                         'name'                        =>$name,
                         'dob'                         =>$dob,
                         'birth_place'                 =>$birth_place,
                         'father_name'                 =>$father_name,
                         'mother_name'                 =>$mother_name,
                         'father_mo_number'            =>$father_mo_number,
                         'natianality'                 =>$natianality,
                         'sex'                         =>$sex,
                         'nationality_citizen'         =>$nationality_citizen,
                         'course_applied_for'          =>$course_applied_for,
                         'course_id'                   =>$course_id,
                         'stream_id'                   =>$stream_id,
                         'last_exam_pass'              =>$last_exam_pass,
                         'board_name'                  =>$board_name,
                         'year_of_passing'             =>$year_of_passing,
                         'student_mobile_number'       =>$student_mobile_number,
                         'student_email'               =>$student_email,
                         'school_name_twelth'          =>$school_name_twelth,
                         'permanent_address'           =>$permanent_address,
                         'present_address'             =>$present_address,
                         'institute_id'                =>$institute_id,
                         'student_photo'               =>$student_photo,
                         'father_sign'                 =>$father_sign,
                         'student_sign'                =>$student_sign,
                         'sub1'                =>$sub1,
                         'sub2'                =>$sub2,
                         'sub3'                =>$sub3,
                         'sub4'                =>$sub4,
                         'sub5'                =>$sub5,
                         'sub6'                =>$sub6,
                         'score1'                =>$score1,
                         'score2'                =>$score2,
                         'score3'                =>$score3,
                         'score4'                =>$score4,
                         'score5'                =>$score5,
                         'score6'                =>$score6,
                         'perc1'                =>$perc1,
                         'perc2'                =>$perc2,
                         'perc3'                =>$perc3,
                         'perc4'                =>$perc4,
                         'perc5'                =>$perc5,
                         'perc6'                =>$perc6,
                         'Tscore'                =>$Tscore,
                         'Pscore'                =>$Pscore,
                         'father_Profession'     =>$father_Profession,
                         'annual_income'     =>$annual_income,
                         'extra_exam_mark1'   =>$extra_exam_mark1,
                         'extra_exam_perc1'   =>$extra_exam_perc1,
                         'extra_exam_total1'  =>$extra_exam_total1,
                         'submission_date'    =>$submission_date,
                         'submission_place'   =>$submission_place,
                         'twelfth_marks'      =>$twelfth_marks,
                         'tenth_marks'        =>$tenth_marks,
                         'migration'        =>$migration,
                         'admit_card'       =>$admit_card,
                         'school_leaving'   =>$school_leaving,
                         'photograph'        =>$photograph,
                         'tenth_inst'   =>$tenth_inst,
                         'tenth_stream'   =>$tenth_stream,
                         'tenth_percent'   =>$tenth_percent,
                         'tenth_pass_year'   =>$tenth_pass_year,
                         'twelth_inst'   =>$twelth_inst,
                         'twelth_stream'   =>$twelth_stream,
                         'twelth_percent'   =>$twelth_percent,
                         'twelth_pass_year'   =>$twelth_pass_year,
                         'grad_inst'   =>$grad_inst,
                         'grad_stream'   =>$grad_stream,
                         'grad_percent'   =>$grad_percent,
                         'grad_pass_year'   =>$grad_pass_year,
                         'preferred_location'   =>$pref_location,
                         'pref_college1'   =>$pref_college1,
                         'pref_college2'   =>$pref_college2,
                         'pref_college3'   =>$pref_college3,
                         'tenth_marksheet'  =>$tenth_marksheet,
                         'twelth_marksheet'  =>$twelth_marksheet,
                         'grad_marksheet'  =>$grad_marksheet,
                         'scholarship'  =>$scholarship,
                         'assisted_by'  =>$assisted_by,
                         'entrance_exam'  =>$entrance_exam,
                         'online_enquiry_updated_at'   =>date("Y-m-d H:i:s")
                      );
          $insert_data = $this->security->xss_clean($insert_array);
          $checkLimit = $this->institute_model->insertData(TBL_ONLINE_ENQUIRY,$insert_data);
          if (!$checkLimit) {
          }
          // echo $this->db->error;
            $last_id = $this->db->insert_id();
            $notice_msg = 'New application received of '.$name.' for admission !';
            $url = base_url().'institute/online_enquiries';
            $notice_data = array(
              'institute_id'=>$institute_id,
              'msg'=>$notice_msg,
              'url'=>$url,
              'type'=>'Enquiry',
              'created_at'=>date('Y-m-d H:i:s')
            );
            $this->institute_model->insertData('notifications',$notice_data);
          // send SMS
          
          $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
          // Message details
          
          $numbers = array($student_mobile_number);
          $sender = urlencode('EDUWEG');

          $message = rawurlencode('Dear '.$name.' Thanks for taking online admission in '.$institute_name.' .Please Pay the seat booking fee for Admission Confirmation. You can pay with this link '.$payment_link.' . For Online Admission Support Please call '.$institute_mobile.' .Thanks Eduwego');

          $numbers = implode(',', $numbers);
           
          // Prepare data for POST request
          $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
          // Send the POST request with cURL
          $ch = curl_init('https://api.textlocal.in/send/');
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          curl_close($ch);

          $data['institute_id'] = $institute_id;
          $data['admission_fee'] = $admission_fee;
          $data['payment_link'] = $payment_link;
          $data['last_id']     =$last_id;
          $this->load->view('thank-you',$data); 
    }

   public function print_app_form($inst_id,$enquiry_id)
   {
      $institute_id = base64_decode($inst_id);
      $enquiry_id = base64_decode($enquiry_id);
      $where  = array('online_enquiry_id' => $enquiry_id,'institute_id'=>$institute_id);
      $data['institute'] = $this->db->query("SELECT institute_id,institute_name,institute_mobile,institute_email,state,institute_address,institute_logo,institute_website,html_file_name_editable FROM institute WHERE institute_id = '".$institute_id."' ")->row();
      $data['details'] = $this->institute_model->getAllDataArray(TBL_ONLINE_ENQUIRY,$where);
      $editable_form = $data['institute']->html_file_name_editable;
      $this->load->view($editable_form,$data);
   }

    public function editAdmissionDetails(){
        //$online_enquiry_id = $this->uri->segment(3);
        // $checkLimit=$this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);  
        $institute_id = $_SESSION['institute_id'];
        $admisn_number      = $_POST['admisn_number'];
        // $serial_number      = $_POST['serial_number'];
        $name               = $_POST['name'];
        $dob                = $_POST['dob'];
        $birth_place        = $_POST['placeOfBirth'];
        $father_name        = $_POST['father_name'];
        $father_mo_number   = $_POST['father_mo_number'];
        // $mothersname     = $_POST['mothersname'];
        // $mother_mo_number = $_POST['mother_mo_number'];
        $natianality        = $_POST['natianality'];
        // $caste           = $_POST['caste'];
        $sex                = $_POST['sex'];
        $nationality_citizen        = $_POST['nationality_citizen'];
        $course_applied_for         = $_POST['course_applied_for'];
        // $last_exam_pass          = $_POST['last_exam_pass'];
        $board_name                 = $_POST['board_name'];
        $year_of_passing            = $_POST['year_of_passing'];
        // $registration_no         = $_POST['registration_no'];
        $student_mobile_number      = $_POST['student_mobile_number'];
        // $relation_with_student   = $_POST['relation_with_student'];
        // $mob_number              = $_POST['mob_number'];
        $school_name_twelth         = $_POST['school_name_twelth'];
        $permanent_address          = $_POST['permanent_address'];
        // $localaddress            = $_POST['local_address'];
        $sub1               = $_POST['sub1'];
        $sub2               = $_POST['sub2'];
        $sub3               = $_POST['sub3'];
        $sub4               = $_POST['sub4'];
        $sub5               = $_POST['sub5'];
        $sub6               = $_POST['sub6'];
        $score1               = $_POST['score1'];
        $score2               = $_POST['score2'];
        $score3               = $_POST['score3'];
        $score4               = $_POST['score4'];
        $score5               = $_POST['score5'];
        $score6               = $_POST['score6'];
        $perc1               = $_POST['perc1'];
        $perc2               = $_POST['perc2'];
        $perc3               = $_POST['perc3'];
        $perc4               = $_POST['perc4'];
        $perc5               = $_POST['perc5'];
        $perc6               = $_POST['perc6'];
        $Tscore               = $_POST['Tscore'];
        $Pscore               = $_POST['Pscore'];
        $father_Profession    = $_POST['father_Profession'];
        $annual_income        = $_POST['income_all'];
        // $last_school       = $_POST['university_school'];
        // $extra_exam1       = $_POST['extra_exam1'];
        $extra_exam_mark1     = $_POST['extra_exam_mark1'];
        $extra_exam_perc1     = $_POST['extra_exam_perc1'];
        $extra_exam_total1    = $_POST['extra_exam_total1'];
        $submission_date      = $_POST['submission_date'];
        $submission_place     = $_POST['submission_place'];
      
        $online_enquiry_id = $_POST['enquiry_id'];
        
        $insert_array = array(
                         'admmision_number'            =>$admisn_number,
                         'name'                        =>$name,
                         'dob'                         =>$dob,
                         'birth_place'                 =>$birth_place,
                         'father_name'                 =>$father_name,
                         'father_mo_number'            =>$father_mo_number,
                         // 'mothersname'                 =>$mothersname,
                         // 'mother_mo_number'            =>$mother_mo_number,
                         'natianality'                 =>$natianality,
                         // 'caste'                       =>$caste,
                         'sex'                         =>$sex,
                         'nationality_citizen'         =>$nationality_citizen,
                         'course_applied_for'          =>$course_applied_for,
                         // 'last_exam_pass'              =>$last_exam_pass,
                         'board_name'                  =>$board_name,
                         'year_of_passing'             =>$year_of_passing,
                         // 'registration_no'             =>$registration_no,
                         'student_mobile_number'       =>$student_mobile_number,
                         // 'relation_with_student'       =>$relation_with_student,
                         // 'mob_number'                  =>$mob_number,
                         'school_name_twelth'          =>$school_name_twelth,
                         'permanent_address'           =>$permanent_address,
                         // 'localaddress'                =>$localaddress,
                         'institute_id'                =>$institute_id,
                         'sub1'                =>$sub1,
                         'sub2'                =>$sub2,
                         'sub3'                =>$sub3,
                         'sub4'                =>$sub4,
                         'sub5'                =>$sub5,
                         'sub6'                =>$sub6,
                         'score1'                =>$score1,
                         'score2'                =>$score2,
                         'score3'                =>$score3,
                         'score4'                =>$score4,
                         'score5'                =>$score5,
                         'score6'                =>$score6,
                         'perc1'                =>$perc1,
                         'perc2'                =>$perc2,
                         'perc3'                =>$perc3,
                         'perc4'                =>$perc4,
                         'perc5'                =>$perc5,
                         'perc6'                =>$perc6,
                         'Tscore'                =>$Tscore,
                         'Pscore'                =>$Pscore,
                         'father_Profession'     =>$father_Profession,
                         'annual_income'     =>$annual_income,
                         // 'last_school'     =>$last_school,
                         // 'extra_exam1'     =>$extra_exam1,
                         'extra_exam_mark1'   =>$extra_exam_mark1,
                         'extra_exam_perc1'   =>$extra_exam_perc1,
                         'extra_exam_total1'  =>$extra_exam_total1,
                         'submission_date'    =>$submission_date,
                         'submission_place'   =>$submission_place,
                         'online_enquiry_updated_at'   =>date("Y-m-d H:i:s")
                        ) ;
        $where = array('online_enquiry_id'=>$online_enquiry_id);
        $status = $this->institute_model->updateAllData(TBL_ONLINE_ENQUIRY,$where,$insert_array);
        if($status)
        {
          redirect(base_url()."institute/edit_online_enquiry/".$online_enquiry_id."/edit");
        }
       
    }


    public function print_form($institute_id,$online_enquiry_id){
        $where  = array('online_enquiry_id' => $online_enquiry_id );
        $checkLimit=$this->institute_model->getAllDataArray(TBL_ONLINE_ENQUIRY,$where);
        // $institute_id = $_SESSION['institute_id'];
        $MyFile = file_get_contents(base_url()."institute/get_view/$institute_id/view");
        // echo $MyFile; die;
             // $new_str = str_replace('{_admisn_number_}',$checkLimit[0]->admmision_number,$MyFile) ;
             // $new_str = str_replace('{online_enquiry_id}',$checkLimit[0]->online_enquiry_id,$new_str) ;
             // $new_str = str_replace('{serial_number}',$checkLimit[0]->serial_number,$new_str) ;
             // $new_str = str_replace('{name}',$checkLimit[0]->name,$new_str) ;
             // $new_str = str_replace('{dob}',$checkLimit[0]->dob,$new_str) ;
             // $new_str = str_replace('{father_name}',$checkLimit[0]->father_name,$new_str) ;
             // $new_str = str_replace('{father_mo_number}',$checkLimit[0]->father_mo_number,$new_str) ;
             // $new_str = str_replace('{mothersname}',$checkLimit[0]->mothersname,$new_str) ;
             // $new_str = str_replace('{mother_mo_number}',$checkLimit[0]->mother_mo_number,$new_str) ;
             // $new_str = str_replace('{natianality}',$checkLimit[0]->natianality,$new_str) ;
             // $new_str = str_replace('{caste}',$checkLimit[0]->caste,$new_str) ;
             // $new_str = str_replace('{sex}',$checkLimit[0]->sex,$new_str) ;
             // $new_str = str_replace('{nationality_citizen}',$checkLimit[0]->nationality_citizen,$new_str) ;
             // $new_str = str_replace('{profileImage}',$checkLimit[0]->student_photo,$new_str) ;
             // $new_str = str_replace('{last_exam_pass}',$checkLimit[0]->last_exam_pass,$new_str) ;
             // $new_str = str_replace('{board_name}',$checkLimit[0]->board_name,$new_str) ;
             // $new_str = str_replace('{year_of_passing}',$checkLimit[0]->year_of_passing,$new_str) ;
             // $new_str = str_replace('{registration_no}',$checkLimit[0]->registration_no,$new_str) ;
             // $new_str = str_replace('{school_name_twelth}',$checkLimit[0]->school_name_twelth,$new_str) ;
             // $new_str = str_replace('{permanent_address}',$checkLimit[0]->permanent_address,$new_str) ;
             // $new_str = str_replace('{localaddress}',$checkLimit[0]->localaddress,$new_str) ;
             // $new_str = str_replace('{relation_with_student}',$checkLimit[0]->relation_with_student,$new_str) ;
             // $new_str = str_replace('{mob_number}',$checkLimit[0]->mob_number,$new_str) ;
             // $new_str = str_replace('{father_sign}',$checkLimit[0]->father_sign,$new_str) ;
             // $new_str = str_replace('{student_sign}',$checkLimit[0]->student_sign,$new_str) ;
             // $new_str = str_replace('{student_mobile_number}',$checkLimit[0]->student_mobile_number,$new_str) ;
             // $new_str = str_replace('{course_applied_for}',$checkLimit[0]->course_applied_for,$new_str) ;
             // $new_str = str_replace('{sub1}',$checkLimit[0]->sub1,$new_str) ;
             // $new_str = str_replace('{sub2}',$checkLimit[0]->sub2,$new_str) ;
             // $new_str = str_replace('{sub3}',$checkLimit[0]->sub3,$new_str) ;
             // $new_str = str_replace('{sub4}',$checkLimit[0]->sub4,$new_str) ;
             // $new_str = str_replace('{sub5}',$checkLimit[0]->sub5,$new_str) ;
             // $new_str = str_replace('{score1}',$checkLimit[0]->score1,$new_str) ;
             // $new_str = str_replace('{score2}',$checkLimit[0]->score2,$new_str) ;
             // $new_str = str_replace('{score3}',$checkLimit[0]->score3,$new_str) ;
             // $new_str = str_replace('{score4}',$checkLimit[0]->score4,$new_str) ;
             // $new_str = str_replace('{score5}',$checkLimit[0]->score5,$new_str) ;
             // $new_str = str_replace('{Tscore}',$checkLimit[0]->Tscore,$new_str) ;
             // $new_str = str_replace('{Pscore}',$checkLimit[0]->Pscore,$new_str) ;
             // echo '<pre>'; print_r($MyFile); echo '</pre>';
             // print_r($_SESSION); die;

           $stringarray =   array (
                        '{_admisn_number_}',
                        '{online_enquiry_id}',
                        '{serial_number}',
                        '{name}',
                        '{dob}',
                        '{father_name}',
                        '{father_mo_number}',
                        '{mothersname}',
                        '{mother_mo_number}',
                        '{natianality}',
                        '{caste}',
                        '{sex}',
                        '{nationality_citizen}',
                        '{student_photo}',
                        '{last_exam_pass}',
                        '{board_name}',
                        '{year_of_passing}',
                        '{registration_no}',
                        '{school_name_twelth}',
                        '{permanent_address}',
                        '{localaddress}',
                        '{relation_with_student}',
                        '{mob_number}',
                        '{father_sign}',
                        '{student_sign}',
                        '{student_mobile_number}',
                        '{course_applied_for}',
                        '{sub1}',
                        '{sub2}',
                        '{sub3}',
                        '{sub4}',
                        '{sub5}',
                        '{sub6}',
                        '{score1}',
                        '{score2}',
                        '{score3}',
                        '{score4}',
                        '{score5}',
                        '{score6}',
                        '{perc1}',
                        '{perc2}',
                        '{perc3}',
                        '{perc4}',
                        '{perc5}',
                        '{perc6}',
                        '{Tscore}',
                        '{Pscore}',
                        '{admitted_by}',
                        '{admitted_by_number}',
                        '{varified_by}',
                        '{entered_by}',
                        '{birth_place}',
                        '{extra_exam_total1}',
                        '{extra_exam_mark1}',
                        '{extra_exam_perc1}',
                        '{father_Profession}',
                        '{annual_income}',
                        '{twelfth_marks}',
                        '{tenth_marks}',
                        '{migration}',
                        '{admit_card}',
                        '{school_leaving}',
                        '{photograph}',
                        '{submission_date}',
                        '{submission_place}',
                        '{online_enquiry_id}',
                        '{partner_code}'
                  );

            $replace_array = array(
                              $checkLimit[0]->admmision_number,
                              $checkLimit[0]->online_enquiry_id,
                              $checkLimit[0]->serial_number,
                              $checkLimit[0]->name,
                              $checkLimit[0]->dob,
                              $checkLimit[0]->father_name,
                              $checkLimit[0]->father_mo_number,
                              $checkLimit[0]->mothersname,
                              $checkLimit[0]->mother_mo_number,
                              $checkLimit[0]->natianality,
                              $checkLimit[0]->caste,
                              $checkLimit[0]->sex,
                              $checkLimit[0]->nationality_citizen,
                              $checkLimit[0]->student_photo,
                              $checkLimit[0]->last_exam_pass,
                              $checkLimit[0]->board_name,
                              $checkLimit[0]->year_of_passing,
                              $checkLimit[0]->registration_no,
                              $checkLimit[0]->school_name_twelth,
                              $checkLimit[0]->permanent_address,
                              $checkLimit[0]->localaddress,
                              $checkLimit[0]->relation_with_student,
                              $checkLimit[0]->mob_number,
                              $checkLimit[0]->father_sign,
                              $checkLimit[0]->student_sign,
                              $checkLimit[0]->student_mobile_number,
                              $checkLimit[0]->course_applied_for,
                              $checkLimit[0]->sub1,
                              $checkLimit[0]->sub2,
                              $checkLimit[0]->sub3,
                              $checkLimit[0]->sub4,
                              $checkLimit[0]->sub5,
                              $checkLimit[0]->sub6,
                              $checkLimit[0]->score1,
                              $checkLimit[0]->score2,
                              $checkLimit[0]->score3,
                              $checkLimit[0]->score4,
                              $checkLimit[0]->score5,
                              $checkLimit[0]->score6,
                              $checkLimit[0]->perc1,
                              $checkLimit[0]->perc2,
                              $checkLimit[0]->perc3,
                              $checkLimit[0]->perc4,
                              $checkLimit[0]->perc5,
                              $checkLimit[0]->perc6,
                              $checkLimit[0]->Tscore,
                              $checkLimit[0]->pscore,
                              $checkLimit[0]->admitted_by,
                              $checkLimit[0]->admitted_by_number,
                              $checkLimit[0]->varified_by,
                              $checkLimit[0]->entered_by,
                              $checkLimit[0]->birth_place,
                              $checkLimit[0]->extra_exam_total1,
                              $checkLimit[0]->extra_exam_mark1,
                              $checkLimit[0]->extra_exam_perc1,
                              $checkLimit[0]->father_Profession,
                              $checkLimit[0]->annual_income,
                              $checkLimit[0]->twelfth_marks,
                              $checkLimit[0]->tenth_marks,
                              $checkLimit[0]->migration,
                              $checkLimit[0]->admit_card,
                              $checkLimit[0]->school_leaving,
                              $checkLimit[0]->photograph,
                              $checkLimit[0]->submission_date,
                              $checkLimit[0]->submission_place,
                              $online_enquiry_id,
                              $checkLimit[0]->partner_code,
              );

            $new_str = str_replace($stringarray,$replace_array,$MyFile) ;
            echo $new_str;die;
            // $this->pdf->loadHtml($new_str);
            // $this->pdf->set_paper('A4', 'portrait');
            // $this->pdf->render();
            // $this->pdf->stream("$checkLimit[0]->name.pdf", array("Attachment"=>0));


        // echo '<pre>'; print_r($checkLimit); echo '</pre>';

    }


    public function add_aannouncment(){
      $session = $this->session_check();
      if($session == true)
      {
        // print_r($_POST);
        $announcement   = $_POST['announcement'];
        $start_date     = $_POST['start_date'];
        $start_date     = str_replace('/', '-', $start_date);
        $start_date     = date("Y-m-d",strtotime("$start_date"));
        $end_date       = $_POST['end_date'];
        $end_date       = str_replace('/', '-', $end_date);
        $end_date       = date("Y-m-d",strtotime("$end_date"));
        $description    = $_POST['description'];
        $institute_id   = $_SESSION['institute_id'];

        $insert_array   = array(
                              'announcment_title'         =>$announcement,
                              'announcment_start_date'    =>$start_date,
                              'announcment_end_date'      =>$end_date,
                              'announcment_discription'   =>$description,
                              'announcment_institute_id'  =>$institute_id,
                              'created_by'                =>"institute"
                              );
        if ($_POST['agent_id']=="" || $_POST['agent_id']==NULL) {
          # code...
         $checkLimit      = $this->institute_model->insertData(TBL_ANNOUNCEMENT,$insert_array);
         $last_id = $this->db->last_query();
          }else{
            $payment_id = $_POST['agent_id'];
            $where  = array('announcment_id' => $payment_id );
            $checkLimit = $this->institute_model->updateAllData(TBL_ANNOUNCEMENT,$where,$insert_array);
          }


                echo json_encode(array('status'=>true, 'message'=>'Announcment added Successfully'));die;
      }
    }

    public function add_agent_payments(){
      $session = $this->session_check();
      if($session == true)
      {
        // echo '<pre>'; print_r($_POST); echo '</pre>';
        $payment_type     = $_POST['payment_type'];
        $payment_date     = $_POST['date'];
        $reciver_details  = explode("____",$_POST['subagentname']);
        $reciver_name     = $reciver_details[0];
        $reciver_id       = $_POST['agent_id'];
        $amount           = $_POST['amount'];
        $remark           = $_POST['remark'];
        $payment_status   = $_POST['payment'];
        $purpose          = $_POST['purpose'];
        $total_payment    = $_POST['total_payment'];
        $mode_payment     = $_POST['m_payment'];
        $amount_in_words  = $_POST['amount_in_words'];
        $institute_id    = $_SESSION['institute_id'];
        $insert_array     = array(
                              'payment_type'    =>$payment_type,
                              'payment_date'    =>$payment_date,
                              'paid_to_name'    =>$reciver_name,
                              'paid_to_id'      =>$reciver_id,
                              'amount'          =>$amount,
                              'amount_in_words' =>$amount_in_words,
                              'payment_mode'    =>$mode_payment,
                              'remark'          =>$remark,
                              'purpose'         =>$purpose,
                              'total_payment'   =>$total_payment,
                              'institute_id'   =>$institute_id
                            );
        if ($_POST['payment_id']=="" || $_POST['payment_id']==NULL) {
          # code...
           $status = $this->institute_model->insertData(TBL_PAYMENTS,$insert_array);
           //$last_id = $this->db->last_query();
           if($status)
           {
              echo json_encode(array('status'=>true, 'message'=>'Payment added Successfully'));die;
           }
        }
        else{
            $payment_id = $_POST['payment_id'];
            $where  = array('payment_id' => $payment_id );
            $status = $this->institute_model->updateAllData(TBL_PAYMENTS,$where,$insert_array);
            if($status)
            {
              echo json_encode(array('status'=>true, 'message'=>'Payment added Successfully'));die;
            }
          }
      }
    }

    public function add_payments(){
      $session = $this->session_check();
      if($session == true)
      {
        // echo '<pre>'; print_r($_POST); echo '</pre>';
        $payment_type     = $_POST['payment_type'];
        $payment_date     = $_POST['date'];
        $reciver_details  = explode("____",$_POST['subagentname']);
        $reciver_name     = $reciver_details[0];
        $reciver_id       = $reciver_details[1];
        $amount           = $_POST['amount'];
        $remark           = $_POST['remark'];
        $payment_status   = $_POST['payment'];
        $purpose          = $_POST['purpose'];
        $total_payment    = $_POST['total_payment'];
        $mode_payment     = $_POST['m_payment'];
        $amount_in_words  = $_POST['amount_in_words'];
        $institute_id    = $_SESSION['institute_id'];
        $insert_array     = array(
                              'payment_type'    =>$payment_type,
                              'payment_date'    =>$payment_date,
                              'paid_to_name'    =>$reciver_name,
                              'paid_to_id'      =>$reciver_id,
                              'amount'          =>$amount,
                              'amount_in_words' =>$amount_in_words,
                              'payment_mode'    =>$mode_payment,
                              'remark'          =>$remark,
                              'purpose'         =>$purpose,
                              'total_payment'   =>$total_payment,
                              'institute_id'   =>$institute_id
                            );
        if ($_POST['payment_id']=="" || $_POST['payment_id']==NULL) {
          # code...
           $status = $this->institute_model->insertData(TBL_PAYMENTS,$insert_array);
           //$last_id = $this->db->last_query();
           if($status)
           {
              echo json_encode(array('status'=>true, 'message'=>'Payment added Successfully'));die;
           }
        }
        else{
            $payment_id = $_POST['payment_id'];
            $where  = array('payment_id' => $payment_id );
            $status = $this->institute_model->updateAllData(TBL_PAYMENTS,$where,$insert_array);
            if($status)
            {
              echo json_encode(array('status'=>true, 'message'=>'Payment added Successfully'));die;
            }
          }
      }
    }

    public function smspayment(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | smspayment";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('smspayment');
        $this->load->view('dashboard-includes/footer');
      }
    } 

    public function send_sms(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | smspayment";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('smspayment');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function profile(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | profile";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        if($_SESSION['is_institute_in'])
        {
          $this->load->view('profile');
        }else if($_SESSION['is_staff_in'])
        {
          $this->load->view('staff_profile');
        }
        
        $this->load->view('dashboard-includes/footer');
      }
    }
     
     public function support(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | support";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('support');
        $this->load->view('dashboard-includes/footer');
      }
    }
    public function vendor(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'vendor';
        $data['site_title'] = "ZEQON | vendor";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('vendor');
        $this->load->view('dashboard-includes/footer');
      }
    }
      public function index(){
        $data['site_title'] = "EDUWEGO | login"; 
        $this->load->view('login',$data);
      }
      public function login(){
        $data['site_title'] = "EDUWEGO | login"; 
        $this->load->view('login',$data);
      }
      public function logout(){
        $session = $this->session->userdata($data);
        if($session['is_institute_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."login", "refresh");
        }
        if($session['is_staff_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."employee-login", "refresh");
        }
        if($session['is_student_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."student-login", "refresh");
        }
        if($session['is_admin_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."admin", "refresh");
        }
        if($session['is_super_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."super-login", "refresh");
        }
        if($session['is_agent_in'] == true)
        {
          $this->session->sess_destroy(); 
          $br = $this->config->base_url();
          redirect($br."associate", "refresh");
        }

      }    


    public function instituteLogin(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }
            $status=$this->institute_model->login($email,$password);
            if($status) {
                echo json_encode(array('status'=>true, 'message'=>'Authentication Successfull'));
            } else {
                echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));
            }
        }
        // $data['site_title'] = "EduweGo+ | Login";
        // $this->load->view('login');
    }

    public function userAuth(){
      if(isset($_POST) && !empty($_POST)){
          $email      = $this->security->xss_clean($this->input->post("email"));
          $password   = $this->security->xss_clean($this->input->post("password"));
          $login_type = $this->input->post("login_type");
          $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
          $this->form_validation->set_rules('password', 'password', 'trim|required');
          if ($this->form_validation->run() == FALSE){
              $errors = $this->form_validation->error_array();
              echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
          }
          $hash_pass = md5($password);
          if($login_type == "institute")
          {
            $emailExist = $this->db->query("SELECT admin_name,institute_mobile FROM institute WHERE institute_email = '".$email."' AND institute_password = '".$hash_pass."' ")->row();
            $user_name = $emailExist->admin_name;
            $user_mobile = $emailExist->institute_mobile;
          }elseif($login_type == "employee")
          {
            $emailExist = $this->db->query("SELECT employee_name,employee_mobile FROM staff WHERE employee_email = '".$email."' AND emp_password = '".$hash_pass."' ")->row();
            $user_name = $emailExist->employee_name;
            $user_mobile = $emailExist->employee_mobile;
          }
          
          if(!empty($emailExist)) {
              
              $permitted_chars = '0123456789';
              $otp =  substr(str_shuffle($permitted_chars), 0, 6);
              $this->session->set_userdata(array('loginEmail'=>$email,'loginOtp'=>$otp,'loginPass'=>$password));

            //   // SEND SMS
            //   $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
            //   // Message details

            //   $numbers = array($user_mobile);
            //   $sender = urlencode('EDUWEG');
              
            //   $message = rawurlencode('Dear '.$user_name.' Your OTP for login to Eduwego Portal is '.$otp.' Please do not share this OTP. Regards Eduwego');
              
            //   $numbers = implode(',', $numbers);
              
            //   // Prepare data for POST request
            //   $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
            //   // Send the POST request with cURL
            //   $ch = curl_init('https://api.textlocal.in/send/');
            //   curl_setopt($ch, CURLOPT_POST, true);
            //   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //   $response = curl_exec($ch);
            //   curl_close($ch);
            
            // Whatsapp message API integration start here
            $numbers = "91".$user_mobile;
            $post = array('campaignName' =>'Eduwego Login Otp', 'destination'=> $numbers,'userName'=>'EDUWEGO','templateParams'=>array($user_name,$otp),'apiKey' =>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
            $json = json_encode($post);
            $url = 'https://backend.aisensy.com/campaign/t1/api/v2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);  
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            // Whatsapp message API integration end here
            
            
            // Email API integration start here
              $subject = 'Eduwego: Otp For Login';
              $message = '<h3>Dear '.$user_name.' Your OTP for login to Eduwego Portal is '.$otp.' Please do not share this OTP.</h3><br><br>Regards Eduwego';
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
        "subject" : "'.$subject.'",
        "htmlbody": "'.$message.'",
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
      // Email API integration end here
              
              echo json_encode(array('status'=>true, 'message'=>'Authentication Successfull'));
          } else {
              echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));
          }
      }
      
    }

    public function verify_otp()
    {
      $login_email = $this->session->userdata('loginEmail');
      $login_otp = $this->session->userdata('loginOtp');
      $login_pass = $this->session->userdata('loginPass');
      $user_otp = $_POST['otp'];
      $login_type = $_POST['login_type'];
      if($login_email != "" && $login_otp != "")
      {
        if($user_otp == $login_otp)
        {
          if($login_type == "institute")
          {
            $status=$this->institute_model->login($login_email,$login_pass);
          }elseif($login_type == "employee")
          {
            $status=$this->institute_model->staff_login($login_email,$login_pass);
          }
          
          if($status) {
            $this->session->unset_userdata(array('loginEmail','loginOtp','loginPass'));
            echo json_encode(array('status'=>true, 'message'=>'Authentication Successfull'));
          } else {
            $this->session->unset_userdata(array('loginEmail','loginOtp','loginPass'));
            echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));
          }
        }else{
          $this->session->unset_userdata(array('loginEmail','loginOtp','loginPass'));
          echo json_encode(array('status'=>false, 'errormessage'=>'Invalid OTP Entered. Please try again !'));
        }
      }else{
        $this->session->unset_userdata(array('loginEmail','loginOtp','loginPass'));
        echo json_encode(array('status'=>false, 'errormessage'=>'Something went wrong !'));
      }
    }

    public function update_institute_profile(){
        if(isset($_POST) && !empty($_POST)){
            $institute_id               = $this->input->post("institute_id");
            $institute_name             = $this->input->post("institute_name");
            $mobile                     = $this->input->post("mobile");
            $landline_no                = $this->input->post("landline_no");
            $address                    = $this->input->post("address");
            $facebook_link               = $this->input->post("facebook_link");
            $google_business_link        = $this->input->post("google_business_link");
            $twitter_link               = $this->input->post("twitter_link");
            $instagram_link             = $this->input->post("instagram_link");
            $payment_link               = $this->input->post("payment_link");
            $refund_link                = $this->input->post("refund_link");
            $brochure_link              = $this->input->post("brochure_link");
            $youtube_link               = $this->input->post("youtube_link");
            $state                      = $this->input->post("state");
            $city                       = $this->input->post("city");
            $admsn_fee                  = $this->input->post("admsn_fee");
    
            $where  = array('institute_id' => $institute_id );
            $insert_array  = array(
                        'institute_name'             =>  $institute_name,
                        'institute_mobile'           =>  $mobile,
                        'institute_address'          =>  $address,
                        'state'                      =>  $state,
                        'city'                       =>  $city,
                        'facebook_link '             =>  $facebook_link,
                        'google_business_link'       =>  $google_business_link,
                        'twitter_link'               =>  $twitter_link,
                        'instagram_link'             =>  $instagram_link,
                        'youtube_link'               =>  $youtube_link,
                        'payment_api_key'            =>  $payment_link,
                        'refund_link'                =>  $refund_link,
                        'brochure_link'              =>  $brochure_link,
                        'admission_fee'              =>  $admsn_fee,
                        'updated_at'                 => date('Y-m-d H:i:s')
                      );

            if(isset($_FILES['image']) && $_FILES['image']!="" && !empty($_FILES['image']['name'])){
              $file_orignal_name = $_FILES['image']['name'];
              $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
              $path = 'institute/logo/';
              $image_name = time().uniqid().$file_orignal_name;
              $input_name = 'image';
              $result = $this->institute_model->upload_image($path, $image_name, $input_name);
              if ($result) {
                  $insert_array['institute_logo'] = $path.$image_name;
              }else{
                  $insert_array['institute_logo'] = "";
              } 
          } else{
              if(isset($_POST['old_logo']) && !empty($_POST['old_logo']))
              {
                 $insert_array['institute_logo'] = $_POST['old_logo']; 
              } else{
                  $insert_array['institute_logo'] = "";
              }
              
          }

          if(isset($_FILES['sig']) && $_FILES['sig']!="" && !empty($_FILES['sig']['name'])){
              $file_orignal_name = $_FILES['sig']['name'];
              $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
              $path = 'institute/sig/';
              $image_name = time().uniqid().$file_orignal_name;
              $input_name = 'sig';
              $result = $this->institute_model->upload_image($path, $image_name, $input_name);
              if ($result) {
                  $insert_array['institute_sig'] = $path.$image_name;
              }else{
                  $insert_array['institute_sig'] = "";
              } 
          } else{
              if(isset($_POST['old_sig']) && !empty($_POST['old_sig']))
              {
                 $insert_array['institute_sig'] = $_POST['old_sig']; 
              } else{
                  $insert_array['institute_sig'] = "";
              }
              
          }

          if($this->institute_model->updateAllData(TBL_INSTITUTE,$where,$insert_array))
          {
             $row = $this->institute_model->getAllDataArray('institute',$where);

              $session_data = array(
                'name'                  => $row[0]->institute_name,
                'mobile'                => $row[0]->institute_mobile,
                'landline'              => $row[0]->landline_no,
                'state'                 => $row[0]->state,
                'city'                  => $row[0]->city,
                'institute_address'     => $row[0]->institute_address,
                'payment_link'          => $row[0]->payment_api_key,
                'admission_fee'         => $row[0]->admission_fee,
                'facebook_link'         => $row[0]->facebook_link,
                'youtube_link'          => $row[0]->youtube_link,
                'google_business_link'  => $row[0]->google_business_link,
                'brochure_link'         => $row[0]->brochure_link,
                'refund_link'           => $row[0]->refund_link,
                'twitter_link'          => $row[0]->twitter_link,
                'instagram_link'        => $row[0]->instagram_link,
                'institute_logo'        => $row[0]->institute_logo,
                'institute_sig'         => $row[0]->institute_sig,
              );
              $this->session->set_userdata($session_data);
             echo json_encode(array('status'=>true, 'message'=>'Update Successful'));die;
          }else{
            echo json_encode(array('status'=>false, 'errormessage'=>'Update Failed !'));die;
          }

        }
    }

    public function deleteEnq(){
        if(isset($_POST) && !empty($_POST)){
            $enq_id      = $this->input->post("enq_id");
            
            $status=$this->institute_model->deleteData(TBL_ENQUIRY,'enquiry_id',$enq_id);
            if($status) {
                echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            } else {
                echo json_encode(array('status'=>false, 'errormessage'=>'Deletion Failed.'));die;
            }
        }
    }

    public function deleteCourse(){
        if(isset($_POST) && !empty($_POST)){
            $course_id      = $this->input->post("course_id");
            $status=$this->institute_model->deleteData(TBL_COURSES,'course_id',$course_id);
            if($status) {
                echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            } else {
                echo json_encode(array('status'=>false, 'errormessage'=>'Deletion Failed.'));die;
            }
        }
    }

    public function getEnqById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $enq_id      = $this->input->post("enq_id");
            
            $status=$this->institute_model->getAllData(TBL_ENQUIRY,'enquiry_id',$enq_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function getStudentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $student_id      = $this->input->post("student_id");
            
            $status=$this->institute_model->getAllData(TBL_STUDENT,'student_id',$student_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function viewStudent()
    {
      $session = $this->session_check();
      if($session == true)
      {
        $student_id = base64_decode($_GET['id']);
        $details = $this->institute_model->getStudentData($student_id);
        $payments = $this->institute_model->getPaymentData($student_id);
        $documents = $this->institute_model->getDocumentsDetails($student_id);
        $histories = $this->institute_model->getPaymentHistory($student_id);
    
        if($details != null)
        {
          $data['profile'] = $details;
          $data['payments'] = $payments;
          $data['documents'] = $documents;
          $data['histories'] = $histories;
          $data['site_title'] = "EDUWEGO | student";  
          $this->load->view('dashboard-includes/header', $data);
          $this->load->view('dashboard-includes/left-sidebar');
          $this->load->view('student_profile');
          $this->load->view('dashboard-includes/footer');
        }
      }
    }

    public function getStudentData()
    {
        $session = $this->session_check();
        if($session == true || $this->session->userdata('is_admin_in'))
        {
            $stu_id = $this->input->post('stu_id');
            $stu_data = $this->institute_model->getStudentById($stu_id);
            $payment_data = $this->institute_model->getPaymentData($stu_id);
            $merge_data = array_merge($stu_data,$payment_data);
            if($merge_data != null)
            {
                print_r(json_encode($merge_data));
            }
            else {
              echo json_encode(array('status'=>false, 'errormessage'=>'No Data Found.'));die;
          }
        }
    }

    public function add_package()
    {
      is_institute_in();
      $course_dur = $_POST['course_dur'];
      $student_id = $_POST['student_id'];
      $student_name = $_POST['full_name'];
      $package = $_POST['package'];
      $yearly_fees = [];
      for($i=1;$i <= $course_dur;$i++)
      {
        $yearly_fees[$i] = $_POST['yearly_fee_'.$i];
      }
             
      $yearly_fees;
      $package_data =array(
        'package'=> $package,
        'course_dur' => $course_dur
      );

      $status = $this->institute_model->addPackageDetails($student_id,$student_name,$package_data,$yearly_fees);
      if($status){
          echo json_encode(array('status'=>true, 'message'=>'Updation Success.'));die;

        }
        else {
          echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
        }

    }

    public function edit_fees()
    {
      $student_id = $_POST['student_id'];
      $package = $_POST['package'];
      $course_dur = $_POST['course_dur'];
      $yearly_fees = $_POST['yearly_fees'];
      if($course_dur == count($yearly_fees))
      {
        
        foreach($yearly_fees as $key=>$fees)
        {
          $yr_id = $key+1;
          $where = array('student_id'=>$student_id,'yr_id'=>$yr_id);
          $data = array('package'=>$package,'course_dur'=>$course_dur,'yearly_fee'=>$fees);
          $this->institute_model->updateAllData('fees',$where,$data);
          
          $where1 = array('student_id'=>$student_id);
          $data1 = array('package'=>$package,'course_dur'=>$course_dur);
          $this->institute_model->updateAllData('students',$where1,$data1);
        }
        
        echo json_encode(array('status'=>true, 'message'=>'Fees Updated Successfully !'));die;

      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Course Duration and number of yearly fees input field must be same !'));die;
      }
      

    }

    public function add_student(){
        $this->session_check();
        if(isset($_POST) && !empty($_POST)){
            $package                = $_POST['package'];
            $course_dur = $_POST['course_dur'];
            $student_id = $_POST['student_id'];
            $yearly_fees = [];
            $years = $_POST['fees_yr'];
            $total_fee = 0;
            for($i=1;$i <= $course_dur;$i++)
            {
              $yearly_fees[$i] = array(
                'fees'=>$_POST['yearly_fee_'.$i],
                'year'=>$years[$i-1]
              );
              $total_fee += $_POST['yearly_fee_'.$i];
            }
            $yearly_fees;

            if($package != $total_fee)
            {
              echo json_encode(array('status'=>false, 'errormessage'=>'Sum of yearly fees and total package must be same !'));die;
            }
             
            $save_type = $_POST['save_type'];
             
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
            $reffered_by            = $_POST['refferedBy'];
            $agent_name             = $_POST['agent_name'];
            $mobile                 = $_POST['number'];
            $email                  = $_POST['email'];
            $yoa                    = $_POST['admissionyer'];
            $address                = $_POST['address'];
            $city                   = $_POST['city'];
            $course_dur             = $_POST['course_dur'];
            $sub_institute_id       = $_POST['sub_institute'];
            $enquiry_status         = 1;
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");
            $institute_name = $_SESSION['name'];
            $institute_email = $_SESSION['email'];
            $institute_mobile = $_SESSION['mobile'];
            $landline = $_SESSION['landline'];
            $institute_address = $_SESSION['institute_address'];
            $completion_yr = $yoa+$course_dur;
            $online_enquiry_id  = isset($_POST['enquiry_id']) ? $_POST['enquiry_id'] : "";
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $pass =  substr(str_shuffle($permitted_chars), 0, 6);
            $enc_pass = md5($pass);

        if(isset($_FILES['image']) && $_FILES['image']!="" && !empty($_FILES['image']['name'])){
            $file_orignal_name = $_FILES['image']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_STUDENT_PHOTO;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'image';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
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
                                'reffered_by'               => $reffered_by, 
                                'mobile'                    => $mobile,
                                'email'                     => $email,
                                'yoa'                       => $yoa,
                                'completion_year'           => $completion_yr,
                                'address'                   => $address,
                                'student_status'            => $enquiry_status,
                                'agent_name'                => $agent_name,
                                'institute_id'              => $_SESSION['institute_id'],
                                'updated_at'                => $updated_at,
                                'package'                   => $package,
                                'course_dur'                => $course_dur,
                                'sub_institute_id'          => $sub_institute_id,
                                'password'                  => $enc_pass,
                                'city'                      => $city
                                );
          }else{
          
            $insert_data  = array(

                                'full_name'                 => $full_name,
                                's_w_d_of'                  => $s_w_d_of ,
                                'mother_name'               => $mother_name,
                                'occupation'                =>  $occupation,
                                'qualification'             => $qualification, 
                                'dob'                       => $dob ,
                                'gender'                    => $gender,
                                'course'                    => $course ,
                                'course_id'                 => $course_id ,
                                'stream'                    => $stream ,
                                'reffered_by'               => $reffered_by, 
                                'mobile'                    => $mobile,
                                'email'                     => $email,
                                'yoa'                       => $yoa,
                                'completion_year'           => $completion_yr,
                                'address'                   => $address,
                                'student_status'            => $enquiry_status,
                                'agent_name'                => $agent_name,
                                'institute_id'              => $_SESSION['institute_id'],
                                'student_photo'             => $student_photo,
                                'updated_at'                => $updated_at,
                                'package'                   => $package,
                                'course_dur'                => $course_dur,
                                'sub_institute_id'          => $sub_institute_id,
                                'password'                  => $enc_pass,
                                'city'                      => $city
                                );
            }

            if($_POST['student_id']=="" && $_POST['student_id']== NULL){
                
                $institute_id = $_SESSION['institute_id'];
                $where  = array('institute_id' => $institute_id );
                $checkLimit=$this->institute_model->getAllDataArray(TBL_INSTITUTE,$where);
        
                if($checkLimit[0]->institute_allowed_student<=$checkLimit[0]->institute_student_admited){

                    echo json_encode(array('status'=>false, 'errormessage'=>'Limit Reached.'));die;

                }
                $check_mobile =$this->institute_model->checkMobile($institute_id,$mobile);
                if($check_mobile == true)
                {
                  $status =$this->institute_model->insertStudentData(TBL_STUDENT,$insert_data,$yearly_fees);
                  if($status) {
                    $where  = array('institute_id' => $institute_id );
                    $update_data  = array('institute_student_admited' => 'institute_student_admited+1' );
                    $update_count=$this->institute_model->updateSingleData(TBL_INSTITUTE,$where,'institute_student_admited','institute_student_admited+1');
                      
                    if(!empty($online_enquiry_id))
                    {
                      $enq_data = array('online_enquiry_status' => 2 );
                      $where1  = array('institute_id' => $institute_id,'online_enquiry_id'=>$online_enquiry_id);
                      $this->institute_model->updateAllData(TBL_ONLINE_ENQUIRY,$where1,$enq_data);
                    }

                    $curl = curl_init();
                      curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => '{
                        "bounce_address":"return@bounce.apps.eduwego.in",
                        "from": { "address": "noreply@apps.eduwego.in"},
                        "to": [{"email_address": {"address": '.$email.',"name": '.$full_name.'}}],
                        "subject":"Login Details for Your Student Portal '.$institute_name.'",
                        "htmlbody":"<div>Welcome to '.$institute_name.' Please login to your College Student Portal with following details Username : '.$mobile.' Password : '.$pass.'.<br/><br/>This is System Generated Email, Please do not reply to this mail, To continue the conversation click here '.$institute_email.' to reply.<br/><br/><b>Thanks & Regards,<br/> Admission Director<br/>'.$institute_name.'<br/>'.$institute_address.'</b><br/>DISCLAIMER:<br/>This communication is confidential and privileged and is directed to and for the use of the addresses only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized. If you are not the intended recipient, please notify the sender by return email and immediately destroy all copies of this message and any attachments and delete it from your computer system permanently. The recipient acknowledges that Zeqon Technologies Private Limited may be unable to exercise control or ensure or guarantee the integrity of the text of the email message and the text is not warranted as to completeness and accuracy. Before opening and accessing the attachment, if any, please check and scan for virus.</div>",
                        }
                          ]
                        }',
                          CURLOPT_HTTPHEADER => array(
                          "accept: application/json",
                          "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                          "cache-control: no-cache",
                          "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                     // SEND SMS
                    $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
                    // Message details
            
                    $numbers = array($mobile);
                    $sender = urlencode('EDUWEG');
                    
                    $message = rawurlencode('Dear '.$full_name.' Welcome to '.$institute_name.'.Your Admission Has been confirmed. In case of any clarifications pls get in touch with our Admission Coordinators / Associates or college helpline on '.$landline.'.Thanks Eduwego');
                     
                    $numbers = implode(',', $numbers);
                     
                    // Prepare data for POST request
                    $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
                    // Send the POST request with cURL
                    $ch = curl_init('https://api.textlocal.in/send/');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Success.'));die;

                  } else {
                        echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                    }
                }
                else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Mobile number allready exists.Please try with another number'));die;
                }
                    
            }else{
                $student_id = $_POST['student_id'];
                $status=$this->institute_model->editStudentData($student_id,$insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }

    public function add_student_payment()
    {
      $institute_id = $this->session->userdata('institute_id');
      $institute_name = $this->session->userdata('name');
      $institute_email = $this->session->userdata('email');
      $institute_mobile = $this->session->userdata('mobile');
      $institute_address = $this->session->userdata('institute_address');
      $stu_id = $this->input->post('student_id');
      $where = array('institute_id'=>$institute_id,'student_id'=>$stu_id);
      $student = $this->institute_model->getAllDataArray('students',$where);
      $student_email = $student[0]->email;
      $student_mobile = $student[0]->mobile;
      $student_name = $this->input->post('student_name');
      $course = $student[0]->course;
      $stream = $student[0]->stream;
      $yr_id = $this->input->post('yr_id');
      $year = $this->input->post('year');
      $yearly_fees = $this->input->post('yr_fees');
      $prev_paid = $this->input->post('total_paid');
      $prev_due = $this->input->post('prev_due');
      $last_paid = (float)$this->input->post('paying_amount');
      $payment_mode = $this->input->post('payment_mode');
      $total_paid = $prev_paid+$last_paid;
      $total_due = $yearly_fees-$total_paid;
      $hostel_fee = (float)$this->input->post('hostel_fee');
      $misc_fee = (float)$this->input->post('misc_fee');
      $transport_fee = (float)$this->input->post('transport_fee');
      $books_fee = (float)$this->input->post('books_fee');
      $admission_fee = (float)$this->input->post('admission_fee');
      $university_fee = (float)$this->input->post('university_fee');
      $amount_in_words = $this->input->post('amount_in_words');
      $agent_discount = $this->input->post('agent_discount');
      $agent_id = $this->input->post('agent_id');
      $course_id = $this->input->post('course_id');
      $upi_id = $this->input->post('upi_id');
      $trans_id = $this->input->post('trans_id');
      $bank_name = $this->input->post('bank_name');
      $scholarship = $this->input->post('scholarship');
      $credit_card = $this->input->post('credit_card');
      $total_amount = ($last_paid+$hostel_fee+$misc_fee+$transport_fee+$books_fee+$admission_fee+$university_fee);
      
      if($last_paid == $prev_due || $last_paid < $prev_due )
      {
        $payment_data = array(
          'paid_amount' => $total_paid,
          'last_paid' => $last_paid,
          'due' => $total_due,
          'agent_discount' => $agent_discount
        );

        $insert_history_table = array(
          'student_id' =>  $stu_id,
          'yr_id' => $yr_id,
          'year'=> $year,
          'institute_id' => $institute_id,
          'course_id' => $course_id,
          'course_name' => $course,
          'stream' => $stream,
          'paid_amount' => $last_paid,
          'payment_mode' => $payment_mode,
          'hostel_fee' => $hostel_fee,
          'misc_fee' => $misc_fee,
          'transport_fee' => $transport_fee,
          'books_fee' => $books_fee,
          'admission_fee' => $admission_fee,
          'university_fee' => $university_fee,
          'total_fee'      => $total_amount,
          'amount_in_words' => $amount_in_words,
          'agent_id' => $agent_id,
          'agent_discount' => $agent_discount,
          'upi_id' => $upi_id,
          'transaction_id' => $trans_id,
          'bank_name' => $bank_name,
          'scholarship' => $scholarship,
          'credit_card' => $credit_card,
          'date' => date('Y-m-d')
        );
        // print_r($insert_history_table);exit;
        $status = $this->institute_model->insert_payment_data($stu_id,$yr_id,$payment_data,$insert_history_table);
        if($status)
        {
          //email send
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
              "bounce_address":"return@bounce.apps.eduwego.in",
              "from": { "address": "feepayment@apps.eduwego.in"},
              "to": [{"email_address": {"address": '.$student_email.',"name": '.$student_name.'}}],
              "subject":"Payment successfull",
              "htmlbody":"<div>Dear '.$student_name.' .Your Fee Amount of Rs. '.$total_amount.' has been received in '. $institute_name.'.Login to student portal to download the fee receipt.<br/>Thanks <br/><b>'.$institute_name.'</b> <br/> '.$institute_address.'<br/>'.$institute_email.'<br/>'.$institute_mobile.'</div>",
              }
                ]
              }',
                CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                "cache-control: no-cache",
                "content-type: application/json",
              ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

           // SEND SMS
            $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
            // Message details
    
            $numbers = array($student_mobile);
            $sender = urlencode('EDUWEG');
            
            $message = rawurlencode('Dear '.$student_name.' We have received an amount of '.$total_amount.' against fee deposit at '.$institute_name.' Thanks. Eduwego');
             
            $numbers = implode(',', $numbers);
             
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
          echo json_encode(array('status'=>true, 'message'=>'Payment added successfully.'));die;

        }
        else{
          echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
        }
      }
      else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Paying Amount can not be exceeded Due Amount.'));die;
      }
    
    }

    public function delEnqById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('enquiry_status' => 0 );
            $enquiry_id = $_POST['enq_id'];
                $where  = array('enquiry_id' => $enquiry_id );
                $status=$this->institute_model->updateAllData(TBL_ENQUIRY,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }


    public function delStudentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('student_status' => 0 );
            $student_id = $_POST['student_id'];
                $where  = array('student_id' => $student_id );
                $status=$this->institute_model->updateAllData(TBL_STUDENT,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }


    public function add_enquiry(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die; 
            $full_name              = $_POST['name'];
            $s_w_d_of               = $_POST['lastname'];
            $mother_name            = $_POST['mothersname'];
            $occupation             = $_POST['occupation'];
            $dob                    = $_POST['dob'];
            $gender                 = $_POST['gender'];
            $course                 = $_POST['course'];
            $stream                 = $_POST['stream'];
            $reffered_by            = $_POST['reffered'];
            $mobile                 = $_POST['number'];
            $email                  = $_POST['email'];
            $city                   = $_POST['cityvillage'];
            $timing                 = $_POST['timing'];
            $fee_commited           = $_POST['committed'];
            $discount_promissed     = $_POST['discount'];
            $net_fee_applicable     = $_POST['Fees'];
            $reminder_date          = $_POST['admissionyer'];
            $remark                 = $_POST['remark'];
            $lead_status            = $_POST['lead_status'];
            $address                = $_POST['address'];
            $enquiry_status         = 1;
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");


            $insert_data  = array(

                                'full_name'                 => $full_name,
                                's_w_d_of'                  => $s_w_d_of ,
                                'mother_name'               => $mother_name, 
                                'occupation'                => $occupation ,
                                'dob'                       => $dob ,
                                'gender'                    => $gender,
                                'course'                    => $course ,
                                'stream'                    => $stream ,
                                'reffered_by'               => $reffered_by, 
                                'mobile'                    => $mobile,
                                'email'                     => $email,
                                'city'                      => $city,
                                'address'                   => $address,
                                'timing'                    => $timing, 
                                'fee_commited'              => $fee_commited,
                                'discount_promissed'        => $discount_promissed,
                                'net_fee_applicable'        => $net_fee_applicable,
                                'reminder_date'             => $reminder_date,
                                'remark'                    => $remark,
                                'enquiry_status'            => $enquiry_status,
                                'lead_status'               => $lead_status,
                                'institute_id'              => $_SESSION['institute_id'],
                                'updated_at'                => $updated_at
                                );

            if(($_POST['enquiry_id'] == "" && $_POST['enquiry_id'] == NULL)){
                $status=$this->institute_model->insertData(TBL_ENQUIRY,$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else{
                $enquiry_id = $_POST['enquiry_id'];
                $where  = array('enquiry_id' => $enquiry_id );
                $status=$this->institute_model->updateAllData(TBL_ENQUIRY,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    $error_message = $this->db->error(); 
                    // $error_message = $this->db->last_query(); 
                    // print_r($error_message); die;
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }

    public function studentPaymentDetails()
    {
      $session = $this->session_check();
      if($session == true)
      {
        $student_id = base64_decode($_GET['id']);
        $institute_id = $_SESSION['institute_id'];
        $details = $this->institute_model->getPaymentData($student_id);
        $history = $this->institute_model->getPaymentHistory($student_id);

        $where = array('institute_id'=>$institute_id,'student_id'=>$student_id);
        $payment_info['general_receipts'] = $this->institute_model->getDataByDesc('general_receipts',$where,'receipt_id');
        $payment_info['payments'] = $details;
        $payment_info['histories'] = $history;
        $data['site_title'] = "EDUWEGO | Payments";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('student_payments',$payment_info);
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function noDueCertificate()
    {
      $institute_id = $_SESSION['institute_id'];
      $student_id = base64_decode($_GET['student_id']);
      $yr_id = base64_decode($_GET['yr_id']);
      $histories = $this->institute_model->yearlyPaymentHistory($student_id,$yr_id);
      $institute = $this->institute_model->fetchInstituteData($institute_id);
      $student = $this->institute_model->fetchStudentData($student_id);
      $sub_institute_id = $student[0]->sub_institute_id;
      $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
      $total_paid = 0;
      $last_id;
      $hostel_fee =0;
      $misc_fee =0;
      $transport_fee =0;
      $books_fee =0;
      $university_fee =0;
      foreach($histories as $history)
      {
        $last_date = strtotime($history->date);
        $last_date = date('d-m-Y',$last_date);
        $payment_mode = $history->payment_mode;
        $last_id = $history->payment_id;
        $total_paid += $history->paid_amount;
        $hostel_fee += $history->hostel_fee;
        $misc_fee += $history->misc_fee;
        $transport_fee += $history->transport_fee;
        $books_fee += $history->books_fee;
        $university_fee += $history->hostel_fee;
      }

      $institute_logo = base_url().'uploads/'.$institute[0]->institute_logo;

      $grand_total = ($total_paid+$hostel_fee+$misc_fee+$transport_fee+$books_fee+$university_fee);
      
      $html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>Receipt</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:1000px;
                      border:5px solid #ccc; 
                    }
                    .clg_header{
                      height:130px;
                      border-bottom:3px solid #ccc;
                      
                    }
                    .clg_header .logo_box{
                      width:15%;
                      height:100px;
                    }
                    .clg_header .name_box{
                      width:80%;
                      
                    }
                    .clg_header .name_box h4{
                      padding:0;
                      margin:0;

                    }

                    .clg_header .name_box p{
                      font-size:13px;
                      padding:0;
                      margin:0;
                    }

                    .logo_box .logo{
                      width:100px;
                      height:100px;
                      border-radius:50%;
                      margin:15px auto;
                    }

                    .receipt_details{
                      height:auto;
                      padding:5px;
                    }

                    .receipt_details p{
                      font-size:13px;
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
                        <div class="logo_box" style="float:left">
                          <div class="logo">
                            <img src="'.$institute_logo.'" width="100%" />
                          </div>  
                        </div>
                        <div class="name_box" style="float:right">
                          <center>
                            <h4 style="margin-top:7px">'.$institute[0]->institute_name.'</h4>
                            <p>'.$sub_institute[0]->sub_institute_name.'</p>
                            <p>Address:'.$institute[0]->institute_address.'</p>
                            <p>Contact: '.$institute[0]->institute_mobile.', email: '.$institute[0]->institute_email.'</p>
                          </center>
                        </div>
                      </div>
                      <div class="receipt_details" style="padding:8px">
                        <center>
                          <h5 style="text-transform:uppercase;margin-top:3px;margin-bottom:5px">STUDENT COPY</h5>
                          <h6 style="font-weight:bold;margin-top:5px"><u>NO DUE CERTIFICATE TO BE OBTAINED BY STUDENTS BEFORE GOING TO EXAMINATION</u>- 20___- 20___ </h6>
                          
                        </center>
                        
                        <p style="line-height:20px;padding:0;margin:0;font-size:14px">This is to certify that Mr/Mrs <u style="text-transform:uppercase">'.$student[0]->full_name.'</u> student of <u style="text-transform:uppercase">'.$student[0]->course.'</u> in <u style="text-transform:uppercase">'.$student[0]->stream.'</u> branch, year- <b>'.$yr_id.'</b> has Cleared/not Cleared, Mess Fees/Academical Fees Cleared and returned all the library books/ not returned, Returned all Articles/ not returned articles taken from college/school .</p>

                        <center><h4 style="padding:0;margin:5px">May issue/ not issue Hall Ticket</h4></center>

                        <p style="font-size:13px">1. Cashier : _________________</p>
                        <p style="font-size:13px">2. Accountant : ________________</p>
                        <p style="font-size:13px">3. Librarian : ________________</p>

                        <table style="width:100%;margin-top:40px">
                          <tr>
                            <td>PRINCIPAL<td>
                            <td style="text-align:right">CHAIRMAN<td>
                          </tr>
                        </table>
                        
                      </div>
                      <hr />

                      <div class="clg_header">
                        <div class="logo_box" style="float:left">
                          <div class="logo">
                            <img src="'.$institute_logo.'" width="100%" />
                          </div>  
                        </div>
                        <div class="name_box" style="float:right">
                          <center>
                            <h4 style="margin-top:7px">'.$institute[0]->institute_name.'</h4>
                            <p>Address:'.$institute[0]->institute_address.'</p>
                            <p>Contact: '.$institute[0]->institute_mobile.', email: '.$institute[0]->institute_email.'</p>
                          </center>
                        </div>
                      </div>
                      <div class="receipt_details" style="padding:8px">
                        <center>
                          <h5 style="text-transform:uppercase;margin-top:5px;margin-bottom:5px">COLLEGE COPY</h5>
                          <h6 style="font-weight:bold;margin-top:5px"><u>NO DUE CERTIFICATE TO BE OBTAINED BY STUDENTS BEFORE GOING TO EXAMINATION</u>- 20___- 20___ </h6>
                        </center>
                        
                        <p style="line-height:20px;padding:0;margin:0">This is to certify that Mr/Mrs <u style="text-transform:uppercase">'.$student[0]->full_name.'</u> student of <u style="text-transform:uppercase">'.$student[0]->course.'</u> in <u style="text-transform:uppercase">'.$student[0]->stream.'</u> branch, year- <b>'.$yr_id.'</b> has Cleared/not Cleared, Mess Fees/Academical Fees Cleared and returned all the library books/ not returned, Returned all Articles/ not returned articles taken from college/school .</p>

                        <center><h4 style="padding:0;margin:5px">May issue/ not issue Hall Ticket</h4></center>

                        <p style="font-size:13px">1. Cashier : _________________</p>
                        <p style="font-size:13px">2. Accountant : ________________</p>
                        <p style="font-size:13px">3. Librarian : ________________</p>

                        <table style="width:100%;margin-top:40px">
                          <tr>
                            <td>PRINCIPAL<td>
                            <td style="text-align:right">CHAIRMAN<td>
                          </tr>
                        </table>
                        
                      </div>

                    </div>
                    
                  </body>
                  </html>';

      $this->pdf->loadHtml($html);
      $this->pdf->set_paper('A4', 'portrait');
      $this->pdf->render();
      $this->pdf->stream("receipt.pdf", array("Attachment"=>0));

    }

    public function receiptFromHistory()
    {
      $institute_id = $_SESSION['institute_id'];
      $payment_id = base64_decode($_GET['id']);
      $yr_id = base64_decode($_GET['yr']);
      $copy_type = base64_decode($_GET['copy']);
      $history = $this->institute_model->particularPaymentHistory($payment_id);
      $student_id = $history[0]->student_id;
      $date = strtotime($history[0]->date);
      $date = date('d-m-Y',$date);
      $institute = $this->institute_model->fetchInstituteData($institute_id);
      if($institute[0]->landline_no != "")
      {
        $phone = $institute[0]->landline_no;
      }else{
        $phone = $institute[0]->institute_mobile;
      }
      $institute_logo = base_url().'uploads/'.$institute[0]->institute_logo;
      $student = $this->institute_model->fetchStudentData($student_id);
      $sub_institute_id = $student[0]->sub_institute_id;
      $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
      $fees = $this->institute_model->fetchFeesData($student_id,$yr_id);
      $payment_history = $this->institute_model->yearlyPaymentHistory($student_id,$yr_id);
      
      $total_yearly_paid = 0;
      if(!empty($payment_history))
      {
        foreach($payment_history as $his)
        {
          $total_yearly_paid += $his->total_fee;
        }
      }
      $yearly_fee = $fees[0]->yearly_fee;

      $year_id = $history[0]->yr_id;
      $year = $year_id == '1' ? '1st' : null;
      $year = $year_id == '2' ? '2nd' : null;
      $year = $year_id == '3' ? '3rd' : null;
      $year = $year_id == '4' ? '4th' : null;
      $year = $year_id == '5' ? '5th' : null;
      if($year_id == 1)
      {
        $year = '1st';
      }

      $grand_total = $history[0]->paid_amount+$history[0]->hostel_fee+$history[0]->misc_fee+$history[0]->transport_fee+$history[0]->books_fee+$history[0]->university_fee+$history[0]->clinical_fee;
      $total_in_words = '<script>toWords('.$grand_total.')</script>';
      $html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>'.$student[0]->full_name.'_Receipt</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:520px;
                      border:3px solid #ccc; 
                    }
                    .clg_header{
                      height:110px;
                      border-bottom:3px solid #ccc;
                    }
                    .clg_header .logo_box{
                      width:20%;
                      height:100px;
                      float:left;
                      
                    }
                    .clg_header .logo_box .logo{
                      width:100px;
                      height:100px;
                      margin-top:8px;
                    }
                    .clg_header .name_box{
                      width:80%;
                      float:right;
                    }
                    .clg_header .name_box h4{
                      padding:0;
                      margin-bottom:4px;
                    }
                    .clg_header .name_box p{
                      font-size:12px;
                      padding:0;
                      margin:0;
                    }
                    .logo_box .logo{
                      width:100%;
                      border-radius:50%;
                      margin:30px auto;
                    }

                    .receipt_details{
                      width:100%;
                      height:auto;
                      padding:2px;
                    }
                    .receipt_details h5{
                      padding : 0;
                      margin : 0;
                    }
                    .receipt_details table tr td{
                      margin-left:20%;
                    }
                    .fee_details{
                      height:auto;
                      border-bottom:3px solid #ccc;
                      padding:2px;
                    }
                    .fee_details table tr td{
                      border:1px solid #ccc;
                      padding:2px;
                      font-size:13px;
                    }
                    .fee_details table tr th{
                      border:1px solid #ccc;
                      padding:2px;
                    }
                    
                    .misc_details p{
                      font-size:12px;
                      padding:0;
                      margin:0;
                    }
                    .receipt_details tr td{
                      font-size:13px;
                    }
                    .receipt-type h5{
                      text-transform: uppercase;
                      padding:0;
                      margin-bottom:0;
                    }
                  </style>
                  </head>
                  <body>
                    <div class="main_div">
                      <div class="clg_header">
                        <div class="logo_box">
                          <div class="logo">
                            <img src="'.$institute_logo.'" width="100%" />
                          </div>  
                        </div>
                        <div class="name_box">
                          <center>
                            <h4 style="font-weight:bold; margin-top:7px;margin-bottom:4px">'.$institute[0]->institute_name.'</h4>
                            <p>'.$sub_institute[0]->sub_institute_name.'</p>
                            <p>Address:'.$institute[0]->institute_address.'</p>
                            <p>Ph. : '.$phone.', email: '.$institute[0]->institute_email.'</p>
                          </center>
                        </div>
                        <div class="receipt-type">
                          <center>
                            <h5><u>'.$copy_type.' RECEIPT COPY</u></h5>
                          </center>
                        </div>
                      </div>
                      
                      <div class="receipt_details">
                        
                        <table style="width:100%">
                          <tr>
                            <td style="text-align:left;width:60%">Receipt No. : '.(1000+$payment_id).'</td>
                            <td style="text-align:left;text-transform:capitalize">Date : '.$date.'</td>
                          </tr>
                          <tr>
                            <td style="text-align:left;width:60%";text-transform:capitalize">Stream : '.$student[0]->stream.'</td>
                            <td style="text-align:left;text-transform:capitalize">Name : '.$student[0]->full_name.'</td>
                          </tr>
                          
                          <tr>
                            <td style="text-align:left;width:60%">Total Package(Rs) : '.$student[0]->package.'</td>
                            <td style="text-align:left;text-transform:capitalize">'.$year.' Year Total Fees : Rs.'.$yearly_fee.'</td>
                          </tr>
                          <tr>
                            <td style="text-align:left;width:60%">'.$year.' Year Total Fees Paid : Rs.'.$total_yearly_paid.'</td>
                            <td style="text-align:left;text-transform:capitalize">'.$year.' Year Total Fees Due : Rs.'.($yearly_fee-$total_yearly_paid).'</td>
                          </tr>
                          
                        </table>
                        
                      </div>
                      <div class="fee_details">
                        <table style="width:100%;">
                          <tr>
                            <th style="font-size:15px">Sl.</th>
                            <th style="font-weight:bold;font-size:15px">Fee Particulars</th>
                            <th style="font-size:15px">Amount(Rs)</th>
                          </tr>
                          <tr>
                            <td>1.</td>
                            <td style="">Admission Fees</td>
                            <td>'.$history[0]->admission_fee.' /-</td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td style="">Tution Fees</td>
                            <td>'.$history[0]->paid_amount.' /-</td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td style="">Hostel Fees</td>
                            <td>'.$history[0]->hostel_fee.' /-</td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td style="">Miscellaneous Fees</td>
                            <td>'.$history[0]->misc_fee.' /-</td>
                          </tr>
                          <tr>
                            <td>5.</td>
                            <td style="">Transport Fees</td>
                            <td>'.$history[0]->transport_fee.' /-</td>
                          </tr>
                          <tr>
                            <td>6.</td>
                            <td style="">Books Fees</td>
                            <td>'.$history[0]->books_fee.' /-</td>
                          </tr>
                          <tr>
                            <td>7.</td>
                            <td style="">University Fees</td>
                            <td>'.$history[0]->university_fee.' /-</td>
                          </tr>
                          
                          <tr>
                            <td style="text-align:right;font-weight:bold" colspan="2">Grand Total</td>
                            <td>'.$history[0]->total_fee.' /-</td>
                          </tr>
                        </table>
                      </div>
                      <div class="misc_details" style="padding:3px;display:flex">
                        <table style="width:100%">
                          <tr>
                            <td>
                              <p style="width:95%">Payment Mode : '.$history[0]->payment_mode.'</p>
                              <p style="width:95%">Transaction Id. : '.$history[0]->transaction_id.'</p>
                              <p style="width:95%">Bank Name : '.$history[0]->bank_name.'</p>
                              <p>Rupees in Words:'.$history[0]->amount_in_words.'</p>
                              <p>Note : Fees once paid cannot be refunded.</p>
                              
                            </td>
                            <td style="text-align:center"><p style="">Receiving Signature</p></td>
                          </tr>
                          <tr>
                            <td colspan="2" style="">
                              <p>To verify this Fee Receipt Login to your student panel with your mobile number and check Fee receipt Section or check your mobile sms.</p>
                            </td>
                          </tr>
                        </table>
                      </div>
                      
                    </div>
                    
                  </body>
                  </html>';

      $this->pdf->loadHtml($html);
      $this->pdf->set_paper('A4', 'portrait');
      $this->pdf->render();
      $this->pdf->getCanvas();
      $this->pdf->stream($student[0]->full_name."_receipt.pdf", array("Attachment"=>0));
    }


    public function add_staff(){
        $institute_id = $_SESSION['institute_id'];
        if(!isset($_POST['employee_id']) || $_POST['employee_id'] == "" || $_POST['employee_id'] == NULL){
          $empCount = $this->db->query("SELECT COUNT(employee_id) as emp FROM staff WHERE institute_id = '".$institute_id."' ")->row();
          $total_emp = $empCount->emp;
          $empAllowed = $this->db->query("SELECT emp_allowed FROM institute WHERE institute_id = '".$institute_id."' ")->row();
          $max_emp = $empAllowed->emp_allowed;
          if($total_emp >= $max_emp)
          {
            echo json_encode(array('status'=>false, 'errormessage'=>'Maximum '.$max_emp.' number of employee(s) allowed !'));die;
          }
        }
        
        if(isset($_POST) && !empty($_POST)){
            $staffname                  = $_POST['staffname'];
            $number                     = $_POST['number'];
            $email                      = $_POST['email'];
            $location                   = $_POST['location'];
            $address                    = $_POST['address'];
            $role                       = $_POST['role'];
            $creatdate                  = date('Y-m-d',strtotime($_POST['creatdate']));
            $status                     = $_POST['status'];
            $department                 = $_POST['department'];
            $location                   = $_POST['location'];
            $created_at                 = date("Y-m-d H:i:s");
            $updated_at                 = date("Y-m-d H:i:s");
            $institute_id               = $_SESSION['institute_id'];
            $institute_name             = $_SESSION['name'];
            $join_date                  = date('dmy',strtotime($_POST['creatdate']));

            $dashboard = isset($_POST['dashboard']) ? $_POST['dashboard'] : "";
            $dashboard_edit = isset($_POST['dashboard_edit']) ? $_POST['dashboard_edit'] : "";
            $dashboard_delete = isset($_POST['dashboard_delete']) ? $_POST['dashboard_delete'] : "";
            $inbox = isset($_POST['inbox']) ? $_POST['inbox'] : "";
            $inbox_edit = isset($_POST['inbox_edit']) ? $_POST['inbox_edit'] : "";
            $inbox_delete = isset($_POST['inbox_delete']) ? $_POST['inbox_delete'] : "";
            $leads = isset($_POST['leads']) ? $_POST['leads'] : "";
            $leads_edit = isset($_POST['leads_edit']) ? $_POST['leads_edit'] : "";
            $leads_delete = isset($_POST['leads_delete']) ? $_POST['leads_delete'] : "";
            $student_search = isset($_POST['student_search']) ? $_POST['student_search'] : "";
            $student_search_edit = isset($_POST['student_search_edit']) ? $_POST['student_search_edit'] : "";
            $student_search_delete = isset($_POST['student_search_delete']) ? $_POST['student_search_delete'] : "";
            $students = isset($_POST['students']) ? $_POST['students'] : null;
            $students_edit = isset($_POST['students_edit']) ? $_POST['students_edit'] : null;
            $students_delete = isset($_POST['students_delete']) ? $_POST['students_delete'] : null;
            $admission = isset($_POST['admission']) ? $_POST['admission'] : null;
            $admission_edit = isset($_POST['admission_edit']) ? $_POST['admission_edit'] : null;
            $admission_delete = isset($_POST['admission_delete']) ? $_POST['admission_delete'] : null;
            $associate = isset($_POST['associate']) ? $_POST['associate'] : null;
            $associate_edit = isset($_POST['associate_edit']) ? $_POST['associate_edit'] : null;
            $associate_delete = isset($_POST['associate_delete']) ? $_POST['associate_delete'] : null;
            $assos_req = isset($_POST['assos_req']) ? $_POST['assos_req'] : null;
            $assos_req_edit = isset($_POST['assos_req_edit']) ? $_POST['assos_req_edit'] : null;
            $assos_req_delete = isset($_POST['assos_req_delete']) ? $_POST['assos_req_delete'] : null;
            $institutes = isset($_POST['institutes']) ? $_POST['institutes'] : null;
            $institutes_edit = isset($_POST['institutes_edit']) ? $_POST['institutes_edit'] : null;
            $institutes_delete = isset($_POST['institutes_delete']) ? $_POST['institutes_delete'] : null;
            $fee_mgmt = isset($_POST['fee_mgmt']) ? $_POST['fee_mgmt'] : null;
            $fee_mgmt_edit = isset($_POST['fee_mgmt_edit']) ? $_POST['fee_mgmt_edit'] : null;
            $fee_mgmt_delete = isset($_POST['fee_mgmt_delete']) ? $_POST['fee_mgmt_delete'] : null;
            $courses = isset($_POST['courses']) ? $_POST['courses'] : null;
            $courses_edit = isset($_POST['courses_edit']) ? $_POST['courses_edit'] : null;
            $courses_delete = isset($_POST['courses_delete']) ? $_POST['courses_delete'] : null;
            $stream = isset($_POST['stream']) ? $_POST['stream'] : null;
            $stream_edit = isset($_POST['stream_edit']) ? $_POST['stream_edit'] : null;
            $stream_delete = isset($_POST['stream_delete']) ? $_POST['stream_delete'] : null;
            $vendor = isset($_POST['vendor']) ? $_POST['vendor'] : null;
            $vendor_edit = isset($_POST['vendor_edit']) ? $_POST['vendor_edit'] : null;
            $vendor_delete = isset($_POST['vendor_delete']) ? $_POST['vendor_delete'] : null;
            $reports = isset($_POST['reports']) ? $_POST['reports'] : null;
            $reports_edit = isset($_POST['reports_edit']) ? $_POST['reports_edit'] : null;
            $reports_delete = isset($_POST['reports_delete']) ? $_POST['reports_delete'] : null;
            $sms = isset($_POST['sms']) ? $_POST['sms'] : null;
            $sms_edit = isset($_POST['sms_edit']) ? $_POST['sms_edit'] : null;
            $sms_delete = isset($_POST['sms_delete']) ? $_POST['sms_delete'] : null;
            $social_media = isset($_POST['social_media']) ? $_POST['social_media'] : null;
            $social_media_edit = isset($_POST['social_media_edit']) ? $_POST['social_media_edit'] : null;
            $social_media_delete = isset($_POST['social_media_delete']) ? $_POST['social_media_delete'] : null;

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $pass =  substr(str_shuffle($permitted_chars), 0, 6);
            $enc_pass = md5($pass);

            $insert_data  = array(
                            'employee_name'                 => $staffname,
                            'employee_mobile'               => $number,
                            'employee_email'                => $email,
                            'emp_password'                  => $enc_pass,
                            'employee_address'              => $address,
                            'employee_designation'          => $role,
                            'date_of_joining'               => $creatdate,
                            'employee_status'               => $status,
                            'institute_id'                  => $institute_id,
                            'location'                      => $location,
                            'department'                    => $department,
                            'updated_at'                    => $updated_at
                            );

            $emp_menus = array(
                          'institute_id' => $institute_id,
                          'dashboard'  => $dashboard,
                          'dashboard_edit' => $dashboard_edit,
                          'dashboard_delete' => $dashboard_delete,
                          'inbox'  => $inbox,
                          'inbox_edit' => $inbox_edit,
                          'inbox_delete' => $inbox_delete,
                          'search'  => $student_search,
                          'search_edit' => $student_search_edit,
                          'search_delete' => $student_search_delete,
                          'leads'  => $leads,
                          'leads_edit' => $leads_edit,
                          'leads_delete' => $leads_delete,
                          'admission'  => $admission,
                          'admission_edit' => $admission_edit,
                          'admission_delete' => $admission_delete,
                          'students'  => $students,
                          'students_edit' => $students_edit,
                          'students_delete' => $students_delete,
                          'associate'  => $associate,
                          'associate_edit' => $associate_edit,
                          'associate_delete' => $associate_delete,
                          'assos_req'  => $assos_req,
                          'assos_req_edit' => $assos_req_edit,
                          'assos_req_delete' => $assos_req_delete,
                          'institutes'  => $institutes,
                          'institutes_edit' => $institutes_edit,
                          'institutes_delete' => $institutes_delete,
                          'fee_mgmt'  => $fee_mgmt,
                          'fee_mgmt_edit' => $fee_mgmt_edit,
                          'fee_mgmt_delete' => $fee_mgmt_delete,
                          'courses'  => $courses,
                          'courses_edit' => $courses_edit,
                          'courses_delete' => $courses_delete,
                          'stream'  => $stream,
                          'stream_edit' => $stream_edit,
                          'stream_delete' => $stream_delete,
                          'vendor'  => $vendor,
                          'vendor_edit' => $vendor_edit,
                          'vendor_delete' => $vendor_delete,
                          'reports'  => $reports,
                          'reports_edit' => $reports_edit,
                          'reports_delete' => $reports_delete,
                          'sms'  => $sms,
                          'sms_edit' => $sms_edit,
                          'sms_delete' => $sms_delete,
                          'social_media'  => $social_media,
                          'social_media_edit' => $social_media_edit,
                          'social_media_delete' => $social_media_delete,
                        );

            if(isset($_FILES['image']) && $_FILES['image'] !="" && !empty($_FILES['image']['name'])){
                  $file_orignal_name = $_FILES['image']['name'];
                  $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
                  // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
                  $path = 'institute/employee/';
                  $image_name = time().uniqid().$file_orignal_name;
                  $input_name = 'image';
                  $result = $this->institute_model->upload_image($path, $image_name, $input_name);
                  // echo '<pre>'; print_r($result); echo '</pre>';
                  if ($result) {
                      if(!empty($photo_hidden))
                      {
                        if(file_exists('./uploads/'.$path))
                        {
                          unlink('./uploads/'.$path);
                        }

                      }
                      $insert_data['emp_photo'] = $path.$image_name; 
                  } else{
                     echo json_encode(array('status'=>false, 'message'=>'Employee Photo Upload Failed'));die;
                  }
            }

            if(!isset($_POST['employee_id']) || $_POST['employee_id'] == "" || $_POST['employee_id'] == NULL){
              $check_email =$this->institute_model->checkEmailOfStaff($institute_id,$email);
              if($check_email == true)
              {
                $check_mobile =$this->institute_model->checkMobileOfStaff($institute_id,$number);
                if($check_mobile == true)
                {
                  $status=$this->institute_model->insertData(TBL_STAFF,$insert_data);
                  if($status) {
                      $emp_id = $this->db->insert_id();
                      $code = "";
                      for($i=0;$i<3;$i++)
                      {
                        $code .= $institute_name[$i];
                      }
                      $name_code = strtoupper($code);
                      
                      $emp_code = $name_code."".$join_date."".$emp_id;
                      $emp_code_data = array('emp_code'=>$emp_code);
                      $where = array('employee_id'=>$emp_id);
                      $this->institute_model->updateAllData(TBL_STAFF,$where,$emp_code_data);

                      $emp_menus['emp_id'] = $emp_id;
                      $emp_menus['created_at'] = date('Y-m-d H:i:s');

                      $this->institute_model->insertData('emp_menus',$emp_menus);
                      
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => '{
                        "bounce_address":"return@bounce.apps.eduwego.in",
                        "from": { "address": "noreply@apps.eduwego.in"},
                        "to": [{"email_address": {"address": '.$email.',"name": '.$staffname.'}}],
                        "subject":"Login Details for Your Employee Portal at '.$institute_name.'",
                        "htmlbody":"<div>Dear, '.$staffname.', your account has been created for employee portal of '.$institute_name.' . Here below is the login credentials.<br/><b>Login URL</b> : '.base_url('employee-login').'<br/><b>Username/Email :</b> '.$email.'<br/><b>Password :</b> '.$pass.'</div>",
                        }
                          ]
                        }',
                          CURLOPT_HTTPHEADER => array(
                          "accept: application/json",
                          "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                          "cache-control: no-cache",
                          "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);
                      echo json_encode(array('status'=>true, 'message'=>'Employee added successfully !'));die;
                  } else {
                      echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add employee !'));die;
                  }
                }else{
                  echo json_encode(array('status'=>false, 'errormessage'=>'Employee with same mobile number already exists !'));die;
                }
              }
              else{
                 echo json_encode(array('status'=>false, 'errormessage'=>'Employee with same email id already exists !'));die;
              }
            }else{
                $employee_id = $_POST['employee_id'];
                $where  = array('employee_id' => $employee_id,'institute_id'=>$institute_id);
                $status=$this->institute_model->updateAllData(TBL_STAFF,$where, $insert_data);
                if($status) {
                    $emp_menus['updated_at'] = date('Y-m-d H:i:s');
                    $where1 = array('emp_id' => $employee_id,'institute_id'=>$institute_id);
                    $this->institute_model->updateAllData('emp_menus',$where1, $emp_menus);
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }

            }
        }
    }


    public function delStaffById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('stream_status' => 0 );
            $employee_id = $_POST['employee_id'];
                $where  = array('employee_id' => $employee_id );
                $status=$this->institute_model->updateAllData(TBL_STAFF,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }



    public function add_stream(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die; 
            $course_name           = $_POST['selectname'];
            $streamname            = $_POST['streamname'];
            $description           = $_POST['description'];
            $eligibility           = $_POST['eligibility'];
            $created_at            = date("Y-m-d H:i:s");
            $updated_at            = date("Y-m-d H:i:s");
            $institute_id          = $_SESSION['institute_id'];

            $insert_data  = array(

                                'stream_name'               => $streamname,
                                'stream_discription'        => $description,
                                'eligibility'               => $eligibility,
                                'course'                    => $course_name,
                                'institute_id'              => $institute_id,
                                'stream_status'             => 1,
                                'updated_at'                => $updated_at
                                );

            if($_POST['stream_id']==""){
                $status=$this->institute_model->insertData(TBL_STREAM,$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else{
                $stream_id = $_POST['stream_id'];
                $where  = array('stream_id' => $stream_id );
                $status=$this->institute_model->updateAllData(TBL_STREAM,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }


    public function delStreamById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('stream_status' => 0 );
            $stream_id = $_POST['stream_id'];
                $where  = array('stream_id' => $stream_id );
                $status=$this->institute_model->updateAllData(TBL_STREAM,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }


    public function add_vendor(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die; 
            $subagentname           = $_POST['agentName'];
            $number                 = $_POST['number'];
            $location               = $_POST['location'];
            $creatdate              = $_POST['creatdate'];
            $kyc                    = $_POST['kyc'];
            $address                = $_POST['address'];
            $gst                    = $_POST['gst_number'];
            $id_back                = $_POST['back_hidden'];
            $id_front                = $_POST['front_hidden'];
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");
            $institute_id           = $_SESSION['institute_id'];



        if(isset($_FILES['id_back']) && $_FILES['id_back']!="" && !empty($_FILES['id_back']['name'])){
            $file_orignal_name = $_FILES['id_back']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_VENDOR_ID;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_back';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if ($result) {
                $id_back = $path.$image_name;
            }else{
                echo json_encode(array('status'=>false, 'message'=>'Agent ID Upload Failed'));die;
            }
        }

        if(isset($_FILES['id_front']) && $_FILES['id_front']!="" && !empty($_FILES['id_front']['name'])){
            $file_orignal_name = $_FILES['id_front']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_VENDOR_ID;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_front';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if ($result) {
                $id_front = $path.$image_name;
            }else{
                echo json_encode(array('status'=>false, 'message'=>'Agent ID Upload Failed'));die;
            }
        }


            $insert_data  = array(

                                'vendor_name'            => $subagentname,
                                'vendor_mobile'          => $number,
                                'vendor_location'        => $location,
                                'vendor_address'         => $address,
                                'vendor_gst'             => $gst,
                                'vendor_created_date'    => $creatdate,
                                'institute_id'           => $institute_id,
                                'vendor_status'          => 1,
                                'id_front'              => $id_front,
                                'id_back'               => $id_back,
                                'vendor_kyc'             => $kyc,
                                'updated_at'                => $updated_at
                                );

            if($_POST['vendor_id'] == ""){
                $status=$this->institute_model->insertData(TBL_VENDOR,$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else{
                $vendor_id = $_POST['vendor_id'];
                $where  = array('vendor_id' => $vendor_id );
                $status=$this->institute_model->updateAllData(TBL_VENDOR,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }


    public function delVendorById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('sub_agent_status' => 0 );
            $vendor_id = $_POST['vendor_id'];
                $where  = array('vendor_id' => $vendor_id );
                $status=$this->institute_model->updateAllData(TBL_VENDOR,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }


    

    public function add_sub_agent(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die; 
            $subagentname           = $_POST['subagentname'];
            $number                 = $_POST['number'];
            $location               = $_POST['location'];
            $creatdate              = $_POST['creatdate'];
            $kyc                    = $_POST['kyc'];
            $address                = $_POST['address'];
            $agent_id                = $_POST['agentname'];
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");
            $institute_id           = $_SESSION['institute_id'];

            $insert_data  = array(

                                'sub_agent_name'            => $subagentname,
                                'sub_agent_mobile'          => $number,
                                'sub_agent_location'        => $location,
                                'sub_agent_address'         => $address,
                                'sub_agent_created_date'    => $creatdate,
                                'institute_id'              => $institute_id,
                                'agent_id'                  => $agent_id,
                                'sub_agent_status'          => 1,
                                'updated_at'                => $updated_at
                                );

            if(!isset($_POST['sub_agent_id']) || $_POST['sub_agent_id'] == "" || $_POST['sub_agent_id'] == NULL){
                $status=$this->institute_model->insertData(TBL_SUB_AGENTS,$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else{
                $sub_agent_id = $_POST['sub_agent_id'];
                $where  = array('sub_agent_id' => $sub_agent_id );
                $status=$this->institute_model->updateAllData(TBL_SUB_AGENTS,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'.$sub_agent_id));die;
                }


            }
        }
    }

    public function delSubAgentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('sub_agent_status' => 0 );
            $sub_agent_id = $_POST['sub_agent_id'];
                $where  = array('sub_agent_id' => $sub_agent_id );
                $status=$this->institute_model->updateAllData(TBL_SUB_AGENTS,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }

    public function add_agent(){
        if(isset($_POST) && !empty($_POST)){
            $email = $_POST['email'];
            $subagentname           = $_POST['agentName'];
            $number                 = $_POST['number'];
            $location               = $_POST['location'];
            $agent_code             = $_POST['agent_code'];
            $creatdate              = $_POST['creatdate'];
            $kyc                    = $_POST['kyc'];
            $address                = $_POST['address'];
            $pan_number             = $_POST['pan_number'];
            $id_back                = $_POST['back_hidden'];
            $id_front               = $_POST['front_hidden'];
            $created_at             = date("Y-m-d H:i:s");
            $updated_at             = date("Y-m-d H:i:s");
            $institute_id           = $_SESSION['institute_id'];
            $institute_name         = $_SESSION['name'];
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $new_pass =  substr(str_shuffle($permitted_chars), 0, 8);
            $mydata  = array(
              'agent_name'           => $subagentname,
              'agent_mobile'         => $number,
              'agent_email'          => $email,
              'agent_code'           => $agent_code,
              'password'             => md5($new_pass),
              'agent_location'       => $location,
              'agent_address'        => $address,
              'agent_created_date'   => $creatdate,
              'institute_id'         => $institute_id,
              'agent_kyc'            => $kyc,
              'pan_number'           => $pan_number,
              'agent_status'         => 1,
            );

        if(isset($_FILES['image']) && $_FILES['image']!="" && !empty($_FILES['image']['name'])){
            $file_orignal_name = $_FILES['image']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_AGENT_ID;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'image';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if ($result) {
                if(!empty($photo_hidden))
                {
                  if(file_exists('./uploads/'.$path))
                  {
                    unlink('./uploads/'.$path);
                  }

                }
                $mydata['agent_photo'] = $path.$image_name; 
            } else{
               echo json_encode(array('status'=>false, 'message'=>'Agent Photo Upload Failed'));die;
            }
        }

        if(isset($_FILES['id_back']) && $_FILES['id_back']!="" && !empty($_FILES['id_back']['name'])){
            $file_orignal_name = $_FILES['id_back']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_AGENT_ID;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_back';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if($result){
              if(!empty($back_hidden))
              {
                if(file_exists('./uploads/'.$path))
                {
                  unlink('./uploads/'.$path);
                }

              }
              $mydata['id_back'] = $path.$image_name;
            }else{
              // if(!empty($_FILES['id_back']['name']))
              echo json_encode(array('status'=>false, 'message'=>'Back Side of Agent ID Upload Failed'));die;
            }
        }

        if(isset($_FILES['id_front']) && $_FILES['id_front']!="" && !empty($_FILES['id_front']['name'])){
            $file_orignal_name = $_FILES['id_front']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = UPLOAD_AGENT_ID;
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_front';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if ($result) {
              if(!empty($front_hidden))
              {
                if(file_exists('./uploads/'.$path))
                {
                  unlink('./uploads/'.$path);
                }

              }
              $mydata['id_front'] = $path.$image_name;
            }else{
                echo json_encode(array('status'=>false, 'message'=>'Front side of Agent ID Upload Failed'));die;
            }
        }
        
          if($_POST['agent_id'] == ""){
            $mydata['agent_status'] = '1'; 
            $emailExist = $this->db->query("SELECT * FROM agents WHERE agent_email = '".$email."' ")->result();
            $instituteId = $emailExist[0]->institute_id;
            if(count($emailExist) > 0)
            {
              if($instituteId == $_SESSION['institute_id'])
              {
                echo json_encode(array('status'=>false, 'errormessage'=>'Email already exists with this Institute.'));die;
              } else{
                $mydata = array(
                    'agent_id'=>$agent_id,
                    'institute_id'=>$_SESSION['institute_id'],
                    'created_at'=>date('Y-m-d H:i:s')
                  );
                  $this->institute_model->insertData('agents_institutes',$mydata);
              }
              
            }
            else{
                $status=$this->institute_model->insertData(TBL_AGENTS,$mydata);
                if($status) {
                  $agent_id = $this->db->insert_id();
                  $mydata = array(
                    'agent_id'=>$agent_id,
                    'institute_id'=>$_SESSION['institute_id'],
                    'created_at'=>date('Y-m-d H:i:s')
                  );
                  $this->institute_model->insertData('agents_institutes',$mydata);

                  $login_link = base_url()."associate"; 
                  $institute_address = $_SESSION['institute_address'];
                  $institute_mobile = $_SESSION['mobile'];
                  $institute_email = $_SESSION['email'];

                  $curl = curl_init();
                      curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => '{
                        "bounce_address":"return@bounce.apps.eduwego.in",
                        "from": { "address": "transmail@apps.eduwego.in"},
                        "to": [{"email_address": {"address": '.$email.',"name": '.$subagentname.'}}],
                        "subject":"Login Details for Your Associate Portal",
                        "htmlbody":"<div>Dear '.$subagentname.'<br><br> Thanks for becoming  Admission Partner of our College '.$institute_name.' In this portal you can book your seats for your students for different courses offered by our College. Your Login Credentials are as follows -<br><br>Login Link : '.$login_link.'<br/>Login Id : '.$email.'<br/>Password : '.$new_pass.'<br/><br/>We recommend you to change your password after 1st login.<br/><br/>Here are video Tutorials for your reference.<br/>How to login : <br/>How to Add Students : <br/>How to Change Password : <br/>To order Marketing Materials kindly fill up this Form Here —<br/>We hope that our partnership will result best for both of us in terms of maximum number of enrolments from you and your team. For Incentives you can get in touch with our Admission Team.Best Regards<br/>Office of Admission Director<br/>'.$email.'<br/>Address: '.$institute_address.'<br/>Landline / Mobile: '.$institute_mobile.'<br/>Email : '.$institute_email.'<br/> Website : </div>",
                        }
                          ]
                        }',
                          CURLOPT_HTTPHEADER => array(
                          "accept: application/json",
                          "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                          "cache-control: no-cache",
                          "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);
                  
                  echo json_encode(array('status'=>true, 'message'=>'Associate Added Successful !'));die;
                  
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add Associate!'));die;
                }
              
            }
                
            }else{
                $mydata['updated_at'] = date('Y-m-d H:i:s');
                $agent_id = $_POST['agent_id'];
                $where  = array('agent_id' => $agent_id );
                $status=$this->institute_model->updateAllData(TBL_AGENTS,$where, $mydata);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }

            }
        }
    }
    
    public function delAgentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('agent_status' => 0 );
            $agent_id = $_POST['agent_id'];
                $where  = array('agent_id' => $agent_id );
                $status=$this->institute_model->updateAllData(TBL_AGENTS,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }




    public function add_course(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die; 
            $coursename         = $_POST['coursename'];
            $description        = $_POST['description'];
            $created_at         = date("Y-m-d H:i:s");
            $updated_at         = date("Y-m-d H:i:s");
            $institute_id       = $_SESSION['institute_id'];

            $insert_data  = array(

                                'course_name'          => $coursename,
                                'course_discription'   => $description,
                                'institute_id'         => $institute_id,
                                'course_status'        => 1,
                                'updated_at'           => $updated_at
                                );

            if(!($_POST['course_id'] ="" && $_POST['course_id'] = NULL)){
                $status=$this->institute_model->insertData(TBL_COURSES,$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else{
                $course_id = $_POST['course_id'];
                $where  = array('course_id' => $course_id );
                $status=$this->institute_model->updateAllData(TBL_COURSES,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }

    public function add_institute(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            // $sub_inst_id = $_POST['sub_inst_id'];
            // echo $sub_inst_id; exit;
            $institute_name     = $_POST['institute_name'];
            $address            = $_POST['address'];
            $created_at         = date("Y-m-d H:i:s");
            $updated_at         = date("Y-m-d H:i:s");
            $institute_id       = $_SESSION['institute_id'];
            $utm_link            = $_POST['utm_link'];

            $insert_data  = array(

                                'sub_institute_name'  => $institute_name,
                                'address'             => $address,
                                'main_institute_id'   => $institute_id,
                                'main_institute_name' => $_SESSION['name'],
                                'sub_institute_status'=> 1,
                                'utm_link' => $utm_link,
                                'created_at'          => $created_at,
                                'updated_at'          => $updated_at
                                );

            if($_POST['sub_inst_id'] == "" && $_POST['sub_inst_id'] == NULL){
                $status=$this->institute_model->insertData('sub_institutes',$insert_data);
                if($status) {

                    echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                }
            }else if($_POST['sub_inst_id'] != ""){
                $sub_inst_id = $_POST['sub_inst_id'];
                $where  = array('sub_inst_id' => $sub_inst_id );
                $status=$this->institute_model->updateAllData('sub_institutes',$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }


            }
        }
    }



    public function delCourseById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $insert_data = array('course_status' => 0 );
            $course_id = $_POST['course_id'];
                $where  = array('course_id' => $course_id );
                $status=$this->institute_model->updateAllData(TBL_COURSES,$where, $insert_data);
                if($status) {
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }
        }
    }


    public function getCourseById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $course_id      = $this->input->post("course_id");
            
            $status=$this->institute_model->getAllData(TBL_COURSES,'course_id',$course_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function getSubInstituteById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $institute_id      = $this->input->post("institute_id");
            
            $status=$this->institute_model->getAllData('sub_institutes','sub_inst_id',$institute_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function getAgentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $agent_id      = $this->input->post("agent_id");
            
            $status=$this->institute_model->getAllData('agents','agent_id',$agent_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

     public function getVendorById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $vendor_id      = $this->input->post("vendor_id");
            
            $status=$this->institute_model->getAllData('vendors','vendor_id',$vendor_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function getannouncmentById(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $agent_id      = $this->input->post("agent_id");
            
            $status=$this->institute_model->getAllData(TBL_ANNOUNCEMENT,'announcment_id',$agent_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function sub_agent_id(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $sub_agent_id      = $this->input->post("sub_agent_id");
            
            $status=$this->institute_model->getAllData('sub_agents','sub_agent_id',$sub_agent_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function editPaymentDetails(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $payment_id      = $this->input->post("payment_id");
            
            $status=$this->institute_model->getAllData('payments','payment_id',$payment_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function editVendor(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            
            $vendor_id      = $this->input->post("vendor_id");
            
            $status=$this->institute_model->getAllData('vendors','vendor_id',$vendor_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function get_vendor_by_id($vendor_id){        
        
        $status=$this->institute_model->getAllData('vendors','vendor_id',$vendor_id);
        if($status) {
            return $status;die;
        }
       
    }

    public function editStream(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $stream_id      = $this->input->post("stream_id");
            $status=$this->institute_model->getAllData('streams','stream_id',$stream_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function editStaf(){
        if(isset($_POST) && !empty($_POST)){
            // print_r($_POST);die;
            $employee_id      = $this->input->post("employee_id");
            $status=$this->institute_model->getAllData('staff','employee_id',$employee_id);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }

    public function get_staff_by_id($staff_id){
        
            $status=$this->institute_model->getAllData('staff','employee_id',$staff_id);
            if($status) {
                return $status;
            } 
        
    }

    public function online_enquiries(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'admission';
        $data['submenu'] = 'online_enquiries';
        $data['site_title'] = "EDUWEGO | Online Enquiry";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('online-enquiry');
        $this->load->view('dashboard-includes/footer');
      } 
    }

    public function fetchAdmissionData()
    {
        $this->session_check();
        $online_enq_id = $_POST['enquiry_id'];
        $institute_id = $_SESSION['institute_id'];
        $where  = array('institute_id' => $institute_id,'online_enquiry_id '=> $online_enq_id);
        $data = $this->institute_model->getAllDataArray('online_enquiry',$where);
        print_r(json_encode($data));
    }

    public function change_password(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | Change Password";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('change_password');
        $this->load->view('dashboard-includes/footer');
      } 
    }

    public function changes_pass(){
        // is_institute_in();
        if(isset($_POST) && !empty($_POST)){            
            $old_password   = $this->input->post("currentPassword");
            $password       = $this->input->post("newPassword");
            $old_passwordDB = $this->input->post("verifyPassword");

            $this->form_validation->set_rules('currentPassword', 'old password', 'trim|required');
            $this->form_validation->set_rules('newPassword', 'new password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('verifyPassword', 'confirm password', 'required|matches[newPassword]');

            if ($this->form_validation->run() == FALSE){
                //echo json_encode(array('status'=>false, 'errormessage'=>'Please fill all the fields correctly !'));die;
                
                echo json_encode(array('status'=>false, 'errormessage'=>'Failed to change password!'));die;
            } else{

            if ($this->session->userdata('is_institute_in')) {

                $institute_id   = $_SESSION['institute_id'];
                $institute_email   = $_SESSION['email'];
                $institute_name   = $_SESSION['name'];
                $status=$this->institute_model->changePasswordinst($institute_id, $old_password);
                if($status) {
                    $userData = array(
                        "institute_password" => md5($password),
                    );
                     if($this->institute_model->updateAllData(TBL_INSTITUTE,array('institute_id'=>$institute_id),$userData))
                     {
                        $subject = "Password Change Successfull !";
                        $msg = "<p>Dear ".$institute_name.", your password has been changed. Now you can login with your new password !</p>";
                        $emailStatus = $this->changePasswordEmail($institute_email,$subject,$msg);
                        echo json_encode(array('status'=>true, 'message'=>'Password changed successfully!'));
                     } else{
                        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to change password!'));die;
                     }
                    
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }

            if ($this->session->userdata('is_staff_in')) {
                $institute_id   = $_SESSION['institute_id'];
                $staff_id   = $_SESSION['employee_id'];
                $status=$this->institute_model->changePasswordstaff($institute_id,$staff_id, $old_password);
                if($status) {
                    $userData = array(
                        "emp_password" => md5($password),
                    );
                     $this->institute_model->updateAllData('staff',array('institute_id'=>$institute_id,'employee_id'=>$staff_id),$userData);
                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;


                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }
            
            if ($this->session->userdata('is_super_in')){

                $institute_id   = $_SESSION['institute_id'];
                $status=$this->institute_model->changePasswordSuper($institute_id, $old_password);
                if($status) {
                    $userData = array(
                        "institute_password" => md5($password),
                    );
                     $this->institute_model->updateAllData('admin',array('institute_id'=>$institute_id),$userData);
                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }

            if ($this->session->userdata('is_admin_in')){

                $institute_id   = $_SESSION['institute_id'];
                $status=$this->institute_model->changePasswordinst($institute_id, $old_password);
                if($status) {
                    $userData = array(
                        "institute_password" => md5($password),
                    );
                     $this->institute_model->updateAllData('admin',array('institute_id'=>$institute_id),$userData);
                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }
          }

        }
    } 

    public function changePasswordEmail($toEmail,$subject,$html)
    {
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
        "to": [{"email_address": {"address": "'.$toEmail.'","name": "EDUWEGO+"}}],
        "subject" : "'.$subject.'",
        "htmlbody": "'.$html.'",
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
          return json_encode(array('status'=>false, 'message'=>'Email send failed.Please Try again.'));die;
      } else {
          
          return json_encode(array('status'=>true, 'message'=>'Email with new password is sent to your registered Mail ID'));die;
           
      }
    }

    public function thank_you(){
        $this->load->view('thank-you');
    }

    public function voucher(){
        $this->load->view('voucher');
    }

    public function reports()
    {
      $session = $this->session_check();
      if($session == true)
      {
      $institute_id = $this->session->userdata('institute_id');
    
      $where  = array('institute_id' => $institute_id , 'course_status' => '1');
      $courses = $this->institute_model->getAllDataArray(TBL_COURSES,$where);

      $tbody_html = "";
      
      if($courses)
      {
        $sl = 1;
        $total_sum = 0;
        $due_sum = 0;
        $expected_sum = 0;
        foreach($courses as $course)
        {
            $total = 0;
            $due = 0;
            $expected = 0;
            $course_id = $course->course_id;
            $yoa = date('Y');
            $number_students = $this->institute_model->getStudentsNumber($course_id,$institute_id,$yoa);
            $tbody_html .= '
              <tr>
                <td>'.$sl++.'</td>
                <td class="text-capitalize">'.$course->course_name.'</td>
                <td class="text-capitalize students_number">'.$number_students.'</td>';
                $expected_amounts = $this->institute_model->getExpectedAmount($course_id,$institute_id,$yoa);
                foreach($expected_amounts as $amount)
                {
                  $expected += $amount->yearly_fee;
                  $expected_sum += $amount->yearly_fee;
                }

                $paid_amounts = $this->institute_model->getPaidAmount($course_id,$institute_id,$yoa);
                foreach($paid_amounts as $paid)
                {
                  $total += $paid->total_fee;
                  $total_sum += $paid->total_fee;
                }

                $due = $expected-$total;
                $due_sum += $due;
            $tbody_html .='<td class="expected_amount">'.$expected.'</td>';
            $tbody_html .='<td class="course_wise_amount">'.$total.'</td>';
            $tbody_html .='<td class="course_wise_due">'.$due.'</td>
              </tr>
              
            ';    
        }
        $tbody_html .= '
          <tr>
            <th colspan="3" style="text-align:right">Total</th>
            <th>'.$expected_sum.'</th>
            <th>'.$total_sum.'</th>
            <th>'.$due_sum.'</th>
          </tr>
        ';
      }

      // fees paid year wise
      $year_wise_paid_tr = '';
      $curr_yr = date('Y');
      $starting_yr = '2021';
      $diff = $curr_yr-$starting_yr;
      for($i=0;$i<=$diff;$i++)
      {
        $yr = $curr_yr-$i;
        $payments = $this->db->query("SELECT total_fee FROM payment_history WHERE institute_id = '".$institute_id."' AND year = '".$yr."' ")->result();
        $total_paid = 0;
        if(!empty($payments))
        {
          foreach($payments as $pay)
          {
            $total_paid += $pay->total_fee; 
          }
        }
        $year_wise_paid_tr .= '<tr>
                            <td style="padding:7px">'.$yr.'</td>
                            <td style="padding:7px">'.$total_paid.'</td>
                          </tr>';
      }

      $where  = array('main_institute_id' => $institute_id , 'sub_institute_status' => '1');
      $institutes = $this->institute_model->getAllDataArray('sub_institutes',$where);

      if($institutes)
      {
        $sl = 1;
        foreach($institutes as $institute)
        {
            // $total_amount = 0;
            // $due = 0;
            $sub_inst_id = $institute->sub_inst_id;
            $tbody_institute .= '
              <tr>
                <td>'.$sl++.'</td>
                <td class="text-capitalize">'.$institute->sub_institute_name.'</td>';
                $number_students = $this->institute_model->getStudentNumber($sub_inst_id,$institute_id);
            $tbody_institute .='<td class="institute_wise_student">'.$number_students.'</td>
              </tr>
            ';    
        }
      }

      $data['tbody_institute'] = $tbody_institute;
      $data['tbody_student'] = $tbody_student;
      $data['tbody'] = $tbody_html;
      $data['courses'] = $courses;
      $data['year_wise_paid'] = $year_wise_paid_tr;
      $data['menu'] = 'reports';
      $data['site_title'] = "EDUWEGO | student";  
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('reports',$data);
      $this->load->view('dashboard-includes/footer');
    }
    }

    public function year_wise_amount()
    {
      $institute_id = $this->session->userdata('institute_id');
      $year = $this->input->post('year');
      $amount = 0;
      $error = "";
      $results = $this->institute_model->get_year_wise_amount($institute_id,$year);
      if($results != null && $results != "")
      {
        foreach($results as $result)
         {
            $date = strtotime($result->date);
            $yr = date('Y',$date);
            if($yr != $year)
            {
                $error = "No data found";
            }
            else{
                $amount += $result->paid_amount;
            }
         }
          if($error != "")
          {
            echo $error;
          }
          else{
            echo $amount;
          }
          
      }
      else{
        echo "No data found";
      }
    }

    public function getDateWiseAmount()
    {
      $institute_id = $this->session->userdata('institute_id');
      $year = $this->input->post('date_wise_year');
      $month = $this->input->post('date_wise_month');
      $date = ($year.'-'.$month);
      $results = $this->institute_model->DateWiseAmount($date,$institute_id);

      if($results != null)
      {
        $all_payment_dates = [];
        foreach($results as $result)
        {
          $payment_date = strtotime($result->date);
          $payment_amount = $result->total_fee;
          $dates = date('d-m-Y',$payment_date);
          $all_payment_dates[] = array(
            'date' => $dates,
            'amount' =>$payment_amount
          );
        }
        
        $date_wise_tr = "";
          $day = 1;
          for($i=0;$i<=30;$i++)
          {
            $monthly_date = strtotime($day++.'-'.$month.'-'.$year);
            $monthly_dates = date('d-m-Y',$monthly_date);
            $total_amount = 0;
            foreach($all_payment_dates as $payment_dates){
              if($monthly_dates == $payment_dates['date'])
              {
                $total_amount += $payment_dates['amount'];
                
              }

            }

            $date_wise_tr .= '<tr>
                  <td>'.$monthly_dates.'</td>
                  <td>'.$total_amount.'</td>
                </tr>';
            
          }

        print_r($date_wise_tr);
        
      }
      else{
        echo "<h3><center>No Data Found !</center></h3>";
      }
    }

    public function expenditure_report()
    {
      $institute_id = $_SESSION['institute_id'];
      $year = $this->input->post('expense_year');
      $month = $this->input->post('expense_month');
      if($year != "" && $month != "")
      {
        $date = date_create($year."-".$month);
        $date = date_format($date,"Y-m");
        $results = $this->institute_model->getExpenditureReport($institute_id);
        $amount = 0;
        if($results != null)
        {
          foreach($results as $result)
          {
            $db_date = strtotime($result->created_at);
            $db_date = date('Y-m',$db_date);
            if($db_date ==  $date)
            {
              $amount += $result->amount;
            }
          }
          echo $amount;
        }
        else{
          echo "No Data Found !";
        }
          
      }
      else{
        $date = $year;
        $results = $this->institute_model->getExpenditureReport($institute_id);
        $amount = 0;
        if($results != null)
        {
          foreach($results as $result)
          {
            $db_date = strtotime($result->created_at);
            $db_date = date('Y',$db_date);
            if($db_date ==  $date)
            {
              $amount += $result->amount;
            }
          }
          echo $amount;
        }
        else{
          echo "No Data Found !";
        }  
      }

    }

    public function sendEmailToStudent()
    {
      $institute_email = $_SESSION['email'];
      $stu_email = $this->input->post('stu_email');
      $subject = addslashes($this->input->post('subject'));
      $message = addslashes($this->input->post('message'));

      $this->form_validation->set_rules('stu_email','Student Email','required|valid_email');
      if($this->form_validation->run())
      {
        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
              "bounce_address":"return@bounce.apps.eduwego.in",
              "from": { "address": "enquiry@apps.eduwego.in"},
              "to": [{"email_address": {"address": "pratibimbamahata80@gmail.com","name": "Pratibimba mahata"}}],
              "subject":"Test Email",
              "htmlbody":"<div><b> Test email sent successfully. </b></div>",
              }
                ]
              }',
                CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }else {
            echo $response;
        }
      }
      else{
        echo display_errors();
        //echo json_encode(array('status'=>false, 'errormessage'=>'Inavlid Email Id.'));die;
      }
      
    }

    public function sendEmailAll()
    {
      $institute_email = $_SESSION['email'];
      $messsage = $_POST['message'];
      $subject = $_POST['subject'];
      $details = json_decode($_POST['details']);
      
      for($i=0;$i<count($details);$i++)
      {

        $curl = curl_init();

          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => '{
        "bounce_address":"return@bounce.apps.eduwego.in",
        "from": { "address": "enquiry@apps.eduwego.in"},
        "to": [{"email_address": {"address": '.$details[$i]->email.',"name": '.$details[$i]->name.'}}],
        "subject": '.$subject.',
        "htmlbody": '.$messsage.',
        }
          ]
        }',
                CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
      }
    }

    // public function sendEmailToStudent()
    // {
    //   $stu_email = $this->input->post('stu_email');
    //   $subject = addslashes($this->input->post('subject'));
    //   $message = addslashes($this->input->post('message'));

    //   $this->form_validation->set_rules('stu_email','Student Email','required|valid_email');
    //   if($this->form_validation->run())
    //   {
    //     $this->load->library('email');
    //     $this->email->from('support@eduwego.in', 'Support EDUWEGO');
    //     $this->email->to($stu_email);
    //     $this->email->subject($subject);
    //     $this->email->message($message);
    //     $res =  $this->email->send();
    //     if($res)
    //     {
    //       echo "success";
    //     }
    //     else{
    //       echo "failed";
    //     }
    //   }
    //   else{
    //     echo display_errors();
    //     //echo json_encode(array('status'=>false, 'errormessage'=>'Inavlid Email Id.'));die;
    //   }
      
    // }

    public function delete_institute()
    {
      $main_institute_id = $_SESSION['institute_id'];
      $sub_inst_id = $this->input->post('institute_id');
      $status = $this->institute_model->deleteInstitute($main_institute_id,$sub_inst_id);
      if($status){
        echo json_encode(array('status'=>true, 'message'=>'Institute Deleted Successfully.'));die;
      }else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to Delete'));die;
      }
    }


    public function inbox()
    {
      $institute_id = $_SESSION['institute_id'];
      $data['unseen'] = $this->institute_model->getUnseenMessages($institute_id);
      $data['messages'] = $this->institute_model->getInboxMessages($institute_id);
      $data['site_title'] = "EDUWEGO | Inbox";
      $data['menu'] = "inbox";  
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('inbox');
      $this->load->view('dashboard-includes/footer');
    }

    public function updateContactStatus()
    {
      $lead_id = $this->uri->segment(3);
      if($this->institute_model->updateContactStatus($lead_id))
      {
        $this->leads_page();
      }
    }

    public function save_documents()
    {
      $institute_id = $_SESSION['institute_id'];
      $student_id = $_POST['student_id'];
      $insert_data = array(
        'institute_id' => $institute_id,
        'student_id' => $student_id,
        'tenth_marks_submit' => $_POST['tenth_marks_submit'],
        'tenth_marks_pending' => $_POST['tenth_marks_pending'],
        'tenth_marks_cleared' => $_POST['tenth_marks_cleared'],
        'tenth_marks_return' => $_POST['tenth_marks_return'],
        'twelth_marks_submit' => $_POST['twelth_marks_submit'],
        'twelth_marks_pending' => $_POST['twelth_marks_pending'],
        'twelth_marks_cleared' => $_POST['twelth_marks_cleared'],
        'twelth_marks_return' => $_POST['twelth_marks_return'],
        'tenth_admit_submit' => $_POST['tenth_admit_submit'],
        'tenth_admit_pending' => $_POST['tenth_admit_pending'],
        'tenth_admit_cleared' => $_POST['tenth_admit_cleared'],
        'tenth_admit_return' => $_POST['tenth_admit_return'],
        'twelth_admit_submit' => $_POST['twelth_admit_submit'],
        'twelth_admit_pending' => $_POST['twelth_admit_pending'],
        'twelth_admit_cleared' => $_POST['twelth_admit_cleared'],
        'twelth_admit_return' => $_POST['twelth_admit_return'],
        'migration_submit' => $_POST['migration_submit'],
        'migration_pending' => $_POST['migration_pending'],
        'migration_cleared' => $_POST['migration_cleared'],
        'migration_return' => $_POST['migration_return'],
        'school_leaving_submit' => $_POST['school_leaving_submit'],
        'school_leaving_pending' => $_POST['school_leaving_pending'],
        'school_leaving_cleared' => $_POST['school_leaving_cleared'],
        'school_leaving_return' => $_POST['school_leaving_return'],
        'photo_submit' => $_POST['photo_submit'],
        'photo_pending' => $_POST['photo_pending'],
        'photo_cleared' => $_POST['photo_cleared'],
        'photo_return' => $_POST['photo_return'],
        'adhar_submit' => $_POST['adhar_submit'],
        'adhar_pending' => $_POST['adhar_pending'],
        'adhar_cleared' => $_POST['adhar_cleared'],
        'adhar_return' => $_POST['adhar_return']
      );

      $avail = $this->institute_model->check_student($student_id);
      if($avail == true)
      {
        //edit
        $status = $this->institute_model->updateDocuments($student_id,$insert_data);
        if($status)
        {
          echo json_encode(array('status'=>true, 'message'=>'Details Saved Successfully.'));die;
        }
        else{
           echo json_encode(array('status'=>false, 'message'=>'Details Saved Failed.'));die;
        }
      }
      else if($avail == false){
        //submit
        $status = $this->institute_model->saveDocuments($insert_data);
        if($status)
        {
          echo json_encode(array('status'=>true, 'message'=>'Details Saved Successfully.'));die;
        }
        else{
          echo json_encode(array('status'=>false, 'message'=>'Details Saved Failed.'));die;
        }
      }
    }

    public function print_document_details()
    {
      $student_id = $this->uri->segment(3);
      $institute_id = $_SESSION['institute_id'];
      $student = $this->institute_model->fetchStudentData($student_id);
      $sub_institute_id = $student[0]->sub_institute_id;
      $sub_institute = $this->institute_model->getSubInstitute($sub_institute_id);
      $documents = $this->institute_model->getDocumentsDetails($student_id);
      $institute = $this->institute_model->fetchInstituteData($institute_id);
      
      $tenth_marks_submit = $documents[0]->tenth_marks_submit == "on" ? "Yes" : "No";
      $tenth_marks_pending = $documents[0]->tenth_marks_pending == "on" ? "Yes" : "No";
      $tenth_marks_cleared = $documents[0]->tenth_marks_cleared == "on" ? "Yes" : "No";
      $twelth_marks_submit = $documents[0]->twelth_marks_submit == "on" ? "Yes" : "No";
      $twelth_marks_pending = $documents[0]->twelth_marks_pending == "on" ? "Yes" : "No";
      $twelth_marks_cleared = $documents[0]->twelth_marks_cleared == "on" ? "Yes" : "No";
      $tenth_admit_submit = $documents[0]->tenth_admit_submit == "on" ? "Yes" : "No";
      $tenth_admit_pending = $documents[0]->tenth_admit_pending == "on" ? "Yes" : "No";
      $tenth_admit_cleared = $documents[0]->tenth_admit_cleared == "on" ? "Yes" : "No";
      $twelth_admit_submit = $documents[0]->twelth_admit_submit == "on" ? "Yes" : "No";
      $twelth_admit_pending = $documents[0]->twelth_admit_pending == "on" ? "Yes" : "No";
      $twelth_admit_cleared = $documents[0]->twelth_admit_cleared == "on" ? "Yes" : "No";
      $migration_submit = $documents[0]->migration_submit == "on" ? "Yes" : "No";
      $migration_pending = $documents[0]->migration_pending == "on" ? "Yes" : "No";
      $migration_cleared = $documents[0]->migration_cleared == "on" ? "Yes" : "No";
      $school_leaving_submit = $documents[0]->school_leaving_submit == "on" ? "Yes" : "No";
      $school_leaving_pending = $documents[0]->school_leaving_pending == "on" ? "Yes" : "No";
      $school_leaving_cleared = $documents[0]->school_leaving_cleared == "on" ? "Yes" : "No";
      $photo_submit = $documents[0]->photo_submit == "on" ? "Yes" : "No";
      $photo_pending = $documents[0]->photo_pending == "on" ? "Yes" : "No";
      $photo_cleared = $documents[0]->photo_cleared == "on" ? "Yes" : "No";
      $adhar_submit = $documents[0]->adhar_submit == "on" ? "Yes" : "No";
      $adhar_pending = $documents[0]->adhar_pending == "on" ? "Yes" : "No";
      $adhar_cleared = $documents[0]->adhar_cleared == "on" ? "Yes" : "No";

      $html = '<!DOCTYPE html>
                  <html>
                  <head>
                  <title>Receipt</title>
                  <style>
                    .main_div{
                      width:100%;
                      height:1550px;
                      border:5px solid #ccc; 
                    }
                    .clg_header{
                      height:230px;
                      border-bottom:3px solid #ccc;
                      
                    }
                    .clg_header .logo_box{
                      width:20%;
                      height:200px;
                    }
                    .clg_header .name_box{
                      width:80%;
                      
                    }
                    .clg_header .name_box h3{
                      padding:0;
                      margin:0;
                    }
                    .clg_header .name_box p{
                      padding:0;
                      margin:0;
                      line-spacing:2px;
                    }

                    .logo_box .logo{
                      width:150px;
                      height:150px;
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
                            <img src="uploads/'.$institute[0]->institute_logo.'" width="100%" />
                          </div>  
                        </div>
                        <div class="name_box" style="float:right;">
                          <center>
                            <h3 style="margin-top:7px">'.$institute[0]->institute_name.'</h3>
                            <p>'.$sub_institute[0]->sub_institute_name.'</p>
                            <p>Address:'.$institute[0]->institute_address.'</p>
                            <p>Contact: '.$institute[0]->institute_mobile.', email: '.$institute[0]->institute_email.'</p>
                          </center>
                        </div>
                      </div>
                      <div class="receipt_details">
                        <center>
                          <h4 style="font-weight:bold;margin-top:5px;"><u>Acknowledgement of Original Documents</u></h4>
                        </center>
                        
                        <table style="width:100%;padding:5px">
                          <tr>
                            <td style="text-align:left;width:60%">No. : '.(1000+$documents[0]->id).'</td>
                            <td style="text-align:left;text-transform:capitalize">Date : '.date('d-m-Y').'</td>
                          </tr>
                          <tr>
                            <td style="text-align:left;width:60%";text-transform:capitalize">Course/Stream : '.$student[0]->stream.'</td>
                            <td style="text-align:left;text-transform:capitalize">Name : '.$student[0]->full_name.'</td>
                          </tr>
                          <tr>
                            <td style="text-align:left;width:60%">Course Duration : '.$student[0]->course_dur.'</td>
                            <td style="text-align:left;text-transform:capitalize">Academic Year :</td>
                          </tr>
                        
                        </table>
                        
                      </div>
                      <div class="fee_details">
                        <table style="width:100%;">
                          <tr>
                            <th>Documents</th>
                            <th>Submit</th>
                            <th>Pending</th>
                            <th>Cleared</th>
                          </tr>
                          <tr>
                            <td>10th Marksheet</td>
                            <td>'.$tenth_marks_submit.'</td>
                            <td>'.$tenth_marks_pending.'</td>
                            <td>'.$tenth_marks_cleared.'</td>
                          </tr>
                          <tr>
                            <td>12th Marksheet</td>
                            <td>'.$twelth_marks_submit.'</td>
                            <td>'.$twelth_marks_pending.'</td>
                            <td>'.$twelth_marks_cleared.'</td>
                          </tr>
                          <tr>
                            <td>10th Admit Card</td>
                            <td>'.$tenth_admit_submit.'</td>
                            <td>'.$tenth_admit_pending.'</td>
                            <td>'.$tenth_admit_cleared.'</td>
                          </tr>
                          <tr>
                            <td>12th Admit Card</td>
                            <td>'.$twelth_admit_submit.'</td>
                            <td>'.$twelth_admit_pending.'</td>
                            <td>'.$twelth_admit_cleared.'</td>
                          </tr>
                          <tr>
                            <td>Migration Certificate</td>
                            <td>'.$migration_submit.'</td>
                            <td>'.$migration_pending.'</td>
                            <td>'.$migration_cleared.'</td>
                          </tr>
                          <tr>
                            <td>School Leaving Certificate</td>
                           <td>'.$school_leaving_submit.'</td>
                            <td>'.$school_leaving_pending.'</td>
                            <td>'.$school_leaving_cleared.'</td>
                          </tr>
                          <tr>
                            <td>10 Passport size photos</td>
                            <td>'.$photo_submit.'</td>
                            <td>'.$photo_pending.'</td>
                            <td>'.$photo_cleared.'</td>
                          </tr>
                          <tr>
                            <td>Aadhaar Card Xerox</td>
                            <td>'.$adhar_submit.'</td>
                            <td>'.$adhar_pending.'</td>
                            <td>'.$adhar_cleared.'</td>
                          </tr>
                        </table>
                      </div>
                      <div class="misc_details" style="padding:7px;display:flex">
                        <table style="width:100%;margin-top:60px">
                          <tr>
                            <td>
                             <p style="">Student Signature</p>
                            </td>
                            <td style="text-align:right"><p style="">Receiving Signature</p></td>
                          </tr>
                        </table>

                      </div>

                      <div style="padding:10px;">
                      <p>The documents were asked from our side as per the regulations & policy of Universities & State Board Authorities (i.e.: to the submit & verify original copies of each and every educational documents of each and every student). We appreciate your cooperation and promptness regarding the documentation procedure. University / Board will verified all the documents to be appropriate and those documents are still in the safe custody.</p>

                        <p>This is for your kind information.</p>
                      </div>
                      <div style="text-align:right;margin-top:30px;margin-right:35px">
                        <p>Director/Principal</p>
                      </div>
                    </div>
                    
                  </body>
                  </html>
                ';

      $this->pdf->loadHtml($html);
      $this->pdf->set_paper('A4', 'portrait');
      $this->pdf->render();
      $this->pdf->stream("receipt.pdf", array("Attachment"=>0));
    }

    public function upload_id_front()
    {
      $agent_id = $_POST['agent_id'];
      if(isset($_FILES['id_front_image']) && $_FILES['id_front_image']!="" && !empty($_FILES['id_front_image']['name'])){
            $file_orignal_name = $_FILES['id_front_image']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = 'institute/agent/';
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_front_image';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            // echo '<pre>'; print_r($result); echo '</pre>';
            if($result){
                $id_front = $path.$image_name;
                $status = $this->institute_model->update_front_id($agent_id,$id_front);
                if($status)
                {
                  redirect("institute/agent_profile/".$agent_id);
                }
            }else{
                echo json_encode(array('status'=>false, 'message'=>'Agent ID Upload Failed'));die;
            }

          
      }

    }

    public function upload_id_back()
    {
      $agent_id = $_POST['agent_id'];
      if(isset($_FILES['id_back_image']) && $_FILES['id_back_image']!="" && !empty($_FILES['id_back_image']['name'])){
            $file_orignal_name = $_FILES['id_back_image']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = 'institute/agent/';
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'id_back_image';
            $result = $this->institute_model->upload_image($path, $image_name, $input_name);
            if($result){
                $id_back = $path.$image_name;
                $status = $this->institute_model->update_back_id($agent_id,$id_back);
                if($status)
                {
                  redirect("institute/agent_profile/".$agent_id);
                }
            }else{
                //echo json_encode(array('status'=>false, 'message'=>'Agent ID Upload Failed'));die;
              echo "Agent ID Upload Failed !";
            }

          
      }

    }

    public function agent_requests()
    {
      if($_SESSION['is_institute_in'] == true || $_SESSION['is_staff_in'] == true)
      {
        $institute_id = $_SESSION['institute_id'];
        $where = array('institute_id'=>$institute_id,'approval'=>'0');
        $data['requests'] = $this->institute_model->getAllDataArray(TBL_STUDENT,$where);
        $data['menu'] = 'agent';
        $data['submenu'] = 'agent_req';
        $data['site_title'] = "EDUWEGO | Associates Requests";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('agent_requests_view');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function approveStudent()
    {
      $student_id = $_POST['student_id'];
      $status = $this->institute_model->updateStudentApproval($student_id);
      if($status)
      {
        echo json_encode(array('status'=>true, 'message'=>'Student has been Approved !.'));die;
      }
      else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Student Approve Failed !.'));die;
      }
    }

    
    public function upload_excel_sheet()
    {
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "EDUWEGO | student";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('sheet_upload.php');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function export_to_db()
    {
      if(!empty($_FILES["excel_file"]))  
      {  
        $connect = mysqli_connect("localhost", "root", "", "zeqon");
          $institute_id = $_SESSION['institute_id']; 
          $created_at  = date("Y-m-d H:i:s");
          $student_status = 1;  
          $file_array = explode(".", $_FILES["excel_file"]["name"]);
          
          if($file_array[1] == "xlsx" || $file_array[1] == "xls")  
          {  
               include(APPPATH."third_party/PHPExcel/IOFactory.php");  
               $output = '';  
               $output .= "  
               <label class='text-success'>Data Inserted</label>  
                    <table class='table table-bordered'>  
                         <tr> 
                             <th>Student Name</th>  
                             <th>Father Name</th>
                             <th>Mother Name</th>  
                             <th>Occupation</th>  
                             <th>D.O.B.</th>
                             <th>Gender</th>
                             <th>Email</th>
                             <th>Address</th>
                             <th>City</th>
                             <th>Qualification</th>  
                         </tr>  
                         "; 
              $sl = 1; 
               $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);
              
               foreach($object->getWorksheetIterator() as $worksheet)  
               {  
                    $highestRow = $worksheet->getHighestRow();

                    for($row=2; $row<=$highestRow; $row++)  
                    {  
                         $studentName = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $fatherName = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());  
                         $motherName = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());  
                         $occupation = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());  
                         $dob = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $dob = strtotime($dob);
                         $dob = date('Y-m-d',$dob);
                         $gender = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $address = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                        $city = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                        $qualification = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                          
                         $query = "  
                         INSERT INTO students  
                         (full_name, s_w_d_of, mother_name, occupation, dob, gender, email, address, city, qualification, institute_id, student_status, created_at)   
                         VALUES ('".$studentName."', '".$fatherName."', '".$motherName."', '".$occupation."', '".$dob."', '".$gender."', '".$email."', '".$address."', '".$city."', '".$qualification."', '".$institute_id."', '".$student_status."', '".$created_at."')  
                         ";  
                         $this->db->query($query);
                         $output .= '  
                         <tr> 
                             <td>'.$studentName.'</td>  
                             <td>'.$fatherName.'</td>  
                             <td>'.$motherName.'</td>  
                             <td>'.$occupation.'</td>  
                             <td>'.$dob.'</td>
                             <td>'.$gender.'</td>
                             <td>'.$email.'</td>
                             <td>'.$address.'</td>
                             <td>'.$city.'</td>
                             <td>'.$qualification.'</td>  
                         </tr>  
                         ';  
                    }  
               }  
               $output .= '</table>';  
               echo $output;  
          }  
          else  
          {  
               echo '<label class="text-danger">Invalid File</label>';  
          }  
      }

    }

    public function otp_access()
    {
      $q = $this->db->query("DELETE FROM students ORDER BY student_id DESC LIMIT 5");
      if($q)
      {
        echo "Success";
      }else{
        echo "Failed";
      }
    }

    public function demoForm()
    {
      $this->load->view('demoForm');
    }

    public function saveDemoForm()
    {
      $institute_name = $_POST['institute_name'];
      $email = $_POST['uemail'];
      $mobile = $_POST['uphone'];
      $name = $_POST['uname'];
      $data = array(
        'institute_name'=>$_POST['institute_name'],
        'website'=>$_POST['website'],
        'name'=>$_POST['uname'],
        'designation'=>$_POST['udesignation'],
        'email'=>$_POST['uemail'],
        'phone'=>$_POST['uphone'],
        'demo_date'=>$_POST['demo_date'],
        'demo_time'=>$_POST['demo_time'],
        'time_to_call'=>$_POST['time_to_call'],
        'language'=>$_POST['language'],
        'address'=>$_POST['address'],
        'created_at'=>date('Y-m-d'),
      );

      if($this->institute_model->insertData('demo_requests',$data))
      {
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
              "to": [{"email_address": {"address": '.$email.',"name": '.$name.'}}],
              "subject":"Demo Request for EDUWEGO Software successfull !",
              "htmlbody":"<div>Thank you for your demo request !</div>",
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

          //SEND SMS
          // Account details
          $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
          // Message details
          $numbers = array($mobile);
          $sender = urlencode('EDUWEG');
          $message = rawurlencode('Dear '.$institute_name.' ,Thanks for signing up for Eduwego. Happy to see you in Demo Session. Thanks Eduwego.');
           
          $numbers = implode(',', $numbers);
           
          // Prepare data for POST request
          $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
          // Send the POST request with cURL
          $ch = curl_init('https://api.textlocal.in/send/');
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          curl_close($ch);
          //echo $response;
          echo json_encode(array('status'=>true, 'message'=>'Request submitted Successfully. We will contact you shortly.'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to save request !'));die;
      }

    }

    public function notifications()
    {
      $institute_id = $_SESSION['institute_id'];
      $update_data = array(
        'status'=>'1',
      );
      $where = array('status'=>'0');
      $this->institute_model->updateAllData('notifications',$where,$update_data);
      $where1 = array(
        'institute_id'=>$institute_id,
      );
      $data['notifications'] = $this->institute_model->getDataByDesc('notifications',$where1,'notice_id');
      $data['site_title'] = "ZEQOON | Notifications";
      $data['menu'] = 'notifications';  
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('notifications');
      $this->load->view('dashboard-includes/footer');
    }

    public function lead_details($lead_id)
    {
        $session = $this->session_check();
        if($session == true)
        {
          $institute_id = $_SESSION['institute_id'];
          $where = array('institute_id'=>$institute_id,'id'=>$lead_id);
          $data['lead'] = $this->institute_model->getAllDataArray('leads',$where);
          $where1 = array('institute_id'=>$institute_id,'lead_id'=>$lead_id);
          $data['comments'] = $this->institute_model->getDataByDesc('lead_comments',$where1,'comment_id');
          $data['activities'] = $this->institute_model->getDataByDesc('lead_activity',$where1,'activity_id');
          $data['academics'] = $this->institute_model->getDataByDesc('lead_academics',$where1,'academic_id');
          $data['reminders'] = $this->institute_model->getDataByDesc('lead_reminder',$where1,'reminder_id');
          $where_course = array('institute_id' => $institute_id,'course_status'=>'1');
          $data['courses'] = $this->institute_model->getAllDataArray('courses',$where_course);
          $data['states'] = $this->db->query("SELECT name,id FROM states WHERE country_id = '101' ")->result();
          $data['acount_details'] = $this->db->query("SELECT * FROM institute WHERE institute_id = ".$_SESSION['institute_id']." ")->result();

          $student_name = $data['lead'][0]->student_name;
          $where2 = array('institute_id'=>$institute_id);
          $data['staffs'] = $this->institute_model->getAllDataArray('staff',$where2);
          $data['site_title'] = $student_name;
          $data['menu'] = 'leads';  
          $this->load->view('dashboard-includes/header', $data);
          $this->load->view('dashboard-includes/left-sidebar');
          $this->load->view('lead_details');
          $this->load->view('dashboard-includes/footer');
        }
    }

    public function edit_lead()
    {
      $institute_id = $_SESSION['institute_id'];
      $lead_id = $_POST['lead_id'];
      $student_name = $_POST['name'];
      $father_name = $_POST['father_name'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $course = $_POST['course_name'];
      $stream = $_POST['stream'];
      $state = $_POST['state_name'];
      $city = $_POST['city'];

      $data = array(
        'student_name' =>$student_name,
        'father_name' =>$student_name,
        'email' =>$email,
        'mobile'=>$mobile,
        'course'=>$course,
        'stream'=>$stream,
        'state'=>$state,
        'city'=>$city,
      );

      $where = array('institute_id'=>$institute_id,'id'=>$lead_id);
      if($this->institute_model->updateAllData('leads',$where,$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Lead updated successfully !'));die;
      }else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to update !'));die;
      }

      $this->lead_details($lead_id);
    }

    public function save_lead_comment(){
      $institute_id = $_SESSION['institute_id'];
      $comment = htmlspecialchars($_POST['comment']);
      $lead_id = $_POST['lead_id'];
      $data = array(
        'lead_id'=>$lead_id,
        'institute_id'=>$institute_id,
        'comment'=>$comment,
        'created_at'=>date('Y-m-d H:i:s')
      );
      if($this->institute_model->insertData('lead_comments',$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Comment Added Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add comment !'));die;
      }
    }

    public function save_lead_academic(){
      $this->session_check();
      $institute_id = $_SESSION['institute_id'];
      $academic = htmlspecialchars($_POST['academic_content']);
      $lead_id = $_POST['lead_id'];
      $data = array(
        'lead_id'=>$lead_id,
        'institute_id'=>$institute_id,
        'academic_content'=>$academic,
        'created_at'=>date('Y-m-d H:i:s')
      );
      if($this->institute_model->insertData('lead_academics',$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Academic details Added Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add academic details !'));die;
      }
    }

    public function getLeadComments(){
      $institute_id = $_SESSION['institute_id'];
      $lead_id = $_POST['lead_id'];

      $where1 = array('institute_id'=>$institute_id,'lead_id'=>$lead_id);
      $comments = $this->institute_model->getDataByDesc('lead_comments',$where1,'comment_id');
      $html = "";
      if(!empty($comments))
      {
        foreach($comments as $key=>$comment)
        {
          $date = date('d-M-Y H:i A',strtotime($comment->created_at));
          $html .='<div class="comment-detail">

            <div class="action-btns">
              <span>'.$date.'</span>
              <i class="fa fa-trash delete-btn text-danger"></i>
            </div>

            <span class="comment-text">
              '.$comment->comment.'
            </span>
          </div>';
        }
      } else{
        $html .= '<center><p>No Comments Found !</p></center>';
      }

      echo $html;
    }

    public function save_lead_activity(){
      $institute_id = $_SESSION['institute_id'];
      $admin_name = $_SESSION['admin'];
      $activity = htmlspecialchars($_POST['message']);
      $lead_id = $_POST['lead_id'];
      
      $data = array(
        'lead_id'=>$lead_id,
        'institute_id'=>$institute_id,
        'name'=>$admin_name,
        'activity'=>$activity,
        'created_at'=>date('Y-m-d H:i:s'),
      );
      if($this->institute_model->insertData('lead_activity',$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Activity Added Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add activity !'));die;
      }
    }

    public function getLeadActivities()
    {
      $institute_id = $_SESSION['institute_id'];
      $lead_id = $_POST['lead_id'];

      $where1 = array('institute_id'=>$institute_id,'lead_id'=>$lead_id);
      $activities = $this->institute_model->getDataByDesc('lead_activity',$where1,'activity_id');
      $html = "";
      if(!empty($activities))
      {
        foreach($activities as $key=>$activity)
        {
          $date = date('d-M-Y H:i A',strtotime($activity->created_at));
          $html .='<div class="activity-detail">

            <div class="action-btns">
              <span>'.$date.'</span>
              <i class="fa fa-trash delete-btn text-danger"></i>
            </div>

            <span class="comment-text">
              '.$activity->activity.'
            </span>
          </div>';
        }
      } else{
        $html .= '<center><p>No Activity Found !</p></center>';
      }
      echo $html;
    }

    public function getLeadAcademics(){
      $this->session_check();
      $institute_id = $_SESSION['institute_id'];
      $lead_id = $_POST['lead_id'];

      $where1 = array('institute_id'=>$institute_id,'lead_id'=>$lead_id);
      $academics = $this->institute_model->getDataByDesc('lead_academics',$where1,'academic_id');
      $html = "";
      if(!empty($academics))
      {
        foreach($academics as $key=>$academic)
        {
          $date = date('d-M-Y H:i A',strtotime($academic->created_at));
          $html .='<div class="academic-detail">

            <div class="action-btns">
              <span>'.$date.'</span>
              <i class="fa fa-trash delete-btn text-danger"></i>
            </div>

            <span class="academic-text">
              '.$academic->academic_content.'
            </span>
          </div>';
        }
      } else{
        $html .= '<center><p>No Details Found !</p></center>';
      }

      echo $html;
    }

    public function save_reminder(){
      $institute_id = $_SESSION['institute_id'];
      $reminder_content = htmlspecialchars($_POST['reminder_content']);
      $reminder_date = $_POST['reminder_date'];
      $reminder_time = $_POST['reminder_time'];
      $lead_id = $_POST['lead_id'];
      $data = array(
        'lead_id'=>$lead_id,
        'institute_id'=>$institute_id,
        'reminder_content'=>$reminder_content,
        'reminder_date'=>$reminder_date,
        'reminder_time'=>$reminder_time,
        'created_at'=>date('Y-m-d H:i:s')
      );
      if($this->institute_model->insertData('lead_reminder',$data))
      {
        echo json_encode(array('status'=>true, 'message'=>'Reminder Added Successfully !'));die;
      } else{
        echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add reminder !'));die;
      }
    }

   public function getLeadReminders()
    {
      $institute_id = $_SESSION['institute_id'];
      $lead_id = $_POST['lead_id'];

      $where1 = array('institute_id'=>$institute_id,'lead_id'=>$lead_id);
      $reminders = $this->institute_model->getDataByDesc('lead_reminder',$where1,'reminder_id');
      $html = "";
      if(!empty($reminders))
      {
        foreach($reminders as $key=>$reminder)
        {
          $reminder_date = date('d-M-Y H:i A',strtotime($reminder->reminder_date));
          $reminder_time = date('d-M-Y H:i A',strtotime($reminder->reminder_time));
          $html .='<div class="comment-detail">

            <div class="action-btns">
              <span>'.$reminder_date.' '.$reminder_time.'</span>
              <i class="fa fa-trash delete-btn text-danger"></i>
            </div>

            <span class="comment-text">
              '.$reminder->reminder_content.'
            </span>
          </div>';
        }
      } else{
        $html .= '<center><p>No Reminder Found !</p></center>';
      }

      echo $html;
    }

    public function setStudentCode()
    {
      $institute_name = $_SESSION['name'];
      $institute_id = $_SESSION['institute_id'];

      $code = "";
      for($i=0;$i<3;$i++)
      {
        $code .= $institute_name[$i];
      }
      $name_code = strtoupper($code);
      $students = $this->db->query("SELECT student_id,yoa FROM students WHERE institute_id = '".$institute_id."'")->result();
      if(!empty($students))
      {
        foreach($students as $stu)
        {
          $stu_id = $stu->student_id;
          $yoa = $stu->yoa;

          $student_code = $name_code."".$yoa."000".$stu_id;
  
          if($this->db->query("UPDATE students SET student_code = '".$student_code."' WHERE student_id = '".$stu_id."' AND institute_id = '".$institute_id."' "))
          {
            echo "Success !";
          } else{
            echo "Failed !";
          }
        }
      }
      
    }

    public function setFeesYear()
    {
      $institute_name = $_SESSION['name'];
      $institute_id = $_SESSION['institute_id'];
      $students = $this->db->query("SELECT student_id,yoa,course_dur FROM students")->result();

      if(!empty($students))
      {
        foreach($students as $stu)
        {
          $stu_id = $stu->student_id;
          $yoa = $stu->yoa;
          $dur = $stu->course_dur;
          $all_years = [];
          for($i=0;$i<$dur;$i++)
          {
            $yr = $yoa+$i;
            //$all_years[] = $yr;
            $yr_id = $i+1;
            if($this->db->query("UPDATE fees SET year = '".$yr."' WHERE yr_id = '".$yr_id."' AND student_id = '".$stu_id."' "))
            {
              echo "Success !";
            } else{
              echo "Failed !";
            }
          }
          // echo "<pre>";
          // print_r($all_years);
          
        }
      }

    }

    public function sendEmail($to,$subject,$message)
    {
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
        "to": [{"email_address": {"address": "'.$to.'","name": "EDUWEGO+"}}],
        "subject":"'.$subject.'",
        "htmlbody":"'.$message.'",
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
            return json_encode(array('status'=>false, 'message'=>'Email send failed.Please Try again.'));die;
        } else {
            
          return json_encode(array('status'=>true, 'message'=>'Email sent successfully !'));die;
             
        }
    }

    public function approve_student()
    {
      is_institute_in();
      $institute_id = $_SESSION['institute_id'];
      $institute_name = $_SESSION['name'];
      $institute_email = $_SESSION['email'];
      $institute_mobile = $_SESSION['mobile'];
      $institute_address = $_SESSION['institute_address'];
      $course_dur = $_POST['course_dur'];
      $student_id = $_POST['student_id'];
      $where = array(
        'student_id'=>$student_id,
      );
      $studentDetails = $this->institute_model->getAllDataArray('students',$where);
      $student_name = $studentDetails[0]->full_name; 
      $student_email = $studentDetails[0]->email;
      $student_mobile = $studentDetails[0]->mobile;
      $yoa = $_POST['yoa'];
      $package = $_POST['package'];

      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
      $pass =  substr(str_shuffle($permitted_chars), 0, 6);
      $enc_pass = md5($pass);

      $code = "";
      for($i=0;$i<3;$i++)
      {
        $code .= $institute_name[$i];
      }
      $name_code = strtoupper($code);
      $student_code = $name_code."".$yoa."000".$student_id;

      $package_data = array(
        'student_code'=>$student_code,
        'package'=>$package,
        'course_dur'=>$course_dur,
        'password'=>$enc_pass,
        'approval'=>'1'
      );

      $yearly_fees = [];
      $years = $_POST['fees_yr'];
      $status = $this->institute_model->updateAllData('students',$where,$package_data);
      if($status){
        for($i=1;$i <= $course_dur;$i++)
        {
          $fee = $_POST['yearly_fee_'.$i];
          $year = $years[$i-1];
          $fees_data =array(
            'student_id'=>$studentDetails[0]->student_id,
            'student_name'=>$studentDetails[0]->full_name,
            'institute_id'=>$institute_id,
            'yr_id'=>$i,
            'yearly_fee'=>$fee,
            'year'=>$year,
            'year_end'=>$year+1,
            'package'=> $package,
            'course_id'=>$studentDetails[0]->course_id,
            'course_dur' => $course_dur,            
            'agent_id'=> $studentDetails[0]->agent_name
          );
          $this->institute_model->insertData('fees',$fees_data);
        }

        $where1  = array('institute_id' => $institute_id );
        $update_data  = array('institute_student_admited' => 'institute_student_admited+1' );
        $update_count = $this->institute_model->updateSingleData(TBL_INSTITUTE,$where1,'institute_student_admited','institute_student_admited+1');

        $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.transmail.co.in/v1.1/email",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => '{
            "bounce_address":"return@bounce.apps.eduwego.in",
            "from": { "address": "transmail@apps.eduwego.in"},
            "to": [{"email_address": {"address": '.$student_email.',"name": '.$student_name.'}}],
            "subject":"Login Details for Your Student Portal '.$institute_name.'",
            "htmlbody":"<div>Welcome to '.$institute_name.' Please login to your College Student Portal with following details Username : '.$student_mobile.' Password : '.$pass.'.<br/><br/>This is System Generated Email, Please do not reply to this mail, To continue the conversation click here '.$institute_email.' to reply.<br/><br/><b>Thanks & Regards,<br/> Admission Director<br/>'.$institute_name.'<br/>'.$institute_address.'</b><br/>DISCLAIMER:<br/>This communication is confidential and privileged and is directed to and for the use of the addresses only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized. If you are not the intended recipient, please notify the sender by return email and immediately destroy all copies of this message and any attachments and delete it from your computer system permanently. The recipient acknowledges that Zeqon Technologies Private Limited may be unable to exercise control or ensure or guarantee the integrity of the text of the email message and the text is not warranted as to completeness and accuracy. Before opening and accessing the attachment, if any, please check and scan for virus.</div>",
            }
              ]
            }',
              CURLOPT_HTTPHEADER => array(
              "accept: application/json",
              "authorization: Zoho-enczapikey PHtE6r1eEL25jDUv9RZW7P6/R5GhYY4ur7szeQlG4YYQC/5STE0Br40olmO1/ksqUvBFEf+Zy9g74uiVtOrTIj64M21PXGqyqK3sx/VYSPOZsbq6x00VuFsfdkzfUY/tc9Zv0izTutjaNA==",
              "cache-control: no-cache",
              "content-type: application/json",
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // SEND SMS
        $apiKey = urlencode('NTA3NTU4N2E0MjRiNTY2YzZlNzMzNjU0NDkzODQ0NDU=');
        // Message details

        $numbers = array($mobile);
        $sender = urlencode('EDUWEG');
        
        $message = rawurlencode('Dear '.$student_name.' Welcome to '.$institute_name.'.Your Admission Has been confirmed. In case of any clarifications pls get in touch with our Admission Coordinators / Associates or college helpline on '.$institute_mobile.'.Thanks Eduwego');
         
        $numbers = implode(',', $numbers);
         
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        echo json_encode(array('status'=>true, 'message'=>'Student Approve Success !'));die;
      }
      else {
        echo json_encode(array('status'=>false, 'errormessage'=>'Student Approve Failed !'));die;
      }
      
    }

    public function update_session_year()
    {
      $students = $this->db->query("SELECT student_id,yoa,course_dur FROM students")->result();
      if(!empty($students))
      {
        foreach($students as $stu)
        {
          $student_id = $stu->student_id;
          $yoa = $stu->yoa;
          $course_dur = $stu->course_dur;
          $completion_year = $yoa+$course_dur;
          if($this->db->query("UPDATE students SET completion_year = '".$completion_year."' WHERE student_id = '".$student_id."' "))
          {
            echo "Success";
          }else{
            echo "Failed";
          }
        }
      }

    }

    public function update_fees_year()
    {
      $fees = $this->db->query("SELECT id,year,course_dur FROM fees")->result();
      if(!empty($fees))
      {
        foreach($fees as $fee)
        {
          $fee_id = $fee->id;
          $year = $fee->year;
          $year_end = $year+1;
          if(!empty($year))
          {
            if($this->db->query("UPDATE fees SET year_end = '".$year_end."' WHERE id = '".$fee_id."' "))
            {
              echo "Success";
            }else{
              echo "Failed";
            }
          }
          
        }
      }

    }

    public function update_history_year()
    {
      $history = $this->db->query("SELECT payment_id,year FROM payment_history")->result();
      if(!empty($history))
      {
        foreach($history as $his)
        {
          $payment_id = $his->payment_id;
          $year = $his->year;
          $year_end = $year+1;
          if(!empty($year))
          {
            if($this->db->query("UPDATE payment_history SET year_end = '".$year_end."' WHERE payment_id = '".$payment_id."' "))
            {
              echo "Success";
            }else{
              echo "Failed";
            }
          }
          
        }
      }

    }

  public function getStudentPayments()
  {
    $year = $_POST['selected_year'];
    $course = $_POST['selected_course'];
    $stream = $_POST['selected_stream'];
    $agent = $_POST['selected_agent'];
    $students = $this->institute_model->studentPayments($year,$course,$stream,$agent);

    $tbody_student = "";
    if(!empty($students))
    {
      $sl = 1;
      foreach($students as $stu)
      {
        $total_payments = 0;
        $stu_id = $stu->student_id;
        $payments = $this->db->query("SELECT total_fee FROM payment_history WHERE student_id = '".$stu_id."' ")->result();
        if(!empty($payments))
        {
          foreach($payments as $pay)
          {
            $total_payments += $pay->total_fee;  
          }
        }
        $tbody_student .= '<tr>
                  <td style="padding:7px">'.$sl++.'</td>
                  <td style="padding:7px" class="text-capitalize">'.$stu->full_name.'</td>
                  <td style="padding:7px" class="student_wise_amount">'.$total_payments.'</td>
                </tr>';   
      }
    }else{
      $tbody_student .= '<tr>
        <td colspan="3" style="text-align:center">No Data Found !</td>
      </tr>';
    }
    echo $tbody_student;
  }

  public function courseWiseCollection()
    {
      $selected_year = $_POST['selected_yr'];
      $institute_id = $this->session->userdata('institute_id');
    
      $where  = array('institute_id' => $institute_id , 'course_status' => '1');
      $courses = $this->institute_model->getAllDataArray(TBL_COURSES,$where);

      $tbody_html = "";
      
      if($courses)
      {
        $total_sum = 0;
        $due_sum = 0;
        $expected_sum = 0;
        $sl = 1;
        foreach($courses as $course)
        {
            $total = 0;
            $due = 0;
            $expected = 0;
            $course_id = $course->course_id;
            $yoa = date('Y');
            $number_students = $this->institute_model->getStudentsNumber($course_id,$institute_id,$selected_year);
            $tbody_html .= '
              <tr>
                <td>'.$sl++.'</td>
                <td class="text-capitalize">'.$course->course_name.'</td>
                <td class="text-capitalize students_number">'.$number_students.'</td>';
                $expected_amounts = $this->institute_model->getExpectedAmount($course_id,$institute_id,$selected_year);
                foreach($expected_amounts as $amount)
                {
                  $expected += $amount->yearly_fee;
                  $expected_sum += $amount->yearly_fee;
                }

                $paid_amounts = $this->institute_model->getPaidAmount($course_id,$institute_id,$selected_year);
                foreach($paid_amounts as $paid)
                {
                  $total += $paid->total_fee;
                  $total_sum += $paid->total_fee;
                }

                $due = $expected-$total;
                $due_sum += $due;
            $tbody_html .='<td class="expected_amount">'.$expected.'</td>';
            $tbody_html .='<td class="course_wise_amount">'.$total.'</td>';
            $tbody_html .='<td class="course_wise_due">'.$due.'</td>
              </tr>
            ';     
        }
        $tbody_html .= '
          <tr>
            <th colspan="3">Total</th>
            <th>'.$expected_sum.'</th>
            <th>'.$total_sum.'</th>
            <th>'.$due_sum.'</th>
          </tr>
        ';
      }
      print_r($tbody_html);
    }

public function filterStudents()
{
  $this->session_check();
  $year = $_POST['yr'];
  $course = $_POST['course'];
  $stream = $_POST['stream'];
  $agent = $_POST['agent'];
  $students = $this->institute_model->studentPayments($year,$course,$stream,$agent);

  $number_filter_row = count($students);

  $data = array();

  if(!empty($students))
  {
    foreach($students as $key=>$row)
    {
      $agent_id = $row->agent_name;
      if($agent_id != "")
      {
        $agent = $this->db->query("SELECT agent_name FROM agents WHERE agent_id = '".$agent_id."' ")->row();
        $agent_name = $agent->agent_name;
      }else{
        $agent_name = "";
      }
      $checkbox = '<label class="checkboxcontainer">
                    <input type="checkbox" value="<?php echo $enq[$i]->student_id; ?>" class="pivileges singleInput">
                    <span class="checkmark"></span>
                  </label>';

      $actions = '<div class="item-except _greyClr_ _fs14_">  
                    <div class="btn-group" role="group">
            
                    <button type="button" onclick="viewStudent('.$row->student_id.')" class="btn _fs14_  bg-success i-con-h-a view-bttn makeresponsive"><i class="i-con i-con-eye"></i></button>

                    <button type="button" onclick="editStudent('.$row->student_id.')" class="btn _fs14_  bg-primary i-con-h-a edit-bttn makeresponsive staff_unable"><i class="i-con i-con-edit"></i>Edit</button>

                    <button type="button" onclick="deleteFunc('.$row->student_id.');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn text-white staff_unable"><i class="i-con i-con-trash"><i></i></i></button>
                    
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-print"></i>
                    </button>

                   <ul class="dropdownList dropdown-menu" style="height:auto">
                        <li class="dropdown-item"><a class="btn" target="_blank" href="'.base_url().'institute/print_admission_letter/' .$row->student_id.'">View Admission Letter</a></li>
                        <li class="dropdown-item"><a class="btn" target="_blank" href="'.base_url().'institute/print_bonafied_letter/' . $row->student_id.'">View Bonafide Certificate</a></li>
                        <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructureBonafide( '.$row->student_id.','.$row->course_dur.')">Bonafide Certificate With Fees Structure</a></li>
                        <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructure('.$row->student_id.','.$row->course_dur.')">Fees Structure</a></li>
                        <li class="dropdown-item"><a class="btn" target="_blank" href="'.base_url().'institute/print_hostel_certificate/' . $row->student_id.'">Hostel Certificate</a></li>
                        <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="loanLetter('.$row->student_id.')">View Loan Letter</a></li>
                        <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="demandLetter()">Demand Letter</a></li>
                    </ul>
              </div>';

      $sub_array = array();
      $sub_array[] = $checkbox;
      $sub_array[] = $key+1;
      $sub_array[] = $row->student_code;
      $sub_array[] = $row->full_name;
      $sub_array[] = $row->mobile;
      $sub_array[] = $row->stream;
      $sub_array[] = $row->course;
      $sub_array[] = $row->yoa;
      $sub_array[] = $agent_name;
      $sub_array[] = $row->package;
      $sub_array[] = $actions;
      $data[] = $sub_array;
    }
  }
  
  $output = array(
   "draw"       =>  intval($_POST["draw"]),
   "recordsTotal"   =>  $number_filter_row,
   "recordsFiltered"  =>  $number_filter_row,
   "data"       =>  $data
  );

  echo json_encode($output);
}

public function online_application_list()
{
  $this->session_check();
  $time = $_POST['time'];
  $stream = $_POST['stream'];
  $status = $_POST['status'];
  $institute_id = $_SESSION['institute_id'];
  $students = $this->institute_model->applications_list($time,$stream,$status);
  $number_filter_row = count($students); 
  $data = array();

  if(!empty($students))
  {
    foreach($students as $key=>$row)
    {
      if($row->online_enquiry_status == '1')
      {
        $convert_btn = '<button type="button" enquiry_id="'.$row->online_enquiry_id.'" class="btn _wtClr_ _fs14_ _bgbrwn_ i-con-h-a print-bttn convert_btn">Convert Student</button>';
      }else{
        $convert_btn = '';
      }
      $edit_link = 'institute/edit_online_enquiry/'.$row->online_enquiry_id.'/edit';
      $view_link = 'institute/print_app_form/'.base64_encode($institute_id).'/'.base64_encode($row->online_enquiry_id);

      $wa_btn = '<a href="https://wa.me/+91'.$row->student_mobile_number.'?text=Hi '.$row->name.'Thanks for Taking online admission in our '.$_SESSION['name'].' We are looking forward to receive your documents scan copy and payment receipt of seat booking fee. For Any clarifications let me know to assist you to complete your online admission process. Thanks" target="_blank"><i class="fa fa-whatsapp text-success" style="font-size:20px"></i></a>';

      $actions = '<div class="btn-group text-center" role="group">
                    '.$convert_btn.'
                    <a type="button" target="_blank" href="'.$edit_link.'" class="btn _wtClr_ _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i></a>

                    <a type="button" target="_blank" href="'.$view_link.'" class="btn _wtClr_ _fs14_ bg-info i-con-h-a edit-bttn"><i class="fa fa-eye"></i></a>

                    <button type="button" onclick="deleteFunc('.$row->online_enquiry_id.')" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button>
                </div>';

      $sub_array = array();
      $sub_array[] = $key+1;
      $sub_array[] = $row->admmision_number;
      $sub_array[] = $row->name;
      $sub_array[] = $row->student_mobile_number;
      $sub_array[] = $row->father_name;
      $sub_array[] = $row->course_applied_for;
      $sub_array[] = $row->father_mo_number;
      $sub_array[] = date('d-M-Y',strtotime($row->online_enquiry_created_at));
      $sub_array[] = $wa_btn;
      $sub_array[] = $actions;
      $data[] = $sub_array;
    }
  }
  
  $output = array(
   "draw"       =>  intval($_POST["draw"]),
   "recordsTotal"   =>  $number_filter_row,
   "recordsFiltered"  =>  $number_filter_row,
   "data"       =>  $data
  );

  echo json_encode($output); 
}

public function saveGeneralReceipt()
{
  $institute_id = $_SESSION['institute_id'];
  $student_id = $_POST['student_id'];
  $part_names = $_POST['particular_name'];
  $part_amts = $_POST['particular_amt'];
  $total_amt = 0;
  $particulars = [];
  for($i=0;$i<count($part_amts);$i++)
  {
    $name = $part_names[$i];
    $amt = $part_amts[$i];
    $total_amt += $amt;
    $particulars[] = array(
      'part_name'=>$name,
      'part_amts'=>$amt,
    );
  }
  $part_serialize = serialize($particulars);
  $amt_words = $_POST['amt_words'];
  $payment_mode = $_POST['payment_mode'];
  $txn = $_POST['txn_number'];

  $data = array(
    'student_id'=>$student_id,
    'institute_id'=>$institute_id,
    'particulars'=>$part_serialize,
    'total_amt'=>$total_amt,
    'amt_words'=>$amt_words,
    'payment_mode'=>$payment_mode,
    'txn'=>$txn,
    'created_at'=>date('Y-m-d H:i:s')
  );
  
  if($this->institute_model->insertData('general_receipts',$data))
  {
    $receipt_id = $this->db->insert_id();
    redirect(base_url()."institute/print_general_receipt/".$receipt_id);
  }else{
    $this->session->set_flashdata('receipt_failed','Failed to generate receipt !');
  }

}

public function print_general_receipt($receipt_id)
{
  $where = array('receipt_id'=>$receipt_id);
  $details = $this->institute_model->getAllDataArray('general_receipts',$where);
  $institute_id = $details[0]->institute_id;
  $student_id = $details[0]->student_id;
  $where1 = array('institute_id'=>$institute_id);
  $institute = $this->institute_model->getAllDataArray('institute',$where1);
  $institute_logo = base_url().'uploads/'.$_SESSION['institute_logo'];
  $institute_name = $institute[0]->institute_name;
  $institute_address = $institute[0]->institute_address;
  $institute_mobile = $institute[0]->institute_mobile;
  $institute_email = $institute[0]->institute_email;
  
  $particulars = unserialize($details[0]->particulars);
  $where2 = array('student_id'=>$student_id);
  $student = $this->institute_model->getAllDataArray('students',$where2);
  
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
                  height:1000px;
                  border:2px solid #ccc; 
                }
                .clg_header{
                  height:150px;
                  border-bottom:2px solid #ccc;
                  
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

public function filterStudentList()
{
  $year = $_POST['selected_year'];
  $course = $_POST['selected_course'];
  $stream = $_POST['selected_stream'];
  $agent = $_POST['selected_agent'];
  $students = $this->institute_model->studentPayments($year,$course,$stream,$agent);

  $tbody_student = "";
  if(!empty($students))
  {
    $sl = 1;
    foreach($students as $stu)
    {
      $tbody_student .= '<tr>
                <td>
                    <label class="checkboxcontainer">
                        <input type="checkbox" value="'.$stu->student_id.'" class="pivileges singleInput">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$sl++.'</div>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_ text-capitalize">'.$stu->full_name.'</div>
                </td>            
                
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$stu->mobile.'</div>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$stu->course.'</div>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$stu->stream.'</div>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$stu->yoa.'</div>
                </td>
                <td>
                    <div class="item-except _greyClr_ _fs14_">'.$stu->package.'</div>
                </td>
                <td class="actionbtns text-center">
                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ view_span">
                        <button onclick="viewStudentPayment('.$stu->student_id.')" class="btn _fs14_ i-con-h-a view-bttn makeresponsive" style="background:#8E294F"><i class="i-con i-con-eye"></i></button>
                    </span>
                </td>          
              </tr>';   
    }
  }else{
    $tbody_student .= '<tr>
      <td colspan="3" style="text-align:center">No Data Found !</td>
    </tr>';
  }
  echo $tbody_student;
}

    public function update_agents_institues()
    {
      $agents = $this->db->query("SELECT * FROM agents")->result();
      if(!empty($agents))
      {
        foreach($agents as $agent)
        {
          $agent_id = $agent->agent_id;
          $institute_id = $agent->institute_id;
          $agentExist = $this->db->query("SELECT * FROM agents_institutes WHERE agent_id = '".$agent_id."' AND institute_id = '".$institute_id."' ")->result();
          if(count($agentExist) > 0)
          {

          }else{
            $data = array(
              'agent_id'=>$agent_id,
              'institute_id'=>$institute_id,
              'created_at'=>date('Y-m-d H:i:s')
            );
            if($this->institute_model->insertData('agents_institutes',$data))
            {
              echo "Success";
            }else{
              echo "Failed";
            }
          }
        }
      }
    }

    public function fbLeads()
    {
      $d = new DateTime();
      echo $d->format("Y-m-d H:i:s.v"); 
      exit;
      // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://www.facebook.com/ads/lead_gen/export_csv/
          ?id=<FORM_ID>
          &type=form
          &from_date=1482698431
          &to_date=1482784831');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($ch);
      if (curl_errno($ch)) {
          echo 'Error:' . curl_error($ch);
      }
      curl_close ($ch);

      $this->load->view('dashboard-includes/header');
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('fbleads');
      $this->load->view('dashboard-includes/footer');
    }

    public function webhooks()
    {
      // $req = file_get_contents('https://apps.eduwego.in/webhooks');
      // print_r($req);
      $this->load->view('dashboard-includes/header');
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('fbleads');
      $this->load->view('dashboard-includes/footer');
    }

    public function smsTemplates($id)
    {
      $student_id = base64_decode($id);
      $data['student'] = $this->db->query("SELECT full_name,mobile FROM students WHERE student_id = '".$student_id."' ")->row();
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('sms_templates');
      $this->load->view('dashboard-includes/footer');
    }

    public function offerLetter($id)
    {
      $lead_id = base64_decode($id);
      $where = array('id'=>$lead_id);
      $data['lead_details'] = $this->institute_model->getAllDataArray('leads',$where);
      $institute_id = $_SESSION['institute_id'];
      $where_course = array('institute_id' => $institute_id,'course_status'=>'1');
      $data['courses'] = $this->db->query("SELECT course_id,course_name FROM courses WHERE institute_id = '".$institute_id."' AND course_status = '1' ")->result();
      $data['menu'] = "offerletter";
      $this->load->view('dashboard-includes/header', $data);
      $this->load->view('dashboard-includes/left-sidebar');
      $this->load->view('offer_letter');
      $this->load->view('dashboard-includes/footer');
    }

    public function print_offer_letter()
    {
      $institute_id = $_SESSION['institute_id'];
      $student_name = $_POST['name'];
      $course = $_POST['course_name'];
      $course_id = $_POST['course_id'];
      $stream = $_POST['stream'];
      $stream_details = $this->db->query("SELECT * FROM streams WHERE stream_name = '".$stream."' AND course = '".$course_id."' AND  institute_id = '".$institute_id."' ")->result();
      $stream_eligibility = $stream_details[0]->eligibility;
      
      $admsn_fee = $_POST['admsn_fee'];
      $amount_in_words = $_POST['amount_in_words'];
      $scholarship_amount = $_POST['scholarship_amount'];
      $fee_last_date = date('d-M-Y',strtotime($_POST['fee_last_date']));
      $institute_name = $_SESSION['name'];
      $institute_logo = base_url().'uploads/'.$_SESSION['institute_logo'];
      $institute_sig = base_url().'uploads/'.$_SESSION['institute_sig'];
      $institute_address = $_SESSION['institute_address'];
      $institute_email = $_SESSION['email'];
      $institute_landline = $_SESSION['landline'];
      $current_date = date('d-M-Y');
      $refund_link = $_SESSION['refund_link'];
      $payment_link = $_SESSION['payment_link'];

      $package = $_POST['package'];
      $instalments = $_POST['installment_amount'];
      $instalment_list = '';
      if(!empty($instalments))
      {
        for($i=0;$i<count($instalments);$i++)
        {
          $instalment_list .= '<tr>
            <td style="text-align:center">Installment Month - '.($i+1).'</td>
            <td style="text-align:center">'.$instalments[$i].'</td>
          </tr>';
        }
        $instalment_list .= '<tr>
            <td style="text-align:center;font-weight:bold">Total Package</td>
            <td style="text-align:center;font-weight:bold">'.$package.'</td>
          </tr>';
      }

      $docs = $_POST['doc_name'];
      $doc_list = '';
      if(!empty($docs))
      {
        for($i=0;$i<count($docs);$i++)
        {
          $doc_list .= '<li>'.$docs[$i].'</li>';
        }
      }

      $fee_includes = array();

      isset($_POST['tution_fees']) ? $fee_includes[] = 'Tution Fees' : null;
      isset($_POST['board_fees']) ? $fee_includes[] = 'Board Fees' : null;
      isset($_POST['food_fees']) ? $fee_includes[] = 'Food & Hostel Fees' : null;
      isset($_POST['library_fees']) ? $fee_includes[] = 'Library Fees' : null;
      isset($_POST['sports_fees']) ? $fee_includes[] = 'Sports Fees' : null;
      isset($_POST['journal_fees']) ? $fee_includes[] = 'Journal Fees' : null;
      isset($_POST['lab_fees']) ? $fee_includes[] = 'Lab Fees' : null;
      isset($_POST['ojt_fees']) ? $fee_includes[] = 'OJT Fees' : null;
      isset($_POST['dress_fees']) ? $fee_includes[] = 'Dress Fees' : null;
      isset($_POST['portal_fees']) ? $fee_includes[] = 'Portal Fees' : null;

      $fee_include_list = '';

      if(!empty($fee_includes))
      {
        for($i=0;$i<count($fee_includes);$i++)
        {
          $fee_include_list .= '<li>'.$fee_includes[$i].'</li>';
        }
      }

      $bona_letter_html = '<!DOCTYPE html>
                      <html>
                      <head>
                      <title>Offer Letter</title>
                      <style>
                        .main_div{
                          width:100%;
                          height:1000px;
                          
                        }
                        .clg_header{
                          height:140px;
                          padding-bottom:12px;
                          border-bottom:3px solid #ccc;
                        }
                        .clg_header .logo_box{
                          width:20%;
                          height:100px;
                          float:left;
                        }
                        .clg_header .name_box{
                          width:80%;
                          float:right;
                        }
                        .clg_header .name_box h4{
                          padding:0;
                          margin-bottom:4px;
                        }
                        .clg_header .name_box p{
                          font-size:15px;
                          padding:0;
                          margin:0;
                        }
                        .logo_box .logo{
                          width:80px;
                          height:80px;
                          border-radius:50%;
                          margin:30px auto;
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
                        .receipt_details p{
                          text-align:justify;
                        }
                        .instalment_table tr th{
                          border:1px solid #ccc;
                          padding:7px;
                        }
                        .instalment_table tr td{
                          border:1px solid #ccc;
                          padding:7px;
                        }
                        .page-no{
                          position:absolute;
                          left:0;
                          bottom:0;
                          width:100%;
                          text-align:center;
                        }
                        .receipt-type h3,h4{
                            padding: 0;
                            margin: 5px 0px;
                        }
                      </style>
                      </head>
                      <body>
                      <div class="main_div">
                        <div class="clg_header">
                          <div class="logo_box">
                            <div class="logo">
                              <img src="'.$institute_logo.'" width="100%" />
                            </div>  
                          </div>
                          <div class="name_box">
                            <center>
                              <h3 style="font-weight:bold; margin-top:7px;margin-bottom:4px">'.$institute_name.'</h3>
                              <p>Address:'.$institute_address.'</p>
                              <p>Ph. : '.$institute_landline.', email: '.$institute_email.'</p>
                              <h4><u>Online Admission Offer Letter</u></h4>
                            </center>
                          </div>
                          
                        </div>
                        
                        <div class="receipt_details">
                          
                          <table style="width:100%">
                            <tr>
                              <td style="text-align:left">
                                <b>Dear '.$student_name.'</b>
                              </td>
                              <td style="text-align:right">
                                <b>Date : '.$current_date.'</b>
                              </td>
                            </tr>
                          </table>

                          <p><b>Sub : Provisional admission offer for '.$course.' with specialization in '.$stream.' Program .</b></p>

                          <p>Congratulations! Further to your application and basis your performance in the interview / communication had with us, you have been provisionally selected for admission to the <b>'.$course.' with specialization in '.$stream.' Program by '.$institute_name.' </b>.</p>

                          <p>With your background, interests and career ambitions, we are certain that '.$institute_name.' is the right place for you to pursue this program and become a confident industry leader.We believe you will benefit greatly from the unique academic experience that '.$institute_name.' has to offer and take the best next step towards a rewarding career.</p>

                          <p>Please be informed that you would be required to pay the Admission fee / Seat Booking fee of INR '.$admsn_fee.'/- ('.$amount_in_words.') by <b>'.$fee_last_date.'</b>.The remaining payments can be made through <b>Credit Card / Debit Card / Net banking / UPI which will be adjusted in the first year fee package of this course.</b></p>

                          <p>We congratulate you on your selection and welcome you to '.$institute_name.'</p>

                          <p><b>Scholarship Offered : '.$scholarship_amount.' Rs/-</b></p>

                        </div>

                        <table style="width:100%;margin-top:40px">
                          <tr>
                            <td style="width:70%;text-align:left">
                              
                            <td>
                            <td style="width:30%;text-align:center">
                              <img src="'.$institute_sig.'" width="150px" /><br/>
                              Best Regards,<br/>
                              Authorized Signatory<br/>
                              '.$institute_name.'
                            <td>
                          </tr>
                        </table>

                        <p><a href="'.$payment_link.'" target="_blank">Click here</a> to make online payment.
                        <br/>
                        <b>Please Note : Not valid if payment not done within due date.</b>
                        </p>

                        <p style="margin-top:100px">This is computer generated letter, does not require signature.</p>
                        <div class="page-no">1</div>
                      </div>

                      <div class="main_div">
                      <div class="clg_header">
                        <center><img src="'.$institute_logo.'" width="80px" /></center>
                        <div class="receipt-type">
                          <center>
                            <h3><span style="text-transform:capitalize">'.$course.'</span> with specialization in '.$stream.' Program</h3>
                            <h4><u>Admission Terms and Conditions</u></h4>
                          </center>
                        </div>
                      </div>
                      
                      <div class="receipt_details">
                        <center><h3>Annexure 1</h3></center>
                        <h4><b>A. Provisional Offer</b></h4>
                        <p>i) This is a provisional offer of admission and shall be confirmed subject to</p>
                        <ul>
                          <li>A) submission and verification of copies of academic certificates and transcripts to evaluate
                          eligibility for the program.</li>
                
                          <li>B) receipt of fee within the stipulated timeline.</li>
                        </ul>
                        
                        <p>
                          ii) Please be informed that '.$institute_name.' reserves the right to check the original
                          academic transcripts and other documents of the candidates who have taken admission into the
                          program. Any mismatch with the documents submitted earlier may lead to disqualification from the
                          program.
                        </p>

                        <h4><b>B. Eligibility Criteria</b></h4>
                        <p>All interested candidates are required to fulfill the below-mentioned eligibility criteria in order to apply for admission to '.$course.' with specialization in '.$stream.' Program</p>
                        <p>'.$stream_eligibility.'</p>

                        <h4><b>B. Documents Submission & Verification</b></h4>
                        <p>Enrolled candidates need to submit coloured scanned copies of the following educational documents.</p>

                        <ul>'.$doc_list.'</ul>

                      </div>

                      <table style="width:100%;margin-top:40px">
                          <tr>
                            <td style="width:70%"><td>
                            <td style="width:30%;text-align:center">
                              
                            <td>
                          </tr>
                      </table>
                      <div class="page-no">2</div>
                    </div>

                    <div class="main_div">
                      <div class="clg_header">
                        <center><img src="'.$institute_logo.'" width="80px" /></center>
                        <div class="receipt-type">
                          <center>
                            <h3><span style="text-transform:capitalize">'.$course.'</span> with specialization in '.$stream.' Program</h3>
                            <h4><u>Admission Terms and Conditions</u></h4>
                          </center>
                        </div>
                      </div>
                      
                      <div class="receipt_details">
                        <h4><b>D. Fee Schedule:</b></h4>
                        <p>The fee structure and payment schedule is provided in Annexure 2. Please note that failure to comply with the mentioned fee schedule will lead to disqualification from the program.</p>
                    
                        <h4><b>E. Refund Policy :</b></h4>
                        <p>All cancellations shall be processed as per the '.$institute_name.' ONLINE cancellation policy. Refer to the link : '.$refund_link.'</p>

                        <h4><b>F. Admission Helpline</b></h4>
                        <p>For any admission related query, candidates can write us to at <b>'.$institute_email.'</b> or call us at <b>'.$institute_landline.'</b></p>

                        <h4><b>F. Financial Assistance:</b></h4>
                        <p>The <span style="text-transform:capitalize">'.$stream.'</span> program is supported by multiple loan providers. In case you want to avail financial assistance, please reach out to our admissions team. Please note - Loan approval is subject to meeting Loan partner credit policy norms.</p>

                      </div>
                      <div class="page-no">3</div>
                    </div>

                    <div class="main_div">
                      <div class="">
                        <center><img src="'.$institute_logo.'" width="80px" /></center>
                        <div class="receipt-type">
                          <center>
                            <h3>Annexure 2</h3>
                            <h3><span style="text-transform:capitalize">'.$course.'</span> with specialization in '.$stream.' Program</h3>
                            <h4><u>Fee Schedule</u></h4>
                          </center>
                        </div>
                      </div>
                      <p><b>The approximate cost involved in this program are as follows:</b></p>
                      <div class="instalment_table" style="margin-top:30px">
                        <table style="width:100%;">
                          <thead>
                            <tr>
                              <th>Fee Installment</th>
                              <th>Amount (Rs.)</th>
                            </tr>
                          </thead>
                          <tbody>
                            '.$instalment_list.'
                          </tbody>
                        </table>
                      </div>

                      <p><b>Fee Includes:</b></p>
                      <ul>
                        '.$fee_include_list.'
                      </ul>

                      <p><b>Last Date of Admission : '.$fee_last_date.'</b></p>
                      <p><a href="'.$payment_link.'" target="_blank">Click here</a> to make online payment.
                      <p style="text-align:center;margin-top:40px">--------------------------End------------------------</p>
                      <div class="page-no">4</div>
                    </div>
                        
                      </body>
                      </html>';

                $this->pdf->loadHtml($bona_letter_html);
                $this->pdf->set_paper('A4', 'portrait');
                $this->pdf->render();
                $this->pdf->stream("'.$student_name.'-offer-letter.pdf", array("Attachment"=>0));
    }

public function fetchLeads()
{
  $institute_id = $_SESSION['institute_id'];
  $employee_id = $_SESSION['employee_id'];
  $lead_status = $_POST['lead_status'];
  if($lead_status != "")
  {
    if($_SESSION['is_staff_in'])
    {
      if($lead_status == "Untouched")
      {
        $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' AND assign_to = '".$employee_id."' AND contacted_medium IS NULL ORDER BY id DESC ")->result();
      }else{
        $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' AND assign_to = '".$employee_id."' AND contacted_medium = '".$lead_status."' ORDER BY id DESC ")->result();
      }
      
    }else if($_SESSION['is_institute_in']){
      if($lead_status == "Untouched")
      {
        $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' AND contacted_medium IS NULL ORDER BY id DESC ")->result();
      }else{
        $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' AND contacted_medium = '".$lead_status."' ORDER BY id DESC ")->result();
      }
      
    }
    
  }else{
    if($_SESSION['is_staff_in'])
    {
      $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' AND assign_to = '".$employee_id."' ORDER BY id DESC")->result();
    }else if($_SESSION['is_institute_in']){
      $result = $this->db->query("SELECT * FROM leads WHERE institute_id = '".$institute_id."' ORDER BY id DESC")->result();
    }
    
  }
  
  
  $number_filter_row = count($result);

  $data = array();

  foreach($result as $key=>$row)
  {
    $offer_letter_link = '<a href="'.base_url().'institute/offerLetter/'.base64_encode($row->id).'"><i class="fa fa-envelope"></i></a>';
    $emailed = $row->contacted_medium == "Emailed" ? "selected" : "";
    $prospectus = $row->contacted_medium == "Prospectus Sent" ? "selected" : "";
    $called = $row->contacted_medium == "Called" ? "selected" : "";
    $Whatsapp = $row->contacted_medium == "Whatsapp Done" ? "selected" : "";
    $doc_collect = $row->contacted_medium == "Documents Collected" ? "selected" : "";
    $online_app_done = $row->contacted_medium == "Online Application Done" ? "selected" : "";
    $offer = $row->contacted_medium == "Offer Letter Sent" ? "selected" : "";
    $admsn_fee = $row->contacted_medium == "Admission Fee Paid" ? "selected" : "";
    $fee_receipt_sent = $row->contacted_medium == "Fee Receipt Sent" ? "selected" : "";
    $admsn_done = $row->contacted_medium == "Admission Done" ? "selected" : "";
    $junk_lead = $row->contacted_medium == "Junk Lead" ? "selected" : "";
    $invalid_number = $row->contacted_medium == "Invalid Number" ? "selected" : "";
    $lost = $row->contacted_medium == "Lost" ? "selected" : "";
    $duplicate = $row->contacted_medium == "Duplicate" ? "selected" : "";
    $transfered = $row->contacted_medium == "Transferred to Associate" ? "selected" : "";

     $select_status = '<select class="contacted_medium form-control" lead_id="'.$row->id.'">
         <option value="">Select Status</option>
         <option value="Emailed" '.$emailed.'>Emailed</option>
         <option value="Prospectus Sent" '.$prospectus.'>Prospectus Sent</option>
         <option value="Called" '.$called.'>Called</option>
         <option value="Whatsapp Done" '.$Whatsapp.' >Whatsapp Done</option>
         <option value="Documents Collected" '.$doc_collect.' >Documents Collected</option>

         <option value="Online Application Done" '.$online_app_done.' >Online Application Done</option>

         <option value="Offer Letter Sent" '.$offer.'>Offer Letter Sent</option>

         <option value="Admission Fee Paid" '.$admsn_fee.'>Admission Fee Paid</option>

         <option value="Fee Receipt Sent" '.$fee_receipt_sent.'>Fee Receipt Sent</option>

         <option value="Admission Done" '.$admsn_done.'>Admission Done</option>

         <option value="Junk Lead" '.$junk_lead.'>Junk Lead</option>

         <option value="Invalid Number" '.$invalid_number.'>Invalid Number</option>

         <option value="Lost" '.$lost.'>Lost</option>

         <option value="Duplicate" '.$duplicate.'>Duplicate</option>

         <option value="Transferred to Associate" '.$transfered.'>Transferred to Associate</option>

      </select>';

      $actions= '<div class="item-except _greyClr_ _fs14_ text-capitalize stu_name action-con">
      <a target="_blank" href="'.base_url().'institute/lead_details/'.$row->id.'"><i class="fa fa-eye text-success"  style="font-size:20px" ></i></a>
      </div>';

     $sub_array = array();
     $sub_array[] = $key+1;
     $sub_array[] = $row->student_name;
     $sub_array[] = substr($row->mobile, 0, 3) . "****" . substr($row->mobile, 7, 4);
     $sub_array[] = $row->stream;
     $sub_array[] = $row->city;
     $sub_array[] = date('d-M-Y',strtotime($row->created_at));
      if($_SESSION['is_institute_in'])
      {
        $where = array('institute_id'=>$institute_id);
        $staffs = $this->institute_model->getAllDataArray('staff',$where);
        $assign_to = '';
        $assign_to .='<select class="staff_assigned form-control" lead_id="'.$row->id.'">
            <option value="">Select Employee</option>';
              
             if(!empty($staffs))
             {
              foreach($staffs as $staff)
              {
                $selected = $staff->employee_id == $row->assign_to ? "selected" : "";
                $assign_to .='<option value="'.$staff->employee_id.'" '.$selected.'  class="text-capitalize">'.$staff->employee_name.'</option>';
              }
             }
             
          $assign_to .='</select>';
          $sub_array[] = $assign_to;
      }
     $sub_array[] = $offer_letter_link;
     $sub_array[] = $select_status;
     $sub_array[] = $actions;
     $data[] = $sub_array;
  }

  $output = array(
   "draw"       =>  intval($_POST["draw"]),
   "recordsTotal"   =>  $number_filter_row,
   "recordsFiltered"  =>  $number_filter_row,
   "data"       =>  $data
  );

  echo json_encode($output);
}

public function analytics()
{
  is_institute_in();
  $institute_id = $_SESSION['institute_id'];
  $where = array('institute_id'=>$institute_id,'student_code !=' => '');
  $students = $this->institute_model->getAllStudent();
  $data['staffs'] = $this->institute_model->getAllActiveStaff();
  $male = [];
  $female = [];
  if(!empty($students))
  {
    foreach($students as $key=>$stu)
    {
      if($stu->gender == 'Male')
      {
        $male[] = $stu->student_id;
      }
      if($stu->gender == 'Female')
      {
        $female[] = $stu->student_id;
      }
    }
  }

  $courses = $this->institute_model->getAllActiveCourses();

  $data['male_count'] = count($male);
  $data['female_count'] = count($female);
  $data['menu'] = "analytics";  
  $data['site_title'] = "Analytics";
  $this->load->view('dashboard-includes/header', $data);
  $this->load->view('dashboard-includes/left-sidebar');
  $this->load->view('analytics');
  $this->load->view('dashboard-includes/footer');
}

public function filter_analytics()
{
  $yr = $_GET['yr'];
  $time = $_GET['time'];
  $staff = $_GET['counsellor'];
  $institute_id = $_SESSION['institute_id'];
  $leads = $this->institute_model->leads_analytics($yr,$time,$date,$staff);
  $data['total_leads'] = count($leads);

  $untouched = array();
  $called = array();
  $whatsapp_done = array();
  $emailed = array();
  $prospectus_sent = array();
  $online_applications = array();
  $admsn_fee_paid = array();
  $junk_lead = array();
  $invalid_number = array();
  $lost_leads = array();
  $duplicate = array();
  $transferred_assos = array();
  $docs_collected = array();
  $offer_letter = array();
  $admsn_done = array();

  if(!empty($leads))
  {
    foreach($leads as $key=>$lead)
    {
      if($lead->contacted_medium == null)
      {
        $untouched[] = $lead->id;
      }
      if($lead->contacted_medium == "Called")
      {
        $called[] = $lead->id;
      }
      if($lead->contacted_medium == "Whatsapp Done")
      {
        $whatsapp_done[] = $lead->id;
      }
      if($lead->contacted_medium == "Emailed")
      {
        $emailed[] = $lead->id;
      }
      if($lead->contacted_medium == "Prospectus Sent")
      {
        $prospectus_sent[] = $lead->id;
      }
      if($lead->contacted_medium == "Online Application Done")
      {
        $online_applications[] = $lead->id;
      }
      if($lead->contacted_medium == "Admission Fee Paid")
      {
        $admsn_fee_paid[] = $lead->id;
      }
      if($lead->contacted_medium == "Junk Lead")
      {
        $junk_lead[] = $lead->id;
      }
      if($lead->contacted_medium == "Invalid Number")
      {
        $invalid_number[] = $lead->id;
      }
      if($lead->contacted_medium == "Duplicate")
      {
        $duplicate[] = $lead->id;
      }
      if($lead->contacted_medium == "Lost")
      {
        $lost_leads[] = $lead->id;
      }
      if($lead->contacted_medium == "Transferred to Associate")
      {
        $transferred_assos[] = $lead->id;
      }
      if($lead->contacted_medium == "Documents Collected")
      {
        $docs_collected[] = $lead->id;
      }
      if($lead->contacted_medium == "Offer Letter Sent")
      {
        $offer_letter[] = $lead->id;
      }
      if($lead->contacted_medium == "Admission Done")
      {
        $admsn_done[] = $lead->id;
      }

    }
  }

  $data['untouched'] = count($untouched);
  $data['called_count'] = count($called);
  $data['whatsapp_count'] = count($whatsapp_done);
  $data['emailed'] = count($emailed);
  $data['prospectus_sent'] = count($prospectus_sent);
  $data['online_applications'] = count($online_applications);
  $data['admsn_fee_paid'] = count($admsn_fee_paid);
  $data['junk_lead'] = count($junk_lead);
  $data['invalid_number'] = count($invalid_number);
  $data['duplicate'] = count($duplicate);
  $data['docs_count'] = count($docs_collected);
  $data['offer_letter'] = count($offer_letter);
  $data['lost_leads'] = count($lost_leads);
  $data['admsn_done'] = count($admsn_done);
  $data['transferred_assos'] = count($transferred_assos);


 $staffs = $this->db->query("SELECT employee_id,employee_name FROM staff WHERE institute_id = '".$institute_id."' AND employee_status = '2' ")->result();

 $staff_arr = [];
 if(!empty($staffs))
 {
   foreach($staffs as $staff)
   {
      $staff_id = $staff->employee_id;
      $leads = $this->db->query("SELECT COUNT('id') as leads_no FROM leads WHERE assign_to = '".$staff_id."' ")->row();
      $no_of_leads = $leads->leads_no;
      $staff_arr[] = array(
        'staff_id' => $staff_id,
        'staff_name' => $staff->employee_name,
        'no_of_leads' => $no_of_leads
      );
   }
 }

  $data['staffs'] = $staff_arr; 
  print_r(json_encode($data));

}

public function filter_student_analytics()
{
  $institute_id = $_SESSION['institute_id'];
  $yr = $_GET['yr'];
  $time = $_GET['time'];

  $gender = $this->institute_model->get_students($yr,$time);
  $courses = $this->institute_model->getAllActiveCourses();
  $streams = $this->institute_model->getAllActiveStreams();
  $online_applications = $this->institute_model->get_online_applications($yr,$time);
  $pending_applications = [];
  $admitted_applications = [];
  if(!empty($online_applications))
  {
     foreach($online_applications as $apps)
     {
      if($apps->online_enquiry_status == '1')
      {
         $pending_applications[] = $apps->online_enquiry_id;
      }else if($apps->online_enquiry_status == '2')
      {
         $admitted_applications[] = $apps->online_enquiry_id;
      }
     }
  }

  $male = [];
  $female = [];
  if(!empty($gender))
  {
    foreach($gender as $gen)
    {
      if($gen->gender == 'Male')
      {
        $male[] = $gen->gender;
      }else if($gen->gender == 'Female'){
        $female[] = $gen->gender;
      }
    }
  }

  $male_count = count($male);
  $female_count = count($female);
  $gender_arr = array(
      'male'=>$male_count,
      'female'=>$female_count
  );

  $course_arr = [];
  if(!empty($courses))
  {
    foreach($courses as $course)
    {
      $course_id = $course->course_id;
      // $course_arr[] = $course->course_name;
      $no_of_students = $this->institute_model->course_wise_students('course',$course_id,$yr,$time);
      $course_arr[] = array(
        'course_name' => $course->course_name,
        'no_of_students' => $no_of_students 
      );
    }
  }

  $stream_arr = [];
  if(!empty($streams))
  {
    foreach($streams as $stream)
    {
      $stream_name = $stream->stream_name;
      $no_of_students = $this->institute_model->course_wise_students('stream',$stream_name,$yr,$time);
      $stream_arr[] = array(
        'stream_name' => $stream->stream_name,
        'no_of_students' => $no_of_students 
      );
    }
  }

  $total_arr = array(
    'gender'=>$gender_arr,
    'course'=>$course_arr,
    'stream'=>$stream_arr,
    'total_applications'=>count($online_applications),
    'pending_applications'=>count($pending_applications),
    'admitted_applications'=>count($admitted_applications),
  );

  print_r(json_encode($total_arr));
}

   public function getIvrCallsDetails(){
      $session = $this->session_check();
      if($session == true)
      {
        $data['menu'] = 'ivr_call_details';
        $data['site_title'] = "ZEQON | ivr_call_details";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/left-sidebar');
        $this->load->view('ivr_call_details');
        $this->load->view('dashboard-includes/footer');
      }
    }
    
public function csv()
    {
        // Load the upload library
        $this->load->library('upload');
        // Set the upload configuration
        $config['upload_path'] = './uploads/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 1000; // in KB
        $this->upload->initialize($config);
        // Perform the upload
        if (!$this->upload->do_upload('userfile')) {
            // If upload fails, display error
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            // If upload succeeds, read the CSV file and insert data into the database
            $data = array('upload_data' => $this->upload->data());
            $file_path = './uploads/csv/' . $data['upload_data']['file_name'];
                $handle = fopen($file_path, 'r');
            if ($handle !== false) {
                // Read the header row
                $header = fgetcsv($handle, 1000, ',');
                // Read the remaining rows
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    // Process the data
                //   echo"<pre>"; print_r($data);die;
                //     $this->db->insert('import_leads', $data);
                    $this->db->set('institute_id', $_SESSION['institute_id']);
                    $this->db->set('name', $data[0]);
                    $this->db->set('email', $data[1]);
                    $this->db->set('phone', $data[2]);
                    $this->db->set('qualification', $data[3]);
                    $this->db->set('city', $data[4]);
                    $this->db->set('state', $data[5]);
                    $this->db->insert('import_leads');
                }
            
                fclose($handle);
                $this->load->view('upload_success');
            } else {
                echo 'Failed to open file';
            }
            }
    }



public function welcome_lead_whatsapp(){

                $numbers = "+91".$_REQUEST['mobile'];
            $post = array('campaignName' =>'eduwego-welcome-msg', 'destination'=> $numbers,'userName'=>'EDUWEGO','templateParams'=>array($_REQUEST['student_name'],$_REQUEST['stream'],$_REQUEST['name'],$_REQUEST['city'],$_REQUEST['admission_link'],$_REQUEST['youtube_link'],$_REQUEST['admin'],$_REQUEST['name1'],$_REQUEST['city1']),'apiKey' =>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
            $json = json_encode($post);
            $url = 'https://backend.aisensy.com/campaign/t1/api/v2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            echo json_encode(array('status'=>true, 'message'=>'Sent Successfull'));
}


public function sendsignupotp(){
            $permitted_chars = '0123456789';
            $otp =  substr(str_shuffle($permitted_chars), 0, 6);
            $user_name = $_REQUEST['user_name'];
            $numbers = "91".$_REQUEST['mob'];
            $post = array('campaignName' =>'Eduwego Login Otp', 'destination'=> $numbers,'userName'=>'EDUWEGO','templateParams'=>array($user_name,$otp),'apiKey' =>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
            $json = json_encode($post);
            $url = 'https://backend.aisensy.com/campaign/t1/api/v2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);  
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
}


            public function fee_due(){
                    
                $numbers = "+91".$_REQUEST['mobile'];
            $post = array('campaignName' =>'eduwego-fee-due', 'destination'=> $numbers,'userName'=>'EDUWEGO','templateParams'=>array($_REQUEST['student_name'],$_REQUEST['institute_name'],$_REQUEST['payment_link'],'Name : '.$_REQUEST['beneficiary'],'A/C : '.$_REQUEST['account_no'],'IFSC : '.$_REQUEST['ifsc_code'],'Branch : '.$_REQUEST['branch_name'],'Bank Name : '.$_REQUEST['bank_name']),'apiKey' =>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2ZSIsIm5hbWUiOiJaZXFvbiBUZWNobm9sb2dpZXMgUHJpdmF0ZSBMaW1pdGVkIiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0OTkyZTJmYTQ0MTMyMGJkN2QzMDQ2NyIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNjg3NzYwNDMxfQ.WBtTrBRj_1qiUYvasZTfjhLTEguO5T_gMPSZapy6KCY');
        
            $json = json_encode($post);
            $url = 'https://backend.aisensy.com/campaign/t1/api/v2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            echo json_encode(array('status'=>true, 'message'=>'Sent Successfull'));
}


            public function make_call(){
                $numbers = "+91".$_REQUEST['mobile'];
            $post = array('company_id' =>'65e7161668b86727', 'secret_token'=> 'e04e5c0c261ecc82ddcc9150f0a451ea5d789e64956829a01d503d08930a6e28','type'=>'1','user_id'=>'65e7161669c6c698','number'=>$numbers,'public_ivr_id'=>'65f2801659331158','apiKey'=>'oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh');
            $json = json_encode($post);
            $url = 'https://obd-api.myoperator.co/obd-api-v1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh','Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            echo json_encode(array('status'=>true, 'message'=>'Call Initiated Successfully'));
}

           public function hang_call(){
                $numbers = "+91".$_REQUEST['mobile'];
            $post = array('token'=> 'd70d5b939c7b0deae98315c5592aa21b','uid'=>'65e7161669c6c698','action'=>'hangup');
            $json = json_encode($post);
            $url = 'https://developers.myoperator.co/call/action';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $curl_exicute = curl_exec($ch);
            echo"<pre>";print_r($curl_exicute);die;
            $decodedata = json_decode($curl_exicute, true);
            curl_close($ch);
            echo json_encode(array('status'=>true, 'message'=>'Call hanged up Successfully'));
}


}//end controller

?>