<?php 
	//$addresses=array();
	$defaultPlace="custom";
	$countries=array(array('Id'=>1,"name"=>"Nederland"));
?>
<div class="col-md-9">
	<div class="row buttons pull-right" style="margin-bottom:10px">
		<button id="selectAdressButton"		style="display: none;"	class="pageSwitch page1 btn "			></button>
		<button id="sendMethodButton"								class="pageSwitch page2 btn btn-success">Volgende</button>
		<button id="paymentMethodButton"	style="display: none;"	class="pageSwitch page3 btn"			></button>
		<button id="summaryButton"			style="display: none;"	class="pageSwitch page4 btn"			></button>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form method="post">
				<input name="usedPlace" id="used" type="hidden" value="<?php echo $defaultPlace ?>">
				<div id="selectAdress" class="pages">
					<?php
						foreach($addresses as $key => $addressData){
					?>
						<div>
							<button id="button<?php echo $addressData['placeId']?>" type="button" class="selectAdress btn btn-primary"><?php echo $addressData['Adress']?></button>
							<div hidden class="adressData">
								<table style="max-width:100%">
									<tr>
										<td>Voornaam</td>
										<td>Tussen voegsels</td>
										<td>Achternaam</td>
									</tr>
									<tr>
										<td><input readonly type="text" value="<?php echo $addressData['Firstname'] ?>"></td>
										<td><input readonly type="text" value="<?php echo $addressData['SecondName'] ?>"></td>
										<td><input readonly type="text" value="<?php echo $addressData['LastName'] ?>"></td>
									</tr>
								</table>
								<table style="max-width:100%">
									<tr>
										<td>Woonplaats</td>
										<td>Zipcode</td>
									</tr>
									<tr>
										<td><input readonly type="text" value="<?php echo $addressData['City'] ?>"></td>
										<td><input readonly type="text" value="<?php echo $addressData['Zipcode']?>"></td>
									</tr>
									<tr>
										<td>Straat</td>
										<td>Huisnummer</td>
									</tr>
									<tr>
										<td><input readonly type="text" value="<?php echo $addressData['Adress'] ?>"></td>
										<td><input readonly type="text" value="<?php echo $addressData['HomeNumber']?>"></td>
									</tr>
									<tr>
										<td>Email address</td>
									</tr>
									<tr>
										<td><input readonly type="text" value="<?php echo $addressData["MailAdress"] ?>"></td>
									</tr>
								</table>
								<table style="max-width:100%">
									<tr>
										<td>Land</td>
									</tr>
									<tr>
										<td><input readonly value="<?php echo $addressData['LandName'] ?>">
									</tr>
								</table>
							</div>
						</div>
					<?php	
						}
					?>
					<div>
						<button id="custom" type="button" class="selectAdress btn btn-primary">Anders</button>
						<div class="adressData">
							<table style="max-width:100%; table-layout:fixed">
								<tr>
									<td>Voornaam</td>
									<td>Tussen voegsels</td>
									<td>Achternaam</td>
								</tr>
								<tr>
									<td><input type="text"	name="user[Firstname]"	></td>
									<td><input type="text"	name="user[SecondName]"	></td>
									<td><input type="text"	name="user[LastName]"		></td>
								</tr>
							</table>
							<table style="max-width:100%">
								<tr>
									<td>Woonplaats</td>
									<td>Zipcode</td>
								</tr>
								<tr>
									<td><input type="text"	name="user[City]"		></td>
									<td><input type="text"	name="user[Zipcode]"	></td>
								</tr>
								<tr>
									<td>Straat</td>
									<td>Huisnummer</td>
								</tr>
								<tr>
									<td><input type="text"	name="user[Adress]"		></td>
									<td><input type="text"	name="user[HomeNumber]"	></td>
								</tr>
							</table>
							<table style="max-width:100%">
								<tr>
									<td>Land</td>
								</tr>
								<tr>
									<td><select id="country" name="country">
									<?php 
										foreach($countries as $key=>$value){
											echo '<option value="'.$value['Id'].'">'.$value['name'].'</option>';
										}
									?>
								</tr>
								<tr>
									<td>Email address</td>
								</tr>
								<tr>
									<td><input type="text" name="user[MailAdress]"></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div id="sendMethod" class="pages">
					<div id="tableRowTemplate" hidden>
						<table class="table">
							<tr class="templateRow">
								<td class="picture"><img src="" class="pictureEle" style="max-width:100px"></td>
								<td class="rule"><select name="SendMethodRule_id" class="select"></select></td>
							</tr>
						</table>
					</div>
					<table id="sendMethodTable">
					</table>
				</div>
				<div id="paymentMethod" class="pages" hidden>
					<label>Paypal</label>
					<input type="radio" name="paymentMethod" id="paypal" value="paypal">
				</div>http://localhost/webshop/index.phphome
				<div id="summary" class="pages" hidden>
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
									$totalProductPrice	=	$value['Sell_price']*$value['want'];
									$taxProduct			=	$totalProductPrice/100*$value['taxAmount'];
									$totalTax			=	$taxProduct+$totalTax;
									$total				=	$total+$totalProductPrice;
							?>
								<td><img style="width:100%;" src="<?php echo base_url($value['Picpath'])?>"></td>
								<td><?php echo $value['Name'] ?> </td>
								<td class="want"><?php echo $value['want']?></td>
								<td>&#8364; <?php echo $value['Sell_price'] ?></td>
								<td>&#8364; <?php echo $totalProductPrice?></td>
							<?php
							}
							?>
							<tr >
								<td colspan="3"></td>
								<td style="border-top:solid 2px black">Bruto totaal bedrag</td>
								<td style="border-top:solid 2px black"><?php echo $total ?><input id="noTaxPrice" type="hidden" value="<?php echo $total?>"></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Verzend kosten</td>
								<td id="shipmentCostsSummary"></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Totaal BTW</td>http://localhost/webshop/index.phphome
								<td><?php echo $totalTax ?><input id="tax" type="hidden" value="<?php echo $totalTax ?>"></td>
							</tr>
								<td>Betaal methode:</td>
								<td id="paymentMethodSummary"></td>
								<td></td>
								<td>Netto totaal bedrag</td>
								<td id="totalWithTax"><?php echo $total+$totalTax?></td>
							</tr>
						</tbody>
					</table>
					<button>Verzenden</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
