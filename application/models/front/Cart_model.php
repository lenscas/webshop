<?php
class cart_model extends CI_Model {
	public function addToCart($productId){
		$cart=$this->getCart();
		if(isset($cart[$productId])){
			$cart[$productId]++;
		}else {
			$cart[$productId]=1;
		}
		$this->session->set_userdata("cart",$cart);
		$this->session->updateCartDB($cart);
	}
	public function getCart(){
		if (! $this->session->has_userdata("cart")) {
			$oldCart=$this->getCartDb()
			$this->session->set_userdata("cart",array());
		}
		return $this->session->cart;
	}
	public function createCart(){
		
	}
	public function updateCartDB(){
		if($this->session->has_userdata("loggedIn")){
			$this->db->update()
		}
	}
	public function createCartId(){
		$this->load->helper('string');
		$this->db->select("count(*) AS count");
		$this->db->from("shoppingcart");
		$query=$this->db->get();
		$result=$query->row_array();
		return sha1($result."/".random_string("alpha",4)."/".time())
	}
	public function getCartDb(){
		if($this->session->has_userdata("userId")){
			$userId=$this->session->userId;
			//try and 
			$this->db
		}else{
			//no userId exist, user is not logged in
		}
	}
>
