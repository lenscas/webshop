<?php
class Rma_model extends CI_Model {
	public function getAllRMA(){
		$this->db->select("*");
		$this->db->from("RMA");
		$this->db->join("status","status.Id=RMA.status");
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getRMAData($rmaId){
		$this->db->select("*");
		$this->db->from("RMA");
		$this->db->join("status","status.Id=RMA.status");
		$this->db->where("RMA.Id",$rmaId);
		$query=$this->db->get();
		return $query->row_array();
	}
	public function update($rmaId,$data){
		$this->db->where("RMA.Id",$rmaId);
		$this->db->update("RMA",$data);
	}
	public function getRMAStatuses(){
		$this->db->select("*");
		$this->db->from("statusLink");
		$this->db->join("status","status.id=statusLink.StatusId");
		$this->db->where("statusLink.TableName","RMA");
		$query=$this->db->get();
		return $query->result_array();
	}
}
