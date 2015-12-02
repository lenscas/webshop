<?php
class Orders_model extends CI_Model {
	public function getAllOrders(){
		$this->db->select("*, orders.Id as orderId");
		$this->db->from("orders");
		$this->db->join("deliveraddress","deliveraddress.Id=orders.DeliverAddress_Id");
		$this->db->join("status","status.Id=orders.status");
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getOrderData($orderId){
		$this->load->model("general/Gorder_model");
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->where("orders.Id",$orderId);
		$this->db->join("deliveraddress","deliveraddress.Id=orders.DeliverAddress_Id");
		$query=$this->db->get();
		$result['orderData']	=	$query->row_array();
		$result['products']		=	$this->Gorder_model->getOrderProducts($orderId);
		return $result;
	}

	
	public function editOrder($data,$orderId){
		$this->db->where("Id",$orderId);
		$helpVariable=mt_rand(0,1000) . 'x' . date('His');
		$this->db->update("orders",array("Transaction_Id"=>substr(preg_replace('/[^a-zA-Z0-9]+/', '', $helpVariable),0,35)));
		//remove all the old values from the database
		$this->db->where("Order_Id",$orderId);
		$this->db->delete("backOrders");
		
		$this->db->select("Product_Id as Products_Id,Date,Ean,PurchasePrice");
		$this->db->from("productorders");
		$this->db->where("Order_Id",$orderId);
		$query=$this->db->get();
		$rows = $query->result_array();
		$this->db->where("Order_Id",$orderId);
		$this->db->delete("productorders");
		if($rows){
			$this->db->insert_batch("stock",$rows);
		}
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
				$this->db->select("Products_Id as Product_Id,PurchasePrice,Ean");
				$this->db->from("stock");
				$this->db->where("Products_Id",$value['productId']);
				$this->db->limit(1);
				$query=$this->db->get();
				$result=$query->row_array();
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
