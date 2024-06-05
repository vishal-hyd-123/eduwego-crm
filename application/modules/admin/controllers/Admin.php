<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('common_helper'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('zip');
        $this->load->model('admin_model');
    }

    public function session_check()
    {
     
      if($this->session->userdata('is_super_in') == true || $this->session->userdata('is_admin_in') == true)
      {
        return true;
      }
      else{
        return false;
      }
    }

    public function superLogin_view()
    {
        $data['site_title'] = "EduweGo+ | Login";
        $this->load->view('super_login',$data); 
    }

    public function superLogin(){
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }
            $status = $this->admin_model->superLogin($email,$password);

            if($status){
                echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
            }else{
                echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));die;
            }
        }
        $data['site_title'] = "EduweGo+ | Login";
        $this->load->view('super_login',$data);
    }

    public function index(){
        
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }
            $status=$this->admin_model->login($email,$password);

            if($status){
                echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
            } else {
                echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));die;
            }
        }
        $data['site_title'] = "EduweGo+ | Login";
        $this->load->view('login',$data);
    }

    public function dashboard(){
        $session = $this->session_check();
        if($session == true)
        {
            $data['site_title'] = "EduweGo+ | Dashboard";  
            $this->load->view('dashboard-includes/header', $data);
            $this->load->view('dashboard-includes/superAdmin-sidebar');
            $this->load->view('dashboard');
            $this->load->view('dashboard-includes/footer'); 
        }
        
    }

    public function admin_dashboard(){
        $session = $this->session_check();
        if($session == true)
        {
            $data['site_title'] = "EduweGo+ | Dashboard";  
            $this->load->view('dashboard-includes/header', $data);
            $this->load->view('dashboard-includes/admin-sidebar');
            $this->load->view('admin_dashboard');
            $this->load->view('dashboard-includes/footer'); 
        }
        
    }

    public function searchStudents()
    {
        $session = $this->session_check();
        if($session == true)
        {
            $srch_by = $this->input->post('srch_by');
            $srch_number = $this->input->post('srch_number');
            $students = $this->admin_model->fecthStudentsList($srch_by,$srch_number);
            if($students != null)
            {
                print_r(json_encode($students));
            }
            else{
                echo "No Data Found";
            }
        }
    }

    public function getStudentData()
    {
        $session = $this->session_check();
        if($session == true)
        {
            $stu_id = $this->input->post('stu_id');
            $stu_data = $this->admin_model->getStudentById($stu_id);
            $payment_data = $this->admin_model->getPaymentData($stu_id);
            $merge_data = array_merge($stu_data,$payment_data);
            if($merge_data != null)
            {
                print_r(json_encode($merge_data));
            }
        }
    }

    public function admin_list()
    {
        if($this->session->userdata('is_super_in'))
        {
            $data['institutes'] = $this->admin_model->getAllActiveInstitute();
            $data['admins'] = $this->admin_model->fetchAdmins();
            $data['site_title'] = "EduweGo+ | Admin_list";  
            $this->load->view('dashboard-includes/header', $data);
            $this->load->view('dashboard-includes/superAdmin-sidebar');
            $this->load->view('admin_list');
            $this->load->view('dashboard-includes/footer');
        }

    }

    public function add_admin()
    {
        if(isset($_POST) && !empty($_POST))
        {
            
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('institute_id','Institute Id','required');
            $this->form_validation->set_rules('institute_name','Institute Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('mobile','Mobile','required|exact_length[10]|numeric');

            if($this->form_validation->run() == true)
            {
                $name = $this->input->post('name');
                $institute_id = $this->input->post('institute_id');
                $institute_name = $this->input->post('institute_name');
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
                $password = md5('admin123456');

                $status = $this->admin_model->checkAdminAvail($email);
                if($status == true)
                {
                  $data = array(
                    'name' => $name,
                    'institute_id' => $institute_id,
                    'institute_name' => $institute_name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'password' => $password
                    );

                    if($this->admin_model->insert_admin($data))
                    {
                        echo json_encode(array('status'=>true, 'message'=>'Admin Added Successfully'));die; 
                    }
                    else{
                        echo json_encode(array('status'=>false, 'errormessage'=>'Admin Add Failed'));die;
                    }  
                }
                else{
                   echo json_encode(array('status'=>false, 'errormessage'=>'Email id allready exists !'));die; 
                }
                
            }

            else{
                echo json_encode(array('status'=>false, 'errormessage'=>'Fill with correct details !'));die;
            }
               
        }
    }

    public function edit_admin()
    {
        if(isset($_POST) && !empty($_POST))
        {
            
            $this->form_validation->set_rules('edit_name','Name','required');
            $this->form_validation->set_rules('edit_institute_id','Institute Id','required');
            $this->form_validation->set_rules('edit_institute_name','Institute Name','required');
            $this->form_validation->set_rules('edit_mobile','Mobile','required|exact_length[10]|numeric');

            if($this->form_validation->run() == true)
            {
                $name = $this->input->post('edit_name');
                $institute_id = $this->input->post('edit_institute_id');
                $institute_name = $this->input->post('edit_institute_name');
                $mobile = $this->input->post('edit_mobile');
                $admin_id = $this->input->post('admin_id');

                  $data = array(
                        'name' => $name,
                        'institute_id' => $institute_id,
                        'institute_name' => $institute_name,
                        'mobile' => $mobile
                    );

                    if($this->admin_model->update_admin($admin_id,$data))
                    {
                        echo json_encode(array('status'=>true, 'message'=>'Update Successful .'));die; 
                    }
                    else{
                        echo json_encode(array('status'=>false, 'errormessage'=>'Update Failed'));die;
                    }  
                
            }

            else{
                
                echo json_encode(array('status'=>false, 'errormessage'=>'Fill correct details !'));die;
            
            }
            
        }
    }

    public function getAdminById()
    {
        $admin_id = $_POST['admin_id'];
        $admin_details = $this->admin_model->getAdminById($admin_id);
        print_r(json_encode($admin_details));
    }

    public function deleteAdmin()
    {
        $admin_id = $this->input->post('admin_id');
        $status = $this->admin_model->deleteAdmin($admin_id);
        if($status){
            echo json_encode(array('status'=>true, 'message'=>'Admin Deleted Successfully.'));die;
        }else{
            echo json_encode(array('status'=>false, 'errormessage'=>'Failed to Delete'));die;
        }
    }

    public function institute_list(){
        // is_admin_in();
        $data['site_title'] = "EduweGo+ | institute_list";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('institute_list');
        $this->load->view('dashboard-includes/footer');

    }

    public function add_institute_new(){
        // is_admin_in();
        $data['site_title'] = "EduweGo+ | add_institute_new";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('add_institute_new');
        $this->load->view('dashboard-includes/footer');

    } 
    public function permission_section(){
        // is_admin_in();
        $data['site_title'] = "EduweGo+ | permission_section";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('permission_section');
        $this->load->view('dashboard-includes/footer');

    }
    public function all_old_institute(){
        // is_admin_in();
        $data['site_title'] = "EduweGo+ | all_old_institute";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('all_old_institute');
        $this->load->view('dashboard-includes/footer');

    }
    public function logout(){
        $this->session->sess_destroy(); 
        $br = $this->config->base_url();
        redirect($br, 'refresh');
    }

    public function change_password(){
      if($this->session->userdata('is_super_in'))
      {
        $data['site_title'] = "ZEQON | Change Password";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('change-password');
        $this->load->view('dashboard-includes/footer');
      }
      if($this->session->userdata('is_admin_in'))
      {
        $data['site_title'] = "ZEQON | Change Password";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/admin-sidebar');
        $this->load->view('change-password');
        $this->load->view('dashboard-includes/footer');
      } 
    } 


    public function login(){
        if(isset($_POST) && !empty($_POST)){
            $email      = $this->input->post("email");
            $password   = md5($this->input->post("password"));
            $this->form_validation->set_rules('email', 'email or contact', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                echo json_encode(array('status'=>false, 'message' => json_encode($errors)));die;
            }
            $status=$this->admin_model->login($email,$password);

            if($status) {
                echo json_encode(array('status'=>true, 'message'=>'Login Successful'));die;
            } else {
                echo json_encode(array('status'=>false, 'errormessage'=>'Invalid Email or Password.'));die;
            }
        }
        $data['site_title'] = "EduweGo+ | Login";
        $this->load->view('login');
    }
    
     public function add_institute(){
            $institute_name      = $_POST['name'];
            $admin_name          = $_POST['admin_name'];
            $institute_mobile    = $_POST['mobile'];
            $institute_email     = $_POST['email'];
            $institute_website   = $_POST['website'];
            $facebook            = $_POST['facebook'];
            $instagram           = $_POST['instagram'];
            $youtube             = $_POST['youtube'];
            $google_business     = $_POST['google_business'];
            $brochure_link       = $_POST['brochure_link'];
            $refund_link         = $_POST['refund_link'];
            $allowed_student     = $_POST['allowed_student'];
            $leads_allowed       = $_POST['leads_allowed'];
            $emp_allowed         = $_POST['emp_allowed'];
            $landline            = $_POST['landline'];
            $affiliations        = $_POST['affiliation'];

            if(isset($_POST['password']))
            {
                $inst_password = $_POST['password'];
                $institute_password = md5($_POST['password']);
            }
            
            $payment_api_key = $_POST['payment_api_key'];
            $institute_address                = $_POST['address'];
            $msg_api_username                 = $_POST['msg_api_username'];
            $msg_api_password                 = $_POST['msg_api_password'];
            $subdomain                        = $_POST['subdomain'];
            $state                            = $_POST['state'];
            $city                             = $_POST['city'];
            $html_file_name                   = $_POST['html_file_name'];
            $html_file_name_editable          = $_POST['html_file_name_editable'];
            $post_expiry_date                 = str_replace('/','-',$_POST['expiry_date']);
            $expiry_date                      = date("Y-m-d",strtotime($post_expiry_date));

            $status                           = 1;
            $institute_updated_at             = date("Y-m-d H:i:s");
            $bank_name = $_POST['bank_name'];
            $branch_name = $_POST['branch_name'];
            $account_no = $_POST['account_no'];
            $ifsc_code = $_POST['ifsc_code'];
            $beneficiary = $_POST['beneficiary'];

            $dashboard = isset($_POST['dashboard']) ? $_POST['dashboard'] : "";
            $inbox = isset($_POST['inbox']) ? $_POST['inbox'] : "";
            $leads = isset($_POST['leads']) ? $_POST['leads'] : "";
            $student_search = isset($_POST['student_search']) ? $_POST['student_search'] : "";
            $students = isset($_POST['students']) ? $_POST['students'] : null;
            $admission = isset($_POST['admission']) ? $_POST['admission'] : null;
            $associate = isset($_POST['associate']) ? $_POST['associate'] : null;
            $assos_req = isset($_POST['assos_req']) ? $_POST['assos_req'] : null;
            $institutes = isset($_POST['institutes']) ? $_POST['institutes'] : null;
            $fee_mgmt = isset($_POST['fee_mgmt']) ? $_POST['fee_mgmt'] : null;
            $courses = isset($_POST['courses']) ? $_POST['courses'] : null;
            $stream = isset($_POST['stream']) ? $_POST['stream'] : null;
            $staff = isset($_POST['staff']) ? $_POST['staff'] : null;
            $vendor = isset($_POST['vendor']) ? $_POST['vendor'] : null;
            $reports = isset($_POST['reports']) ? $_POST['reports'] : null;
            $sms = isset($_POST['sms']) ? $_POST['sms'] : null;
            $social_media = isset($_POST['social_media']) ? $_POST['social_media'] : null;

            $menu_data = array(
                'dashboard'         => $dashboard,
                'inbox'             => $inbox,
                'search'            => $student_search,
                'leads'             => $leads,
                'students'          => $students,
                'admission'         => $admission,
                'associates'        => $associate,
                'assos_req'         => $assos_req,
                'institutes'        => $institutes,
                'fee_mgmt'          => $fee_mgmt,
                'courses'           => $courses,
                'stream'            => $stream,
                'staff'             => $staff,
                'vendor'            => $vendor,
                'reports'           => $reports,
                'sms'               => $sms,
                'social_media'      => $social_media
            );
            // print_r($menu_data);exit;

            $insert_data  = array(
                    'institute_name'              => $institute_name,
                    'admin_name'                  => $admin_name,
                    'institute_allowed_student'   => $allowed_student,
                    'institute_mobile'            => $institute_mobile ,
                    'institute_email'             => $institute_email,
                    'institute_website'           => $institute_website,
                    'facebook_link'               => $facebook,
                    'instagram_link'              => $instagram,
                    'youtube_link'                => $youtube,
                    'google_business_link'        => $google_business,
                    'brochure_link'               => $brochure_link,
                    'refund_link'                 => $refund_link,  
                    'institute_address'           => $institute_address,
                    'institute_status'            => $status,
                    'msg_api_password'            => $msg_api_password,
                    'msg_api_username'            => $msg_api_username,
                    'payment_api_key'             => $payment_api_key,
                    'institute_expiry_date'       => $expiry_date,
                    'subdomain'                   => $subdomain,
                    'state'                       => $state,
                    'city'                        => $city,
                    'leads_allowed'               => $leads_allowed,
                    'emp_allowed'                 => $emp_allowed,
                    'html_file_name'              => $html_file_name,
                    'html_file_name_editable'     => $html_file_name_editable,
                    'bank_name'                   => $bank_name,
                    'branch_name'                 => $branch_name,
                    'account_no'                  => $account_no,
                    'ifsc_code'                   => $ifsc_code,
                    'beneficiary'                 => $beneficiary,
                    'landline_no'                 => $landline,
                    'affiliations'                => $affiliations
                );

                if(isset($_FILES['logo']) && $_FILES['logo']!="" && !empty($_FILES['logo']['name'])){
                    $file_orignal_name = $_FILES['logo']['name'];
                    $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
                    // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
                    $path = 'institute/logo/';
                    $image_name = time().uniqid().$file_orignal_name;
                    $input_name = 'logo';
                    $result = $this->admin_model->upload_image($path, $image_name, $input_name);
                    // echo '<pre>'; print_r($result); echo '</pre>';
                    if ($result) {
                        $insert_data['institute_logo'] = $path.$image_name;
                    }else{
                        $insert_data['institute_logo'] = "";
                    } 
                } else{
                    if(isset($_POST['old_logo']) && !empty($_POST['old_logo']))
                    {
                       $insert_data['institute_logo'] = $_POST['old_logo']; 
                    } else{
                        $insert_data['institute_logo'] = "";
                    }
                    
                }

                if(isset($_FILES['sig']) && $_FILES['sig']!="" && !empty($_FILES['sig']['name'])){
                    $file_orignal_name = $_FILES['sig']['name'];
                    $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
                    // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
                    $path = 'institute/sig/';
                    $image_name = time().uniqid().$file_orignal_name;
                    $input_name = 'sig';
                    $result = $this->admin_model->upload_image($path, $image_name, $input_name);
                    // echo '<pre>'; print_r($result); echo '</pre>';
                    if ($result) {
                        $insert_data['institute_sig'] = $path.$image_name;
                    }else{
                        $insert_data['institute_sig'] = "";
                    } 
                } else{
                    if(isset($_POST['old_sig']) && !empty($_POST['old_sig']))
                    {
                       $insert_data['institute_sig'] = $_POST['old_sig']; 
                    } else{
                        $insert_data['institute_sig'] = "";
                    }
                    
                }

    
            if(!isset($_POST['institute_id']) || $_POST['institute_id'] == ""){                
                    $where0  = array(
                        'institute_mobile'  => $institute_mobile,
                        'institute_status!='  => 9
                    );
                    $checkLimit0=$this->admin_model->getAllDataArray(TBL_INSTITUTE,$where0);
                    if (count($checkLimit0)){
                        echo json_encode(array('status'=>false, 'errormessage'=>'Institute With same mobile number already exists'));die;
                        
                    }

                    $where1  = array(
                        'institute_email' => $institute_email,
                        'institute_status!='  => 9
                    );
                    $checkLimit1=$this->admin_model->getAllDataArray(TBL_INSTITUTE,$where1);
                    if (count($checkLimit1)) {
                        echo json_encode(array('status'=>false, 'errormessage'=>'Institute With same email already exists'));die;
                        
                    }

                    $where2  = array(
                        'subdomain' => $subdomain,
                        'html_file_name' => $html_file_name,
                        'html_file_name_editable' => $html_file_name_editable,
                        'institute_status!='  => 9
                    );
                    $checkLimit2 = $this->admin_model->getAllDataArray(TBL_INSTITUTE,$where2);
                    if (count($checkLimit2)) {
                        echo json_encode(array('status'=>false, 'errormessage'=>'Subdomain or html file name or html file name editable allready exists.'));die;
                        
                    }
                    $insert_data['institute_password'] = $institute_password;
                    $insert_data['institute_created_at'] = date('Y-m-d H:i:s');
                    //print_r($insert_data);exit;
                    $status = $this->admin_model->insertData(TBL_INSTITUTE,$insert_data);
                    if($status){
                        $insert_id = $this->db->insert_id();
                        $menu_data['institute_id'] = $insert_id;
                        $menu_data['created_at'] = date('Y-m-d');
                        // print_r($menu_data);exit;
                        $this->admin_model->insertData('menus',$menu_data);

                        //send mail to institute
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
                          "to": [{"email_address": {"address": '.$institute_email.',"name": '.$institute_name.'}}],
                          "subject":"Welcome to EDUWEGO | Login Details !",
                          "htmlbody":"Dear '.$institute_name.' Your account is now active.<br/><b>Login URL :</b> http://www.eduwego.in/<br/><b>Login Id :</b> '.$institute_email.'<br><b>Password :</b> '.$inst_password.'<br><br>Thanks for Giving Opportunity to partner us to increase your number of Admissions and student management<br>Best Regards<br><b>Eduwego - Activation Team</b><br>http://www.eduwego.in/<br>This is system generated email.Do not reply.",
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
                      
                      echo json_encode(array('status'=>true, 'message'=>'Insertion Successful'));die;
                    } else {
                        echo json_encode(array('status'=>false, 'errormessage'=>'Insertion Failed.'));die;
                    }
            }else if($_POST['institute_id'] != ""){
                $institute_id = $_POST['institute_id'];
                $where  = array('institute_id' => $institute_id);

                $status = $this->admin_model->updateData('institute',$where,$insert_data);
                if($status) {
                    $check_institute_menu = $this->admin_model->getById('menus',$where);
                    if(!empty($check_institute_menu))
                    {
                       $menu_data['updated_at'] = date('Y-m-d H:i:s');
                       $this->admin_model->updateData('menus',$where, $menu_data); 
                    } else{
                        // print_r($menu_data);exit;
                        $menu_data['institute_id'] = $institute_id;
                        $menu_data['created_at'] = date('Y-m-d H:i:s');
                        $this->admin_model->insertData('menus',$menu_data);
                    }
                    echo json_encode(array('status'=>true, 'message'=>'Updation Successful'));die;
                } else {
                    echo json_encode(array('status'=>false, 'errormessage'=>'Updation Failed.'));die;
                }

            }
    }


    public function getInstituteById(){
        if(isset($_POST) && !empty($_POST)){
            $institute_id  = $this->input->post("institute_id");
            $institute = $this->admin_model->getAllData('institute','institute_id',$institute_id);
            $menus = $this->admin_model->getAllData('menus','institute_id',$institute_id);
            $status = array_merge($institute,$menus);
            if($status) {
                echo json_encode($status);die;
            } else {
                echo json_encode('Failed');die;
            }
        }
    }


    public function deleteInstitute(){
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $institute_id = $deleteArr[$i];
                $userData = array(
                        "institute_status" => 9,
                    );
                $status = $this->admin_model->updateAllData(TBL_INSTITUTE,array('institute_id'=>$institute_id),$userData);
                }
                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }

    public function delete_announcment(){
        // is_institute_in();
        // print_r($_POST);
        if(isset($_POST) && !empty($_POST)){
            $deleteArr = $_POST['deleteArr'];
            for ($i=0; $i < count($deleteArr) ; $i++) { 
                $student_id = $deleteArr[$i];
                $userData = array(
                        "announcment_status" => 9
                    );
                $status = $this->admin_model->updateAllData(TBL_ANNOUNCEMENT,array('announcment_id'=>$student_id),$userData);
                }

                    echo json_encode(array('status'=>true, 'message'=>'Deletion Successful'));die;
            
        }
    }




    public function announcement(){
        // is_institute_in();
        $data['site_title'] = "ZEQON | Announcement";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('announcement');
        $this->load->view('dashboard-includes/footer');

    }


    public function add_aannouncment(){
        // is_institute_in();
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
                              'announcment_institute_id'  =>$institute_id
                              );
        if ($_POST['agent_id']=="" || $_POST['agent_id']==NULL) {
          # code...
         $checkLimit      = $this->admin_model->insertData(TBL_ANNOUNCEMENT,$insert_array);
         $last_id = $this->db->last_query();
          }else{
            $payment_id = $_POST['agent_id'];
            $where  = array('announcment_id' => $payment_id );
            $checkLimit = $this->admin_model->updateAllData(TBL_ANNOUNCEMENT,$where,$insert_array);
          }


                echo json_encode(array('status'=>true, 'message'=>'Announcment added Successfully'));die;
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

            if($this->session->userdata('is_super_in'))
            {
                $admin_id = $_SESSION['super_admin_id'];
                $status=$this->admin_model->changePasswordSuper($admin_id, $old_password);
                // echo $this->db->last_query();die;
                if($status){
                    $userData = array(
                        "super_admin_password" => md5($password),
                    );
                     $this->admin_model->updateAllData('super_admin',array('super_admin_id'=>$admin_id),$userData);
                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;
                }else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }

            if($this->session->userdata('is_admin_in'))
            {
                $admin_id = $_SESSION['admin_id'];
                $status=$this->admin_model->changePasswordAdmin($admin_id, $old_password);
                // echo $this->db->last_query();die;
                if($status){
                    $userData = array(
                        "password" => md5($password),
                    );
                     $this->admin_model->updateAllData('admin',array('id'=>$admin_id),$userData);
                    echo json_encode(array('status'=>true, 'message'=>'Password changed successfully.'));die;
                }else{
                    echo json_encode(array('status'=>false, 'errormessage'=>'Old password not match.'));die;
                }
            }

        }
    }

    public function viewInstitute()
    {
        // is_admin_in();
        $institute_id = $_GET['id'];
        $status = $this->admin_model->getAllData(TBL_INSTITUTE,'institute_id',$institute_id);
        $data['details'] = $this->admin_model->getAllData(TBL_INSTITUTE,'institute_id',$institute_id);
        $data['students'] = $this->admin_model->getAllData('students','institute_id',$institute_id);
        $data['agents'] = $this->admin_model->getAllData('agents','institute_id',$institute_id);
        $data['staffs'] = $this->admin_model->getAllData('staff','institute_id',$institute_id);
        $data['site_title'] = "ZEQON | Announcement";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('institute',$data);
        $this->load->view('dashboard-includes/footer');
        
    } 


    public function forgot_password()
    {
        $email = $_POST['email'];
        $where = array('email' => $email);   
        $assignments = $this->admin_model->getAllDataArray('admin',$where);
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
                        $update = $this->admin_model->updateAllData('admin',$where,$userData);
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

    public function get_package_info()
    {
        if($this->session->userdata('is_admin_in'))
        {
            $student_id = $_POST['student_id'];
            $package_info = $this->admin_model->getAllData('fees','student_id',$student_id);
            print_r(json_encode($package_info));
        }
    }

    public function update_package()
    {
        $student_id = $_POST['student_id'];
        $package = $_POST['current_package'];
        echo $student_id;
        $status = $this->admin_model->updatePackage($student_id,$package);
        if($status == true)
        {
            echo "Package Update Success";
        }
        else{
            echo "Package Update Failed !";
        }
    }

    public function update_yearly_fees()
    {
        $yr_id = $_POST['yr_id'];
        $student_id = $_POST['student_id'];
        $data = array(
            'yearly_fee' => $_POST['current_fee'],
        );

        $status = $this->admin_model->updateYearlyFees($yr_id,$student_id,$data);
        if($status)
        {
            echo "Update Success !";
        }
        else{
            echo "Update Failed !";
        } 
    }

    public function banner($institute_id)
    {
      $session = $this->session_check();
      if($session == true)
      {
        $data['site_title'] = "ZEQON | Banners";
        $where = array('institute_id'=>$institute_id);
        $data['banners'] = $this->admin_model->getAllData('banner','institute_id',$institute_id);
        $data['institute_id'] = $institute_id;  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('banner');
        $this->load->view('dashboard-includes/footer');
      }
    }

    public function save_banner()
    {
      $institute_id = $_POST['institute_id']; 
      $created_at  = date("Y-m-d H:i:s");
      $banner_type = $_POST['banner_type'];

      $data = array(
        'banner_type'=>$banner_type,
        'institute_id'=>$institute_id,
        'created_at'=>$created_at,
      );

       if(isset($_FILES['banner_img']) && $_FILES['banner_img']!="" && !empty($_FILES['banner_img']['name'])){
            $file_orignal_name = $_FILES['banner_img']['name'];
            $file_orignal_name = str_replace(' ', '-', $file_orignal_name);;
            // echo '<pre>'; print_r($file_orignal_name); echo '</pre>';
            $path = 'banner/';
            $image_name = time().uniqid().$file_orignal_name;
            $input_name = 'banner_img';
            $result = $this->admin_model->upload_image($path, $image_name, $input_name);
            if ($result) {
                $data['banner_img'] = $path.$image_name;
            }else{
                echo json_encode(array('status'=>false, 'errormessage'=>'Banner Photo Upload Failed'));die;
            }
        }

        if($this->admin_model->insertData('banner',$data))
        {
          echo json_encode(array('status'=>true, 'message'=>'Banner added Successfully !'));die;
        } else{
          echo json_encode(array('status'=>false, 'errormessage'=>'Failed to add banner !'));die;
        }

    }

    public function delete_banner()
    {
        $banner_id = $_POST['banner_id'];
        $institute_id = $_POST['institute_id'];
        $where = array('banner_id'=>$banner_id,'institute_id'=>$institute_id);
        $banner_details = $this->admin_model->getById('banner',$where);
        $path = $banner_details->banner_img;
        if($this->admin_model->deleteData('banner','banner_id',$banner_id))
        {
          if(file_exists('./uploads/'.$path))
          {
            unlink('./uploads/'.$path);
          }
          echo json_encode(array('status'=>true, 'message'=>'Banner Deleted Successfully !'));die;
        } else{
          echo json_encode(array('status'=>false, 'errormessage'=>'Failed to delete banner !'));die;
        }

    }

    public function demoRequests(){
        $session = $this->session_check();
        if($session == true)
        {
            $data['requests'] = $this->admin_model->get_all('demo_requests',false,'request_id');
            $data['site_title'] = "EduweGo+ | Dashboard";  
            $this->load->view('dashboard-includes/header', $data);
            $this->load->view('dashboard-includes/superAdmin-sidebar');
            $this->load->view('demo_requests');
            $this->load->view('dashboard-includes/footer'); 
        }
        
    }

    public function deleteRequest()
    {
        $req_id = $_POST['req_id'];
        if($this->admin_model->deleteData('demo_requests','request_id',$req_id))
        {
            echo json_encode(array('status'=>true, 'message'=>'Data deleted successfully !'));die;
        } else{
            echo json_encode(array('status'=>false, 'errormessage'=>'Failed to delete request !'));die;
        }

    }

    public function changeDemoStatus()
    {
        $req_id = $_POST['req_id'];
        $status = $_POST['status'];
        $where = array('request_id'=>$req_id);
        $data = array(
            'status'=>$status,
        );
        if($this->admin_model->updateAllData('demo_requests',$where,$data))
        {
            echo json_encode(array('status'=>true, 'message'=>'Status updated Successfully !'));die;
        } else{
            echo json_encode(array('status'=>false, 'errormessage'=>'Failed to update Status !'));die;
        }

    }

    public function viewRequestDetails($id)
    {
        $request_id = base64_decode($id);
        $data['details'] = $this->db->query("SELECT * FROM demo_requests WHERE request_id = '".$request_id."' ")->row();
        $data['site_title'] = "EduweGo+ | Dashboard";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('view_request');
        $this->load->view('dashboard-includes/footer'); 
    }

    public function changeInstPassword()
    {
       $new_pass = md5($_POST['new_pass']);
       $institute_id = $_POST['institute_id'];
       $q = $this->db->query("UPDATE institute SET institute_password = '".$new_pass."' WHERE institute_id = '".$institute_id."' ");
       if($q == true)
       {
         echo json_encode(array('status'=>true, 'message'=>'Password changed successfully !'));die;
       } else{
          echo json_encode(array('status'=>false, 'errormessage'=>'Failed to change password !'));die;
       }
    }

    public function job_post()
    {
        $data['jobs'] = $this->admin_model->get_all('job_posts',false,'job_id');
        $data['site_title'] = "EduweGo+ | Dashboard";  
        $this->load->view('dashboard-includes/header', $data);
        $this->load->view('dashboard-includes/superAdmin-sidebar');
        $this->load->view('job_post');
        $this->load->view('dashboard-includes/footer');
    }

    public function add_job_new()
    {
        $job_title = $this->input->post('title');
        $job_location = $this->input->post('location');
        $recruiter = $this->input->post('recruiter');
        $qualification = $this->input->post('qualification');
        $exp = $this->input->post('experience');
        $salary = $this->input->post('salary');
        $skills = $this->input->post('skills');
        $email = $this->input->post('company_email');
        $phone = $this->input->post('phone');
        $website = $this->input->post('website');
        $desc = $this->input->post('job_desc');

        $data = array(
            'job_title' => $job_title,
            'job_location' => $job_location,
            'recruiter' => $recruiter,
            'qualification' => $qualification,
            'experience'=> $exp,
            'skills' => $skills,
            'salary' => $salary,
            'company_email'=> $email,
            'company_phone' => $phone,
            'company_website' => $website,
            'job_desc' => $desc,
            'created_at'=>date('Y-m-d H:i:s')

        );

        if($this->admin_model->insertData('job_posts',$data))
        {
           echo json_encode(array('status'=>true,'message'=>'Job added Successfully !')); 
        }else{
            echo json_encode(array('status'=>false,'errormessage'=>'Failed to add job !'));
        }

    }

    public function delete_job()
    {
        $job_id = $_POST['job_id'];
        if($this->admin_model->deleteData('job_posts', 'job_id', $job_id))
        {
           echo json_encode(array('status'=>true,'message'=>'Job deleted Successfully !'));  
       }else{
          echo json_encode(array('status'=>false,'errormessage'=>'Failed to delete job !'));
       }
    }

}//end controller

?>