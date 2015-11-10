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
								<th class="col-md-2"></th>
								<th class="col-md-2">Product prijs</th>
								<th class="col-md-2">Totaal prijs</th>
								<th class="col-md-2">Verwijderen</th>
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
									$totalProductPrice	=	$value['Sell_price']*$value['want'];
									$taxProduct			=	$totalProductPrice/100*$value['taxAmount'];
									$totalTax			=	$taxProduct+$totalTax;
									$total				=	$total+$totalProductPrice;
							?>
									<td><img style="width:100%;" src="<?php echo base_url($value['Picpath'])?>"></td>
									<td><?php echo $value['Name'] ?> </td>
									<td class="want"><?php echo $value['want']?></td>
									<td>
										<button class="btn btn-danger subtract">-</button>
										<button class="btn btn-success add">+</button>
									</td>
									<td> <input value="<?php echo $value['Sell_price'] ?>" type="hidden" class="productPrice">&#8364; <?php echo $value['Sell_price'] ?> <input type="hidden" value="<?php echo $value['Sell_price']/100*$value['taxAmount']; ?>" class="tax"></td>
									<td class="totalPrice">&#8364; <?php echo $totalProductPrice?></td>
									<td><button type="button" class="btn btn-danger delete"><span class="fa fa-times"></span></button></td>
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
							<td colspan="4"></td>
							<td style="border-top:solid 2px black" >Sub-totaal bedrag</td>
							<td style="border-top:solid 2px black" id="subTotal"><?php echo $total ?></td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td>Totaal BTW</td>
							<td id="totalTax"><?php echo $totalTax ?></td>
						</tr>
							<td colspan="4"></td>
							<td>Netto totaal bedrag</td>
							<td id="nettoTotalPrice"><?php echo $total+$totalTax?></td>
						</tr>
					</tbody>
				</table>
				<a href="<?php echo base_url("index.php/makeOrder")?>" class="btn btn-success pull-right">Order aanmaken</a>
			<?php
				} else {
			?>
				<h1>Geen producten in het winkel mandje </h1>
			<?php 
				}
			?>
		</div>
	</div>
</div>
<script>
	function changeWant(way,element){
		var text= $(element).html()
		if(way=="up"){
			$(element).empty().html(Number(text)+1)
		} else {
			if(text>0){
				$(element).empty().html(Number(text)-1)
			}
		}
	}
	function returnId(element){
		var id=$(element).parent().parent().attr("id")
		var cleanId=id.replace("product","")
		return [id,cleanId]
	}
	$(".add").on("click",function(){
		var idList=returnId(this)
		$.ajax({
			url:"<?php echo base_url("index.php/cart/ajax/add")?>/"+idList[1],
			success:function (){
				var element= $("#"+idList[0]).find(".want")
				changeWant("up",element)
				update($("#"+idList[0]));
			}
			
		})
	})
	$(".subtract").on("click",function(){
		var idList=returnId(this)
		$.ajax({
		url: "<?php echo base_url("index.php/cart/ajax/subtract")?>/"+idList[1],
		success:function (){
				var element= $("#"+idList[0]).find(".want")
				changeWant("down",element)
				update($("#"+idList[0]));
			}
		})
	})
	$(".delete").on("click",function(){
		var idList=returnId(this)
		$.ajax({
		url: "<?php echo base_url("index.php/cart/ajax/delete")?>/"+idList[1],
		success:function (){
				var element= $("#"+idList[0]).find(".want")
				$(element).empty().html(0)
				update($("#"+idList[0]));
			}
		})
		
	})
	
	function update(row){
		console.log(row)
		var totalCost		=0;
		var productAmount	=0;
		var productTax		=0;
		var totalTax		=0;
		var taxAmount		=0;
		
		var amount		=	parseFloat($(row).find(".want").html())
		var costProduct	=	parseFloat($(row).find(".productPrice").val())
		var newCost		=	amount*costProduct
		
		$(row).find(".totalPrice").empty().html(newCost)
		$(".products").each(function(){
			productAmount	=	parseFloat($(this).find(".want").html())
			tax				=	parseFloat($(this).find(".tax").val())
			console.log(tax)
			productCost		=	parseFloat($(this).find(".productPrice").val())
			totalTax		=	totalTax+(tax*productAmount);
			totalCost		=	totalCost+(productAmount*productCost)
		})
		$("#subTotal").empty().html(totalCost)
		$("#totalTax").empty().html(totalTax)
		$("#nettoTotalPrice").empty().html((totalCost+totalTax).toFixed(2))
		
	}
	

</script>
