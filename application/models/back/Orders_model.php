<?php
class Orders_model extends CI_Model {
	public function getAllOrders(){
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->join("deliveraddress","deliveraddress.Id=orders.DeliverAddress_Id");
		$this->db->join("status","status.Id=orders.status");
		$query=$this->db->get();
		return $query->result_array();
	}


}
