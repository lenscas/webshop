<?php 
class Defaults extends CI_Model {
	public function headerData(){
		if($this->session->has_userdata("userId")){
			$loglink			="editUser";
			$registerHidden		=true;
			$accountText		="profile";
		} else {
			$loglink			="login";
			$registerHidden		=false;
			$accountText		="log in";
			
		}
		return array(	"title"			=>"test",
						"accountText"	=>$accountText,
						"warningMessage"=>"this is a test error message",
						"warningClass"	=>"alert-success",
						"warningVisible"=>true,
						"logLink"		=>$loglink,
						"registerHidden"=>$registerHidden
					);
	}


}
