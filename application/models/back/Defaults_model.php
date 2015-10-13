<?php
class Defaults_model extends CI_Model {
	public function loadHeaderData(){
		if(! $this->session->has_userdata("adminId")){
			redirect("admin/login");
		}
		
	}


}
