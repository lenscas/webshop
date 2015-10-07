<<<<<<< HEAD
<?php 
class Order_model extends CI_Model {
	public function Login_user($login_data){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("Username",$login_data["Username"]);
		$this->db->limit("1");
		$query=$this->db->get();
		$result=$query->row_array();

		$this->load->library('encryption');

		if (isset($result['Password'])) {
			$decryptedPassword=$this->encryption->decrypt($result['Password']);
			if($decryptedPassword==$login_data['Password']){
				$this->session->set_userdata("userId",$result['Id']);
			}
		}
		if(! $this->session->has_userdata('userId')){
			return "De gebruikersnaam of het wachtwoord is onjuist.";
		}
	}


}
=======
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

>>>>>>> orders
