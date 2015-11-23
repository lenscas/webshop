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

	public function search(){
		$this->load->model("general/Gproducts_model");
		$post=$this->input->post();
		if(! $post){
			redirect("/home","refresh");
		}
		if(! $post['search']){
			redirect("/home","refresh");
		}
		$data['search']=$this->Gproducts_model->search($post['search']);
		$this->load->view("front/products/search.php",$data);
		$this->load->view("front/defaults/front-footer.php");
	}
	public function product($id){
		$this->load->model("general/Gproducts_model");
		$productInfo=$this->Gproducts_model->getProductData($id);

		$this->load->view("front/products/product.php",$productInfo);
		$this->load->view("front/defaults/front-footer.php");	
	}
	public function ofCategory($table,$id){
		if($table=="subCat"){
			$table="Sub_Cat_Id";
		}else {
			$table="Cat_Id";
		}
		$this->load->model("front/Products_model");
		$contentData['search']=$this->Products_model->getProductsOfCategory($table,$id);
		$this->load->view("front/products/search",$contentData);
		$this->load->view("front/defaults/front-footer.php");
	}

}
?>
