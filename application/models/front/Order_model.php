<?php
class Order_model extends CI_Model {
	public function checkValidPostData($postData){
		$this->load->model("general/Gorder_model");
		$valid=false;
		if($postData['usedPlace']!= "custom"){
			$country=$this->Gorder_moddel->getCountryId($postData["usedPlace"]);
			if($country){
				$valid=true;
			}
		} else {
			$valid=$this->checkCountry($postData['country']);
			if(!$valid){
				return false;
			}
			foreach($postData['user'] as $key=>$value){
				if(! $value && $key != 'SecondName'){
					return false;
				}
			}
		}
		if(!$postData['SendMethodRule_id']){
			return false;
		}
		if(!$this->checkRealRule($postData['SendMethodRule_id'])){
			return false;
		}
		if(!$postData['paymentMethod']){
			return false;
		}
		return true;
	}
	public function checkRealRule($id){
		$this->db->select("count(*) as count");
		$this->db->from("SendMethodRules");
		$this->db->where("Id",$id);
		$query=$this->db->get();
		$result=$query->row_array();
		
		if($result['count']>0){
			return true;
		}
			return false;
	}
	public function checkCountry($id){
		$this->db->select("count(*) as count");
		$this->db->from("countries");
		$this->db->where("Id",$id);
		$query=$this->db->get();
		$result=$query->row_array();
		if ($result['count']>0){
			return true;
		}
		return false;
	}
}

