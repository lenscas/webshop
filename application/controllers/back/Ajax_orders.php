<?php 
class Ajax_orders extends CI_Controller {
	public function getAllOrders(){
		$this->load->model("back/Orders_model");
		$error=null;

		$data = $this->Orders_model->getAllOrders($this->session->userId);
		$string='{"data":[';
		$first=true;
		foreach ($data as $key => $value) {
			if(!$first){
				$string=$string.'],';
				
			} else {
				$first=false;
			}
			$string=$string.'["'.$value["orderId"].'",';
			$string=$string.'"'.$value['Firstname'].'",';
			$string=$string.'"'.$value['Date'].'",';
			$string=$string.'"<label class=\'label label-'.$value['Class'].'\'>'.$value['Name'].'</label>",';
			$string=$string.'"<a href=\''.base_url("index.php/admin/orders/edit")."/".$value["orderId"].'\' class=\'btn btn-primary\'><span class=\'fa fa-edit\'></span></a>"';
		}
		$string=$string."]]}";

		echo $string;
	}
}
?>