//selecting of the addresses
	$(".selectAdress").on("click",function(){
		var element=$(this).parent().find(".adressData")[0]
		$("#selectAdress").find(".adressData").each(function(){
			if(this != element){
				$(this).hide()
			}else {
				$(this).show();
			}
		})
		if($(this).attr("id")=="custom"){
			$("#used").attr("value","custom")
		}else {
			$("#used").attr("value",($(this).attr("id").replace("button","")))
		}
	})
var pageFunctions={
	"selectAdress"	:function(){},
	"sendMethod"	:function(){
		var place=$("#used").val()
		var country=""
		if(place==="custom"){
			country=$("#country").val()
		}
		$.ajax({
			dataType:"json",
			method:		"POST",
			url	:		"<?php echo base_url("index.php/ajax/getShipmentOption") ?>",
			data:		{place:place,country:country},
			success:	function(result){
							$("#sendMethodTable").empty()
							var template=$("#tableRowTemplate").find(".templateRow")
							$.each(result,function(index,value){
								$(template).find(".pictureEle").attr("src","<?php echo base_url()?>/"+value["PicPath"])
								$(template).find(".select").empty()
								$(template).find(".select").append("<option value=''>Selecteer de verzend Methode</option>")
								$.each(value['rules'],function(ruleKey,ruleValue){
									$(template).find(".select").append('<option value="'+ruleValue['Id']+'">'+ruleValue['Rule_Name']+" "+ruleValue['SendCosts']+'</option>')
								})
								$(template).clone().appendTo("#sendMethodTable")
							})
								
						}
		})
	},
	"paymentMethod"	:function(){},
	"summary"	:function(){
		var cost=""
		$(".select").each(function(){
			if($(this).val()){
				$.ajax({
					dataType:	"json",
					method	:	"POST",
					url		:	"<?php echo base_url("index.php/ajax/getShipmentCosts") ?>",
					data	:	{Id:$(this).val()},
					success	:	function(result){
									console.log(result['SendCosts'])
									$("#shipmentCostsSummary").empty().html(result["SendCosts"]);
									var totalTax 		=	$("#tax").val()
									var productPrice	=	$("#noTaxPrice").val()
									$("#totalWithTax").empty().append(Number(totalTax)+Number(productPrice)+Number(result['SendCosts']))
									if($("#paypal").is(":checked")){
										$("#paymentMethodSummary").empty().html("paypal")
									}
								}
					
				})
			return false
			}
		})
	}
}
//handling of the multiple pages

$(".pageSwitch").on("click",function(){
	//get the id of the button and which number it is
	var id = $(this).attr("id")
	var cleanId=id.replace("Button","")
	var number=$(this).attr("class").match(/\d/g)[0]
	//run the needed function
	pageFunctions[cleanId]()
	//show the correct page
	$(".pages").hide()
	$("#"+cleanId).show()
	//change the buttons correctly
	//first hide all of them
	$(".pageSwitch").hide()
	//edit the classes of the previous and show it
	editButton($(".page"+(number-1)),"btn-warning","Vorige")
	//edit the classes of the next button and show it
	editButton($(".page"+(Number(number)+1)),"btn-success","Volgende")
})

function editButton(button,giveClass,message){
	$(button).removeClass("btn-success")
	$(button).removeClass("btn-warning")
	$(button).addClass(giveClass)
	$(button).empty().html(message)
	$(button).show()
}
</script>
