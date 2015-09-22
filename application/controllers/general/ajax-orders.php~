<?php
class TestHeader extends CI_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function admin(){
		$this->load->view("back/defaults/back-header.php");
		$this->load->view("back/defaults/menu.php");
		$this->load->view("back/dashboard.php");
		$this->load->view("back/defaults/back-footer.php");
	}
	public function user(){
		$testArray=array("title"=>"test",
						"accountText"=>"testThisShit",
						"warningMessage"=>"this is a test error message",
						"warningClass"=>"alert-success",
						"warningVisible"=>true
						);
		$this->load->view("front/defaults/front-header.php",$testArray);
		$this->load->view("front/defaults/front-footer.php");
	}
}
