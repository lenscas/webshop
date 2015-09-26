<?php 
class Products extends CI_Controller {
	public function addProduct(){
		$contentData=array();
		$data=$this->input->post();
		$this->load->model("back/Products_model");
		if($data){
			foreach($data as $key => $value){
				if($value==""){
					$contentData["error"][]="Er is een waarde niet ingevuld.";
				}
				if($key=="Fragile"){
					$data[$key]=1;
				}
			}
			if(!isset($contentData["error"])){
				$config['upload_path'] = './application/assets/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100000';
				$config['max_width']  = '10240';
				$config['max_height']  = '7680';
				
				$this->load->library('upload', $config);
				//first upload 
				$this->upload->do_upload("Picture");
				$uploadData=$this->upload->data();
				if($this->upload->display_errors()){
					$contentData["error"]="De afbeeling kon niet worden ge-upload.";
				}else {
					$data['Picpath']="/application/assets/products/".$uploadData['file_name'];
					unset($data['Picture']);
					$this->Products_model->add($data);
					$contentData["success"]="Het product is toegevoegd";
				}
			}
		}
		$contentData['taxOptions']=$this->Products_model->getTaxOptions();
		$this->load->view("back/defaults/back-header.php");
		$this->load->view("back/defaults/menu.php");
		$this->load->view("back/products/add.php",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}
}
?>