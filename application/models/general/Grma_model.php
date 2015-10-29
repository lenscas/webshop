<?php
class Grma_model extends CI_Model {
	public function createRMA($orderId,$userId,$data){
		if(!$data['reason']){
			return "Er moet een reden voor de RMA worden ingevuld.";
		}
		$this->db->insert("RMA",array("reason"=>$data['reason'],"status"=>10,"Order_Id"=>$orderId,"User_Id"=>$userId));
		return false;
	}
	
}
