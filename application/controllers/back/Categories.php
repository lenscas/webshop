<?php 
class Categories extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		$this->load->view("back/defaults/back-header.php",$headerData);
		$this->load->view("back/defaults/menu");
	}
	public function insertCategory(){
		$this->load->model("general/Gcategories_model");
		$this->load->model("back/Categories_model");
		$error=false;
		if($this->input->post()){
			$error=$this->Categories_model->createCategory($this->input->post());
		}
		$categories=$this->Gcategories_model->loadAllCategories();
		$contentData=array('categoriesList'=>$categories,'error'=>$error);
		$this->load->view('back/categories/add',$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}
}
