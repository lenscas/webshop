<?php
Class Gusers_model extends CI_Model {
	public function Register($data, $sort){
		foreach ($data as $key => $value) {
				if ($value == "") {
					$error = "Niet alle velden zijn ingevuld!";
				break;
				}
			}

		if (!isset($error) && $data['Password'] != $data['PasswordCheck'] ) {
				$error = "Wachtwoorden komen niet overeen.";
		}	

		if (isset($error)) {
			return $error;
		}

		unset($data['PasswordCheck']);

		if ($sort == 'users') {
			$data['Id']=$this->GenId();
		}

		$this->db->insert($sort, $data);
	}

	public function GenId(){
		$this->load->helper('string');
		$this->db->select('count(*) as counter');
		$this->db->from('users');
		$query = $this->db->get();
		$result = $query->row_array();
		return sha1($result['counter']."/".random_string("alpha", 4)."/".time());
	}
	public function getAllUserData($userId){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("Id",$userId);
		$this->db->limit("1");
		$query=$this->db->get();
		return $query->row_array();
	}
	public function 
	
}
?>
