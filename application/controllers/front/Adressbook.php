<?php
class Adressbook extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->has_userdata("userId")){
			redirect("home");
		}
		$this->load->model("front/Defaults");
		$data=$this->Defaults->headerData();
		$this->load->view("front/defaults/front-header.php",$data);
		
	}
	public function add(){
		$data=$this->input->post();
		$contentData=array();
		$this->load->model("front/Adressbook_model");
		$contentData["countries"]=$this->Adressbook_model->getCountries();
		if($data){
			
			$contentData['error']=$this->Adressbook_model->insertAdress($data,$this->session->userId);
			if(!$contentData['error']){
				$contentData['success']=true;
			}
		}
		$this->load->view("front/adressbook/add",$contentData);
		$this->load->view("front/defaults/front-footer.php");
	}

	public function view(){

		$this->load->view("front/adressbook/view");
		$this->load->view("front/defaults/front-footer.php");
	
	}
}
