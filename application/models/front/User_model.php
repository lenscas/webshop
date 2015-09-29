<?php 
class User_model extends CI_Model {
	public function Login_user($login_data){
		$result=$this->GetUserData($login_data["Username"]);
		/*$this->db->select("*");
		$this->db->from("users");
		$this->db->where("Username",$login_data["Username"]);
		$this->db->limit("1");
		$query=$this->db->get();
		$result=$query->row_array();*/

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

	public function GetUserData($Username, $Email=null){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("Username",$Username);
		if ($Email) {
			$this->db->or_where("Email", $Email);
		}
		$this->db->limit("1");
		$query=$this->db->get();
		return $query->row_array();
	}


}
