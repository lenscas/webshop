<?php
	class User extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model("front/Defaults");
			$data=$this->Defaults->headerData();
			$this->load->view("front/default/front-header.php", $data);
		}

		public function Register_User(){
			$this->load->model("front/Defaults");
			$data=$this->Defaults->headerData();
			$this->load->view("front/default/front-header.php", $data);
		}
	}


?>