<?php
class Rma extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(! $this->session->has_userdata("userId")){
			redirect("home");
		}
		$this->load->model("front/Defaults");
		$data=$this->Defaults->headerData();
		$this->load->view("front/defaults/front-header.php",$data);
	}
	public function viewAllRma(){
		$this->load->model("front/Rma_model");
		$contentData['RMA']=$this->Rma_model->GetAllRma($this->session->userId);
		$this->load->view("front/RMA/history",$contentData);
		$this->load->view("front/defaults/front-footer.php");
	
	}
	public function createRMA($id){
		$this->load->model("general/Grma_model");
		$this->load->model("general/Gorder_model");
		
		$createError=false;
		$error=false;
		$order=$this->Gorder_model->getOrderById($id);
		if(!$order){
			$error="Order bestaat niet.";
		} elseif($order['Users_Id']!=$this->session->userId) {
			$error="Dit order hoort niet bij dit account.";
		}
		if($this->input->post() && ! $error){
			$createError=$this->Grma_model->createRMA($id,$this->session->userId,$this->input->post());
		}
			
		if($error){
			$this->load->view("front/RMA/error",array('error'=>$error));
		} else {
			$this->load->view("front/RMA/create",array('error'=>$createError));
		}
		$this->load->view("front/defaults/front-footer.php");
	}
}
