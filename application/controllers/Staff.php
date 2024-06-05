<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller
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
        $this->load->model('Staff_model');
    }

    public function staff_login()
    {
    	$data['site_title'] = "Eduwego | Employee Login"; 
    	$this->load->view('staff/login',$data);
    }

    public function staffLogin(){
        if(isset($_POST) && !empty($_POST)){
            $mobile      = $this->input->post("mobile");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('mobile', 'mobile or contact', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }

            else{
                $status=$this->Staff_model->login($mobile,$password);
                if($status){
                    echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
                }else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Phone or Password.'));die;
                }
            }
        }
        $data['site_title'] = "EduweGo+ | Staff Login";
        $this->load->view('staff/login',$data);
    }

    public function dashboard()
    {
    	echo "login success";
    }

    public function staff_forgot_password()
    {
        $email = $_POST['email'];
        $where = array('employee_email' => $email);   
        $assignments = $this->staff_model->checkEmail('staff',$where);
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
                            "institute_password" => md5($new_pass)
                        );
                        $update = $this->staff_model->updateAllData('staff',$where,$userData);
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

    public function search()
    {
      // $session = $this->session->userdata($data);
      // if($session['is_staff_in'] == true)
      // {
      //   $data['site_title'] = "ZEQON | Search Student";  
      //   $this->load->view('dashboard-includes/header', $data);
      //   $this->load->view('dashboard-includes/left-sidebar');
      //   $this->load->view('');
      //   $this->load->view('dashboard-includes/footer');
      // }
      
    }

}//end controller
?>