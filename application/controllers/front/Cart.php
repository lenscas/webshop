<?php
class Cart extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("front/Defaults");
		$data=$this->Defaults->headerData();
		$this->load->view("front/defaults/front-header.php",$data);
	}
	
	public function add($id){
		$this->load->model("front/Cart_model");
		$this->Cart_model->addToCart($id);
		
	}
	public function seeCart(){
		$this->load->model("front/Cart_model");
		$this->load->model("general/Gproducts_model");
		$cart=$this->Cart_model->getCart();
		$contentData=array();
		foreach($cart as $key=>$value){
			$contentData['products'][]= $this->Gproducts_model->getProductData($key);
		}
		$this->load->view("front/cart/view",$contentData);
	
	}
}




?>
