<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome/index";
//$route['home'] = "welcome";
$route['404_override'] = '';
$route['university/articles/(:any)'] = 'university/articles/$1';
$route['university/(:any)'] = 'university/index/$1';
$route['admin'] = 'admin/login';
$route['register'] = 'user/register';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['dashboard'] = 'userboard/index';
$route['dashboard/events'] = 'userboard/events';
$route['dashboard/classified'] = 'userboard/classified';
$route['dashboard/threads'] = 'userboard/threads';
$route['dashboard/(\d+)'] = 'userboard/index/$1';
$route['classified/(\d+)'] = 'classified/index/$1';
$route['password-recovery'] = 'user/recover_password';
$route['profile'] = 'user/profile';
$route['feedback'] = 'feedback/index';
$route['articles'] = 'articles/index';
$route['articles/(\d+)'] = 'articles/view';
$route['write-to-editor'] = 'feedback/editor';
$route['advertise-here'] = 'contactus/advertise';
$route['contact-us'] = 'contactus/index';



/* End of file routes.php */
/* Location: ./application/config/routes.php */