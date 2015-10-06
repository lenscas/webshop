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
							</tr>
						</thead>
						<tbody>
				<?php
					foreach($products as $key=>$value){
				?>
							<?php 
								if(isset($value['Name'])){
							?>
									<td><img style="width:100%;" src="<?php echo base_url($value['Picpath'])?>"></td>
									<td><?php echo $value['Name'] ?> </td>
									<td class="want"><?php echo $value['want']?></td>
									<td id="product<?php echo $value["Id"]?>">
										<button class="btn btn-danger subtract">-</button>
										<button class="btn btn-success add">+</button>
									</td>
									<td>&#8364; <?php echo $value['Sell_price'] ?></td>
									<td>&#8364; <?php echo $value['Sell_price']*$value['want'] ?></td>
							<?php
								} else {
							?>
								<td></td>
								<td>Product kon niet worden weergegeven</td>
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
						</tbody>
					</table>
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
		var id=$(element).parent().attr("id")
		var cleanId=id.replace("product","")
		return [id,cleanId]
	}
	$(".add").on("click",function(){
		var idList=returnId(this)
		$.ajax({
			url:"<?php echo base_url("index.php/cart/ajax/add")?>/"+idList[1],
			success:function (){
				var element= $("#"+idList[0]).parent().find(".want")
				changeWant("up",element)
			}
			
		})
	})
	$(".subtract").on("click",function(){
		var idList=returnId(this)
		$.ajax({
		url: "<?php echo base_url("index.php/cart/ajax/subtract")?>/"+idList[1],
		success:function (){
				var element= $("#"+idList[0]).parent().find(".want")
				changeWant("down",element)
			}
		})
	})

</script>
