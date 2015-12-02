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
	//user account
		//acount
			$route['login']			=	'front/User/login_User';
			$route['register']		=	'front/User/Register_User';
			$route['editUser']		=	'front/User/editUser';
			$route['logout']		=	'front/User/logout';
		//profile
			$route['user/profile']	=	"front/User/showProfile";
	//looking at products
		$route['home']						=	'front/Products/index';
		$route['product/(:any)']			=	'front/Products/product/$1';
		$route['products/search']			=	'front/Products/search';
		$route["categories/(:any)/(:any)"]	=	"front/Products/ofCategory/$1/$2";
	//cart
		$route['cart/add/(:any)']	=	'front/Cart/add/$1';
		$route['cart/view']			=	'front/Cart/seeCart';
	//cart-ajax calls
		$route['cart/ajax/add/(:any)']				=	'front/Cart_ajax/add/$1';
		$route['cart/ajax/subtract/(:any)']			=	'front/Cart_ajax/subtract/$1';
		$route['cart/ajax/delete/(:any)']			=	'front/Cart_ajax/delete/$1';
		$route['cart/ajax/update/(:any)/(:any)']	=	'front/Cart_ajax/update/$1/$2';
	//add adress
		$route['adress/add']	=	'front/Adressbook/add';
	//orders
		$route['makeOrder']			=	'front/Orders/makeOrder';
		$route['order/ajax/view']	=	'front/Order/loadHistory' ;
		//payment
			$route['orders/success']	=	'front/Orders/payOrder';
		//payment after edit
			$route['orders/payExtra/(:any)']	=	"front/Orders/payExtra/$1";
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
	//products
		//viewing
			$route["admin/products/view"]			=	"back/Products/viewProducts";
		//editing the products list
			$route['admin/products/add']			=	"back/Products/addProduct";
			$route['admin/products/edit/(:any)']	=	"back/Products/editProduct/$1";
	//categories
		//inserting categories
			$route['admin/categories/add']	=	"back/Categories/insertCategory";
		//disable/enable the categories
			$route['admin/categories/disable']	=	"back/Categories/showCategoriesForDelete";
			$route['admin/categories/ajax/delete/(:any)/(:any)'] = "back/CategoriesAjax/disable/$1/$2";
		//linking products and categories 
			$route["admin/categories/link/(:any)"]								=	"back/Categories/showCategoriesForLink/$1";
			$route["admin/categories/ajax/link/update/(:any)/(:any)/(:any)"]	=	"back/CategoriesAjax/switchLink/$1/$2/$3";
	//orders
		//viewing Orders
			$route['admin/orders/view']				=	"back/Orders/viewOrder";
			$route['admin/orders/ajax/getorders']	=	"back/Ajax_orders/GetAllOrders";
		//edit Orders
			$route['admin/orders/edit/(:any)']		=	"back/Orders/editOrder/$1";
	//RMA's
		//viewing rma's
		$route["admin/rma/view"]		=	"back/RMAs/view";
		$route['admin/rma/ajax/getrma']	=	"back/RMA_ajax/getAllRMA";
		//edit rma 
		$route["admin/rma/edit/(:any)"]	=	"back/RMAs/edit/$1";
		
//general ajax-calls
	//products
		$route['products/getProducts']			=	'general/Ajax_products/getProducts';
		$route['products/getProducts/dataTable']=	'general/Ajax_products/getProducts/true';
		$route['products/getProduct/(:any)']	=	"general/Ajax_products/getProductById/$1";
	//autocomplete products
		$route['products/autocomplete']	=	"general/Ajax_products/autocompleteProducts";

