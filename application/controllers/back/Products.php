<?php 
class Products extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("back/Defaults_model");
		$headerData=$this->Defaults_model->loadHeaderData();
		$this->load->view("back/defaults/back-header.php",$headerData);
		$this->load->view("back/defaults/menu");
	}
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
		//$this->load->view("back/defaults/back-header.php");
		//
		$this->load->view("back/defaults/menu.php");
		$this->load->view("back/products/add.php",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}

	public function editProduct($productId){		
		$contentData=array();
		
		$data=$this->input->post();
		$this->load->model("back/Products_model");
		$this->load->model("general/Gproducts_model");
		$contentData['productData']=$this->Gproducts_model->getProductData($productId);
		if($data){
			
			foreach($data as $key => $value){
				if($value==""){
					$contentData["error"][]="Er is een waarde niet ingevuld.";
				}
				
			}
			if(isset($data["Fragile"])){
				$data["Fragile"]=1;
			} else {
				$data["Fragile"]=0;
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
				} else {
					$data['Picpath']="/application/assets/products/".$uploadData['file_name'];
					$this->load->helper("file");
					//echo FCPATH. preg_replace('/^\//', '', $contentData['productData']["Picpath"]);
					delete_files(FCPATH. preg_replace('/^\//', '', $contentData['productData']["Picpath"]));
				}
			}
			unset($data['Picture']);
			$this->Products_model->editProduct($data,$productId);
			$contentData["success"]="Het product is bijgewerkt.";
			}
		$contentData['taxOptions']=$this->Products_model->getTaxOptions();
		$contentData['productData']=$this->Gproducts_model->getProductData($productId);
		//$this->load->view("back/defaults/back-header.php");
		//
		$this->load->view("back/products/add.php",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}

	function updateStorage($productId) {
		//initialize Array
		$contentData=array();

		//load model
		$this->load->model("back/Products_model");
		$this->load->model("general/Gproducts_model");
		
		$contentData['productData']=$this->Gproducts_model->getProductData($productId);


		//array information
		if ($this->input->post()) {
			$data=$this->input->post();
			$insertData=array();

			if (isset($data['amount']) && isset($data['Sell_Price']) ) {
				if ($data['amount']>0 && $data['Sell_Price']>=0)  {
					for($times=0; $times<$data['amount'];$times++){
						if(isset($data['ean'][$times])){
							$insertData[$times]['Ean']=$data['ean'][$times];
						}
						$insertData[$times]['PurchasePrice']=$data['Sell_Price'];
						$insertData[$times]['Products_Id']=$productId;
						$contentData["success"]="De voorraad is toegevoegd.";
						$this->Products_model->updateStorage($insertData);
					}
				} 
			}

			if(!isset($contentData["success"])){
				$contentData["error"]="Er zijn 1 of meerdere velden niet goed ingevuld";
			}
			
		} 
		$this->load->view("back/products/addstock.php",$contentData);
		$this->load->view("back/defaults/back-footer.php");
	}
	public function viewProducts(){
		$this->load->view("back/products/view.php");
		$this->load->view("back/defaults/back-footer.php");
	}
}
?>
