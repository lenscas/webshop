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
$route['testHeader/admin'] = 'testheader/admin';
$route['testHeader/user'] = 'testheader/user';

//user 

	//login
		$route['login'] 	=	'front/User/login_User';
		$route['register']	=	'front/User/Register_User';
		$route['editUser']	=	"front/User/editUser";

	//looking at products
		$route['home']				=	'front/Products/index';
		$route['product/(:any)']	=	'front/Products/product/$1';
		$route['products/search']	=	'front/Products/search';

	//cart
		$route['cart/add/(:any)']	=	'front/Cart/add/$1';
		$route['cart/view']			=	'front/Cart/seeCart';
	//cart-ajax calls
		$route['cart/ajax/add/(:any)']	=	'front/Cart_ajax/add/$1';
		$route['cart/ajax/subtract/(:any)']	=	'front/Cart_ajax/subtract/$1';

//admin
	//viewing products
	
	//editing the products list
		$route['admin/products/add']="back/Products/addProduct";

//general ajax-calls
	//products
		$route['products/getProducts'] = 'general/Ajax_products/getProducts';
