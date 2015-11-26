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
		$this->load->model("front/Payment_model");
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
				$id=$this->Gorder_model->InsertOrder($this->input->post(),$cart,$this->session->userId);
				$this->Cart_model->deleteCart();
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
			$contentData=$this->Payment_model->getPaymentData($id);
			$this->load->view("front/orders/orderMade",$contentData);
		}
		$this->load->view("front/defaults/front-footer.php");
	}

	public function loadHistory(){
		if(! $this->session->has_userData("userId")){
			redirect("home");
		}
		$this->load->model("front/User_model");
		$error = null;
		if ($this->input->post()) {
			$error = $this->User_model->Login_user($this->input->post());
			if(!$error){
				redirect("home");
			}
		} 
		$this->load->view("front/orders/ajax/view");
		$this->load->view("front/defaults/front-footer.php");
	}
	public function payOrder(){
		$this->load->model("front/Payment_model");
		$legit= $this->Payment_model->validate($this->input->post());
		if($legit){
			$status=$this->Payment_model->payOrder($legit);
			$this->load->view("front/orders/success",array("status"=>$status));
		} else {
			$this->load->view("front/defaults/error");
		}
		$this->load->view("front/defaults/front-footer.php");
	}
	public function payExtra($transactionId){
		$this->load->model("front/Order_model");
		$this->load->model("front/Payment_model");
		$contentData=$this->Order_model->getOrderByTransId($transactionId);
		$contentData['paymentData']=$this->Payment_model->getPaymentData($contentData['orderData']['orderId']);
		print_r($contentData['paymentData']);
		$this->load->view("front/orders/payExtra",$contentData);
		$this->load->view("front/defaults/front-footer");
		
	}
	
}
