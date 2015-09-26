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
		/*print_r($productInfo);
		exit(); */
		$this->load->view("front/products/product.php",$productInfo);
		$this->load->view("front/defaults/front-footer.php");	
	}

}
?>