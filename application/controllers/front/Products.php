<?php
class Products extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("front/Defaults");
		$data=$this->Defaults->headerData();
		$this->load->view("front/defaults/front-header.php",$data);
	}
	public function index(){
		$this->load->view("front/products/index.php");
		$this->load->view("front/defaults/front-footer.php");	
	}

}
?>
