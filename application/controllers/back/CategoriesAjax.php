<?php 
class CategoriesAjax extends CI_Controller {
	public function disable($table,$id){
		$this->load->model("back/Categories_model");
		$this->Categories_model->disable($table,$id);
	}
	public function switchLink($table,$id,$productId){
		echo $table;
		$this->load->model("back/Categories_model");
		if($table=='subcat'){
			$table="Sub_Cat_Id";
		}else {
			$table="Cat_Id";
		}
		echo $table;
		$this->Categories_model->switchLink($table,$id,$productId);
	}
}
