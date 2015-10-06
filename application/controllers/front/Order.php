<?php
	class Order extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model("front/Defaults");
			$data=$this->Defaults->headerData();
			$this->load->view("front/defaults/front-header.php",$data);
		}

		public function loadHistory(){
			if(! $this->session->has_userData("userId")){
				redirect("home");
			}
			$this->load->model("front/User_model");
			$error = null;
			if ($this->input->post()) {
				$error = $this->User_model->Login_user($this->input->post());
				if(!$error){
					redirect("home");
				}
			} 
			$this->load->model("front/Defaults");
			$this->load->view("front/defaults/front-footer.php");
		}
	}
?>