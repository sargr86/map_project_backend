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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['check_price'] = 'price_page/price_page';

$route['forgot_password'] = 'user/forgot_password';
$route['dashboard'] = 'dashboard/dashboard/';

$route['admin_login'] = 'admin/admin/login';

$route['addTours'] = 'admin/Tours/add_tours';
$route['allTours'] = 'admin/Tours/get_tour';
$route['removeTour'] = 'admin/Tours/remove_tour';
$route['updateTour'] = 'admin/Tours/update_tour';
$route['getOneTour'] = 'admin/Tours/get_one_tour';

$route['addTourType'] = 'admin/Tours/add_tour_type';
$route['allTourType'] = 'admin/Tours/get_tour_type';

$route['insert_ferry'] = 'Ferry/insert_ferry';
$route['all_ferry'] = 'Ferry/get_all_ferry';

$route['addPartner'] = 'admin/Partners/add_partner';
$route['allPartner'] = 'admin/Partners/get_partners';
$route['checkPartner'] = 'admin/Partners/partner_login';

$route['addFoodDrink'] = 'admin/FoodDrink/add_food_drink';
$route['login'] = 'admin/Partners/login';
$route['registration'] = 'admin/Partners/registration';
$route['home'] = 'admin/Partners/home';
$route['add_comment'] = 'admin/Partners/add_comment';
$route['comment'] = 'admin/Partners/comment';
$route['lastet'] = 'admin/Partners/lastet';
$route['single/(:any)'] = 'admin/Partners/single/$1';

$route['removeFerry'] = 'Ferry/remove_ferry';
$route['updateFerry'] = 'Ferry/update_ferry';
$route['getOneFerry'] = 'Ferry/get_one_ferry';

$route['saveDrawing'] = 'admin/GPS_Location_Drawing/add_drawing';
