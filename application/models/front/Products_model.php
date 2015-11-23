<?php
class Products_model extends CI_Model {
	public function getProductsOfCategory($table,$id){
		$this->load->model("general/Gproducts_model");
		
		$this->db->select('*,tax.Tax_Amount AS taxAmount');
		$this->db->from("products");
		$this->db->join('tax', 'tax.Tax_Id = products.Tax_Id');
		$this->db->join("catlink","catlink.Product_Id = products.Id");
		$this->db->where("catlink.".$table,$id);
		$query=$this->db->get();
		$result=$query->result_array();
		foreach($result as $key =>$value){
			$result[$key]["stock"]=$this->Gproducts_model->getStock($value["Id"]);
		}
		return $result;
	}

}
