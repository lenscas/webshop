<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<div id="templates" hidden>
			<table>
				<tr id="trTemplate" class="products">
					<td  ><img class="image" style="width:100%"></td>
					<td class="name"></td>
					<td><input class="want" type="text" value="1" name=""></td>
					<td>
						<button type="button" class="btn btn-danger subtract">-</button>
						<button type="button" class="btn btn-success add">+</button>
					</td>
					<td> 
						<input value="" type="disabled"class="productPrice">
						<input type="hidden" class="tax">
						<input type="hidden" class="taxProcent">
						<input type="hidden" class="productId" name="">
					</td>
					<td class="totalPrice">&#8364; </td>
					<td><button type="button" class="btn btn-danger delete"><span class="fa fa-times"></span></button></td>
				</tr>
			</table>
		</div>
		<h1>
			Edit orders
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="<?php echo base_url("index.php/admin/orders/view")?>"></i> Orders</a></li>
			<li class="active">Edit</li>
		</ol>
	</section>
	<section class="content">
		<form method="post">
			<div class="box">
				<div class="box-header">
					<button class="btn btn-success pull-right">Opslaan</button>
				</div>
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Product Naam</th>
								<th>Aantal</th>
								<th></th>
								<th>Product Prijs</th>
								<th>Totaal Prijs</th>
								<th>Verwijderen</th>
							</tr>
						</thead>
						<tbody id="productsTable">
				<?php
					$total		=0;
					$totalTax	=0;
					foreach($products as $key=>$value){
						if(!isset($value['Id'])){
							break;
						}
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
									<td ><input class="want" type="text" name="<?php echo "products[".$key."][want]" ?>" value="<?php echo $value['amount']?>"></td>
									<td>
										<button type="button" class="btn btn-danger subtract">-</button>
										<button type="button" class="btn btn-success add">+</button>
									</td>
									<td> 
										<?php echo $value['Sell_price'] ?>
										<input value="<?php echo $value['Sell_price'] ?>" type="hidden" name="<?php echo "products[".$key."][price]"?>" class="productPrice">
										<input type="hidden" value="<?php echo $value['Sell_price']/100*$value['Tax_Amount']; ?>" class="tax">	
										<input type="hidden" class="taxProcent" value="<?php echo $value['Tax_Amount'] ?>">
										<input type="hidden" value="<?php echo $value["Product_Id"]?>"name="<?php echo "products[".$key."][productId]"?>">
									</td>
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
								$lastKey=$key;
							?>
						</tr>
				<?php
					}
				?>
						<tr id="calculation">
							<td colspan="4"></td>
							<td style="border-top:solid 2px black" >Sub-totaal bedrag</td>
							<td style="border-top:solid 2px black" id="subTotal"><?php echo $total ?></td>
						</tr>
						<tr>
							<td><input id="addProductInput" type="text" class="form-control"><input id="addProductId" type="hidden"></td>
							<td><button id="addProduct" class="btn btn-primary" type="button">Toevoegen</button><td>
							<td></td>
							<td>Totaal BTW</td>
							<td id="totalTax"><?php echo $totalTax ?></td>
						</tr>
							<td colspan="4"></td>
							<td>Netto totaal bedrag</td>
							<td id="nettoTotalPrice"><?php echo $total+$totalTax?></td>
						</tr>
					</tbody>
					</table>
				</div>
		</form>
	</section>
<script>

//script for the product buttons
function update(row){
	var totalCost		=0;
	var productAmount	=0;
	var productTax		=0;
	var totalTax		=0;
	var taxAmount		=0;
	var amount		=	parseFloat($(row).find(".want").val())
	var costProduct	=	parseFloat($(row).find(".productPrice").val())
	var newCost		=	amount*costProduct
	
	$(row).find(".totalPrice").empty().html(newCost.toFixed(2))
	$("#productsTable").find(".products").each(function(){
		console.log("bla")
		productAmount	=	parseFloat($(this).find(".want").val())
		tax				=	parseFloat($(this).find(".tax").val())
		productCost		=	parseFloat($(this).find(".productPrice").val())
		totalTax		=	totalTax+(tax*productAmount);
		totalCost		=	totalCost+(productAmount*productCost)
	})
	$("#subTotal").empty().html(totalCost.toFixed(2))
	$("#totalTax").empty().html(totalTax.toFixed(2))
	$("#nettoTotalPrice").empty().html((totalCost+totalTax).toFixed(2))
	
}
function changeWant(way,element){
	var text= $(element).val()
	if(way=="up"){
		$(element).val(Number(text)+1)
	} else {
		if(text>0){
			$(element).val(Number(text)-1)
		}
	}
}
function returnId(element){
	var id=$(element).parent().parent().attr("id")
	var cleanId=id.replace("product","")
	return [id,cleanId]
}
$("#productsTable").on("click",".add",function(){
	console.log("test")
	var element = $(this).parent().parent()
	changeWant("up",$(element).find(".want"))
	update(element);
})
$("#productsTable").on("click",".subtract",function(){
	var element = $(this).parent().parent()
	changeWant("down",$(element).find(".want"))
	update(element);
})
$("#productsTable").on("click",".delete",function(){
	var element = $(this).parent().parent()
	$(element).find(".want").val(0)
	update(element);
})
$("#productsTable").on("change",".productPrice",function(){
	var row = $(this).parent().parent()
	var tax= parseFloat(parseFloat($(this).val())/100*parseFloat($(row).find(".taxProcent").val()))
	
	$(row).find(".tax").val(tax)
	update($(row))
})
</script>
<script>
var key	=	<?php if(isset($lastKey)){
				echo $lastKey;
			} else {
				echo 0;
			} ?>;
//script for the adding of products
$( "#addProductInput" ).autocomplete({ 
	source: "<?php echo base_url("index.php/products/autocomplete")?>",
	minLength: 2,
	select: function( event, ui ) {
		$("#addProductId").val(ui.item.id)
	}
});
$("#addProduct").on("click",function(){
	$.ajax({
		url: "<?php echo base_url("index.php/products/getProduct")?>/"+$("#addProductId").val(),
		dataType: "json",
		success: function(result,status,xhr){
			if(result){
				key++
				var template=$("#trTemplate");
				$(template).find(".image").attr("src",result.Picpath)
				$(template).find(".name").empty().html(result.Name)
				$(template).find(".want").attr("name","products["+key+"][want]")
				$(template).find(".productId").attr("name","products["+key+"][productId]")
				$(template).find(".productId").val($("#addProductId").val())
				$(template).find(".productPrice").val(result.Sell_price)
				$(template).find(".productPrice").attr("name","products["+key+"][price]")
				$(template).find(".taxProcent").val(result.Tax_Amount)
				$(template).find(".tax").val(parseFloat(result.Sell_price)/100*parseFloat(result.Tax_Amount))
				$(template).find(".totalPrice").empty().html(parseFloat(result.Tax_Amount)+parseFloat(result.Sell_price))
				$(template).clone().insertBefore($("#calculation"))
				update()
				
			}
		}
	})
})
</script>
