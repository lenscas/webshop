<?php
	$emailSTR='<h1>Wijziging in order</h1>
				<p>Uw order is gewijzigd, dit zorgde er voor dat de totaal prijs omhoog ging.</p>
				<p>U kunt betalen via de volgende link: <a href="'.base_url("index.php/orders/payExtra/")."/".$orderData['Transaction_Id'].'">'.base_url("index.php/orders/payExtra")."/".$orderData['Transaction_Id'].'</a>.</p>
				<p>Als u geen wijziging heeft aangevraagd neem dan contact op met één van onze medewerkers</p>';
	 mail ( $orderData['MailAdress'] , "Order wijziging" , $emailSTR);


?>
