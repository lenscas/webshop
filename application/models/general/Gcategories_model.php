<?php
class Gcategories_model extends CI_Model {
	public function loadAllCategories($loadDisabled=false){
		$categories=$this->getCategrories($loadDisabled);
		foreach($categories as $key=>$value){
			$categories[$key]['subCatergory']=$this->getAllSubcategories($value['Id'],"CatLink");
		}
		return $categories;
	}
	public function getCategrories($loadDisabled=false){
		$this->db->select("*");
		$this->db->from("categories");
		if(!$loadDisabled){
			$this->db->where("Disabled",0);
		}
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getAllSubcategories($category,$sort,$loadDisabled=false){
		$subcategories=array();
		$this->db->select("*");
		$this->db->from("subcat");
		$this->db->where($sort,$category);
		if(!$loadDisabled){
			$this->db->where("Disabled",0);
		}
		$query=$this->db->get();
		$result=$query->result_array();
		$subCatergories=$result;
		foreach($subCatergories as $key=>$value){
			$subCatergories[$key]['subCatergory']=$this->getAllSubcategories($value['Id'],'SubCatLink');
		}
		return $subCatergories;
	}
}
