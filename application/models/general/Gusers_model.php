<?php
Class Gusers_model extends CI_Model {
	public function Register($data, $sort){
		foreach ($data as $key => $value) {
				if ($value == null) {
					$error = "Er is een veld niet ingevuld!";
				break;
				}
			}

		if (isset($error)) {
			return $error;
		}

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

	
}
?>