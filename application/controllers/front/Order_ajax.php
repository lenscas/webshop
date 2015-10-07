<?php
	class Order_ajax extends CI_Controller {

	public function Order_user(){
			$this->load->model("general/Gorders_model");
			$error=null;

			$data = $this->Gorders_model->getOrderFromUsers($this->session->userId);
			
			$string='{"data":[';
			$first=true;
			foreach ($data as $key => $value) {
				if(!$first){
					$string=$string.'],';
					
				} else {
					$first=false;
				}
				$string=$string.'["'.$value["Id"].'",';
				$string=$string.'"'.$value['Date'].'",';
				$string=$string.'"'.$value['Status'].'",';
				$string=$string.'"'.$value['TotalPrice'].'"';
			}
			$string=$string."]]}";

			echo $string;

			

		}
	}
?>