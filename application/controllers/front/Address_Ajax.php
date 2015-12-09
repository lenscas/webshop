<?php
	class Address_Ajax extends CI_Controller {

	public function Address_user(){
		$this->load->model("front/Adressbook_model");
		$error=null;
		$data = $this->Adressbook_model->getUsersAdresses($this->session->userId);

		$string='{"data":[';
			$first=true;
			foreach ($data as $key => $value) {
				if(!$first){
					$string=$string.'],';
					
				} else {
					$first=false;
				}
				if($value["SecondName"]){
					$name=$value["Firstname"]." ".$value["SecondName"]." ".$value["LastName"];
				} else{
					$name=$value["Firstname"]." ".$value["LastName"];
				}
				$string=$string.'["'.$name.'"],';
				$string=$string.'["'.$value["Adress"]." ".$value["HomeNumber"].'",';
				$string=$string.'["'.$value["City"]." ".$value["Zipcode"].'",';
				$string=$string.'"'.$value['MailAddress'].'",';
			}
			$string=$string."]]}";

			echo $string;
			

		}
	}

	
?>