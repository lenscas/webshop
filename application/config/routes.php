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
|	http://codeigniter.com/user_guide/general/routing.html
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
//default stuff
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//tests
$route['testHeader/admin']	=	'testheader/admin';
$route['testHeader/user']	=	'testheader/user';

//user 

	//login
		$route['login']		=	'front/User/login_User';
		$route['register']	=	'front/User/Register_User';
		$route['editUser']	=	'front/User/editUser';
		$route['logout']	=	'front/User/logout';

	//looking at products
		$route['home']				=	'front/Products/index';
		$route['product/(:any)']	=	'front/Products/product/$1';
		$route['products/search']	=	'front/Products/search';

	//cart
		$route['cart/add/(:any)']	=	'front/Cart/add/$1';
		$route['cart/view']			=	'front/Cart/seeCart';
	//cart-ajax calls
		$route['cart/ajax/add/(:any)']		=	'front/Cart_ajax/add/$1';
		$route['cart/ajax/subtract/(:any)']	=	'front/Cart_ajax/subtract/$1';
		$route['cart/ajax/delete/(:any)']	=	'front/Cart_ajax/delete/$1';
	//orders
		$route['makeOrder']			=	'front/Orders/makeOrder';
		$route['order/ajax/view']	=	'front/Order/loadHistory' ;
	//orders ajax
		$route['ajax/getShipmentOption']	=	"front/Orders_ajax/getSendMethods";
		$route['ajax/getShipmentCosts']		=	"front/Orders_ajax/getSendCost";
		$route['order'] 					=	'front/Order_ajax/Order_user';
	//RMA
		$route['RMA/history']		=	'front/Rma/viewAllRma';
		$route['RMA/create/(:any)']	=	'front/Rma/createRMA/$1';
//admin
	//login 
		$route['admin/login']	=	"back/Admins/logIn";
	//home
		$route['admin/home']	=	"back/Admins/dashboard";
	//viewing products
	
	//editing the products list
		$route['admin/products/add']	=	"back/Products/addProduct";
	//inserting categories
		$route['admin/categories/add']	=	"back/Categories/insertCategory";

//general ajax-calls
	//products
		$route['products/getProducts']	=	'general/Ajax_products/getProducts';
