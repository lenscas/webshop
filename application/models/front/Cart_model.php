<?php
class cart_model extends CI_Model {
	public function addToCart($productId){
		//get the array with the products that are currently in the cart
		$cart=$this->getCart();
		//look if the product is already in the cart, if it is increase the amount by 1 else add it and said the amount to 1
		$this->load->model("general/Gproducts_model");
		$data=$this->Gproducts_model->getProductData($productId);
		if(isset($data['Id'])){
			if(isset($cart[$productId])){
				$cart[$productId]++;
			}else {
				$cart[$productId]=1;
			}
		}
		//update the session
		$this->session->set_userdata("cart",$cart);
		//update the Database
		$this->updateCartDB($cart);
	}
	public function subtractFromCart($productId){
		//get the array with the products that are currently in the cart
		$cart=$this->getCart();
		//look if the product is already in the cart, if it is increase the amount by 1 else add it and said the amount to 1
		$this->load->model("general/Gproducts_model");
		$data=$this->Gproducts_model->getProductData($productId);
		if(isset($data['Id'])){
			if(isset($cart[$productId])){
				if($cart[$productId]>2){
					$cart[$productId]=$cart[$productId]-1;
				} else {
					unset($cart[$productId]);
				}
			}
		}
		//update the session
		$this->session->set_userdata("cart",$cart);
		//update the Database
		$this->updateCartDB($cart);
	}
	public function deleteFromCart($productId){
		//get the array with the products that are currently in the cart
		$cart = $this->getCart();
		//sets the amount on 0, product will stay in cart untill refresh website.
		unset($cart[$productId]);

		//update the session
		$this->session->set_userdata("cart",$cart);
		//update the Database
		$this->updateCartDB($cart);

	}
	public function getCart(){
		//check if the session contains data for the cart if it has then return it, else look in the Database to see if there is an old one
		if (! $this->session->has_userdata("cart")) {
			$oldCart=$this->getCartDb();
			$this->session->set_userdata("cart",$oldCart);
		}
		return $this->session->cart;
	}
	public function updateCartDB(){
		/*
		if($this->session->has_userdata("loggedIn")){
			$this->db->update();
		}*/
	}
	public function createCartId(){
		$this->load->helper('string');
		$this->db->select("count(*) AS count");
		$this->db->from("shoppingcart");
		$query=$this->db->get();
		$result=$query->row_array();
		return sha1($result."/".random_string("alpha",4)."/".time());
	}
	public function getCartDb(){
		//get the user Id
		$cart=array();
		/*if($this->session->has_userdata("userId")){
			$userId=$this->session->userId;
			//try to get the cart out of the database
			$this->db->select("*");
			$this->db->from("shoppingcart");
			$this->db->where("User_Id",$userId);
			$this->db->order_by("date","asc");
			$this->db->limit(1);
			$query=$this->db->get();
			$result=$query->row_array();
			if (isset($result["CartItems_Id"])){
				
				$this->db->select("*");
				$this->db->from("cartitems");
				$this->db->where("ShoppingCart_Id",$result["CartItems_Id"]);
				$query=$this->db->get();
				$cart=$query->row_array();
			}
			
		}*/
		return $cart;
	}
}
?>
