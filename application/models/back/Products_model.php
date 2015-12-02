<?php 
class Products_model extends CI_Model {
	public function add($data){
		$this->db->insert("products",$data);
	}
	public function getTaxOptions(){
		$this->db->select("*");
		$this->db->from("tax");
		$query=$this->db->get();
		return $query->result_array();
	}


	public function editProduct($data,$productId){
		$this->db->where("products.Id",$productId);
		$this->db->update("products",$data);
	}

	public function updateStorage($data){
		$this->db->insert_batch("stock",$data);
	}


}
?>
