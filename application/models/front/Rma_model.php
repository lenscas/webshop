<?php
class Rma_model extends CI_Model {
	public function GetAllRma($userId){
		$this->db->select("*");
		$this->db->from("RMA");
		$this->db->join("status","status.Id = RMA.Status");
		$this->db->where("User_id",$userId);
		$query=$this->db->get();
		return $query->result_array();
	}

}
