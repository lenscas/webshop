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
				$string=$string.'["'.$name.'",';
				$string=$string.'"'.$value["Adress"]." ".$value["HomeNumber"].'",';
				$string=$string.'"'.$value["City"]." ".$value["Zipcode"].'",';
				$string=$string.'"'.$value['MailAdress'].'",';
				$string=$string.'"<a href=\''.base_url("index.php/adress/edit/".$value['placeId']).'\' class=\'btn btn-primary\'><span class=\'fa fa-edit\'></span></a><button id=\'delete'.$value['placeId'].'\' class=\'btn btn-danger delete\'><span class=\'fa fa-trash\'></span></button>"';
			}
			$string=$string."]]}";

			echo $string;
			

		}
	
	public function delete_Address($adressId){
		/*print_r($this->session->userdata());
		print_r($this->session->has_userdata("userId"));
		*/
		if($this->session->has_userdata("userId")){
			//echo $this->session->userId;
			$this->load->model("front/Adressbook_model");
			$adress=$this->Adressbook_model->getAdressById($adressId);
			if($adress['Users_Id']==$this->session->userId){
				$this->Adressbook_model->disable($adressId);
				echo json_encode(array("success"=>true));
				exit;
			}
		}
		echo json_encode(array("success"=>false));
	}
}
	
?>
