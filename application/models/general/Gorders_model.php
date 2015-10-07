<?php
Class Gorders_model extends CI_Model {
	public function getOrderFromUsers($userId){
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->join('DeliverAddress', 'DeliverAddress.Id = Orders.DeliverAddress_Id');
		$this->db->where('DeliverAddress.Users_Id', $userId);
		//$this->db->where("userId",$userId);
		$query=$this->db->get();	
		return $result = $query->result_array();
	}

	

}
?>