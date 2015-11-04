<?php
class Gpayment_model extends CI_Model {
	public function getMerchantData(){
		$merchantFile = fopen ( APPPATH."/config/Merchant_key" , "r" );
		if ($merchantFile){
			$data=array("payURL"				=>str_replace("Simulatie-URL_connector: ","",fgets($merchantFile)),
						"merchantId"			=>str_replace("\n","",str_replace("merchantID: ","",fgets($merchantFile))),
						"secretKey"				=>str_replace("\n","",str_replace("secretKey: ","",fgets($merchantFile))),
						"keyVersion"			=>str_replace("keyVersion: ","",fgets($merchantFile)),
						"normalReturnUrl"		=>base_url("index.php/orders/success"),
						"automaticResponseUrl"	=>base_url("index.php/orders/success")
			);
			fclose($merchantFile);
			return $data;
		}
	}


}
