<?php 
class Products extends CI_Controller {
	public function addProduct(){
		$contentData=array();
		$data=$this->input->post();
		if($data){
			foreach($data as $key => $value){
				if($value==""){
					$contentData["error"][]="Er is een waarde niet ingevuld ";
				}
				if($key=="Fragile"){
					$data[$key]=1;
				}
			}
			if(!isset($contentData["error"])){
				$this->load->model("back/Products_model");
				
				$this->Products_model->add($data);
				$contentData["success"]="Het product is toegevoegd";
			}
		}
		
		$this->load->view("back/defaults/back-header.php");
		$this->load->view("back/defaults/menu.php");
		$this->load->view("back/products/add.php",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}
}
?>