<?php
class Adressbook_model extends CI_Model {
	public function getCountries(){
		$this->db->select("*");
		$this->db->from("countries");
		$query=$this->db->get();
		return $query->result_array();
	}
	public function insertAdress($data,$userId){
		foreach($data as $key=>$value){
			if(!$value && $key!="SecondName"){
				return "er waren 1 of meerdere velden niet ingevuld";
			}
		}
		
		$data['Users_Id']=$userId;
		$this->db->insert("deliveraddress",$data);
	}
	public function getUsersAdresses($userId){
		$this->db->select("*, deliveraddress.Id as placeId,countries.Name as LandName");
		$this->db->from("deliveraddress");
		$this->db->where("Users_Id",$userId);
		$this->db->join("countries","countries.Id=deliveraddress.Land_Id");
		$query=$this->db->get();
		return $query->result_array();
	}
}
