<?php 
class RMA_ajax extends CI_Controller {
	public function getAllRMA(){
		$this->load->model("back/Rma_model");
		$RMAs=$this->Rma_model->getAllRMA();
		$string='{"data":[';
			$first=true;
			foreach ($RMAs as $key => $value) {
				if(!$first){
					$string=$string.'],';
					
				} else {
					$first=false;
				}
				$string=$string.'["'.$value["Order_Id"].'",';
				$string=$string.'"'.$value['Date'].'",';
				$string=$string.'"<label class=\'label label-'.$value['Class'].'\'>'.$value['Name'].'</label>",';
				$string=$string.'"'.'"';
			}
			$string=$string."]]}";

			echo $string;
	}
}
