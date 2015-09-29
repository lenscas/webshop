<?php
	class User extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model("front/Defaults");
			$data=$this->Defaults->headerData();
			$this->load->view("front/defaults/front-header.php",$data);
		}

		public function login_User(){
			$this->load->model("general/Gusers_model");
			$posted = true;
			if ($this->input->post()) {
				$error = $this->Gusers_model->Register($this->input->post(),'users');
			} else {
				$posted = false;
			}

			if (isset($error)|| $posted == false) {
				$this->load->view('front/users/register_form.php');
			}else{
				$this->load->view('front/users/register_success.php');
			}

			$this->load->view('front/defaults/front-footer.php');
		}

		public function Register_User(){
			$this->load->model("general/Gusers_model");
			$posted = true;
			$error = null;

			if ($this->input->post()) {
				$error = $this->Gusers_model->Register($this->input->post(),'users');
			} else {
				$posted = false;
			}

			if (isset($error)|| $posted == false) {
				$this->load->view('front/users/register_form.php', array('error' => $error));
			}else{
				$this->load->view('front/users/register_success.php');
			}

			$this->load->view('front/defaults/front-footer.php');
		}
	}


?>