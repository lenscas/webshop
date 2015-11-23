<?php
class Ajax_products extends CI_Controller {
	public function getProducts($orderId = false){
		$this->load->model("general/Gproducts_model");

		if (!$orderId) {
			echo json_encode($this->Gproducts_model->getProducts());
		} else {
			
		}
	}
	public function autocompleteProducts(){
		$this->load->model("general/Gproducts_model");
		$resluts=$this->Gproducts_model->search($this->input->get_post("term"));
		$first=true;		
		echo "[";
		foreach($resluts as $key=>$value){
			if($first){
				$first=false;
			}else {
				echo ",";
			}
			echo '{"value":"'.$value['Name'].'","label":"'. $value['Name'].'","id":"'.$value["Id"].'"}';
		}
		echo "]";
	}
	public function getProductById($id){
		$this->load->model("general/Gproducts_model");
		echo json_encode($this->Gproducts_model->getProductData($id));
	}
}
