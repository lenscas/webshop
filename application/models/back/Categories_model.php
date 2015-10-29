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
}
