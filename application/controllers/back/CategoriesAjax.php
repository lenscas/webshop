<?php 
class CategoriesAjax extends CI_Controller {
	public function disable($table,$id){
		$this->load->model("back/Categories_model");
		$this->Categories_model->disable($table,$id);
	}
}
