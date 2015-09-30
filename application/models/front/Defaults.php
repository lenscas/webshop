<?php 
class Defaults extends CI_Model {
	public function headerData(){
		if($this->session->has_userdata("userId")){
			$loglink			="editUser";
			$registerHidden		=true;
			$accountText		="Profiel";
		} else {
			$loglink			="login";
			$registerHidden		=false;
			$accountText		="Login";
			
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
