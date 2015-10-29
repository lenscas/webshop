<?php
class Gcategories_model extends CI_Model {
	public function loadAllCategories(){
		$categories=$this->getCategrories();
		foreach($categories as $key=>$value){
			$categories[$key]['subCatergory']=$this->getAllSubcategories($value['Id'],"CatLink");
		}
		return $categories;
	}
	public function getCategrories(){
		$this->db->select("*");
		$this->db->from("categories");
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getAllSubcategories($category,$sort){
		$subcategories=array();
		$this->db->select("*");
		$this->db->from("subcat");
		$this->db->where($sort,$category);
		$query=$this->db->get();
		$result=$query->result_array();
		$subCatergories=$result;
		foreach($subCatergories as $key=>$value){
			$subCatergories[$key]['subCatergory']=$this->getAllSubcategories($value['Id'],'SubCatLink');
		}
		return $subCatergories;
	}
}
