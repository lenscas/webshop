<?php 
class RMAs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		$this->load->view("back/defaults/back-header.php",$headerData);
		$this->load->view("back/defaults/menu.php");
	}
	public function view(){
		$this->load->view("back/rma/view");
		$this->load->view("back/defaults/back-footer.php");
	}
	public function edit($rmaId){
		$this->load->model("back/Rma_model");
		$error=false;
		if($this->input->post()){
			$error=$this->Rma_model->update($rmaId,$this->input->post());
		}
		$contentData=array("error"=>$error);
		$contentData['RMAData']	=	$this->Rma_model->getRmaData($rmaId);
		$contentData['status']	=	$this->Rma_model->getRMAStatuses();
		$this->load->view("back/rma/edit",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}
}
