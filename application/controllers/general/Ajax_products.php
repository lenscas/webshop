<?php
class Ajax_products extends CI_Controller {
	public function getProducts($orderId = false){
		$this->load->model("general/Gproducts_model");

		if (!$orderId) {
			echo json_encode($this->Gproducts_model->getProducts());
		} else {
			
		}
		
		
	}
}
