<?php
class Payment_model extends CI_Model {
	public function getPaymentData($orderId){
		$this->load->model("general/Gpayment_model");
		$this->load->model("general/Gorder_model");
		$data=$this->Gpayment_model->getMerchantData();
		$order=$this->Gorder_model->getOrderById($orderId);
		$needPay=$order["TotalPrice"]-$order["User_Paid"];
		$strData="merchantId=".$data['merchantId']."|orderId=".$order['Id']."|amount=".number_format ( $needPay , 2 , "" , "" )."|customerLanguage=nl|keyVersion=1|currencyCode=978|transactionReference=".$order['Transaction_Id']."|normalReturnUrl=".$data['normalReturnUrl']."|automaticResponseUrl=".$data['automaticResponseUrl'];

		
		$contentData=array("data"=>$strData,
							"interfaceVersion"=>"HP_1.0",
							"seal"=>hash('sha256', utf8_encode($strData . $data['secretKey'])),
							'payURL'=>$data['payURL']
		);
		return $contentData;
	}
	protected function getTransactionStatus($sTransactionCode)
		{
			if(in_array($sTransactionCode, array('00'))) // SUCCESS
			{
				return 'SUCCESS';
			}
			elseif(in_array($sTransactionCode, array('60'))) // PENDING
			{
				return 'PENDING';
			}
			elseif(in_array($sTransactionCode, array('97'))) // EXPIRED
			{
				return 'EXPIRED';
			}
			elseif(in_array($sTransactionCode, array('17'))) // CANCELLED
			{
				return 'CANCELLED';
			}

			return 'FAILED';
		}
	public function validate($postData){
		$this->load->model("general/Gpayment_model");
		$merchantData=$this->Gpayment_model->getMerchantData();
		if(!empty($postData['Data']) && !empty($postData['Seal']))
			{
				$sData = $postData['Data'];
				$sHash = $postData['Seal'];

				// Valdate HASH
				if(strcmp($sHash, hash('sha256', utf8_encode($sData . $merchantData['secretKey']))) === 0)
				{
					$a = explode('|', $sData);
					$aData = array();

					foreach($a as $d)
					{
						list($k, $v) = explode('=', $d);
						$aData[$k] = $v;
					}

					return array('transaction_reference' => $aData['transactionReference'], 'transaction_status' => $this->getTransactionStatus($aData['responseCode']), 'transaction_id' => (empty($aData['authorisationId']) ? '' : $aData['authorisationId']), 'order_id' => $aData['orderId'], 'raw_data' => $aData);
				}
			}

			return false;
	}
	public function payOrder($orderData){
		if($orderData['transaction_status']=="SUCCESS"){
			$this->db->select("*");
			$this->db->from("orders");
			$this->db->where("Transaction_Id",$orderData["transaction_reference"]);
			$query=$this->db->get();
			$result=$query->row_array();
			
			$this->db->where("orders.Id",$result['Id']);
			$this->db->update("orders",array("User_Paid"=>$result['TotalPrice'],"Status"=>10));
		}
		return $orderData['transaction_status'];
	}
}
