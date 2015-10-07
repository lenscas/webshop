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
