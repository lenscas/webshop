<?php
class Rma_model extends CI_Model {
	public function getAllRMA(){
		$this->db->select("*");
		$this->db->from("RMA");
		$this->db->join("status","status.Id=RMA.status");
		$query=$this->db->get();
		return $query->result_array();
	}
}
