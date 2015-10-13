<?php
class Admins extends CI_Controller {
	
	public function logIn(){
		$showForm=true;
		if($this->input->post()){
			$this->load->model("general/Gusers_model");
			$error=$this->Gusers_model->login("admin",$this->input->post());
			echo $error;
			if(!$error){
				$showForm=false;
			}
		}
		if($showForm){
			$this->load->view("back/admin/login");
		} else {
			redirect("admin/home");
			/*
			*/
		}
	}
	public function dashboard(){
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		
		$this->load->model("back/Admins_model");
		$contentData=$this->Admins_model->getDashboardData();
		$this->load->view("back/defaults/back-header",$headerData);
		$this->load->view("back/defaults/menu");
		$this->load->view("back/admin/dashboard",$contentData);
		$this->load->view("back/defaults/back-footer");
	}
	

}
