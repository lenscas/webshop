<?php 
class Gproducts_model extends CI_Model {
	public function getProducts(){
		$this->db->select("*");
		$this->db->from("products");
		$query=$this->db->get();
		$result=$query->result_array();
		foreach($result as $key =>$value){
			$result[$key]["stock"]=$this->getStock($value["Id"]);
		}
		return $result;
	}
	public function getStock($id){
		$this->db->select("count(*) as stock");
		$this->db->from("stock");
		$this->db->where("id",$id);
		$query=$this->db->get();
		
		return $query->row()->stock;
	}
	public function search($data){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->like('Name', $data);
		$this->db->or_like('Description', $data);
		$query=$this->db->get();
		$result=$query->result_array();
		foreach($result as $key =>$value){
			$result[$key]["stock"]=$this->getStock($value["Id"]);
		}
		return $result;
	}

}
?>
