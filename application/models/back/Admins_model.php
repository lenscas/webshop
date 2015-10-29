<?php
class Admins_model extends CI_Model {
	public function getDashboardData(){
	$contentData=array();
	//first get the amount of orders
	$this->db->select("count(*) as count");
	$this->db->from("orders");
	$this->db->where("Date >=",date('Y-m-d H:i:s', strtotime('-24 hours')));
	$query=$this->db->get();
	$result=$query->row_array();
	$contentData['newOrders']=$result['count'];
	return $contentData;
	
	}

}
