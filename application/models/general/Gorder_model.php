<?php
class Gorder_model extends CI_Model {
	public function getCountryId($placeId){
		$this->db->select("Land_Id,id");
		$this->db->from("deliveraddress");
		$this->db->where("Id",$placeId);
		$query=$this->db->get();
		$result=$query->row_array();
		return $result['Land'];
	}
	public function GetSendMethods($products,$country){
		$this->load->model("general/Gproducts_model");
		$totalWeight=0;
		foreach($products as $key=>$value){
			$totalWeight=$totalWeight+($this->Gproducts_model->getProductWeigth($key)*$value);
		}/*
		$this->db->select("*");
		$this->db->from("SendMethodRules");
		$this->db->join("SendMethods","SendMethodRules.SendMethod_Id=SendMethods.Id");
		$this->db->where("SendMethodRules.Min_Weight <",$totalWeight);
		$this->db->where("SendMethodRules.Max_Weight >",$totalWeight);
		$this->db->or_where("SendMethodRules.Max_Weight",NULL);
		$this->db->where("Land_id",$country);
		$query=$this->db->get();
		$result=$query->result_array();*/
		$this->db->select("*");
		$this->db->from("SendMethods");
		$query=$this->db->get();
		$result=$query->result_array();
		foreach($result as $key=>$value){
			$this->db->select("*");
			$this->db->from("SendMethodRules");
			$this->db->where("SendMethodRules.Min_Weight <",$totalWeight);
			$this->db->where("SendMethodRules.Max_Weight >",$totalWeight);
			$this->db->or_where("SendMethodRules.Max_Weight",NULL);
			$this->db->where("Land_id",$country);
			$this->db->where("SendMethod_Id",$value['Id']);
			$query=$this->db->get();
			$result[$key]['rules']=$query->result_array();
			if( ! $result[$key]['rules']){
				unset($result[$key]);
			}
		}
		return $result;
	}
	public function getSendCost($id){
		$this->db->select("SendCosts,Id");
		$this->db->from("SendMethodRules");
		$this->db->where("Id",$id);
		$query=$this->db->get();
		return $query->row_array();
	}
	public function InsertOrder($data,$cart,$userId=null){
		$insertData=array();
		if($data['usedPlace']=="custom"){
			$data['user']["Land_id"]=$data['country'];
			$data['user']["Users_Id"]=$userId;
			$insertData['DeliverAddress_Id']=$this->CreateAdress($data['user']);
		} else {
			$insertData['DeliverAddress_Id']=$data['usedPlace'];
		}
		$costData=$this->calculateCost($cart);
		$orderData=array("DeliverAddress_Id"=>$insertData['DeliverAddress_Id'],
			"Status"=>0,
			"Tax"=>$costData['Tax'],
			"price"=>$costData['TotalPrice'],
			"TotalPrice"=>$costData['Tax']+$costData['TotalPrice'],
			"Discount"=>0,
			"SendMethodRule_id"=>$data['SendMethodRule_id'],
			
		);
		
		$this->db->insert("orders",$orderData);
		$orderId=$this->db->insert_id();
		
		foreach($cart as $key=>$value){
			$this->db->select("*");
			$this->db->from("stock");
			$this->db->where("Products_Id",$key);
			$query=$this->db->get();
			$result=$query->result_array();
			foreach($result as $stockKey=>$stockValue){
				if($cart[$key]>0){
					$insertData=$stockValue;
					$insertData['Order_Id']=$orderId;
					
					$this->db->insert("productorders",$insertData);
					$this->db->where($stockValue);
					$this->db->delete();
					$cart[$key]=$cart[$key]-1;
				} else {
					break;
				}
			}
			foreach($cart as $key=>$value){
				$this->db->insert("backOrders",array("Product_Id"=>$key,"Order_Id"=>$orderId));
			}
		}
		
	}
	public function CreateAdress($data){
		$this->db->insert('deliveraddress',$data);
		return $this->db->insert_id();
	}
	public function calculateCost($cart){
		$this->load->model("general/Gproducts_model");
		$totalTax=0;
		$totalCost=0;
		foreach($cart as $key=>$value){
			$productData	=	$this->Gproducts_model->getProductData($key);
			$cost			=	$productData['Sell_price']*$value;
			$tax			=	$cost/100*$productData['taxAmount'];
			$totalCost		=	$totalCost+$cost;
			$totalTax		=	$totalTax+$tax;
		}
		return array("TotalPrice"=>$totalCost,"Tax"=>$totalTax);
	}
}