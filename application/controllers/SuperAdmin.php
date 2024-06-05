<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{

	public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('common_helper'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('zip');
        $this->load->model('SuperAdmin_model');
    }

	public function login(){
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }
            $status = $this->SuperAdmin_model->login($email,$password);

            if($status) {
                echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
            } else{
                echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));die;
            }
        }
        $data['site_title'] = "EduweGo+ | Login";
        $this->load->view('superAdmin/login');
    }

    public function dashboard(){
        // is_admin_in();
        $data['site_title'] = "EduweGo+ | Dashboard";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/admin-sidebar');
        $this->load->view('superAdmin/dashboard');
        $this->load->view('dashboard-includes/footer');
    }


}//end controller

?>