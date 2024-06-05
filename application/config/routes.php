<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'institute/enquiryNew';
// $route['default_controller'] = 'institute/enquiryNew';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route["dashboard"]    		  	= 'institute/dashboard';
$route["agent"]    		  	   	= 'institute/agent';
$route["subagent"]    		  	= 'institute/subagent';
$route["courses"]    		  	= 'institute/courses';
$route["stream"]    		  	= 'institute/stream';
$route["student"]    		  	= 'institute/student';
$route["cheque"]    		  	= 'institute/cheque';
$route["staff"]    		  	   	= 'institute/staff';
$route["payments/(:any)"]    	= 'institute/payments/$1';
$route["convertStudent/(:any)"] = 'institute/convertStudent/$1';
$route["get_view/(:any)"]    	= 'institute/get_view/$1';
$route["edit_online_enquiry/(:any)"]   = 'institute/edit_online_enquiry/$1';
$route["online_enqury_page_view/(:any)"]   = 'institute/online_enqury_page_view/$1';
$route["smspayment"]    		= 'institute/smspayment';
$route["enquiry"]    		   	= 'institute/enquiry';
$route["online-admission/(:any)"]  = 'institute/enquiryNew';
$route["profile"]    		   	= 'institute/profile';
$route["support"]    		   	= 'institute/support';
$route["vendor"]    		   	= 'institute/vendor';
$route["login"]   	 		   	= 'institute/login';
$route["employee-login"]   	 	= 'institute/staff_login_view';
$route["student-enquiry/(:any)"]	= 'institute/signupForm';
$route["signup"]	= 'institute/demoForm';
$route["webhooks"]	= 'institute/webhooks';

$route["institute_list"]        = 'admin/institute_list';
$route["add_institute_new"]     = 'admin/add_institute_new';
$route["permission_section"]    = 'admin/permission_section';
$route["student-login"]    		= 'student/login_view';
$route["associate"]    			= 'associate/associate_login';

$route["super-login"]    		= 'admin/superLogin_view';