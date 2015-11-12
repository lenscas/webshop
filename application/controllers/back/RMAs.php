<?php 
class RMAs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		$this->load->view("back/defaults/back-header.php",$headerData);
	}
	public function view(){
		$this->load->view("back/rma/view");
		$this->load->view("back/defaults/back-footer.php");
	}
}
