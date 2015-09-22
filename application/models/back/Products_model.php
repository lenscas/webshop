<?php 
class Products_model extends CI_Model {
	public function add($data){
		$this->db->insert("Products",$data);
	}
}
?>