<?php 
class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		$this->load->view("back/defaults/back-header.php",$headerData);
		$this->load->view("back/defaults/menu");
	}
	public function viewOrder(){
		
		$this->load->view("back/orders/show.php");
		$this->load->view("back/defaults/back-footer.php");
	}
}
?>
