<?php
ob_start();

if(!function_exists('is_superadmin_in')) {
	function is_superadmin_in() {
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_superadmin_in');
		if(!isset($is_logged_in) || $is_logged_in != true) {
		    redirect(base_url('admin-login'));
		}
	}
}

if(!function_exists('is_institute_in')) {
	function is_institute_in() {
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_institute_in');
		if(!isset($is_logged_in) || $is_logged_in != true) {
		    redirect(base_url());
		}
	}
}	

if(!function_exists('is_student_in')) {
	function is_student_in() {
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_student_in');
		if(!isset($is_logged_in) || $is_logged_in != true) {
		    redirect(base_url());
		}
	}
}

?>