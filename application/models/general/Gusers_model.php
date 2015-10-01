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
		$birthdata=$this->getDate($data['Birthdate']);
		if($birthdata['correct']){
			$data['Birthdate']=$birthdata['date'];
		} else {
			$error="Er is geen geldige geboortedatum ingevuld";
		}
		if (isset($error)) {
			return $error;
		}

		unset($data['PasswordCheck']);

		if ($sort == 'users') {
			$data['Id']=$this->GenId();
		}
		
		//encrypt password for registration
		$this->load->library('encryption');
		$data['Password']=$this->encryption->encrypt($data['Password']);

		//insert in database
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
	public function editUser($data,$userId){
		$updatePassword=false;
		//check if the password needs to be set
		if($data['Password'] && $data['PasswordCheck']){
			if($data['Password']==$data["PasswordCheck"]){
				$updatePassword=true;
				$error="Wachtwoord velden zijn niet hetzelfde";
			}
		}
		if(! $updatePassword){
			unset($data['Password']);
		}
		unset($data["PasswordCheck"]);
		//check if the date is valid
		$birthdata=$this->getDate($data["Birthdate"]);
		if($birthdata['correct']){
			$data['Birthdate']=$birthdata['date'];
		}else {
			unset($data['Birthdate']);
		}
		//unset all emtpy values
		foreach($data as $key => $value){
			if($value==""){
				unset($data[$key]);
			}
		}

		//encrypt password for edit profile
		$this->load->library('encryption');
		$data['Password']=$this->encryption->encrypt($data['Password']);

		//update the database
		$this->db->where("Id",$userId);
		$this->db->update("users",$data);
	}
	public function getDate($dateString){
		$data=explode ( "/", $dateString );
		//0=the month,1=the day,2 = the year 
		$correct=false;
		if(count($data)==3){
			$correct=checkdate ( $data[0] , $data[1] , $data[2] );
		}
		if($correct){
			return array("correct"=>true,"date"=>$data[2].'-'.$data[0].'-'.$data[1]);
		}
		
	}

	public function logout($sort){

		//$this->load->view('front/users/logout_form');
		$this->session->sess_destroy('userId');
		$this->output->set_header('refresh:3;url=login');
		//$this->load->view('front/defaults/front-footer.php');
	}
	
}
?>
