<?php 
class Gproducts_model extends CI_Model {
	public function getProducts(){
		$this->db->select("*");
		$this->db->from("products");
		$query=$this->db->get();
		return $query->results_array();
	}

}
?>
