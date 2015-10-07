<?php
class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("front/Defaults");
		$data=$this->Defaults->headerData();
		$this->load->view("front/defaults/front-header.php",$data);
	}
	public function makeOrder(){
		$this->load->model("front/Cart_model");
		$this->load->model("front/Order_model");
		$this->load->model("general/Gproducts_model");
		$this->load->model("general/Gorder_model");
		$cart=$this->Cart_model->getCart();
		if(empty($cart)){
			redirect("home");
		}
		$orderData=array();
		$loadForm=true;
		$contentData=array();
		if($this->input->post()){
			$validPostData=$this->Order_model->checkValidPostData($this->input->post());
			if(! $validPostData){
				$contentData['error']="Er waren 1 of meer verplichte input velden niet correct ingevuld";
				echo $contentData['error'];
			} else{
				$loadForm=false;
				$this->Gorder_model->InsertOrder($this->input->post(),$cart);
			} 
		}
		if($loadForm){
			$times=0;
			foreach($cart as $key=>$value){
				$contentData['products'][$times]=$this->Gproducts_model->getProductData($key);
				$contentData['products'][$times]['want']=$value;
				$times++;
			}
			
			$this->load->view("front/orders/createOrder",$contentData);
		} else {
			$this->load->view("front/orders/orderMade",$orderData);
		}
		$this->load->view("front/defaults/front-footer.php");
	}
	
}
