<?php 
class Defaults extends CI_Model {
	public function headerData(){
		if($this->session->has_userdata("userId")){
			$loglink="editUser";
		} else {
			$loglink="login";
		}
		return array("title"=>"test",
						"accountText"=>"Login",
						"warningMessage"=>"this is a test error message",
						"warningClass"=>"alert-success",
						"warningVisible"=>true,
						"logLink"=>$loglink,
					);
	}


}
