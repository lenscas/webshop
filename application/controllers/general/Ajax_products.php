<?php
class Ajax_products extends CI_Controller {
	public function getProducts($dataTables = false){
		$this->load->model("general/Gproducts_model");
		$data=$this->Gproducts_model->getProducts();
		if (!$dataTables) {
			echo json_encode($data);
		} else {
			$string='{"data":[';
			$first=true;
			foreach ($data as $key => $value) {
				if(!$first){
					$string=$string.'],';
					
				} else {
					$first=false;
				}
				$string=$string.'["<img src=\''.$value["Picpath"].'\'>",';
				$string=$string.'"'.$value['Name'].'",';
				$string=$string.'"'.$value['Sell_price'].'",';
				$string=$string.'"'.$value['stock'].'",';
				$string=$string.'"<a href=\''.base_url("index.php/admin/products/edit")."/".$value['Id'].'\' class=\'btn btn-primary\'><span class=\'fa fa-edit\'></span></a><a href=\''.base_url("index.php/admin/products/addstock")."/".$value['Id'].'\' class=\'btn btn-primary\'><span class=\'fa fa-truck\'></span></a><a href=\''.base_url("index.php/admin/categories/link/")."/".$value['Id'].'\' class=\'btn btn-primary\'><span class=\'fa fa-edit\'></span></a>"';
			}	
			$string=$string."]]}";

			echo $string;
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
