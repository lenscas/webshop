<?php 
class Gproducts_model extends CI_Model {
	public function getProducts(){
		$this->db->select("*,tax.Tax_Amount AS taxAmount ");
		$this->db->from("products");
		$this->db->join('tax', 'tax.Tax_Id = products.Tax_Id');
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
	public function getProductData($id){
		$this->db->select('*,tax.Tax_Amount AS taxAmount');
		$this->db->from("products");
		$this->db->where("Id",$id);
		$this->db->join('tax', 'tax.Tax_Id = products.Tax_Id');
		$query=$this->db->get();
		$result=$query->row_array();
		$result["stock"]=$this->getStock($id);
		return $result;
	}
	public function getProductWeigth($id){
		$this->db->select("Weight,Id");
		$this->db->from("products");
		$this->db->where("Id",$id);
		$query=$this->db->get();
		$result=$query->row_array();
		return $result['Weight'];
	}

}
?>
