<?php 
class Orders_ajax extends CI_Controller {
	public function getSendMethods(){
		$this->load->model("general/Gorder_model");
		if($this->input->post() && $this->session->has_userdata("cart")){
			if($this->input->post("usedPlace")=="custom"){
				$country=$this->input->post("country");
			} else {
				$country=$this->Gorder_model->getCountryId($this->input->post("place"));
			}
			echo json_encode($this->Gorder_model->GetSendMethods($this->session->cart,$country));
		}
	}
	public function getSendCost(){
		if($this->input->post()){
			$this->load->model("general/Gorder_model");
			echo json_encode($this->Gorder_model->getSendCost($this->input->post("Id")));
		}
	}
}
