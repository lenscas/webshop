<?php
class Orders_model extends CI_Model {
	public function getAllOrders(){
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->join("deliveraddress","deliveraddress.Id=orders.DeliverAddress_Id");
		$this->db->join("status","status.Id=orders.status");
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getOrderData($orderId){
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->where("orders.Id",$orderId);
		$this->db->join("deliveraddress","deliveraddress.Id=orders.DeliverAddress_Id");
		$query=$this->db->get();
		$result['orderData']	=	$query->row_array();
		$result['products']		=	$this->getOrderProducts($orderId);
		return $result;
	}
	public function getOrderProducts($orderId){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->join("productorders","productorders.Product_Id=products.Id","left");
		$this->db->join("backOrders","backOrders.Product_Id=products.Id","left");
		$this->db->join("tax","products.Tax_Id=tax.Tax_Id");
		$this->db->where("productorders.Order_Id",$orderId);
		$this->db->or_where("backOrders.Order_Id",$orderId);
		$query=$this->db->get();
		$result=$this->compressProductsList($query->result_array());
		return $result;
		
	}
	public function compressProductsList($products){
		$compressed=array();
		$productCounter=0;
		$lastProductId=null;
		$lastKey=0;
		foreach($products as $key=>$value){
			if($lastProductId==$value['Product_Id']){
				$productCounter++;
			}else{
				if($lastProductId!=null){
					$compressed[$lastKey]['amount']=$productCounter;
					$lastKey++;
				}
				$productCounter=1;
				$compressed[$lastKey]=$value;
				$lastProductId=$value['Product_Id'];
			}
		}
		$compressed[$lastKey]['amount']=$productCounter;
		return $compressed;
		
	}
	public function editOrder($data,$orderId){
		//remove all the old values from the database
		$this->db->where("Order_Id",$orderId);
		$this->db->delete("backOrders");
		
		$this->db->select("Product_Id");
		$this->db->from("productorders");
		$this->db->where("Order_Id",$orderId);
		$query=$this->db->get();
		$rows = $query->result_array();
		$this->db->where("Order_Id",$orderId);
		$this->db->delete("productorders");
		
		foreach($data['products'] as $key=>$value){
			//exit;
			/*$this->db->select("count(*) as count");
			$this->db->from("stock");
			$this->db->where("Products_Id",$value['productId']);
			$query=$this->db->get();
			$result=$query->row_array();
			*/
			//Products_Id,PurchasePrice,Ean,
			for($times=0;$times<=$value['want'];$times++){
				$this->db->select("Products_Id,PurchasePrice,Ean");
				$this->db->from("stock");
				$this->db->where("Products_Id",$value['productId']);
				$this->db->limit(1);
				$query=$this->db->get();
				$result=$query->result_array();
				if($result){
					$this->db->insert("productorders",$result);
				} else {
					break;
				}
			}
			if($times< $value['want']){
				for($inBack=1;$inBack<=($value['want']-$times);$inBack++){
					$this->db->insert("backOrders",array("Product_Id"=>$value['productId'],"Order_Id"=>$orderId));
				}
			}
			$totalTax=0;
			$totalPrice=0;
			foreach($data['products'] as $key=>$value){
				$this->db->select("tax.Tax_Amount,products.Tax_Id");
				$this->db->from("products");
				$this->db->join("tax","tax.Tax_Id=products.Tax_Id");
				$this->db->where("products.id",$value["productId"]);
				$query=$this->db->get();
				$result=$query->row_array();
				
				$price=$value['price']*$value['want'];
				$tax=$price/100*$result['Tax_Amount'];
				$totalTax=$totalTax+$tax;
				$totalPrice=$totalPrice+$price;
				
			}
			$updateArray=array(
				"Tax"=>$totalTax,
				"Price"=>$totalPrice,
				"TotalPrice"=>$totalTax+$totalPrice
			);
			$this->db->where("Id",$orderId);
			$this->db->update("orders",$updateArray);
		}
		
	}
	
}
