<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<?php 
				if(isset($products)){
			?>
					<table class="table">
						<thead>
							<tr>
								<th class="col-md-2">Product</th>
								<th class="col-md-3">Product naam</th>
								<th class="col-md-1">Aantal</th>
								<th class="col-md-2">Product prijs</th>
								<th class="col-md-2">Totaal prijs</th>
							</tr>
						</thead>
						<tbody>
				<?php
					$total		=0;
					$totalTax	=0;
					foreach($products as $key=>$value){
				?>
						<tr id="product<?php echo $value["Id"]?>" class="products">
							<?php 
								if(isset($value['Name'])){
									$totalProductPrice	=	$value['Sell_price']*$value['amount'];
									$taxProduct			=	$totalProductPrice/100*$value['Tax_Amount'];
									$totalTax			=	$taxProduct+$totalTax;
									$total				=	$total+$totalProductPrice;
							?>
									<td><img style="width:100%;" src="<?php echo base_url($value['Picpath'])?>"></td>
									<td><?php echo $value['Name'] ?> </td>
									<td><?php echo $value['amount']?></td>
									<td>&#8364; <?php echo $value['Sell_price'] ?></td>
									<td class="totalPrice">&#8364; <?php echo $totalProductPrice?></td>
							<?php
								} else {
							?>
								<td></td>
								<td>Product kon niet worden weergegeven</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							<?php
								}
							?>
						</tr>
				<?php
					}
				?>
						<tr >
							<td colspan="3"></td>
							<td style="border-top:solid 2px black" >Sub-totaal bedrag</td>
							<td style="border-top:solid 2px black" id="subTotal"><?php echo $total ?></td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td>Totaal BTW</td>
							<td id="totalTax"><?php echo $totalTax ?></td>
						</tr>
							<td colspan="3"></td>
							<td style="border-top:solid 2px black">Netto totaal bedrag</td>
							<td style="border-top:solid 2px black" id="nettoTotalPrice"><?php echo $total+$totalTax?></td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td>Betaald</td>
							<td><?php echo $orderData['User_Paid'] ?></td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td style="border-top:solid 2px black">Nog te betalen</td>
							<td style="border-top:solid 2px black"><?php echo ($total+$totalTax)- $orderData['User_Paid'] ?></td>
						</tr>
					</tbody>
				</table>
				<form method="post" action="<?php echo $paymentData['payURL'] ?>" name="checkout">
					<input type="hidden" value="<?php echo $paymentData['data'] ?>" name="Data">
					<input type="hidden" value="<?php echo $paymentData['interfaceVersion'] ?>" name="InterfaceVersion">
					<input type="hidden" value="<?php echo $paymentData['seal'] ?>" name="Seal">
					<input type="submit" class="btn btn-success pull-right" value="Betalen">
				</form>
			<?php
				} else {
			?>
				<h1>Er waren geen producten in de order gevonden.</h1>
			<?php 
				}
			?>
		</div>
	</div>
</div>
<script>
	
</script>
