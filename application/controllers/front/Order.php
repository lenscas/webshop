<?php
	class Order extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model("front/Defaults");
			$data=$this->Defaults->headerData();
			$this->load->view("front/defaults/front-header.php",$data);
		}

		public function loadHistory(){
			$this->load->model("front/Order");
			$this->load->view("front/defaults/front-header.php",$data);
			$this->load->view("front/defaults/front-footer.php");
		}
	}
?>