<?php
class Cart_ajax extends CI_Controller {
	public function add($id){
		$this->load->model("front/Cart_model");
		$this->Cart_model->addToCart($id);
	}
	public function subtract($id){
		$this->load->model("front/Cart_model");
		$this->Cart_model->subtractFromCart($id);
	}
	public function delete($id){
		$this->load->model("front/Cart_model");
		$this->Cart_model->deleteFromCart($id);
	}




}
?>
