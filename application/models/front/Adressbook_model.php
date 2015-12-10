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
		$this->db->where("deliveraddress.active",1);
		$this->db->join("countries","countries.Id=deliveraddress.Land_Id");
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getAdressById($adressId){
		$this->db->select("*, deliveraddress.Id as placeId,countries.Name as LandName");
		$this->db->from("deliveraddress");
		$this->db->where("deliveraddress.Id",$adressId);
		$this->db->join("countries","countries.Id=deliveraddress.Land_Id");
		$query=$this->db->get();
		return $query->row_array();
	}
	public function disable($adressId){
		$this->db->where("Id",$adressId);
		$this->db->update("deliveraddress",array("active"=>"0"));
	}
	
	public function getAdress($id){
		$this->db->select("*, deliveraddress.Id as placeId,countries.Name as LandName");
		$this->db->from("deliveraddress");
		$this->db->where("deliveraddress.Id",$id);
		$this->db->join("countries","countries.Id=deliveraddress.Land_Id");
		$query=$this->db->get();
		$result=$query->row_array();
		//echo $this->db->last_query();
		return $result; 
	}
	
	
	public function editAddress($data,$id){
		foreach($data as $key=>$value){
			if(!$value && $key!="SecondName"){
				return "er waren 1 of meerdere velden niet ingevuld";
			}
		}
		//update the database
		$this->disable($id);
		$this->db->insert("deliveraddress",$data);
		return $this->db->insert_id();
		//$this->db->where("deliveraddress.Id",$id);
		//$this->db->update("deliveraddress",$data);
	}

}
