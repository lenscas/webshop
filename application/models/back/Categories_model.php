<?php
class Categories_model extends CI_Model {
	public function createCategory($data){
		if(! $data['Name']){
			return "Er is geen naam voor de categorie opgegeven";
		}
		if( isset($data['categories']) || isset($data['subCat'])){
			$table='subcat';
			if(isset($data['categories'])){
				$insertData['CatLink']=$data['categories'];
			} else {
				$insertData['SubCatLink']=$data['subCat'];
			}
		} else {
			$table='categories';
		}
		$insertData['Name']=$data['Name'];
		$this->db->insert($table,$insertData);
	}
	public function disable($table,$id){
		$this->db->where("Id",$id);
		$this->db->update($table,array("Disabled"=>1));
	}
	public function checkForLinks($categories,$productId){
		foreach($categories as $key=>$value){
			$categories[$key]['hasLink']=$this->checkLinkSingleCat($value['Id'],$productId,"Cat_Id");
			$categories[$key]['subCatergory']=$this->linkRecursionHelper($value['subCatergory'],$productId);
		}
		return $categories;
	}
	private function linkRecursionHelper($categories,$productId){
		$loopedCategories=$categories;
		foreach($categories as $key=>$value){
			$loopedCategories[$key]["hasLink"]=$this->checkLinkSingleCat($value['Id'],$productId,"Sub_Cat_Id");
			$loopedCategories[$key]['subCatergory']=$this->linkRecursionHelper($value['subCatergory'],$productId);
		}
		return $loopedCategories;
	}
	private function checkLinkSingleCat($categoryId,$productId,$table){
		$this->db->select("count(*) as count");
		$this->db->from("catlink");
		$this->db->where($table,$categoryId);
		$this->db->where("Product_Id",$productId);
		$query=$this->db->get();
		$result=$query->row_array();
		if($result['count']>0){
			return true;
		}
		return false;
	}
	public function switchLink($table,$id,$productId){
		if($this->checkLinkSingleCat($id,$productId,$table)){
			$this->db->where(array("Product_Id"=>$productId,$table=>$id));
			$this->db->delete("catlink");
		} else {
			$this->db->insert("catlink",array("Product_Id"=>$productId,$table=>$id));
		}
	}
}
