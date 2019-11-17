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

/*$route['admin'] = "Admin/AdminPanel/admin_index";
$route['dashboard'] = "Admin/AdminPanel/dashboard";
$route['sign_out'] = "Admin/AdminPanel/sign_out";
$route['signin'] = "Admin/AdminPanel/signin";
$route['admin_search'] = "Admin/AdminPanel/admin_search";*/

$route['admin-panel'] = 'Admin/AdminPanel/index';

////
$route['default_controller'] = "home";
$route['preview-info'] = 'web-registration/OnlineRegistrationController/preview_page';
$route['final-submit'] = 'web-registration/OnlineRegistrationController/final_submit';
$route['search'] = 'web-registration/OnlineRegistrationController/search';
$route['search-view'] = 'web-registration/OnlineRegistrationController/search_view';
$route['web-member-information-preview-data'] = 'web-registration/OnlineRegistrationController/memberInfoBack';
$route['web-member-information-preview'] = 'web-registration/OnlineRegistrationController/memberInfoBackImg';
$route['data-preview'] = 'web-registration/OnlineRegistrationController/upload_photo';
$route['data-submit'] = 'web-registration/OnlineRegistrationController/data_submit';
$route['kib'] = 'web-registration/OnlineRegistrationController/index';
$route['index'] = 'web-registration/OnlineRegistrationController/index';
$route['web-member-information'] = 'web-registration/OnlineRegistrationController/memberInfo';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




