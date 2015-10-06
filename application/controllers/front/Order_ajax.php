<?php
	class Order_ajax extends CI_Controller {

	public function Order_user(){
			$this->load->model("general/Gorders_model");
			$error=null;

			$data = $this->Gorders_model->getOrderFromUsers($this->session->userId);
			echo json_encode($data);

		}
	}
?>